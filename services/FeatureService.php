<?php

class FeatureService extends StdClass {

	/* returns false if fails, object is success */
	public static function createFeature(Feature $feature) {
		$database = Database::instance();
		return $database->insert($feature);
	}

}