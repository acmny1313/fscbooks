
<html>
<head>
	<title>FSCBOOKS</title>
	<link rel="stylesheet" type = "text/css" href = "globalStyles.css">
</head>
<body>
<header>
	<h1>FSCBOOK Exchange</h1>
	<h3>A place to exchange books</h3>
</header>
<nav class = "navBar">
	<a class="home" href="index.html"><img src = "home.png"></a>
	<a class="search" href = "browse.html"><img src = "browse.png"></a>
	<a class="login" href= "login.html"><img src = "login.png"></a>
	<a class = "signup" href = "signUp.html"><img src = "signUp.png"></a>
	<a class = "profile" href = "profile.html"><img src = "profile.png"></a>
</nav>
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
			echo "new record created successfully";
			
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
	<a class = "profile" href = "login.html">Click here to log in</a>
</body>
</html>
