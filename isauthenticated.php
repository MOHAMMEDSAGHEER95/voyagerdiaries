<?php
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
?>