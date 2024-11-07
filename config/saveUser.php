<?php
require_once 'config.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $permissao = $_POST['permissao'];

    $sql_update = "UPDATE usuarios SET nome = ?, email = ?, senha = ?, permissao = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql_update);
    $stmt->bind_param("ssssi", $nome, $email, $senha, $permissao, $id); // 's' para string e 'i' para inteiro

    if ($stmt->execute()) {
        header('Location: ../painelAdmin/tabelaUser.php');
        exit;
    } else {
        echo "Erro ao atualizar o usuário: " . $stmt->error;
    }
    $stmt->close();
}
?>