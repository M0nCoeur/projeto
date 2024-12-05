<?php
session_start(); // Inicia a sessão
session_unset(); // Remove todas as variáveis de sessão
session_destroy(); // Destroi a sessão

// Redireciona para a página inicial após sair
header("Location: index.php");
exit();
?>
