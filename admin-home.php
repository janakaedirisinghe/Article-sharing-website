<?php require_once('connection.php'); ?>
<?php require_once('header.php') ?>

<?php require_once('admin-check.php') ?>


<?php 
		$query = "SELECT * FROM post ";
		$result = mysqli_query($connect,$query);

		
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>
		post add
	</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		
			<br>

		<div class="row">
			<div class="col-md-4">
				<?php 
					$query = "SELECT * from post";
					$result = mysqli_query($connect,$query);
					$post_count = mysqli_num_rows($result);

					$query = "SELECT * from comment";
					$result = mysqli_query($connect,$query);
					$post_comment = mysqli_num_rows($result);

					$myfile = fopen("counter.txt", "r") or die("Unable to open file!");
					$post_views= fgets($myfile);
					fclose($myfile);

				 ?>
				<ul class="list-group">
					<li class="list-group-item" style="text-align: center;">Analysis</li>
				  <li class="list-group-item d-flex justify-content-between align-items-center">
				    Total Post
				    <span class="badge badge-success badge-pill"><?php echo $post_count; ?></span>
				  </li>
				  <li class="list-group-item d-flex justify-content-between align-items-center">
				    All views
				    <span class="badge badge-success badge-pill"><?php echo $post_views; ?></span>
				  </li>
				  <li class="list-group-item d-flex justify-content-between align-items-center">
				    All Comments
				    <span class="badge badge-success badge-pill"><?php echo $post_comment; ?></span>
				  </li>
				</ul>
				
			</div>	
			<div class="col-md-8">
				<?php 
				function limit_words($string, $word_limit)
					{
					    $words = explode(" ",$string);
					    return implode(" ",array_splice($words,0,$word_limit));
					}
 
				
						$query = "SELECT * FROM post ";
						$result = mysqli_query($connect,$query);

						if (mysqli_num_rows($result) != 0 ) {
							while ($row = mysqli_fetch_assoc($result)) {
								?>
								<div class="card" style="height: 15rem">
									  <div class="card-header">
									   <b> <?php echo $row['post_title']; ?></b>
									  </div>
									  <div class="card-body">
									    
									    <p class="card-text"><?php echo limit_words($row['post_content'],25)."...." ?></p>
									    <div>
									    	<a href="#" class="badge badge-primary">View</a>
									    	<?php 
									    			if ($row['status'] == 'published') {
									    				?>
									    				<a  style="color: white;" onclick="deleteMe(<?php echo $row['id']; ?>)" class="badge badge-danger">Delete</a>
									    				<?php
									    			}else{
									    				?>
									    				<a  style="color: white;" onclick="republishMe(<?php echo $row['id']; ?>)" class="badge badge-info">Republish</a>
									    				<?php
									    			}
									    	 ?>
										    
										    <a href="post-update.php?id=<?php echo($row['id']) ?>" class="badge badge-success">Update</a>
									    </div>
									  </div>
									  
								</div>
								<br>


								<?php
							}
						}else{
							echo "<div class='alert alert-danger' role='alert'>
								  No post Found!
								</div>";
						}

				 ?>
				
				
				
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function deleteMe(id)
		{
			if (confirm("Do you want to delete?")) {
				window.location.href='post-delete.php?id='+id+'';
				return true;
			}
		}
		function republishMe(id)
		{
			if (confirm("Do you want to republish?")) {
				window.location.href='post-republish.php?id='+id+'';
				return true;
			}
		}
	</script>


</body>
</html>