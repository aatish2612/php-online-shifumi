<?php

require_once __DIR__ . '/../game/states.php';
require_once __DIR__ . '/../models/stats.php';
require_once __DIR__ . '/../models/timeOfPlay.php';

function handleStatsAction(string $userChoice): string {
    if(checkUserInputIsValid($userChoice, getStatsInputToState()) === false) {
        return getGameStates()['INPUT_ERROR'];
    }

    return getStatsInputToState()[$userChoice];
}

function getStatsMessage(): string {
    $message = "Vos statistiques de parties :\n\n";

    $stats = getStats();

    if(empty($stats)) {
        $message .= "Nombre de parties jouées : 0\n";
        $message .= "\nRetourner au menu : m\n";
        return $message;        
    }
    
    $timeOfPlay = getTimeOfPlay();

    $message .= "Nombre de parties jouées : " . $stats['totalOfMatches'] . "\n";
    $message .= "Vous avez joué : " . gmdate("H:i:s", $timeOfPlay['timeOfPlay']) . "\n";
    $message .= "Taux de victoires : " . $stats['victoryPercentage'] . "%\n";

    if($stats['victoryPercentage'] == 0) {
        $message .= "Vous n'avez pas de meilleure main...\n\n";
    } else {
        $betterHand = getBetterHandAccordingToPercentage($stats['handsWinningPercentageStats']);
        $message .= "Meilleure main : $betterHand\n\n";
    }
    
    $message .= "Détail des mains : \n\n";

    foreach($stats['handsWinningPercentageStats'] as $hand=>$percentage) {
        $message .= "$hand : $percentage% de victoire avec\n";
    }
    
    $message .= "\nRetourner au menu : m\n";

    return $message;
}


function getStatsInputToState(): array {
    return [
        'm' => 'MAIN_MENU'
    ];
}
