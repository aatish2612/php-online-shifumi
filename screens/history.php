<?php

require_once __DIR__ . '/../game/states.php';
require_once __DIR__ . '/../models/history.php';

function handleHistoryScreen(): string {
    $index = 0;
    $userChoice = null;
    while($userChoice !== 'm') {
        $historyMessagePaginated = getHistoryMessagePaginated($index);
        displayMessageInTerminal($historyMessagePaginated['message']);
        $userChoice = getUserInput();

        if(checkUserInputIsValid($userChoice, getHistoryInputToState()) === false) {
            return getGameStates()['INPUT_ERROR'];
        }
        
        if($userChoice === 'n') {
            $index = $historyMessagePaginated['nextPage'];
        }

        if($userChoice === 'p'){
            $index = $historyMessagePaginated['previousPage'];
        }
        
        clearTerminalOutput();
    }

    return getHistoryInputToState()[$userChoice];    
}


function getHistoryMessagePaginated(int $index): array {
    $message = "Votre historique de parties :\n\n";
    
    $historyOfMatches = getHistory();

    $pageStart = $index * 10;
    $pageEnd = min(count($historyOfMatches), $index + 10);

    $message .= getHistoryOfMatchesAsTextTable($historyOfMatches, $pageStart, $pageEnd);

    $message .= "Page suivante : n\n";
    $message .= "Page précédente : p\n";
    $message .= "Retourner au menu : m\n";
    
    return [
        'message' => $message,
        'previousPage' => max($index - 1, 0),
        'nextPage' => $index + 1
    ];
}

function getHistoryOfMatchesAsTextTable(array $historyOfMatches, int $pageStart, int $pageEnd): string {
    $historyTextTable = '';
    
    $mask = "|%-30s |%-15s | %-15s | %-15s |\n";
    $historyTextTable .= sprintf($mask, 'Date', 'Main joueur', 'Main CPU', 'Résultat');
    for($i = $pageStart; $i < $pageEnd; $i++) {
        $historyTextTable .= sprintf($mask, $historyOfMatches[$i]['date'], $historyOfMatches[$i]['userHand'], $historyOfMatches[$i]['cpuHand'], $historyOfMatches[$i]['result']); 
    }
    
    return $historyTextTable;
}


function getHistoryInputToState(): array {
    return [
        'm' => 'MAIN_MENU',
        'n' => 'HISTORY',
        'p' => 'HISTORY'
    ];
}

