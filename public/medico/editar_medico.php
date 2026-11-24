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
    $especialidade = $_POST["especialidade"];

    $sql = "UPDATE medicos SET nome = ?, especialidade = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $nome, $especialidade, $id);
    mysqli_stmt_execute($stmt);

    header("Location: ../../medicos.php");
    exit();
}

$id = (int) ($_GET["id"] ?? 0);
$sql = "SELECT * FROM medicos WHERE id = $id";
$resultado = mysqli_query($conexao, $sql);
$medico = mysqli_fetch_assoc($resultado);

if (!$medico) {
    header("Location: ../../medicos.php");
    exit();
}

?>

<meta charset="UTF-8">
<h1>Editar médico</h1>

<form action="editar_medico.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $medico["id"]; ?>">

    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome"
           value="<?php echo htmlspecialchars($medico["nome"]); ?>" required>
    <br>

    <label for="especialidade">Especialidade:</label>
    <input type="text" name="especialidade" id="especialidade"
           value="<?php echo htmlspecialchars($medico["especialidade"]); ?>" required>
    <br>

    <button type="submit">Atualizar</button>
</form>

<a href="../../medicos.php">Voltar</a>