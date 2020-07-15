<?php

function createPdo(): PDO {
    return new PDO("mysql:host=database_host;dbname=distributed_worker", 'distributed_worker', 'secret');
}

function fetchRow(PDO $pdo): ?array {
    $sql = <<<SQL
SELECT `id`, `url` 
FROM `sites`
WHERE `status` = 'NEW'
ORDER BY `id`
LIMIT 1
FOR UPDATE SKIP LOCKED;
SQL;

    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC) ?: null;
}

function fetchRowById(PDO $pdo, int $id): ?array {
    $sql = "SELECT * FROM `sites` WHERE `id` = $id";
    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC) ?: null;
}

