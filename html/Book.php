<?php
  include('session.php');
	include('dp.php');
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
<?php

//*************Insert comment code*******************
if($reload==1){
	$id=$bookid;
	$_SESSION['reload']=0;
}else{

	$id = stripslashes($_POST['id']);
	$id = mysqli_real_escape_string($con,$id);
	$_SESSION['bookid']=$id;
}

	$query = "SELECT * from bookPost where ID='$id'  ";

	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);

	$row = mysqli_fetch_assoc($result);


?>
<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-teal w3-card-2 w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="Home" class="w3-bar-item w3-button w3-padding-large ">Home</a>
    <a href="Browse" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-white w3-hover-gray">Browse</a>

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

 <header class="w3-container w3-teal w3-center" style="padding:25px 16px">
	<h1>FSCBOOK Exchange</h1>
	<h3><?php echo  $row['title'] ;?></h3>
	<h3> Posted by: <?php echo  $row['userName'] ;?></h3>
</header>
<section class="signup">
<?php

	 if($rows>0){

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
			/*echo "<Title: " .  $row["title"] . "<br>";
			echo "Edition: " . $row['edition'].$numberEnd." edition<br>";
			echo "Author: " . $row['author']."<br>";
			echo "ISBN: ".$row['ISBN']."<br>";
      echo "<form  action='UserProfile' method='POST'>
            Posted by: ".$row['userName']."
            <input type='hidden' name='act' value =''/>
            <input type='hidden' name='userName' value ='".$row['userName']."'/>
            <input type='Submit'  value='Profile'>
            </form>";
			echo "Class: " . $row['department'] ." ". $row['courseNumber']."<br>";
			echo "Price: $ ".$row['price']."<br>";
			echo '<a href="Browse" style="float: right;">Back to Browse</a><br>';*/
?>

  Title: <?php echo $row["title"];?><br>
  Edition: <?php echo $row["edition"].$numberEnd.' edition';?><br>
  Author: <?php echo $row["author"];?><br>
  ISBN: <?php echo $row["ISBN"];?><br>
  <form  action='UserProfile' method='POST'>
        Posted by: <?php echo $row['userName'];?>
        <input type='hidden' name='act' value =''/>
        <input type='hidden' name='userName' value ='<?php echo $row['userName'];?>'/>
        <input type='Submit'  value='Profile'>
  </form>
  Class: <?php echo $row["department"].' '.$row['courseNumber'];?><br>
  Price: $<?php echo $row['price'];?><br>
  <a href="Browse" style="float: right;">Back to Browse</a><br>

<?php


	 }else{
		 echo '<h3><a href="Browse">You made a wrong turn go back</a></h3>';
	 }

		?>
</section>

<section class="comments">

  <h3>Comments</h3>
  <?php
		$query = "SELECT * from postComments where bookPostID='$id' order by timeOfComment desc;";

		$result = mysqli_query($con,$query) or die(mysql_error());
		$rowCS = mysqli_num_rows($result);
	?>
  <h4><?php echo $rowCS;?> Comments</h4>


 <div class ="w3-border w3-padding">
	<form action="/Comment" method=POST>
	<input type="hidden" name="postID" value="<?php echo $row['ID'];?>">
	<input type="hidden" name="act" value="newComment">
	<textarea rows="4" cols="50" name="comment" placeholder="Add a comment"></textarea>
	<input type="submit"  value="Post" >
	</form>
</div>

	<div class="w3-border">
	<?php
		if($rowCS>0){
			while($rowC = mysqli_fetch_assoc($result)){
				echo '<div class="w3-container w3-border ">';
					echo '<div class="w3-cell w3-border-right" >';
					echo '<h5><strong>' . $rowC['commenterID'] . '</strong></h5> <br>';
					echo '<p class = "w3-small">' . $rowC['timeOfComment'] . '</p>';
				echo '</div>';
				echo '<div class="w3-cell" >';
					echo '<p>' . $rowC['commentText'] . '</p> <br>';

					if($login_session == $rowC['commenterID']){
						echo '<button onclick="modal(' . $rowC['commentID'] . ')"  id="myBtn' . $rowC['commentID'] . '">edit</button>';

					echo '<form action="Comment" method=POST>';
						echo '<input type="hidden" name="act" value="delete">';
						echo '<input type="hidden" name="uID" value="' . $rowC['commenterID'] .'">';
						echo '<input type="hidden" name="commentID" value="' . $rowC['commentID'] .'">';
						echo '<input type="hidden" name="postCID" value="' . $rowC['bookPostID'] .'">';
						echo '<input type="submit" value="Delete">';
					echo '</form>';

					echo '<form  action="Comment" method=POST>';
						echo '<input type="hidden" name="act" value="edit">';
						echo '<input type="hidden" name="uID" value="' .$rowC['commenterID'] .'">';
						echo '<input type="hidden" name="commentID" value="' .$rowC['commentID'] .'">';
						echo '<input type="hidden" name="postCID" value="' .$rowC['bookPostID'] .'">';
						echo '<div id="id01' . $rowC['commentID'] . '" class="w3-modal">';
								echo '<div class="w3-modal-content w3-card">';
									echo '<div class="w3-container">';
										echo '<span id="span' . $rowC['commentID'] . '" class="w3-button w3-display-topright">&times;</span>';
											echo '<p>Edit Comment.</p>';
											echo '<textarea rows="4" cols="50" name="commentEdit" >' . $rowC['commentText'] . '</textarea>';
											echo '<input type="submit" value="submit">';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</form>';
					}
					echo '</div>';
				echo '</div>';


			}
		}

		?>
	</div>
</section>

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
	<script>
					function modal(ids){
		// Get the modal




					var modal = document.getElementById("id01"+ids);

					// Get the button that opens the modal
					var btn = document.getElementById("myBtn"+ids);

					// Get the <span> element that closes the modal
					var span = document.getElementById("span"+ids);



					// When the user clicks the button, open the modal
					btn.onclick = function() {
						modal.style.display = "block";
					}

					// When the user clicks on <span> (x), close the modal
					span.onclick = function() {
						modal.style.display = "none";
					}

					// When the user clicks anywhere outside of the modal, close it
					window.onclick = function(event) {
						if (event.target == modal) {
							modal.style.display = "none";
						}
					}
}


			</script>

</body>
</html>
