<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "cadastro");
define("DB_PORT", "3306");


function abrirBanco(){
    $conexao = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME, DB_PORT);

     if ($conexao-> connect_errno); {
        // die("falha na conexão". $conexaoComBanco->connect_error);
     }
     return  $conexao;
}


function fecharBanco($conexao){
    $conexao->close();
}
?>