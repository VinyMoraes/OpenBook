<?php
session_start();

// Destrua todos os dados armazenados na sessão
session_unset(); // Remove todas as variáveis de sessão
session_destroy(); // Destrói a sessão

// Redireciona para a página de login
header("Location: ../login.php");
exit(); // Encerra a execução do script após o redirecionamento
?>
