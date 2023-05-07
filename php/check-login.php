<?php  
session_start();
include "../db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$email = test_input($_POST['email']);
	$password = test_input($_POST['password']);
	

	if (empty($email)) {
		header("Location: ../index.php?error=User Name is Required");
	}else if (empty($password)) {
		header("Location: ../index.php?error=Password is Required");
	}else {

		// Hashing the password
		// $password = md5($password);
        
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
        	// the user name must be unique
        	$row = mysqli_fetch_assoc($result);
        	if ($row['password'] === $password) {
        		if ( $row['status'] != 'Active') {
					header("Location: ../index.php?error=Your Account was Disabled or Deleted!");
				}
				else{
				$_SESSION['name'] = $row['name'];
        		$_SESSION['id'] = $row['id'];
        		$_SESSION['role'] = $row['role'];
        		$_SESSION['email'] = $row['email'];
				$_SESSION['status'] = $row['status'];
				header("Location: ../home.php");
        		}
			}
			else {
        		header("Location: ../index.php?error=Incorrect Email or Password");
        	}
        }else {
        	header("Location: ../index.php?error=Incorrect Email or Password");
        }
	}
}else {
	header("Location: ../index.php");
}