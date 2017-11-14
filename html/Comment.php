<?php
	 include('session.php');
	include('dp.php');
	
	$comment= stripslashes($_POST['comment']);
	$comment = mysqli_real_escape_string($con,$comment);
	
	$id = stripslashes($_POST['postID']);
	$id = mysqli_real_escape_string($con,$id);
	
	$cUP = stripslashes($_POST['commentEdit']);
	$cUP = mysqli_real_escape_string($con,$cUP);
	
	$act = stripslashes($_POST['act']);
	$uid=stripslashes($_POST['uID']);
	$comID=stripslashes($_POST['commentID']);
	$post=stripslashes($_POST['postCID']);
 
  if($act=="delete"){
	  if($uid==$login_session){
		$de = "DELETE FROM postComments WHERE commenterID='$uid' AND commentID='$comID' AND bookPostID='$post' ";

		if( mysqli_query($con,$de)){
			echo "comment deleted";
			$_SESSION['bookid']=$post;
			$_SESSION['reload']=1;
			$act="something";
			header("Location: Book");
		}else{
			echo "$comment not added." . $sql . "<br>" . mysqli_error($con);
			echo "ERROR";
		}
	}
	$_SESSION['bookid']=$post;
		$_SESSION['reload']=1;
		$act="something";
		 header("Location: Book");
 }elseif($act=="edit"){
	 if($uid==$login_session){
	 	 	$up = "UPDATE postComments SET commentText='$cUP' WHERE commenterID='$uid' AND commentID='$comID' AND bookPostID='$post' ";
		

 
		if(mysqli_query($con,$up)){
		$_SESSION['bookid']=$post;
		$_SESSION['reload']=1;
		header("Location: Book");

		}else{
			echo "$comment not added." . $sql . "<br>" . mysqli_error($con);
			$_SESSION['reload']=1;
			$_SESSION['bookid']=$post;
		}	
 
	 }else{
		 $_SESSION['reload']=1;
			$_SESSION['bookid']=$post;
			header("Location: Book");
	 }


 }else{


	
	//echo "the post id is" . $id;
	
	
	$sql = "INSERT into postComments(bookPostID,commenterID,commentText)
	VALUES('$id','$login_session','$comment');";

 
	if(mysqli_query($con,$sql)){
		$_SESSION['bookid']=$id;
		$_SESSION['reload']=1;
    header("Location: Book");

	}else{
    echo "$comment not added." . $sql . "<br>" . mysqli_error($con);
	$_SESSION['reload']=1;
	$_SESSION['bookid']=$id;
	}
 }
?>