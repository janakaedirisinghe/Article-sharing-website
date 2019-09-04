<?php 
session_start();
require_once('connection.php');
require_once('function.php');



if (isset($_POST['submit'])) {

	$errors = array();
	$errors = verify($_POST['email'],$_POST['password']);

	if (empty($errors)) {
		$user_email = $_POST['email'];
		$user_password = sha1($_POST['password']);

				$query = "SELECT * FROM users WHERE user_email='$user_email' AND user_password='$user_password' " ;
				$result = mysqli_query($connect,$query);
				if (mysqli_num_rows($result) == 1) {
			
					$query = "SELECT * FROM users WHERE user_email='$user_email' " ;
					$result = mysqli_query($connect,$query);
					$row=mysqli_fetch_assoc($result);
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['user_name'] = $row['user_name'];
					header('Location: Home.php');

		}else{
			$errors[] = 'Email or Password invalid';
		}

		}

	

	
}
 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>User Login</title>
 	
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 </head>
 <body>



 	<div class="container">
 		<div class="row">
 			<div class="col"></div>
 			<div class="col">
 				<h1>User Login</h1><br>
 				<?php 
					if (isset($errors)) {
						echo "<div class='alert alert-danger' role='alert'>$errors[0]</div>";
					}
				 ?>
 				<form method="post" action="user-login.php">
					  <div class="form-group">
					    <label for="exampleInputEmail1">Email address</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
					  </div>
					  
				  <button type="submit" class="btn btn-success" name="submit">Login</button>
				</form>
 			</div>
 			<div class="col"></div>
 		</div>
 	</div>

 

 
 </body>
 </html>