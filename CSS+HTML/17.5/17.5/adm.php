<?php
session_start();

if (!isset($_SESSION["cpf"]) || $_SESSION["tipo"] !== "admin") {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel - Biblioteca Online</title>
  <link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>




    <link rel="stylesheet" href="adm.css">
</head>

<body>

<a href="index.php" class="back-button"><i class='bx bx-arrow-back'></i></a>

<div class="links">
  <a href="adicionar.php">Adicionar</a>
  <a href="ver_alugueis.php">Pedidos de aluguel</a>
  <a href="listar.php">Acervo</a>
</div>

</body>
</html>