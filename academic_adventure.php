<?php
session_start();
include('conexao.php');

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$jogo_id = 1; // ID do jogo. Você pode substituir com o ID do jogo que deseja favoritar

$is_favorited = false;
if ($user_id) {
  $query = "SELECT * FROM favoritos WHERE id_user = :id_user AND id_jogo = :id_jogo";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':id_user', $user_id, PDO::PARAM_INT);
  $stmt->bindParam(':id_jogo', $jogo_id, PDO::PARAM_INT);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $is_favorited = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GameVerse - Academic Adventure</title>
  <link rel="stylesheet" href="/HTML_PROJECT/styles/academic_adventure.css">
  <script src="/HTML_PROJECT/scripts/academic_adventure.js" defer></script>
</head>

<body>
  <header>
    <div class="content">
      <nav>
        <p class="brand">
          <a href="index.php">Game<strong>Verse</strong></a>
        </p>
        <ul>
          <li><a href="index.php#games">Jogos</a></li>
          <li><a href="index.php#galery">Notícias</a></li>
          <li><a href="index.php#about">Sobre</a></li>
          <?php if (isset($_SESSION['usuario'])): ?>
            <li class="dropdown">
              <div class="user-container" onclick="toggleDropdown()">
                <span>Olá, <?php echo $_SESSION['usuario']; ?></span>
                <i class="uil uil-user-circle"></i>
              </div>
              <ul class="dropdown-menu">
                <li><a href="myaccount.php">Minha Conta</a></li>
                <li><a href="jogos_favoritos.php">Jogos Favoritos</a></li>
                <li><a href="reviews.php">Minhas Avaliações</a></li>
              </ul>
            </li>
            <li><button onclick="window.location.href='logout.php'">Sair</button></li>
          <?php else: ?>
            <li><button onclick="window.location.href='login.php'">Entrar</button></li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <!-- Section Inicial -->
    <section class="hero">
      <!-- Vídeo de fundo -->
      <video autoplay muted loop id="hero-video">
        <source src="https://github.com/M0nCoeur/projeto/raw/main/assets/video-bg.mp4" type="video/mp4">
        Seu navegador não suporta o vídeo.
      </video>

      <div class="hero-content">
        <img src="https://github.com/M0nCoeur/projeto/raw/main/assets/logo-game.jpg" alt="Banner do Jogo" class="hero-image">
        <div class="hero-text">
          <h1>Academic Adventure</h1>
          <p>Embarque em uma emocionante jornada pelo mundo da TI. Resolva desafios, conquiste conhecimentos e alcance seu diploma!</p>
          <button onclick="window.location.href='#download'" class="download-btn">Baixar Agora</button>
        </div>

        <!-- Botão Favoritar ao lado da imagem -->
        <?php if ($user_id): ?>
          <div class="favorite-container" id="favorite-container">
            <div class="favorite-icon" onclick="toggleFavorite()" style="color: <?php echo $is_favorited ? 'red' : ''; ?>;">
              &#9829; <!-- Coração -->
            </div>
            <span id="favorite-text"><?php echo $is_favorited ? 'Favoritado' : 'Favoritar'; ?></span>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- Outras Seções -->
    <!-- Section Sobre -->
    <section id="about" class="about">
      <h2>Sobre o Jogo</h2>
      <div class="about-content">
        <img src="https://github.com/M0nCoeur/projeto/raw/main/assets/logo-game.jpg" alt="Sobre o jogo" class="about-image">
        <p>Os jogadores mergulham em uma aventura ambientada em uma instituição de ensino voltada para a tecnologia da informação. Explore ambientes interativos, enfrente desafios e desenvolva habilidades essenciais enquanto desbloqueia conhecimentos e interage com personagens intrigantes.</p>
      </div>
    </section>

    <!-- Sections do Carrousel -->
    <section id="gallery" class="gallery">
      <h2>Galeria</h2>
      <div class="carousel">
        <img src="https://github.com/M0nCoeur/projeto/raw/main/assets/imagem_1.jpg" alt="Imagem 1" onclick="openModal(this)">
        <img src="https://github.com/M0nCoeur/projeto/raw/main/assets/imagem_1.jpg" alt="Imagem 2" onclick="openModal(this)">
        <img src="https://github.com/M0nCoeur/projeto/raw/main/assets/imagem_1.jpg" alt="Imagem 3" onclick="openModal(this)">
      </div>
    </section>

    <!-- Modal com as imagens-->
    <div id="imageModal" class="modal">
      <span class="close" onclick="closeModal()">&times;</span>
      <img class="modal-content" id="modalImage">
      <div id="caption"></div>
    </div>

    <!-- Section de Download -->
    <section id="download" class="download">
      <h2>Baixe Agora</h2>
      <p>Disponível para sistema Windows 10 e 11. Clique no logotipo do sistema operacional para fazer o download.</p>
      <div class="download-buttons">
        <a href="https://github.com/M0nCoeur/projeto/raw/refs/heads/main/assets/video-bg.mp4" class="btn google">
          <img src="/HTML_PROJECT/assets/store2.png" alt="Windows">
          Windows
        </a>
      </div>
    </section>
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

  <script src="/HTML_PROJECT/scripts/drop.js"></script>
  <script src="/HTML_PROJECT/scripts/game.js"></script>
</body>

</html>