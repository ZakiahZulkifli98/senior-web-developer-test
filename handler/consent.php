<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/consent.php';

header('Content-Type: application/json');

function response(bool $success, string $message = ''): void
{
    echo json_encode([
        'success' => $success,
        'message' => $message
    ]);

    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    response(
        false,
        'Invalid request method.'
    );
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!is_array($data)) {
    http_response_code(400);
    response(
        false,
        'Invalid request data.'
    );
}

$action = $data['action'] ?? '';

if (!in_array($action, ['accept', 'decline'], true)) {
    http_response_code(400);
    response(
        false,
        'Invalid consent action.'
    );
}

if ($action === 'accept') {

    try {
        $guid = sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0x0fff) | 0x4000,
            random_int(0, 0x3fff) | 0x8000,
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff)
        );
    } catch (Throwable $e) {
        http_response_code(500);
        response(
            false,
            'Unable to generate consent identifier. Please try again.'
        );
    }

    $consentDatetime = date('Y-m-d H:i:s');
    $version = CONSENT_VERSION;

    try {
        $db = get_db();
        $stmt = $db->prepare("
            INSERT INTO consents (
                guid,
                decided_at,
                consent_version
            )
            VALUES (
                :guid,
                :decided_at,
                :consent_version
            )
        ");

        $stmt->execute([
            ':guid' => $guid,
            ':decided_at' => $consentDatetime,
            ':consent_version' => $version
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        response(
            false,
            'Unable to save your consent. Please try again.'
        );
    }

    $cookieData = json_encode([
        'guid' => $guid,
        'consent_datetime' => $consentDatetime,
        'version' => $version
    ]);

    $cookieCreated = setcookie(
        'privacy_consent',
        $cookieData,
        [
            'expires' => time() + (365 * 24 * 60 * 60),
            'path' => '/',
            'secure' => !empty($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Lax'
        ]
    );

    if (!$cookieCreated) {
        http_response_code(500);
        response(
            false,
            'Unable to save consent. Please try again.'
        );
    }

    response(
        true,
        'Consent accepted successfully.'
    );
}

if ($action === 'decline') {
    $cookieCreated = setcookie(
        'privacy_declined',
        date('Y-m-d H:i:s'),
        [
            'expires' => time() + (24 * 60 * 60),
            'path' => '/',
            'secure' => !empty($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Lax'
        ]
    );

    if (!$cookieCreated) {
        http_response_code(500);
        response(
            false,
            'Unable to save your preference. Please try again.'
        );
    }

    response(
        true,
        'Consent declined successfully.'
    );
}
