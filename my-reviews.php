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

<div class="modal fade" id="editReview" tabindex="-1" role="dialog" aria-labelledby="editReviewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editReviewLabel">Edit Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="text" class="form-control no-border" id="editReviewText">
        <input type="hidden" id="editReviewId">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitReview">Save changes</button>
      </div>
    </div>
  </div>
</div>
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
$user_id = 0;
if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}


$reviewsResult = pg_query($dbconn, "SELECT r.review, u.username, r.id, CASE WHEN l.user_id IS NULL THEN 0 ELSE 1 END AS liked,CASE WHEN d.user_id IS NULL THEN 0 ELSE 1 END AS disliked,like_count,dislike_count FROM reviews r LEFT JOIN liked_reviews l ON l.review_id = r.id AND l.user_id = ".$user_id.  " LEFT JOIN disliked_reviews d ON d.review_id = r.id AND d.user_id = ".$user_id.  " JOIN users u ON r.user_id = u.id where r.user_id=".$user_id." ORDER BY r.id DESC;");
if (pg_num_rows($reviewsResult) > 0) {
  while ($row = pg_fetch_assoc($reviewsResult)) {

    echo "<div class='card-body' id='card-".$row['id']."'>";
    echo '<h5 class="card-title" id="card-title-'.$row['id'].'">'.$row["review"] .'</h5>';
    echo '<p>Review By:'.$row["username"].'</p>';
    if($row["liked"]== 0){
      echo '<i class="fa fa-lg fa-thumbs-up action_like" review_id="' . $row['id'] . '" user_id="'.$user_id.'" action="like" "></i>';

    }
    else {
      echo '<i class="fa fa-lg fa-thumbs-up action_like" style="color: #2d7ce6" review_id="' . $row['id'] . '" user_id="'.$user_id.'" action="unlike" "></i>';
    }
    echo '<i class="like_count">'.$row['like_count'].'</i>';
    if($row["disliked"]== 0){
    echo '<i class="fa fa-lg fa-thumbs-down action_dislike" style="margin-left:5px;" review_id="' . $row['id'] . '" user_id="'.$user_id.'" action="dislike" "></i>';
    }
    else {
      echo '<i class="fa fa-lg fa-thumbs-down action_dislike" style="margin-left:5px; color: red" review_id="' . $row['id'] . '" user_id="'.$user_id.'" action="undislike" "></i>';
    }
    echo '<i class="dislike_count">'.$row['dislike_count'].'</i>';
    echo '<i class="fa fa-lg fa-solid fa-trash" style="color: #e25555;" review_id="' . $row['id'] . '"></i>';
    echo '<i class="fa fa-lg fa-solid fa-edit" style="color: #2363d1;" review_id="' . $row['id'] . '"></i>';
    
  echo '<div class="card-footer text-muted"></div></div>';
  }
}
else {
    echo "<p>No reviews posted by user</p>";
}

?>
  
    
</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <?php
$script = file_get_contents("assets/js/script.js");
echo "<script>" . $script . "</script>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $data = json_decode($data, true);
    if($_REQUEST["action"] == "delete"){
        $reviewId = $_REQUEST["review_id"];
    
        pg_query($dbconn, "delete from reviews where id=".$reviewId."");
        echo $reviewId;
    }
    else if ($_REQUEST["action"] == "edit"){
        $reviewId = $_REQUEST["review_id"];
        $review = $_REQUEST["review"];
        pg_query($dbconn, "update reviews set review='".$review."' where id=".$reviewId."");
        echo "edit successful";
    }
}


?>
  </body>
</html>
