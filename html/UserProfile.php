<?php
	$_SESSION['page']="Browse";
  // include('session.php');
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
    <a href="Browse" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-gray ">Browse</a>

	<div class="w3-dropdown-hover">

		<a href="Profile" class="w3-bar-item w3-button w3-padding-large w3-teal w3-white">Profile</a>
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

<?php
  include('db.php');

//if($_SERVER["REQUEST_METHOD"]=="POST"){

  $username = stripslashes($_POST['userName']);
  $username = mysqli_real_escape_string($con,$username);

  $query = "SELECT * FROM bookPost where userName = '$username';";
  $result = mysqli_query($con,$query) or die(mysql_error());

   //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   //$active = $row['active'];

   $rows = mysqli_num_rows($result);
   //Creates array of posts
  if($rows >= 1){

      while($row = $result->fetch_assoc()) {//while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

        $i++;

        $PostArray[$i]['userName'] = $row["userName"];
        $PostArray[$i]['newUsed'] = $row["newUsed"];
        $PostArray[$i]['description'] = $row["description"];
        $PostArray[$i]['id'] = $row["ID"];
        $PostArray[$i]['timeUserAddedBook'] = $row["timeUserAddedBook"];
        $PostArray[$i]['statusOfBook'] = $row["statusOfBook"];
        $PostArray[$i]['price'] = $row["price"];
        $PostArray[$i]['isbn'] = $row["ISBN"];
        $PostArray[$i]['title']=$row['title'];
        $PostArray[$i]['author'] = $row["author"];
        $PostArray[$i]['edition'] = $row["edition"];
        $PostArray[$i]['courseNumber'] = $row["courseNumber"];
        $PostArray[$i]['department'] = $row["department"];
      }
   }
   else{
     header('Location: /Browse');
   }

   //******ACCOUNT INFO*******************
   $accountQuery = "SELECT * FROM account where userName = '$username';";
   $accountResult = mysqli_query($con,$accountQuery) or die(mysql_error());

   $accountRows = mysqli_num_rows($accountResult);
  // $accountRow = $accountResult->fetch_assoc();
   $accountRow = mysqli_fetch_array($accountResult,MYSQLI_ASSOC);

?>
<div class="w3-container">

<section class = 'left' style="border:solid">
<h3><?php echo $username;?></h3>
<hr>
<h5><?php echo $accountRow['firstname']." ".$accountRow['lastname'];?></h5>
<h5><?php echo $accountRow['year'];?></h5>
<hr>

<h4 align="center">Write A Review</h4>

<form id="ratingsForm" action='NewReview' method='POST'>
	<span class="star-rating star-5">
	<input type="radio" name="rating" value="1"><i></i>
	<input type="radio" name="rating" value="2"><i></i>
	<input type="radio" name="rating" value="3"><i></i>
	<input type="radio" name="rating" value="4"><i></i>
	<input type="radio" name="rating" value="5"><i></i>
	</span>
	<br>
	<br>
	<input type="hidden" name="reviewie" value="<?php echo $username;?>">
	<input type="hidden" name="act" value="writeReview">
	<textarea rows="4" cols="35" name="reviewText" placeholder="Write Your Review..."></textarea>
	<input type='submit'  value='Submit'>
</form>

<hr>
<hr>
<?php
//******REVIEWW INFO*******************
$reviewsQuery = "SELECT review, reviewer FROM review where reviewie = '$username';";
$reviewsResult = mysqli_query($con,$reviewsQuery) or die(mysql_error());

$reviewsRows = mysqli_num_rows($reviewsResult);

//Creates array of reviews
if($reviewsRows >= 1){

	 while($reviewsRow = $reviewsResult->fetch_assoc()) {
		 $r++;

		 $reviewsArray[$r]['review'] = $reviewsRow["review"];
		 $reviewsArray[$r]['reviewer'] = $reviewsRow["reviewer"];
	 }
}

// AVERAGE STARS
$avgStarQuery = "SELECT AVG(stars) FROM review WHERE reviewie = '$username';";
$avgStarResult = mysqli_query($con,$avgStarQuery) or die(mysql_error());

//$avgStarRows = mysqli_num_rows($avgStarResult);
$avgStarRow = mysqli_fetch_array($avgStarResult,MYSQLI_ASSOC);
//$avgStarRow = $avgStarResult->fetch_assoc()
echo $avgStarRow['AVG(stars)'];


 ?>

</section>

<aside>
<?php
  echo "<h3>Postings</h3>";

  if($rows == 0){
    echo "<h4>".$something."</h4>";
  }
  $ifNoCurrentPostings = 0;
  for($j = 1; $j<=$i; $j++){

    //Creates array for sold books
    if($PostArray[$j]['statusOfBook'] == 1){

      $opa++;
      $oldPostArray[$opa] = $j;
      continue;
    }
    $ifNoCurrentPostings = 1; //Will display no current postings if there are none

    if($PostArray[$j]['edition'] == 1){
      $numberEnd = "st";
    }
    else if($PostArray[$j]['edition'] == 2){
      $numberEnd = "nd";
    }
    else if($PostArray[$j]['edition'] == 3){
      $numberEnd = "rd";
    }
    else{
      $numberEnd = "th";
    }

    echo "<hr><br>";
    echo $PostArray[$j]['title']."<br>";
    echo $PostArray[$j]['edition'].$numberEnd." edition<br>";
    echo $PostArray[$j]['author']."<br>";
    echo "ISBN: ".$PostArray[$j]['isbn']."<br>";
    echo $PostArray[$j]['department'] ." ". $PostArray[$j]['courseNumber']."<br>";
    echo "$ ".$PostArray[$j]['price'];

  }
  //Displays no postings if there are none
  if($ifNoCurrentPostings == 0){
    echo "<h4>No Current Postings For Sale!</h4>";
  }

  //For old sold posts **$oldPostArray[$opa] contains an array of the index of PostArray of books that are marked as sold
  /*if($opa >=1){
  echo "<hr><br>";
  echo "<h3>Sold Postings</h3>";

  for($y = 1; $y<$opa+1; $y++){

    if($PostArray[$oldPostArray[$y]]['edition'] == 1){
      $numberEnd = "st";
    }
    else if($PostArray[$oldPostArray[$y]]['edition'] == 2){
      $numberEnd = "nd";
    }
    else if($PostArray[$oldPostArray[$y]]['edition'] == 3){
      $numberEnd = "rd";
    }
    else{
      $numberEnd = "th";
    }

    echo "<hr><br>";
    echo $PostArray[$oldPostArray[$y]]['title']."<br>";
    echo $PostArray[$oldPostArray[$y]]['edition'].$numberEnd." edition<br>";
    echo $PostArray[$oldPostArray[$y]]['author']."<br>";
    echo "ISBN: ".$PostArray[$oldPostArray[$y]]['isbn']."<br>";
    echo $PostArray[$oldPostArray[$y]]['department'] ." ". $PostArray[$oldPostArray[$y]]['courseNumber']."<br>";
    echo "$ ".$PostArray[$oldPostArray[$y]]['price'];
  }
}*/

  ?>
</aside>
</div>

<!-- Footer -->
<footer  class="w3-container w3-padding-32 w3-teal w3-center">

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

</body>
</html>
