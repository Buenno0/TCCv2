<?php
require_once("config.php");

function checkEmail($email) {
    global $conn;
    
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    
    if ($user) {
        return true; // Retorna true se o e-mail já estiver cadastrado
    } else {
        return false; // Retorna false se o e-mail não estiver cadastrado
    }
}