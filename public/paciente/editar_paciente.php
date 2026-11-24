<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

include "../../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = (int) $_POST["id"];
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];

    $sql = "UPDATE pacientes SET nome = ?, telefone = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $nome, $telefone, $id);
    mysqli_stmt_execute($stmt);

    header("Location: ../../pacientes.php");
    exit();
}

$id = (int) ($_GET["id"] ?? 0);
$sql = "SELECT * FROM pacientes WHERE id = $id";
$resultado = mysqli_query($conexao, $sql);
$paciente = mysqli_fetch_assoc($resultado);

if (!$paciente) {
    header("Location: ../../pacientes.php");
    exit();
}

?>

<meta charset="UTF-8">
<h1>Editar paciente</h1>

<form action="editar_paciente.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $paciente["id"]; ?>">

    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome"
           value="<?php echo htmlspecialchars($paciente["nome"]); ?>" required>
    <br>

    <label for="telefone">Telefone:</label>
    <input type="tel" name="telefone" id="telefone"
           value="<?php echo htmlspecialchars($paciente["telefone"]); ?>" required>
    <br>

    <button type="submit">Atualizar</button>
</form>

<a href="../../pacientes.php">Voltar</a>