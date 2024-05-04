<?php
require_once("config.php");

function login_user($email, $password) {
    global $conn;
    
    $sql = "SELECT id, name, password FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name, $hashed_password);
    mysqli_stmt_fetch($stmt);

    if (password_verify($password, $hashed_password)) {
        session_start();
        $_SESSION["user_id"] = $id;
        $_SESSION["user_name"] = $name;
        mysqli_stmt_close($stmt);
        return true;
    } else {
        mysqli_stmt_close($stmt);
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (login_user($email, $password)) {
        echo "Login successful. Welcome, " . $_SESSION["user_name"] . ".";
        exit();
    } else {
        echo "Login failed. Please check your email and password.";
    }
}
?>
