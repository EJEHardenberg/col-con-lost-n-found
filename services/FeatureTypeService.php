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

	/* If passed nothing, returns ALL feature types, if passed an event
	 * id then only the feature types for that event will be given
	*/
	public static function getFeatureTypes($event_id = null) {
		$database = Database::instance();
		if (is_null($event_id)) {
			return $database->all(new FeatureType());
		}
		return $database->where(new FeatureType(), 'event_id', $event_id);
	}

	/* Returns true if all were deleted, false otherwise */
	public static function deleteFeatureTypes(Array $arrayOfIds) {
		$database = Database::instance();
		$allDeleted = true;
		foreach ($arrayOfIds as $id) {
			if (is_numeric($id)) {
				$toDel = new FeatureType();
				$toDel->id = $id;
				$allDeleted = $database->delete($toDel) && $allDeleted;
			}
		}
		return $allDeleted;
	}

	/* For validating input from $_POST */
	public static function validateFeatureTypeArray(Array $eventArray) {
		if (!isset($eventArray['id']) 		|| 
			!isset($eventArray['name']) 	|| 
			!isset($eventArray['is_']) 		|| 
			!isset($eventArray['event_id']) ){
			return false;
		}

		if (!is_numeric($eventArray['id']) 			||  
			!is_numeric($eventArray['event_id']) 	|| 
			empty($eventArray['name']) 				|| 
			strlen($eventArray['name']) > 64		){
			return false;
		}

		if (!in_array($eventArray['is_'], array('multi','dropdown'))) {
			return false;
		}

		return true;
	}

	public static function updateFeature(FeatureType $featureType) {
		$database = Database::instance();
		return $database->update($featureType);
	}

}