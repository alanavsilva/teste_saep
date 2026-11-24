<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'infra/conexao.php';

    $id = (int) $_POST['id'];
    $stmt = $conexao->prepare('DELETE FROM medicos WHERE id = ?');
    $stmt->bind_param('i', $id);

    try {
        $stmt->execute();
    } catch (mysqli_sql_exception $erro) {
        if ($erro->getCode() == 1451) {
            exit('<meta charset="UTF-8">Este médico está vinculado a uma consulta.
                  <a href="medicos.php">Voltar</a>');
        }
        throw $erro;
    }
}

header('Location: medicos.php');
exit();