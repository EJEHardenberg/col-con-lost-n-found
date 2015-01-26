<?php



class ItemService extends StdClass {
	
	public static function createItem(Item $item) {
		$database = Database::instance();
		return $database->insert($item);
	}

	/* Return T | F */
	public static function assignFeatureToItem(Feature $feature, Item $item) {
		$database = Database::instance();
		return $database->custom(
			'INSERT INTO item_feature (item_id, feature_id) VALUES (:item_id, :feature_id)', 
			array(
				':item_id' => $item->id,
				':feature_id' => $feature->id
			)
		);
	}

} 