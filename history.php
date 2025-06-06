<?php
session_start();

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
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear'])) {
        $pdo->exec('TRUNCATE TABLE games');
        header('Location: history.php');
        exit;
    }

    $stmt = $pdo->query('SELECT * FROM games ORDER BY date DESC');
    $games = $stmt->fetchAll();
} catch (PDOException $e) {
    $games = [];
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
    <title>Online Shifumi - Historique</title>
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
    <h1>Historique des parties</h1>

    <?php if (empty($games)): ?>
        <p>Aucune partie enregistrée pour le moment.</p>
    <?php else: ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Choix Joueur</th>
                    <th>Choix CPU</th>
                    <th>Résultat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($games as $game): ?>
                    <tr>
                        <td><?= htmlspecialchars($game['date']) ?></td>
                        <td><?= htmlspecialchars(labelChoice($game['handPlayedByUser'])) ?></td>
                        <td><?= htmlspecialchars(labelChoice($game['handPlayedByCPU'])) ?></td>
                        <td><?= htmlspecialchars(ucfirst($game['result'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <form method="post" action="history.php">
            <button type="submit" name="clear">Effacer l'historique</button>
        </form>
    <?php endif; ?>
</main>

<footer>
    <p>Online Shifumi</p>
</footer>
</body>
</html>
