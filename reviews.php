<?php
session_start();
include('conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

// Busca as avaliações do usuário
$query_reviews = "SELECT a.id, a.nota, a.comentario, a.data_avaliacao, j.nome as jogo_nome, j.imagem as jogo_imagem 
                  FROM avaliacoes a 
                  JOIN jogos j ON a.id_jogo = j.id
                  WHERE a.id_user = :id_user";
$stmt_reviews = $conn->prepare($query_reviews);
$stmt_reviews->bindParam(':id_user', $user_id, PDO::PARAM_INT);
$stmt_reviews->execute();
$reviews = $stmt_reviews->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Minhas Avaliações - GameVerse</title>
  <link rel="stylesheet" href="/HTML_PROJECT/styles/reviews.css">
  <script src="/HTML_PROJECT/scripts/drop.js"></script>
</head>

<body>
  <header>
    <div class="content">
      <nav>
        <p class="brand">
          <a href="index.php">
            <img src="/HTML_PROJECT/assets/Logo2.png" alt="Logo GameVerse" class="logo">
          </a>
        </p>
        <ul>
          <li><a href="index.php#games">Jogos</a></li>
          <li><a href="index.php#galery">Notícias</a></li>
          <li><a href="index.php#about">Sobre</a></li>

          <?php if (isset($_SESSION['usuario'])): ?>
            <!-- Dropdown para o usuário logado -->
            <li class="dropdown">
              <div class="user-container" onclick="toggleDropdown()">
                <span>Olá, <?php echo $_SESSION['usuario']; ?></span>
                <i class="uil uil-user-circle"></i>
              </div>
              <ul class="dropdown-menu">
                <li><a href="myaccount.php">Conta</a></li>
                <li><a href="jogos_favoritos.php">Jogos Favoritos</a></li>
                <li><a href="reviews.php">Avaliações</a></li>
              </ul>
            </li>
            <li><button onclick="window.location.href='logout.php'">Sair</button></li>
          <?php else: ?>
            <li><button onclick="window.location.href='login.php'">Login</button></li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <h1>Minhas Avaliações</h1>

    <?php if (empty($reviews)): ?>
      <p>Você ainda não fez nenhuma avaliação. Avalie seus jogos!</p>
    <?php else: ?>
      <div class="reviews-list">
        <?php foreach ($reviews as $review): ?>
          <div class="review-item">
            <div class="review-content">
              <h3><?php echo htmlspecialchars($review['jogo_nome']); ?></h3>
              <div class="stars">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                  <span class="star <?php echo ($review['nota'] >= $i) ? 'filled' : ''; ?>">&#9733;</span>
                <?php endfor; ?>
              </div>
              <p><?php echo htmlspecialchars($review['comentario']); ?></p>
              <p><small>Publicado em: <?php echo date("d/m/Y", strtotime($review['data_avaliacao'])); ?></small></p>
              <a href="edit_review.php?id=<?php echo $review['id']; ?>">Editar Avaliação</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </main>

  <footer>
    <div class="main">
      <div class="content footer-links">
        <div class="footer-company">
          <h4>Nosso Site</h4>
          <h6>Sobre</h6>
          <h6>Contato</h6>
        </div>
        <div class="footer-social">
          <h4>Mantenha-se Conectado</h4>
          <div class="social-icons">
            <img src="/HTML_PROJECT/assets/instagram.png" alt="Instagram">
            <img src="/HTML_PROJECT/assets/facebook.png" alt="Facebook">
            <img src="/HTML_PROJECT/assets/whatsapp-svgrepo-com.png" alt="Whatsapp">
          </div>
        </div>
        <div class="footer-contact">
          <h4>Nosso Contato</h4>
          <h6>+55 31 988776644</h6>
          <h6>turma0043@gmail.com</h6>
          <h6>R. Paineiras, 1300 - Eldorado, Contagem - MG</h6>
        </div>
      </div>
    </div>
    <div class="last">
      GameVerse
    </div>
  </footer>

</body>

</html>