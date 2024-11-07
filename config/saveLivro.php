<?php
require_once 'config.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $genero = $_POST['genero'];

    $sql_update = "UPDATE livros SET titulo = ?, autor = ?, ano_publicacao = ?, genero = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql_update);
    $stmt->bind_param("ssssi", $titulo, $autor, $ano_publicacao, $genero, $id); // 's' para string e 'i' para inteiro

    if ($stmt->execute()) {
        header('Location: ../painelAdmin/tabelaLivro.php');
        exit;
    } else {
        echo "Erro ao atualizar o usuário: " . $stmt->error;
    }
    $stmt->close();
}
?>