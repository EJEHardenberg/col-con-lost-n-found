<?php

class FeatureService extends StdClass {

	/* returns false if fails, object is success */
	public static function createFeature(Feature $feature) {
		$database = Database::instance();
		return $database->insert($feature);
	}

	/* returns list of features, if featureType given list will be 
	 * constrained to only features of that type.
	*/
	public static function getFeatures($featureType = null) {
		$database = Database::instance();
		if (is_null($featureType)) {
			return $database->all(new Feature());
		}
		return is_numeric($featureType) ? $database->where(new Feature(), 'feature_type', $featureType) : array();
	}

	public static function deleteFeatures(Array $featureIds) {
		$database = Database::instance();
		$allDeleted = true;
		foreach ($featureIds as $id) {
			if (is_numeric($id)) {
				$toDel = new Feature();
				$toDel->id = $id;
				$allDeleted = $database->delete($toDel) && $allDeleted;
			}
		}
		return $allDeleted;
	}

	public static function updateFeature(Feature $feature) {
		$database = Database::instance();
		return $database->update($feature);
	}

}