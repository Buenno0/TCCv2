<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
</head>
<body>
<div class="container">
   
<div class="body-login">
    <div class="card-login">
        <h3>Entrar em sua conta</h3>
        <form action="user-login.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" placeholder="joao@example.comn" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">Entrar</button>
            <p class="p-no-account">Ainda não tem conta?</p>
            <a href="create_account.php" class="no-account">Crie agora</a>
        </form>
    </div>
</div>
</body>
</html>