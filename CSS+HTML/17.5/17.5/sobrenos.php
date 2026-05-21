<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sobre Nós - Corujoteca</title>

<link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">

<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>



    <link rel="stylesheet" href="sobrenos.css">
</head>

<body>

<!-- BOTÃO VOLTAR -->
<a href="index.php" class="back-button">
  <i class='bx bx-arrow-back'></i>
</a>

<main>

  <!-- SOBRE -->
  <section class="about">

    <h1>Sobre a Corujoteca</h1>

    <p>
      A Corujoteca é uma organização especializada em soluções para o setor
      literário. A empresa atua no desenvolvimento de sistemas de gestão
      bibliotecária, e-commerce de livros e consultoria em organização de
      acervos digitais, unindo a tradição da leitura com a eficiência da
      Tecnologia da Informação.
    </p>

    <div class="info-grid">

      <!-- HISTÓRIA -->
      <div class="info-card">

        <h2>História da Empresa</h2>

        <p>
          A Corujoteca surgiu com o objetivo de modernizar o acesso ao
          conhecimento através da tecnologia. O projeto foi desenvolvido
          para facilitar a gestão de bibliotecas, otimizar processos
          de empréstimos e aproximar leitores de obras literárias
          físicas e digitais.
        </p>

      </div>

      <!-- MISSÃO -->
      <div class="info-card">

        <h2>Missão</h2>

        <p>
          Proporcionar soluções tecnológicas inovadoras que facilitem
          o acesso ao conhecimento e otimizem a gestão de acervos
          literários, promovendo a cultura de forma organizada,
          ágil e acessível a todos os públicos.
        </p>

      </div>

      <!-- VISÃO -->
      <div class="info-card">

        <h2>Visão</h2>

        <p>
          Ser a principal referência em tecnologia aplicada ao
          mercado editorial e bibliotecário na região de São Paulo
          até 2030, destacando-se pela excelência técnica e pelo
          compromisso com a democratização da informação.
        </p>

      </div>

      <!-- VALORES -->
      <div class="info-card">

        <h2>Valores</h2>

        <ul>
          <li>
            <strong>Inovação:</strong>
            Busca constante por novas tecnologias de programação e design.
          </li>

          <li>
            <strong>Acessibilidade:</strong>
            Compromisso em criar interfaces simples e inclusivas.
          </li>

          <li>
            <strong>Ética:</strong>
            Transparência total no tratamento de dados e nas relações comerciais.
          </li>

          <li>
            <strong>Sustentabilidade:</strong>
            Estímulo à economia circular através da circulação de obras físicas e digitais.
          </li>
        </ul>

      </div>

      <!-- ÁREA -->
      <div class="info-card">

        <h2>Área de Atuação</h2>

        <p>
          A Corujoteca atua no desenvolvimento de plataformas digitais,
          sistemas de gerenciamento bibliotecário, e-commerce de livros
          e soluções voltadas para organização de acervos digitais.
        </p>

      </div>

      <!-- DIFERENCIAIS -->
      <div class="info-card">

        <h2>Diferenciais</h2>

        <p>
          A empresa se destaca pela união entre tecnologia e literatura,
          oferecendo plataformas modernas, acessíveis e intuitivas,
          focadas na experiência do usuário e na democratização do conhecimento.
        </p>

      </div>

    </div>

  </section>

  <!-- TIME -->
  <section class="team">

    <h2>Nosso Time</h2>

    <div class="member">
      <h3>Diego de Oliveira Silva</h3>
      <p>Programador e Designer.</p>
    </div>

    <div class="member">
      <h3>Paula Camilly Huanca Lucas</h3>
      <p>Programadora e Designer.</p>
    </div>

    <div class="member">
      <h3>Juliane de Almeida Carvalho</h3>
      <p>Gerente e responsável pela documentação do projeto.</p>
    </div>

    <div class="member">
      <h3>Rian Felipe Salomão</h3>
      <p>Programador e Designer.</p>
    </div>

    <div class="member">
      <h3>Sara Cristina Viana Rocha</h3>
      <p>Programadora e Designer.</p>
    </div>

  </section>

</main>

<!-- RODAPÉ -->
<footer>

  <div id="footer_content">

    <div id="footer_logo" class="footer_column">
      <img src="img/CORUJOTECA.png" alt="Logo da Corujoteca">
    </div>

    <ul class="footer_list footer_column">

      <li><h3>Contato</h3></li>

      <li>
        <a href="faleconosco.php" class="footer_link">
          Fale conosco
        </a>
      </li>

      <li>
        <a href="sobrenos.php" class="footer_link">
          Sobre nós
        </a>
      </li>

    </ul>

    <ul class="footer_list footer_column">

      <li><h3>Recursos</h3></li>

      <li>
        <a href="index.php" class="footer_link">
          Página inicial
        </a>
      </li>

    </ul>

    <ul class="footer_list footer_column">

      <li><h3>Conta</h3></li>

      <li>
        <a href="login.php" class="footer_link">
          Login
        </a>
      </li>

      <li>
        <a href="cadastro.php" class="footer_link">
          Cadastro
        </a>
      </li>

    </ul>

  </div>

  <div class="footer-copy">
    © 2026 Corujoteca - Biblioteca Online. Todos os direitos reservados.
  </div>

</footer>

</body>
</html>