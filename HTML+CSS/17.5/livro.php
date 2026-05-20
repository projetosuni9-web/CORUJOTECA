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

<style>

/* ======================
   VARIÁVEIS DE COR
====================== */
:root {
  --rosa-escuro: #ec95c1;
  --creme: #fcfcec;
  --marrom: #79564d;
  --marrom-claro: #8d6d52;
  --marrom-escuro: #57362e;
}

/* ======================
   BASE DA PÁGINA
====================== */
body {
  font-family: "Segoe UI", Arial, sans-serif;
  background-color: var(--creme);
  margin: 0;
  color: #222;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

/* ======================
   BOTÃO VOLTAR
====================== */
.back-button {
    position: fixed;
    top: 20px;
    left: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--marrom-escuro);
    color: white;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    text-decoration: none;
    font-size: 1.3rem;
    transition: 0.3s;
    z-index: 999;
}

.back-button:hover {
    background-color: var(--rosa-escuro);
    transform: scale(1.05);
}

/* ======================
   CONTEÚDO PRINCIPAL
====================== */
main {
  flex: 1;
  max-width: 1000px;
  margin: 80px auto 40px;
  background: white;
  border-radius: 12px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.1);
  padding: 30px;
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
}

/* ======================
   CAPA DO LIVRO
====================== */
.livro-capa {
  flex: 1 1 300px;
}

.livro-capa img {
  width: 100%;
  border-radius: 10px;
  object-fit: cover;
}

/* ======================
   INFORMAÇÕES DO LIVRO
====================== */
.livro-info {
  flex: 2 1 400px;
}

.livro-info h1 {
  font-size: 28px;
  color: var(--marrom-escuro);
  margin-bottom: 10px;
}

.livro-info h3 {
  color: var(--rosa-escuro);
  margin-top: 0;
}

.livro-info p {
  font-size: 15px;
  line-height: 1.6;
  color: #555;
}

/* ======================
   BOTÃO SOLICITAR
====================== */
.botao {
  display: inline-block;
  margin-top: 20px;
  background-color: var(--marrom-escuro);
  color: white;
  border: none;
  border-radius: 6px;
  padding: 10px 20px;
  font-size: 15px;
  text-decoration: none;
  cursor: pointer;
  transition: 0.3s;
}

.botao:hover {
  background-color: var(--rosa-escuro);
}

/* ======================
   RESPONSIVO
====================== */
@media (max-width: 768px) {
  main {
    flex-direction: column;
    text-align: center;
  }
}
</style>
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