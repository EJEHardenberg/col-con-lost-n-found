CREATE TABLE item (
	id INT(20) NOT NULL auto_increment PRIMARY KEY, -- association id for foreign relationships to other tables
	event_id INT(20) NOT NULL,
	name VARCHAR(64), 
	is_found TINYINT(1), 
	submitted_time TIMESTAMP, 
	INDEX (`event_id`),
	CONSTRAINT FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE InnoDB;

