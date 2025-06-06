<?php
// game.php - page pour choisir la main et lancer une partie
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Online Shifumi - Nouvelle partie</title>
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
        <h1>Partie lancée</h1>
        <form action="result.php" method="post">
            <p>Choisir une main à jouer :</p>

            <input type="radio" id="rock" name="choice" value="rock" required>
            <label for="rock">Pierre</label><br />

            <input type="radio" id="paper" name="choice" value="paper">
            <label for="paper">Papier</label><br />

            <input type="radio" id="scissors" name="choice" value="scissors">
            <label for="scissors">Ciseaux</label><br />

            <button type="submit">Jouer !</button>
        </form>
    </main>

    <footer>
        <p>Online Shifumi</p>
    </footer>
</body>
</html>
