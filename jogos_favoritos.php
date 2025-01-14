<?php
session_start();
include 'conexao.php'; // Certifique-se de que o caminho do arquivo está correto

if (!isset($conn)) {
    echo "Erro: A conexão com o banco de dados não foi estabelecida.";
    exit();
}

if (!isset($_SESSION['user_id'])) {
    echo "Você precisa estar logado para acessar seus favoritos.";
    exit();
}

$id_user = $_SESSION['user_id']; // Pega o ID do usuário logado

// Consulta para pegar todos os jogos favoritados
$query = "SELECT j.* FROM jogos j
          JOIN favoritos f ON j.id = f.id_jogo
          WHERE f.id_user = :id_user";
$stmt = $conn->prepare($query);  // Usando $conn para a conexão
$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
$stmt->execute();

$favoritos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVerse - Jogos Favoritos</title>
    <link rel="stylesheet" href="/HTML_PROJECT/styles/favorites.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
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

<?php if (empty($favoritos)): ?>
    <div class="no-favorites">
    <div class="no-favorites-message">
        <h2>Você não tem jogos favoritos ainda!</h2>
        <p>Adicione alguns aos seus favoritos.</p>
    </div>
    </div>
<?php else: ?>
    <section class="catalog" id="games">
        <div class="content">
            <div class="title-wrapper-catalog">
                <p>Seus Jogos Favoritos</p>
                <h3>Jogos</h3>
            </div>

            <div class="card-wrapper">
                <?php foreach ($favoritos as $jogo): ?>
                    <div class="card-item_fav">
                        <!-- Ícone de favoritar dentro do card -->
                        <div class="favorite-icon" onclick="toggleFavorite(this)" data-id-jogo="<?= $jogo['id'] ?>" data-favoritado="true" style="color: red;">
                            &#9829; <!-- Coração para indicar que está favoritado -->
                        </div>
                        <img src="<?= $jogo['imagem'] ?>" alt="<?= $jogo['nome'] ?>" />
                        <div class="card-content">
                            <h3><?= $jogo['nome'] ?></h3>
                            <p><?= $jogo['descricao'] ?></p>
                            <button type="button" onclick="window.location.href='academic_adventure.php?id=<?= $jogo['id'] ?>'">Veja Mais</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

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
<script src="/HTML_PROJECT/scripts/favorite.js"></script>
</body>
</html>
