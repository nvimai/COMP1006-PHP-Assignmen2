<?php
	// Authentication checking
	include('global/auth.php');
	try{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Store the product inputs in variables
			$productName	= $_POST['productName'];
			$categoryID		= $_POST['categoryID'];
			$description	= $_POST['description'];
			$price				= $_POST['price'];
			$image				= $_POST['image'];

			$complete = true;

			//create variable indicating if form is complete or not
			$valid = inputValidate();

			
			include('upload-photo.php');
			
			// Check if there any errors, if not connect
			if ($valid == true) {
				// Connect to the database
				include('global/connect.php');
					
				// Write the sql insert
				$sql = "INSERT INTO products (productName, categoryID, description, price, image) VALUES ('$productName', $categoryID, '$description', $price, '$photo')";

				// Execute the save
				if ($conn->query($sql) == TRUE) {
					echo "New record created successfully<br />";
					// Display a confirmation message
					echo "Your subscription was saved<br />";
					echo "You will be redirecting to Products Page<br />";
					header("location: products.php");
				} 
				else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
		}
	}	catch (Exception $e) {

		//redirect to the error page
		header('location: error.php');
	}
	function inputValidate() {
		$valid = true;
		// Check each product input & show any error messages
		if (empty($_POST['productName'])) {
			echo 'Product Name is required<br />';
			$valid = false;
		}
		//Check for price value
		if (empty($_POST['price'])) {
			echo 'Price is required<br />';
			$valid = false;
		}
		return $valid;
	}
?>