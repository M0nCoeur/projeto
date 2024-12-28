<?php
session_start();
include('conexao.php');

if (isset($_SESSION['user_id'])) {
    $id_user = $_SESSION['user_id'];

    if (isset($_POST['id_jogo'])) {
        $id_jogo = $_POST['id_jogo'];

        // Verifica se o jogo está nos favoritos
        $query = "SELECT * FROM favoritos WHERE id_user = :id_user AND id_jogo = :id_jogo";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_jogo', $id_jogo, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Jogo já favoritado, desfavoritar
            $query = "DELETE FROM favoritos WHERE id_user = :id_user AND id_jogo = :id_jogo";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':id_jogo', $id_jogo, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo 'success'; // Jogo desfavoritado
            } else {
                echo 'error';
            }
        } else {
            // Jogo não favoritado, favoritar
            $query = "INSERT INTO favoritos (id_user, id_jogo) VALUES (:id_user, :id_jogo)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':id_jogo', $id_jogo, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo 'success'; // Jogo favoritado
            } else {
                echo 'error';
            }
        }
    } else {
        echo 'invalid request'; // Caso o ID do jogo não seja enviado
    }
} else {
    echo 'not_logged_in'; // Se o usuário não estiver logado
}
?>
