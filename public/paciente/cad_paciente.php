<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../../index.php");
    exit();
}

include "../../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];

    $sql = "INSERT INTO pacientes (nome, telefone) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $nome, $telefone);
    mysqli_stmt_execute($stmt);

    header("Location: ../../pacientes.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar paciente</title>
</head>
<body>
    <h1>Cadastrar paciente</h1>

    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <br>

        <label for="telefone">Telefone:</label>
        <input type="tel" name="telefone" id="telefone" required>
        <br>

        <button type="submit">Cadastrar</button>
    </form>

    <a href="../../pacientes.php">Voltar</a>
</body>
</html>