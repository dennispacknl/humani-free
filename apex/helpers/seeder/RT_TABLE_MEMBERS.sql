-- Table t_members of database myapp_db

CREATE TABLE t_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_sid VARCHAR(50) DEFAULT NULL,
    member_id VARCHAR(50) DEFAULT NULL,
    m_auth_token VARCHAR(255) DEFAULT NULL,
    m_email VARCHAR(50) NOT NULL UNIQUE,
    m_password VARCHAR(255) NOT NULL,
    m_fname VARCHAR(50) DEFAULT NULL,
    m_lname VARCHAR(50) DEFAULT NULL,
    m_phone VARCHAR(20) DEFAULT NULL,
    m_pfp VARCHAR(255) DEFAULT NULL,
    m_flags VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);
