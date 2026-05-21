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




    <link rel="stylesheet" href="listar.css">
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