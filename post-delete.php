<?php require_once('connection.php'); ?>
<?php 
$post_id = $_GET['id'];
$query = "UPDATE post SET status = 'deleted' WHERE id = $post_id";
$result  = mysqli_query($connect,$query);
if ($result) {
				echo "<script>window.alert('Your post delete successfully!')</script>";
				echo "<script>window.location.href='admin-home.php'</script>";

}

 ?>
