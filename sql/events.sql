CREATE TABLE events (
	id INT(20) NOT NULL auto_increment PRIMARY KEY, -- association id for foreign relationships to other tables
	name CHAR(64) UNIQUE,
	enabled TINYINT(1)
) ENGINE InnoDB;