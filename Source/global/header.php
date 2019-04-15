<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/styles.css"/>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
		<header class="mb-3">
			<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
				<a class="navbar-brand" href="index.php">
					<img src="images/logo-nuniversal.svg" alt="Logo" heigth="40" width="40">
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarText">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="index.php">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="products.php">Products</a>
						</li>
					</ul>
					<ul class="navbar-nav ml-auto">
					<?php 
						try {
							session_start();
							// Show Log In / Register links if user has not logged in yet
							if (!isset($_SESSION['userID'])) {
								echo '<li class="nav-item"><a class="nav-link" href="login.php" title="Login">Login</a></li>
											<li class="nav-item"><a class="nav-link" href="register.php" title="Register">Register</a></li>';
							}
							else {
								//If yes say Hi to firstName of user
								// Connect to the database
								require 'global/connect.php';
								
								// Write the sql insert
								$sql = "SELECT firstName FROM users WHERE userID = " . $_SESSION['userID'];
								$result = $conn->query($sql);
								foreach ($result as $row) {
									echo '<li class="nav-item"><a class="nav-link" href="users.php">Hi ' . $row['firstName'] . '!</a></li>
												<li class="nav-item"><a class="nav-link" href="logout.php" title="Logout">Logout</a></li>';
								}
								// Disconnect to the database
								require 'global/disconnect.php';
							}
						}catch (Exception $e) {
							//redirect to the error page
							header('location: global/error.php');
						}
					?>
					</ul>
				</div>
			</nav>
		</header>