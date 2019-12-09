CREATE TABLE student(
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL DEFAULT '',
	age TINYINT NOT NULL DEFAULT 0,
	sex TINYINT NOT NULL DEFAULT 10,
	created_at INT NOT NULL DEFAULT 0,
	updated_at INT NOT NULL DEFAULT 0
) ENGINE=INNODB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1001;
