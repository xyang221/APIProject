<?php
require_once("db_conn.php");

// Fetch data
$sql =  "SELECT * FROM users WHERE role ='User'";
$Sql_query = mysqli_query($conn,$sql);
$result = mysqli_fetch_all($Sql_query,MYSQLI_ASSOC);
?>

<html>
<head>	
	<title>Homepage</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<style>
		.btn{
			border: none;
			color: white;
			padding: 8px 8px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 5px 5px;
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
		.darkred{
			background-color: #8B0000;
		}
		.retrieve{
			background-color: #00CED1;
		}
		table,th{
			border-style : solid;
			border-width : 1;
			text-align :center;
			background-color: #FF69B4;
		}
		td{
			text-align :center;
			font-size: 18px;
		}
	</style>	
</head>

<body>
	<div style= " margin-top: 30px;">
		<h2 align=center>CRUD Operations Page</h2>
	</div>

	<div style= "padding-left: 20px; padding-right: 20px;  margin-top: 30px;">
	<table width='100%' border=0 padding='20px'>
		<tr bgcolor='#7CFC00'>
			<td><strong>ID</strong></td>
			<td><strong>Name</strong></td>
			<td><strong>Age</strong></td>
			<td><strong>Email</strong></td>
			<td><strong>Password</strong></td>
			<td><strong>Role</strong></td>
			<td><strong>Status</strong></td>
			<td><strong>Action</strong></td>
		</tr>
		<?php
			foreach ($result as $res) { ?>
				<tr>
				<td><?php echo $res['id']; ?></td>
				<td><?php echo $res['name']; ?></td>
				<td><?php echo $res['age']; ?></td>
				<td><?php echo $res['email']; ?></td>
				<td><?php echo $res['password']; ?></td>
				<td><?php echo $res['role']; ?></td>
				<td><?php echo $res['status']; ?></td>	
				<td>			
					<?php
						echo "<a href=\"edit.php?id=$res[id]\" class='btn blue'>Edit</a>";

						if($res['status']=="Active")
							echo "<a href=disabled.php?id=".$res['id']."\" onClick=\"return confirm('Are you sure you want to DISABLE this USER ACCOUNT?')\"class='btn darkred'>Disable</a>";
						else if($res['status']=="Disabled")
							echo "<a href=enabled.php?id=".$res['id']."\" onClick=\"return confirm('Are you sure you want to ENABLE this USER ACCOUNT?')\"class='btn green'>Enable</a>";
					
						if($res['status']=="Active")
							echo "<a href=\"delete.php?id=".$res['id']."\" onClick=\"return confirm('Are you sure you want to HIDE this USER data?')\"class='btn red'>Soft Delete</a>";
						else if($res['status']=="Deleted")
							echo "<a href=\"retrieve.php?id=".$res['id']."\" onClick=\"return confirm('Are you sure you want to RETRIEVE this USER data?')\"class='btn retrieve'>Retrieve</a>";
					?>		
				</td>
				</tr>	
			<?php
			}
		?>
	</table>
		</div>
	<a href="home.php" class="btn btn-dark">BACK</a>
</body>
</html>
