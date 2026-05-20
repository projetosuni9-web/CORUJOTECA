<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clube do Livro - Corujoteca</title>
    <link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">

    <style>
        /* ======================
           VARIÁVEIS (Mesmas da Index)
        ====================== */
        :root {
          --rosa-escuro: #ec95c1;
          --creme: #fcfcec;
          --marrom: #79564d;
          --marrom-claro: #8d6d52;
          --marrom-escuro: #57362e;
        }

        /* ======================
           BASE
        ====================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            background-color: var(--creme);
            color: #222;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main { flex: 1; }

       /* ======================
           HEADER (Barra Superior)
        ====================== */
        header {
          background-color: #2d1f1f;
          padding: 14px 50px;
          display: flex;
          align-items: center;
          justify-content: space-between;
          position: sticky;
          top: 0;
          z-index: 100;
          border-bottom: 3px solid var(--rosa-escuro);
          box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .logo-area { display: flex; align-items: center; gap: 18px; }
        .logo img { height: 78px; }
        .nome-empresa img { height: 52px; }

        /* Menu */
        .menu-superior { display: flex; align-items: center; gap: 14px; }
        .menu-superior a, .btn-categorias {
          text-decoration: none;
          color: white;
          font-size: 15px;
          font-weight: 500;
          padding: 10px 15px;
          border-radius: 10px;
          transition: 0.3s;
          cursor: pointer;
          background: transparent;
          border: 1px solid transparent;
        }

        .menu-superior a:hover, .btn-categorias:hover {
          border-color: var(--rosa-escuro);
          color: var(--rosa-escuro);
        }

        /* Dropdown Fix */
        .dropdown-categorias { position: relative; }
        .categorias-conteudo {
          opacity: 0; visibility: hidden;
          position: absolute; top: 45px; left: 0;
          background: white; min-width: 200px;
          border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);
          transition: 0.3s; transform: translateY(10px);
        }
        .categorias-conteudo::before { /* Ponte invisível */
            content: ""; position: absolute; top: -15px; width: 100%; height: 15px;
        }
        .dropdown-categorias:hover .categorias-conteudo {
          opacity: 1; visibility: visible; transform: translateY(0);
        }
        .categorias-conteudo a {
            display: block; padding: 12px; color: var(--marrom-escuro);
            text-decoration: none; transition: 0.3s;
        }
        .categorias-conteudo a:hover { background: #f8f3f5; padding-left: 20px; }

        /* ======================
           CONTEÚDO (Espaçamento reduzido)
        ====================== */
        .container {
            width: 100%;
            max-width: 1100px;
            margin: auto;
            padding: 30px 20px; /* Reduzi de 50px */
        }

        .secao { margin-bottom: 40px; } /* Reduzi de 60px */

        .secao h2 {
            color: var(--marrom-escuro);
            margin-bottom: 15px;
            font-size: 32px;
            border-left: 5px solid var(--rosa-escuro);
            padding-left: 15px;
        }

        .apresentacao-clube {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            line-height: 1.6;
        }

        /* ======================
           CARDS (Mesmo estilo da Index)
        ====================== */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.08);
            transition: 0.3s;
            border: 1px solid #eee;
        }

        .card:hover { transform: translateY(-5px); box-shadow: 0px 8px 20px rgba(0,0,0,0.12); }
        .card img { width: 100%; height: 180px; object-fit: cover; }
        .card-conteudo { padding: 20px; }
        .card-conteudo h3 { color: var(--marrom-escuro); margin-bottom: 10px; }

        /* ======================
           DEPOIMENTOS
        ====================== */
        .depoimento {
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            border-bottom: 4px solid var(--rosa-escuro);
            box-shadow: 0 4px 10px rgba(0,0,0,0.04);
        }

        .depoimento h4 { color: var(--marrom-claro); margin-bottom: 10px; }
        .depoimento p { font-style: italic; color: #555; font-size: 15px; }

        /* ======================
           FOOTER (Igual à Index)
        ====================== */
        footer {
          background-color: #2d1f1f;
          color: white;
          padding: 30px 20px;
          text-align: center;
          margin-top: 40px;
        }
    </style>
</head>

<body>

    <header>
        <div class="logo-area">
            <div class="logo"><img src="img/logoNova.png" alt="Logo"></div>
            <div class="nome-empresa"><img src="img/CORUJOTECA.png" alt="Corujoteca"></div>
        </div>

        <nav class="menu-superior">
            <a href="index.php">Início</a>
            <div class="dropdown-categorias">
                <button class="btn-categorias">Categorias</button>
                <div class="categorias-conteudo">
                    <a href="categoria.php?cat=antropologia">Antropologia</a>
                <a href="categoria.php?cat=artes">Artes</a>
                <a href="categoria.php?cat=auto-ajuda">Auto Ajuda</a>
                <a href="categoria.php?cat=biografias">Biografias</a>
                <a href="categoria.php?cat=ciencia-politica">Ciência Política</a>
                <a href="categoria.php?cat=comunicacao">Comunicação</a>
                <a href="categoria.php?cat=direito">Direito</a>
                <a href="categoria.php?cat=engenharia">Engenharia</a>
                <a href="categoria.php?cat=historia-do-brasil">História do Brasil</a>
                </div>
            </div>
            <a href="faleconosco.php">Contato</a>
        </nav>
    </header>

    <main>
        <div class="container">

            <section class="secao">
                <h2>Sobre o Clube</h2>
                <div class="apresentacao-clube">
                    <p>
                        O Clube do Livro da Corujoteca une leitores apaixonados em um ambiente acolhedor. 
                        Realizamos encontros presenciais e digitais para debater obras que transformam nossa visão de mundo.
                    </p>
                </div>
            </section>

            <section class="secao">
                <h2>Projetos</h2>
                <div class="cards">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?q=80&w=600" alt="Leitura">
                        <div class="card-conteudo">
                            <h3>Leitura Coletiva</h3>
                            <p>Discussões mensais sobre clássicos e novidades literárias.</p>
                        </div>
                    </div>

                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?q=80&w=600" alt="Jovens">
                        <div class="card-conteudo">
                            <h3>Jovens Leitores</h3>
                            <p>Incentivo à leitura para adolescentes com desafios criativos.</p>
                        </div>
                    </div>

                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=600" alt="Café">
                        <div class="card-conteudo">
                            <h3>Café Literário</h3>
                            <p>Encontros com autores e integração entre os membros.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="secao">
                <h2>O que dizem nossos leitores</h2>
                <div class="cards">
                    <div class="depoimento">
                        <h4>Ana Beatriz</h4>
                        <p>“O Clube me ajudou a recuperar o hábito de ler. Os debates são enriquecedores!”</p>
                    </div>
                    <div class="depoimento">
                        <h4>Lucas Henrique</h4>
                        <p>“Conheci pessoas incríveis e livros que nunca leria sozinho. Recomendo muito.”</p>
                    </div>
                </div>
            </section>

        </div>
    </main>

    <footer>
        © 2026 Corujoteca - Todos os direitos reservados.
    </footer>

</body>
</html>