<?php

function emptyDb(PDO $pdo) {
    $pdo->exec('TRUNCATE TABLE `sites`;');
}

function populateData(PDO $pdo) {

    $sql = "INSERT INTO `sites` (`url`, `status`, `http_code`) VALUES (:url, 'NEW', NULL);";
    $stmt = $pdo->prepare($sql);

    for ($i = 1; $i <= 100; $i++) {
        $stmt->execute(['url' => sprintf("url%d.com", $i)]);
    }
}