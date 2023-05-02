<?php
include('config/db_config.php');

// Establish a connection to the PostgreSQL database using PDO
try {
  $pdo = new PDO('pgsql:host='.DB_HOST.';dbname='.DB_NAME.';user='.DB_USER.';password='.DB_PASSWORD);
  // Set PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully to the PostgreSQL database";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>