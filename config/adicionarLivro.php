<?php
if (isset($_POST['submit'])) {
    require_once 'config.php';

    // Verifica se a conexão foi bem-sucedida
    if ($conexao) {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        // Captura o ano de publicação como um inteiro
        $ano_publicacao = (int)$_POST['ano_publicacao']; // Cast to integer
        $genero = $_POST['genero']; 

        // Usando prepared statements para evitar SQL Injection
        $stmt = $conexao->prepare("INSERT INTO livros (titulo, autor, ano_publicacao, genero) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $titulo, $autor, $ano_publicacao, $genero); // "ssis" for int

        if ($stmt->execute()) {
            // Exibe uma mensagem de sucesso e permanece na página
            echo "<script>alert('Livro cadastrado com sucesso!');</script>";
            echo "<script>window.location.href = '../painelAdmin/addLivro.php';</script>";  // Redireciona para a mesma página
        } else {
            echo "Erro na inserção: " . $stmt->error; // Mostra erro específico
        }

        $stmt->close(); // Fecha a declaração
    } else {
        echo "Erro na conexão com o banco de dados.";
    }

    $conexao->close(); // Fecha a conexão
}

?>
