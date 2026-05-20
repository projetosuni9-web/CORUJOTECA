<?php
session_start();

// ======================
// CONEXÃO COM O BANCO
// ======================
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bancoBiblioteca";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

// ======================
// BUSCA LIVROS NO BANCO
// ======================
$sql = "SELECT id, titulo, autor, imagem FROM livros";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca Online</title>

  <!-- ÍCONE DO SITE -->
  <link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">

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
   ESTILO GLOBAL
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

main {
  flex: 1;
}

/* ======================
   CABEÇALHO
====================== */
header {
  background-color: #342424;

  /* sombra inferior */
  box-shadow: 0 3px 0 var(--rosa-escuro);

  padding: 10px 40px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: sticky;
  top: 0;
  z-index: 100;
}

header .logo img {
  height: 80px;
}

/* ÍCONES DO HEADER */
.icons {
  display: flex;
  align-items: center;
  gap: 25px;
}

.icon img {
  height: 22px;
  cursor: pointer;
  opacity: 0.7;
  transition: opacity 0.3s ease;
}

.icon img:hover {
  opacity: 1;
}

/* ======================
   BARRA DE PESQUISA
====================== */
.search-bar {
  display: flex;
  align-items: center;
  background-color: var(--azul-claro);
  border: 1px solid var(--marrom-escuro);
  border-radius: 20px;
  padding: 5px 10px;
  transition: width 0.4s ease, opacity 0.3s ease;
  width: 0;
  opacity: 0;
  pointer-events: none;
}

#iconContainer.ativo .search-bar {
  width: 220px;
  opacity: 1;
  pointer-events: auto;
}

.search-bar input {
  width: 100%;
  border: none;
  background: transparent;
  outline: none;
  font-size: 14px;
}

/* ======================
   MENU DO USUÁRIO
====================== */
.user-menu {
  position: relative;
}

.user-menu img {
  border-radius: 50%;
  border: 2px solid var(--marrom-escuro);
  cursor: pointer;
}

.dropdown {
  display: none;
  position: absolute;
  right: 0;
  top: 50px;
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 6px;
  box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
  min-width: 160px;
  z-index: 9999;
}

.dropdown a {
  display: block;
  padding: 10px 15px;
  color: #222;
  text-decoration: none;
  font-size: 14px;
  border-bottom: 1px solid #eee;
}

.dropdown a:last-child {
  border-bottom: none;
}

.dropdown a:hover {
  background-color: #f5f5f5;
}

/* ======================
   CONTEÚDO PRINCIPAL
====================== */
.conteudo {
  max-width: 1200px;
  margin: 40px auto 20px;
  padding: 0 20px;
}

.destaque img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 16px;
  transition: transform 0.3s ease, filter 0.3s ease;
}

.destaque img:hover {
  transform: scale(1.02);
  filter: brightness(0.95);
}

.titulo-catalogo {
  text-align: left;
  font-size: 40px;
  font-weight: bold;
  color: var(--azul-escuro);
  margin-top: 25px;
}

/* ======================
   LISTA DE LIVROS
====================== */
.wrapper {
  display: flex;
  justify-content: center;
  padding: 30px 20px;
}

.container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
  max-width: 1200px;
  width: 100%;
}

.cartao {
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 10px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  box-shadow: 0 3px 6px rgba(0,0,0,0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.cartao:hover {
  transform: translateY(-4px);
  box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

.cartao .imagem {
  width: 100%;
  height: 400px;
  object-fit: cover;
  background-color: #eee;
}

.conteudo-livro {
  padding: 15px 20px 20px;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

/* título do livro */
.conteudo-livro h2 {
  font-size: 18px;
  margin: 0 0 10px;
}

.conteudo-livro p {
  font-size: 14px;
  flex: 1;
}

.botao {
  background-color: var(--marrom-escuro);
  color: white;
  border: none;
  border-radius: 4px;
  padding: 8px;
  font-size: 14px;
  cursor: pointer;
  transition: background 0.3s ease;
  text-decoration: none;
  display: inline-block;
  text-align: center;
}

.botao:hover {
  background-color: var(--rosa-escuro);
}

/* ======================
   RODAPÉ
====================== */
footer {
  background-color: var(--marrom-escuro);
  color: white;
  padding: 40px 20px;
  margin-top: 50px;
}

#footer_content {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  gap: 30px;
  max-width: 1200px;
  margin: auto;
}

#footer_logo img {
  max-width: 180px;
}

.footer_column {
  min-width: 200px;
}

.footer_list {
  list-style: none;
  padding: 0;
}

.footer_list h3 {
  margin-bottom: 10px;
  color: var(--rosa-escuro);
  font-size: 18px;
}

.footer_link {
  text-decoration: none;
  color: white;
  font-size: 14px;
  display: block;
  margin: 5px 0;
  transition: color 0.3s ease;
}

.footer_link:hover {
  color: var(--rosa-escuro);
}

#footer_instagram a {
  color: var(--rosa-escuro);
  text-decoration: none;
}

#footer_instagram a:hover {
  text-decoration: underline;
}

/* ======================
   RESPONSIVIDADE
====================== */
@media (max-width: 900px) {
  .container {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 600px) {
  .container {
    grid-template-columns: 1fr;
  }
}
</style>
</head>

<body>

<!-- CABEÇALHO -->
<header>
  <div class="logo">
   <img src="img/logoNova.png" alt="Logo da Biblioteca - Cabeçalho">
  </div>

  <div class="icons" id="iconContainer">

    <!-- LUPA -->
    <div class="icon" onclick="abrirPesquisa()">
      <img src="img/lupa.png" alt="Lupa">
    </div>

    <!-- PESQUISA -->
    <div class="search-bar" id="barra-pesquisa">
      <form action="pesquisar.php" method="GET" onsubmit="return validarPesquisa()">
        <input type="text" name="q" id="campoPesquisa" placeholder="Pesquisar livros..." required>
      </form>
    </div>

    <!-- USUÁRIO -->
    <div class="user-menu">
      <img src="img/foto_perfil.png" height="40" alt="Perfil" id="userIcon">

      <div class="dropdown" id="dropdownMenu">
        <?php if (!isset($_SESSION['cpf'])): ?>
            <a href="login.php">Login</a>
            <a href="cadastro.php">Cadastro</a>
        <?php else: ?>
          <?php if ($_SESSION['tipo'] === 'admin'): ?>
                <a href="adm.php">Administração</a>
          <?php endif; ?>
            <a href="logout.php">Sair</a>
        <?php endif; ?>
      </div>
    </div>

  </div>
</header>

<!-- CONTEÚDO -->
<main>
  <div class="conteudo">
    <div class="destaque">
      <a href="https://forms.gle/LWcKoUD6jVZH2fcV6">
        <img src="img/bannerCorujoteca.png" alt="Banner Catálogo">
      </a>
      <p class="titulo-catalogo">Catálogo:</p>
    </div>
  </div>
</main>

<!-- LISTA DE LIVROS -->
<div class="wrapper">
  <div class="container">

    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $id = isset($row['id']) ? (int)$row['id'] : 0;
            $imagemPath = !empty($row['imagem']) ? 'fotos/' . htmlspecialchars($row['imagem']) : 'img/capa_padrao.png';

            echo '<div class="cartao">';
            echo '<img src="' . $imagemPath . '" alt="Imagem do livro" class="imagem">';
            echo '<div class="conteudo-livro">';
            echo '<h2 class="titulo">' . htmlspecialchars($row['titulo']) . '</h2>';
            echo '<p class="autor">' . htmlspecialchars($row['autor']) . '</p>';
            echo '<a href="livro.php?id=' . urlencode($id) . '" class="botao">Ver detalhes</a>';
            echo '</div></div>';
        }
    } else {
        echo '<p>Nenhum livro encontrado.</p>';
    }

    $conn->close();
    ?>

  </div>
</div>

<!-- RODAPÉ -->
<footer>
  <div id="footer_content">
    <div id="footer_logo" class="footer_column">
      <img src="img/CORUJOTECA.png" alt="Logo da Biblioteca - Rodapé">
    </div>

    <ul class="footer_list footer_column">
      <li><h3>Fale conosco</h3></li>
      <li><a href="faleconosco.php" class="footer_link">Fale conosco</a></li>
      <li><a href="sobrenos.php" class="footer_link">Sobre nós</a></li>
    </ul>

    <ul class="footer_list footer_column">
      <li><h3>Recursos</h3></li>
      <li><a href="index.php" class="footer_link">Página inicial</a></li>
    </ul>

    <ul class="footer_list footer_column">
      <li><h3>Conta</h3></li>
      <li><a href="login.php" class="footer_link">Login</a></li>
      <li><a href="cadastro.php" class="footer_link">Cadastro</a></li>
    </ul>
  </div>
</footer>

<!-- SCRIPTS -->
<script>
function abrirPesquisa() {
  const iconsContainer = document.getElementById('iconContainer');
  const campo = document.getElementById('campoPesquisa');

  iconsContainer.classList.toggle('ativo');

  if (iconsContainer.classList.contains('ativo')) {
    setTimeout(() => campo.focus(), 250);
  }
}

document.addEventListener('click', function (e) {
  const iconsContainer = document.getElementById('iconContainer');
  const barra = document.getElementById('barra-pesquisa');
  const lupa = iconsContainer.querySelector('.icon img');

  if (!barra.contains(e.target) && !lupa.contains(e.target)) {
    iconsContainer.classList.remove('ativo');
  }
});

function validarPesquisa() {
  const campo = document.getElementById('campoPesquisa');
  if (campo.value.trim() === "") {
    campo.focus();
    return false;
  }
  return true;
}

document.addEventListener("DOMContentLoaded", function() {
  const userIcon = document.getElementById("userIcon");
  const dropdownMenu = document.getElementById("dropdownMenu");

  userIcon.addEventListener("click", function() {
      dropdownMenu.style.display =
          dropdownMenu.style.display === "block" ? "none" : "block";
  });

  document.addEventListener("click", function(event) {
      if (!userIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
          dropdownMenu.style.display = "none";
      }
  });
});
</script>

</body>
</html>