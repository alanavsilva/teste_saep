<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit();
}

include "../../infra/conexao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST["nome"];
    $especialidade = $_POST["especialidade"];

    $sql = "INSERT INTO medicos (nome, especialidade) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $nome, $especialidade);
    mysqli_stmt_execute($stmt);

    header("Location: ../../medicos.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar médico</title>
</head>
<body>
    <h1>Cadastrar médico</h1>

    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <br>

        <label for="especialidade">Especialidade:</label>
        <input type="text" name="especialidade" id="especialidade" required>
        <br>

        <button type="submit">Cadastrar</button>
    </form>

    <a href="../../medicos.php">Voltar</a>
</body>
</html>