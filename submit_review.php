<?php
session_start();
include('conexao.php');

$user_id = $_SESSION['user_id'];
$jogo_id = $_POST['id_jogo'];
$nota = $_POST['nota'];
$comentario = $_POST['comentario'];

// Verificar se o usuário já avaliou o jogo
$query_check = "SELECT * FROM avaliacoes WHERE id_user = :id_user AND id_jogo = :id_jogo";
$stmt_check = $conn->prepare($query_check);
$stmt_check->bindParam(':id_user', $user_id, PDO::PARAM_INT);
$stmt_check->bindParam(':id_jogo', $jogo_id, PDO::PARAM_INT);
$stmt_check->execute();

if ($stmt_check->rowCount() > 0) {
    // O usuário já avaliou este jogo
    header("Location: academic_adventure.php?error=already-reviewed");
    exit();
}

// Inserir nova avaliação
$query_insert = "INSERT INTO avaliacoes (id_user, id_jogo, nota, comentario, data_avaliacao)
                 VALUES (:id_user, :id_jogo, :nota, :comentario, NOW())";
$stmt_insert = $conn->prepare($query_insert);
$stmt_insert->bindParam(':id_user', $user_id);
$stmt_insert->bindParam(':id_jogo', $jogo_id);
$stmt_insert->bindParam(':nota', $nota);
$stmt_insert->bindParam(':comentario', $comentario);
$stmt_insert->execute();

// Atualizar a tabela jogos_jogados para marcar como avaliado
$query_update = "UPDATE jogos_jogados SET avaliado = 1 WHERE id_user = :id_user AND id_jogo = :id_jogo";
$stmt_update = $conn->prepare($query_update);
$stmt_update->bindParam(':id_user', $user_id);
$stmt_update->bindParam(':id_jogo', $jogo_id);
$stmt_update->execute();

header("Location: academic_adventure.php?success=review-submitted");
exit();
?>
