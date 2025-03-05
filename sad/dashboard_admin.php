<?php require 'connection.php';?>
<?php
	if(!isset($_SESSION['username'])){
		echo '<script>alert ("Please login first") ; window.location.href = "admin_login.php"; </script>';
		exit();
	}
                           

if(isset($_POST['logout'])){
	if(isset($_SESSION['username'])){
		$username=$_SESSION['username'];
		$sql = "UPDATE `admin` SET `Status` = '0' WHERE `Username` = '$username'";
		$result = mysqli_query($conn, $sql);

		header("Location:logout.php");
		exit();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
<form action="" method="POST"><br>
	<button type="submit" name="logout" value="logout" class="btn btn-danger"  onclick="return confirm('Are you sure you want to logout?')">Logout</button>
</form>
</body>
</html>