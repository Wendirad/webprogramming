<?php
	require_once "connection.php";
	session_start();
	
	if (!isset($_SESSION['user_id'])) {
		header("Location: login.php");
		exit();
	} else {
		?>

		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>Index</title>
			<link rel="stylesheet" href="">
		</head>
		<body>
			<h4>You are authenticated as User(<?php echo $_SESSION['user_id']; ?>)</h4>
			<a href="logout.php">Logout</a>
		</body>
		</html>
	<?php
	}
?>