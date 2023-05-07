<?php
	include("db_conn.php");

	if (isset($_GET['id'])){

		$id = $_GET['id'];

		$sql = "UPDATE `users` SET `status`= 'Active' WHERE id='$id'";

		mysqli_query($conn,$sql);
	}

	header('location:display.php');
?>
