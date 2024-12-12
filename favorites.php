<?php
session_start();
include 'conexao.php'; // Conexão com o banco de dados

// Verifica se o usuário está logado
if (!isset($_SESSION['id_user'])) {
    echo json_encode(['status' => 'error', 'message' => 'Usuário não logado']);
    exit();
}

$id_user = $_SESSION['id_user']; // Pega o ID do usuário logado

// Verifica a ação solicitada (favoritar ou desfavoritar)
if (isset($_POST['id_jogo']) && isset($_POST['action'])) {
    $id_jogo = $_POST['id_jogo'];
    $action = $_POST['action'];

    if ($action == 'add') {
        // Adicionar favorito
        $query = "INSERT INTO favoritos (id_user, id_jogo) VALUES (:id_user, :id_jogo)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_jogo', $id_jogo, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Jogo favoritado com sucesso']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao favoritar jogo']);
        }
    } elseif ($action == 'remove') {
        // Remover favorito
        $query = "DELETE FROM favoritos WHERE id_user = :id_user AND id_jogo = :id_jogo";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_jogo', $id_jogo, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Jogo desfavoritado com sucesso']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao desfavoritar jogo']);
        }
    }
}
?>
