<?php
session_start();
require_once '../config/config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['email']) || !isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

// Verifica a permissão do usuário
if (!isset($_SESSION['permissao']) || $_SESSION['permissao'] != 1) {
    header("Location: ../login.php");
    exit();
}

// Verifica se o parâmetro de aluguel foi passado
if (isset($_GET['alugado']) && $_GET['alugado'] === 'true' && isset($_GET['livro_id'])) {
    $livro_id = (int) $_GET['livro_id'];
    $usuario_id = $_SESSION['usuario_id'];
    $data_aluguel = date('Y-m-d'); // Define a data atual como data de aluguel

    // Insere o registro de aluguel na tabela `alugueis`
    $sql = "INSERT INTO alugueis (livro_id, usuario_id, data_aluguel) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);

    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conexao->error);
    }

    $stmt->bind_param("iis", $livro_id, $usuario_id, $data_aluguel);

    if ($stmt->execute()) {
        // Mensagem de sucesso
        echo "<script>alert('O livro foi alugado com sucesso!'); window.location.href='../painelAdmin/alugarLivroAdmin.php';</script>";
    } else {
        // Mensagem de erro
        echo "<script>alert('Erro ao alugar o livro: " . $conexao->error . "'); window.location.href='../painelAdmin/alugarLivroAdmin.php';</script>";
    }

    $stmt->close();
} else {
    // Caso não tenha passado os parâmetros corretamente
    echo "<script>alert('Parâmetros inválidos.'); window.location.href='../painelUser/alugarLivro.php';</script>";
}

// Fechar a conexão
$conexao->close();
?>
