<?php
session_start(); // Iniciar a sessão para armazenar dados do usuário
include('conexao.php'); // Inclua a conexão com o banco de dados usando PDO

$status = "";
if (isset($_GET['status']) && $_GET['status'] == 'cadastro_sucesso') {
  $status = "<p style='color: green;'>Cadastro realizado. Siga para o Login</p>";
}

// Verifica se o cookie existe e preenche os campos automaticamente
$emailCookie = isset($_COOKIE['email']) ? $_COOKIE['email'] : '';
$passwordCookie = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';

// Processamento do login
if (isset($_POST['entrar'])) {
  $email = $_POST['email'];
  $senha = $_POST['password'];
  $lembrar = isset($_POST['lembrar']);

  try {
    // Consulta para verificar o usuário
    $query = "SELECT * FROM user WHERE email = :email AND senha = :senha";
    $stmt = $conn->prepare($query);  // Usando $conn para a conexão PDO
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    $usuario = $stmt->fetch();

    if ($usuario) {
      // Usuário encontrado, inicia a sessão e armazena o nome e ID
      $_SESSION['usuario'] = $usuario['nome']; // Armazena o nome do usuário na sessão
      $_SESSION['user_id'] = $usuario['id_user']; // Armazena o ID do usuário na sessão

      // Configuração do cookie se "Lembrar-me" estiver marcado
      if ($lembrar) {
        setcookie('email', $email, time() + (86400 * 30), "/"); // Cookie válido por 30 dias
        setcookie('password', $senha, time() + (86400 * 30), "/");
      } else {
        // Limpa os cookies se "Lembrar-me" não estiver marcado
        setcookie('email', '', time() - 3600, "/");
        setcookie('password', '', time() - 3600, "/");
      }

      header("Location: index.php"); // Redireciona para a página inicial após login
      exit();
    } else {
      $status = "<p style='color: red;'>E-mail ou senha incorretos!</p>";
    }
  } catch (PDOException $e) {
    $status = "<p style='color: red;'>Erro ao fazer login: " . $e->getMessage() . "</p>";
  }
}

// Processamento do cadastro
if (isset($_POST['cadastrar'])) {
  $nome = $_POST['name'];
  $email = $_POST['email'];
  $senha = $_POST['pass'];

  try {
    // Verifica se o e-mail já está cadastrado
    $query = "SELECT * FROM user WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $status = "<p style='color: red;'>E-mail já cadastrado!</p>";
    } else {
      // Inserir o usuário no banco com a senha em texto simples
      $query = "INSERT INTO user (nome, email, senha) VALUES (:nome, :email, :senha)";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':senha', $senha);
      $stmt->execute();

      // Cadastro bem-sucedido, redirecionar para o login com mensagem
      header("Location: login.php?status=cadastro_sucesso");
      exit();
    }
  } catch (PDOException $e) {
    $status = "<p style='color: red;'>Erro ao cadastrar: " . $e->getMessage() . "</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <link rel="stylesheet" href="/HTML_PROJECT/styles/login.css" />
  <title>GameVerse - Login</title>
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
          <!--  <li><a href="index.php#games">Jogos</a></li>
                  <li><a href="index.php#galery">Notícias</a></li>
                  <li><a href="index.php#about">Sobre</a></li> -->
          <button onclick="window.location.href='login.php'">Login</button>
        </ul>

      </nav>
  </header>

  <div class="container">
    <div class="forms">

      <!-- Login Form -->
      <div class="form login">
        <span class="title">Acesse sua conta</span>

        <!-- Exibindo status -->
        <?php echo $status; ?>

        <form action="#" method="post">
          <div class="input-field">
            <label for="email">
              <input type="email" name="email" id="email" placeholder="E-mail" required value="<?php echo htmlspecialchars($emailCookie); ?>" />
            </label>
            <i class="uil uil-envelope icon"></i>
          </div>
          <div class="input-field">
            <label for="password">
              <input type="password" class="password" name="password" id="password" placeholder="Senha" required minlength="8" maxlength="20" value="<?php echo htmlspecialchars($passwordCookie); ?>" />
            </label>
            <i class="uil uil-lock icon"></i>
            <i class="uil uil-eye-slash showHidePw"></i>
          </div>

          <div class="checkbox-text">
            <div class="checkbox-content">
              <input type="checkbox" id="logCheck" />
              <label for="logCheck" class="text">Lembrar-me</label>
            </div>
          </div>

          <div class="input-field button">
            <input type="submit" name="entrar" value="Login" />
          </div>
        </form>

        <div class="login-signup">
          <span class="text">Não é um membro?
            <a href="#" class="text signup-link">Cadastre-se aqui</a>
          </span>
        </div>
      </div>

      <!-- Registration Form -->
      <div class="form signup">
        <span class="title">Criar conta</span>

        <form action="#" method="post">
          <div class="input-field">
            <label for="name">
              <input type="text" name="name" id="name" placeholder="Nome" required maxlength="100" />
            </label>
            <i class="uil uil-user"></i>
          </div>
          <div class="input-field">
            <label for="email">
              <input type="email" name="email" id="email" placeholder="E-mail" required />
            </label>
            <i class="uil uil-envelope icon"></i>
          </div>
          <div class="input-field">
            <label for="pass">
              <input type="password" class="password" name="pass" id="pass" placeholder="Crie uma senha" required minlength="8" maxlength="20" />
            </label>
            <i class="uil uil-lock icon"></i>
          </div>
          <div class="input-field">
            <label for="pass">
              <input type="password" class="password" name="pass" id="pass" placeholder="Confirme a senha" required minlength="8" maxlength="20" />
            </label>
            <i class="uil uil-lock icon"></i>
            <i class="uil uil-eye-slash showHidePw"></i>
          </div>
          <div class="input-field button">
            <input type="submit" name="cadastrar" value="Cadastrar" />
          </div>
        </form>

        <div class="login-signup">
          <span class="text">Já possui uma conta?
            <a href="#" class="text login-link">Entre aqui</a>
          </span>
        </div>
      </div>
    </div>
  </div>

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

  <script src="/HTML_PROJECT/scripts/login.js"></script>
</body>

</html>