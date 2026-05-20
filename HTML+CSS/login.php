<?php
include("conexao.php");
session_start();

$mensagem = "";
$tipoMensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cpf = preg_replace('/[^0-9]/', '', trim($_POST["cpf"]));
    $senha = trim($_POST["senha"]);

    // ADMIN FIXO
    if ($cpf === "1" && $senha === "123") {

        $_SESSION["cpf"] = "00001";
        $_SESSION["tipo"] = "admin";

        header("Location: adm.php");
        exit;
    }

    // LOGIN USUÁRIO
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE cpf = ?");

    if (!$stmt) {
        die("Erro no prepare: " . $conn->error);
    }

    $stmt->bind_param("s", $cpf);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows > 0) {

        $user = $resultado->fetch_assoc();

        if (password_verify($senha, $user["senha"])) {

            $_SESSION["cpf"] = $user["cpf"];
            $_SESSION["tipo"] = $user["tipo"];

            header("Location: index.php");
            exit;

        } else {
            $mensagem = "Senha incorreta!";
            $tipoMensagem = "erro";
        }

    } else {
        $mensagem = "Usuário não encontrado!";
        $tipoMensagem = "erro";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">

<style>
@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap");

:root {
    --rosa-escuro: #ec95c1;
    --creme: #fcfcec;
    --marrom: #79564d;;
    --branco: #ffffff;
    --marrom-escuro: #57362e;
}

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background-color: var(--creme);
    color: var(--marrom);
}

.l-form {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 150px;
}

.logo img {
    width: 500px;
    filter: drop-shadow(5px 5px 15px rgba(0,0,0,0.15));
}

.form {
    background-color: var(--branco);
    padding: 3rem;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    width: 320px;
}

.form__title {
    text-align: center;
    font-size: 1.8rem;
    color: var(--rosa-escuro);
    margin-bottom: 2rem;
}

.form__div {
    position: relative;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid var(--marrom);
}

.form__input {
    width: 100%;
    padding: 0.6rem 0.6rem 0.6rem 2rem;
    border: none;
    outline: none;
    background: none;
    color: var(--marrom);
}

.form__label {
    position: absolute;
    top: -1.2rem;
    left: 2rem;
    font-size: 0.9rem;
    color: var(--marrom);
}

.form__forgot {
    display: block;
    text-align: right;
    margin-bottom: 2rem;
    color: var(--rosa-escuro);
}

.form__forgot:hover {
    color: var(--marrom-escuro);
}

.form__button {
    width: 100%;
    background-color: var(--rosa-escuro);
    border: none;
    padding: 1rem;
    border-radius: 6px;
    color: var(--branco);
    cursor: pointer;
}

.form__button:hover {
    background-color: var(--marrom-escuro);
}

.back-button {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background-color: var(--rosa-escuro);
    color: var(--branco);
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.mensagem {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    padding: 1rem 2rem;
    border-radius: 6px;
    color: var(--branco);
}

.mensagem.erro {
    background-color: #b33a3a;
}

.form__signup {
    text-align: center;
    margin-top: 1.5rem;
    color: var(--marrom);
}

.form__signup a {
    color: var(--rosa-escuro);
}

@media (max-width: 900px) {
    .l-form {
        flex-direction: column;
        text-align: center;
    }
}
</style>
</head>

<body>

<a href="index.php" class="back-button">←</a>

<?php if (!empty($mensagem)): ?>
<div class="mensagem <?= $tipoMensagem; ?>">
    <?= htmlspecialchars($mensagem); ?>
</div>
<?php endif; ?>

<div class="l-form">

    <div class="logo">
        <img src="img/book-lover-25.png" alt="Ilustração">
    </div>

    <div class="form">

        <form method="POST">

            <h1 class="form__title">Bem-vindo</h1>

            <div class="form__div">
                <input type="text" name="cpf" class="form__input" required>
                <label class="form__label">CPF</label>
            </div>

            <div class="form__div">
                <input type="password" name="senha" class="form__input" required>
                <label class="form__label">Senha</label>
            </div>

            <button type="submit" class="form__button">Entrar</button>

            <p class="form__signup">
                Não tem login?
                <a href="cadastro.php">Cadastre-se!</a>
            </p>

        </form>

    </div>
</div>

</body>
</html>
