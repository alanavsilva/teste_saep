<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

include 'infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (int) $_POST['id'];
    $nome = $_POST['nome'];
    $especialidade = $_POST['especialidade'];

    $sql = 'UPDATE medicos SET nome = ?, especialidade = ? WHERE id = ?';
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('ssi', $nome, $especialidade, $id);
    $stmt->execute();

    header('Location: medicos.php');
    exit();
}

$id = (int) ($_GET['id'] ?? 0);

$stmt = $conexao->prepare('SELECT * FROM medicos WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$medico = $stmt->get_result()->fetch_assoc();

if (!$medico) {
    header('Location: medicos.php');
    exit();
}
?>

<meta charset="UTF-8">
<h1>Editar médico</h1>

<form action="editar_medico.php" method="POST">
    <input type="hidden" name="id" value="<?= $medico['id'] ?>">

    <label>Nome
        <input type="text" name="nome" maxlength="100"
               value="<?= htmlspecialchars($medico['nome']) ?>" required>
    </label><br>

    <label>Especialidade
        <input type="text" name="especialidade" maxlength="100"
               value="<?= htmlspecialchars($medico['especialidade']) ?>" required>
    </label><br>

    <button type="submit">Salvar</button>
</form>

<a href="medicos.php">Voltar</a>