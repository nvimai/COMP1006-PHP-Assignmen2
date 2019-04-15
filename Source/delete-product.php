<!-- Loading header -->
<?php $title = 'Delete Product'; include('global/header.php'); ?>

<!-- Loading body -->
<?php

try{
//authentication check
	include('global/auth.php');

	//retrieve the selected id from the url querystring and save it to a variable
	$id = $_GET['id'];
	
	// Connect with database
	include('global/connect.php');

	//write and run the sql command
	$sql = "DELETE FROM products WHERE productID = :id";
	
	$cmd = $conn->prepare($sql);
	$cmd->bindParam(':id', $id, PDO::PARAM_INT);
	$cmd->execute();
	
	} catch (Exception $e ){
		//redirect to the error page
		header('location: error.php');
	}
	//disconnect
	include('global/disconnect.php'); 
	
	//redirect back to updated persons_table page
	header('location:products.php');
?>
<!-- Loading footer -->
<?php include('global/footer.php'); ?>
