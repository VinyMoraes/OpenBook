<?php
session_start();

// Verifica se o usuário está logado e se tem permissão de administrador
if (!isset($_SESSION['email']) || !isset($_SESSION['permissao']) || $_SESSION['permissao'] != 1) {
    // Se não estiver logado ou não for admin, redireciona para a página de login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/painel.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" href="img/logo.png">
    <title>Painel Admin</title>
</head>

<body>
    <header>
        <nav class="nav-bar">
            <input type="checkbox" id="check">
            <label for="check" class="btn-menu">
                <i class="fa fa-bars"></i>
            </label>

            <label class="title">Portal da Literatura</label>
            <ul>
                <li><a href="#">HOME</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <div class="title-painel text-center">
            <h2>Seja Bem Vindo(a) ao Painel Administrador</h2>
        </div>
        <div class="row justify-content-center painel-funcoes">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 funcoes">
                <a href="painelAdmin/addLivro.php">
                    <i class="fa fa-book"></i> Adicionar Livro
                </a>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 funcoes">
                <a href="painelAdmin/tabelaLivro.php">
                    <i class="fa fa-list"></i> Listar Livros
                </a>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 funcoes">
                <a href="painelAdmin/alugarLivroAdmin.php">
                    <i class="fa fa-book"></i> Alugar Livros
                </a>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 funcoes">
                <a href="painelAdmin/listarEmprestimo.php">
                    <i class="fa fa-random"></i> Listar Empréstimo de Livros
                </a>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 funcoes">
                <a href="painelAdmin/addUser">
                    <i class="fa fa-user"></i> Adicionar Usuário
                </a>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 funcoes">
                <a href="painelAdmin/tabelaUser.php">
                    <i class="fa fa-pencil"></i> Listar Usuários
                </a>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 funcoes">
                <a href="config/sairSistema.php">
                    <i class="fa fa-sign-out"></i> Sair
                </a>
            </div>
        </div>
    </main>

    <footer>
            <div class="footer-content">
                <h3 class="footer-title">Portal da Literatura</h3>
                <p class="footer-info">Olá, o sistema Portal da Literatura, conhecido por um pequeno grupo de jovens desenvolvedores na qual estão 
                    graduando em Ciências da Computação, vem por meio deste site lhe apresentar um sistema de gerenciamento de bibloteca.</p>
                <ul class="footer-redes-sociais">
                    <li><a href="https://www.instagram.com/vinyde_moraes/"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="https://www.linkedin.com/in/vinicius-alves-de-moraes-440a87199/"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="https://wa.me/5511974023353"><i class="fa fa-whatsapp"></i></a></li>
                </ul>
            </div>
            <div class="footer-bottom">
                <p class="footer-copy">Copyright &copy;2024 Tec Vini. Designed by <span class="footer-autor">Vinicius Alves de Moraes</span></p>
            </div>
        </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>