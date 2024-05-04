<?php



$conn = mysqli_connect("localhost", "root", "", "db_site");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} 
