<?php
// Inclui conexão com o banco de dados
include("conexao.php");

// Inicia sessão para armazenar dados do usuário
session_start();

/* Variáveis usadas para mensagens de feedback */
$mensagem = "";
$tipoMensagem = "";

/* Executa apenas quando o formulário é enviado */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recebe e limpa os dados do formulário
    $cpf = trim($_POST["cpf"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];

    // Verifica se já existe um usuário com esse CPF
    $verifica = $conn->prepare("SELECT id FROM usuarios WHERE cpf = ?");

    // Se falhar ao preparar a query
    if (!$verifica) {
        die("Erro no prepare: " . $conn->error);
    }

    // Envia o CPF para a query
    $verifica->bind_param("s", $cpf);

    // Executa a verificação
    $verifica->execute();

    // Pega o resultado da busca
    $resultado = $verifica->get_result();

    // Se já existir CPF no banco
    if ($resultado->num_rows > 0) {
        $mensagem = "Este CPF já está cadastrado!";
        $tipoMensagem = "erro";
    } else {

        // Criptografa a senha antes de salvar no banco
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Define tipo de usuário como aluno por padrão
        $tipo = "aluno";

        // Insere novo usuário no banco
        $sql = $conn->prepare("INSERT INTO usuarios (cpf, email, senha, tipo) VALUES (?, ?, ?, ?)");

        // Verifica erro no prepare do INSERT
        if (!$sql) {
            die("Erro no insert: " . $conn->error);
        }

        // Associa os valores à query
        $sql->bind_param("ssss", $cpf, $email, $senhaHash, $tipo);

        // Executa o cadastro
        if ($sql->execute()) {

            // Cria sessão do usuário automaticamente após cadastro
            $_SESSION['cpf'] = $cpf;
            $_SESSION['email'] = $email;
            $_SESSION['tipo'] = $tipo;
            $_SESSION['logado'] = true;

            // Redireciona para login
            header("Location: login.php");
            exit;

        } else {
            // Mensagem de erro caso falhe o cadastro
            $mensagem = "Erro ao cadastrar. Tente novamente.";
            $tipoMensagem = "erro";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro</title>
<link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">

<!-- Responsividade -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Ícones Boxicons -->
<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

<style>

/* VARIÁVEIS DE CORES */
:root {
    --rosa-escuro: #ec95c1;
    --creme: #fcfcec;
    --marrom: #79564d;
    --branco: #ffffff;
    --marrom-escuro: #57362e;
}

/* RESET BÁSICO */
* { box-sizing: border-box; }

/* ESTILO GERAL DA PÁGINA */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: var(--creme);
    overflow-x: hidden;
}

/* LAYOUT PRINCIPAL (LOGO + FORM) */
.l-form {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 100px;
    padding: 2rem;
}

/* LOGO */
.logo img {
    width: 400px;
    max-width: 100%;
}

/* CAIXA DO FORMULÁRIO */
.form {
    background-color: var(--branco);
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    width: 320px;
}

/* TÍTULO DO FORM */
.form__title {
    text-align: center;
    margin-bottom: 1.5rem;
    color: var(--marrom-escuro);
}

/* CAMPOS DO FORM */
.form__div {
    position: relative;
    margin-bottom: 1.2rem;
    border-bottom: 2px solid var(--marrom);
}

/* ÍCONES DOS CAMPOS */
.form__icon {
    position: absolute;
    top: 8px;
    left: 0;
    color: var(--marrom-escuro);
}

/* INPUTS */
.form__input {
    width: 100%;
    padding: 8px 8px 8px 25px;
    border: none;
    outline: none;
    background: none;
}

/* BOTÃO */
.form__button {
    width: 100%;
    background-color: var(--marrom-escuro);
    border: none;
    padding: 10px;
    border-radius: 6px;
    color: white;
    cursor: pointer;
}

/* HOVER DO BOTÃO */
.form__button:hover {
    background-color: var(--rosa-escuro);
}

/* LINK DE LOGIN */
.form__login {
    text-align: center;
    margin-top: 10px;
}

.form__login a {
    text-decoration: none;
    color: var(--marrom-escuro);
}

/* MENSAGEM DE ERRO */
.mensagem {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    padding: 10px 20px;
    border-radius: 6px;
    color: white;
}

.mensagem.erro {
    background-color: red;
}

/* BOTÃO DE VOLTAR */
.back-button {
    position: absolute;
    top: 10px;
    left: 10px;
    background: var(--marrom-escuro);
    color: white;
    padding: 10px;
    border-radius: 50%;
    text-decoration: none;
}

</style>
</head>

<body>

<!-- BOTÃO DE VOLTAR -->
<a href="index.php" class="back-button">
    <i class='bx bx-arrow-back'></i>
</a>

<!-- MENSAGEM DE ERRO OU SUCESSO -->
<?php if (!empty($mensagem)): ?>
<div class="mensagem <?= $tipoMensagem; ?>">
    <?= $mensagem; ?>
</div>
<?php endif; ?>

<!-- CONTEÚDO PRINCIPAL -->
<div class="l-form">

    <!-- IMAGEM/LOGO -->
    <div class="logo">
        <img src="img/resting-74.png" alt="Imagem">
    </div>

    <!-- FORMULÁRIO -->
    <div class="form">
        <form method="POST">

            <h2 class="form__title">Cadastre-se</h2>

            <div class="form__div">
                <i class='bx bx-user form__icon'></i>
                <input type="text" name="cpf" class="form__input" placeholder="CPF" required>
            </div>

            <div class="form__div">
                <i class='bx bx-envelope form__icon'></i>
                <input type="email" name="email" class="form__input" placeholder="Email" required>
            </div>

            <div class="form__div">
                <i class='bx bx-lock form__icon'></i>
                <input type="password" name="senha" class="form__input" placeholder="Senha" required>
            </div>

            <button type="submit" class="form__button">Cadastrar</button>

            <p class="form__login">
                Já tem conta? <a href="login.php">Entrar</a>
            </p>

        </form>
    </div>

</div>

</body>
</html>