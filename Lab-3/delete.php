<?php 
	require_once "connection.php";
	$user_id = $_GET['id'];
	$sql = "DELETE FROM users WHERE id = ?";
	if ($stmt = $link->prepare($sql)) {
		$stmt->bind_param("d", $param_id);
		$param_id = $user_id;
		if ($stmt->execute()) {
			header("Location: view.php");
		} else {
			echo $link->error;
		}
	 } else {
		echo $link->error;
	}
?>