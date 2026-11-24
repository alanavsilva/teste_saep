<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

include "../../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = (int) $_POST["id"];

    $sql = "SELECT id FROM consultas WHERE id_paciente = $id";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo '<meta charset="UTF-8">';
        echo '<p>Este paciente não pode ser excluído porque tem uma consulta vinculada.</p>';
        echo '<a href="../../pacientes.php">Voltar</a>';
        exit();
    }

    $sql = "DELETE FROM pacientes WHERE id = $id";
    mysqli_query($conexao, $sql);
}

header("Location: ../../pacientes.php");
exit();