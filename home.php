<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['email']) && isset($_SESSION['id']) && isset($_SESSION['role'])) {   
	$Sql_query = mysqli_query($conn, "SELECT * FROM users WHERE status = 'Active' AND role = 'User' ");
	$result = mysqli_fetch_all($Sql_query,MYSQLI_ASSOC);

	$id = $_SESSION['id'];
	$user_query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");

	// Fetch the next row of a result set as an associative array
	$userresult = mysqli_fetch_assoc($user_query);
	$id = $userresult['id'];
	$name = $userresult['name'];
	$age = $userresult['age'];
	$email = $userresult['email'];
	$password = $userresult['password'];	
	$role = $userresult['role'];
	$status = $userresult['status'];
	?>

<!DOCTYPE html>
<html>
<head>
	<title>DASHBOARD</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<style>
		.btn{
			border: none;
			color: white;
			padding: 10px 10px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 10px 2px;
			cursor: pointer;
			border-radius: 20px;
		}
		.green{
			background-color: #199319;
		}
		.red{
			background-color: red;
		}
		.blue{
			background-color: blue;
		}
		.orange{
			background-color: orange;
		}
		table,th{
			border-style : solid;
			border-width : 1;
			
		}
		td{
			font-size: 18px;
			padding-left: 30px;
		}
		.user{
			width: 100
		}
	</style>	
</head>
<body>
	  
      	<?php if ($_SESSION['role'] == 'Admin') {
			?>
      		<!-- For Admin -->
			  <div style="display: flex; margin:auto; width:80%">
      		<div>
			  <h1><strong>Admin</strong></h1>
			  <img src="img/admin-default.png"
			  	style="width: 12rem; height:12rem;"
				alt="admin image">
			  <div>
			  <h3><strong><?php echo $name; ?></strong></h3>
					<strong>ID: </strong><?php echo $id; ?><br>
					<strong>Age: </strong><?php echo $age; ?><br>
					<strong>Email: </strong><?php echo $email; ?><br>
					<strong>Password: </strong>********<br>
					<strong>Role: </strong><?php echo $role; ?><br>
					<strong>Status: </strong><?php echo $status; ?><br>
				<a href="display.php" class="btn orange">CRUD</a>
				<a href="userEdit.php" class="btn blue">Edit</a>
			    <a href="logout.php" class="btn btn-dark">Logout</a>
			  </div>
			</div>
			<div>
				<?php include 'php/members.php';
                 if (mysqli_num_rows($res) > 0) {?>
                  
				<h1 class="display-4 fs-1" style=" text-align: center" ><strong>User Records</strong></h1>
				<table class="table" 
				       style="margin-left:20px; width: 50rem; background-color: #FFE4C4; 
					   ">
				  <tr bgcolor='#7FFF00'>
					<td><strong>ID</strong></td>
					<td><strong>Name</strong></td>
					<td><strong>Age</strong></td>
					<td><strong>Email</strong></td>
					<td><strong>Password</strong></td>
					<td><strong>Role</strong></td>
					<td><strong>Status</strong></td>
					</tr>

				  <?php
			foreach ($result as $res) { ?>
				<tr>
				<td><?php echo $res['id']; ?></td>
				<td><?php echo $res['name']; ?></td>
				<td><?php echo $res['age']; ?></td>
				<td><?php echo $res['email']; ?></td>
				<td>*********</td>
				<td><?php echo $res['role']; ?></td>
				<td><?php echo $res['status']; ?></td>	
				</tr>	
			<?php
			}
		?>
				</table>
				<?php }?>
			</div>
		</div>
      	<?php }else { 					
			?>
	<div>
      		<!-- FOR USERS -->
			<h2 align=center> User</h2>
			<table border="5" style="margin:auto;"> 
			<tr><td width="90%">
			  <img src="img/user-default.png"  
			       alt="user image" 
				   style="width: 12rem; height:12rem;" >
				   <br>
				   <a href="userEdit.php" class="btn blue">Edit</a>
				   <a href="userDelete.php" onClick="return confirm('Are you sure you want to DELETE your account? You can no longer retrieve this account if you click OK.')"class='btn red'>Delete</a>
			    	<a href="logout.php" class="btn btn-dark">Logout</a>
				<div>
				<h3><strong><?php echo $name; ?></strong></h3>
					<tr>
					<td><strong>ID: </strong><?php echo $id; ?><br></td>
					</tr>
					<tr>
					<td><strong>Age: </strong><?php echo $age; ?><br></td>
					</tr>
					<tr>
					<td><strong>Email: </strong><?php echo $email; ?><br></td>
					</tr>
					<tr>
					<td><strong>Password: </strong>********<br></td>
					</tr>
					<tr>
					<td><strong>Role: </strong><?php echo $role; ?><br></td>
					</tr>
					<tr>
					<td><strong>Status: </strong><?php echo $status; ?><br></td>
			</td></td>
		</div>
      	<?php } ?>
		</table>
		</div>
</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>