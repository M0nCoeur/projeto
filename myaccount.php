<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVerse - Home</title>
    <link rel="stylesheet" href="/HTML_PROJECT/styles/myaccount.css">
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
                    <!-- Dropdown para o usuário logado -->
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
    </header>

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
</body>
</html>
