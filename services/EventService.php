<?php

/* implicit assumption that this class is being loaded by core and has 
 * proper files loaded before hand.
*/

class EventService extends StdClass {
	
	public static function validateName($eventName) {
		return strlen($eventName) <= 64;
	}

	/* Will return false on failures, object with id on success
	*/
	public static function createEvent($eventName, $enabled) {
		if (!validateName($eventName)) {
			return false;
		}
		$database = Database::instance();
		$event = new Event();
		$event->name = $eventName;
		$event->enabled = $enabled ? '1' : '0';
		$eventWithId = $database->insert($event);

		return $eventWithId;
	}
}