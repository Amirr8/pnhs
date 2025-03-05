<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'connection.php' ?>
<?php 
if(isset($_SESSION["Status"])){
    echo '<script>alert ("You already logged in. Please proceed.") ; window.location.href = "dashboard.php"; </script>';
    exit();
}

  if(isset($_POST['submit'])){
    $users = $_POST['user'];
    $passs = $_POST['pass'];
    $fnames = $_POST['fname'];
    $mnames = $_POST['mname'];
    $lnames = $_POST['lname'];
    $User_role = $_POST['user_role'];

    $query = "SELECT * FROM `users` WHERE `Username` = '$users'";
    $stmts = $conn->prepare($query);
    $stmts->execute();
    $result = $stmts->get_result();
    $row = $result->fetch_assoc();

    if($users == @$row['Username']){

      echo '<p class="text-danger">User already exist! Please try another username!</p>';
      


    }else{

    $sql = "INSERT INTO `users`( `Username`, `Password`, `Fname`, `Mname`, `Lname`, `User_role`) VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt -> bind_param("ssssss",$users,$passs,$fnames,$mnames,$lnames,$User_role);
    $stmt->execute();
      echo 'Registered Successfully.';

  }
}
?>

<form method="post" class="mx-auto p-2" style="width: 700px; height:720px;"><br><br>
<div class="logo">
        <img src="pnhs.jpg" alt="Company Logo" class="position-absolute top-40 start-50 translate-middle position-absolute">
        </div><br><br>
<h2>SIGN UP</h2>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input name="user" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input name="pass" type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">First name</label>
    <input name="fname"  class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Middle name</label>
    <input name="mname"  class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Last name</label>
    <input name="lname"  class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
  <label for="user_role">User role</label><BR>
  <select name="user_role" id="user_role">
  <option value="Student">Student</option>
  <option value="Teacher">Teacher</option>
</select>
  </div>

  <button type="submit" name="submit" class="btn btn-success">Submit</button>
			<span class="small"></span> <a href="login.php" class="btn btn-outline-success">LOGIN</a>
		</div>
</form>

<style>
form{
	border: 2px solid green;
	padding: 30px;
	border-radius: 30px;
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


