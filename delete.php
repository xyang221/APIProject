<?php

require_once("db_conn.php");

$query = mysqli_query($conn,"UPDATE users SET status='Deleted' WHERE id ='".$_GET['id']."'") or die(mysqli_error());
if(!$query){
    echo "<br>User Record was not deleted!<br>";
    }
    else{
    echo"<br>User Record successfully deleted!<br>";
    }
    
header("Location:display.php");