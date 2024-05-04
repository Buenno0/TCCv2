<?php
require_once("config.php");


function get_all_users() {
  global $conn;

  $sql = "SELECT * FROM user";
  $result = mysqli_query($conn, $sql);
  $users = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
  }
  mysqli_free_result($result);

  return $users;
}
