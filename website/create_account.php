<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <style>
    .status-card {
      position: fixed;
      top: 10%;
      right: 10%;
      background-color: #F5F5F5;
      border: 1px solid #E0E0E0;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      display: none;
      z-index: 1000;
      max-width: 400px;
      width: 90%;
      margin: 0 auto;
      text-align: center;
      transition: all 0.3s ease-in-out;
    }

    .status-message.success {
      color: green;
    }

    .status-message.error {
      color: red;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="body-login">
    <div class="card-login">
      <h3>Criar sua conta</h3>
      <form id="signupForm" action="user.php" method="post">
        <div class="form-group">
          <label for="name">Nome de Usuario:</label>
          <input type="text" id="name" name="name" required oninput="validarNome()">
            <span id="nameError" style="color: red;"></span>
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" placeholder="joao@example.com" id="email" name="email" required>
          <span id="emailError" style="color: red;"></span>
        </div>
        <div class="form-group">
          <label for="password">Senha:</label>
          <input type="password" id="password" name="password" required oninput="validarSenha()">
          <span id="passwordError" style="color: red;"></span>
        </div>
        <button type="submit" class="btn-login">Criar conta</button>
        <p class="p-no-account">Já tem uma conta?</p>
        <a href="login.php" class="no-account">Entre agora</a>
      </form>
    </div>
  </div>
</div>

<div id="statusCard" class="status-card">
  <p id="statusMessage" class="status-message"></p>
</div>
</body>
</html>
<script>
  function validarNome() {
    var nameInput = document.getElementById("name");
    var nameError = document.getElementById("nameError");
    var name = nameInput.value.trim().replace(/\s{2,}/g, ' '); // Remove espaços em branco extras e limpa os espaços em branco do início e do fim

    if (name.length === 0 || name.length < 4 || name.length > 20) {
      nameError.textContent = "O nome deve ter entre 4 e 20 caracteres.";
      return false; // Retorna false se o nome não atender aos critérios
    } else {
      nameError.textContent = "";
      nameInput.value = name; // Atualiza o valor do campo de entrada com o nome limpo
      return true; // Retorna true se o nome atender aos critérios
    }
  }

  function validarSenha() {
    var passwordInput = document.getElementById("password");
    var passwordError = document.getElementById("passwordError");
    var password = passwordInput.value.trim(); // Remove espaços em branco do início e do fim

    if (password.length === 0) {
      passwordError.textContent = "A senha não pode estar em branco.";
      return false; // Retorna false se a senha estiver em branco
    } else if (password.length < 8) {
      passwordError.textContent = "A senha deve ter pelo menos 8 caracteres.";
      return false; // Retorna false se a senha não atender aos critérios
    } else {
      passwordError.textContent = "";
      passwordInput.value = password; // Atualiza o valor do campo de entrada com a senha limpa
      return true; // Retorna true se a senha atender aos critérios
    }
  }

  document.getElementById("signupForm").addEventListener("submit", function (event) {
    var isPasswordValid = validarSenha();
    var isNameValid = validarNome();

    if (!isPasswordValid || !isNameValid) {
      event.preventDefault(); // Impede o envio do formulário se a senha ou o nome não forem válidos
      return; // Para a execução da função
    }

    event.preventDefault(); // Evita que o formulário seja enviado normalmente

    var formData = new FormData(this);

    fetch('user.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        var statusCard = document.getElementById("statusCard");
        var statusMessage = document.getElementById("statusMessage");

        statusMessage.classList.remove("success"); // Remove existing classes
        statusMessage.classList.remove("error");

        statusMessage.textContent = data.message;
        statusMessage.classList.add(data.success ? "success" : "error");

        statusCard.style.display = "block";

        setTimeout(function() {
          statusCard.style.display = "none";
          if (data.success) {
            window.location.href = "index.php"; // Redireciona após 3 segundos
          }
        }, 3000);
      })
      .catch(error => console.error('Error:', error));
  });
</script>

