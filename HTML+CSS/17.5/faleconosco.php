<?php
session_start();

/* ======================
   ENVIO DO FORMULÁRIO
====================== */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mensagem = "Sua mensagem foi enviada com sucesso!";
    $tipoMensagem = "sucesso";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Fale Conosco - Corujoteca</title>

<link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">

<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

<style>

/* ======================
   VARIÁVEIS
====================== */
:root {
  --branco: #ffffff;
  --rosa-escuro: #ec95c1;
  --creme: #fcfcec;
  --marrom: #79564d;
  --marrom-claro: #8d6d52;
  --marrom-escuro: #57362e;
  --cinza: #666;
}

/* ======================
   BASE
====================== */
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

/* ======================
   BOTÃO VOLTAR
====================== */
.back-button {
  position: fixed;

  top: 25px;
  left: 25px;

  display: flex;
  align-items: center;
  justify-content: center;

  background-color: var(--marrom-escuro);

  color: white;

  width: 52px;
  height: 52px;

  border-radius: 50%;

  text-decoration: none;

  font-size: 1.6rem;

  box-shadow: 0 4px 10px rgba(0,0,0,0.15);

  transition: 0.3s;

  z-index: 999;
}

.back-button:hover {
  background-color: var(--rosa-escuro);

  transform: scale(1.05);
}

/* ======================
   CONTAINER PRINCIPAL
====================== */
.container {
  max-width: 1200px;

  width: 100%;

  margin: 80px auto;

  display: grid;

  grid-template-columns: 1fr 1fr;

  gap: 35px;

  padding: 0 20px;

  box-sizing: border-box;
}

/* ======================
   FORMULÁRIO
====================== */
.formulario {
  background-color: white;

  padding: 40px;

  border-radius: 20px;

  box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.formulario h1 {
  color: var(--marrom-escuro);

  margin-bottom: 30px;

  font-size: 38px;

  border-bottom: 3px solid var(--rosa-escuro);

  display: inline-block;

  padding-bottom: 8px;
}

form {
  display: flex;
  flex-direction: column;

  gap: 18px;
}

label {
  font-weight: bold;

  color: var(--marrom);
}

input,
textarea {
  border: 1px solid #ccc;

  border-radius: 10px;

  padding: 14px;

  font-size: 15px;

  transition: 0.3s;
}

input:focus,
textarea:focus {
  border-color: var(--rosa-escuro);

  box-shadow: 0 0 8px rgba(236,149,193,0.2);

  outline: none;
}

textarea {
  resize: none;

  height: 160px;
}

/* ======================
   BOTÃO
====================== */
button {
  background-color: var(--marrom-escuro);

  color: white;

  border: none;

  border-radius: 10px;

  padding: 14px;

  font-size: 16px;

  cursor: pointer;

  transition: 0.3s;

  margin-top: 10px;
}

button:hover {
  background-color: var(--rosa-escuro);
}

/* ======================
   CONTATO
====================== */
.contato {
  background-color: white;

  padding: 40px;

  border-radius: 20px;

  box-shadow: 0 10px 25px rgba(0,0,0,0.08);

  display: flex;
  flex-direction: column;
  justify-content: center;
}

.contato h2 {
  color: var(--marrom-escuro);

  font-size: 34px;

  margin-bottom: 25px;

  border-bottom: 3px solid var(--rosa-escuro);

  display: inline-block;

  padding-bottom: 8px;
}

.contato p {
  color: var(--cinza);

  font-size: 17px;

  line-height: 1.8;

  margin: 12px 0;
}

/* ======================
   MENSAGEM
====================== */
.mensagem {
  position: fixed;

  top: 20px;
  left: 50%;

  transform: translateX(-50%);

  padding: 1rem 2rem;

  border-radius: 8px;

  color: white;

  font-weight: 500;

  z-index: 1000;

  animation: aparecer 0.5s ease forwards;
}

.sucesso {
  background-color: var(--marrom-escuro);
}

@keyframes aparecer {

  from {
    opacity: 0;
    top: 0;
  }

  to {
    opacity: 1;
    top: 20px;
  }

}

/* ======================
   RESPONSIVO
====================== */
@media (max-width: 900px) {

  .container {
    grid-template-columns: 1fr;
  }

  .formulario,
  .contato {
    padding: 30px;
  }

}

</style>
</head>

<body>

<!-- BOTÃO VOLTAR -->
<a href="index.php" class="back-button">
  <i class='bx bx-arrow-back'></i>
</a>

<!-- MENSAGEM -->
<?php if (!empty($mensagem)): ?>

  <div class="mensagem <?= $tipoMensagem; ?>" id="mensagemAviso">
    <?= htmlspecialchars($mensagem); ?>
  </div>

  <script>

    setTimeout(() => {

      const msg =
        document.getElementById('mensagemAviso');

      if (msg) {
        msg.style.display = 'none';
      }

    }, 4000);

  </script>

<?php endif; ?>

<!-- CONTAINER -->
<div class="container">

  <!-- FORMULÁRIO -->
  <div class="formulario">

    <h1>Fale Conosco</h1>

    <form method="POST" action="">

      <label for="nome">
        Nome
      </label>

      <input
        type="text"
        id="nome"
        name="nome"
        required
      >

      <label for="email">
        E-mail
      </label>

      <input
        type="email"
        id="email"
        name="email"
        required
      >

      <label for="assunto">
        Assunto
      </label>

      <input
        type="text"
        id="assunto"
        name="assunto"
        required
      >

      <label for="mensagem">
        Mensagem
      </label>

      <textarea
        id="mensagem"
        name="mensagem"
        required
      ></textarea>

      <button type="submit">
        Enviar mensagem
      </button>

    </form>

  </div>

  <!-- CONTATO -->
  <div class="contato">

    <h2>Contato</h2>

    <p>
      Rua das Corujas, 245 - Centro, São Paulo - SP
    </p>

    <p>
      (11) 98765-4321
    </p>

    <p>
      contato@corujoteca.com
    </p>

    <p>
      Atendimento de segunda a sexta-feira,
      das 08h às 18h.
    </p>

    <p>
      Nossa equipe está preparada para ajudar
      você com dúvidas, sugestões ou informações
      sobre nossos serviços.
    </p>

  </div>

</div>

</body>
</html>