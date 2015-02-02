<?php

/* implicit assumption that this class is being loaded by core and has 
 * proper files loaded before hand.
*/

class EventService extends StdClass {

	public static function validateName($eventName) {
		return strlen($eventName) <= 64;
	}

	/* Will return false on failures, object with id on success */
	public static function createEvent($eventName, $enabled) {
		$database = Database::instance();
		if (!self::validateName($eventName)) {
			return false;
		}
		$event = new Event();
		$event->name = $eventName;
		$event->enabled = $enabled ? '1' : '0';
		$eventWithId = $database->insert($event);

		return $eventWithId;
	}

	/* Will return an array of events from the database */
	public static function getEvents($enabled = null) {
		$database = Database::instance();
		if (is_null($enabled)) {
			return $database->all(new Event());
		}
		return $database->where(new Event(), 'enabled', $enabled === false ? '0' : '1' );
	}

	/* Returns true if all were deleted, false otherwise */
	public static function deleteEvents(Array $arrayOfIds) {
		$database = Database::instance();
		$allDeleted = true;
		foreach ($arrayOfIds as $id) {
			if (is_numeric($id)) {
				$toDel = new Event();
				$toDel->id = $id;
				$allDeleted = $database->delete($toDel) && $allDeleted;
			}
		}
		return $allDeleted;
	}

	/* For validating input from $_POST */
	public static function validateEventArray(Array $eventArray) {
		if (!isset($eventArray['id']) || !isset($eventArray['name'])) {
			return false;
		}

		if (!is_numeric($eventArray['id']) || empty($eventArray['name']) || strlen($eventArray['name']) > 64){
			return false;
		}

		if (isset($eventArray['enabled']) && !$eventArray['enabled'] == 'true') {
			return false;
		}
		return true;
	}

	public static function updateEvent(Event $event) {
		$database = Database::instance();
		return $database->update($event);
	}

	/* T | F */
	public static function eventExists($id) { 
		$database = Database::instance();
		$event = new Event();
		$event->id = $id;
		return $database->get($event) !== false;
	}
}