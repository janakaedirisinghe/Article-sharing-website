<?php 
session_start();
require_once('connection.php');
require_once('function.php');



if (isset($_POST['submit'])) {

	$errors = array();
	$errors = verify($_POST['email'],$_POST['password']);

	if (empty($errors)) {
		$admin_email = $_POST['email'];
		$admin_password = sha1($_POST['password']);

				$query = "SELECT * FROM admin WHERE admin_email='$admin_email' AND admin_password='$admin_password' " ;
				$result = mysqli_query($connect,$query);
				if (mysqli_num_rows($result) == 1) {
			
					$query = "SELECT * FROM admin WHERE admin_email='$admin_email' " ;
					$result = mysqli_query($connect,$query);
					$row=mysqli_fetch_assoc($result);
					$_SESSION['admin_id'] = $row['admin_id'];
					$_SESSION['admin_name'] = $row['admin_name'];
					header('Location: admin-home.php');

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
 <body style="background-image:url(img/users.png);text-align: center" >



 	<div class="container" >
 		<div class="row" style="margin-top: 50px">
 			<div class="col"></div>
 			<div class="col">
 				<h1 style="text-align: center;color: gray">Admin Login</h1><br>
 				<?php 
					if (isset($errors)) {
						echo "<div class='alert alert-danger' role='alert'>$errors[0]</div>";
					}
				 ?>
 				<form method="post" action="admin-login.php">
					  <div class="form-group">
					    
					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
					  </div>
					  <div class="form-group">
					   
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