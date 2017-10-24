<?php
   include('db.php');
   session_start();
   
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($con,"select username from account where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
    if(!isset($_SESSION['login_user'])){
      header("Location: Login.html");
   }
   
  
?>

<html>
<body>
<div class="w3-top">
  <div class="w3-bar w3-teal w3-card-2 w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="index" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="browse" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Browse</a>
	
	<div class="w3-dropdown-hover">
		
		<a href="profile" class="w3-bar-item w3-button w3-padding-large">Profile</a>
			<div class="w3-dropdown-content w3-bar-block w3-border">
			<a href="profile" class="w3-bar-item w3-button w3-padding-large">Profile</a>
				<a class="w3-bar-item w3-button" href= "login">Login</a>
				<a class = "w3-bar-item w3-button" href = "signUp">Sign Up</a>
				<a class="w3-bar-item w3-button" href="logout">Log Out</a>
			</div>	
	</div>
  </div>
  </body>
</html>