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

    <style>
        /* ======================
           VARIÁVEIS (Cores globais)
        ====================== */
        :root {
          --rosa-escuro: #ec95c1;
          --creme: #fcfcec;
          --marrom: #79564d;
          --marrom-claro: #8d6d52;
          --marrom-escuro: #57362e;
        }

        /* ======================
           BASE E LAYOUT
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

        main { flex: 1; }

        /* ======================
           HEADER (Barra Superior)
        ====================== */
        header {
          background-color: #2d1f1f;
          padding: 14px 50px;
          display: flex;
          align-items: center;
          justify-content: space-between;
          position: sticky;
          top: 0;
          z-index: 100;
          border-bottom: 3px solid var(--rosa-escuro);
          box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .logo-area { display: flex; align-items: center; gap: 18px; }
        .logo img { height: 78px; }
        .nome-empresa img { height: 52px; }

        /* ======================
           MENU DE NAVEGAÇÃO
        ====================== */
        .menu-superior {
          display: flex;
          align-items: center;
          gap: 14px;
        }

        .menu-superior a,
        .btn-categorias {
          text-decoration: none;
          color: white;
          font-size: 15px;
          font-weight: 500;
          padding: 12px 18px;
          border-radius: 10px;
          background-color: transparent;
          border: 1px solid transparent;
          transition: all 0.3s ease;
          cursor: pointer;
        }

        .menu-superior a:hover,
        .btn-categorias:hover {
          background-color: rgba(255,255,255,0.08);
          border-color: var(--rosa-escuro);
          color: var(--rosa-escuro);
        }

        /* ======================
           DROPDOWN CATEGORIAS (Fix do Hover)
        ====================== */
        .dropdown-categorias { position: relative; }

        .categorias-conteudo {
          /* Usamos opacity e visibility em vez de display:none para permitir animações */
          opacity: 0;
          visibility: hidden;
          position: absolute;
          top: 48px; /* Espaço ajustado */
          left: 0;
          min-width: 220px;
          background-color: white;
          border-radius: 12px;
          box-shadow: 0 8px 20px rgba(0,0,0,0.15);
          z-index: 999;
          transform: translateY(10px); /* Começa um pouco abaixo */
          transition: all 0.3s ease;
          overflow: visible; /* Importante para a ponte invisível funcionar */
        }

        /* A PONTE INVISÍVEL: Preenche o vazio entre o botão e o menu */
        .categorias-conteudo::before {
            content: "";
            position: absolute;
            top: -15px; /* Sobe para cobrir a área de 'gap' */
            left: 0;
            width: 100%;
            height: 15px;
            background: transparent;
        }

        .dropdown-categorias:hover .categorias-conteudo {
          opacity: 1;
          visibility: visible;
          transform: translateY(0); /* Sobe suavemente para a posição real */
        }

        .categorias-conteudo a {
          display: block;
          padding: 14px 18px;
          color: var(--marrom-escuro);
          text-decoration: none;
          transition: 0.3s;
        }

        /* Arredondar apenas as pontas do primeiro e último item do menu */
        .categorias-conteudo a:first-child { border-radius: 12px 12px 0 0; }
        .categorias-conteudo a:last-child { border-radius: 0 0 12px 12px; }

        .categorias-conteudo a:hover {
          background-color: #f8f3f5;
          padding-left: 24px;
        }

        /* ======================
           ÍCONES E PESQUISA
        ====================== */
        .icons { display: flex; align-items: center; gap: 20px; }
        .icon img { height: 22px; cursor: pointer; opacity: 0.8; transition: 0.3s; }
        .icon img:hover { opacity: 1; }

        .search-bar {
          display: flex;
          align-items: center;
          background-color: white;
          border-radius: 30px;
          padding: 6px 12px;
          transition: width 0.4s ease, opacity 0.3s ease;
          width: 0;
          opacity: 0;
          pointer-events: none;
        }

        #iconContainer.ativo .search-bar { width: 240px; opacity: 1; pointer-events: auto; }
        .search-bar input { width: 100%; border: none; outline: none; font-size: 14px; }

        /* ======================
           MENU USUÁRIO E PERFIL
        ====================== */
        .user-menu { position: relative; }
        .user-menu img { border-radius: 50%; border: 2px solid var(--rosa-escuro); cursor: pointer; }

        .dropdown {
          display: none;
          position: absolute;
          right: 0;
          top: 55px;
          background-color: white;
          border-radius: 10px;
          box-shadow: 0 8px 20px rgba(0,0,0,0.15);
          min-width: 180px;
          overflow: hidden;
          z-index: 9999;
        }

        .dropdown a {
          display: block;
          padding: 14px 18px;
          color: #222;
          text-decoration: none;
          transition: 0.3s;
        }

        .dropdown a:hover { background-color: #f5f5f5; }

        /* ======================
           CONTEÚDO E CATÁLOGO
        ====================== */
        .conteudo { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .destaque img { width: 100%; border-radius: 20px; transition: 0.3s; }
        .destaque img:hover { transform: scale(1.01); filter: brightness(0.97); }

        .apresentacao {
          background-color: white;
          padding: 45px;
          border-radius: 20px;
          margin-top: 35px;
          box-shadow: 0 6px 16px rgba(0,0,0,0.08);
        }

        .servicos { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-top: 35px; }
        .servico { background-color: var(--creme); border-radius: 16px; padding: 25px; transition: 0.3s; border: 1px solid #eee; }
        .servico:hover { transform: translateY(-5px); box-shadow: 0 8px 18px rgba(0,0,0,0.08); }

        .titulo-catalogo { font-size: 42px; font-weight: bold; color: var(--marrom-escuro); margin-top: 50px; }

        .wrapper { display: flex; justify-content: center; padding: 30px 20px; }
        .container { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; max-width: 1200px; width: 100%; }

        /* Estilo do Cartão de Livro */
        .cartao {
          background-color: white;
          border-radius: 16px;
          overflow: hidden;
          display: flex;
          flex-direction: column;
          box-shadow: 0 4px 12px rgba(0,0,0,0.08);
          transition: 0.3s;
        }

        .cartao:hover { transform: translateY(-6px); box-shadow: 0 10px 20px rgba(0,0,0,0.12); }
        .imagem { width: 100%; height: 400px; object-fit: cover; }
        .conteudo-livro { padding: 20px; flex: 1; display: flex; flex-direction: column; justify-content: space-between; }

        .botao {
          background-color: var(--marrom-escuro);
          color: white;
          border: none;
          border-radius: 8px;
          padding: 10px;
          text-decoration: none;
          text-align: center;
          margin-top: 15px;
          transition: 0.3s;
        }
        .botao:hover { background-color: var(--rosa-escuro); }

        /* ======================
           FOOTER (Rodapé)
        ====================== */
        footer { background-color: #2d1f1f; color: white; padding: 50px 20px 20px; margin-top: 50px; }
        #footer_content { display: flex; justify-content: space-around; flex-wrap: wrap; gap: 40px; max-width: 1200px; margin: auto; }
        .footer_link { text-decoration: none; color: white; display: block; margin: 8px 0; transition: 0.3s; }
        .footer_link:hover { color: var(--rosa-escuro); }
        .footer-copy { text-align: center; margin-top: 40px; color: #ccc; font-size: 14px; }

        /* ======================
           RESPONSIVIDADE
        ====================== */
        @media (max-width: 900px) {
          header { flex-direction: column; gap: 20px; }
          .container { grid-template-columns: repeat(2, 1fr); }
          .servicos { grid-template-columns: 1fr; }
        }
    </style>
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