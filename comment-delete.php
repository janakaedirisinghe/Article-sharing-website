<?php require_once('connection.php') ?>

<?php 
		$post_id = $_GET['post_id'];
		$comment_id = $_GET['comment_id'];

		$query = "DELETE from comment WHERE id=$comment_id";
		$result = mysqli_query($connect,$query);
		header('Location: post-read.php?id='.$post_id.'');
 ?>