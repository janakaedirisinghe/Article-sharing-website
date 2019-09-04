<?php require_once('connection.php') ?>

<?php 	

		
		if (isset($_POST['submit'])) {
			$post_id = $_POST['post_id'];
			$user_id = $_POST['user_id'];
			$comment_content = $_POST['comment_content'];
			$comment_date = date("Y/m/d");

			$query = "INSERT INTO comment (post_id,user_id,comment_content,comment_date) VALUES ('$post_id','$user_id','$comment_content','$comment_date')";

			$result = mysqli_query($connect,$query);
			if ($result) {
				# code...
				header('Location: post-read.php?id='.$post_id.'');
			}


		}
 ?>