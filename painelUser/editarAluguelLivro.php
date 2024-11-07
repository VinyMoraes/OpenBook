<?php
session_start();
require_once '../config/config.php';

// Verifica se o usuário está logado e se tem permissão de usuario
if (!isset($_SESSION['email']) || !isset($_SESSION['permissao']) || $_SESSION['permissao'] != 0) {
    // Se não estiver logado ou não for admin, redireciona para a página de login
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id']; // Supondo que você está passando o ID do aluguel pela URL
$sql = "SELECT * FROM alugueis WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verificações simples para evitar avisos
    $data_aluguel = $row['data_aluguel'];
    $data_devolucao = $row['data_devolucao'] ?? 'Data não disponível';
} else {
    echo "Aluguel não encontrado.";
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
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="icon" href="../img/logo.png">
    <title>Editar Aluguel do Livro</title>
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
                <li><a href="#">EDIT. ALUGUEL</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Editar Aluguel</h1>
                <form action="../config/saveAluguelLivro.php" method="post" class="form-responsivo">

                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                    <div class="icon-input">
                        <label for="data_aluguel">Data de Aluguel</label>
                        <input class="input-forms readonly-field" type="text" name="data_aluguel" id="data_aluguel"
                            placeholder="2024" readonly-field minlength="2" maxlength="30"
                            value="<?php echo htmlspecialchars($data_aluguel); ?>">
                        <i class="fa fa-calendar icon"></i>
                    </div>

                    <div class="icon-input">
                        <label for="data_devolucao">Data de Devolução*</label>
                        <input class="input-forms" type="date" name="data_devolucao" id="data_devolucao" required
                            minlength="2" maxlength="30" value="<?php echo htmlspecialchars($data_devolucao); ?>">
                        <i class="fa fa-calendar icon"></i>
                    </div>

                    <input type="submit" name="update" class="enviar">
                </form>

                <div class="voltar">
                    <a href="listarAluguel.php">
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