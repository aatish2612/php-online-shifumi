<?php

function createFile(string $filePath) {
    $fp = fopen($filePath, 'w');
    fwrite($fp, '');
    fclose($fp);
    chmod($filePath, 0644);
}
