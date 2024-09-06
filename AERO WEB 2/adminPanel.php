<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['member_type']) || $_SESSION['member_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "HNDWEBMR3", "RSYZ3LyZEy", "HNDWEBMR3") or die("could not connect");

function sanitize($input) {
    return htmlspecialchars(strip_tags($input));
}

// Handle AeroMembers actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aero_action'])) {
    if ($_POST['aero_action'] === 'update') {
        $id = sanitize($_POST['aero_id']);
        $username = sanitize($_POST['aero_username']);
        $password = sanitize($_POST['aero_password']);
        $dob = sanitize($_POST['aero_dob']);
        $memberType = sanitize($_POST['aero_member_type']);
        $updateQuery = "UPDATE AeroMembers SET username='$username', password='$password', DOB='$dob', member_type='$memberType' WHERE ID='$id'";
        mysqli_query($conn, $updateQuery) or die("Update unsuccessful");
    } elseif ($_POST['aero_action'] === 'delete') {
        $id = sanitize($_POST['aero_id']);
        $deleteQuery = "DELETE FROM AeroMembers WHERE ID='$id'";
        mysqli_query($conn, $deleteQuery) or die("Delete unsuccessful");
    } elseif ($_POST['aero_action'] === 'add') {
        $username = sanitize($_POST['new_aero_username']);
        $password = sanitize($_POST['new_aero_password']);
        $dob = sanitize($_POST['new_aero_dob']);
        $memberType = sanitize($_POST['new_aero_member_type']);
        $addQuery = "INSERT INTO AeroMembers (username, password, DOB, member_type) VALUES ('$username', '$password', '$dob', '$memberType')";
        mysqli_query($conn, $addQuery) or die("Add unsuccessful");
    }
}

$aero_query = "SELECT * FROM AeroMembers";
$aero_result = mysqli_query($conn, $aero_query) or die("unable to execute query");

// Handle Product actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_action'])) {
    if ($_POST['product_action'] === 'update') {
        $id = sanitize($_POST['product_id']);
        $productName = sanitize($_POST['product_name']);
        $gender = sanitize($_POST['gender']);
        $category = sanitize($_POST['category']);
        $subcategory = sanitize($_POST['subcategory']);
        $description = sanitize($_POST['description']);
        $price = sanitize($_POST['price']);
        $stock = sanitize($_POST['stock']);
        $updateQuery = "UPDATE Product SET ProductName='$productName', Gender='$gender', Category='$category', Subcategory='$subcategory', Description='$description', Price='$price', Stock='$stock' WHERE ProductID='$id'";
        mysqli_query($conn, $updateQuery) or die("Update unsuccessful");
    } elseif ($_POST['product_action'] === 'delete') {
        $id = sanitize($_POST['product_id']);
        $deleteQuery = "DELETE FROM Product WHERE ProductID='$id'";
        mysqli_query($conn, $deleteQuery) or die("Delete unsuccessful");
    } elseif ($_POST['product_action'] === 'add') {
        $productName = sanitize($_POST['new_product_name']);
        $gender = sanitize($_POST['new_gender']);
        $category = sanitize($_POST['new_category']);
        $subcategory = sanitize($_POST['new_subcategory']);
        $description = sanitize($_POST['new_description']);
        $price = sanitize($_POST['new_price']);
        $stock = sanitize($_POST['new_stock']);
        $addQuery = "INSERT INTO Product (ProductName, Gender, Category, Subcategory, Description, Price, Stock) VALUES ('$productName', '$gender', '$category', '$subcategory', '$description', '$price', '$stock')";
        mysqli_query($conn, $addQuery) or die("Add unsuccessful");
    }
}

$product_query = "SELECT * FROM Product";
$product_result = mysqli_query($conn, $product_query) or die("unable to execute query");

// Handle ProductImage actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image_action'])) {
    if ($_POST['image_action'] === 'add') {
        $productId = sanitize($_POST['product_id']);
        if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
          //need directory with correct permissions to be able to upload the images
            $targetDir = "assets/images";
            $targetFile = $targetDir . basename($_FILES['image_url']['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            
            // Check file type
            $allowedTypes = array("jpg", "jpeg", "png", "gif");
            if (in_array($imageFileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES['image_url']['tmp_name'], $targetFile)) {
                    $addImageQuery = "INSERT INTO ProductImage (ProductID, ImageURL) VALUES ('$productId', '$targetFile')";
                    if (mysqli_query($conn, $addImageQuery)) {
                        echo "Image added successfully.";
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    echo "Error uploading file.";
                }
            } else {
                echo "File type not allowed.";
            }
        } else {
            echo "Error with file upload.";
        }
    } elseif ($_POST['image_action'] === 'delete') {
        $imageId = sanitize($_POST['image_id']);
        $deleteImageQuery = "DELETE FROM ProductImage WHERE ImageID='$imageId'";
        mysqli_query($conn, $deleteImageQuery) or die("Delete image unsuccessful");
    }
}

// Select all records from ProductImage table
$image_query = "SELECT * FROM ProductImage";
$image_result = mysqli_query($conn, $image_query) or die("unable to execute query");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
        <!--google Fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Admin Panel</title>
</head>
<body style='background-color:#f2f2f2;'>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="logout.php">
      <img src="assets/images/LOGO-AM.png" alt="Bootstrap" width="70" height="70">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="admin-panel-content">
    <h2 class="admin-panel-title">Manage AeroMembers</h2>
    <h2 class="admin-panel-subtitle">Welcome to the Admin Panel, <?php echo $_SESSION['username']; ?>!</h2>

    <?php
    if (mysqli_num_rows($aero_result) > 0) {
        echo "<table class='admin-table'>";
        echo "<tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>DOB</th>
                  <th>Member Type</th>
                  <th>Action</th>
              </tr>";

        while ($row = mysqli_fetch_assoc($aero_result)) {
            echo "<tr>";
            echo '<form class="admin_panel_form" method="POST">';
            echo "<input type='hidden' name='aero_id' value='" . $row['ID'] . "'>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td><input type='text' name='aero_username' value='" . $row['username'] . "'></td>";
            echo "<td><input type='text' name='aero_password' value='" . $row['password'] . "'></td>";
            echo "<td><input type='text' name='aero_dob' value='" . $row['DOB'] . "'></td>";
            echo "<td><input type='text' name='aero_member_type' value='" . $row['member_type'] . "'></td>";
            echo "<td>";
            echo "<input class='admin-btn-update' type='submit' name='aero_action' value='update'>";
            echo "<input class='admin-btn-delete' type='submit' name='aero_action' value='delete'>";
            echo "</td>";
            echo "</form>";
            echo "</tr>";
        }

        echo "<tr>";
        echo "<form method='POST'>";
        echo "<td></td>";
        echo "<td><input type='text' name='new_aero_username' placeholder='New Username' required></td>";
        echo "<td><input type='text' name='new_aero_password' placeholder='New Password' required></td>";
        echo "<td><input type='date' name='new_aero_dob' placeholder='New DOB' required></td>";
        echo "<td><input type='text' name='new_aero_member_type' placeholder='New Member Type' required></td>";
        echo "<td>";
        echo "<input class='admin-btn-add' type='submit' name='aero_action' value='add'>";
        echo "</td>";
        echo "</form>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "<p class='no-members'>No members found.</p>";
    }
    ?>
</div>

<div class="admin-panel-content">
    <h2 class="admin-panel-title">Manage Products</h2>

    <?php
    if (mysqli_num_rows($product_result) > 0) {
        echo "<table class='admin-table'>";
        echo "<tr>
                  <th>ProductID</th>
                  <th>ProductName</th>
                  <th>Gender</th>
                  <th>Category</th>
                  <th>Subcategory</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Action</th>
              </tr>";

        while ($row = mysqli_fetch_assoc($product_result)) {
            echo "<tr>";
            echo '<form class="admin_panel_form" method="POST">';
            echo "<input type='hidden' name='product_id' value='" . $row['ProductID'] . "'>";
            echo "<td>" . $row['ProductID'] . "</td>";
            echo "<td><input type='text' name='product_name' value='" . $row['ProductName'] . "'></td>";
            echo "<td><input type='text' name='gender' value='" . $row['Gender'] . "'></td>";
            echo "<td><input type='text' name='category' value='" . $row['Category'] . "'></td>";
            echo "<td><input type='text' name='subcategory' value='" . $row['Subcategory'] . "'></td>";
            echo "<td><input type='text' name='description' value='" . $row['Description'] . "'></td>";
            echo "<td><input type='text' name='price' value='" . $row['Price'] . "'></td>";
            echo "<td><input type='text' name='stock' value='" . $row['Stock'] . "'></td>";
            echo "<td>";
            echo "<input class='admin-btn-update' type='submit' name='product_action' value='update'>";
            echo "<input class='admin-btn-delete' type='submit' name='product_action' value='delete'>";
            echo "</td>";
            echo "</form>";
            echo "</tr>";

            // Display product images for each product
            $productId = $row['ProductID'];
            $productImageQuery = "SELECT * FROM ProductImage WHERE ProductID='$productId'";
            $productImageResult = mysqli_query($conn, $productImageQuery);

            echo "<tr>";
            echo "<td colspan='9'>";
            echo "<div class='product-images'>";
            if (mysqli_num_rows($productImageResult) > 0) {
                while ($imageRow = mysqli_fetch_assoc($productImageResult)) {
                    echo "<div class='product-image'>";
                    echo "<img src='" . $imageRow['ImageURL'] . "' alt='Product Image' width='100'>";
                    echo "<form method='POST'>";
                    echo "<input type='hidden' name='image_id' value='" . $imageRow['ImageID'] . "'>";
                    echo "<input type='hidden' name='product_id' value='" . $productId . "'>";
                    echo "<input class='admin-btn-delete' type='submit' name='image_action' value='delete'>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>No images found.</p>";
            }
            echo "</div>";
            echo "<form method='POST' enctype='multipart/form-data'>";
            echo "<input type='hidden' name='product_id' value='$productId'>";
            echo "<input type='file' name='image_url' required>";
            echo "<input class='admin-btn-add' type='submit' name='image_action' value='add'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }

        echo "<tr>";
        echo "<form method='POST'>";
        echo "<td></td>";
        echo "<td><input type='text' name='new_product_name' placeholder='New Product Name' required></td>";
        echo "<td><input type='text' name='new_gender' placeholder='New Gender' required></td>";
        echo "<td><input type='text' name='new_category' placeholder='New Category' required></td>";
        echo "<td><input type='text' name='new_subcategory' placeholder='New Subcategory' required></td>";
        echo "<td><input type='text' name='new_description' placeholder='New Description' required></td>";
        echo "<td><input type='text' name='new_price' placeholder='New Price' required></td>";
        echo "<td><input type='text' name='new_stock' placeholder='New Stock' required></td>";
        echo "<td>";
        echo "<input class='admin-btn-add' type='submit' name='product_action' value='add'>";
        echo "</td>";
        echo "</form>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "<p class='no-products'>No products found.</p>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
