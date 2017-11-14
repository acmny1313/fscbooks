<?php
   include('session.php');
?>
<html>
<head>
	<title>FSCBOOKS</title>
	<link rel='stylesheet' type = 'text/css' href = 'globalStyles.css'>
	<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>

</head>
<body>

  <header class='w3-container w3-teal w3-center' style='padding:25px 16px'>
	<h1>FSCBOOK Exchange</h1>
	<h3>A place to exchange books</h3>
</header>
<!-- Navbar -->
<div class='w3-top'>
  <div class='w3-bar w3-teal w3-card-2 w3-left-align w3-large'>
    <a class='w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red' href='javascript:void(0);' onclick='myFunction()' title='Toggle Navigation Menu'><i class='fa fa-bars'></i></a>
    <a href='Home' class='w3-bar-item w3-button w3-padding-large '>Home</a>
    <a href='Browse' class='w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white'>Browse</a>

	<div class='w3-dropdown-hover'>

		<a href='Profile' class='w3-bar-item w3-button w3-padding-large w3-white'>Profile</a>
			<div class='w3-dropdown-content w3-bar-block w3-border'>
			<a href='Profile' class='w3-bar-item w3-button w3-padding-large'>Profile</a>
				<a class='w3-bar-item w3-button' href= 'Login'>Login</a>
				<a class = 'w3-bar-item w3-button' href = 'SignUp'>Sign Up</a>
				<a class='w3-bar-item w3-button' href='Logout'>Log Out</a>
			</div>
	</div>
  </div>

  <!-- Navbar on small screens -->
  <div id='navDemo' class='w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large'>
    <a href='#' class='w3-bar-item w3-button w3-padding-large'>Link 1</a>
    <a href='#' class='w3-bar-item w3-button w3-padding-large'>Link 2</a>
    <a href='#' class='w3-bar-item w3-button w3-padding-large'>Link 3</a>
    <a href='#' class='w3-bar-item w3-button w3-padding-large'>Link 4</a>
  </div>
</div>

<?php
  include('db.php');

//if($_SERVER["REQUEST_METHOD"]=="POST"){
  $username = stripslashes($login_session);
  $username = mysqli_real_escape_string($con,$login_session);

  $act = stripslashes($_POST['act']);

  if($act == 'accountUpdate'){
    $firstname = stripslashes($_POST['fname']);
    $firstname = mysqli_real_escape_string($con,$firstname);
    $lastname = stripslashes($_POST['lname']);
    $lastname = mysqli_real_escape_string($con,$lastname);
    $password = stripslashes($_POST['pswd']);
    $password = mysqli_real_escape_string($con,$password);
    $year = stripslashes($_POST['year']);
    $year = mysqli_real_escape_string($con,$year);

    $updateQuery = "UPDATE account set firstname = '$firstname', lastname = '$lastname', password = '$password', year = '$year' where username = '$login_session';";

    if(mysqli_query($con,$updateQuery)){
       header('Location: /Profile');
    }
    else{
      echo "error" . $sql . "<br>" . mysqli_error($con);
    }
  }

  $query = "SELECT * FROM account where userName = '$username';";
  $result = mysqli_query($con,$query) or die(mysql_error());
  $rows = mysqli_num_rows($result);

  $row = mysqli_fetch_assoc($result);

//For the year


if($row['year'] == Freshman){
  $year1 = 'selected';
}
else if($row['year'] == Sophomore){
  $year2 = 'selected';
}
else if($row['year'] == Junior){
  $year3 = 'selected';
}
else if($row['year'] == Senior){
  $year4 = 'selected';
}
  ?>

<section class = "signup">
	<h3>Edit Account Info</h3>

	<form action="EditAccount" method="POST" id="frm1">
		Email: <?php echo $login_session ?>
    <br>
    <br>
    <input type='hidden' name='act' value ='accountUpdate'/>
		First name:<br>
		<input type="text" name="fname" value ="<?php echo $row['firstname'] ?>" required><br>
		Last name:<br>
		<input type="text" name="lname" value ="<?php echo $row['lastname'] ?>" required><br>
		Password: <br>
		<input type="password" name="pswd" value ="<?php echo $row['password'] ?>" required><br><br>
		Year: <select name="year" form="frm1">
				<option value="null"disabled required>Select a year</option>
				<option value="Freshman" <?php echo $year1;?>>Freshman</option>
				<option value="Sophomore" <?php echo $year2;?>>Sophomore</option>
				<option value="Junior" <?php echo $year3;?>>Junior</option>
				<option value="Senior" <?php echo $year4;?>>Senior</option>
				</select>
				<br>
        <br>
	<input type="submit"  value="Save">
	<input type="reset"  value="Reset">
</form>

</section>

<!-- Footer -->
<footer  class="w3-container w3-padding-32 w3-teal w3-center ">

 <p>Powered by Senior Projects Group #1</p>
</footer>
</body>
</html>
