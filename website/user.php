<?php
require_once("config.php");


function email_is_valid($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
    
}


function check_email($email) {
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

function create_user($name, $password, $email) {
    global $conn;
    
    
    $sql = "INSERT INTO user (name, password, email) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $name, $hashed_password, $email);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return true; // Retorna true se o usuário foi criado com sucesso
    } else {
        mysqli_stmt_close($stmt);
        return false; // Retorna false se houver um erro ao criar o usuário
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $response = array();

    if (!email_is_valid($email)) {
        $response['success'] = false;
        $response['message'] = "E-mail inválido.";
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    
    if (check_email($email)) {
        $response['success'] = false;
        $response['message'] = "E-mail já cadastrado.";
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    if (create_user($name, $password, $email)) {
        $response['success'] = true;
        $response['message'] = "Usuário criado com sucesso!";
    } else {
        $response['success'] = false;
        $response['message'] = "Erro ao criar usuário.";
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>
