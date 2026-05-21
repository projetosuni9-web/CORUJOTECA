<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar Senha</title>
  <link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

  

    <link rel="stylesheet" href="esq_senha.css">
</head>

<body>
  <!-- 🔙 BOTÃO DE VOLTAR -->
  <a href="login.php" class="back-button"><i class='bx bx-arrow-back'></i></a>

  <!-- 💬 MENSAGEM DE EMAIL ENVIADO -->
  <div id="mensagem" class="mensagem sucesso" style="display: none;">Email enviado com sucesso!</div>

  <!-- ======= FORMULÁRIO ======= -->
  <div class="form__content">
    <h1 class="form__title">Recuperar Senha</h1>

    <form id="recuperarForm">
      <div class="form__div">
        <div class="form__icon"><i class='bx bx-user-circle'></i></div>
        <div>
          <input type="email" id="email" name="email" class="form__input" placeholder=" " required autocomplete="off">
          <label class="form__label">Digite seu E-mail</label>
        </div>
      </div>

      <button type="submit" class="form__button">Recuperar</button>
    </form>
  </div>

  <script>
    // Simula envio e exibe mensagem igual à do login
    document.getElementById('recuperarForm').addEventListener('submit', function (e) {
      e.preventDefault();

      const mensagem = document.getElementById('mensagem');
      mensagem.style.display = 'block';

      setTimeout(() => {
        mensagem.style.opacity = '1';
      }, 100);

      setTimeout(() => {
        mensagem.style.display = 'none';
      }, 4000);
    });
  </script>
</body>
</html>
