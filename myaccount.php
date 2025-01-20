<?php
session_start();
include('conexao.php');

// Verificar se o usuário está logado
if (isset($_SESSION['usuario'])) {
    $username = $_SESSION['usuario']; // Usando o nome de usuário ou e-mail armazenado na sessão

    // Função para carregar os dados do usuário
    function carregarUsuario($conn, $username)
    {
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email OR nome = :nome");
        $stmt->bindParam(':email', $username);
        $stmt->bindParam(':nome', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Busca o usuário
    $user = carregarUsuario($conn, $username);

    // Verifique se um usuário foi encontrado
    if (!$user) {
        die("Usuário não encontrado.");
    }
} else {
    die("Você não está logado.");
}

// Processar atualização de dados
if (isset($_POST['update_account'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Atualizar nome e e-mail
    $update_query = "UPDATE user SET nome = :nome, email = :email";

    // Se a senha foi alterada, inclui a senha na consulta
    if (!empty($password)) {
        $update_query .= ", senha = :senha";
    }

    $update_query .= " WHERE id_user = :id_user"; // Usando o campo correto id_user
    $stmt = $conn->prepare($update_query);
    $stmt->bindParam(':nome', $name);
    $stmt->bindParam(':email', $email);

    if (!empty($password)) {
        // Aqui não estamos criptografando a senha, apenas atualizando o campo com o valor recebido
        $stmt->bindParam(':senha', $password);
    }
    $stmt->bindParam(':id_user', $user['id_user']); // Usando o id_user correto

    if ($stmt->execute()) {
        // Atualiza o nome do usuário na sessão
        $_SESSION['usuario'] = $name;

        // Recarrega os dados do usuário após a atualização
        $user = carregarUsuario($conn, $name);

        echo "<script>document.getElementById('message').innerText = 'Dados atualizados com sucesso!';</script>";
    } else {
        echo "<script>document.getElementById('message').innerText = 'Erro ao atualizar dados. Tente novamente.';</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVerse - Minha Conta</title>
    <link rel="stylesheet" href="/HTML_PROJECT/styles/myaccount.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <script src="/HTML_PROJECT/scripts/script-header.js"></script>
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
        <section class="account-section">
            <h2>Informações da Conta</h2>

            <!-- Toggle Switch -->
            <div class="toggle-container">
                <label class="switch">
                    <input type="checkbox" id="edit-toggle" onclick="toggleEditMode()">
                    <span class="slider"></span>
                </label>
                <span id="edit-label">Modo Visualização</span>
            </div>

            <form method="POST" action="myaccount.php" id="account-form">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['nome'] ?? ''); ?>" required disabled>

                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required disabled>

                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" placeholder="Digite uma nova senha (opcional)" disabled>

                <button type="submit" name="update_account" id="update-button" disabled>Atualizar</button>
            </form>
            <div id="message"></div> <!-- Mensagem de feedback -->
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
    <script src="/HTML_PROJECT/scripts/myaccount.js"></script>
</body>

</html>