<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

include 'infra/conexao.php';

$medicos = $conexao->query('SELECT * FROM medicos');

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos</title>
</head>
<body>

    <h1>Médicos</h1>

    <a href="public/medico/cadastrar_medico.php">Cadastrar médico</a>
    <a href="home.php">Voltar</a>

    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Especialidade</th>
            <th>Ações</th>
        </tr>

        <?php while ($medico = $medicos->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($medico['nome']) ?></td>
                <td><?= htmlspecialchars($medico['especialidade']) ?></td>
                <td>
                    <form action="public/medico/editar_medico.php" method="GET">
                        <input type="hidden" name="id" value="<?= $medico['id'] ?>">
                        <button type="submit">Editar</button>
                    </form>

                    <form action="public/medico/excluir_medico.php" method="POST">
                        <input type="hidden" name="id" value="<?= $medico['id'] ?>">
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>