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
		<table>
			<tr>
				<th>ID</th>
				<th>	Username</th>
				<th>	Email</th>
				<th>	Status</th>
			</tr>
				<?php
					$stmt = $pdo->query("SELECT * FROM users 
					                     JOIN status ON users.status_id = status.id  
										 WHERE name = 'Active account' AND username LIKE 'e%'");
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
				?>
		</table>
	</body>
</html>