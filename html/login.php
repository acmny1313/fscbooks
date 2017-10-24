<?php

   include('session.php');
   if(isset($_SESSION['login_user'])){
      header("location: Profile.php");
   }
?>

<html>
<head>
	<title>FSCBOOKS</title>
	<link rel="stylesheet" type = "text/css" href = "globalStyles.css">
	<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
<body>

  <header class="w3-container w3-teal w3-center" style="padding:25px 16px">
	<h1>FSCBOOK Exchange</h1>
	<h3>A place to exchange books</h3>
</header>
<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-teal w3-card-2 w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="Home" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="Browse" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Browse</a>

	<div class="w3-dropdown-hover">

		<a href="Profile" class="w3-bar-item w3-button w3-padding-large">Profile</a>
			<div class="w3-dropdown-content w3-bar-block w3-border">
			<a href="Profile" class="w3-bar-item w3-button w3-padding-large">Profile</a>
				<a class="w3-bar-item w3-button" href= "Login.html">Login</a>
				<a class = "w3-bar-item w3-button" href = "SignUp">Sign Up</a>
				<a class="w3-bar-item w3-button" href="Logout">Log Out</a>
			</div>
	</div>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 4</a>
  </div>
</div>
<section class = "login">
<?php
include('db.php');



if($_SERVER["REQUEST_METHOD"]=="POST"){

	$username = stripslashes($_POST['email']);
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_POST['password']);
	$password = mysqli_real_escape_string($con,$password);

	$query = "SELECT username,password FROM account where username='$username' and password='$password'";
	$result = mysqli_query($con,$query) or die(mysql_error());


	 $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];

	  $rows = mysqli_num_rows($result);

	if($rows == 1){
				$_SESSION['login_user'] = $username;
				header( "location: /Profile" );
	}else{
		header( "location: /Login");
		echo '';
	}

}
?>

  	  <h3>Welcome back please log in.</h3>
			<font color="red"><h3>Incorrect username/password.</h3></font>
			<form action="" method="POST" id="login">
			Email:<br>
      <input type="email" name="email" required><br>
			Password:<br>
      <input type="password" name="password" required><br>
			<input type="submit" value="Submit">
			<input type="reset"  value="Reset">
			</form>
			</section>

   </body>

</html>
