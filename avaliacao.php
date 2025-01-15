<?php
// avaliacao.php
session_start();
require_once 'conexao.php'; // Conexão com o banco de dados

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['message' => 'Usuário não logado']);
    exit;
}

$user_id = $_SESSION['user_id']; // Id do usuário logado

// Recebe os dados da avaliação
$jogo_id = $_POST['jogo_id'];
$nota = $_POST['nota'];
$comentario = $_POST['comentario'];

// Inserir a avaliação no banco de dados
$sql = "INSERT INTO avaliacoes (id_jogo, id_user, nota, comentario) 
        VALUES (:id_jogo, :id_user, :nota, :comentario)";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_jogo', $jogo_id);
$stmt->bindParam(':id_user', $user_id);
$stmt->bindParam(':nota', $nota);
$stmt->bindParam(':comentario', $comentario);
$stmt->execute();

// Retornar sucesso
echo json_encode(['message' => 'Avaliação enviada com sucesso!']);
?>
