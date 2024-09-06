<?php
// Check if ProductID is set in the URL
if (isset($_GET['ProductID'])) {
    $productID = $_GET['ProductID'];

    // Connect to the database
    $conn = mysqli_connect("localhost", "HNDWEBMR3", "RSYZ3LyZEy", "HNDWEBMR3") or die("Could not connect");

    $sizes = array("S", "M", "L");

    // Query to retrieve product details and all associated images
    $sql = "SELECT p.*, i.ImageURL 
            FROM Product p 
            LEFT JOIN ProductImage i ON p.ProductID = i.ProductID 
            WHERE p.ProductID = '$productID'";
    
    $result = $conn->query($sql);

    // php products retrieval
    $sql1 = "SELECT p.*, MIN(i.ImageURL) AS ImageURL 
    FROM Product p 
    LEFT JOIN ProductImage i ON p.ProductID = i.ProductID 
    GROUP BY p.ProductID
    ORDER BY RAND() LIMIT 5";

    $products = $conn->query($sql1);

    if ($result->num_rows > 0) {
        // Output data of the specific product
        $row = $result->fetch_assoc();
?>

        
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <title><?php echo $row["ProductName"]; ?> - Product Details</title>

<body>


<!-- Navigation Bar -->
<?php include 'navbar.php'; ?>


<div class="product-margin">
<div class="padding_wrapper">

<?php 
while($row = mysqli_fetch_assoc($result)) {
    $sizes = explode(',', $row["sizes"]);
?>

    <div class="img_and_details">
    <div class="product_image">
    <img src="<?php echo $row["ImageURL"]; ?>" alt="<?php echo $row["ProductName"]; ?>" class="card-img-top">
    </div>

    <div class="product_details">

      <h5><?php echo $row["ProductName"]; ?></h5>
      <p>£<?php echo $row["Price"]; ?></p>

      <div class="dropdown">
      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
       SELECT SIZE
        </button>
      <ul class="dropdown-menu">
      <?php foreach ($sizes as $size) { ?>
                        <li><button class="dropdown-item select-size" type="button" data-size="<?php echo $size; ?>">UK <?php echo $size; ?></button></li>
      <?php } ?>
      </ul>
      </div>

      <div class="quantity-selector">
    <button class="decrease-btn">-</button>
    <input type="number" class="quantity-input" value="1" min="1" max="4">
    <button class="increase-btn">+</button>
      </div>

      <div class="buy_now">
      <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
	  <input type="hidden" name="cmd" value="_xclick">
      <input type="hidden" name="business" value="buyer@sandbox.co.uk"><!-- COMMENT change this in the code to the email address of the paypal acc to receive funds -->
	  <input type="hidden" name="lc" value="US">
	  <input type="hidden" name="item_name" value="<?php echo($row['ProductID']);?>"><!-- COMMENT dynamic content here for each different item name in the db table -->
	  <input type="hidden" name="amount" value="<?php echo($row['Price']);?>"><!-- COMMENT dynamic content here for each different item cost in the db table -->
	  <input type="hidden" name="currency_code" value="GBP">
	  <input type="hidden" name="button_subtype" value="services">
	  <input type="hidden" name="no_note" value="0">
	  <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
	  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	  </form>
    </div>

    </div>

    
    <div class="info-wrapper">
    <div class="info-item">
        <div class="info_title" onclick="toggleInfo(this)">
            <i class="fa-regular fa-file-lines"></i>
            PRODUCT DETAILS
            <i class="fa-solid fa-caret-down"></i> <!-- Arrow icon -->
        </div>
        <div class="info"><?php echo($row['Description']);?></div>
    </div>

    <div class="info-item">
        <div class="info_title" onclick="toggleInfo(this)">
            <i class="fa-solid fa-box"></i>
            SHIPPING
            <i class="fa-solid fa-caret-down"></i> <!-- Arrow icon -->
        </div>
        <div class="info">
            <p><strong>Processing Time:</strong> 1-2 business days</p>
            <p><strong>Shipping Time:</strong> 2-3 business days for standard shipping, 1-2 business days for expedited shipping</p>
            <p><strong>Tracking Information:</strong> Provided via email once your order is shipped</p>
            <p><strong>Shipping Costs:</strong> Calculated at checkout</p>
            <p><strong>International Shipping:</strong> Customs clearance may cause delays; customs duties or taxes may apply</p>
        </div>
    </div>

    <div class="info-item">
        <div class="info_title" onclick="toggleInfo(this)">
            <i class="fa-solid fa-rotate-left"></i>
            RETURN POLICY
            <i class="fa-solid fa-caret-down"></i> <!-- Arrow icon -->
        </div>
        <div class="info">
            We offer a hassle-free return policy to ensure customer satisfaction. If you are not completely satisfied with your purchase, you may return the item(s) within 30 days of delivery for a full refund or exchange. Please note that the item(s) must be in unused condition with the original packaging intact.
        </div>
    </div>
</div>

</div>

  <?php
    }
    ?>

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
    while($row = mysqli_fetch_assoc($products)) {
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

      <!-- closing php while curly brackets -->
      <?php
      }
      ?>

        </div>
    </div>
</div>



<?php include 'footer.php'; ?>


<!-- all scripts file -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- select sizes javascript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var sizeButtons = document.querySelectorAll('.select-size');
    
    sizeButtons.forEach(function(button) {
        button.addEventListener('click', function () {
            var selectedSize = this.getAttribute('data-size');
            var dropdownToggle = this.closest('.dropdown').querySelector('.dropdown-toggle');
            dropdownToggle.innerHTML = 'UK ' + selectedSize;
        });
    });
});


// quantity selector 
document.addEventListener("DOMContentLoaded", function() {
    const decreaseBtn = document.querySelector(".decrease-btn");
    const increaseBtn = document.querySelector(".increase-btn");
    const quantityInput = document.querySelector(".quantity-input");

    decreaseBtn.addEventListener("click", function() {
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            value--;
            quantityInput.value = value;
        }
    });

    increaseBtn.addEventListener("click", function() {
        let value = parseInt(quantityInput.value);
        if (value < 4) {
            value++;
            quantityInput.value = value;
        }
    });
});

 // info script

 function toggleInfo(element) {
    const info = element.nextElementSibling;
    info.style.display = info.style.display === 'block' ? 'none' : 'block';
    }



</script>



</body>
</html>


<?php
    } else {
        echo "No results found for the specified product ID.";
    }

    $conn->close();
} else {
    echo "Invalid request. Please provide a product ID.";
}
?>