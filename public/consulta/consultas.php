<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

include "infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idMedico = (int) $_POST["medico"];
    $idPaciente = (int) $_POST["paciente"];

    $sql = "INSERT INTO consultas (id_medico, id_paciente) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $idMedico, $idPaciente);
    mysqli_stmt_execute($stmt);

    header("Location: home.php");
    exit();
}

$medicos = mysqli_query($conexao, "SELECT id, nome FROM medicos");
$pacientes = mysqli_query($conexao, "SELECT id, nome FROM pacientes");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar consulta</title>
</head>
<body>
    <h1>Cadastrar consulta</h1>

    <?php if (mysqli_num_rows($medicos) > 0 && mysqli_num_rows($pacientes) > 0) { ?>
        <form method="POST">
            <label for="medico">Médico:</label>
            <select name="medico" id="medico" required>
                <option value="">Selecione um médico</option>

                <?php while ($medico = mysqli_fetch_assoc($medicos)) { ?>
                    <option value="<?php echo $medico["id"]; ?>">
                        <?php echo htmlspecialchars($medico["nome"]); ?>
                    </option>
                <?php } ?>
            </select>
            <br>

            <label for="paciente">Paciente:</label>
            <select name="paciente" id="paciente" required>
                <option value="">Selecione um paciente</option>

                <?php while ($paciente = mysqli_fetch_assoc($pacientes)) { ?>
                    <option value="<?php echo $paciente["id"]; ?>">
                        <?php echo htmlspecialchars($paciente["nome"]); ?>
                    </option>
                <?php } ?>
            </select>
            <br>

            <button type="submit">Cadastrar consulta</button>
        </form>
    <?php } else { ?>
        <p>Cadastre um médico e um paciente primeiro.</p>
    <?php } ?>

    <a href="home.php">Voltar</a>
</body>
</html>