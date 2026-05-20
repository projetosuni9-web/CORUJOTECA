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

// ===== VERIFICA SE A TABELA EXISTE =====
// evita erro fatal caso a tabela "alugueis" não exista
$check = $conn->query("SHOW TABLES LIKE 'alugueis'");

// se não existir tabela, interrompe o sistema
if ($check->num_rows == 0) {
    die("Tabela 'alugueis' não existe no banco.");
}

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

<style>

/* ===== CORES DO SISTEMA ===== */
:root {
  --rosa-escuro: #ec95c1;
  --creme: #fcfcec;
  --marrom-escuro: #57362e;
}

/* ===== BASE ===== */
body {
  margin: 0;
  font-family: Arial;
  background: var(--creme);
}

/* título da página */
h2 {
  text-align: center;
  margin-top: 90px;
  color: var(--marrom-escuro);
}

/* ===== BOTÃO VOLTAR ===== */
.back-button {
  position: fixed;
  top: 25px;
  left: 25px;
  width: 45px;
  height: 45px;
  background: var(--marrom-escuro);
  color: white;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  text-decoration: none;
  font-size: 20px;
}

/* hover botão voltar */
.back-button:hover {
  background: var(--rosa-escuro);
}

/* ===== TABELA ===== */
table {
  width: 90%;
  margin: 20px auto;
  border-collapse: collapse;
  background: white;
  border-radius: 8px;
  overflow: hidden;
}

/* cabeçalho tabela */
th {
  background: var(--marrom-escuro);
  color: white;
  padding: 12px;
}

/* células tabela */
td {
  text-align: center;
  padding: 12px;
  border-bottom: 1px solid #ddd;
}

/* hover linhas */
tr:hover {
  background: #f5f5f5;
}

</style>
</head>

<body>

<!-- botão voltar para painel admin -->
<a href="adm.php" class="back-button">←</a>

<!-- título da página -->
<h2>Ver Aluguéis</h2>

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

</body>
</html>