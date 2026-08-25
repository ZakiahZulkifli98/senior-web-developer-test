<?php

$pageTitle = 'Privacy Policy';

$policyData = json_decode(
    file_get_contents(__DIR__ . '/../data/privacy.json'),
    true
);

require_once __DIR__ . '/../components/header.php';

?>

<section class="page-section">
    <div class="container">

        <h1><?= htmlspecialchars($policyData['title']) ?></h1>

        <p>
            <?= htmlspecialchars($policyData['description']) ?>
        </p>

        <?php foreach ($policyData['privacy'] as $section): ?>

            <h2>
                <?= htmlspecialchars($section['title']) ?>
            </h2>

            <?php if (is_array($section['description'])): ?>

                <?php foreach ($section['description'] as $paragraph): ?>
                    <p><?= htmlspecialchars($paragraph) ?></p>
                <?php endforeach; ?>

            <?php else: ?>

                <p><?= htmlspecialchars($section['description']) ?></p>

            <?php endif; ?>

        <?php endforeach; ?>

    </div>
</section>

<?php require_once __DIR__ . '/../components/footer.php'; ?>