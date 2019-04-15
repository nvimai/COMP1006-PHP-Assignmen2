
<!-- Loading header -->
<?php $title = 'Users'; include('global/header.php'); ?>

<!-- Loading body -->
<main class="container">
	<h1><?php echo $title; ?></h1>
	<?php
	session_start();
		if (isset($_SESSION['userID'])) {
			echo '<a class="btn btn-primary" href="register.php">Add User</a>';
		}
	?>
<?php 
	// Authentication checking
	include('global/auth.php');

	try{
		// Connect to the database
		include('global/connect.php');
		//Set up the SQL 
		$sql = 'SELECT userID, firstName, lastName, middleName, email, streetAddress, city, states.stateName, countries.countryName FROM users
		INNER JOIN countries ON countries.countryID = users.countryID
		INNER JOIN states ON states.stateID = users.stateID';
		//Execute the SQL command in the db; store the whole dataset in a $result variable
		$cmd = $conn->prepare($sql);
		$cmd->execute();
		$result = $cmd->fetchAll();
		echo '<table class="table table-striped table-hover mt-3">';
		echo '<thead class="thead-dark"><tr><th>Full Name</th><th>Email</th><th>Address</th><th>Delete</th><th>Edit</th></tr></thead><tbody>';
			//Loop throught the collection of data
		foreach ($result as $row) {
			echo 
			'<tr>
				<td>' . $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'] . '</td>
				<td><a href="mailto:' . $row['email'] . '">' . $row['email'] . '</a></td>
				<td>' . $row['streetAddress'] . ', ' . $row['city'] . ', ' . $row['stateName'] . ', ' . $row['countryName'] . ' ' . $row['postalCode'] . '</td>
				<td><a href="delete-user.php?id=' . $row['userID'] . '" onclick="return confirm(\'Are you sure you want to delete ' . $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'] . '?\');">Delete</a></td>
				<td><a href="edit-user.php?id=' . $row['userID'] . '">Edit</a></td>
			</tr>';
		}
		echo '</tbody></table>';
	} catch (Exception $e) {
		//redirect to the error page
		header('location: error.php');
	}
	//Disconnect
	include('global/disconnect.php'); 
	echo '<a href="logout.php">Log Out</a>';
?>
</main>
<!-- Loading footer -->
<?php include('global/footer.php'); ?>