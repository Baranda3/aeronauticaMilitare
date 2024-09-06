<!--

LIMELIGHT CINEMA PROJECT
Developer: Carlo Baranda
Coding Languages Used in Project: HTML, CSS, JS, PHP, SQL

Project Start Date: 24/nov/2023
Project Completion Date: -/-/-
Code Last Updated Date: 04/01/2023

-->


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



<div class="form_login_box">
        <div class="login_form_body">
            <h2 class="titulo_forma_login">Login Form</h2>

            <?php
            // Display error message if present
            if (isset($_GET['error']) && $_GET['error'] == 'invalid') {
                echo '<p style="color: red;">Invalid username or password. Please try again.</p>';
            }
            ?>

            <form class="login_form" action="processLogin.php" method="POST">
                <label>Username:</label><br>
                <input type="text" name="username" required><br>
                <label>Password:</label><br>
                <input type="password" name="password" required><br>
                <input type="submit" value="Login">
            </form>

            <!-- Link to go to register page -->
            <!-- <p>New user? <a href="register.html">Register here</a></p> -->
        </div>
    </div>






<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



</body>
</html>
