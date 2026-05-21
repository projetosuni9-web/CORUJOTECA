<?php
// inicia sessão para controle de login e permissões
session_start();

// importa conexão com banco de dados
include("conexao.php");

// ===== PROTEÇÃO ADMIN =====
// verifica se o usuário está logado e se é admin
if (!isset($_SESSION["cpf"]) || !isset($_SESSION["tipo"]) || $_SESSION["tipo"] !== "admin") {
    header("Location: login.php"); // redireciona se não for admin
    exit;
}

// ===== CRIA A TABELA SE NÃO EXISTIR =====
// isso evita o erro:
// "Tabela 'alugueis' não existe no banco."

$sqlTabela = "
CREATE TABLE IF NOT EXISTS alugueis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_livro INT NOT NULL,
    cpf_aluno VARCHAR(20) NOT NULL,
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$conn->query($sqlTabela);

// ===== CONSULTA PRINCIPAL =====
// busca todos os aluguéis com nome do livro
$sql = "SELECT a.id, l.titulo, a.cpf_aluno, a.data_pedido
        FROM alugueis a
        INNER JOIN livros l ON a.id_livro = l.id
        ORDER BY a.data_pedido DESC";

// executa consulta
$result = $conn->query($sql);

// verifica erro na SQL
if (!$result) {
    die("Erro na SQL: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">

<!-- favicon do sistema -->
<link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">

<title>Ver Aluguéis</title>



    <link rel="stylesheet" href="ver_alugueis.css">
</head>

<body>

<!-- botão voltar para painel admin -->
<a href="adm.php" class="back-button">←</a>

<!-- título da página -->
<h2>Ver Aluguéis</h2>

<?php if ($result->num_rows > 0): ?>

<!-- tabela de resultados -->
<table>
<tr>
  <th>ID</th>
  <th>Livro</th>
  <th>CPF</th>
  <th>Data</th>
</tr>

<?php 
// loop para exibir todos os registros
while ($row = $result->fetch_assoc()) { 
?>
<tr>
  <td><?= htmlspecialchars($row["id"]) ?></td>
  <td><?= htmlspecialchars($row["titulo"]) ?></td>
  <td><?= htmlspecialchars($row["cpf_aluno"]) ?></td>
  <td><?= htmlspecialchars($row["data_pedido"]) ?></td>
</tr>
<?php } ?>

</table>

<?php else: ?>

<!-- mensagem caso não existam pedidos -->
<div class="sem-registros">
    Nenhum aluguel encontrado.
</div>

<?php endif; ?>

</body>
</html>