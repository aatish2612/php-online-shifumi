<?php

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Online shifumi - En jeu</title>
    </head>
    <body>
        <nav>
            <ul>
                <li>
                    <a href="./index.php">Accueil</a>
                </li>
                <li>
                    <a href="./">Nouvelle partie</a>
                </li>
                <li>
                    <a href="./history.php">Historique des parties</a>
                </li>
            </ul>
        </nav>
        <main>
            <h1>Partie lancée !</h1>
            <form>
                <p>Choisir une main à jouer</p>
                <input type="radio" value="rock" id="rock">
                <label for="rock">Pierre</label><br>
                <input type="radio" value="paper" id="paper">
                <label for="paper">Papier</label><br>
                <input type="radio" value="scissors" id="scissors">
                <label for="scissors">Ciseaux</label><br>
                <button>Jouer !</button>
            </form>
        </main>
        <footer>
            <p>Online shifumi</p>
        </footer>
    </body>
</html>
