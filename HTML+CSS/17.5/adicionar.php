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

<style>
:root {
    --rosa-escuro: #ec95c1;
    --creme: #fcfcec;
    --marrom: #79564d;
    --marrom-escuro: #57362e;
}

/* FUNDO */
body {
    margin: 0;
    font-family: "Segoe UI", Arial;
    background: var(--creme);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* CONTAINER */
.form-container {
    background: white;
    padding: 40px;
    border-radius: 20px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    text-align: center;
}

/* TÍTULO */
h2 {
    color: var(--marrom-escuro);
    border-bottom: 2px solid var(--rosa-escuro);
    display: inline-block;
    padding-bottom: 5px;
}

/* FORM */
form {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 15px;
}

label {
    text-align: left;
    font-weight: bold;
    color: var(--marrom-escuro);
}

input, textarea {
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #ccc;
    outline: none;
    transition: 0.3s;
}

input:focus, textarea:focus {
    border-color: var(--rosa-escuro);
}

/* BOTÃO */
button {
    background: var(--marrom-escuro);
    color: white;
    padding: 12px;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: var(--rosa-escuro);
    transform: scale(1.03);
}

/* VOLTAR */
.voltar a {
    display: inline-block;
    margin-top: 15px;
    color: var(--marrom-escuro);
    text-decoration: none;
    font-weight: bold;
}

.voltar a:hover {
    color: var(--rosa-escuro);
}

/* ALERTA */
.alerta {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 10px;
    font-weight: bold;
}

.alerta.sucesso {
    background: #e8f7ea;
    color: green;
}

.alerta.erro {
    background: #ffe8e8;
    color: red;
}
</style>
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