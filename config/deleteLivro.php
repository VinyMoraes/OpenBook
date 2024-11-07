<?php
session_start();

require_once '../config/config.php';

// Definindo uma constante para a permissão de administrador
define('PERMISSAO_ADMIN', 1);

// Verifica se o usuário está logado e se tem permissão de administrador
if (!isset($_SESSION['email']) || !isset($_SESSION['permissao']) || $_SESSION['permissao'] != PERMISSAO_ADMIN) {
    // Se não estiver logado ou não for admin, redireciona para a página de erro
    header("Location: ../paginaErro.php"); // Redireciona para uma página de erro informativa
    exit();
}

// Atribui valor armazenado do login
$login = $_SESSION['email'];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara a consulta para verificar se o usuário existe
    $sql_seleciona = "SELECT * FROM livros WHERE id = ?";
    $stmt = $conexao->prepare($sql_seleciona);
    $stmt->bind_param('i', $id); // 'i' para inteiro
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Prepara a consulta para excluir o usuário
        $sql_deletar = "DELETE FROM livros WHERE id = ?";
        $stmt_deletar = $conexao->prepare($sql_deletar);
        $stmt_deletar->bind_param('i', $id); // 'i' para inteiro
        $resultado_deletar = $stmt_deletar->execute();

        if ($resultado_deletar) {
            // Redireciona para tabelaUser.php após a exclusão
            header('Location: ../painelAdmin/tabelaLivro.php');
            exit();
        } else {
            echo "Erro ao excluir o livro: " . $conexao->error;
        }
    } else {
        echo "Livro não encontrado.";
    }
} else {
    echo "ID do livro não foi fornecido.";
}

// Fecha as conexões
$stmt->close();
$stmt_deletar->close();
$conexao->close();
?>
