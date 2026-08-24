<?php

$pageTitle = 'Home';

require_once __DIR__ . '/components/header.php';

?>

<section class="hero">
    <div class="container">
        <h1>Welcome to Our Website</h1>

        <p>
            Discover more about our company, services and
            how we protect your privacy.
        </p>

        <a href="/pages/about_us.php" class="btn">
            Learn More
        </a>
    </div>
</section>

<section class="overview">
    <div class="container">
        <h2>Website Overview</h2>

        <p>
            This website demonstrates a responsive web experience
            with privacy and cookie consent management.
        </p>
    </div>
</section>

<?php require_once __DIR__ . '/components/footer.php'; ?>