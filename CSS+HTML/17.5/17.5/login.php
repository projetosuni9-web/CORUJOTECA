<?php
include("conexao.php");
session_start();

$mensagem = "";
$tipoMensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cpf = preg_replace('/[^0-9]/', '', trim($_POST["cpf"]));
    $senha = trim($_POST["senha"]);

    // 🔐 ADMIN FIXO
    if ($cpf === "1" && $senha === "123") {

        $_SESSION["cpf"] = "1";
        $_SESSION["tipo"] = "admin";

        header("Location: adm.php");
        exit;
    }

    // 🔎 LOGIN USUÁRIO
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



    <link rel="stylesheet" href="login.css">
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