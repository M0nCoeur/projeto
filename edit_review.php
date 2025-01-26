<?php
session_start();
include('conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Verifica se o ID da avaliação foi passado na URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: reviews.php");
    exit();
}

$review_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Busca a avaliação do usuário
$query = "SELECT a.*, j.nome as jogo_nome, j.imagem as jogo_imagem 
          FROM avaliacoes a 
          JOIN jogos j ON a.id_jogo = j.id
          WHERE a.id = :id AND a.id_user = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $review_id, PDO::PARAM_INT);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$review = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se a avaliação existe
if (!$review) {
    header("Location: reviews.php");
    exit();
}

// Processa a edição da avaliação
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nota = $_POST['nota'];
    $comentario = $_POST['comentario'];

    // Atualiza a avaliação no banco de dados
    $update_query = "UPDATE avaliacoes SET nota = :nota, comentario = :comentario WHERE id = :id";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bindParam(':nota', $nota, PDO::PARAM_INT);
    $update_stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
    $update_stmt->bindParam(':id', $review_id, PDO::PARAM_INT);
    $update_stmt->execute();

    // Redireciona de volta para a página de avaliações
    header("Location: reviews.php?success=review-updated");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Avaliação - GameVerse</title>
    <link rel="stylesheet" href="/HTML_PROJECT/styles/edit_review.css">
    <script src="/HTML_PROJECT/scripts/script-header.js"></script>
    <script src="/HTML_PROJECT/scripts/drop.js"></script>
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
            <nav>
                <p class="brand">
                    <a href="index.php">
                        <img src="/HTML_PROJECT/assets/Logo2.png" alt="Logo GameVerse" class="logo">
                    </a>
                </p>
                <ul>
                    <li><a href="index.php#games">Jogos</a></li>
                    <li><a href="index.php#galery">Notícias</a></li>
                    <li><a href="about.php">Sobre Nós</a></li>

                    <?php if (isset($_SESSION['usuario'])): ?>
                        <li class="dropdown">
                            <div class="user-container" onclick="toggleDropdown()">
                                <span>Olá, <?php echo $_SESSION['usuario']; ?></span>
                                <i class="uil uil-user-circle"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a href="myaccount.php">Minha Conta</a></li>
                                <li><a href="favorites.php">Jogos Favoritos</a></li>
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
        <h1>Editar Avaliação - <?php echo htmlspecialchars($review['jogo_nome']); ?></h1>
        <form method="POST">
            <div>
                <label for="nota">Nota:</label>
                <div class="stars">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="star <?php echo ($review['nota'] >= $i) ? 'filled' : ''; ?>" data-value="<?php echo $i; ?>">&#9733;</span>
                    <?php endfor; ?>
                </div>
                <input type="hidden" id="nota" name="nota" value="<?php echo htmlspecialchars($review['nota']); ?>" required>
            </div>

            <div>
                <label for="comentario">Comentário:</label>
                <textarea id="comentario" name="comentario" rows="4" required><?php echo htmlspecialchars($review['comentario']); ?></textarea>
            </div>

            <button class="save" type="submit">Salvar Alterações</button>
        </form>

        <a href="reviews.php">Voltar para Minhas Avaliações</a>
    </main>

    <footer>
        <div class="main">
            <div class="content footer-links">
                <div class="footer-company">
                    <h4>Nosso Site</h4>
                    <a href="/HTML_PROJECT/about.php">Sobre Nós</a>
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
    <script src="/HTML_PROJECT/scripts/accessibility.js"></script>
    <script>
        // Adiciona interação nas estrelas
        const stars = document.querySelectorAll('.star');
        const hiddenInput = document.getElementById('nota');

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const value = star.getAttribute('data-value');
                hiddenInput.value = value;

                // Atualiza as estrelas
                stars.forEach(s => s.classList.remove('filled'));
                for (let i = 0; i < value; i++) {
                    stars[i].classList.add('filled');
                }
            });
        });
    </script>
</body>

</html>