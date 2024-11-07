<?php
session_start();

require_once '../config/config.php';

// Verifica se o usuário está logado e se tem permissão de usuário comum
if (!isset($_SESSION['email']) || !isset($_SESSION['permissao']) || $_SESSION['permissao'] != 0) {
    // Se não estiver logado ou não for um usuário comum, redireciona para a página de erro
    header("Location: ../paginaErro.php"); // Redireciona para uma página de erro informativa
    exit();
}

// Atribui valor armazenado do login
$login = $_SESSION['email'];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara a consulta para verificar se o aluguel existe
    $sql_seleciona = "SELECT * FROM alugueis WHERE id = ?";
    $stmt = $conexao->prepare($sql_seleciona);
    $stmt->bind_param('i', $id); // 'i' para inteiro
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Prepara a consulta para excluir o aluguel
        $sql_deletar = "DELETE FROM alugueis WHERE id = ?";
        $stmt_deletar = $conexao->prepare($sql_deletar);
        $stmt_deletar->bind_param('i', $id); // 'i' para inteiro
        $resultado_deletar = $stmt_deletar->execute();

        if ($resultado_deletar) {
            // Redireciona para a tabela de alugueis após a exclusão
            header('Location: ../painelUser/listarAluguel.php'); // Atualize para a página desejada
            exit();
        } else {
            echo "Erro ao cancelar o aluguel: " . $conexao->error;
        }
    } else {
        echo "Aluguel não encontrado.";
    }
} else {
    echo "ID do aluguel não fornecido.";
}

// Fecha as conexões
$stmt->close();
if (isset($stmt_deletar)) {
    $stmt_deletar->close();
}
$conexao->close();
?>
