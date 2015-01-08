CREATE TABLE features (
	id INT(20) NOT NULL auto_increment PRIMARY KEY, -- association id for foreign relationships to other tables
	event_id INT(20) NOT NULL,
	feature_type INT(20) NOT NULL,
	name VARCHAR(256), 
	INDEX (`event_id`),
	INDEX (`feature_type`),
	CONSTRAINT FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY (`feature_type`) REFERENCES `featuretypes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE InnoDB;

