<?php

require_once __DIR__ . '/../game/states.php';
require_once __DIR__ . '/../utils/input.php';
require_once __DIR__ . '/../models/match.php';
require_once __DIR__ . '/../models/history.php';

function handlePlayingAction(string $userChoice): string {
    if(checkUserInputIsValid($userChoice, getPlayingInputToHandType()) === false) {
        return getGameStates()['INPUT_ERROR'];
    }

    if($userChoice === 'm') {
        return getGameStates()['MAIN_MENU'];
    }

    $cpuHand = getCpuHand();
    $userHand = getPlayingInputToHandType()[$userChoice];
    $gameState = getMatchResult($userHand, $cpuHand);

    saveMatchHistory($userHand, $cpuHand, $gameState);

    return $gameState;
}

function getPlayingMessage(): string {
    $message = "Choisissez une main à jouer : \n\n";
    $message .= "Pierre : 1\n";
    $message .= "Feuille : 2\n";
    $message .= "Ciseaux : 3\n";
    $message .= "Retour au menu princpal : m\n";

    return $message;
}

function getPlayingInputToHandType(): array {
    return [
        '1' => 'pierre',
        '2' => 'feuille',
        '3' => 'ciseaux',
        'm' => 'menu'
    ];
}
