DROP TABLE campers;
CREATE TABLE campers (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT UNSIGNED NOT NULL,
	insurance_card_id INT UNSIGNED DEFAULT NULL,
	birth_date DATE NOT NULL,
	background_check BOOLEAN DEFAULT FALSE,
	shirt_size ENUM('S', 'M', 'L', 'XL', '2XL', '3XL', '4XL') NOT NULL,
	camp_choice_1 INT UNSIGNED NOT NULL,
	camp_choice_2 INT UNSIGNED NOT NULL,
	camp_assignment INT UNSIGNED,
	site_assignment INT UNSIGNED,
	paid BOOLEAN DEFAULT FALSE,
	application_complete BOOLEAN DEFAULT FALSE,
	accepted BOOLEAN DEFAULT FALSE,
	address_1 VARCHAR(40) NOT NULL,
	address_2 VARCHAR(40),
	city VARCHAR(30) NOT NULL,
	state CHAR(2) NOT NULL,
	zip CHAR(5) NOT NULL,
	email VARCHAR(100) NOT NULL,
	phone CHAR(10) NOT NULL,
	cell_phone CHAR(10) NOT NULL,
	church VARCHAR(40) NOT NULL,
	district VARCHAR(30) NOT NULL
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
);
