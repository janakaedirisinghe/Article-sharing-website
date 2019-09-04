<?php require_once('connection.php'); ?>
<?php session_start(); ?>
<?php 
		if (!isset($_SESSION['user_id'])) {
			header('Location: user-login.php');
		} 
?>


<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">

			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				  <a class="navbar-brand" href="#">Post</a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarNav">
				    <ul class="navbar-nav">
				      
				      <li class="nav-item">
				        <a class="nav-link" href="#">Features</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="#">Pricing</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
				      </li>
				    </ul>
				  </div>
			</nav>
			<br>

		<div class="row">
			<div class="col-md-4" >
				<?php 
						$query = "SELECT * FROM post WHERE status = 'published' ";
						$result = mysqli_query($connect,$query);
						while ($row = mysqli_fetch_assoc($result)) {
							?>
									<a style="text-decoration:none;" href="post-read.php?id=<?php echo($row['id']) ?>">
										<div class='alert alert-success' role='alert'>
					 					 <?php echo $row['post_title']; ?>
										</div>
									</a>

							<?php
						}


				 ?>
				 					
				
				
			</div>

			<div class="col-md-8">
				<?php 
				function limit_words($string, $word_limit)
					{
					    $words = explode(" ",$string);
					    return implode(" ",array_splice($words,0,$word_limit));
					}
 
				
						$query = "SELECT * FROM post WHERE status = 'published' ";
						$result = mysqli_query($connect,$query);

						if (mysqli_num_rows($result) != 0 ) {
							while ($row = mysqli_fetch_assoc($result)) {
								?>

				<div class="card">
					  <div class="card-header">
					   <b> <?php echo $row['post_title']; ?></b>
					  </div>
					  <div class="card-body">
					    
					    <p class="card-text"><?php echo limit_words($row['post_content'] , 15) . "...."; ?></p>
					    <a href="post-read.php?id=<?php echo($row['id']) ?>" class="btn btn-success" style="float: right;">Read More</a>
					  </div>
					  <div class="card-footer text-muted">
					   <small><?php echo $row['post_date']; ?></small>
					  </div>
				</div>
				<br>
				
					<?php } } ?>


				


			</div>
		</div>
	</div>


</body>
</html>