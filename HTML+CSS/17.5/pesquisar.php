<?php
session_start();

// Conexão com o banco
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bancoBiblioteca";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

// Recebe o termo de busca via GET
$q_raw = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($q_raw === '') {
    $mensagem_vazia = "Por favor, digite um termo para pesquisar.";
}

$results = [];
if ($q_raw !== '') {
    if (mb_strlen($q_raw) < 2) {
        $mensagem_vazia = "Digite ao menos 2 caracteres para pesquisar.";
    } else {
        $term = '%' . $q_raw . '%';
        $sql = "SELECT id, titulo, autor, imagem FROM livros 
                WHERE titulo LIKE ? OR autor LIKE ? 
                LIMIT 100";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('ss', $term, $term);
            $stmt->execute();
            $res = $stmt->get_result();
            while ($row = $res->fetch_assoc()) {
                $results[] = $row;
            }
            $stmt->close();
        } else {
            $erro = "Erro na busca: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Resultados da pesquisa - Biblioteca</title>
  <link rel="shortcut icon" href="img/FAVICON-Photoroom.ico" type="image/x-icon">

  <!-- Ícone da seta -->
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

  <style>
    body{
      font-family: "Segoe UI", Arial, sans-serif;
      background:#f2f6fa;
      color:#222;
      margin:0;
      padding:20px;
    }

    .container{
      max-width:1100px;
      margin:0 auto;
      margin-top: 60px; /* espaço por causa da seta */
    }

    /* 🔙 Seta igual ao login.php */
    .back-button {
        position: absolute;
        top: 1rem;
        left: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #bfa14a; /* dourado */
        color: #ffffff;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        text-decoration: none;
        font-size: 1.2rem;
        transition: 0.3s;
        z-index: 999;
    }

    .back-button:hover {
        background-color: #1e3a5f; /* azul escuro */
    }

    header{
      margin-bottom:20px;
    }

    .mensagem{
      padding:12px;
      background:#fff;
      border:1px solid #ddd;
      border-radius:8px;
      margin-bottom:16px;
    }

    .grid{
      display:grid;
      grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
      gap:18px;
    }

    .card{
      background:#fff;
      border:1px solid #ddd;
      border-radius:10px;
      overflow:hidden;
      box-shadow:0 3px 6px rgba(0,0,0,0.05);
    }

    .card img{
      width:100%;
      height:280px;
      object-fit:cover;
      background:#eee;
      display:block;
    }

    .card-body{
      padding:12px;
    }

    .card-body h3{
      margin:0 0 8px;
      font-size:16px;
      color:#1e3a5f;
    }

    .card-body p{
      margin:0;
      color:#6b6b6b;
      font-size:14px;
    }

    .botao{
      display:inline-block;
      margin-top:10px;
      padding:8px 10px;
      background:#1e3a5f;
      color:#fff;
      border-radius:6px;
      text-decoration:none;
      font-size:13px;
    }
  </style>
</head>

<body>

  <!-- 🔙 Seta igual ao login -->
  <a href="index.php" class="back-button"><i class='bx bx-arrow-back'></i></a>

  <div class="container">

    <header>
      <h1>Resultados para: "<?php echo htmlspecialchars($q_raw, ENT_QUOTES, 'UTF-8'); ?>"</h1>
    </header>

    <?php if (!empty($mensagem_vazia)): ?>
      <div class="mensagem"><?php echo htmlspecialchars($mensagem_vazia, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <?php if (!empty($erro)): ?>
      <div class="mensagem">Erro: <?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <?php if ($q_raw !== '' && empty($mensagem_vazia) && empty($erro)): ?>
      <?php if (count($results) === 0): ?>
        <div class="mensagem">Nenhum resultado encontrado para "<?php echo htmlspecialchars($q_raw, ENT_QUOTES, 'UTF-8'); ?>".</div>
      <?php else: ?>
        <div class="grid">
          <?php foreach ($results as $row): 
            $id = (int)$row['id'];
            $titulo = htmlspecialchars($row['titulo'], ENT_QUOTES, 'UTF-8');
            $autor = htmlspecialchars($row['autor'], ENT_QUOTES, 'UTF-8');
            $imagemPath = !empty($row['imagem']) ? 'fotos/' . htmlspecialchars($row['imagem'], ENT_QUOTES, 'UTF-8') : 'img/capa_padrao.png';
          ?>
            <div class="card">
              <a href="livro.php?id=<?php echo urlencode($id); ?>">
                <img src="<?php echo $imagemPath; ?>" alt="<?php echo $titulo; ?>">
              </a>
              <div class="card-body">
                <h3><?php echo $titulo; ?></h3>
                <p><?php echo $autor; ?></p>
                <a class="botao" href="livro.php?id=<?php echo urlencode($id); ?>">Ver detalhes</a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>

  </div>
</body>
</html>
