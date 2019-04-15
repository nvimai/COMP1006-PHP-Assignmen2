<!-- Login validation -->
<?php
// authentication check
include('global/auth.php');

try {
	if (!empty($id = $_GET['id']) && $_SERVER["REQUEST_METHOD"] != "POST") {
			
			include('global/connect.php');
			//write and run the sql select and store the results
			$sql = "SELECT * FROM products WHERE productID = $id";
			$result = $conn -> query($sql);

			//store the name and email into variables
			foreach ($result as $row) {
				$productName		= $row['productName'];
				$categoryID		= $row['categoryID'];
				$description		= $row['description'];
				$price			= $row['price'];
				$image	= $row['image'];
			}
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		// Store the product inputs in variables
		$id 						= $_POST['id'];
		$productName		= $_POST['productName'];
		$categoryID			= $_POST['categoryID'];
		$description		= $_POST['description'];
		$price					= $_POST['price'];
		
		$valid = inputValidate(); //create variable indicating if form is complete or not
		
		include('upload-photo.php');
		
		// Check if there any errors, if not connect
		if ($valid == true) {
			// Connect to the database
			include('global/connect.php');
				
			//Hash the password before saving it to make the value obscure
			$passwordHas = sha1($userPassword);
			

			// Write the sql insert
			if(!empty($id)) {
				$sql = "UPDATE products SET productName = '$productName', categoryID = $categoryID, description = '$description', price = $price, image = '$photo' WHERE productID = $id";

				// Execute the save
				if ($conn->query($sql) == TRUE) {
					echo "The record updated successfully<br />";
					// Display a confirmation message
					echo "You will be redirecting to Products Page<br />";
					header("location: products.php");
				} 
				else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
			else {
				echo "Error: <br>";
			}
		}
	}
} catch (Exception $e ){
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