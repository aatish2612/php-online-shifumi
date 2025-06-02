<?php

require_once __DIR__ . '/../game/states.php';
require_once __DIR__ . '/../utils/input.php';

function handleMenuAction(string $userChoice): string {
    if(checkUserInputIsValid($userChoice, getMenuInputToState()) === false) {
        return getGameStates()['INPUT_ERROR'];
    }

    return getMenuInputToState()[$userChoice];
}

function getMainMenuMessage(): string {
    $message = "Bonjour c'est le shifumi \n\n";
    $message .= "Nouvelle partie : 1\n";
    $message .= "Afficher l'historique : 2\n";
    $message .= "Afficher les statistiques : 3\n";
    $message .= "Quitter : q\n";

    return $message;
}

function getMenuInputToState(): array {
    return [
        '1' => 'PLAYING',
        '2' => 'HISTORY',
        '3' => 'STATS',
        'q' => 'EXITED'
    ];
}
