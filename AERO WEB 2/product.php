<?php
// Create connection
$con = new mysqli('localhost', 'HNDWEBMR3', 'RSYZ3LyZEy', 'HNDWEBMR3');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Query to retrieve all products from the Product table
$sql = "SELECT p.*, MIN(i.ImageURL) AS ImageURL 
        FROM Product p 
        LEFT JOIN ProductImage i ON p.ProductID = i.ProductID 
        GROUP BY p.ProductID";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Shop</title>
</head>
<body>

<?php include 'navbar.php'; ?>

<!-- 
  START OF PRODUCT SECTION
-->
<!-- 
  title and text of PRODUCT section
-->
<div class="header-of-product-section">
    <div class="title-of-product-section">
      <h2 >New collection</h2>
    </div>
    <div class="text-link-of-product-section">
      <p style="font-size: 28px;">Get ready for summer!</p>
    </div>
  </div>
<!-- 
  PRODUCT CARDS (PRODUCT)
-->
  <div class="product-card-display">
    <div class="product-card-behavior">

      <!-- php to retrive products information from database -->
      <?php

    // Output data of each row
    while($row = $result->fetch_assoc()) {
  ?>

      <div class="product-card-content">            
          <img src="<?php echo $row["ImageURL"]; ?>" alt="">
          <h3><?php echo $row["ProductName"];?></h3>
          <h6>£<?php echo $row["Price"];?></h6>
          <a href="login.php">
            <button class="buy-4 button-product-card">
                Shop Now
            </button>
        </a>
      </div>

      <!-- closing php while curly brackets -->
      <?php
      }
      ?>

    </div>
  </div>
<!-- 
  END OF PRODUCT SECTION 
-->

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
