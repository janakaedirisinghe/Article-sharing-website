<?php require_once('connection.php'); ?>
<?php require_once('main-header.php') ?>
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
	
</head>
<body>
	<div class="container">

			
	
		<div class="row">
			<div class="col-md-4" >
				<h3>Recent Post</h3>
				<br>
				
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
					   
					    <a href="post-read.php?id=<?php echo($row['id']) ?>" style="float: right;" class="badge badge-success">Read More</a>
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