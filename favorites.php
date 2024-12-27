<?php
session_start(); // Iniciar a sessão para acessar as variáveis de sessão
include('conexao.php'); // Conexão com o banco de dados

// Verificar se o usuário está logado
if (isset($_SESSION['user_id'])) {
    // Pega o ID do usuário
    $id_user = $_SESSION['user_id'];

    // Verifica se o ID do jogo foi passado
    if (isset($_POST['id_jogo'])) {
        $id_jogo = $_POST['id_jogo'];

        // Verifica se o jogo já está nos favoritos
        $query = "SELECT * FROM favoritos WHERE id_user = :id_user AND id_jogo = :id_jogo";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_jogo', $id_jogo, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Se já está favoritado, remove da tabela favoritos
            $query = "DELETE FROM favoritos WHERE id_user = :id_user AND id_jogo = :id_jogo";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':id_jogo', $id_jogo, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo 'success'; // Jogo desfavoritado com sucesso
            } else {
                echo 'error'; // Erro ao desfavoritar
            }
        } else {
            // Se não está favoritado, insere na tabela favoritos
            $query = "INSERT INTO favoritos (id_user, id_jogo) VALUES (:id_user, :id_jogo)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':id_jogo', $id_jogo, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo 'success'; // Jogo favoritado com sucesso
            } else {
                echo 'error'; // Erro ao favoritar
            }
        }
    } else {
        echo 'invalid request'; // Caso não tenha o ID do jogo
    }
} else {
    echo 'not_logged_in'; // Se o usuário não estiver logado
}
?>
