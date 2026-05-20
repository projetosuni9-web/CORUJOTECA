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

<style>
:root {
  --rosa-escuro: #ec95c1;
  --creme: #fcfcec;
  --marrom: #79564d;
  --marrom-claro: #8d6d52;
  --marrom-escuro: #57362e;
}

/* BASE */
html, body {
  margin: 0;
  padding: 0;
  font-family: "Segoe UI", Arial, sans-serif;
  background-color: var(--creme);
  color: #222;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* LINKS PRINCIPAIS */
.links {
  display: flex;
  justify-content: center;
  gap: 25px;
  margin: 80px 0;
}

.links a {
  text-decoration: none;
  color: var(--marrom-escuro);
  font-weight: 600;
  padding: 12px 20px;
  border: 2px solid var(--marrom-escuro);
  border-radius: 10px;
  transition: all 0.3s ease;
  background-color: white;
}

.links a:hover {
  background-color: var(--rosa-escuro);
  color: white;
  border-color: var(--rosa-escuro);
  transform: translateY(-2px);
}

/* BOTÃO VOLTAR */
.back-button {
  position: fixed;
  top: 25px;
  left: 25px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: var(--marrom-escuro);
  color: var(--creme);
  width: 45px;
  height: 45px;
  border-radius: 50%;
  text-decoration: none;
  font-size: 1.4rem;
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
  transition: all 0.3s ease;
}

.back-button:hover {
  background-color: var(--rosa-escuro);
  transform: scale(1.05);
}
</style>

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