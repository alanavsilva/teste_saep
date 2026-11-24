<?php

session_start();

if (isset($_SESSION['usuario'])) {
    header('Location: home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'infra/conexao.php';

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = 'SELECT nome, email, senha FROM funcionarios WHERE email = ?';
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $usuario = $stmt->get_result()->fetch_assoc();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = $usuario['email'];
        $_SESSION['nome'] = $usuario['nome'];

        header('Location: home.php');
        exit();
    }
}

?>

<meta charset="UTF-8">
<h1>Login</h1>

<form action="index.php" method="POST">
    <label>Email <input type="email" name="email" required></label><br>
    <label>Senha <input type="password" name="senha" required></label><br>
    <button type="submit">Entrar</button>
</form>