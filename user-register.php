<?php 


		require_once('connection.php');
		
		if (isset($_POST['submit'])) {
			$errors = array();
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = sha1($_POST['password']);

			$query = "SELECT * FROM users WHERE user_email = '$email' LIMIT 1";
			$result = mysqli_query($connect,$query);
			if (mysqli_num_rows($result) == 1 ) {
				$errors[] = "Email already exist!";
			}else{
				$query = "INSERT INTO users(user_name,user_email,user_password) VALUES ('$name' , '$email' ,'$password' )" ;
				$result = mysqli_query($connect,$query);
				if ($result) {
					header('Location: user-login.php');
				}

			}
			

			

		}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Register</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>



 		<div class="container">
 		<div class="row">
 			<div class="col"></div>
 			<div class="col">
 				<h1>User Register</h1><br>
 				<?php 
					if (isset($errors)) {
						echo "<div class='alert alert-danger' role='alert'>$errors[0]</div>";
					}
				 ?>
 				
 				<form method="post" action="user-register.php">
 					<div class="form-group">
					    <label for="exampleInputEmail1">Name</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="name">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Email address</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
					  </div>
					  
				  <button type="submit" class="btn btn-success" name="submit">Register</button>
				</form>
 			</div>
 			<div class="col"></div>
 		</div>
 	</div>

</body>
</html>