<?php

require_once __DIR__ . '/../game/states.php';

function getHandTypes(): array {
    return [
        'pierre',
        'feuille',
        'ciseaux'
    ];
}

function getCpuHand(): string {
    $randomIndex = rand(0,2);
    return getHandTypes()[$randomIndex];
}

function getHandAdvantage(): array {
    return [
        'pierre' => 'ciseaux',
        'feuille' => 'pierre',
        'ciseaux' => 'feuille'
    ];
}

function getMatchResult(string $userHand, string $cpuHand): string {
    if($userHand === $cpuHand) {
        return getGameStates()['DRAW'];
    }

    if($cpuHand === getHandAdvantage()[$userHand]) {
        return getGameStates()['WON'];
    }

    return getGameStates()['LOST'];
}
