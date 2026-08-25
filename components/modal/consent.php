<?php

if (
    isset($_COOKIE['privacy_consent']) ||
    isset($_COOKIE['privacy_declined'])
) {
    return;
}

?>
<div class="consent-overlay">
    <div class="consent-modal">
        <h2>Privacy & Cookie Consent</h2>
        <p>
            Cookies are necessary for this website to function properly,
            for performance measurement, and to provide you with the best experience.
        </p>
        <p>
            By continuing to access or use this site, you acknowledge and consent
            to our use of cookies in accordance with our
            <a href="/data/terms.json"
                class="policy-link"
                data-policy="terms">
                Terms &amp; Conditions
            </a>
            and
            <a href="/data/privacy.json"
                class="policy-link"
                data-policy="privacy">
                Privacy Statement
            </a>.
        </p>
        <div class="consent-actions">
            <button type="button" class="consent-button consent-decline">
                Decline
            </button>
            <button type="button" class="consent-button consent-accept">
                Accept
            </button>
        </div>
    </div>
</div>

<?php include __DIR__ . '/policy.php'; ?>