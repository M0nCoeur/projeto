<?php
session_start();
include('conexao.php');

// Função para verificar se o jogo está favoritado
function isFavorited($conn, $user_id, $jogo_id)
{
  $query = "SELECT * FROM favoritos WHERE id_user = :id_user AND id_jogo = :id_jogo";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':id_user', $user_id, PDO::PARAM_INT);
  $stmt->bindParam(':id_jogo', $jogo_id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->rowCount() > 0;
}

// Função para verificar se o usuário já avaliou o jogo
function isAlreadyReviewed($conn, $user_id, $jogo_id)
{
  $query_check_review = "SELECT * FROM avaliacoes WHERE id_user = :id_user AND id_jogo = :id_jogo";
  $stmt_check_review = $conn->prepare($query_check_review);
  $stmt_check_review->bindParam(':id_user', $user_id, PDO::PARAM_INT);
  $stmt_check_review->bindParam(':id_jogo', $jogo_id, PDO::PARAM_INT);
  $stmt_check_review->execute();
  return $stmt_check_review->rowCount() > 0;
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$jogo_id = 1; // Este valor pode ser dinâmico dependendo do jogo

// Verifica se o jogo está favoritado e se o usuário já avaliou
$is_favorited = $user_id ? isFavorited($conn, $user_id, $jogo_id) : false;
$is_already_reviewed = $user_id ? isAlreadyReviewed($conn, $user_id, $jogo_id) : false;

// Calcular a média das avaliações
$query_avg = "
    SELECT AVG(nota) as media 
    FROM avaliacoes 
    WHERE id_jogo = :id_jogo
";
$stmt_avg = $conn->prepare($query_avg);
$stmt_avg->bindParam(':id_jogo', $jogo_id, PDO::PARAM_INT);
$stmt_avg->execute();
$avg_rating = $stmt_avg->fetchColumn();

// Arredonda a média para 1 casa decimal
$media_avaliacoes = round($avg_rating, 1);

// Gera as estrelas com base na média
$stars = '';
$rating = round($media_avaliacoes); // Arredonda a média para o inteiro mais próximo

for ($i = 1; $i <= 5; $i++) {
  if ($i <= $rating) {
    $stars .= '<i class="fas fa-star"></i>'; // Estrela cheia
  } else {
    $stars .= '<i class="far fa-star"></i>'; // Estrela vazia
  }
}

// Lógica para carregar as primeiras 5 avaliações
$query_reviews = "SELECT avaliacoes.*, user.nome FROM avaliacoes JOIN user ON avaliacoes.id_user = user.id_user WHERE avaliacoes.id_jogo = :id_jogo ORDER BY avaliacoes.data_avaliacao DESC LIMIT 5";
$stmt_reviews = $conn->prepare($query_reviews);
$stmt_reviews->bindParam(':id_jogo', $jogo_id, PDO::PARAM_INT);
$stmt_reviews->execute();
$reviews = $stmt_reviews->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GameVerse - Academic Adventure</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="/HTML_PROJECT/styles/academic_adventure.css">
  <script src="/HTML_PROJECT/scripts/academic_adventure.js" defer></script>
  <script src="/HTML_PROJECT/scripts/reviews.js" defer></script>
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
            <li class="dropdown">
              <div class="user-container" onclick="toggleDropdown()">
                <span>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
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
    <section class="hero">
      <video autoplay muted loop id="hero-video">
        <source src="https://github.com/M0nCoeur/projeto/raw/main/assets/video-bg.mp4" type="video/mp4">
        Seu navegador não suporta o vídeo.
      </video>

      <div class="hero-content">
        <img src="https://github.com/M0nCoeur/projeto/raw/main/assets/logo-sem-fundo.png" alt="Banner do Jogo" class="hero-image">
        <div class="hero-text">
          <h1>Academic Adventure</h1>
          <p>Embarque em uma emocionante jornada pelo mundo da TI. Resolva desafios, conquiste conhecimentos e alcance seu diploma!</p>
          <button onclick="window.location.href='#download'" class="download-btn">Baixar Agora</button>
        </div>

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

    <section id="about" class="about">
      <h2>Sobre o Jogo</h2>
      <div class="about-content">
        <img src="https://github.com/M0nCoeur/projeto/raw/main/assets/logo-game.jpg" alt="Sobre o jogo" class="about-image">
        <p>Os jogadores mergulham em uma aventura ambientada em uma instituição de ensino voltada para a tecnologia da informação. Explore ambientes interativos, enfrente desafios e desenvolva habilidades essenciais enquanto desbloqueia conhecimentos e interage com personagens intrigantes.</p>
      </div>
    </section>

    <section id="gallery" class="gallery">
      <h2>Galeria</h2>
      <div class="carousel">
        <img src="/HTML_PROJECT/assets/imagem_1" alt="Imagem 1" onclick="openModal(this)">
        <img src="/HTML_PROJECT/assets/imagem_2" alt="Imagem 2" onclick="openModal(this)">
        <img src="/HTML_PROJECT/assets/imagem_3" alt="Imagem 3" onclick="openModal(this)">
      </div>
    </section>

    <div id="imageModal" class="modal">
      <span class="close" onclick="closeModal()">&times;</span>
      <img class="modal-content" id="modalImage">
      <div id="caption"></div>
    </div>

    <section id="reviews" class="reviews">
      <h2>Avaliações</h2>
      <div class="reviews-container" id="reviews-container">

        <!-- Exibição da média das avaliações -->
        <section id="average-rating" class="average-rating">
          <h3>Média das Avaliações</h3>
          <p>Este jogo tem uma média de avaliação de:
            <span class="star-rating-med"><?php echo $stars; ?></span>
            <span class="average-score">(<?php echo $media_avaliacoes; ?>/5)</span>
          </p>
        </section>

        <?php
        $query_reviews = "
SELECT avaliacoes.*, user.nome 
FROM avaliacoes 
JOIN user ON avaliacoes.id_user = user.id_user 
WHERE avaliacoes.id_jogo = :id_jogo 
ORDER BY avaliacoes.data_avaliacao DESC 
LIMIT 5
";
        $stmt_reviews = $conn->prepare($query_reviews);
        $stmt_reviews->bindParam(':id_jogo', $jogo_id, PDO::PARAM_INT);
        $stmt_reviews->execute();
        $reviews = $stmt_reviews->fetchAll();

        if (count($reviews) > 0) {
          foreach ($reviews as $review) {
            $nota = $review['nota'];
            $stars = '';
            for ($i = 1; $i <= 5; $i++) {
              if ($i <= $nota) {
                $stars .= '<i class="fas fa-star"></i>'; // Estrela cheia
              } else {
                $stars .= '<i class="far fa-star"></i>'; // Estrela vazia
              }
            }

            echo "<div class='review-card'>";
            echo "<p><strong>Nota:</strong> <span class='star-rating'>$stars</span></p>";
            echo "<p><strong>Comentário:</strong> " . htmlspecialchars($review['comentario']) . "</p>";
            echo "<p><small>Por: " . htmlspecialchars($review['nome']) . " em " . htmlspecialchars($review['data_avaliacao']) . "</small></p>";
            echo "</div>";
          }
        } else {
          echo "<p>Ainda não há avaliações para este jogo.</p>";
        }

        ?>
      </div>

      <button id="show-all-reviews" onclick="loadMoreReviews()" data-jogo-id="<?php echo $jogo_id; ?>">Ver Mais Avaliações</button>
      <div id="reviews-list"></div>
    </section>


    <section id="add-review" class="add-review">
      <?php if ($user_id && !$is_already_reviewed): ?>
        <h2>Deixe sua Avaliação</h2>
        <form action="submit_review.php" method="POST" onsubmit="return validateReviewForm()">
          <input type="hidden" name="id_jogo" value="<?php echo $jogo_id; ?>">

          <!-- Nova seção para as estrelas -->
          <label for="nota">Nota:</label>
          <div class="game-star-rating" id="game-rating">
            <i class="fas fa-star" data-value="1"></i>
            <i class="fas fa-star" data-value="2"></i>
            <i class="fas fa-star" data-value="3"></i>
            <i class="fas fa-star" data-value="4"></i>
            <i class="fas fa-star" data-value="5"></i>
          </div>

          <input type="hidden" id="nota" name="nota" value="0"> <!-- Valor da nota -->

          <label for="comentario">Comentário:</label>
          <textarea name="comentario" id="comentario" rows="4" required></textarea>

          <button type="submit">Enviar Avaliação</button>
        </form>
      <?php elseif ($user_id && $is_already_reviewed): ?>
        <div class="message">
          <p>Você já avaliou este jogo.</p>
        </div>
      <?php else: ?>
        <div class="message">
          <p>Você precisa estar logado para avaliar o jogo.</p>
        </div>
      <?php endif; ?>
    </section>




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
  <script src="/HTML_PROJECT/scripts/star.js"></script>
  <script>
    function validateReviewForm() {
      const comentario = document.getElementById('comentario').value.trim();
      if (comentario.length < 10) {
        alert('O comentário deve ter pelo menos 10 caracteres.');
        return false;
      }
      return true;
    }
  </script>
</body>

</html>