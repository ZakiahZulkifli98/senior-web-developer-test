<?php

require_once __DIR__ . '/handler/is_authenticated.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/components/header.php';

$db = get_db();

$stmt = $db->query("
    SELECT
        guid,
        decided_at,
        version
    FROM consents
    ORDER BY created_at DESC
");

$consents = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>Consent Dashboard</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body class="admin-page">
    <main class="admin-main">
        <div class="admin-container">
            <div class="page-heading">
                <div>
                    <h1>Consent Acceptances</h1>
                    <p>
                        View submitted privacy consent records.
                    </p>
                </div>
                <div class="record-count">
                    <?= count($consents) ?> Records
                </div>
            </div>
            <div class="table-wrapper">
                <table class="consent-table">
                    <thead>
                        <tr>
                            <th>GUID</th>
                            <th>Consent Date & Time</th>
                            <th>Version</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($consents)): ?>
                            <tr>
                                <td colspan="3" class="empty-state">
                                    No consent acceptances found.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($consents as $consent): ?>
                                <tr>
                                    <td class="guid">
                                        <?= htmlspecialchars($consent['guid']) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars(
                                            date('d M Y, g:i A', strtotime($consent['decided_at']))
                                        ) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($consent['version']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>
<?php require_once __DIR__ . '/components/footer.php'; ?>