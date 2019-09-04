<?php 
		$myfile = fopen("counter.txt", "r") or die("Unable to open file!");
		$count= fgets($myfile);
		$count+=1;
		fclose($myfile);

		$myfile = fopen("counter.txt", "w") or die("Unable to open file!");
		$txt = $count;
		fwrite($myfile, $txt);

		fclose($myfile);

 ?>
<?php require_once('connection.php') ?>


<?php session_start(); ?>
<?php 
		if (!isset($_SESSION['user_id'])) {
			header('Location: user-login.php');
		} 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Post Share App</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<br>
		<?php 
			$post_id = $_GET['id'];
			$query = "SELECT * FROM post WHERE id = $post_id LIMIT 1";
			$result = mysqli_query($connect,$query);
			$row = mysqli_fetch_assoc($result);

		 ?>
		 	<div class="jumbotron jumbotron-fluid">
			  <div class="container">
			    <h1 class="display-4"><?php echo $row['post_title']; ?></h1>
			    
			  </div>
			</div>
		 <br>
		 <div style="background-color: #fcfcfc;padding: 15px 25px 15px 25px;">
		 	<?php echo $row['post_content']; ?>
		 </div>

		<hr>
		<div class="row">
			<div class="col-md-2"></div>



			<div class="col-md-8">
				<h3>Comments</h3><br>

					<?php 
					$id =  $row['id'];
						$query = "SELECT comment.comment_content,users.user_name,comment.comment_date FROM comment,users 
						WHERE comment.post_id = $id AND comment.user_id = users.user_id";

						$result = mysqli_query($connect,$query);
						while ($row = mysqli_fetch_assoc($result)) {
							?>
								<div style="border-left: solid  ;border-color: green;padding-left: 8px;">
									<h6><?php echo $row['user_name'] ?></h6>
									<p style="padding-left: 10px;"><?php echo $row['comment_content'] ?></p>
									<small style="color: gray"><?php echo $row['comment_date']; ?></small>
								</div><br>


							<?php
							//echo $row['user_name']."-".$row['comment_content'];
						}



					 ?>

				<hr>
				<form action="post-comment.php" method="post">
				  <div class="form-group">
				   
				    <input type="text" class="form-control" placeholder="<?php echo($_SESSION['user_name']) ?>" autocomplete="off" disabled="" >
				  </div>
				  
				  <div class="form-group">
				    
				    <textarea placeholder="Your comment here" class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment_content"></textarea>
				  </div>
				  <input hidden="" type="text"  name="post_id" value="<?php 	echo($id) ?>">
				  <input hidden="" type="text"  name="user_id" value="<?php 	echo($_SESSION['user_id']) ?>">
				   <button type="submit" class="btn btn-success" name="submit">submit</button>

				</form>
			</div>

			<div class="col-md-2"></div>
		</div>
	</div>
	<br>
	

</body>
</html>