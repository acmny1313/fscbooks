
<?php

   include('session.php');



if(session_destroy()){
	header("location: /");
}
?>
</body>
</html>
