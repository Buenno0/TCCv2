function validarSenha() {
    var passwordInput = document.getElementById("password");
    var passwordError = document.getElementById("passwordError");
    var password = passwordInput.value;

    if (password.length < 8) {
      passwordError.textContent = "A senha deve ter pelo menos 8 caracteres.";
      return false; // Retorna false se a senha não atender aos critérios
    } else {
      passwordError.textContent = "";
      return true; // Retorna true se a senha atender aos critérios
    }
  }

  document.getElementById("signupForm").addEventListener("submit", function (event) {
    var isPasswordValid = validarSenha(); // Verifica se a senha é válida

    if (!isPasswordValid) {
      event.preventDefault(); // Impede o envio do formulário se a senha não for válida
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