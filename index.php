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
<html lang="pt-br">

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

<div class="accessibility-controls" id="accessibility-controls">
  <button id="increase-font" aria-label="Aumentar tamanho da fonte">A+</button>
  <button id="reset-font-size" aria-label="Restaurar o tamanho da fonte original">A</button>
  <button id="decrease-font" aria-label="Diminuir tamanho da fonte">A-</button>
  <button id="toggle-contrast" aria-label="Alternar contraste">Contraste</button>
  <button id="close-accessibility" aria-label="Fechar painel de acessibilidade">Fechar</button>
</div>

<!-- Botão para abrir o painel -->
<button id="open-accessibility" aria-label="Abrir painel de acessibilidade">Acessibilidade</button>


  <header>
    <div class="content">
      <nav aria-label="Menu de navegação principal">
        <p class="brand">
          <a href="index.php">
            <img src="/HTML_PROJECT/assets/Logo2.png" alt="Logo GameVerse" class="logo">
          </a>
        </p>

        <ul>
          <li><a href="#games" aria-label="Ir para a seção de jogos">Jogos</a></li>
          <li><a href="#galery" aria-label="Ir para a seção de notícias">Notícias</a></li>
          <li><a href="#about" aria-label="Ir para a seção sobre o site">Sobre</a></li>

          <?php if (isset($_SESSION['usuario'])): ?>
            <!-- Dropdown para o usuário logado -->
            <li class="dropdown">
              <div class="user-container" onclick="toggleDropdown()" aria-haspopup="true" aria-expanded="false">
                <span>Olá, <?php echo $_SESSION['usuario']; ?></span>
                <i class="uil uil-user-circle"></i>
              </div>
              <ul class="dropdown-menu" role="menu">
                <li><a href="myaccount.php" role="menuitem" aria-label="Acessar a conta">Conta</a></li>
                <li><a href="jogos_favoritos.php" role="menuitem" aria-label="Ver jogos favoritos">Jogos Favoritos</a></li>
                <li><a href="reviews.php" role="menuitem" aria-label="Acessar as avaliações">Avaliações</a></li>
              </ul>
            </li>
            <li><button onclick="window.location.href='logout.php'" aria-label="Sair do site">Sair</button></li>
          <?php else: ?>
            <li><button onclick="window.location.href='login.php'" aria-label="Fazer login">Login</button></li>
          <?php endif; ?>
        </ul>
      </nav>
      <div class="header-block">
        <div class="carousel-header">
          <div class="imagens-header fade-header" aria-live="polite">
            <img src="/HTML_PROJECT/assets/Group 2.png" alt="Imagem de destaque 1">
            <img src="/HTML_PROJECT/assets/Group 2.png" alt="Imagem de destaque 2">
            <img src="/HTML_PROJECT/assets/Group 1.png" alt="Imagem de destaque 3">
          </div>
          <button class="button-header prev-header" onclick="move(-1)" aria-label="Imagem anterior">&#10094;</button>
          <button class="button-header next-header" onclick="move(1)" aria-label="Próxima imagem">&#10095;</button>
        </div>
      </div>
    </div>
  </header>

  <section class="catalog" id="games" aria-labelledby="games-title">
    <div class="content">
      <div class="title-wrapper-catalog">
        <p>Encontre seu jogo favorito</p>
        <h3 id="games-title">Jogos</h3>
      </div>

      <!-- BUSCA -->
      <div class="filter-card">
        <label for="search-input" class="sr-only">Digite o nome do jogo</label>
        <input
          type="text"
          class="search-input"
          id="search-input"
          placeholder="Digite o nome do jogo.."
          oninput="filtergames()"
          aria-labelledby="search-input" />
        <button class="search-button" onclick="filtergames()" aria-label="Buscar jogos">Buscar</button>
      </div>

      <!-- Card Academic Adventure -->
      <div class="card-wrapper">
        <div class="card-item">
          <?php
          $jogo_id = 1; // ID do jogo (no futuro, este valor será dinâmico)
          $is_favorited = in_array($jogo_id, $favorited_games);
          ?>
          <div class="favorite-icon" onclick="toggleFavorite(this, <?php echo $jogo_id; ?>)" data-id-jogo="<?php echo $jogo_id; ?>" data-favoritado="<?php echo $is_favorited ? 'true' : 'false'; ?>" aria-label="Adicionar aos favoritos" aria-pressed="<?php echo $is_favorited ? 'true' : 'false'; ?>" style="color: <?php echo $is_favorited ? 'red' : ''; ?>;"> &#9829; </div>
          <img src="/HTML_PROJECT/assets/logo-sem-fundo.png" alt="Imagem do jogo Academic Adventure" />
          <div class="card-content">
            <h3>Academic Adventure</h3>
            <p>Uma jornada educativa na área de TI, cheia de desafios e descobertas rumo ao diploma!</p>
            <button type="button" onclick="window.location.href='academic_adventure.php'" aria-label="Saiba mais sobre Academic Adventure">Veja Mais</button>
          </div>
        </div>

        <!-- Card Adm -->
        <div class="card-adm">
          <?php
          $jogo_id = 2; // ID do jogo (no futuro, este valor será dinâmico)
          $is_favorited = in_array($jogo_id, $favorited_games);
          ?>
          <div class="favorite-icon-adm" onclick="toggleFavorite(this, <?php echo $jogo_id; ?>)" data-id-jogo="<?php echo $jogo_id; ?>" data-favoritado="<?php echo $is_favorited ? 'true' : 'false'; ?>" aria-label="Adicionar aos favoritos" aria-pressed="<?php echo $is_favorited ? 'true' : 'false'; ?>" style="color: <?php echo $is_favorited ? 'red' : ''; ?>;"> &#9829; </div>
          <img src="/HTML_PROJECT/assets/adm.png" alt="Imagem do jogo Academic Administração" />
          <div class="card-content-adm">
            <h3>Academic Administração</h3>
            <p>Uma jornada desafiadora e enriquecedora em Administração, rumo ao diploma!</p>
            <button type="button" aria-label="Em breve, informações sobre o jogo Academic Administração">Em Breve</button>
          </div>
        </div>

        <!-- Card Security -->
        <div class="card-sec">
          <?php
          $jogo_id = 3; // ID do jogo (no futuro, este valor será dinâmico)
          $is_favorited = in_array($jogo_id, $favorited_games);
          ?>
          <div class="favorite-icon-sec" onclick="toggleFavorite(this, <?php echo $jogo_id; ?>)" data-id-jogo="<?php echo $jogo_id; ?>" data-favoritado="<?php echo $is_favorited ? 'true' : 'false'; ?>" aria-label="Adicionar aos favoritos" aria-pressed="<?php echo $is_favorited ? 'true' : 'false'; ?>" style="color: <?php echo $is_favorited ? 'red' : ''; ?>;"> &#9829; </div>
          <img src="/HTML_PROJECT/assets/Logo4.png" alt="Imagem do jogo Academic Security" />
          <div class="card-content-sec">
            <h3>Academic Security</h3>
            <p>Uma jornada desafiadora e transformadora em Segurança, rumo ao diploma!</p>
            <button type="button" aria-label="Em breve, informações sobre o jogo Academic Security">Em Breve</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="galery" id="galery" aria-labelledby="news-title">
    <div class="content">
      <div class="texto">
        <p>Veja nossas principais notícias</p>
        <h3 id="news-title">Notícias</h3>
      </div>
      <div class="carousel">
        <div class="imagens fade" aria-live="polite">
          <img src="/HTML_PROJECT/assets/slide4.png" alt="Imagem de notícia 1">
          <img src="/HTML_PROJECT/assets/slide5.png" alt="Imagem de notícia 2">
          <img src="/HTML_PROJECT/assets/Slide6.png" alt="Imagem de notícia 3">
          <img src="/HTML_PROJECT/assets/Slide1.png" alt="Imagem de notícia 4">
        </div>
        <button class="button prev" onclick='move(-1)' aria-label="Imagem anterior">&#10094;</button>
        <button class="button next" onclick='move(1)' aria-label="Próxima imagem">&#10095;</button>
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
        <!-- Cards sobre a empresa -->
        <div class="feature-card-item">
          <img src="/HTML_PROJECT/assets/hello_5110575.png" alt="Ilustração de boas-vindas">
          <div class="feature-text-content">
            <h3>Bem-vindo ao GameVerse</h3>
            <p>Sua fonte definitiva sobre jogos acadêmicos.</p>
          </div>
        </div>
        <div class="feature-card-item">
          <img src="/HTML_PROJECT/assets/history_1825422.png" alt="Ilustração da história do GameVerse">
          <div class="feature-text-content">
            <h3>Nossa História</h3>
            <p>Criado em 2023, unimos tecnologia e jogos para promover aprendizado e diversão.</p>
          </div>
        </div>
        <div class="feature-card-item">
          <img src="/HTML_PROJECT/assets/business-teamwork_17612865.png" alt="Ilustração de equipe">
          <div class="feature-text-content">
            <h3>Equipe</h3>
            <p>Formada por entusiastas na área de tecnologia, nossa equipe garante conteúdo exclusivo sobre jogos acadêmicos.</p>
          </div>
        </div>
        <div class="feature-card-item">
          <img src="/HTML_PROJECT/assets/goal_6756991.png" alt="Ilustração de objetivos">
          <div class="feature-text-content">
            <h3>Nossos Objetivos</h3>
            <p>Queremos ajudar você a aprimorar suas habilidades e aproveitar ao máximo sua experiência de jogo.</p>
          </div>
        </div>
        <div class="feature-card-item">
          <img src="/HTML_PROJECT/assets/impact_11152615.png" alt="Ilustração de impacto social">
          <div class="feature-text-content">
            <h3>Nossos Valores</h3>
            <p>Valorizamos a integridade, estamos comprometidos em fornecer conteúdo honesto e de qualidade.</p>
          </div>
        </div>
        <div class="feature-card-item">
          <img src="/HTML_PROJECT/assets/telephone-call_3059457.png" alt="Ilustração de contato">
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
  <script src="/HTML_PROJECT/scripts/favorite-message.js"></script>
  <script src="/HTML_PROJECT/scripts/accessibility.js"></script>

</body>

</html>