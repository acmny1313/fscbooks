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
  $postId = stripslashes($_POST['id']);
  $postId = mysqli_real_escape_string($con,$postId);

  $act = stripslashes($_POST['act']);
  //$act = mysqli_real_escape_string($con,$act);

  if($act == 'postEdit'){
    $query = "SELECT * FROM bookPost where ID = '$postId';";
    $result = mysqli_query($con,$query) or die(mysql_error());

    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];

    $rows = mysqli_num_rows($result);

    if($rows == 1){

    }
    else{
      echo "No Book.";
    }
  }
  else if($act == 'postUpdate'){

    $isbn = stripslashes($_POST['isbn']);
    $isbn = mysqli_real_escape_string($con,$isbn);

    $title = stripslashes($_POST['title']);
    $title = mysqli_real_escape_string($con,$title);

    $author = stripslashes($_POST['author']);
    $author = mysqli_real_escape_string($con,$author);

    $edition = stripslashes($_POST['edition']);
    $edition = mysqli_real_escape_string($con,$edition);

    $department = stripslashes($_POST['department']);
    $department = mysqli_real_escape_string($con,$department);

    $courseNumber = stripslashes($_POST['courseNumber']);
    $courseNumber = mysqli_real_escape_string($con,$courseNumber);

    $condition = stripslashes($_POST['condition']);
    $condition = mysqli_real_escape_string($con,$condition);

    $description = stripslashes($_POST['description']);
    $description = mysqli_real_escape_string($con,$description);

    $price = stripslashes($_POST['price']);
    $price = mysqli_real_escape_string($con,$price);


    $editQuery = "UPDATE bookPost SET ISBN = '$isbn', title = '$title', author = '$author', edition = '$edition', department = '$department', courseNumber = '$courseNumber', newUsed = '$condition', description = '$description', price = '$price' where ID = '$postId';";

    if(mysqli_query($con,$editQuery)){
       header('Location: /Profile');
    }
    else{
      echo "error" . $sql . "<br>" . mysqli_error($con);
    }
  }
  //Marks as sold or for sale
  else if($act == 'Sold'){
    $statusOfBook = stripslashes($_POST['statusOfBook']);
    $statusOfBook = mysqli_real_escape_string($con,$statusOfBook);

    if($statusOfBook == 0){
      $n = 1;
    }
    else if($statusOfBook == 1){
      $n = 0;
    }

    $editSoldQuery = "UPDATE bookPost SET statusOfBook = '$n' where ID = '$postId';";

    if(mysqli_query($con,$editSoldQuery)){
       header('Location: /Profile');
    }
    else{
      echo "error" . $sql . "<br>" . mysqli_error($con);
    }
  }
?>

<section class = 'signup'>
  <h3>Edit book information.</h3>
  <div  overflow: scroll>
  <form action='EditPost' method='POST'>
    <input type='hidden' name='act' value ='postUpdate'/>
    <input type='hidden' name='id' value ="<?php echo $postId ?>"/>
    ISBN:<br>
    <input type='text' name='isbn' value ="<?php echo $row['ISBN']; ?>" required><br>
    Title: <br>
    <input type='text' name='title' value = "<?php echo $row['title'];?>" required><br>
    Author:<br>
    <input type='text' name='author' value ="<?php echo $row['author'];?>" required><br>
    Edition: <br>

    <?php
    //Sets where the editon drop down selection starts
    $edition = (int)$row['edition'];

    if($edition == 1){
      $choice1 = 'selected';
    }
    else if($edition == 2){
      $choice2 = 'selected';
    }
    else if($edition == 3){
      $choice3 = 'selected';
    }
    else if($edition == 4){
      $choice4 = 'selected';
    }
    else if($edition == 5){
      $choice5 = 'selected';
    }
    else if($edition == 6){
      $choice6 = 'selected';
    }
    else if($edition == 7){
      $choice7 = 'selected';
    }
    else if($edition == 8){
      $choice8 = 'selected';
    }
    else if($edition == 9){
      $choice9 = 'selected';
    }
    else if($edition == 10){
      $choice10 = 'selected';
    }
    else if($edition == 11){
      $choice11 = 'selected';
    }
    else if($edition == 12){
      $choice12 = 'selected';
    }
    else if($edition == 13){
      $choice13 = 'selected';
    }
    else if($edition == 14){
      $choice14 = 'selected';
    }
    else if($edition == 15){
      $choice15 = 'selected';
    }
    ?>
    <select name='edition' style='width: 100px;'>
        <option value = 'null' disabled required>Edition</option>
        <option value='1' <?php echo $choice1;?>>1st</option>
        <option value='2' <?php echo $choice2;?>>2nd</option>
        <option value='3' <?php echo $choice3;?>>3rd</option>
        <option value='4' <?php echo $choice4;?>>4th</option>
        <option value='5' <?php echo $choice5;?>>5th</option>
        <option value='6' <?php echo $choice6;?>>6th</option>
        <option value='7' <?php echo $choice7;?>>7th</option>
        <option value='8' <?php echo $choice8;?>>8th</option>
        <option value='9' <?php echo $choice9;?>>9th</option>
        <option value='10' <?php echo $choice10;?>>10th</option>
        <option value='11' <?php echo $choice11;?>>11th</option>
        <option value='12' <?php echo $choice12;?>>12th</option>
        <option value='13' <?php echo $choice13;?>>13th</option>
        <option value='14' <?php echo $choice14;?>>14th</option>
        <option value='15' <?php echo $choice15;?>>15th</option>
        </select>
        <br><br>Department: <br>
        <select name='department' style='width: 100px;'>
            <option value='BCS' disabled required>Department</option>
            <option value='BCS'>BCS</option>
            </select>

        <br><br>Course Number: <br>
        <select name='courseNumber' style='width: 100px;'>
            <option value='null' disabled required >Course Number</option>
            <option value='101'>101</option>
            <option value='102'>102</option>
            <option value='110'>110</option>
            <option value='111'>111</option>
            <option value='112'>112</option>
            <option value='113'>113</option>
            <option value='114'>114</option>
            <option value='120'>120</option>
            <option value='130'>130</option>
            <option value='160'>160</option>
            <option value='208'>208</option>
            <option value='209'>209</option>
            <option value='215'>215</option>
            <option value='230'>230</option>
            <option value='232'>232</option>
            <option value='235'>235</option>
            <option value='240'>240</option>
            <option value='255'>255</option>
            <option value='260'>260</option>
            <option value='262'>262</option>
            <option value='300'>300</option>
            <option value='301'>301</option>
            <option value='303'>303</option>
            <option value='311'>311</option>
            <option value='316'>316</option>
            <option value='317'>317</option>
            <option value='318'>318</option>
            <option value='320'>320</option>
            <option value='321'>321</option>
            <option value='340'>340</option>
            <option value='345'>345</option>
            <option value='350'>350</option>
            <option value='360'>360</option>
            <option value='370'>370</option>
            <option value='378'>378</option>
            <option value='421'>421</option>
            <option value='430W'>430W</option>
            <option value='440'>440</option>
            <option value='450'>450</option>
            </select>
            <br>
            <br>

            <?php

            if( $row['newUsed'] == 0 ){

              $conditionNew = "selected";
            }
            else{
              $conditionUsed = "selected";
            }
            ?>
        Condition: <br>
        <select name='condition' style='width:100px;'>
            <option  disabled required>Condition</option>
            <option value= 0 <?php echo $conditionNew; ?>>New</option>
            <option value= 1 <?php echo $conditionUsed; ?>>Used</option>
            </select>
        <br><br>
        Description: <br>
        <input type='text' value ="<?php echo $row['description']; ?>" name='description'><br>
        Price: <br>
        $<input type='text' value ="<?php echo $row['price']; ?>" name='price' style='width: 75px;' required><br>

  <input type='Submit'  value='Save'>
  <input type='reset'  value='Reset'>
</form>
</div>
</section>

<!-- Footer -->
<footer  class='w3-container w3-padding-32 w3-teal w3-center '>

 <p>Powered by Senior Projects Group #1</p>
</footer>

</body>
</html>
