<?php  

if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    
    $sql = "SELECT * FROM users ORDER BY id ASC";
    $res = mysqli_query($conn, $sql);
}else{
	header("Location: index.php");
} 