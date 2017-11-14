
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
				<a class = "w3-bar-item w3-button" href = "SignUp.html">Sign Up</a>
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
	<?php
		require('db.php');
		session_start();
		$fName = stripslashes($_POST["fname"]);
		$fName = mysqli_real_escape_string($con,$fName);
		$lName = stripslashes($_POST["lname"]);
		$lName = mysqli_real_escape_string($con,$lName);
		$email = stripslashes($_POST["mail"]);
		$email = mysqli_real_escape_string($con,$email);
		$password =stripslashes( $_POST["pswd"]);
		$password = mysqli_real_escape_string($con,$password);
		$year=stripslashes( $_POST["year"]);
		$year = mysqli_real_escape_string($con,$year);

		$sql = "INSERT INTO account(username,firstname,lastname,password,year)
		VALUES('$email', '$fName', '$lName','$password','$year')";
		if(mysqli_query($con,$sql)){
			header('Location: /Profile');

		}else{
			echo "error" . $sql . "<br>" . mysqli_error($con);
		}

		//echo  $fName  ;
		//echo   $lName ;
		echo"<p> Thank you for signing up " . $email . "</p>";
		//echo  $password  ;
		//echo "connected";
		session_destroy();
		mysqli_close($con);
	?>
	</p>
	<a class = "profile" href = "Login.html">Click here to log in</a>
	<!-- Footer -->
<footer  class="w3-container w3-padding-32 w3-teal w3-center ">

 <p>Powered by Senior Projects Group #1</p>
</footer>
</body>
</html>
