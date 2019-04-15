<!-- Login validation -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Store the user inputs in variables
	$firstName		= $_POST['firstName'];
	$lastName		= $_POST['lastName'];
	$middleName		= $_POST['middleName'];
	$email			= $_POST['email'];
	$userPassword	= $_POST['password'];
	$streetAddress	= $_POST['streetAddress'];
	$city			= $_POST['city'];
	$stateID		= $_POST['stateID'];
	$countryID		= $_POST['countryID'];
	$postalCode		= $_POST['postalCode'];
	$complete = true;

	$valid = true; //create variable indicating if form is complete or not

	// Check each user input & show any error messages
	if (empty($firstName)) {
		echo 'First Name is required<br />';
		$valid = false;
	}
	else if(strlen($firstName) > 25) {
		echo 'First Name is less than 25 character<br />';
		$valid = false;
	}
	if (empty($lastName)) {
		echo 'Last Name is required<br />';
		$valid = false;
	}
	else if(strlen($lastName) > 25) {
		echo 'Last Name is less than 25 character<br />';
		$valid = false;
	}
	if (empty($email)) {
		echo 'Email is required<br />';
		$valid = false;
	}
	else if(strlen($email) > 100) {
		echo 'Email is less than 100 character<br />';
		$valid = false;
	}
	if (empty($userPassword)) {
		echo 'Password is required<br />';
		$valid = false;
	}
	else if(strlen($userPassword) < 4) {
		echo 'Password is greater than 4 character<br />';
		$valid = false;
	}
	//Check for password value
	if ($_POST['password'] != $_POST['repeatPassword']) {
		echo 'Passwords do not match<br />';
		$valid = false;
	}
	//Check for streetAddress value
	if (empty($_POST['streetAddress'])) {
		echo 'Street Address is required<br />';
		$valid = false;
	}
	else if(strlen($streetAddress) > 100) {
		echo 'Street Address is less than 100 character<br />';
		$valid = false;
	}
	//Check for city value
	if (empty($_POST['city'])) {
		echo 'City is required<br />';
		$valid = false;
	}
	else if(strlen($city) > 25) {
		echo 'City is less than 25 character<br />';
		$valid = false;
	}
	try{
		// Check if there any errors, if not connect
		if ($valid == true) {
			// Connect to the database
			include('global/connect.php');

			// Checking exist email
			$sql = "SELECT * FROM users WHERE email = '$email'";
			$cmd = $conn->prepare($sql);
			$cmd->execute();
			$result = $cmd->fetchAll();

			if(count($result) > 0) {
				echo "The email is existed. Please use another email.<br />";
			}
			else {
				
				//Hash the password before saving it to make the value obscure
				$passwordHas = hash('sha512', $_POST['password']);
			
				// Write the sql insert
				$sql = "INSERT INTO users (firstName, lastName, middleName, email, password, streetAddress, city, stateID, countryID, postalCode) VALUES (:firstName, :lastName, :middleName, :email, :password, :streetAddress, :city, :stateID, :countryID, :postalCode)";

				$cmd = $conn->prepare($sql);
				$cmd->bindParam(':firstName', $firstName, PDO::PARAM_STR, 24);
				$cmd->bindParam(':lastName', $lastName, PDO::PARAM_STR, 24);
				$cmd->bindParam(':middleName', $middleName, PDO::PARAM_STR, 24);
				$cmd->bindParam(':email', $email, PDO::PARAM_STR, 100);
				$cmd->bindParam(':password', $passwordHas, PDO::PARAM_STR, 255);
				$cmd->bindParam(':streetAddress', $streetAddress, PDO::PARAM_STR, 100);
				$cmd->bindParam(':city', $city, PDO::PARAM_STR, 24);
				$cmd->bindParam(':stateID', $stateID, PDO::PARAM_STR, 2);
				$cmd->bindParam(':countryID', $countryID, PDO::PARAM_STR, 2);
				$cmd->bindParam(':postalCode', $postalCode, PDO::PARAM_STR, 6);
				$cmd->execute();

				echo "New record created successfully<br />";
				// Display a confirmation message
				echo "Your subscription was saved<br />";
				echo "You will be redirecting to Login Page<br />";
				header("location: login.php");
			}
		}
	} catch (Exception $e) {
		//redirect to the error page
		header('location: error.php');
	}
}
?>