<?php
session_start();
include('conexao.php'); // Inclua a conexão com o banco de dados

// Verifica se o usuário está logado
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Array para armazenar os IDs dos jogos favoritados
$favorited_games = [];

if ($user_id) {
  $query = "SELECT id_jogo FROM favoritos WHERE id_user = :id_user";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':id_user', $user_id, PDO::PARAM_INT);
  $stmt->execute();
  $favorited_games = $stmt->fetchAll(PDO::FETCH_COLUMN, 0); // Retorna uma array com os IDs dos jogos
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GameVerse - Home</title>
  <link rel="stylesheet" href="/HTML_PROJECT/styles/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <script src="/HTML_PROJECT/scripts/script-header.js"></script>
</head>

<body>
  <header>
    <div class="content">
      <nav>
        <p class="brand">
          <a href="index.php">Game<strong>Verse</strong></a>
        </p>
        <ul>
          <li><a href="#games">Jogos</a></li>
          <li><a href="#galery">Notícias</a></li>
          <li><a href="#about">Sobre</a></li>

          <?php if (isset($_SESSION['usuario'])): ?>
            <!-- Dropdown para o usuário logado -->
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
            <li><button onclick="window.location.href='login.php'">Login</button></li>
          <?php endif; ?>
        </ul>
      </nav>
      <div class="header-block">
        <div class="carousel-header">
          <div class="imagens-header fade-header">
            <img src="/HTML_PROJECT/assets/Group 1.png" alt="Imagem1">
            <img src="/HTML_PROJECT/assets/Group 2.png" alt="Imagem2">
            <img src="/HTML_PROJECT/assets/lançamento1.png" alt="Imagem3">
          </div>
          <button class="button-header prev-header" onclick="move(-1)">&#10094;</button>
          <button class="button-header next-header" onclick="move(1)">&#10095;</button>
        </div>
      </div>
    </div>
  </header>

  <section class="catalog" id="games">
    <div class="content">
      <div class="title-wrapper-catalog">
        <p>Encontre seu jogo favorito</p>
        <h3>Jogos</h3>
      </div>

      <!-- BUSCA -->
      <div class="filter-card">
        <input
          type="text"
          class="search-input"
          placeholder="Digite o nome do jogo.."
          oninput="filtergames()" />
        <button class="search-button" onclick="filtergames()">Buscar</button>
      </div>

      <div class="card-wrapper">
        <div class="card-item">
          <?php
          $jogo_id = 1; // ID do jogo (no futuro, este valor será dinâmico)
          $is_favorited = in_array($jogo_id, $favorited_games);
          ?>
          <div class="favorite-icon" onclick="toggleFavorite(this, <?php echo $jogo_id; ?>)" data-id-jogo="<?php echo $jogo_id; ?>" data-favoritado="<?php echo $is_favorited ? 'true' : 'false'; ?>" style="color: <?php echo $is_favorited ? 'red' : ''; ?>;"> &#9829; <!-- Coração -->
          </div>
          <img src="/HTML_PROJECT/assets/Academic Adventure.png" alt="adventure" />
          <div class="card-content">
            <h3>Academic Adventure</h3>
            <p>Academic Adventure é um jogo de aventura...</p>
            <button type="button" onclick="window.location.href='academic_adventure.php'">Veja Mais</button>
          </div>
        </div>

      </div>
    </div>
  </section>


  <section class="galery" id="galery">
    <div class="content">
      <div class="texto">
        <p>Veja nossas principais notícias</p>
        <h3>Notícias</h3>
      </div>
      <div class="carousel">
        <div class="imagens fade">
          <img src="/HTML_PROJECT/assets/Group 1.png" alt="Imagem1">
          <img src="/HTML_PROJECT/assets/Group 2.png" alt="Imagem2">
          <img src="/HTML_PROJECT/assets/lançamento1.png" alt="Imagem3">
        </div>
        <button class="button prev" onclick='move(-1)'>&#10094;</button>
        <button class="button next" onclick='move(1)'>&#10095;</button>
      </div>
    </div>
  </section>

  <section class="features" id="about">
    <div class="content">
      <div class="title-wrapper-features">
        <p>Conheça sobre nosso site</p>
        <h3>Sobre</h3>
      </div>
      <div class="feature-card-block">
        <div class="feature-card-item">
          <img src="/HTML_PROJECT/assets/hello_5110575.png" alt="welcome">
          <div class="feature-text-content">
            <h3>Bem-vindo ao GameVerse</h3>
            <p>Sua fonte definitiva sobre jogos acadêmicos.</p>
          </div>
        </div>
        <div class="feature-card-item">
          <img src="/HTML_PROJECT/assets/history_1825422.png" alt="Feature">
          <div class="feature-text-content">
            <h3>Nossa História</h3>
            <p>Criado em 2023, unimos tecnologia e jogos para promover aprendizado e diversão.</p>
          </div>
        </div>
        <div class="feature-card-item">
          <img src="/HTML_PROJECT/assets/business-teamwork_17612865.png" alt="Feature">
          <div class="feature-text-content">
            <h3>Equipe</h3>
            <p>Formada por entusiastas na área de tecnologia, nossa equipe garante conteúdo exclusivo sobre jogos acadêmicos.</p>
          </div>
        </div>
        <div class="feature-card-item">
          <img src="/HTML_PROJECT/assets/goal_6756991.png" alt="Feature">
          <div class="feature-text-content">
            <h3>Nossos Objetivos</h3>
            <p>Queremos ajudar você a aprimorar suas habilidades e aproveitar ao máximo sua experiência de jogo.</p>
          </div>
        </div>
        <div class="feature-card-item">
          <img src="/HTML_PROJECT/assets/impact_11152615.png" alt="Feature">
          <div class="feature-text-content">
            <h3>Nossos Valores</h3>
            <p>Valorizamos a integridade, estamos comprometidos em fornecer conteúdo honesto e de qualidade.</p>
          </div>
        </div>
        <div class="feature-card-item">
          <img src="/HTML_PROJECT/assets/telephone-call_3059457.png" alt="Feature">
          <div class="feature-text-content">
            <h3>Entre em Contato</h3>
            <p>Estamos prontos para ouvir você. Entre em contato conosco, faça uma parceria de sucesso.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="main">
      <div class="content footer-links">
        <div class="footer-company">
          <h4>Nosso Site</h4>
          <h6>Sobre</h6>
          <h6>Contato</h6>
          <h6>Nossos Parceiros</h6>
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
  <script src="/HTML_PROJECT/scripts/filtergames.js"></script>
  <script src="/HTML_PROJECT/scripts/index.js"></script>

</body>

</html>