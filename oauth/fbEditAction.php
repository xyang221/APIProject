<?php
require_once("db_conn.php");

if (isset($_POST['update'])) {
	// Escape special characters in a string for use in an SQL statement
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);		

	$result = mysqli_query($conn, "UPDATE fb_users SET `fb_name` = '$name',   `fb_email` = '$email' WHERE `fb_id` = '$id'");
	header('location:display.php');
	
}
