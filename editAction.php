<?php
require_once("db_conn.php");

if (isset($_POST['update'])) {
	// Escape special characters in a string for use in an SQL statement
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$age = mysqli_real_escape_string($conn, $_POST['age']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);	
	$password = mysqli_real_escape_string($conn, $_POST['password']);	

	$result = mysqli_query($conn, "UPDATE users SET `name` = '$name',  `age` = '$age',  `email` = '$email', `password` = '$password' WHERE `id` = '$id'");
	header('location:display.php');
	
}
