<?php
session_start();
include('conexao.php');

if (!isset($_GET['id_jogo']) || !is_numeric($_GET['id_jogo'])) {
    error_log("id_jogo not set or invalid.");
    echo json_encode(['error' => 'ID do jogo inválido.']);
    exit();
}

$jogo_id = (int)$_GET['id_jogo'];
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0; // Pega o offset da requisição

error_log("Fetching reviews for game ID: $jogo_id with offset: $offset");

// Buscar avaliações com base no offset
$query_reviews = "
    SELECT avaliacoes.*, user.nome 
    FROM avaliacoes 
    JOIN user ON avaliacoes.id_user = user.id_user 
    WHERE avaliacoes.id_jogo = :id_jogo 
    ORDER BY avaliacoes.data_avaliacao DESC 
    LIMIT 5 OFFSET :offset
";
$stmt_reviews = $conn->prepare($query_reviews);
$stmt_reviews->bindParam(':id_jogo', $jogo_id, PDO::PARAM_INT);
$stmt_reviews->bindParam(':offset', $offset, PDO::PARAM_INT);

try {
    $stmt_reviews->execute();
    $reviews = $stmt_reviews->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array
    error_log("Number of reviews returned: " . count($reviews)); // Log do número de avaliações
    echo json_encode($reviews);
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo json_encode(['error' => 'Erro ao buscar avaliações.']);
}
?>