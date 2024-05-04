<?php
require_once("config.php");

function get_user_by_id($id) {
  global $conn;

  $sql = "SELECT * FROM user WHERE id = 2";
  
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    
    return $user;

    
}