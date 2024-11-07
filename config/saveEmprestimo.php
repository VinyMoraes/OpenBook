<?php
require_once 'config.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $data_devolucao = $_POST['data_devolucao']; // Pegando a data de devolução do formulário

    // Atualizar apenas a data de devolução
    $sql_update = "UPDATE alugueis SET data_devolucao = ? WHERE id = ?"; // Ajuste para sua tabela e campo corretos
    $stmt = $conexao->prepare($sql_update);
    $stmt->bind_param("si", $data_devolucao, $id); // 's' para string (data) e 'i' para inteiro (id)

    if ($stmt->execute()) {
        header('Location: ../painelAdmin/listarEmprestimo.php'); // Redireciona após a atualização
        exit;
    } else {
        echo "Erro ao atualizar a data de devolução: " . $stmt->error;
    }
    $stmt->close();
}
?>
