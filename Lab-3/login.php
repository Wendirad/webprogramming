<?php
	require_once "connection.php";
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$username = $link->real_escape_string($_POST['username']);
		$password = $link->real_escape_string($_POST['password']);
		$remember_me = $_POST['remember_me'];

		$auth_sql = "SELECT id, password FROM users WHERE username = ?";
		if ($stmt = $link->prepare($auth_sql)) {
			$stmt->bind_param("s", $username_param);
			$username_param = $username;
			$stmt->execute();
			$stmt->bind_result($user_id, $hashed_password);
			if ($stmt->fetch()) {
				if (password_verify($password, $hashed_password)) {
					$_SESSION['user_id'] = $user_id;
					if ($remember_me == "on") {
						$expiry =  1 * 60;
						setcookie("username", $username, time() + $expiry , "/");
						setcookie("password", $password, time() + $expiry , "/");
					}
					header("Location: index.php");
					exit();
				} else {
					echo "INVALID USERNAME and/or PASSWORD";
				}
			} else {
				echo "INVALID USERNAME and/or PASSWORD";
			}
		} else {
			echo $link->error;
		}
	} else {
		$username = $_COOKIE['username'];
		$passward = $_COOKIE['password'];
		echo $username." ".$password;
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
	<h4>Login</h4>
	<form action="login.php" method="POST" accept-charset="utf-8">
		<div>
			<label>Username</label>
			<input type="text" placeholder="username" name="username">
		</div>
		<div>
			<label>Password</label>
			<input type="password" placeholder="password" name="password">
		</div>
		<div>
			<input type="checkbox" name="remember_me">
			<label>Remember me</label>
		</div>
		<div>
			<button type="submit">Register</button>
		</div>
	</form>
</body>
</html>

<!-- // Reading assignment require_once and include. -->