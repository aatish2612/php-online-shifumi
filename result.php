<?php
// result.php - calcul du résultat, affichage et enregistrement en base

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['choice'])) {
    header('Location: game.php');
    exit;
}

$playerChoice = $_POST['choice'];
$possibleChoices = ['rock', 'paper', 'scissors'];
$cpuChoice = $possibleChoices[array_rand($possibleChoices)];

function calculateResult(string $player, string $cpu): string {
    if ($player === $cpu) {
        return 'égalité';
    }
    if (
        ($player === 'rock' && $cpu === 'scissors') ||
        ($player === 'paper' && $cpu === 'rock') ||
        ($player === 'scissors' && $cpu === 'paper')
    ) {
        return 'victoire';
    }
    return 'défaite';
}

$result = calculateResult($playerChoice, $cpuChoice);

$host = 'localhost';
$db   = 'shifumi';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Insère sans id, car auto-incrémenté
    $stmt = $pdo->prepare('INSERT INTO games (date, handPlayedByUser, handPlayedByCPU, result) VALUES (NOW(), :player, :cpu, :result)');
    $stmt->execute([
        ':player' => $playerChoice,
        ':cpu' => $cpuChoice,
        ':result' => $result,
    ]);
} catch (PDOException $e) {
    // Gérer l'erreur ou ignorer
}

function labelChoice(string $choice): string {
    return match ($choice) {
        'rock' => 'Pierre',
        'paper' => 'Papier',
        'scissors' => 'Ciseaux',
        default => 'Inconnu',
    };
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Online Shifumi - Résultat</title>
</head>
<body>
<nav>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="game.php">Nouvelle partie</a></li>
        <li><a href="history.php">Historique des parties</a></li>
    </ul>
</nav>

<main>
    <h1>Résultat de la partie</h1>
    <p>Tu as joué : <strong><?= htmlspecialchars(labelChoice($playerChoice)) ?></strong></p>
    <p>Le CPU a joué : <strong><?= htmlspecialchars(labelChoice($cpuChoice)) ?></strong></p>

    <?php if ($result === 'victoire'): ?>
        <p>Bravo, tu as gagné !</p>
    <?php elseif ($result === 'défaite'): ?>
        <p>Tu as perdu, retente ta chance !</p>
    <?php else: ?>
        <p>C'est une égalité !</p>
    <?php endif; ?>
</main>

<footer>
    <p>Online Shifumi</p>
</footer>
</body>
</html>
