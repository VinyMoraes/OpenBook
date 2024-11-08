<?php
session_start();
require_once '../config/config.php';

// Verifica se o usuário está logado e se tem permissão de administrador
if (!isset($_SESSION['email']) || !isset($_SESSION['senha']) || !isset($_SESSION['permissao']) || $_SESSION['permissao'] != 1) {
    // Se não estiver logado ou não for admin, redireciona para a página de login
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header("Location: ../login.php");
    exit;
}

// Atribui valor armazenado do login
$login = $_SESSION['email'];

// Inicializa variáveis
$nome = '';
$email = '';
$senha = '';
$permissao = '';

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id']; // Converte para inteiro para segurança

    // Consulta para selecionar o usuário
    $sql_seleciona = "SELECT nome, email, senha, permissao FROM usuarios WHERE id = ?";
    $stmt = $conexao->prepare($sql_seleciona);
    $stmt->bind_param("i", $id); // 'i' indica que o parâmetro é um inteiro

    if ($stmt->execute()) {
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $user_data = $resultado->fetch_assoc();
            $nome = $user_data['nome'];
            $email = $user_data['email'];
            $senha = $user_data['senha'];
            $permissao = $user_data['permissao'];
        } else {
            // Se não existir, redireciona para painelAdmin
            header('Location: ../painelAdmin.php');
            exit;
        }
    } else {
        // Se houver erro na execução da consulta
        echo "Erro ao executar a consulta: " . $stmt->error;
        exit;
    }
    $stmt->close();
} else {
    // Se o ID não for passado ou não for numérico, redireciona para painelAdmin
    header('Location: ../painelAdmin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstssrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="icon" href="../img/logo.png">
    <title>Editar Usuário</title>
</head>

<body>
    <header>
        <nav class="nav-bar">
            <input type="checkbox" id="check">
            <label for="check" class="btn-menu">
                <i class="fa fa-bars"></i>
            </label>

            <label class="title">Tec Vini</label>
            <ul>
                <li><a href="#">EDIT. USER</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Editar Usuário</h1>
                <form action="../config/saveUser.php" method="post" class="form-responsivo">
                    <div class="icon-input">

                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                        <label for="nome">Nome*</label>
                        <input class="input-forms" type="text" name="nome" id="nome" placeholder="Exemplo" required
                            minlength="3" maxlength="30" value="<?php echo htmlspecialchars($nome); ?>">
                        <i class="fa fa-user icon"></i>
                    </div>

                    <div class="icon-input">
                        <label for="email">E-mail*</label>
                        <input class="input-forms" type="email" name="email" id="email" placeholder="exemplo@gmail.com"
                            required minlength="6" maxlength="30" value="<?php echo htmlspecialchars($email); ?>">
                        <i class="fa fa-envelope icon"></i>
                    </div>

                    <div class="icon-input">
                        <label for="senha">Senha*</label>
                        <input class="input-forms" type="password" name="senha" id="senha" placeholder="senha123"
                            required minlength="8" maxlength="16" value="<?php echo htmlspecialchars($senha); ?>">
                        <i class="fa fa-eye icon" id="togglePassword"></i>
                    </div>

                    <div class="icon-input">
                        <label for="permissao">Permissão*</label>
                        <select class="input-forms" name="permissao" id="permissao" required>
                            <option value="0" <?php echo $permissao == 0 ? 'selected' : ''; ?>>Usuário Comum</option>
                            <option value="1" <?php echo $permissao == 1 ? 'selected' : ''; ?>>Administrador</option>
                        </select>
                        <i class="fa fa-shield icon"></i>
                    </div>

                    <input type="submit" name="update" class="enviar">

                    <div class="voltar">
                        <a href="tabelaUser.php">
                            <i class="fa fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <h3 class="footer-title">Tec Vini</h3>
            <p class="footer-info">Olá, me chamo Vinicius Alves de Moraes, conhecido como VINI. Sou Dev front-end e
                developer web, tenho 22 anos de idade, graduando em Ciências da Computação, último semestre do curso.
            </p>
            <ul class="footer-redes-sociais">
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p class="footer-copy">Copyright &copy;2024 Tec Vini. Designed by <span class="footer-autor">Vinicius Alves
                    de Moraes</span></p>
        </div>
    </footer>

    <script src="../js/ocultar_Ver_Senha.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>