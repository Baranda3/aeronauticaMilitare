<?php
// Create connection
$con = new mysqli('localhost', 'root', 'root', 'aeronautica_db');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT * FROM Products WHERE category = 'Accessories'";
$accessories = $con->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 
    start of links
  -->

  <!--bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!--css-->
  <link rel="stylesheet" href="styles.css">

  <!-- 
    end of links
  -->

  <title>Aeronautica Military</title>
</head>
<body>
  
  <!-- 
    start of navbar
  -->
  <?php include 'navbar.php'; ?>
  <!-- 
    end of navbar
  -->

<!-- 
  title and text of PRODUCT section
-->
<div class="header-of-product-section">
    <div class="title-of-product-section">
      <h2 >Explore Accessories Collection</h2>
    </div>
    <div class="text-link-of-product-section">
      <p style="font-size: 28px;"></p>
    </div>
  </div>
<!-- 
  PRODUCT CARDS (PRODUCT)
-->
  <!-- product cards -->
  <div class="product-card-display">
    <div class="product-card-behavior">

    <?php
  // Output data of each row
  while($row = $accessories->fetch_assoc()) {
    // Split the ImageURLs string into an array using comma as delimiter
    $imageUrls = explode(",", $row["ImageURLs"]);
    // Get the first image URL
    $firstImageUrl = trim($imageUrls[0]); // trim removes any leading or trailing spaces
?>
    <div class="product-card-content">            
        <img src="<?php echo $firstImageUrl; ?>" alt="">
        <h3><?php echo $row["ProductName"];?></h3>
        <h6>£<?php echo $row["Price"];?></h6>
        <a href="singlePage.php?id=<?php echo $row['ProductId']; ?>">
          <button class="buy-4 button-product-card">
              Shop Now
          </button>
      </a>
    </div>
<?php
  }
?>   

    </div>
  </div>
<!-- 
  END OF PRODUCT SECTION 
-->





  <?php include 'footer.php'; ?>
  <!-- The rest of your page content -->
  


  <!--bootstrap navbar hidden menu-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
