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
			<option>Active account
			<option>Waiting for account validation
			</select></p>
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
					//Si une lettre est demandé on va filtrer
					$stmt = $pdo->query("SELECT * 
										FROM users 
					                    JOIN status ON users.status_id = status.id  
										WHERE name = 'Active account' AND username LIKE 'text%'");
					$retour = $stmt-> execute( array('username'=> $_POST['lettre']));
					while ($row = $stmt->fetch()) {
				?>
					<tr>
						<td><?php echo $row['id'];?></td> <!--Test pour pour commit avec le bon "fix"-->
						<td><?php echo $row['username'] ;?></td>
						<td><?php echo $row['email'];?></td>
						<td><?php echo $row['name'];?></td>
					</tr>
				<?php
					}
				}
				?>
		</table>
	</body>
</html>