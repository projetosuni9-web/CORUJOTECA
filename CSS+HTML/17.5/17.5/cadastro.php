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



    <link rel="stylesheet" href="cadastro.css">
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