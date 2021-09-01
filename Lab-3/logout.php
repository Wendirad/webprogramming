<?php
	session_start();
	session_destroy();
	setcookie("forget_user", "", time() - 3600);
	header("Location: login.php");
?>