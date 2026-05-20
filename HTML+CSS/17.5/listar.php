<?php
include 'conexao.php';

// ======================
// BUSCA LIVROS DISPONÍVEIS
// ======================
$sql = "SELECT * FROM livros WHERE disponivel = 1";
$result = $conn->query($sql);

// Verifica erro na consulta SQL
if (!$result) {
    die("Erro na SQL: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">
<title>Listar Livros</title>

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
    margin: 0;
    font-family: "Segoe UI", Arial;
    background-color: var(--creme);
}

/* ======================
   CONTAINER PRINCIPAL
====================== */
.list-container {
    max-width: 1200px;
    margin: 50px auto;
    padding: 0 20px;
    text-align: center;
}

h2 {
    color: var(--marrom-escuro);
    border-bottom: 2px solid var(--rosa-escuro);
    display: inline-block;
    padding-bottom: 5px;
}

/* ======================
   CARD DO LIVRO
====================== */
.livro-card {
    background: white;
    display: flex;
    gap: 20px;
    padding: 20px;
    margin-bottom: 25px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.livro-card:hover {
    transform: translateY(-5px);
}

/* ======================
   IMAGEM DO LIVRO
====================== */
.livro-card img {
    width: 150px;
    height: 220px;
    object-fit: cover;
    border-radius: 10px;
}

/* ======================
   INFORMAÇÕES DO LIVRO
====================== */
.info {
    text-align: left;
    flex: 1;
}

.titulo {
    font-size: 22px;
    color: var(--marrom-escuro);
}

.autor, .ano, .descricao {
    color: var(--marrom);
    font-size: 14px;
}

/* ======================
   BOTÕES
====================== */
.botao-ver {
    background: var(--marrom-escuro);
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    margin-right: 8px;
    display: inline-block;
    transition: 0.3s;
}

.botao-ver:hover {
    background: var(--rosa-escuro);
    transform: scale(1.05);
}

.botao-excluir {
    background: var(--rosa-escuro);
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-block;
    transition: 0.3s;
}

.botao-excluir:hover {
    background: var(--marrom-escuro);
    transform: scale(1.05);
}

/* ======================
   BOTÃO VOLTAR
====================== */
.voltar a {
    display: inline-block;
    margin-top: 30px;
    background: var(--marrom-escuro);
    color: white;
    padding: 12px 20px;
    border-radius: 10px;
    text-decoration: none;
    transition: 0.3s;
}

.voltar a:hover {
    background: var(--rosa-escuro);
    transform: scale(1.05);
}

/* ======================
   RESPONSIVO
====================== */
@media (max-width: 900px) {
    .livro-card {
        flex-direction: column;
        text-align: center;
    }

    .info {
        text-align: center;
    }
}
</style>

</head>

<body>

<!-- LISTA PRINCIPAL -->
<div class="list-container">
    <h2>Lista de Livros Disponíveis</h2>

<?php
// ======================
// EXIBIÇÃO DOS LIVROS
// ======================
if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        // dados do livro
        $id = (int)$row['id'];
        $titulo = htmlspecialchars($row['titulo']);
        $autor = htmlspecialchars($row['autor']);
        $ano = htmlspecialchars($row['ano_publicacao']);
        $descricao = htmlspecialchars($row['descricao']);
        $imagem = htmlspecialchars($row['imagem']);

        echo '<div class="livro-card">';

        // imagem do livro
        echo '<img src="fotos/' . $imagem . '" alt="Livro">';

        echo '<div class="info">';

        echo '<h3 class="titulo">' . $titulo . '</h3>';
        echo '<p class="autor"><strong>Autor:</strong> ' . $autor . '</p>';
        echo '<p class="ano"><strong>Ano:</strong> ' . $ano . '</p>';
        echo '<p class="descricao">' . $descricao . '</p>';

        echo '<div style="margin-top:12px;">';

        // botão ver detalhes
        echo '<a href="livro.php?id=' . $id . '" class="botao-ver">Ver</a>';

        // botão excluir livro
        echo '<a href="excluir.php?id=' . $id . '" class="botao-excluir" onclick="return confirm(\'Excluir este livro?\')">Excluir</a>';

        echo '</div>';

        echo '</div></div>';
    }

} else {
    echo "<p>Nenhum livro disponível.</p>";
}

// fecha conexão
$conn->close();
?>

<!-- BOTÃO VOLTAR -->
<div class="voltar">
    <a href="adm.php">Voltar</a>
</div>

</div>

</body>
</html>