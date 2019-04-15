<!-- Login validation -->
<?php
try {
	if (!empty($id = $_GET['id']) && $_SERVER["REQUEST_METHOD"] != "POST") {
		//authentication check
		include('global/auth.php');
			
		include('global/connect.php');
		//write and run the sql select and store the results
		$sql = "SELECT * FROM users WHERE userID = :id";
		$cmd = $conn->prepare($sql);
		$cmd->bindParam(':id', $id, PDO::PARAM_INT);
		$cmd->execute();
		$result = $cmd->fetchAll();

		//store the name and email into variables
		foreach ($result as $row) {
			$firstName		= $row['firstName'];
			$lastName		= $row['lastName'];
			$middleName		= $row['middleName'];
			$email			= $row['email'];
			$userPassword	= $row['password'];
			$streetAddress	= $row['streetAddress'];
			$city			= $row['city'];
			$stateID		= $row['stateID'];
			$countryID		= $row['countryID'];
			$postalCode		= $row['postalCode'];
		}
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		// Store the user inputs in variables
		$id 			= $_POST['id'];
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
		$valid = inputValidate(); //create variable indicating if form is complete or not
		// Check if there any errors, if not connect
		if ($valid == true) {
			// Connect to the database
			include('global/connect.php');
				
			//Hash the password before saving it to make the value obscure
			$passwordHash = hash('sha512', $userPassword);		

			// Write the sql insert
			if(!empty($id)) {
				$sql = "UPDATE users SET firstName = :firstName, lastName = :lastName, middleName = :middleName, email = :email, password = :passwordHash, streetAddress = :streetAddress, city = :city, stateID = :stateID, countryID = :countryID, postalCode = :postalCode WHERE userID = :id";

				$cmd = $conn->prepare($sql);
				$cmd->bindParam(':firstName', $firstName, PDO::PARAM_STR, 24);
				$cmd->bindParam(':lastName', $lastName, PDO::PARAM_STR, 24);
				$cmd->bindParam(':middleName', $middleName, PDO::PARAM_STR, 24);
				$cmd->bindParam(':email', $email, PDO::PARAM_STR, 100);
				$cmd->bindParam(':passwordHash', $passwordHash, PDO::PARAM_STR, 255);
				$cmd->bindParam(':streetAddress', $streetAddress, PDO::PARAM_STR, 100);
				$cmd->bindParam(':city', $city, PDO::PARAM_STR, 24);
				$cmd->bindParam(':stateID', $stateID, PDO::PARAM_STR, 2);
				$cmd->bindParam(':countryID', $countryID, PDO::PARAM_STR, 2);
				$cmd->bindParam(':postalCode', $postalCode, PDO::PARAM_STR, 6);
				$cmd->bindParam(':id', $id, PDO::PARAM_INT);
				$cmd->execute();

				echo "The record updated successfully<br />";
				// Display a confirmation message
				echo "You will be redirecting to Users Page<br />";
				header("location: users.php");
			}
			else {
				//redirect to the error page
				header('location: error.php');
			}
		}
	}
} catch (Exception $e) {
	//redirect to the error page
	header('location: error.php');
}
function inputValidate() {
	$valid = true;
	// Check each user input & show any error messages
	if (empty($_POST['firstName'])) {
		echo 'First Name is required<br />';
		$valid = false;
	}
	else if(strlen($_POST['firstName']) > 25) {
		echo 'First Name is less than 25 character<br />';
		$valid = false;
	}
	if (empty($_POST['lastName'])) {
		echo 'Last Name is required<br />';
		$valid = false;
	}
	else if(strlen($_POST['lastName']) > 25) {
		echo 'Last Name is less than 25 character<br />';
		$valid = false;
	}
	if (empty($_POST['email'])) {
		echo 'Email is required<br />';
		$valid = false;
	}
	else if(strlen($_POST['email']) > 100) {
		echo 'Email is less than 100 character<br />';
		$valid = false;
	}
	if(!empty($_POST['password']) && strlen($_POST['password']) < 4) {
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
	else if(strlen($_POST['streetAddress']) > 100) {
		echo 'Street Address is less than 100 character<br />';
		$valid = false;
	}
	//Check for city value
	if (empty($_POST['city'])) {
		echo 'City is required<br />';
		$valid = false;
	}
	else if(strlen($_POST['city']) > 25) {
		echo 'City is less than 25 character<br />';
		$valid = false;
	}
	return $valid;
}
?>