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

// ===== CRIA TABELA SE NÃO EXISTIR =====
// evita erro ao tentar inserir em uma tabela inexistente

$sqlTabela = "
CREATE TABLE IF NOT EXISTS alugueis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_livro INT NOT NULL,
    cpf_aluno VARCHAR(20) NOT NULL,
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$conn->query($sqlTabela);

// variável de mensagem (sucesso ou erro)
$msg = "";

// verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // verifica se o ID do livro foi enviado
    if (!isset($_POST["id_livro"])) {

        $msg = "Livro não informado.";

    } else {

        // pega o ID do livro e garante que é número inteiro
        $id_livro = intval($_POST["id_livro"]);

        // pega CPF da sessão e remove caracteres não numéricos
        $cpf_aluno = preg_replace('/[^0-9]/', '', $_SESSION["cpf"]);

        // ===== VERIFICA SE O LIVRO EXISTE =====
        $checkLivro = $conn->prepare("SELECT id FROM livros WHERE id = ?");

        if ($checkLivro) {

            $checkLivro->bind_param("i", $id_livro);
            $checkLivro->execute();

            $resultadoLivro = $checkLivro->get_result();

            if ($resultadoLivro->num_rows == 0) {

                $msg = "Livro não encontrado.";

            } else {

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

                    // fecha statement
                    $stmt->close();
                }
            }

            // fecha verificação do livro
            $checkLivro->close();

        } else {

            $msg = "Erro ao verificar livro.";
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



    <link rel="stylesheet" href="solicitar.css">
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
        mostrarAviso("<?php echo addslashes($msg); ?>");
    <?php endif; ?>

};

</script>

</body>
</html>