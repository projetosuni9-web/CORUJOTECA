<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clube do Livro - Corujoteca</title>
    <link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">

    

    <link rel="stylesheet" href="clube.css">
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