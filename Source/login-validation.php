<!-- Login validation -->
<?php
try {
	if (!isset($_SESSION['userID']) && $_SERVER["REQUEST_METHOD"] == "POST") {
		$userPassword = hash('sha512', $_POST["password"]);
		$email = $_POST["email"];
		$complete = true;

		// Check each user input & show any error messages
		if (empty($email)) {
			echo 'Email is required<br />';
			$complete = false;
		} 
		if (empty($userPassword)) {
			echo 'Password is required<br />';
			$complete = false;
		}

		if ($complete == true) {
			// Connect to the database
			include('global/connect.php');
			
			// Write the sql insert
			$sql = "SELECT userID FROM users WHERE email = :email AND password = :password";

			$cmd = $conn->prepare($sql);
			$cmd->bindParam(':email', $email, PDO::PARAM_STR, 100);
			$cmd->bindParam(':password', $userPassword, PDO::PARAM_STR, 255);
			$cmd->execute();
			$result = $cmd->fetchAll();
			echo count($result);
			// Check if any matches found
			if(count($result) >= 1) {
				echo '<p>Login successfully</p>';
				foreach ($result as $row) {
					//access the existing session created automatically by the server
					session_start();
					
					//take the user's id from the database and store it in a session variable
					$_SESSION['userID'] = $row['userID'];
					//redirect the user
					Header('Location: products.php');

				}
			} else {
				echo 'Invalid login';
			}
			// Disconnect from the db
			include('global/disconnect.php');
		}
	}
	else {
		// If logged in
		if(isset($_SESSION['userID'])) {
			// go to users page
			header("Location: products.php");
		}
	}
} catch (Exception $e) {
	//redirect to the error page
	header('location: error.php');
}
?>