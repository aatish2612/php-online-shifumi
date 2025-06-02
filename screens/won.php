<?php

require_once __DIR__ . '/../game/states.php';
require_once __DIR__ . '/../models/stats.php';
require_once __DIR__ . '/../models/history.php';


function handleWonAction(string $userChoice): string {

    $stats = calculateStats(getHistory());
    saveStats($stats);
    
    if(checkUserInputIsValid($userChoice, getWonInputToState()) === false) {
        return getGameStates()['INPUT_ERROR'];
    }

    return getWonInputToState()[$userChoice];
    
}

function getWonMessage(): string {
    $message = "Vous avez gagné !\n\n";
    $message .= "Rejouer ? : 1\n";
    $message .= "Retour au menu principal : m\n";

    return $message;    
}

function getWonInputToState(): array {
    return [
        '1' => 'PLAYING',
        'm' => 'MAIN_MENU'
    ];
}
