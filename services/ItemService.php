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
	
	public static function getItems() { 
		$database = Database::instance();
		return $database->all(new Item());
	}

	public static function deleteitems(Array $itemIds) {
		$database = Database::instance();
		$allDeleted = true;
		foreach ($itemIds as $id) {
			if (is_numeric($id)) {
				$toDel = new Item();
				$toDel->id = $id;
				$allDeleted = $database->delete($toDel) && $allDeleted;
			}
		}
		return $allDeleted;
	}

	/* T | F */
	public static function updateItem(Item $item) {
		$database = Database::instance();
		return $database->update($item) !== false;
	}

	public static function textSearchForItems($searchTerm) {
		//todo: decide whether or not to do exact or fuzzy search when it comes to spaces and stop words, etc
		$database = Database::instance();
		return $database->custom(
			'SELECT * from items WHERE name LIKE :name or description LIKE :desc',
			array(
				':name' => '%' . $searchTerm . '%',
				':desc' => '%' . $searchTerm . '%'
			)
		);
	}

} 
