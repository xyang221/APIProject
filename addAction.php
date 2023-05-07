<html>
<head>
	<title>REGISTRATION</title>
</head>

<body>
<?php
require_once("db_conn.php");

if (isset($_POST['submit'])) {
	// Escape special characters in string for use in SQL statement	
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$age = mysqli_real_escape_string($conn, $_POST['age']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$status ='Active';
	$role ='User';

	// Insert data into database
	$result = mysqli_query($conn, "INSERT INTO users (`name`, `age`, `email`, `password`, `role`, `status`) VALUES ('$name', '$age', '$email', '$password', '$role', '$status')");
	
	header("Location: register.php?success=Registered successfully!");

	}
?>
</body>
</html>
