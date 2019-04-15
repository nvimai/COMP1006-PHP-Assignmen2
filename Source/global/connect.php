<?php
// 	// Create database variables
	$servername = "localhost";
	$username   = "root"; // For localhost it will be root
	$password   = "mysql"; // If using Ammps "mysql" if other leave empty
	$dbname     = "200385752Comp1006Assignment2"; // replace with your database name

	// Create connection
	// $conn = new mysqli($servername, $username, $password, $dbname) ;
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
	
	//enable SQL debugging
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>