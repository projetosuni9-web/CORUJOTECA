<?php
include("conexao.php");
session_start();

if (!isset($_SESSION["cpf"])) {
    die("Você precisa estar logado.");
}

// CPF limpo (sem pontos e traço)
$cpf = preg_replace('/[^0-9]/', '', $_SESSION["cpf"]);

// ID do livro vindo do botão ou form
$id_livro = isset($_POST["id_livro"]) ? (int)$_POST["id_livro"] : 0;

if ($id_livro <= 0) {
    die("Livro inválido.");
}

// INSERT seguro
$sql = "INSERT INTO alugueis (id_livro, cpf_aluno) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro no prepare: " . $conn->error);
}

$stmt->bind_param("is", $id_livro, $cpf);

if ($stmt->execute()) {
    echo "Aluguel realizado com sucesso!";
} else {
    echo "Erro ao solicitar aluguel: " . $stmt->error;
}
?>