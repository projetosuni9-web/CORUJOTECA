<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar Senha</title>
  <link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

  <style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap");

    :root {
      --azul-escuro: #1e3a5f;
      --azul-claro: #f2f6fa;
      --cinza: #6b6b6b;
      --branco: #ffffff;
      --dourado: #bfa14a;
      --creme: #fcfcec;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Roboto', sans-serif;
      background-color: var(--creme);
      color: var(--azul-escuro);
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
      position: relative;
    }

    a {
      text-decoration: none;
      color: var(--azul-escuro);
    }

    /* ======= FORMULÁRIO ======= */
    .form__content {
      width: 320px;
      text-align: center;
      background-color: var(--branco);
      border: 2px solid var(--azul-escuro);
      border-radius: 12px;
      padding: 2rem 1.5rem;
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
      margin-top: 4rem;
    }

    .form__title {
      font-size: 1.8rem;
      color: var(--azul-escuro);
      margin-bottom: 2rem;
    }

    .form__div {
      position: relative;
      display: grid;
      grid-template-columns: 10% 90%;
      margin-bottom: 1.5rem;
      padding: .25rem 0;
      border-bottom: 1px solid var(--cinza);
    }

    .form__icon {
      font-size: 1.5rem;
      color: var(--dourado);
    }

    .form__input {
      width: 100%;
      border: none;
      outline: none;
      background: none;
      padding: .5rem .75rem;
      font-size: 1rem;
      color: var(--azul-escuro);
    }

    .form__label {
      position: absolute;
      left: 2.5rem;
      top: .3rem;
      font-size: .95rem;
      color: var(--cinza);
      transition: .3s;
      pointer-events: none;
    }

    .form__input:focus + .form__label,
    .form__input:not(:placeholder-shown) + .form__label {
      top: -1.2rem;
      font-size: .85rem;
      color: var(--dourado);
    }

    .form__button {
      width: 100%;
      padding: 0.9rem;
      border: none;
      background-color: var(--azul-escuro);
      color: var(--branco);
      border-radius: .5rem;
      cursor: pointer;
      font-size: 1rem;
      font-weight: 500;
      transition: 0.3s;
    }

    .form__button:hover {
      background-color: var(--dourado);
      color: var(--azul-escuro);
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    /* ======= MENSAGEM (IGUAL À DO LOGIN) ======= */
    .mensagem {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      padding: 1rem 2rem;
      border-radius: 6px;
      color: var(--branco);
      font-weight: 500;
      font-size: 1rem;
      z-index: 1000;
      opacity: 0;
      animation: slideDown 0.6s forwards;
    }

    .mensagem.sucesso {
      background-color: var(--dourado);
    }

    @keyframes slideDown {
      from { top: 0; opacity: 0; }
      to { top: 20px; opacity: 1; }
    }

    /* ======= BOTÃO DE VOLTAR ======= */
    .back-button {
      position: absolute;
      top: 1rem;
      left: 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: var(--dourado);
      color: var(--branco);
      width: 45px;
      height: 45px;
      border-radius: 50%;
      text-decoration: none;
      font-size: 1.2rem;
      transition: 0.3s;
    }

    .back-button:hover {
      background-color: var(--azul-escuro);
    }
  </style>
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
