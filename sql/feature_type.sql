CREATE TABLE featuretypes (
	id INT(20) NOT NULL auto_increment PRIMARY KEY, -- association id for foreign relationships to other tables
	event_id INT(20) NOT NULL,
	name VARCHAR(64), 
	is_multi TINYINT(1), 
	is_dropdown TINYINT(1), 
	INDEX (`event_id`),
	CONSTRAINT FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE InnoDB;

