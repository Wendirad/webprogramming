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
					header("Location : view.php");
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