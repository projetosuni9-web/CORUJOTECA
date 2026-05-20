<?php
// Cria uma conexão com o banco de dados MySQL
// Parâmetros: host, usuário, senha, nome do banco
$conn = new mysqli("localhost", "root", "", "bancobiblioteca");

/* Verifica se houve erro na conexão com o banco */
if ($conn->connect_error) {
    // Interrompe a execução e exibe a mensagem de erro
    die("Erro de conexão: " . $conn->connect_error);
}
?>