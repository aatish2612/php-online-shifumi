<?php


function getTimeOfPlayFilePath(): string {
    return __DIR__ . '/../data/time.json';
}

function getTimeOfPlay(): array {
    if(file_exists(getTimeOfPlayFilePath()) === false) {
        createFile(getTimeOfPlayFilePath());

        return ['timeOfPlay' => 0];
    }

    $fileContent = file_get_contents(getTimeOfPlayFilePath());
    $fileContentAsArray = json_decode($fileContent, true);

    if($fileContentAsArray === null) {
        return ['timeOfPlay' => 0];
    }

    return $fileContentAsArray;
}


function saveTimeOfPlay(float $timeStart, float $timeEnd): void {
    $currentTimeOfPlay = getTimeOfPlay();
    if(empty($currentTimeOfPlay)) {
        $currentTimeOfPlay = ['timeOfPlay' => 0];
    }

    $newPlayedTime = $timeEnd - $timeStart;

    $currentTimeOfPlay['timeOfPlay']+= (int)$newPlayedTime;
    file_put_contents(getTimeOfPlayFilePath(), json_encode($currentTimeOfPlay, JSON_PRETTY_PRINT));    
}
