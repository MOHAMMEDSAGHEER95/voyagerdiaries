<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Signup</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<body>
    <div class="container">
        <h2>Signup with VoyagerDiaries</h2>
<form action="/signup.php" method="post">
<div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" class="form-control" name="first_name" id="first_name">
  </div>
  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" class="form-control" name="last_name" id="last_name">
  </div>
  <div class="form-group">
    <label for="username">UserName</label>
    <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
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

$dbconn = pg_connect($connection_string);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $password = sha1($_REQUEST["password"]);
    $username = $_REQUEST["username"];
    $first_name = $_REQUEST["first_name"];
    $last_name = $_REQUEST["last_name"];

    $user_name_exists = pg_query($dbconn, "select id from users where username='".$username."'");
    $user_exists = FALSE;
    $arr = pg_fetch_all($user_name_exists);
    if($arr){
      $user_exists = TRUE;
    }

    $data_pg = [
        "first_name" => $first_name,
        "last_name" => $last_name,
        "username" => $username,
        "password" => $password,
    ];
    if($user_exists == TRUE){
      echo "<h3>This username is used already. If it is you please use Login.</h3>";
    }

    else if (empty($data_pg)) {
        echo "data is empty";
    } else {
        $res = pg_insert($dbconn, "users", $data_pg);
        if ($res) {
            echo "<br>POST data is successfully logged\n";
            header("Location: http://localhost:8000/signup.php");
        } else {
            echo "<br>User must have sent wrong inputs\n";
        }
    }
}

?>
