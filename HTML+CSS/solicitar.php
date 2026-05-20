<?php
// Inicia a sessão do usuário (necessário para login e CPF salvo)
session_start();

// Importa a conexão com o banco de dados
include("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION["cpf"])) {
    header("Location: login.php"); // redireciona se não estiver logado
    exit;
}

// variável de mensagem (sucesso ou erro)
$msg = "";

// verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // pega o ID do livro e garante que é número inteiro
    $id_livro = intval($_POST["id_livro"]);

    // pega CPF da sessão e remove caracteres não numéricos
    $cpf_aluno = preg_replace('/[^0-9]/', '', $_SESSION["cpf"]);

    // SQL para inserir o pedido de aluguel
    $sql = "INSERT INTO alugueis (id_livro, cpf_aluno) VALUES (?, ?)";

    // prepara a query para evitar SQL Injection
    $stmt = $conn->prepare($sql);

    // verifica se o prepare funcionou
    if (!$stmt) {
        $msg = "Erro no prepare: " . $conn->error;
    } else {

        // associa os parâmetros (i = int, s = string)
        $stmt->bind_param("is", $id_livro, $cpf_aluno);

        // executa a query
        if ($stmt->execute()) {
            $msg = "Pedido de aluguel enviado com sucesso! Procure a biblioteca para mais informações.";
        } else {
            $msg = "Erro ao solicitar aluguel: " . $stmt->error;
        }
    }
}

// fecha conexão com banco
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">

<!-- favicon do site -->
<link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">

<title>Solicitar Aluguel</title>

<style>
/* ===== VARIÁVEIS DE CORES DO SISTEMA ===== */
:root {
  --rosa-escuro: #ec95c1;
  --creme: #fcfcec;
  --marrom: #79564d;
  --marrom-claro: #8d6d52;
  --marrom-escuro: #57362e;
}

/* ===== ESTILO GLOBAL ===== */
body {
  margin: 0;
  font-family: "Segoe UI", Arial, sans-serif;
  background-color: var(--creme);
}

/* ===== MODAL DE AVISO ===== */
.aviso-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.6);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  opacity: 0;
  pointer-events: none;
  transition: opacity .3s ease;
}

/* caixa do aviso */
.aviso-box {
  background: white;
  color: var(--marrom-escuro);
  padding: 25px 35px;
  border-radius: 12px;
  width: 350px;
  text-align: center;
  border: 2px solid var(--rosa-escuro);
  box-shadow: 0 5px 20px rgba(0,0,0,0.2);
  transform: scale(0.85);
  transition: transform .3s ease;
}

/* quando ativo */
.aviso-overlay.ativo {
  opacity: 1;
  pointer-events: all;
}

/* animação do popup */
.aviso-overlay.ativo .aviso-box {
  transform: scale(1);
}

/* botão do aviso */
.btn-aviso {
  margin-top: 20px;
  padding: 10px 20px;
  border: none;
  background: var(--marrom-escuro);
  color: white;
  border-radius: 6px;
  cursor: pointer;
  font-weight: bold;
  transition: 0.3s;
}

/* hover botão */
.btn-aviso:hover {
  background: var(--rosa-escuro);
}
</style>
</head>

<body>

<!-- ===== POPUP DE MENSAGEM ===== -->
<div class="aviso-overlay" id="aviso">
    <div class="aviso-box">
        <h2 id="avisoMsg">Mensagem</h2>
        <button class="btn-aviso" onclick="fecharAviso()">OK</button>
    </div>
</div>

<script>

// mostra o popup com mensagem
function mostrarAviso(msg) {
    const aviso = document.getElementById("aviso");
    const texto = document.getElementById("avisoMsg");

    texto.textContent = msg;
    aviso.classList.add("ativo");
}

// fecha o popup e volta para index
function fecharAviso() {
    document.getElementById("aviso").classList.remove("ativo");
    setTimeout(() => {
        window.location.href = "index.php";
    }, 200);
}

// executa quando a página carrega
window.onload = function() {
    <?php if (!empty($msg)): ?>
        mostrarAviso("<?php echo $msg; ?>");
    <?php endif; ?>
};

</script>

</body>
</html>