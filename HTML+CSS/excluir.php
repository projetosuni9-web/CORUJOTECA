<?php
// Inicia a sessão para acessar dados do usuário logado
session_start();

// Inclui a conexão com o banco de dados
include 'conexao.php';

/* VERIFICAÇÃO DE SEGURANÇA:
   impede que usuários não administradores acessem esta página */
if (!isset($_SESSION["tipo"]) || $_SESSION["tipo"] !== "admin") {
    header("Location: login.php"); // Redireciona para login
    exit();
}

/* VERIFICA SE O ID FOI ENVIADO CORRETAMENTE VIA URL */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: listar.php?erro=id_invalido"); // Redireciona com erro
    exit();
}

// Converte o ID para inteiro por segurança
$id = intval($_GET['id']);

/* PREPARED STATEMENT:
   evita SQL Injection ao excluir livro */
$stmt = $conn->prepare("DELETE FROM livros WHERE id = ?");

// Associa o ID à query (i = inteiro)
$stmt->bind_param("i", $id);

/* EXECUTA A EXCLUSÃO */
if ($stmt->execute()) {

    // Comentário: se o banco estiver com ON DELETE CASCADE,
    // registros relacionados (ex: alugueis) também serão apagados automaticamente.

    header("Location: listar.php?sucesso=1"); // Sucesso na exclusão
    exit();

} else {
    header("Location: listar.php?erro=falha"); // Erro ao excluir
    exit();
}

// Fecha statement e conexão com o banco
$stmt->close();
$conn->close();
?>