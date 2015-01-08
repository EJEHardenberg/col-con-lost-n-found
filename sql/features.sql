CREATE TABLE feature (
	id INT(20) NOT NULL auto_increment PRIMARY KEY, -- association id for foreign relationships to other tables
	event_id INT(20) NOT NULL,
	feature_type INT(20) NOT NULL,
	item_id INT(20) NOT NULL,
	name VARCHAR(64), 
	INDEX (`event_id`),
	INDEX (`feature_type`),
	INDEX (`item_id`),
	CONSTRAINT FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY (`feature_type`) REFERENCES `feature_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY (`item`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE InnoDB;

