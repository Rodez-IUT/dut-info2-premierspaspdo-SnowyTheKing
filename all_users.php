<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Premier pas en PDO</title>
		<!-- Bootstrap CSS -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
		<!-- CSS -->
		<link href="css/monStyle.css" rel="stylesheet">
		
		<?php
			/* link a la BD */
			$host = 'localhost';
			$db   = 'my_activities';
			$user = 'root';
			$pass = 'root';
			$charset = 'utf8mb4';
			$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
			$options = [
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES   => false,
			];
			try {
				 $pdo = new PDO($dsn, $user, $pass, $options);
			} catch (PDOException $e) {
				 throw new PDOException($e->getMessage(), (int)$e->getCode());
			}
		?>
	</head>
	
	<body>
	
		<h1>ALL USERS</h1>
		<form method="POST" action>
			 <p>start with letter : 
			 <input type="lettre" name="lettre" /> and status is 
			 <select name="status">
			<option>Active account</option>
			<option>Waiting for account validation</option>
			<option>Waiting for account deletion</option>
			</select>
			<input type ="submit" value="Valider"></p>
		</form>


		
		<table>
			<tr>
				<th>ID&nbsp;&nbsp;&nbsp;</th>
				<th>Username&nbsp;&nbsp;&nbsp;</th>
				<th>Email&nbsp;&nbsp;&nbsp;</th>
				<th>Status</th>
			</tr>
				<?php
				if(isset($_POST['lettre'])){
					
					/*
					* Mettre ici le code avec une requête en 'query'
					*/
					
					//Si une lettre est demandé on va filtrer
					//Le prepare va permettre d'utiliser le excecute en bas pour pouvoir remplacer "username" et "name" par les valeurs
					//qui seront récuprées par le POST
					//Query exécute directement la requête.
					//requeête préparé en dessous
					$stmt = $pdo->prepare("SELECT users.*, status.name                     
										FROM users 
					                    JOIN status ON users.status_id = status.id  
										WHERE name = :name AND username LIKE :username");
					$retour = $stmt-> execute( array('username'=> $_POST['lettre']."%", 'name'=> $_POST['status']));
					while ($row = $stmt->fetch()) {
				?>
					<tr>
						<td><?php echo $row['id'];?></td> 
						<td><?php echo $row['username'] ;?></td>
						<td><?php echo $row['email'];?></td>
						<td><?php echo $row['name'];?>
						<?php
							if($row['name'] != "Waiting for account deletion"){
						?>
								<a href="all_users.php?status_id=3&user_id=<?php echo $row['id'];?>&action=askDeletion"> ask for deletion</a>
						<?php
							}
						?>
						</td>
					</tr>
				<?php
					}
					if( $_GET['action'] == 'askDeletion'){
								$insert = $pdo->prepare("INSERT INTO my_activities.action_log (action_date, action_name, user_id)
														VALUES (:actionDate, :actionName, :userId)
														");
								$retour = $insert->execute(array(date('Y-m-d H:i:s'),'actionName'=> $_GET['action'],
																'userId'=> $_GET['user_id']));
					}
				}
				?>
		</table>
	</body>
</html>