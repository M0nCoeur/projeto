<?php
// Configurações de conexão
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "gameverse";

// Criar conexão
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verificar conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Exibir mensagem para verificar se está tudo correto (opcional durante o desenvolvimento)
// echo "Conexão bem-sucedida!";
?>
