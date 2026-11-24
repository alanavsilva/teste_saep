<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

include "infra/conexao.php";

$pacientes = mysqli_query($conexao, "SELECT * FROM pacientes");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pacientes</title>
</head>
<body>
    <h1>Pacientes</h1>

    <a href="public/paciente/cadastrar_paciente.php">Cadastrar paciente</a>
    <a href="home.php">Voltar</a>

    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>

        <?php while ($paciente = mysqli_fetch_assoc($pacientes)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($paciente["nome"]); ?></td>
                <td><?php echo htmlspecialchars($paciente["telefone"]); ?></td>
                <td>
                    <form action="public/paciente/editar_paciente.php" method="GET">
                        <input type="hidden" name="id" value="<?php echo $paciente["id"]; ?>">
                        <button type="submit">Editar</button>
                    </form>

                    <form action="public/paciente/excluir_paciente.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $paciente["id"]; ?>">
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>