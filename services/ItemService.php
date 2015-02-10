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
			'SELECT * FROM items WHERE name LIKE :name or description LIKE :desc',
			array(
				':name' => '%' . $searchTerm . '%',
				':desc' => '%' . $searchTerm . '%'
			)
		);
	}

	public static function itemsByFeatureIds(Array $ids) {
		$database = Database::instance();
		return $database-> custom(
			'SELECT i.* FROM items i LEFT JOIN item_feature ifs ON ifs.item_id = i.id WHERE ifs.feature_id IN (:ids)',
			array(
				':ids' => implode($ids,',')
			)
		);
	}

	public static function getItemById($itemId) {
		$database = Database::instance();
		$item = new Item();
		$item->id = $itemId;
		return $database->get($item);
	}

	public static function getFeaturesOfItem(Item $item) {
		$database = Database::instance();
		$features = $database->custom(
			'SELECT f.* FROM features f JOIN item_feature ifs ON f.id = ifs.feature_id WHERE ifs.item_id = :itemId',
			array(
				':itemId' => $item->getId()
			)
		);
		/* Translate the arrays into a Class */
		if ($features === false) {
			logMessage('Could not retrieve features for [Item: ' .$item->getId() .']' ,LOG_LVL_WARN);
			return array();
		}

		$featuresList = array();
		foreach ($features as $featureArr) {
			$feature = new Feature();
			$feature->id = $featureArr->id;
			$feature->name = $featureArr->name;
			$feature->feature_type = $featureArr->feature_type;
			$featuresList[] = $feature;
		}

		return $featuresList;
		
	}

} 
