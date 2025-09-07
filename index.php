<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Mini Quiz Harry Potter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Mini Quiz: Harry Potter</h1>
        <p>Teste seus conhecimentos mágicos!</p>
        <form action="quiz.php" method="post">
            <button type="submit">Iniciar Quiz</button>
        </form>
    </div>
</body>
</html>