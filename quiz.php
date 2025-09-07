<?php
session_start();
require_once 'perguntas.php';

if (!isset($_SESSION['indice'])) {
    $_SESSION['indice'] = 0;
    $_SESSION['pontuacao'] = 0;
}

$indice = $_SESSION['indice'];
$feedback = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resposta'])) {
    $resposta = intval($_POST['resposta']);
    $indice_anterior = $indice - 1;
    $correta = $perguntas[$indice_anterior]['resposta_correta'];

    if ($resposta === $correta) {
        $_SESSION['pontuacao']++;
        $feedback = "✅ Correto!";
    } else {
        $certa = $perguntas[$indice_anterior]['opcoes'][$correta];
        $feedback = "❌ Errado. A resposta certa era: <strong>$certa</strong>";
    }
}

if ($indice >= count($perguntas)) {

    if (!empty($feedback)) {
        echo "
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Fim do Quiz</title>
            <link rel='stylesheet' href='style.css'>
        </head>
        <body>
            <div class='container'>
                <h1>Quiz Finalizado!</h1>
                <div class='feedback'>$feedback</div>
                <p>Sua pontuação: <strong>{$_SESSION['pontuacao']}</strong> de <strong>" . count($perguntas) . "</strong></p>
                <form action='index.php'>
                    <button type='submit'>Reiniciar</button>
                </form>
            </div>
        </body>
        </html>";
    }
    session_destroy();
    exit;
}

$perguntaAtual = $perguntas[$indice];
$_SESSION['indice']++;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pergunta <?= $indice ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2><?= $perguntaAtual['pergunta'] ?></h2>

        <form method="post">
            <?php foreach ($perguntaAtual['opcoes'] as $i => $opcao): ?>
                <label>
                    <input type="radio" name="resposta" value="<?= $i ?>" required>
                    <?= $opcao ?>
                </label>
            <?php endforeach; ?>
            <button type="submit">Enviar</button>
        </form>

        <?php if (!empty($feedback)): ?>
            <div class="feedback"><?= $feedback ?></div>
        <?php endif; ?>
    </div>
</body>
</html>