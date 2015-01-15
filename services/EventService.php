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
}