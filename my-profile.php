<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Update Profile</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  .mt-100 {
  margin-top: 100px !important;
}
  .mr-100 {
  margin-right: 100px !important;
}

.card-body{
  cursor: pointer;
  transition: transform 0.3s ease-in-out;
  transform-origin: center center;
}
.card-body:hover {
  /* background-color: #006dff;
  color: white; */
  transform: scale(1.1);
  -webkit-transition: background 2s; /* For Safari 3.0 to 6.0 */
        transition: background 2s;
}
.fa-trash {
    padding: 10px;
}
</style>
<body>
<?php

    include "includes/base.php";
require 'isauthenticated.php';
    include('config/db_config.php');
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

$dbconn = pg_connect($connection_string);
$userId = $_SESSION['user_id'];
$userResult = pg_query($dbconn, "select * from users where id=".$userId);
$row = pg_fetch_row($userResult);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $updateQuery = pg_query($dbconn, "update users set first_name='".$first_name."', last_name='".$last_name."' where id=".$userId);
    
    echo '<div class="alert alert-success" role="alert">
Profile Updated successfully!
</div>';
header("Location: /");
}


echo '<div class="container d-flex justify-content-center align-items-center vh-100">';
echo '<form action="/my-profile.php" method="post"><div class="form-group"><label for="first_name">First Name:</label>';
echo "<input type='text' class='form-control-lg no-border' name='first_name' value='".$row[1]."'>";
echo '</div><div class="form-group"><label for="last_name">Last Name:</label>';

echo "<input type='text' class='form-control-lg no-border' name='last_name' value='".$row[2]."'>";
echo '</div> <button type="submit" class="btn btn-primary">Submit</button></form>';

echo "</div>";
    ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <?php
$script = file_get_contents("assets/js/script.js");
echo "<script>" . $script . "</script>";
?>

    
    </body>
    </html>