<?php
include("db_conn.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>REGISTRATION</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<style> .btn{
			margin: 10px 60px;
		}
	</style>
</head>
<body>
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<form class="border shadow p-3 rounded"
      	      action="addAction.php" 
      	      method="post" 
				name="submit"
      	      style="width: 450px;">
      	      <h1 class="text-center p-3">REGISTER</h1>
				<?php if (isset($_GET['success'])) { ?>
      	      <div class="alert alert-success" role="alert">
				  <?=$_GET['success']?>
			  </div>
			  <?php } ?>
      	      
		  <div class="mb-3">
		    <label for="name" 
		           class="form-label">Name</label>
		    <input type="text" 
		           class="form-control" 
		           name="name" 
		           id="name"
				   required>
		  </div>
		  <div class="mb-3">
		    <label for="age" 
		           class="form-label">Age</label>
		    <input type="number" 
		           name="age" 
		           class="form-control" 
		           id="age"
				   required>
		  </div>
		  <div class="mb-3">
		    <label for="email" 
		           class="form-label">Email</label>
		    <input type="email" 
		           name="email" 
		           class="form-control" 
		           id="email"
				   required>
		  </div>
		  <div class="mb-3">
		    <label for="password" 
		           class="form-label">Password</label>
		    <input type="password" 
		           name="password" 
		           class="form-control" 
		           id="password"
				   required>
		  </div>
		 
		  <button type="submit" 
		  name="submit" class="btn btn-primary">REGISTER</button>
				  
		  <a href='index.php' class="btn btn-dark">LOGIN</a>
		</form>
      </div>
</body>
</html>