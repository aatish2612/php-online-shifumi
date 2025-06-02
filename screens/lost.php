<?php

require_once __DIR__ . '/../game/states.php';

function handleLostAction(string $userChoice): string {
    $stats = calculateStats(getHistory());
    saveStats($stats);
    if(checkUserInputIsValid($userChoice, getLostInputToState()) === false) {
        return getGameStates()['INPUT_ERROR'];
    }

    return getLostInputToState()[$userChoice];
    
}

function getLostMessage(): string {
    $message = "Vous avez perdu...\n\n";
    $message .= "Rejouer ? : 1\n";
    $message .= "Retour au menu principal : m\n";

    return $message;    
}

function getLostInputToState(): array {
    return [
        '1' => 'PLAYING',
        'm' => 'MAIN_MENU'
    ];
}
