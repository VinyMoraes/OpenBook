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
$titulo = '';
$autor = '';
$ano_publicacao = '';
$genero = '';

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id']; // Converte para inteiro para segurança

    // Consulta para selecionar o usuário
    $sql_seleciona = "SELECT titulo, autor, ano_publicacao, genero FROM livros WHERE id = ?";
    $stmt = $conexao->prepare($sql_seleciona);
    $stmt->bind_param("i", $id); // 'i' indica que o parâmetro é um inteiro

    if ($stmt->execute()) {
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $user_data = $resultado->fetch_assoc();
            $titulo = $user_data['titulo'];
            $autor = $user_data['autor'];
            $ano_publicacao = $user_data['ano_publicacao'];
            $genero = $user_data['genero'];
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
    <link rel="stylesheet" href="../css/User.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="icon" href="../img/logo.png">
    <title>Editar Livro</title>
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
                <li><a href="#">EDIT. LIVRO</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Editar Livro</h1>
                <form action="../config/saveLivro.php" method="post" class="form-responsivo">

                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                    <div class="icon-input">
                        <label for="titulo">Título*</label>
                        <input class="input-forms" type="text" name="titulo" id="titulo" placeholder="Exemplo" required
                            minlength="3" maxlength="30" value="<?php echo htmlspecialchars($titulo); ?>">
                        <i class="fa fa-book icon"></i>
                    </div>

                    <div class="icon-input">
                        <label for="autor">Autor*</label>
                        <input class="input-forms" type="text" name="autor" id="autor" placeholder="Vinicius Alves"
                            required minlength="2" maxlength="30" value="<?php echo htmlspecialchars($autor); ?>">
                        <i class="fa fa-user icon"></i>
                    </div>

                    <div class="icon-input">
                        <label for="ano_publicacao">Ano de Publicação*</label>
                        <input class="input-forms" type="number" name="ano_publicacao" id="ano_publicacao"
                            placeholder="0000" required min="1600" max="2100"
                            value="<?php echo htmlspecialchars($ano_publicacao); ?>">
                        <i class="fa fa-calendar icon" id="togglePassword"></i>
                    </div>

                    <div class="icon-input">
                        <label for="genero">Gênero*</label>
                        <input class="input-forms" type="text" name="genero" id="genero" placeholder="Exemplo: Ação"
                            required minlength="2" maxlength="16" value="<?php echo htmlspecialchars($genero); ?>">
                        <i class="fa fa-tag icon" id="togglePassword"></i>
                    </div>

                    <input type="submit" name="update" class="enviar">
                </form>

                <div class="voltar">
                    <a href="tabelaLivro.php">
                        <i class="fa fa-arrow-left"></i> Voltar
                    </a>
                </div>
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