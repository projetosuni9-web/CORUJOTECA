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

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

// ======================
// BUSCA LIVROS
// ======================
$sql = "SELECT id, titulo, autor, imagem FROM livros";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corujoteca - Biblioteca Online</title>
    <link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">

    

    <link rel="stylesheet" href="index.css">
</head>

<body>

<header>
    <div class="logo-area">
        <div class="logo"><img src="img/logoNova.png" alt="Logo Corujoteca"></div>
        <div class="nome-empresa"><img src="img/CORUJOTECA.png" alt="Corujoteca"></div>
    </div>

    <nav class="menu-superior">
        <a href="index.php">Início</a>
        <a href="sobrenos.php">Sobre</a>
        <a href="faleconosco.php">Contato</a>

        <div class="dropdown-categorias">
            <button class="btn-categorias">Categorias</button>
            <div class="categorias-conteudo">
                <a href="categoria.php?cat=antropologia">Antropologia</a>
                <a href="categoria.php?cat=artes">Artes</a>
                <a href="categoria.php?cat=auto-ajuda">Auto Ajuda</a>
                <a href="categoria.php?cat=biografias">Biografias</a>
                <a href="categoria.php?cat=ciencia-politica">Ciência Política</a>
                <a href="categoria.php?cat=comunicacao">Comunicação</a>
                <a href="categoria.php?cat=direito">Direito</a>
                <a href="categoria.php?cat=engenharia">Engenharia</a>
                <a href="categoria.php?cat=historia-do-brasil">História do Brasil</a>
            </div>
        </div>
    </nav>

    <div class="icons" id="iconContainer">
        <div class="icon" onclick="abrirPesquisa()"><img src="img/lupa.png" alt="Pesquisar"></div>
        <div class="search-bar">
            <form action="pesquisar.php" method="GET">
                <input type="text" name="q" placeholder="Pesquisar livros..." required>
            </form>
        </div>
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

<main>
    <div class="conteudo">
        <div class="destaque">
            <a href="clube.php"> 
                <img src="img/bannerCorujoteca.png" alt="Banner">
            </a>
        </div>

        <div class="apresentacao">
            <h1>Bem-vindo à Corujoteca</h1>
            <p>A Corujoteca é uma biblioteca online criada para facilitar o acesso à leitura e incentivar o aprendizado de forma moderna, prática e organizada.</p>
            
            <div class="servicos">
                <div class="servico"><h3>Catálogo Online</h3><p>Explore diversos livros disponíveis na biblioteca.</p></div>
                <div class="servico"><h3>Pesquisa Inteligente</h3><p>Encontre livros rapidamente através da busca.</p></div>
                <div class="servico"><h3>Empréstimo Fácil</h3><p>Solicite livros diretamente pelo sistema.</p></div>
            </div>
        </div>
        <p class="titulo-catalogo">Catálogo</p>
    </div>
</main>

<div class="wrapper">
    <div class="container">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = (int)$row['id'];
                $imagemPath = !empty($row['imagem']) ? 'fotos/' . htmlspecialchars($row['imagem']) : 'img/capa_padrao.png';
                echo '<div class="cartao">
                        <img src="'.$imagemPath.'" class="imagem">
                        <div class="conteudo-livro">
                            <h2>'.htmlspecialchars($row['titulo']).'</h2>
                            <p>'.htmlspecialchars($row['autor']).'</p>
                            <a href="livro.php?id='.$id.'" class="botao">Ver detalhes</a>
                        </div>
                      </div>';
            }
        } else {
            echo '<p>Nenhum livro encontrado.</p>';
        }
        $conn->close();
        ?>
    </div>
</div>

<footer>
    <div id="footer_content">
        <div id="footer_logo"><img src="img/CORUJOTECA.png" alt="Logo" width="180"></div>
        <ul style="list-style: none; padding: 0;">
            <li><h3>Contato</h3></li>
            <li><a href="faleconosco.php" class="footer_link">Fale conosco</a></li>
            <li><a href="sobrenos.php" class="footer_link">Sobre nós</a></li>
        </ul>
        <ul style="list-style: none; padding: 0;">
            <li><h3>Conta</h3></li>
            <li><a href="login.php" class="footer_link">Login</a></li>
            <li><a href="cadastro.php" class="footer_link">Cadastro</a></li>
        </ul>
    </div>
    <div class="footer-copy">© 2026 Corujoteca - Biblioteca Online.</div>
</footer>

<script>
    // Lógica para abrir a barra de pesquisa
    function abrirPesquisa() {
        document.getElementById('iconContainer').classList.toggle('ativo');
    }

    // Lógica para o menu de usuário (Clique)
    document.addEventListener("DOMContentLoaded", function() {
        const userIcon = document.getElementById("userIcon");
        const dropdownMenu = document.getElementById("dropdownMenu");

        userIcon.addEventListener("click", function() {
            dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
        });

        // Fechar o menu se clicar fora dele
        document.addEventListener("click", function(event) {
            if (!userIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.style.display = "none";
            }
        });
    });
</script>