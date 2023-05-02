<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Login</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<body>
    <div class="container">
        <h2>Login</h2>
<form action="/login.php" method="post">
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
    $user_authentication = pg_query($dbconn, "select * from users where username='".$username."' and password='".$password."'");
    
    $user = pg_fetch_all($user_authentication);
    foreach($user as  $value){
        session_start();
        $_SESSION['user_id'] = $value['id'];
        $_SESSION['first_name'] = $value['first_name'];
        $_SESSION['last_name'] = $value['last_name'];
        $_SESSION['username'] = $value['username'];
        header("Location: /");
    }
    if(count($user) == 0){
        echo "No active account found with the given credentials";
    }
}
?>