<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Post Reviews</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<body>
    <!-- Navbar -->
    <?php
    include "includes/base.php";
    ?>
    <div class="container">
        <h2>Post your Review</h2>
<form action="/create-reviews.php" method="post">
  <div class="form-group">
    <label for="review">Review</label>
    <textarea id="review" name="review" rows="4" cols="50"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
<?php
$script = file_get_contents("assets/js/script.js");
echo "<script>" . $script . "</script>";
?>
</html>

<?php


include "config/db_config.php";

$connection_string =
    "host=" .
    DB_HOST .
    " port=" .
    DB_PORT .
    " dbname=" .
    DB_NAME .
    " user=" .
    DB_USER .
    " password=" .
    DB_PASSWORD;

if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
$dbconn = pg_connect($connection_string);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_pg = ["review" => $_REQUEST["review"], "user_id" => $_SESSION['user_id']];
    $res = pg_insert($dbconn, "reviews", $data_pg);
    header("Location: index.php");
}

?>