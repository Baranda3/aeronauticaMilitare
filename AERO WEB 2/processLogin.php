<?php
// connection to database
$conn = mysqli_connect("localhost", "HNDWEBMR3", "RSYZ3LyZEy", "HNDWEBMR3") or die("could not connect");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check authentication
    $checkQuery = "SELECT * FROM AeroMembers WHERE Username = '$username' AND Password = '$password'";
    $checkResult = mysqli_query($conn, $checkQuery) or die("unable to execute query");

    if (mysqli_num_rows($checkResult) > 0) {
        // Authentication successful
        $row = mysqli_fetch_assoc($checkResult);
        $memberType = $row['member_type'];

        // Start the session
        session_start();

        // Set session variables
        $_SESSION['username'] = $username;
        $_SESSION['member_type'] = $memberType;

        // redirection depending on member_type
        switch ($memberType) {
            case 'admin':
                header("Location: adminPanel.php");
                break;
            default:
                // handle unexpected member_type
                header("Location: login.php");
                exit();
        }
    } else {
        // Authentication failed
        header("Location: login.php?error=invalid");
        exit();
    }
}
?>
