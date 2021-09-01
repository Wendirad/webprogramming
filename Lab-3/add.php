<?php 
	require_once "connection.php";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$username = $link->real_escape_string($_POST['username']);
		$password = $link->real_escape_string($_POST['password']);

		$insert_user_sql = "INSERT INTO users (username, password) VALUES (?, ?)";

		if ($stmt = $link->prepare($insert_user_sql)) {
			$stmt->bind_param("ss", $param_username, $param_password);
			$param_username = $username;
			$param_password = password_hash($password, PASSWORD_DEFAULT);
			if ($stmt->execute()) {
				if ($stmt->affected_rows == 1){
					header("Location : login.php");
				} else {
					echo $link->error;
				}
			} else {
				echo $link->error;
				exit();
			}
		} else {
			echo $link->error;
			exit();
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
</head>
<body>
	<h3>Add user</h3>
	<form action="add.php" method="POST" accept-charset="utf-8">
		<div>
			<label>Username</label>
			<input type="text" placeholder="username" name="username">
		</div>
		<div>
			<label>Password</label>
			<input type="password" placeholder="password" name="password">
		</div>
		<div>
			<button type="submit">Register</button>
		</div>
	</form>
</body>
</html>