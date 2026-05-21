<?php
session_start();
include 'conexao.php';

/* 🔥 CORREÇÃO IMPORTANTE: cpf minúsculo */
if (!isset($_SESSION["cpf"]) || $_SESSION["tipo"] !== "admin") {
    header("Location: adm.php"); // ou login.php se quiser
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $ano_publicacao = trim($_POST['ano_publicacao']);
    $descricao = trim($_POST['descricao']);

    $imagem = $_FILES['imagem']['name'];
    $imagem_tmp = $_FILES['imagem']['tmp_name'];

    if ($titulo && $autor && $ano_publicacao && $descricao && $imagem) {

        if (move_uploaded_file($imagem_tmp, 'fotos/' . $imagem)) {

            $sql = "INSERT INTO livros (titulo, autor, ano_publicacao, descricao, imagem)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssiss", $titulo, $autor, $ano_publicacao, $descricao, $imagem);

            if ($stmt->execute()) {
                $mensagem = "Livro adicionado com sucesso!";
                $tipo_msg = "sucesso";
            } else {
                $mensagem = "Erro ao adicionar livro.";
                $tipo_msg = "erro";
            }

            $stmt->close();

        } else {
            $mensagem = "Erro no upload da imagem.";
            $tipo_msg = "erro";
        }

    } else {
        $mensagem = "Preencha todos os campos.";
        $tipo_msg = "erro";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">
<title>Adicionar Livro</title>



    <link rel="stylesheet" href="adicionar.css">
</head>

<body>

<div class="form-container">

    <h2>Adicionar Livro</h2>

    <?php if (isset($mensagem)): ?>
        <div class="alerta <?= $tipo_msg ?>">
            <?= $mensagem ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <label>Título</label>
        <input type="text" name="titulo" required>

        <label>Autor</label>
        <input type="text" name="autor" required>

        <label>Ano de Publicação</label>
        <input type="text" name="ano_publicacao" required>

        <label>Descrição</label>
        <textarea name="descricao" rows="4" required></textarea>

        <label>Imagem</label>
        <input type="file" name="imagem" required>

        <button type="submit">Adicionar Livro</button>

    </form>

    <div class="voltar">
        <a href="adm.php">← Voltar</a>
    </div>

</div>

</body>
</html>