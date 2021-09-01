<?php
	session_start();
	if (isset($_SESSION['page_count'])) {
		$_SESSION['page_count'] += 1;
	} else {
		$_SESSION['page_count'] = 1;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Web Programming Lab 4</title>
	<link rel="stylesheet" href="">
</head>
<body>
 <h2> You are visiting the page  <?php echo $_SESSION['page_count']; ?> times</h2>
</body>
</html>