<?php
if (isset($_POST['submit'])) {
    require_once 'config.php';

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $permissao = $_POST['permissao']; 

    // Insere os dados no banco de dados
    $resultado = mysqli_query($conexao, "INSERT INTO usuarios(nome, email, senha, permissao) 
    VALUES('$nome', '$email', '$senha', '$permissao')");

    if ($resultado) {
        // Exibe uma mensagem de sucesso e permanece na página
        echo "<script>alert('Usuário cadastrado com sucesso!');</script>";
        echo "<script>window.location.href = '../painelAdmin/addUser.php';</script>";  // Redireciona para a mesma página
    } else {
        echo "Erro na inserção: " . mysqli_error($conexao);
    }
}
?>
