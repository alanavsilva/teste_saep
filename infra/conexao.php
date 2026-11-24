<?php

$host = 'localhost';
$user = 'root';
$password = 'root';
$database = 'clinica';
$port = '3306';

$conexao = new mysqli($host, $user, $password, $database, $port);

if($conexao->connect_error){
    die('Erro na conexao: '. $conexao->connect_error);
}

$conexao->set_charset("utf8mb4");

?>