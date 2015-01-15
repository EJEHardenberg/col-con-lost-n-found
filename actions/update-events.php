<?php
require_once dirname(__FILE__) . '/../shared/core.php';

is_post_action_only('update-events','Invalid method sent to update-events');

if (!isset($_POST['events']) || !is_array($_POST['events'])) {
	send_failure_redirect('update-events');
}

/* Delete first so we don't do unneccesary updates  */
if (isset($_POST['delete']) && is_array($_POST['delete'])) {
	$allDeleted = EventService::deleteEvents($_POST['delete']);
	if (!$allDeleted) {
		send_failure_redirect('update-events');
	}
}

/* Now perform the updates on each passed event that has changed */
$allUpdated = true;
$events = EventService::getEvents();
$eventsById = array();
foreach ($events as $event) {
	$eventsById[$event->id] = $event;
}

function eventsChanged($a, $b) {
	return $a->name != $b->name || $a->enabled != $b->enabled;
}

foreach($_POST['events'] as $eventArray) {
	if (EventService::validateEventArray($eventArray)) {
		$event = new Event();
		$event->id = intval($eventArray['id']);
		$event->name = $eventArray['name'];
		$event->enabled = isset($eventArray['enabled']) ? '1' : '0';

		/* Check if there's been a change for an event we know about */
		if (isset($eventsById[$event->id]) && eventsChanged($event, $eventsById[$event->id])) {
			$allUpdated = false !== EventService::updateEvent($event) && $allUpdated;	
		}		
	}
} 

if (!$allUpdated) {
	send_failure_redirect('update-events');
}

send_success_redirect('update-events');