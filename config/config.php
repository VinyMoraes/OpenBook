<?php 

    $dbHost = 'Localhost';
    $dbUserName = 'root';
    $dbPassword = '';
    $dbName = 'hrmaster';

    $conexao = new mysqli($dbHost,$dbUserName,$dbPassword,$dbName);

    // Verificando se a conexção foi feita com sucesso
    //if($conexao -> connect_errno){
    //    echo "Não foi possível realizar a conexão";
    //}
    //else {
    //    echo "A conexão foi realizada com sucesso";
    //}

?>