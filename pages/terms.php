<?php

$pageTitle = 'Terms & Conditions';

$termData = json_decode(
    file_get_contents(__DIR__ . '/../data/terms.json'),
    true
);

require_once __DIR__ . '/../components/header.php';

?>

<section class="page-section">
    <div class="container">

        <h1><?= htmlspecialchars($termData['title']) ?></h1>

        <p>
            <?= htmlspecialchars($termData['description']) ?>
        </p>

        <?php foreach ($termData['terms'] as $section): ?>

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