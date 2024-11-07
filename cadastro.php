<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" href="img/logo.png">
    <title>Cadastro</title>
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
                <li><a href="index.html">HOME</a></li>
                <li><a href="#">CADASTRO</a></li>
                <li><a href="login.php">LOGIN</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Cadastro</h1>
                <form action="config/cadastrarUser.php" method="post" class="form-responsivo">
                    <div class="icon-input">
                        <label for="nome">Nome*</label>
                        <input class="input-forms" type="text" name="nome" id="nome" placeholder="Exemplo" required
                            minlength="3" maxlength="30">
                        <i class="fa fa-user icon"></i>
                    </div>

                    <div class="icon-input">
                        <label for="email">E-mail*</label>
                        <input class="input-forms" type="email" name="email" id="email" placeholder="exemplo@gmail.com"
                            required minlength="6" maxlength="30">
                        <i class="fa fa-envelope icon"></i>
                    </div>

                    <div class="icon-input">
                        <label for="senha">Senha*</label>
                        <input class="input-forms" type="password" name="senha" id="senha" placeholder="senha123"
                            required minlength="8" maxlength="16">
                        <i class="fa fa-eye icon" id="togglePassword"></i>
                    </div>

                    <input type="submit" name="submit" class="enviar">
                </form>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <h3 class="footer-title">Portal da Literatura</h3>
            <p class="footer-info">Olá, o sistema Portal da Literatura, conhecido por um pequeno grupo de jovens
                desenvolvedores na qual estão
                graduando em Ciências da Computação, vem por meio deste site lhe apresentar um sistema de gerenciamento
                de bibloteca.</p>
            <ul class="footer-redes-sociais">
                <li><a href="https://www.instagram.com/vinyde_moraes/"><i class="fa fa-instagram"></i></a></li>
                <li><a href="https://www.linkedin.com/in/vinicius-alves-de-moraes-440a87199/"><i
                            class="fa fa-linkedin"></i></a></li>
                <li><a href="https://wa.me/5511974023353"><i class="fa fa-whatsapp"></i></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p class="footer-copy">Copyright &copy;2024 Tec Vini. Designed by <span class="footer-autor">Vinicius Alves
                    de Moraes</span></p>
        </div>
    </footer>

    <script src="js/ocultar_Ver_Senha.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>