<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sobre Nós - Biblioteca Online</title>
  <link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

<style>
:root {
  --marrom: #79564d;
  --marrom-escuro: #57362e;
  --rosa-claro: #eecbdd;
  --rosa-escuro: #ec95c1;
  --cinza: #6b6b6b;
  --branco: #ffffff;
  --dourado: #bfa14a;
  --creme: #fcfcec;
}

html, body {
  margin: 0;
  padding: 0;
  font-family: "Segoe UI", Arial, sans-serif;
  background-color: var(--creme);
  color: #222;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

main {
  flex: 1;
}

/* ======= SEÇÃO SOBRE ======= */
.about {
  max-width: 900px;
  margin: 50px auto;
  padding: 30px 20px;
  background: var(--branco);
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

.about-text h2 {
  color: var(--marrom);
  text-align: center;
  margin-bottom: 15px;
}

.about-text p {
  text-align: center;
  color: var(--cinza);
  font-size: 16px;
  line-height: 1.6;
}

/* ======= NOSSO TIME ======= */
.team {
  max-width: 900px;
  margin: 50px auto;
  padding: 20px;
}

.team h2 {
  text-align: center;
  margin-bottom: 40px;
  color: var(--marrom);
}

.member {
  display: flex;
  align-items: flex-start;
  gap: 20px;
  margin-bottom: 40px;
  background: var(--branco);
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.05);
  transition: transform 0.3s ease;
}

.member:hover {
  transform: translateY(-5px);
}

.member img {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid var(--dourado);
}

.member h3 {
  margin: 0;
  color: var(--marrom);
}

.member p {
  margin: 5px 0;
  color: var(--cinza);
}

@media (max-width: 700px) {
  .member {
    flex-direction: column;
    text-align: center;
  }

  .member img {
    margin-bottom: 10px;
  }
}

/* ======= BOTÃO VOLTAR ======= */
.back-button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background-color: var(--dourado);
  color: var(--branco);
  width: 45px;
  height: 45px;
  border-radius: 50%;
  text-decoration: none;
  font-size: 1.2rem;
  transition: 0.3s;
  margin: 20px 0 0 40px;
}

.back-button:hover {
  background-color: var(--rosa-escuro);
}

/* ======= RODAPÉ ======= */
footer {
  background-color: var(--marrom-escuro);
  color: white;
  padding: 40px 20px;
  margin-top: 50px;
}

#footer_content {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  gap: 30px;
  max-width: 1200px;
  margin: auto;
}

#footer_logo img {
  max-width: 180px;
}

.footer_column {
  min-width: 200px;
}

.footer_list {
  list-style: none;
  padding: 0;
}

.footer_list h3 {
  margin-bottom: 10px;
  color: var(--rosa-claro);
  font-size: 18px;
}

.footer_link {
  text-decoration: none;
  color: white;
  font-size: 14px;
  display: block;
  margin: 5px 0;
  transition: color 0.3s ease;
}

.footer_link:hover {
  color: var(--rosa-claro);
}
</style>
</head>

<body>

<a href="index.php" class="back-button">
  <i class='bx bx-arrow-back'></i>
</a>

<main>

  <section class="about">
    <div class="about-text">
      <h2>Nosso Projeto</h2>

      <p>
        Nosso sistema foi desenvolvido para automatizar o uso de uma biblioteca,
        facilitando empréstimos, devoluções e o acesso às informações sobre o acervo.
      </p>
    </div>
  </section>

  <section class="team">

    <h2>Nosso Time</h2>

    <div class="member">

      <div>
        <h3>Diego de Oliveira Silva</h3>
        <p>Programador e Design.</p>
      </div>
    </div>

    <div class="member">

      <div>
        <h3>Paula Camilly Huanca Lucas</h3>
        <p>Programador e Design.</p>
      </div>
    </div>

    <div class="member">

      <div>
        <h3>Juliane de Almeida Carvalho</h3>
        <p>Gerente e Escrevente - Responsável pela documentação do projeto.</p>
      </div>
    </div>

    <div class="member">

      <div>
        <h3>Rian Felipe Salomão</h3>
        <p>Programador e Design.</p>
      </div>
    </div>

    <div class="member">

      <div>
        <h3>Sara Cristina Viana Rocha</h3>
        <p>Programador e Design.</p>
      </div>
    </div>

  </section>

</main>

<footer>
  <div id="footer_content">

    <div id="footer_logo" class="footer_column">
      <img src="img/CORUJOTECA.png" alt="Logo da Biblioteca - Rodapé">
    </div>

    <ul class="footer_list footer_column">
      <li><h3>Fale conosco</h3></li>
      <li><a href="faleconosco.php" class="footer_link">Fale conosco</a></li>
      <li><a href="sobrenos.php" class="footer_link">Sobre nós</a></li>
    </ul>

    <ul class="footer_list footer_column">
      <li><h3>Recursos</h3></li>
      <li><a href="index.php" class="footer_link">Página inicial</a></li>
    </ul>

    <ul class="footer_list footer_column">
      <li><h3>Conta</h3></li>
      <li><a href="login.php" class="footer_link">Login</a></li>
      <li><a href="cadastro.php" class="footer_link">Cadastro</a></li>
    </ul>

  </div>
</footer>

</body>
</html>