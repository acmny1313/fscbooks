<!doctype html>
<?php
	 session_start();
   //include('session.php');
   
?>

<html>
<head>
	<title>FSCBOOKS</title>

	<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type = "text/css" href = "globalStyles.css">
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
    <a href="Home" class="w3-bar-item w3-button w3-padding-large ">Home</a>
    <a href="Browse" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-gray w3-white">Browse</a>

	<div class="w3-dropdown-hover">

		<a href="Profile" class="w3-bar-item w3-button w3-padding-large w3-teal">Profile</a>
			<div class="w3-dropdown-content w3-bar-block w3-border">
			<a href="Profile" class="w3-bar-item w3-button w3-padding-large">Profile</a>
				<a class="w3-bar-item w3-button" href= "Login">Login</a>
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

<section class="browse" >
	<h3> Here you can search for books to purchase or trade. <?php echo $login_session; ?></h3>
</section>

<div class="w3-container w3-center ">
<div class="w3-container w3-cell w3-white w3-border " style="width: 20%;">
<h4>Filter</h4>
	<form action="" method=POST>
		<ul style="list-style-type:none">
		
			<li> Department: <select name='department' style='width: 100px;'>
    		<option value='null' disabled required >Department</option>
    		<?php
			include('db.php');
			
				$query = "SELECT DISTINCT department from subject ";
	
				$result = mysqli_query($con,$query) or die(mysql_error());
				$rows = mysqli_num_rows($result);
	 
				if($rows>0){
		
					while($row = mysqli_fetch_assoc($result)){
						echo '<option value="' . $row['department'] . '">' . $row['department'] . '</option>';
					}
				}else{
					echo '<option value="BCS">BCS</option>';
				}
				
			?>
    		</select></li>
			<li> Course Number: <select name='courseNumber' style='width: 100px;'>
    		<option value='%'  required >ALL</option>
    		<?php
			include('db.php');
				$query = "SELECT DISTINCT courseNumber from subject ";
	
				$result = mysqli_query($con,$query) or die(mysql_error());
				$rows = mysqli_num_rows($result);
	 
				if($rows>0){
		
					while($row = mysqli_fetch_assoc($result)){
						echo '<option value="' . $row['courseNumber'] . '">' . $row['courseNumber'] . '</option>';
					}
				}else{
					echo '<option value="101">101</option>';
				}
				
			?>
    		</select></li>
		</ul>
		<input type="submit" value="Submit">
	</form>
</div>
<div class="w3-container w3-cell w3-sand w3-center w3-border " style="width: 80%;">
<h4>Books</h4>
<?php
include('db.php');
	$course = stripslashes($_POST['courseNumber']);
	$course = mysqli_real_escape_string($con,$course);
	$dept = stripslashes($_POST['department']);
	$dept = mysqli_real_escape_string($con,$dept);
	
	if($course==null){
	$query = "SELECT * from bookPost ";
	
	$result = mysqli_query($con,$query) or die(mysql_error());
	
	}elseif($course=="%"){
		$query = "SELECT * from bookPost ";
	
		$result = mysqli_query($con,$query) or die(mysql_error());
	}else{
		$query = "SELECT * from bookPost where courseNumber='$course' and department='$dept' ";
	
		$result = mysqli_query($con,$query) or die(mysql_error());
	}

	/* $row = mysqli_fetch_array($result,MYSQLI_NUM);*/
	 $rows = mysqli_num_rows($result);
	 
	 if($rows>0){
		
		while($row = mysqli_fetch_assoc($result)){
			
			if($row['edition'] == 1){
				$numberEnd = "st";
			}
			else if($row['edition'] == 2){
				$numberEnd = "nd";
			}
			else if($row['edition'] == 3){
				$numberEnd = "rd";
			}
			else{
				$numberEnd = "th";
			}
			if($row['statusOfBook']==0){
			echo '<ul style="list-style-type:none">' ;
			echo '<form action="/Book" method=POST >';
			echo '<li class="w3-border">' ;
			echo '<input type="hidden" name="id" value="' . $row["ID"] . '" >';
			
			echo "Title: " .  $row["title"] . "<br>";
			echo "Edition: " . $row['edition'].$numberEnd." edition<br>";
			echo "Author: " . $row['author']."<br>";
			echo "Posted by: ".$row['userName']."<br>";
			echo "Class: " . $row['department'] ." ". $row['courseNumber']."<br>";
			echo "Price: $ ".$row['price'] . "<br>";
			echo '<input type="submit"    value="Details">';
			echo "</li>";
			echo '</form>';
			echo "</ul>";
			
			}
		}
		
	 }else{
			echo " 0 results";
	 }
     
	 
	 function book(){
		 echo "in the function";
	 }


?>
</div>
</div>

        
 
<!-- Footer -->
<div w3-container>
<footer  class="w3-container w3-padding-32 w3-teal w3-center ">

 <p>Powered by Senior Projects Group #1</p>
</footer>
<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
</div>
</body>
</html>
