<?php

require_once __DIR__ . '/states.php';
require_once __DIR__ . '/../utils/terminal.php';
require_once __DIR__ . '/../utils/input.php';
require_once __DIR__ . '/../screens/menu.php';
require_once __DIR__ . '/../screens/playing.php';
require_once __DIR__ . '/../screens/won.php';
require_once __DIR__ . '/../screens/lost.php';
require_once __DIR__ . '/../screens/draw.php';
require_once __DIR__ . '/../screens/history.php';
require_once __DIR__ . '/../screens/stats.php';
require_once __DIR__ . '/../screens/invalidInput.php';
require_once __DIR__ . '/../models/timeOfPlay.php';

function runGame() {
    $timeStart = microtime(true);
    $currentGameState = getGameStates()['MAIN_MENU'];
    $newGameState = '';
    $lastGameState = '';

    while($currentGameState !== getGameStates()['EXITED']) {
        clearTerminalOutput();
        $newGameState = executeScreenAccordingToState($currentGameState, $lastGameState);
        $lastGameState = $currentGameState;
        $currentGameState = $newGameState;
        $timeEnd = microtime(true);
        saveTimeOfPlay($timeStart, $timeEnd);
    }
}

function executeScreenAccordingToState(string $currentGameState, string $lastGameState): string {
    if($currentGameState === getGameStates()['INPUT_ERROR']) {
        displayMessageInTerminal(getInvalidUserInputMessage());
        getUserInput();
        return $lastGameState;
    }
    
    if($currentGameState === getGameStates()['MAIN_MENU']) {
        displayMessageInTerminal(getMainMenuMessage());
        $userInput = getUserInput();
        return handleMenuAction($userInput);
    }

    if($currentGameState === getGameStates()['PLAYING']) {
        displayMessageInTerminal(getPlayingMessage());
        $userInput = getUserInput();
        return handlePlayingAction($userInput);
    }
    
    if($currentGameState === getGameStates()['WON']) {
        displayMessageInTerminal(getWonMessage());
        $userInput = getUserInput();
        return handleWonAction($userInput);
    }
    
    if($currentGameState === getGameStates()['LOST']) {
        displayMessageInTerminal(getLostMessage());
        $userInput = getUserInput();
        return handleLostAction($userInput);
    }

    if($currentGameState === getGameStates()['DRAW']) {
        displayMessageInTerminal(getDrawMessage());
        $userInput = getUserInput();
        return handleDrawAction($userInput);
    }

    if($currentGameState === getGameStates()['HISTORY']) {
        return handleHistoryScreen();
    }

    if($currentGameState === getGameStates()['STATS']) {
        displayMessageInTerminal(getStatsMessage());
        $userInput = getUserInput();
        return handleStatsAction($userInput);
    }
    
}


