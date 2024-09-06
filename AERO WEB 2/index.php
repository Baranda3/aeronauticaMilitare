<?php
// Create connection
$con = mysqli_connect('localhost', 'HNDWEBMR3', 'RSYZ3LyZEy', 'HNDWEBMR3') or die("can't connect");

// Query to retrieve distinct products from the Product table along with their first image from the ProductImage table
$sql = "SELECT p.*, MIN(i.ImageURL) AS ImageURL 
        FROM Product p 
        LEFT JOIN ProductImage i ON p.ProductID = i.ProductID 
        WHERE p.Category LIKE '%NC%'
        GROUP BY p.ProductID
        ORDER BY RAND() 
        LIMIT 10";
$result = $con->query($sql);
?>





<!-- 
START HTML
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- 
LINKS
-->
  <!--bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!--css-->
  <link rel="stylesheet" href="styles.css">
    <!--google Fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">


  <title>Aeronautica Military</title>
</head>





<body>  
<!-- 
NAVBAR
-->
  <?php include 'navbar.php'; ?>





<!-- 
START OF CAROUSEL 
-->
  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/images/mwh1.jpg" class="d-block w-100" style="height:100% important!;" alt="...">
      </div>
      <div class="carousel-item">
        <img src="assets/images/mh3.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="assets/images/wh12.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
<!-- 
END OF CAROUSEL 
-->





<!-- 
START OF PRODUCT SECTION
-->
  <!-- title and text -->
  <div class="header-of-product-section">
    <div class="title-of-product-section">
      <a href="newCollection.php">
        <h2 >New collection</h2>
      </a>
    </div>
    <div class="text-link-of-product-section">
      <p style="font-size: 28px;">Get ready for summer!</p>
    </div>
  </div>

  <!-- product cards -->
  <div class="product-card-display">
    <div class="product-card-behavior">

<!-- OPEN PHP -->     
  <!-- php to retrive products information from database -->
  <?php
  // Output data of each row
    while($row = $result->fetch_assoc()) {
  ?>
      <div class="product-card-content">            
          <img src="<?php echo $row["ImageURL"]; ?>" alt="">
          <h3><?php echo $row["ProductName"];?></h3>
          <h6>£<?php echo $row["Price"];?></h6>
          <a href="singleProductPage2.php?ProductID=<?php echo $row['ProductID']; ?>">
            <button class="buy-4 button-product-card">
                Shop Now
            </button>
        </a>
      </div>

  <?php
    }
  ?>
<!-- CLOSE PHP -->    

    </div>
  </div>
<!-- 
END OF PRODUCT SECTION 
-->





<!-- 
START OF CATEGORIES SECTION
-->
  <!-- first header  -->
  <div class="new-collection-title">
    <div class="header-new-collection">
      <h2>Explore our categories</h2>
    </div>
    <div class="text-header-new-collection">
      <!-- option to add smaller text on the right side -->
      <p></p>
    </div>
  </div>

  <!-- wrapper of cards with images -->
  <div class="new-collection-card">

    <!-- card 1 -->
    <div class="new-collection-card-content">
      <div class="new-collection-card-1">
        <div class="text-new-collection-card-image">
          <h2>Man</h2>
            <!-- option to add text in the card as example below, can be used in all cards -->
            <!-- <p>Back to old style but without loosing the fashion</p> -->
            <div class="new-collection-card-image-button"><a href="">Explore now</a>
            </div>
        </div>
      </div>
    </div>

    <!-- card 2 -->
    <div class="new-collection-card-content">
      <div class="new-collection-card-2">
        <div class="text-new-collection-card-image">
          <h2>Woman</h2>
            <div class="new-collection-card-image-button"><a href="">Explore now</a>
            </div>
        </div>
      </div>
    </div>

    <!-- card 3 -->
    <div class="new-collection-card-content">
      <div class="new-collection-card-3">
        <div class="text-new-collection-card-image">
          <h2>Shoes</h2>
            <div class="new-collection-card-image-button"><a href="">Explore now</a>
            </div>
        </div>
      </div>
    </div>
    
    <!-- card 4 -->
    <div class="new-collection-card-content">
      <div class="new-collection-card-4">
        <div class="text-new-collection-card-image">
          <h2>Accessories</h2>
            <div class="new-collection-card-image-button"><a href="">Explore now</a>
            </div>
        </div>
      </div>
    </div>

  </div>
<!-- 
END OF CATEGORIES SECTION
-->





<!-- 
START OF PRODUCT SECTION 2
-->
  <!-- title and text -->
  <div class="header-of-product-section">
      <div class="title-of-product-section">
        <a href="viewAll.php">
          <h2>Popular products</h2>
        </a>
      </div>
      <div class="text-link-of-product-section">
          <!-- option to add smaller text on the right side -->
          <p style="font-size: 28px;"></p>
      </div>
  </div>

  <!-- product cards -->
  <div class="product-card-display">
      <div class="product-card-behavior">

<!-- OPEN PHP -->  
    <!-- php to retrieve product information from the database -->
    <?php

    // Query to retrieve distinct products from the Product table along with their first image from the ProductImage table
    $popular = "SELECT p.*, MIN(i.ImageURL) AS ImageURL 
    FROM Product p 
    LEFT JOIN ProductImage i ON p.ProductID = i.ProductID 
    GROUP BY p.ProductID
    ORDER BY RAND() 
    LIMIT 5";

    $result2 = $con->query($popular);

    // Check if any rows were returned
    if ($result2->num_rows > 0) {
        // Output data of each row
        while ($row = $result2->fetch_assoc()) {
    ?>
<!-- CLOSE PHP -->  
    <a href="singleProductPage2.php?ProductID=<?php echo $row['ProductID']; ?>">
      <div class="product-card-content">
          <img src="<?php echo $row["ImageURL"]; ?>" alt="">
          <h3><?php echo $row["ProductName"]; ?></h3>
          <h6>£<?php echo $row["Price"]; ?></h6>
          <a href="singleProductPage2.php?ProductID=<?php echo $row['ProductID']; ?>">
              <button class="buy-4 button-product-card">
                  Shop Now
              </button>
          </a>
      </div>
    </a>

<!-- OPEN PHP -->  
    <?php
        }
    } else {
        echo "0 results";
    }
    // Close connection
    $con->close();
    ?>
<!-- CLOSE PHP -->  

    </div>
  </div>
<!-- 
END OF PRODUCT SECTION 2
-->





<!-- 
FOOTER
-->
<?php include 'footer.php'; ?>



<!-- 
JS
-->
  <!--bootstrap navbar hidden menu-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



</body>
</html>