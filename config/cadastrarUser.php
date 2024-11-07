<?php 
if (isset($_POST['submit'])) {
    require_once 'config.php';

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $permissao = 0; // Define a permissão padrão como 0 para usuário comum

    // Insere os dados no banco de dados
    $resultado = mysqli_query($conexao, "INSERT INTO usuarios(nome, email, senha, permissao) 
    VALUES('$nome', '$email', '$senha', '$permissao')");

    if ($resultado) {
        // Verifica se a inserção foi bem-sucedida e redireciona com base na permissão
        if ($permissao == 1) {
            // se for administrador
            header("Location: ../painelAdmin.php");
            // se for usuario
        } else {
            header("Location: ../painelUser.php");
        }
        exit(); // Encerra a execução do script após o redirecionamento
    } else {
        echo "Erro na inserção: " . mysqli_error($conexao);
    }
}
?>
