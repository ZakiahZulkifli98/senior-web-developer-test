</main>

<footer class="site-footer">
    <p>
        &copy; <?= date('Y') ?> Website. All rights reserved.
    </p>

    <div class="footer-links">
        <a href="/pages/privacy_policy.php">Privacy Policy</a>
        <a href="/pages/terms.php">Terms & Conditions</a>
    </div>
</footer>

<?php require_once __DIR__ . '/modal/consent.php'; ?>

<script src="/handler/navigation.js"></script>
<script src="/handler/consent.js"></script>

</body>

</html>