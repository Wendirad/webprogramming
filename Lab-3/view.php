<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style type="text/css">
		table, thead, tbody, tr, td {
			border-collapse: collapse;
			border: 1px #000 solid;
		}
		tr {
			background: yellow;
		}
		td {
			padding: 5px;
		}
	</style>
</head>
<body>
	<table>
		<thead>
			<td>ID</td>
			<td>Username</td>
			<td>Passowrd</td>
			<td>Edit?</td>
			<td>Delete?</td>
		</thead>
		<tbody>
<?php
	require_once "connection.php";
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header("Location: login.php");
	} else {

		$list_sql = "SELECT id, username, password FROM users";
		if ($stmt = $link->prepare($list_sql)) {
			$stmt->execute();
			$stmt->bind_result($id, $username, $password);
			while($stmt->fetch()) {?>
				<tr>
					<td><?php  echo $id; ?></td>
					<td><?php  echo $username; ?></td>
					<td><?php  echo $password; ?></td>
					<td><a href="edit.php?id=<?php echo $id; ?>">edit</a></td>
					<td><a href="delete.php?id=<?php echo $id; ?>">delete</a></td>
				</tr>
				<?php
			}
		} else {
			echo $link->error;
		}
	}
?>
		</tbody>
	</table>

</body>
</html>