
<?php

   include('session.php');

	
session_destroy();
session_write_close();

	header("location: /");

?>
</body>
</html>
