<?php

require_once "config.php";

$name = $_POST["name"];
$password = $_POST["password"];
$email = $_POST["email"];
$id = 2;

// Prepare and bind the SQL statement
$sql = "UPDATE user SET name=?, password=?, email=? WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);

// Bind parameters
mysqli_stmt_bind_param($stmt, "sssi", $name, $password, $email, $id);

// Execute the statement
$result = mysqli_stmt_execute($stmt);

if ($result) {
    echo "User updated successfully.";
} else {
    echo "Error updating user: " . mysqli_error($conn);
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
