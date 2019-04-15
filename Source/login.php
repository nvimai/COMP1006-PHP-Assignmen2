
<!-- Loading header -->
<?php
$title = 'Login'; 
include('global/header.php'); 
?>
<!-- Loading body -->
<main class="container">
	<div id="logreg-forms">
		<!-- Loading validation -->
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h1 class="h3 mb-3 text-center"> Login</h1>
			
			<?php include('login-validation.php'); ?>

			<input type="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
			<input type="password" name="password" class="form-control" placeholder="Password" required="">
			
			<button class="btn btn-success btn-block" type="submit">Login</button>
			<hr>
			<!-- <p>Don't have an account!</p>  -->
			<a class="btn btn-primary text-white" href="register.php">Register New Account</a>
		</form>
	</div>
</main>

<?php include('global/disconnect.php');?>
<!-- Loading footer -->
<?php include('global/footer.php'); ?>