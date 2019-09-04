<?php require_once('connection.php'); ?>
<?php require_once('header.php') ?>
	
<?php 
	
	if (isset($_POST['submit'])) {

		$errors = array();

		if (!isset($_POST['post_title']) || strlen(trim($_POST['post_title'])) < 5) {
			$errors[] = "Post Title Invalid or missing!" ;
		}

		if (!isset($_POST['post_content']) || strlen(trim($_POST['post_content'])) < 5 ) {
			$errors[] = "Post content missing or invalid!";
		}

		if (empty($errors)) {
			$post_title = $_POST['post_title'];
			$post_content = $_POST['post_content'];
			$post_date = date("Y/m/d");

			$query = "INSERT INTO post (post_title,post_content,post_date) VALUES ('$post_title','$post_content','$post_date')" ;

			$result = mysqli_query($connect,$query);
			if ($result) {
				echo "<script>window.alert('Your post publish successfully!')</script>";
				echo "<script>window.location.href='admin-home.php'</script>";

			}
		}
	}
	

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Post</title>
	<meta charset="utf-8">
    <script src="//cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
</head>
<body>
	<div class="container">
		<?php if (isset($errors)) {
			echo "	<div class='alert alert-danger' role='alert'>
						$errors[0]
					</div> ";
		} ?>

			<form action="post-add.php" method="post">
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Post Title</label>
			    <input type="text" class="form-control" id="exampleFormControlInput1" name="post_title" >
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlTextarea1">Post Content</label>
			    <textarea class="form-control"  rows="10" name="post_content"></textarea>
			  </div>
			  <script>
		            CKEDITOR.replace( 'post_content' );
		      </script>
		      <button type="submit" class="btn btn-success" name="submit">Add</button>
			</form>




		
		                	
		                
              
                
	</div>


</body>
</html>