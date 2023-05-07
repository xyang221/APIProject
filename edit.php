<?php
require_once("db_conn.php");

$id = $_GET['id'];

// Select data associated with this particular id
$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");

// Fetch the next row of a result set as an associative array
$resultData = mysqli_fetch_assoc($result);

$id = $resultData['id'];
$name = $resultData['name'];
$age = $resultData['age'];
$email = $resultData['email'];
$password = $resultData['password'];
?>

<html>
<head>	
	<title>Edit Data</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
	<h2 align=center>Edit User Data</h2>
	<form name="edit" method="post" action="editAction.php">
		<center><table border="0" width="25%">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name; ?>" required></td>
			</tr>
			<tr> 
				<td>Age</td>
				<td><input type="text" name="age" value="<?php echo $age; ?>" required></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="email" value="<?php echo $email; ?>" required></td>
			</tr>
			<tr> 
				<td>Password</td>
				<td><input type="text" name="password" value="<?php echo $password; ?>" required></td>
			</tr>
			<tr>
                <td><input type="hidden" name="id" value=<?php echo $id; ?>></td>
			</tr>
			</table>
				<button type="submit" name="update" value="Update" class="btn btn-dark" onClick="return confirm('Your Data Updated Successfully!')">Update</button>
				<a href="display.php" class="btn btn-dark">BACK</a>
</center>
	</form>	
</body>
</html>
