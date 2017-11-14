
<?php
  include('db.php');
  include('session.php');

$act = stripslashes($_POST['act']);
$act = mysqli_real_escape_string($con,$act);


//*************NEWW REVIEWW STUFF*****************************
	if($act == 'writeReview'){
    $reviewie = stripslashes($_POST['reviewie']);
    $reviewie = mysqli_real_escape_string($con,$reviewie);
    $review = stripslashes($_POST['reviewText']);
    $review = mysqli_real_escape_string($con,$review);
    $reviewer = stripslashes($login_session);
    //$reviewer = mysqli_real_escape_string($con,$login_session);
    $reviewer = mysqli_real_escape_string($con,$reviewer);
    $stars = stripslashes($_POST['rating']);
    $stars = mysqli_real_escape_string($con,$stars);

    $reviewSQL = "INSERT INTO review(reviewie, reviewer, review, stars)
		VALUES('$reviewie', '$reviewer', '$review','$stars');";

		if(mysqli_query($con,$reviewSQL)){
			//header('Location: /UserProfile');
      ?>
      <form  action='UserProfile' method='POST' id = 'review'>
            <input type='hidden' name='act' value =''/>
            <input type='hidden' name='userName' value ='<?php echo $reviewie;?>'/>
      </form>
      <script type="text/javascript">
        document.getElementById('review').submit(); // SUBMIT FORM
      </script>
      <?php
		}else{
			echo "error" . $sql . "<br>" . mysqli_error($con);
		}

	}
?>
