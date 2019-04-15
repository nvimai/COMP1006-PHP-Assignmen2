<!-- Loading header -->
<?php $title = 'Edit User'; 
include('global/header.php'); ?>

<!-- Loading body -->
<main class="container">
	<div id="logreg-forms">
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h1 class="h3 mb-3 text-center"><?php echo $title; ?></h1>


			<!-- Loading validation -->
			<?php include('update-validation.php'); ?>
			<input type="text" id="id" name="id" hidden value="<?php echo $id;?>">

			<label for="firstName">First Name</label>
			<input type="text" class="form-control" name="firstName" placeholder="First Name" maxlength="25" required autofocus="" value="<?php echo (isset($firstName))?$firstName:'';?>">
			
			<label for="middleName">Middle Name</label>
			<input type="text" class="form-control" name="middleName" placeholder="Middle Name" maxlength="25" autofocus="" value="<?php echo (isset($middleName))?$middleName:'';?>">

			<label for="firstName">Last Name</label>
			<input type="text" class="form-control" name="lastName" placeholder="Last Name" maxlength="25" required autofocus="" value="<?php echo (isset($lastName))?$lastName:'';?>">

			<label for="email">Email Address</label>
			<input type="email" name="email" class="form-control" placeholder="Email address" required autofocus="" value="<?php echo (isset($email))?$email:'';?>">

			<label for="password">Password</label>
			<input type="password" name="password" class="form-control" placeholder="Password" required autofocus="">
			<input type="password" name="repeatPassword" class="form-control" placeholder="Repeat Password" required autofocus="">

			<hr />

			<label for="streetAddress">Street Address</label>
			<input type="text" class="form-control" name="streetAddress" placeholder="Street Address" maxlength="100" required autofocus="" value="<?php echo (isset($streetAddress))?$streetAddress:'';?>">

			<label for="city">City</label>
			<input type="text" class="form-control"  name="city" placeholder="City" required autofocus="" maxlength="24" value="<?php echo (isset($city))?$city:'';?>">

			<label for="countryID">Country</label>
			<select class="form-control" name="countryID" id="countryID" >
			<?php
				try {
					// Connect to the database
					include('global/connect.php');
					//Set up the SQL 
					$countrySQL = "SELECT * FROM countries ORDER BY countryName";

					$cmd = $conn->prepare($countrySQL);
					$cmd->execute();

					//Execute the SQL command in the db; store the whole dataset in a $result variable
					$options = $cmd->fetchAll();

					foreach ($options as $row) {
						if($row['countryID'] != $countryID) {
							echo '<option value="' . $row['countryID'] . '">' . $row['countryName'] . '</option>';
						} else {
							echo '<option selected value="' . $row['countryID'] . '">' . $row['countryName'] . '</option>';
						}
					}
			?>
			</select>
			<label for="stateID">State/Province</label>
			<select class="form-control" name="stateID" >
			<?php
					//Set up the SQL 
					$stateSQL = "SELECT * FROM states ORDER BY stateName"; 

					$cmd = $conn->prepare($stateSQL);

					//Execute the SQL command in the db; store the whole dataset in a $result variable
					$cmd->execute();
					$options = $cmd->fetchAll();
					foreach ($options as $row) {
						if($row['stateID'] != $stateID) {
							echo '<option value="' . $row['stateID'] . '">' . $row['stateName'] . '</option>';
						} else {
							echo '<option selected value="' . $row['stateID'] . '">' . $row['stateName'] . '</option>';
						}
					}
				} catch (Exception $e){
					//redirect to the error page
					header('location: error.php');
				}
			?>
			</select>
			<label for="postalCode">Postal Code/Zip Code</label>
			<input class="form-control" type="text" name="postalCode" placeholder="Postal Code" required autofocus="" value="<?php echo (isset($postalCode))?$postalCode:'';?>">
			<button class="btn btn-success btn-block" type="submit">Update</button>
			<hr />
			<a class="btn btn-primary text-white" href="users.php">Cancel</a>
		</form>
	</div>
</main>
<?php include('global/disconnect.php'); ?>
<!-- Loading footer -->
<?php include('global/footer.php'); ?>