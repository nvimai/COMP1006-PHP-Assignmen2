<html>
<body>

<?php

// If the user is logged in, delete the session vars to log them out
if(!isset($_SESSION['userID'])){
	session_start();
	unset($_SESSION['userID']);
	session_destroy();
}
// Redirect to the login page
Header('Location: login.php');
?>

</body>
</html>