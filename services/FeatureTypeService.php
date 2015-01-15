<?php

/* implicit assumption that this class is being loaded by core and has 
 * proper files loaded before hand.
*/

class FeatureTypeService extends StdClass {

	/* Return false on err, new object with id on success */
	public static function createFeatureType(FeatureType $featureType) {
		$database = Database::instance();
		return $database->insert($featureType);
	}

}