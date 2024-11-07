<?php
session_start();

require_once '../config/config.php';

// Verifica se o usuário está logado e se tem permissão de administrador
if (!isset($_SESSION['email']) || !isset($_SESSION['permissao']) || $_SESSION['permissao'] != 1) {
    // Se não estiver logado ou não for admin, redireciona para a página de login
    header("Location: ../login.php");
    exit();
}
// Consulta SQL com JOIN para obter o nome do usuário
$sql_registros = "SELECT alugueis.*, usuarios.nome AS nome_usuario
FROM alugueis 
JOIN usuarios ON alugueis.usuario_id = usuarios.id 
ORDER BY alugueis.id ASC";
$resultado = $conexao->query($sql_registros);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/tabelaUser.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="icon" href="../img/logo.png">
    <title>Listar Empréstimos de Livros</title>
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
                <li><a href="#">List. Empréstimos</a></li>
                <li><a href="../painelAdmin.php">Painel Admin</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="search-container mb-4 d-flex justify-content-center">
            <button class="btn btn-sm btn-secondary me-2" id="showAllBtn" style="margin-top: 20px;">
                <i class="fa fa-list"></i>
            </button>

            <button class="btn btn-sm btn-primary" id="searchBtn" style="margin-top: 20px;">
                <i class="fa fa-search"></i>
            </button>
            <input type="text" class="form-control mx-2" id="searchInput" placeholder="Pesquisar..."
                style="display:none; width: 300px; margin-top: 20px;">
        </div>

        <div class="m-5">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">ID LIVRO</th>
                            <th scope="col">ID USUÁRIO</th>
                            <th scope="col">NOME DO USUÁRIO</th>
                            <th scope="col">DATA DE ALUGUEL</th>
                            <th scope="col">DATA DE DEVOLUÇÃO</th>
                            <th scope="col">...</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Executa a consulta SQL
                        //$sql_registros = "SELECT * FROM alugueis ORDER BY id ASC";
                        $resultado = $conexao->query($sql_registros);

                        // Verifica se a consulta foi executada com sucesso
                        if ($resultado && $resultado->num_rows > 0) {
                            while ($user_data = $resultado->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $user_data['id'] . "</td>";
                                echo "<td>" . htmlspecialchars($user_data['livro_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($user_data['usuario_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($user_data['nome_usuario']) . "</td>";
                                echo "<td>" . htmlspecialchars($user_data['data_aluguel']) . "</td>";
                                echo "<td>" . htmlspecialchars($user_data['data_devolucao']) . "</td>";
                                echo "<td> 
                                <a class='btn btn-sm btn-primary' href='editarEmprestimos.php?id=" . $user_data['id'] . "'>
                                    <i class='fa fa-edit'></i>
                                </a>
                                <a class='btn btn-sm btn-danger' href='../config/cancelarEmprestimo.php?id=" . $user_data['id'] . "'>
                                    <i class='fa fa-trash'></i>
                                </a>
                            </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Nenhum usuário encontrado.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
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

    <script src="../js/mostrar_todos.js"></script>
    <script src="../js/pesquisa.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>