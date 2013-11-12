CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    password VARCHAR(100),
    level INTEGER(20),
    profile_picture VARCHAR(200),
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);