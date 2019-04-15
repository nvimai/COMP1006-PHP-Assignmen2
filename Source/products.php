
<!-- Loading header -->
<?php $title = 'Products'; include('global/header.php'); ?>

<!-- Loading body -->
<main class="container">
<h1><?php echo $title; ?></h1>
<?php
session_start();
	if (isset($_SESSION['userID'])) {
		echo '<a class="btn btn-primary mb-3" href="add-product.php">Add Product</a>';
	}
?>
<?php 
	try{
		// Connect to the database
		include('global/connect.php');
		//Set up the SQL 
		$sql = 'SELECT p.productID, p.productName, c.categoryName, p.price, p.description, p.image
		FROM products AS p
		INNER JOIN categories AS c ON c.categoryID = p.categoryID';

		//Execute the SQL command in the db; store the whole dataset in a $result variable
		$cmd = $conn->prepare($sql);
		$cmd->execute();
		$result = $cmd->fetchAll();
		
		$i = 0;
		while($i < count($result)) {
			echo '<div class="card-deck">';  //Insert the card-deck in every 3 cards
			$ii = $i;
			//Loop throught the collection of data
			for (;$i < $ii + 4; $i++){
				$row = $result[$i];
				echo '<div class="card">
					<img src="' . $row['image'] . '" class="card-img-top" alt="' . $row['productName'] . '">
					<div class="card-body">
							<h5 class="card-title">' . $row['productName'] . '</h5>
							<p class="card-text">' . $row['price'] . '</p>
							<p class="card-text">' . $row['description'] . '</p>
							<p class="card-text"><small class="text-muted">' . $row['categoryName'] . '</small></p>
						</div>';
				if (isset($_SESSION['userID']) && $row) {
					echo 
					'<div><a class="btn btn-danger" href="delete-product.php?id=' . $row['productID'] . '" onclick="return confirm(\'Are you sure you want to delete ' . $row['productName'] . '?\');">Delete</a>
					<a class="btn btn-primary float-right" href="edit-product.php?id=' . $row['productID'] . '">Edit</a></div>';
				}
				echo '</div>'; // End of "card"
			}
			echo '</div>'; // End of "card-deck"
		}
	} catch (Exception $e){
		//redirect to the error page
		header('location: error.php');		
	}
	//Disconnect
	include('global/disconnect.php'); 
?>
</main>
<!-- Loading footer -->
<?php include('global/footer.php'); ?>