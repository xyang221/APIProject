<?php
 include("db_conn.php");
require_once 'config.php';

$permissions = ['email']; //optional

if (isset($accessToken))
{
	if (!isset($_SESSION['facebook_access_token'])) 
	{
		//get short-lived access token
		$_SESSION['facebook_access_token'] = (string) $accessToken;
		
		//OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();
		
		//Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
		
		//setting default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	} 
	else 
	{
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}
	
	
	//redirect the user to the index page if it has $_GET['code']
	if (isset($_GET['code'])) 
	{
		header('Location: ./');
	}
	
	
	try {
		$fb_response = $fb->get('/me?fields=name,first_name,last_name,email');
		$fb_response_picture = $fb->get('/me/picture?redirect=false&height=200');
		
		$fb_user = $fb_response->getGraphUser();
		$picture = $fb_response_picture->getGraphUser();
		
		$_SESSION['fb_user_id'] = $fb_user->getProperty('id');
		$_SESSION['fb_user_name'] = $fb_user->getProperty('name');
		$_SESSION['fb_user_email'] = $fb_user->getProperty('email');
		$_SESSION['fb_user_pic'] = $picture['url'];


	
	$user_query = mysqli_query($conn, "SELECT * FROM fb_users ");

	// Fetch the next row of a result set as an associative array
	$users = mysqli_fetch_assoc($user_query);
		
		if($_SESSION['fb_user_id'] == $users['fb_id']){
		$id = mysqli_real_escape_string($conn, $_SESSION['fb_user_id']);
		$name = mysqli_real_escape_string($conn, $_SESSION['fb_user_name']);
	// $age = mysqli_real_escape_string($conn, $_POST['age']);
	$email = mysqli_real_escape_string($conn, $_SESSION['fb_user_email']);
	// $password = mysqli_real_escape_string($conn, $_POST['password']);
	$status ='Active';
	$role ='User';

	// Insert data into database
	$result = mysqli_query($conn, "INSERT INTO fb_users (`fb_id`, `fb_name`, `fb_email`, `role`, `status`) VALUES ('$id', '$name', '$email', '$role', '$status')");

		}
		
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		echo 'Facebook API Error: ' . $e->getMessage();
		session_destroy();
		// redirecting user back to app login page
		header("Location: ./");
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		echo 'Facebook SDK Error: ' . $e->getMessage();
		exit;
	}
} 
else 
{	
	// replace your website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and you used
	$fb_login_url = $fb_helper->getLoginUrl('http://localhost/Integra-ApiMidtermProjectFinal/', $permissions);
}


// $id = $_SESSION['fb_user_id'];
// $user_query = mysqli_query($conn, "SELECT * FROM fb_users WHERE fb_id = $id");

// // Fetch the next row of a result set as an associative array
// $userresult = mysqli_fetch_assoc($user_query);
// $name = $userresult['fb_name'];
// $name = $userresult['fb_name'];
// $email = $userresult['fb_email'];	
// $role = $userresult['role'];
// $status = $userresult['status'];

?>

<!DOCTYPE html>
<html lang="en">
	
<head>
	<title>HOME</title>
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

<!-- NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN --> 
<!--  If the user is login  -->
<?php if(isset($_SESSION['fb_user_id'])): 
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
				   <a href="oauth/fbEdit.php" class="btn blue">Edit</a>
				   <a href="userDelete.php" onClick="return confirm('Are you sure you want to DELETE your account? You can no longer retrieve this account if you click OK.')"class='btn red'>Delete</a>
			    	<a href="loggingout.php" class="btn btn-dark">Logout</a>
				<div>
				<h3><strong><?php echo $_SESSION['fb_user_name'] ; ?></strong></h3>
					<tr>
					<td><strong>ID: </strong><?php echo $_SESSION['fb_user_id']; ?><br></td>
					</tr>
				
					<tr>
					<td><strong>Email: </strong><?php echo $_SESSION['fb_user_email']; ?><br></td>
					</tr>
			</td></td>
		</div>
		</table>
		</div>
<!-- NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN --> 
<!-- if user not login --> 
<?php else: ?>
	
	<h2 class="text-center p-3">APPLICATION PROGRAMMING INTERFACE</h2>
	   <h4 class="text-center p-3">Midterm Project</h4>
	   <h5 class="text-center p-3">Group Members: <br> Balanay, Willy Jean <br> Bastillada, Dianne <br> Sumastre, Anna Jean</h5>
		<center>
	<form class="border shadow p-3 rounded"
      	      action="php/check-login.php" 
      	      method="post" 
      	      style="width: 450px;">
		<h1 class="text-center p-3">LOGIN</h1>
		<?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>		

			
			
		
			<div class="mb-3">
		    <label for="email" 
		           class="form-label">Email</label>
		    <input type="email" 
		           class="form-control" 
		           name="email" 
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
		
		  <button type="submit" class="btn btn-primary">LOGIN</button>
		
			<div class="clearfix">
				
				<a href="#" class=" text-success">Forgot Password?</a>
			</div>  
			<div class="or-seperator"><i>or</i></div>
			<div class="hint-text">Don't have an account? <a href="register.php" class="text-success">Register Now!</a></div>
			
			<a href="<?php echo $fb_login_url;?>"  class="btn btn-primary"><i class="fa fa-facebook"></i> Log in with <b>Facebook</b></a>
		</form>
		</center>
<?php endif ?>
<!-- NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN --> 
      
</body>
</html>