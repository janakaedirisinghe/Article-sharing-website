<?php require_once('connection.php'); ?>
<?php require_once('admin-check.php') ?>
<?php 
$post_id = $_GET['id'];
$query = "UPDATE post SET status = 'published' WHERE id = $post_id";
$result  = mysqli_query($connect,$query);
if ($result) {
				echo "<script>window.alert('Your post republish successfully!')</script>";
				echo "<script>window.location.href='admin-home.php'</script>";

}

 ?>
