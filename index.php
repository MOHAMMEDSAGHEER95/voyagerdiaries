<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Home</title>
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
}
.card-body:hover {
  background-color: #006dff;
  color: white;
  -webkit-transition: background 2s; /* For Safari 3.0 to 6.0 */
        transition: background 2s;
}
</style>
<body>
    <!-- Navbar -->
    <?php
    include "includes/base.php";
    ?>
    <div class="container mt-100">
    <div class="card text-center">
  <div class="card-header">
    Reviews
  </div>
  <?php
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
$reviewsResult = pg_query($dbconn, "select a.review,b.username from reviews a join users b on a.user_id=b.id order by a.id desc;");
if (pg_num_rows($reviewsResult) > 0) {
  while ($row = pg_fetch_assoc($reviewsResult)) {
    echo "<div class='card-body'>";
    echo '<h5 class="card-title">'.$row["review"] .'</h5>';
    echo '<p>Review By:'.$row["username"].'</p>';
    echo '<i class="fa fa-lg fa-thumbs-up"></i>';
    
  echo '</div><div class="card-footer text-muted"></div>';
  }
}
?>
  
    
</div>
    </div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <?php
$script = file_get_contents("assets/js/script.js");
echo "<script>" . $script . "</script>";
?>
  </body>
</html>
