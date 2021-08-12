<?php
	require_once "connection.php";

	$user_id = $_GET['id'];
	if ($_SERVER['REQUEST_METHOD'] == "GET"){
		$sql = "SELECT username, password FROM users WHERE id = ?";
		if ($stmt = $link->prepare($sql)) {
			$stmt->bind_param("d", $param_id);
			$param_id = $user_id;
			if ($stmt->execute()){
				$stmt->bind_result($d_username, $d_password);
				$stmt->fetch();
			} else {
				echo $link->error;
			}
		} else {
			echo $link->error;
		}
	} else {
		$username = $link->real_escape_string($_POST['username']);
		$password = $link->real_escape_string($_POST['password']);
		$user_id = $link->real_escape_string($_POST['user_id']);
		$edit_sql = "UPDATE users SET username=?, password=? WHERE id = ?";

		if ($stmt = $link->prepare($edit_sql)) {
			$stmt->bind_param("ssd", $param_username, $param_password, $param_id);
			$param_username = $username;
			$param_password = $password;
			$param_id = $user_id;

			if ($stmt->execute()) {
				header("Location: view.php");
			}  else {
				echo $link->error;
			}
		} else {
			echo $link->error;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit</title>
</head>
<body>
	<form action="edit.php" method="POST" accept-charset="utf-8">
		<input type="hidden" name="user_id"  value="<?php echo $user_id; ?>">
		<div>
			<label>Username</label>
			<input type="text" placeholder="username" name="username" value="<?php echo $d_username; ?>">
		</div>
		<div>
			<label>Password</label>
			<input type="password" placeholder="password" name="password" value="<?php echo $d_password; ?>">
		</div>
		<div>
			<button type="submit">Update</button>
		</div>
	</form>
</body>
</html>