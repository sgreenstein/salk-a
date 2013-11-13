CREATE TABLE blogs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(50),
    content TEXT,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);
