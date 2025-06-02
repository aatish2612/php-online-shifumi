<?php

function clearTerminalOutput(): void {
    echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
}

function displayMessageInTerminal(string $message): void {
    echo $message;
}
