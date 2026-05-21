<?php
session_start();
include 'conexao.php';

// ======================
// VERIFICA SE ID FOI ENVIADO
// ======================
if (!isset($_GET['id'])) {
  die("Livro não especificado.");
}

// ======================
// BUSCA DO LIVRO NO BANCO
// ======================
$id = intval($_GET['id']);
$sql = "SELECT * FROM livros WHERE id = $id";
$result = $conn->query($sql);

// Se não encontrar o livro
if ($result->num_rows === 0) {
  die("Livro não encontrado.");
}

// pega dados do livro
$livro = $result->fetch_assoc();

// fecha conexão com banco
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- TÍTULO DINÂMICO -->
<title><?php echo htmlspecialchars($livro['titulo']); ?> - Biblioteca</title>

<!-- FAVICON -->
<link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">

<!-- ÍCONES -->
<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>



    <link rel="stylesheet" href="livro.css">
</head>

<body>

<!-- BOTÃO VOLTAR -->
<a href="javascript:history.back()" class="back-button">
    <i class='bx bx-arrow-back'></i>
</a>

<!-- CONTEÚDO -->
<main>

  <!-- CAPA DO LIVRO -->
  <div class="livro-capa">
    <img src="fotos/<?php echo htmlspecialchars($livro['imagem']); ?>" alt="Capa do livro">
  </div>

  <!-- INFO DO LIVRO -->
  <div class="livro-info">

    <h1><?php echo htmlspecialchars($livro['titulo']); ?></h1>

    <!-- autor (opcional) -->
    <?php if (!empty($livro['autor'])): ?>
      <h3><?php echo htmlspecialchars($livro['autor']); ?></h3>
    <?php endif; ?>

    <!-- descrição -->
    <p><?php echo nl2br(htmlspecialchars($livro['descricao'])); ?></p>

    <!-- FORM DE ALUGUEL -->
    <form action="solicitar.php" method="POST">
      <input type="hidden" name="id_livro" value="<?php echo $livro['id']; ?>">
      <button type="submit" class="botao">Solicitar Aluguel</button>
    </form>

  </div>

</main>

</body>
</html>