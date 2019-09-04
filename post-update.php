<?php require_once('connection.php') ?>
<?php require_once('header.php') ?>
<?php session_start(); ?>
<?php 
	

		
	if (isset($_POST['submit'])) {


		
		$errors = array();

		/*if (!isset($_POST['post_title']) || strlen(trim($_POST['post_title'])) < 5) {
			$errors[] = "Post Title Invalid or missing!" ;
		}

		if (!isset($_POST['post_content']) || strlen(trim($_POST['post_content'])) < 5 ) {
			$errors[] = "Post content missing or invalid!";
		}*/

		if (empty($errors)) {
			$post_id = $_POST['post_id'];
			$post_title = $_POST['post_title'];
			$post_content = $_POST['post_content'];
			$post_date = date("Y/m/d");

			//echo $post_title . $post_content;

			$query = "UPDATE post SET 
			post_title = '$post_title', 
			post_content = '$post_content', 
			post_date = '$post_date' 
			WHERE id = $post_id ";

			$result = mysqli_query($connect,$query);
			if ($result) {
				echo "<script>window.alert('Your post update successfully!')</script>";
				echo "<script>window.location.href='admin-home.php'</script>";

			}
		}
	}
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Post Update</title>
	 <script src="//cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
</head>
<body>
	<div class="container">
		<!--<?php if (isset($errors)) {
			echo "	<div class='alert alert-danger' role='alert'>
						$errors[0]
					</div> ";
		} ?> -->

		<?php 
				if (isset($_GET['id'])) {
					 $post_id = $_GET['id'];
					$query = "SELECT * FROM post WHERE id = $post_id LIMIT 1";
					$result = mysqli_query($connect,$query);
					while ($row = mysqli_fetch_assoc($result)) {
						?>

						<form action="post-update.php" method="post">
							  <div class="form-group">
							    <label for="exampleFormControlInput1">Post Title</label>
							    <input type="text" class="form-control" id="exampleFormControlInput1" name="post_title" value="<?php echo($row['post_title']) ?>">
							  </div>
							  <div class="form-group">
							    <label for="exampleFormControlTextarea1">Post Content</label>
							    <textarea  class="form-control"  rows="10" name="post_content"><?php echo $row['post_content']; ?></textarea>
							  </div>
							  <script>
						            CKEDITOR.replace( 'post_content' );
						      </script>
						      <input type="text" name="post_id" hidden="" value="<?php echo $row['id']; ?>">
						      <button type="submit" class="btn btn-success" name="submit">Update</button>
						</form>



						<?php
					}
				}
		 ?>

			
         
                
	</div>

</body>
</html>