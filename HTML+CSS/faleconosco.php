<?php
// Inicia a sessão para acessar dados do usuário (caso necessário futuramente)
session_start();

/* VERIFICA SE O FORMULÁRIO FOI ENVIADO */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Define mensagem de sucesso (não salva em banco, apenas feedback visual)
    $mensagem = "Sua mensagem foi enviada!";
    $tipoMensagem = "sucesso";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">

  <!-- Responsividade para dispositivos móveis -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Fale Conosco - Biblioteca Online</title>

  <!-- Favicon do site -->
  <link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">

  <!-- Ícones Boxicons -->
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

  <style>
  /* VARIÁVEIS DE CORES DO SISTEMA */
  :root {
    --branco: #ffffff;
    --rosa-escuro: #ec95c1;
    --creme: #fcfcec;
    --marrom: #79564d;
    --marrom-claro: #8d6d52;
    --marrom-escuro: #57362e;
  }

  /* ESTILO GERAL DA PÁGINA */
  html, body {
    margin: 0;
    padding: 0;
    font-family: "Segoe UI", Arial, sans-serif;
    background-color: var(--creme);
    color: #222;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  /* CONTAINER PRINCIPAL DO FORMULÁRIO */
  main {
    width: 100%;
    max-width: 600px;
    margin: 60px auto;
    background-color: var(--branco);
    border-radius: 20px;
    box-shadow: 0px 10px 25px rgba(0,0,0,0.2);
    padding: 40px 90px;
  }

  /* TÍTULO */
  h1 {
    color: var(--rosa-escuro);
    text-align: center;
    margin-bottom: 30px;
    border-bottom: 3px solid var(--marrom-escuro);
    display: inline-block;
    padding-bottom: 8px;
  }

  /* FORMULÁRIO EM COLUNA */
  form {
    display: flex;
    flex-direction: column;
    gap: 18px;
  }

  /* LABEL DOS CAMPOS */
  label {
    font-weight: bold;
    color: var(--marrom);
  }

  /* CAMPOS INPUT E TEXTAREA */
  input, textarea {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 12px;
    font-size: 16px;
    width: 100%;
    transition: 0.3s;
  }

  /* EFEITO AO FOCAR NOS CAMPOS */
  input:focus, textarea:focus {
    border-color: var(--marrom-escuro);
    box-shadow: 0 0 8px rgba(191,161,74,0.3);
    outline: none;
  }

  /* TEXTAREA PERSONALIZADO */
  textarea {
    height: 140px;
    resize: none;
  }

  /* BOTÃO DE ENVIAR */
  button {
    background-color: var(--marrom);
    color: var(--branco);
    border: none;
    border-radius: 8px;
    padding: 14px;
    font-size: 17px;
    cursor: pointer;
    transition: 0.3s;
    width: 220px;
    align-self: center;
  }

  /* HOVER DO BOTÃO */
  button:hover {
    background-color: var(--rosa-escuro);
  }

  /* MENSAGEM DE FEEDBACK */
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

  /* MENSAGEM DE SUCESSO */
  .mensagem.sucesso {
    background-color: var(--marrom-escuro);
  }

  /* MENSAGEM DE ERRO */
  .mensagem.erro {
    background-color: #b33a3a;
  }

  /* ANIMAÇÃO DA MENSAGEM */
  @keyframes slideDown {
      from { top: 0; opacity: 0; }
      to { top: 20px; opacity: 1; }
  }

  /* BOTÃO DE VOLTAR FIXO */
  .back-button {
    position: fixed;
    top: 25px;
    left: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--marrom-escuro);
    color: var(--branco);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    text-decoration: none;
    font-size: 1.6rem;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
    z-index: 200;
  }

  /* HOVER DO BOTÃO VOLTAR */
  .back-button:hover {
    background-color: var(--rosa-escuro);
    transform: scale(1.05);
  }
  </style>
</head>

<body>

<!-- BOTÃO DE VOLTAR -->
<a href="index.php" class="back-button">
  <i class='bx bx-arrow-back'></i>
</a>

<!-- MENSAGEM DE FEEDBACK -->
<?php if (!empty($mensagem)): ?>
  <div class="mensagem <?= $tipoMensagem; ?>" id="mensagemAviso">
      <?= htmlspecialchars($mensagem); ?>
  </div>

  <!-- SCRIPT PARA SUMIR COM A MENSAGEM APÓS 4 SEGUNDOS -->
  <script>
      setTimeout(() => {
          const msg = document.getElementById('mensagemAviso');
          if (msg) msg.style.display = 'none';
      }, 4000);
  </script>
<?php endif; ?>

<!-- CONTEÚDO PRINCIPAL -->
<main>
  <h1>Fale Conosco</h1>

  <!-- FORMULÁRIO DE CONTATO -->
  <form method="POST" action="">

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required>

    <label for="assunto">Assunto:</label>
    <input type="text" id="assunto" name="assunto" required>

    <label for="mensagem">Mensagem:</label>
    <textarea id="mensagem" name="mensagem" required></textarea>

    <button type="submit">Enviar</button>

  </form>
</main>

</body>
</html>