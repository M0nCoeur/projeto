<?php
include 'conexao.php';

if ($conexao) {
    echo "Conexão com o banco de dados foi bem-sucedida!";
} else {
    echo "Erro ao conectar ao banco de dados.";
}
?>
