<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

include "../../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = (int) $_POST["id"];

    $sql = "SELECT id FROM consultas WHERE id_medico = $id";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo '<meta charset="UTF-8">';
        echo '<p>Este médico não pode ser excluído porque tem uma consulta vinculada.</p>';
        echo '<a href="../../medicos.php">Voltar</a>';
        exit();
    }

    $sql = "DELETE FROM medicos WHERE id = $id";
    mysqli_query($conexao, $sql);
}

header("Location: ../../medicos.php");
exit();