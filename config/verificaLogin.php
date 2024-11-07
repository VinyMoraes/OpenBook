<?php
session_start();

// Verifica se o envio do formulário foi correto e se os campos "email" e "senha" não estão vazios
if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {

    require_once 'config.php';

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Faz a verificação no banco de dados se existe o registro com o email e senha
    $sql_verifica = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $resultado = $conexao->query($sql_verifica);

    // Verifica se o resultado retornou algum registro
    if(mysqli_num_rows($resultado) > 0) {
        // Captura os dados do usuário encontrado
        $usuario = mysqli_fetch_assoc($resultado);
        
        // Armazena os dados na sessão
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['usuario_id'] = $usuario['id']; // Armazenando o usuario_id
        $_SESSION['permissao'] = $usuario['permissao'];

        // Redireciona de acordo com a permissão do usuário
        if ($usuario['permissao'] == 1) {
            header("Location: ../painelAdmin.php"); // Administrador
        } else {
            header("Location: ../painelUser.php"); // Usuário comum
        }
        exit(); // Encerra o script após o redirecionamento
    } else {
        // Se os dados não forem encontrados, redireciona para o login
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header("Location: ../login.php");
        exit();
    }
} else {
    // Redireciona para o login se os campos estiverem vazios
    header("Location: ../login.php");
    exit();
}
?>
