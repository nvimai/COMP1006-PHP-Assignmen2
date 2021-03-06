
<!-- Loading header -->
<?php $title = 'Edit'; 
include('global/header.php'); ?>
<!-- Loading body -->
<?php
	//authentication check
	include('global/auth.php');
?>
<main class="container">
	<div id="logreg-forms">
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
			<h1 class="h3 mb-3 text-center"><?php echo $title; ?></h1>

			<!-- Loading validation -->
			<?php include('edit-product-validation.php'); ?>

			<input type="text" id="id" name="id" hidden value="<?php echo $id;?>">
				
			<label for="productName">Product Name</label>
			<input type="text" class="form-control" name="productName" placeholder="Product Name" required autofocus="" value="<?php echo (isset($productName))?$productName:'';?>">

			<label for="categoryID">Category</label>
			<select class="form-control"  name="categoryID" id="categoryID" >
			<?php
				try {
					// Connect to the database
					include('global/connect.php');
					//Set up the SQL 
					$countrySQL = "SELECT * FROM categories ORDER BY categoryName";
					//Execute the SQL command in the db; store the whole dataset in a $result variable
					$cmd = $conn->prepare($countrySQL);
					$cmd->execute();
					$options = $cmd->fetchAll();

					foreach ($options as $row) {
						if($categoryID != $row['categoryID']){
							echo '<option value="' . $row['categoryID'] . '">' . $row['categoryName'] . '</option>';
						} else {
							echo '<option value="' . $row['categoryID'] . '" selected>' . $row['categoryName'] . '</option>';
						}
					}
				} catch (Exception $e ){
					//redirect to the error page
					header('location: error.php');
				}
			?>
			</select>
			
			<label for="price">Price</label>
			<input type="text" class="form-control" name="price" required autofocus="" value="<?php echo (isset($price))?$price:'';?>">
			
			<label for="description">Description</label>
			<input type="text" class="form-control" name="description" placeholder="Description" autofocus="" value="<?php echo (isset($description))?$description:'';?>">
			
			<label for="image">Image URL</label>
			<input type="text" class="form-control" name="image" placeholder="Image URL" autofocus="" value="<?php echo (isset($image))?$image:'';?>">
			
			<label for="photo">Select image to upload</label>
			<input type="file" name="photo">

			<?php
			if (isset($image)) {
					echo '<div><img src="' . $image . '" alt="Product Photo" width="150" /></div>';
			}
			?>
				
			<button class="btn btn-primary btn-block" type="submit">Submit</button>
		</form>
	</div>
</main>
<?php include('global/disconnect.php'); ?>
<!-- Loading footer -->
<?php include('global/footer.php'); ?>