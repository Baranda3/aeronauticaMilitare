<!-- processSale.php -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected quantity
    $quantity = $_POST["quantity"];

    // Assuming you have a database connection
    $conn = mysqli_connect("localhost", "HNDWEBMR3", "RSYZ3LyZEy", "HNDWEBMR3");

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if 'ProductID' is set in the $_GET array
    if (isset($_GET['ProductID'])) {
        // Get the product ID
        $productID = $_GET['ProductID'];

        // Retrieve current stock
        $sql = "SELECT Stock FROM Product WHERE ProductID = $productID";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentStock = $row["Stock"];

            // Check if there are enough items available
            if ($currentStock >= $quantity) {
                // Update the stock in the database
                $newStock = $currentStock - $quantity;
                $updateSql = "UPDATE Product SET Stock = $newStock WHERE ProductID = $productID";

                if ($conn->query($updateSql) === TRUE) {
                    // Redirect to the confirmation page with sale details
                    header("Location: saleConfirmation.php?ProductID=$productID&quantity=$quantity");
                    exit();
                } else {
                    echo "Error updating stock: " . $conn->error;
                }
            } else {
                // Display the remaining stock
                echo "Not enough items available. Remaining stock: $currentStock";
            }
        } else {
            echo "Product details not found.";
        }
    } else {
        echo "Product ID not set in the URL.";
    }

    // Close the database connection
    $conn->close();
}
?>
