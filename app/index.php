<?php
// TODO: delete
$pdo = new PDO("mysql:host=database_host;dbname=distributed_worker", 'distributed_worker', 'namornik');

$pdo->beginTransaction();

$sql = <<<SQL
SELECT `id`, `url` 
FROM `sites`
WHERE `status` = 'NEW'
ORDER BY `id`
LIMIT 1
FOR UPDATE SKIP LOCKED;
SQL;
$row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
var_dump($row['id']);

$sql = <<<SQL
UPDATE `sites`
SET `status` = 'PROCESSING'
WHERE `id` = ?;
SQL;
$stmt = $pdo->prepare($sql);
$stmt->execute([$row['id']]);

$pdo->commit();

$sql = <<<SQL
UPDATE sites
SET `status` = 'DONE', `http_code` = 200
WHERE `id` = ? 
SQL;
$stmt = $pdo->prepare($sql);
$stmt->execute([$row['id']]);

exit;