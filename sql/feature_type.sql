CREATE TABLE feature_type (
	id INT(20) NOT NULL auto_increment PRIMARY KEY, -- association id for foreign relationships to other tables
	event_id INT(20) NOT NULL,
	name VARCHAR(64), 
	is_multi TINYINT(1), 
	is_dropdown TIMESTAMP, 
	INDEX (`event_id`),
	CONSTRAINT FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE InnoDB;

