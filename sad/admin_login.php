<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
	<div class="row">
	<div class="col-2">
</div>

<div class="col-8">
<form method="post" class="position-absolute top-50 start-50 translate-middle">
<div class="logo">
            <img src="pnhs.jpg" alt="Company Logo" class="position-absolute top-0 start-50 translate-middle">
        </div>
<h2>ADMIN</h2>
  <div class="mb-3">
    <label for="user" class="form-label">Username</label>
    <input name="user" type="text" class="form-control" id="user" aria-describedby="emailHelp">

  </div>
  
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input name="pass" type="password" class="form-control" id="password">
  </div>

  <button type="submit" name="submit" class="btn btn-success">LOGIN</button>
  <div class="text-center"><br>
			<span class="small"></span><p>Not have an account? <a href="register.php" class="btn btn-outline-success">REGISTER FOR USER</a></p>
		</div>
		<div class="text-center">
			<span class="small"></span> <a href="login.php" class="btn btn-outline-success">LOGIN</a>
		</div>
		
<?php include 'connection.php' ?>
<?php
if(isset($_SESSION["Status"])){
	echo '<script>alert ("You already logged in. Please proceed.") ; window.location.href = "dashboard_admin.php"; </script>';
	exit();
}
	if(isset($_POST['submit'])){
		$users = $_POST['user'];
		$passs = $_POST['pass'];

	if( empty($users) || empty($passs)){
		echo '<p class="text-danger" >Please enter username and password.</p>';
	}else{
	$sql = "SELECT * FROM `admin` WHERE `Username` = ? AND `Password` = ?";
	$stmt = $conn->prepare($sql);
	$stmt -> bind_param("ss",$users,$passs);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();

}

	if ($passs != @$row['Password'] && $users != @$row['Username']) {
		
	  echo '<p class="text-danger" >Incorrect Credentials, Please try again!</p>';
	}else{
		

		if($row['Status'] == 0){
			$query = "UPDATE `admin` SET `Status` = '1' WHERE `Username` = '$users'";
			$stmts=$conn->prepare($query);
			$stmts->execute();
			$_SESSION['username'] = @$row['Username'];
			$_SESSION["Status"] = @$row["Status"];
			header ("Location: dashboard_admin.php");
		}else{

			$username = $_SESSION['username'];
			$sql = "SELECT * FROM `users` WHERE `Username` = '$username'";
			$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_assoc($result);
				if($row['Status'] == 1){
			echo '<script>alert ("This account is already logged in. Please create or log in another account.") ; window.location.href = "dashboard_admin.php"; </script>';
				exit();
	}
}
		}
	header("Location:dashboard_admin.php");
	exit();
	}
  }

?>

</form>

</div>

<div class="col-2">
</div>
<style>
form{
	border: 2px solid green;
	padding: 40px;
	border-radius: 10px;
	box-shadow: 5px 5px green;
}
.logo {
    display: flex;
}

.logo img {
    height: 100px;
    margin-right: 15px;
}
input{
	box-shadow: 3px 3px green;
}
</style>


