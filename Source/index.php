
<!-- Loading header -->
<?php $title = 'Home'; include('global/header.php'); ?>

<!-- Loading body -->
<main class="container">
  <!-- Loading body -->
  <h1>Welcome to my PHP e-commerce website</h1>
  <p>This is the e-commerce website made from PHP for the Assignment 2 of COMP1006 course.</p>
  <div class="card-deck">
    <div class="card text-white bg-info mb-3">
      <h2 class="card-header">Products</h2>
      <div class="card-body">
        <a class="btn btn-success" href="products.php">Read More</a>
      </div>
    </div>
    <div class="card text-white bg-warning mb-3">
      <h2 class="card-header">Login</h2>
      <div class="card-body">
        <a class="btn btn-success" href="login.php">Read More</a>
      </div>
    </div>
    <div class="card text-white bg-danger mb-3">
      <h2 class="card-header">Register</h2>
      <div class="card-body">
        <a class="btn btn-success" href="register.php">Read More</a>
      </div>
    </div>
  </div>
</main>
<!-- Loading footer -->
<?php include('global/footer.php'); ?>