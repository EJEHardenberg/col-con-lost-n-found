CREATE TABLE features (
	id INT(20) NOT NULL auto_increment PRIMARY KEY, -- association id for foreign relationships to other tables
	feature_type INT(20) NOT NULL,
	name VARCHAR(256), 
	INDEX (`feature_type`),
	CONSTRAINT FOREIGN KEY (`feature_type`) REFERENCES `featuretypes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE InnoDB;

