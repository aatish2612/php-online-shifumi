<?php

require_once __DIR__ . '/history.php';
require_once __DIR__ . '/../utils/files.php';

function getStatsFilePath(): string {
    return __DIR__ . '/../data/stats.json';
}

function getStats(): array {
    if(file_exists(getStatsFilePath()) === false) {
        createFile(getStatsFilePath());

        return [];
    }

    $fileContent = file_get_contents(getStatsFilePath());
    $fileContentAsArray = json_decode($fileContent, true);

    if($fileContentAsArray === null) {
        return [];
    }
    
    return $fileContentAsArray;
}

function saveStats(array $stats): void {
    file_put_contents(getStatsFilePath(), json_encode($stats, JSON_PRETTY_PRINT));
}

function calculateStats(array $historyOfMatches): array {
    $stats = [
        'totalOfMatches' => 0,
        'victoryPercentage' => 0,
        'handsWinningPercentageStats' => [
            'pierre' => 0,
            'feuille' => 0,
            'ciseaux' => 0
        ]
    ];

    $stats['totalOfMatches'] = count($historyOfMatches);
    if($stats['totalOfMatches'] === 0){
        return $stats;
    }

    $handsWinningStats = getHandsWinningStats($historyOfMatches);
    $victoryCount = getVictoryCount($handsWinningStats);
    
    $handsWinningPercentageStats = getHandsWinningPercentageStats($handsWinningStats, $victoryCount);

    $stats['victoryPercentage'] = floor(($victoryCount / $stats['totalOfMatches'] * 100));
    $stats['handsWinningPercentageStats'] = $handsWinningPercentageStats;
    
    return $stats;    
}

function getVictoryCount(array $handsWinningStats): int {
    $count = 0;

    foreach($handsWinningStats as $stat) {
        $count += $stat;
    }
    
    return $count;
}

function getHandsWinningStats(array $historyOfMatches): array {
    $handsWinningStats = [
        'pierre' => 0,
        'feuille' => 0,
        'ciseaux' => 0
    ];

    foreach($historyOfMatches as $match) {
        if($match['result'] !== 'WON') {
            continue;
        }

        $handsWinningStats[$match['userHand']]++;
    }

    return $handsWinningStats;
}

function getHandsWinningPercentageStats(array $handsWinningStats, int $victoryCount): array {
    $handsWinningPercentageStats = [
        'pierre' => 0,
        'feuille' => 0,
        'ciseaux' => 0
    ];

    if($victoryCount === 0) {
        return $handsWinningPercentageStats;
    }

    foreach($handsWinningStats as $hand => $score) {
        $handsWinningPercentageStats[$hand] = floor(($score / $victoryCount) * 100);
    }

    return $handsWinningPercentageStats;
}

function getBetterHandAccordingToPercentage(array $handsWinningPercentageStats): string {
    $betterHandPercentage = 0;
    $betterHand = '';

    foreach($handsWinningPercentageStats as $hand=>$percentage) {
        if($percentage > $betterHandPercentage) {
            $betterHand = $hand;
        }
    }

    return $betterHand;
}

