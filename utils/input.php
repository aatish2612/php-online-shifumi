<?php

function getUserInput(): string {
    return readline();
}

function checkUserInputIsValid(string $userInput, array $expectedInputs): bool {
    return array_key_exists($userInput, $expectedInputs);
    
}
