<?php

function getGameStates(): array {
    return [
        'MAIN_MENU' => 'MAIN_MENU',
        'PLAYING' => 'PLAYING',
        'WON' => 'WON',
        'LOST' => 'LOST',
        'DRAW' => 'DRAW',
        'HISTORY' => 'HISTORY',
        'STATS' => 'STATS',
        'INPUT_ERROR' => 'INPUT_ERROR',
        'EXITED' => 'EXITED'
    ];
}
