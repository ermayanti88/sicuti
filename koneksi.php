<?php
  // Error reporting
  error_reporting(E_ERROR | E_WARNING | E_PARSE);

  // Database connection
  $dbhost = "localhost";
  $dbuser = "app";
  $dbpass = "serverDB9090";
  $dbname = "sicuti";

  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Check connection
  if (!$conn) {
      die("Tidak dapat terhubung ke database: " . mysqli_connect_error());
  }
?>