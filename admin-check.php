
<?php
session_start(); 
		if (!isset($_SESSION['admin_id'])) {
			header('Location: admin-login.php');
		} 
?>