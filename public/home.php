<?php

session_start();

if(!isset($_SESSION[usuario])){
    header('Location: index.php')
    exit()
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

<h1>Bem vindo <?php htmlspecialchars($_SESSION[nome]) ?></h1>

<a href="medicos.php">Médicos</a><br>
<a href="pacientes.php">Pacientes</a><br>
<a href="consultas.php">Cadastrar consulta</a><br><br>
    
<form action="logout.php" method='POST'>
<button type="submit">Sair</button>
</form>
</body>
</html>