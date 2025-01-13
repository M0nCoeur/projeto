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
    <link rel="stylesheet" href="/HTML_PROJECT/styles/academic_adventure.css">
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
                  <li><a href="index.php#galery">Baixar</a></li>
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
    </header>
    

   

<section class="sobre">
<div id= "background">
 
 <img src="assets/Academic Adventure.png" alt="">
         </div> 
<div class= "texto">
<div class="titulo">Sobre</div>
<p>Os jogadores mergulham em uma emocionante aventura ambientada em uma instituição de ensino voltada para a tecnologia da informação. Com o objetivo de conquistar o tão almejado diploma, os participantes exploram ambientes interativos, enfrentam desafios relacionados a programação, redes e segurança da informação, e resolvem quebra-cabeças tecnológicos.  Ao longo da jornada, os jogadores desenvolvem habilidades essenciais, desbloqueiam conhecimentos e se conectam com personagens intrigantes, enquanto aprendem sobre o mundo da TI. Prepare-se para uma experiência envolvente que une aprendizado e diversão em busca do sucesso acadêmico</p>
</div>
  </section>

<section class="galery" id="galery">

  <div id= "video">
 
 <video loop autoplay muted>

 <source src="assets/VIDEO.mp4">
         </video>

         </div>
      </section>
</section>

<section id= baixar class="download">
<div class="conteudo_baixar">
 <h1>Baixe agora</h1>
 <br>
 <p>Nossos aplicativos funcionam em dispositivos Android e iOS. <br>Faça o download da versão correta para seu dispositivo <br>clicando no logotipo do sistema operacional apropriado abaixo.</p>

 <button class="botao">
     <img src="assets/apple.png" alt="Descrição da imagem">
     Baixar na App Store
 </button>

 <button class="botao_2">
     <img src="assets/playstore.png" alt="Descrição da imagem">
     Disponivel no Google Play

 </button>

 <p>Estude jogando e turbina seus conhecimentos!
 👉 Comece agora: www.GameVerse.com</p>
 </div>
 <div class="imagem_2">
  <img src="assets/MainChar2D.png" alt="">
 </div>
 </section>

>
   
    <footer>
        <div class="main">
            <div class="content footer-links">
              <div class="footer-company">
                <h4>Nosso Site</h4>
                <h6>Sobre</h6>
                
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
