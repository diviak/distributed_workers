<?php

function toStatusAndCode(PDO $pdo, int $id, string $status, string $code = null) {
    $stmt = $pdo->prepare("UPDATE `sites` SET `status` = :status, `http_code` = :code WHERE `id` = :id;");
    $stmt->execute(['id' => $id, 'status' => $status, 'code' => $code]);
}

function toProcessing(PDO $pdo, int $id) {
    toStatusAndCode($pdo, $id, 'PROCESSING');
}

function toDone(PDO $pdo, int $id, int $code) {
    toStatusAndCode($pdo, $id, 'DONE', $code);
}

function toError(PDO $pdo, int $id, int $code) {
    toStatusAndCode($pdo, $id, 'ERROR', $code);
}

function getHttpCode(string $url): int {
    // curl_getinfo() or get_headers() can be used
    sleep(1);
    return 200;
}

function executeJob(PDO $pdo): ?array {

    $pdo->beginTransaction();

    if ($row = fetchRow($pdo)) {
        $id = $row['id'];

        sleep(1); // mock delay in processing

        toProcessing($pdo, $id);
        $pdo->commit();

        $httpCode = getHttpCode($row['url']);

        $row = fetchRowById($pdo, $id);
        if ($row['status'] !== 'PROCESSING') {
            throw new LogicException(sprintf('Invalid status for row `%d`', $id));
        }

        ($httpCode === 200)
            ? toDone($pdo, $row['id'], $httpCode)
            : toError($pdo, $row['id'], $httpCode);

        return $row;
    }

    return null;
}