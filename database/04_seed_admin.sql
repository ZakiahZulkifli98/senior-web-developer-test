USE consent_site;

-- Default admin login (for testing only):
-- Username: admin@zakiah
-- Password: ChangeMe123!
-- (The password above is converted to the bcrypt hash below before storage —
--  the database does NOT store the real password, only the hashed form.)

INSERT INTO admins (username, password)
VALUES ('admin@zakiah', '$2y$10$ZseFAUVSMk2z7yg3CWl2q.nuyRuTXMN1FMcJtICx.jdXH.zHqDHxi');