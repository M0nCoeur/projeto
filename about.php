<?php
session_start();
include('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVerse - Academic Adventure</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/HTML_PROJECT/styles/about.css">
    <script src="/HTML_PROJECT/scripts/academic_adventure.js" defer></script>
    <script src="/HTML_PROJECT/scripts/reviews.js" defer></script>
</head>

<body>

    <!-- Painel de Acessibilidade -->
    <div class="accessibility-controls" id="accessibility-controls">
        <button id="increase-font" aria-label="Aumentar tamanho da fonte">A+</button>
        <button id="reset-font-size" aria-label="Restaurar o tamanho da fonte original">A</button>
        <button id="decrease-font" aria-label="Diminuir tamanho da fonte">A-</button>
        <button id="toggle-contrast" aria-label="Alternar contraste">Contraste</button>
        <button id="close-accessibility" aria-label="Fechar painel de acessibilidade">Fechar</button>
    </div>

    <!-- Botão para abrir o painel -->
    <button id="open-accessibility" aria-label="Abrir painel de acessibilidade">Acessibilidade</button>

    <!-- Cabeçalho -->
    <header>
        <div class="content">
            <nav aria-label="Menu de navegação principal">
                <p class="brand">
                    <a href="index.php">
                        <img src="/HTML_PROJECT/assets/Logo2.png" alt="Logo GameVerse" class="logo">
                    </a>
                </p>
                <ul>
                    <li><a href="index.php#games" aria-label="Ir para a seção de jogos">Jogos</a></li>
                    <li><a href="index.php#galery" aria-label="Ir para a seção de notícias">Notícias</a></li>
                    <li><a href="index.php" aria-label="Ir para a página Sobre Nós">Início</a></li> <!-- Adicionado o link -->
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <li class="dropdown">
                            <div class="user-container" onclick="toggleDropdown()" aria-haspopup="true" aria-expanded="false">
                                <span>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                                <i class="uil uil-user-circle"></i>
                            </div>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="myaccount.php" role="menuitem" aria-label="Acessar a conta">Minha Conta</a></li>
                                <li><a href="jogos_favoritos.php" role="menuitem" aria-label="Ver jogos favoritos">Jogos Favoritos</a></li>
                                <li><a href="reviews.php" role="menuitem" aria-label="Acessar as avaliações">Minhas Avaliações</a></li>
                            </ul>
                        </li>
                        <li><button onclick="window.location.href='logout.php'" aria-label="Sair do site">Sair</button></li>
                    <?php else: ?>
                        <li><button onclick="window.location.href='login.php'" aria-label="Fazer login">Login</button></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Seção Sobre Nós -->
    <main class="sobre-container">
        <section class="sobre-banner">
            <h1>Sobre a GameVerse</h1>
            <p>Transformando o aprendizado em uma aventura emocionante!</p>
        </section>

        <section class="sobre-conteudo">
            <div class="sobre-texto">
                <h2>Nossa Missão</h2>
                <p>Na GameVerse, temos o compromisso de transformar o aprendizado em uma experiência inovadora e cativante. Nossa missão é unir educação e diversão, oferecendo soluções personalizadas em forma de jogos que inspiram criatividade, curiosidade e engajamento.</p>
            </div>

            <div class="sobre-texto">
                <h2>O Que Fazemos?</h2>
                <p>Desenvolvemos jogos educacionais sob medida, projetados para atender às necessidades específicas de escolas, educadores e instituições de ensino. Trabalhamos em parceria com nossos clientes para criar experiências únicas, adaptadas às diferentes faixas etárias e disciplinas acadêmicas, promovendo um aprendizado dinâmico e interativo.</p>
            </div>

            <div class="sobre-texto">
                <h2>Por Que Escolher a GameVerse?</h2>
                <ul>
                    <li><strong>Soluções Personalizadas: </strong> Criamos jogos que atendem às demandas específicas de educadores e escolas, garantindo alinhamento com seus objetivos.</li>
                    <li><strong>Interface Intuitiva:</strong> Experiência acessível para alunos, professores e gestores educacionais.</li>
                    <li><strong>Jogos Inovadores:</strong> Nossos projetos são desenvolvidos para engajar e estimular o aprendizado de forma criativa e divertida.</li>
                    <li><strong>Apoio ao Educador: </strong> Fornecemos ferramentas e suporte que maximizam o impacto educacional dos jogos desenvolvidos.</li>
                    <li><strong>Colaboração Constante:</strong> Trabalhamos lado a lado com nossos parceiros para garantir que cada jogo atenda plenamente às suas expectativas.</li>
                </ul>
            </div>
        </section>

        <section class="sobre-equipe">
            <h2>Conheça Nossa Equipe</h2>
            <div class="equipe-container">
                <div class="equipe-cards">
                    <!-- Membro 1 -->
                    <div class="equipe-card">
                        <img src="/HTML_PROJECT/assets/aluno7.jpeg" alt="Foto do Fundador">
                        <h3>Marcelo Junior</h3>
                        <p>Desenvolvedor de jogos</p>
                    </div>
                    <!-- Membro 2 -->
                    <div class="equipe-card">
                        <img src="/HTML_PROJECT/assets/aluno5.jpeg" alt="Foto da Desenvolvedora">
                        <h3>Lucas Ferreira</h3>
                        <p>Desenvolvedor Web</p>
                    </div>
                    <!-- Membro 3 -->
                    <div class="equipe-card">
                        <img src="/HTML_PROJECT/assets/aluno10.jpeg" alt="Foto do Designer">
                        <h3>Caio Carolino</h3>
                        <p>Desenvolvedor de jogos</p>
                    </div>
                    <!-- Membro 4 -->
                    <div class="equipe-card">
                        <img src="/HTML_PROJECT/assets/aluno1.jpeg" alt="Foto da Gerente de Projetos">
                        <h3>Wendell Henrique</h3>
                        <p>Designer Gráfico</p>
                    </div>
                    <!-- Membro 5 -->
                    <div class="equipe-card">
                        <img src="/HTML_PROJECT/assets/aluno2.jpeg" alt="Foto do Especialista em Educação">
                        <h3>Vitória Larrisa</h3>
                        <p>Desenvolvedora Front-end</p>
                    </div>
                    <!-- Membro 6 -->
                    <div class="equipe-card">
                        <img src="/HTML_PROJECT/assets/aluno3.jpeg" alt="Foto da Desenvolvedora Júnior">
                        <h3>Ludmila Costa</h3>
                        <p>Desenvolvedora Front-end</p>
                    </div>
                    <!-- Membro 7 -->
                    <div class="equipe-card">
                        <img src="/HTML_PROJECT/assets/aluno4.jpeg" alt="Foto do Analista de Dados">
                        <h3>Samuel Martins</h3>
                        <p>Desenvolvedor Front-end</p>
                    </div>
                    <!-- Membro 8 -->
                    <div class="equipe-card">
                        <img src="/HTML_PROJECT/assets/aluno6.jpeg" alt="Foto da Especialista em Marketing">
                        <h3>Gleiciene Fernandes</h3>
                        <p>Designer Gráfico</p>
                    </div>
                    <!-- Membro 9 -->
                    <div class="equipe-card">
                        <img src="/HTML_PROJECT/assets/aluno8.jpeg" alt="Foto do Desenvolvedor Full Stack">
                        <h3>Logan Lucky</h3>
                        <p>Designer Gráfico</p>
                    </div>
                    <!-- Membro 10 -->
                    <div class="equipe-card">
                        <img src="/HTML_PROJECT/assets/aluno9.jpeg" alt="Foto da Coordenadora de Suporte">
                        <h3>Lincoln Luciano</h3>
                        <p>Designer Gráfico</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Rodapé -->
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
                        <a href="#" aria-label="Acessar o Instagram"><img src="/HTML_PROJECT/assets/instagram.png" alt="Instagram"></a>
                        <a href="#" aria-label="Acessar o Facebook"><img src="/HTML_PROJECT/assets/facebook.png" alt="Facebook"></a>
                        <a href="#" aria-label="Acessar o WhatsApp"><img src="/HTML_PROJECT/assets/whatsapp-svgrepo-com.png" alt="Whatsapp"></a>
                    </div>
                </div>
                <div class="footer-contact">
                    <h4>Nosso Contato</h4>
                    <address>
                        <p>+55 31 988776644</p>
                        <p>turma0043@gmail.com</p>
                        <p>R. Paineiras, 1300 - Eldorado, Contagem - MG</p>
                    </address>
                </div>
            </div>
        </div>
        <div class="last">
            GameVerse
        </div>
    </footer>

    <!-- Scripts -->
    <script src="/HTML_PROJECT/scripts/drop.js"></script>
    <script src="/HTML_PROJECT/scripts/game.js"></script>
    <script src="/HTML_PROJECT/scripts/star.js"></script>
    <script src="/HTML_PROJECT/scripts/accessibility.js"></script>

</body>

</html>