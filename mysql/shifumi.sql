DROP DATABASE IF EXISTS shifumi;
CREATE DATABASE shifumi;
USE shifumi;

CREATE TABLE games(
    id INT PRIMARY KEY,
    date DATETIME NOT NULL,
    handPlayedByUser VARCHAR(10) NOT NULL,
    handPlayedByCPU VARCHAR(10) NOT NULL,
    result VARCHAR(4) NOT NULL
);
