<?php
session_start();
require_once '../config/config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['email']) || !isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

// Verifica a permissão do usuário
$permissao = $_SESSION['permissao'];
$usuario_id = $_SESSION['usuario_id'];

// Inicializa a variável de busca
$searchTerm = "";

// Verifica se o formulário de busca foi enviado
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

// Consulta SQL para buscar aluguéis
if ($permissao === 'admin') {
    // Consulta para o admin ver todos os aluguéis, com filtragem
    $sql_registros = "SELECT alugueis.id, livros.titulo, livros.autor, usuarios.nome AS usuario, alugueis.data_aluguel, alugueis.data_devolucao
                      FROM alugueis
                      JOIN livros ON alugueis.livro_id = livros.id
                      JOIN usuarios ON alugueis.usuario_id = usuarios.id
                      WHERE livros.titulo LIKE ? OR livros.autor LIKE ? OR usuarios.nome LIKE ?";
    $stmt = $conexao->prepare($sql_registros);
    $searchWildcard = "%" . $searchTerm . "%";
    $stmt->bind_param("sss", $searchWildcard, $searchWildcard, $searchWildcard);
} else {
    // Consulta para usuários comuns verem apenas os próprios aluguéis, com filtragem
    $sql_registros = "SELECT alugueis.id, livros.titulo, livros.autor, usuarios.nome AS usuario, alugueis.data_aluguel, alugueis.data_devolucao
                      FROM alugueis
                      JOIN livros ON alugueis.livro_id = livros.id
                      JOIN usuarios ON alugueis.usuario_id = usuarios.id
                      WHERE alugueis.usuario_id = ? AND (livros.titulo LIKE ? OR livros.autor LIKE ? OR usuarios.nome LIKE ?)";
    $stmt = $conexao->prepare($sql_registros);
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conexao->error); // Verifica se ocorreu erro
    }
    $searchWildcard = "%" . $searchTerm . "%";
    $stmt->bind_param("isss", $usuario_id, $searchWildcard, $searchWildcard, $searchWildcard);
}

// Executa a consulta
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/tabelaUser.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="icon" href="../img/logo.png">
    <title>Listar Aluguel</title>
</head>

<body>
    <header>
        <nav class="nav-bar">
            <input type="checkbox" id="check">
            <label for="check" class="btn-menu"><i class="fa fa-bars"></i></label>
            <label class="title">Portal da Literatura</label>
            <ul>
                <li><a href="#">List. Aluguel</a></li>
                <li><a href="../painelUser.php">Painel User</a></li>
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
                            <th scope="col">TÍTULO</th>
                            <th scope="col">AUTOR</th>
                            <th scope="col">USUÁRIO</th>
                            <th scope="col">DATA DO ALUGUEL</th>
                            <th scope="col">DATA DE DEVOLUÇÃO</th>
                            <th scope="col">...</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // Verifica se a consulta retornou resultados
                        if ($resultado && $resultado->num_rows > 0) {
                            while ($user_data = $resultado->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $user_data['id'] . "</td>";
                                echo "<td>" . htmlspecialchars($user_data['titulo']) . "</td>";
                                echo "<td>" . htmlspecialchars($user_data['autor']) . "</td>";
                                echo "<td>" . htmlspecialchars($user_data['usuario']) . "</td>";
                                echo "<td>" . htmlspecialchars($user_data['data_aluguel']) . "</td>";
                                echo "<td>" . htmlspecialchars($user_data['data_devolucao']) . "</td>";
                                echo "<td>
                    <a class='btn btn-sm btn-primary' href='editarAluguelLivro.php?id=" . $user_data['id'] . "'>
                        <i class='fa fa-edit'></i>
                    </a>
                    <a class='btn btn-sm btn-danger' href='../config/cancelarAluguelLivro.php?id=" . $user_data['id'] . "'>
                        <i class='fa fa-trash'></i>
                    </a>
                  </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Nenhum aluguel encontrado.</td></tr>";
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