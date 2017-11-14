<?php
   include('db.php');
  // header('Cache-Control: private, must-revalidate'); //no cache
  session_cache_limiter('private_no_expire, must-revalidate'); // works
   
   session_start();


   $user_check = $_SESSION['login_user'];
   $page_check = $_SESSION['page'];


   $ses_sql = mysqli_query($con,"select username from account where username = '$user_check' ");

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session = $row['username'];
   $bookid=$_SESSION['bookid'];
   $reload=$_SESSION['reload'];

   if(!isset($_SESSION['login_user']) ){

	   header("Location: Login.html");
   }


?>
