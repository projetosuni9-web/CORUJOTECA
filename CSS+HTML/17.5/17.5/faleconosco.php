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



    <link rel="stylesheet" href="faleconosco.css">
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