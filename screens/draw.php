<?php

require_once __DIR__ . '/../game/states.php';

function handleDrawAction(string $userChoice): string {
    $stats = calculateStats(getHistory());
    saveStats($stats);
    if(checkUserInputIsValid($userChoice, getDrawInputToState()) === false) {
        return getGameStates()['INPUT_ERROR'];
    }

    return getDrawInputToState()[$userChoice];
    
}

function getDrawMessage(): string {
    $message = "Match nul.\n\n";
    $message .= "Rejouer ? : 1\n";
    $message .= "Retour au menu principal : m\n";

    return $message;    
}

function getDrawInputToState(): array {
    return [
        '1' => 'PLAYING',
        'm' => 'MAIN_MENU'
    ];
}
