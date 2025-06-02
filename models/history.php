<?php

require_once __DIR__ . '/../models/match.php';
require_once __DIR__ . '/../utils/files.php';

function getHistoryFilePath(): string {
    return __DIR__ . '/../data/history.json';
}

function saveMatchHistory(string $userHand, string $cpuHand, string $gameState) {
    if(file_exists(getHistoryFilePath()) === false) {
        createFile(getHistoryFilePath());
    }

    $date = date('Y-m-d H:i:s');
    $matchHistory = [
        'date' => $date,
        'userHand' => $userHand,
        'cpuHand' => $cpuHand,
        'result' => $gameState
    ];

    $history = getHistory();
    $history[] = $matchHistory;

    file_put_contents(getHistoryFilePath(), json_encode($history, JSON_PRETTY_PRINT));
}


function getHistory(): array {
    if(file_exists(getHistoryFilePath()) === false) {
        return [];
    }

    $fileContent = file_get_contents(getHistoryFilePath());
    $fileContentAsArray = json_decode($fileContent, true);

    if($fileContentAsArray === null) {
        return [];
    }

    return sanitizeHistoryData($fileContentAsArray);
}

function sanitizeHistoryData(array $historyData): array {
    $cleanedHistory = [];
    foreach($historyData as $match) {
        if(checkMatchArrayHasExpectedKeys($match) === false) {
            continue;
        }

        if(checkMatchArrayDataIsValid($match) === false) {
            continue;
        }

        $cleanedHistory[] = $match;
    }

    return $cleanedHistory;
}

function checkMatchArrayHasExpectedKeys(array $match): bool {
    if(count(array_keys($match)) !== 4) {
        return false;
    }

    foreach($match as $key => $value) {
        if(in_array($key, ['date', 'userHand', 'cpuHand', 'result']) === false) {
            return false;
        }
    }

    return true;
}

function checkMatchArrayDataIsValid(array $match): bool {
    if(in_array($match['userHand'], getHandTypes()) === false) {
        return false;
    }
    
    if(in_array($match['cpuHand'], getHandTypes()) === false) {
        return false;
    }
    
    if(in_array($match['result'], ['DRAW', 'LOST', 'WON']) === false) {
        return false;
    }

    return true;
}
