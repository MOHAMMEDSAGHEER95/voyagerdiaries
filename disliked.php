<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $user_id = $_REQUEST["user_id"];
    $reviewId = $_REQUEST["review_id"];
    $action = $_REQUEST["action"];
    if($action == 'dislike'){
        pg_query($dbconn, "insert into disliked_reviews (user_id,review_id) values (".$user_id.",".$reviewId.") returning id");
        pg_query($dbconn, "UPDATE reviews SET dislike_count = dislike_count + 1 WHERE id = ".$reviewId.";");
        echo "disliked";
    }
    else {
        pg_query($dbconn, "delete from disliked_reviews where user_id=".$user_id." and review_id=".$reviewId." returning id");
        pg_query($dbconn, "UPDATE reviews SET dislike_count = dislike_count - 1 WHERE id = ".$reviewId.";");
        echo "undisliked";
    }

  }
?>