<?php
  // memulai session
  session_start();
  // menghancurkan session
  $_SESSION['login_user'] = '';
  $logout = session_destroy();
  if($logout) {
    // mengarahkan ke halaman login.php
    header("location: index.php");
  }