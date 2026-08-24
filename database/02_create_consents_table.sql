USE consent_site;

CREATE TABLE IF NOT EXISTS consents (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    guid            CHAR(36)        NOT NULL,
    decision        ENUM('accepted', 'declined') NOT NULL,
    consent_version INT UNSIGNED    NOT NULL DEFAULT 1,
    decided_at      DATETIME        NOT NULL,
    ip_address      VARCHAR(45)     NULL,
    user_agent      VARCHAR(255)    NULL,
    created_at      TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP
);