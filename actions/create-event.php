<?php
require_once dirname(__FILE__) . '/../shared/core.php';

is_post_action_only('create-event','Invalid method sent to create-event');

//todo: write service to create the event and create validations

if( !isset($_POST['name'])) {
	send_failure_redirect('create-event');
}

//keep going here later. todo
$newEvent = EventService::createEvent(name,enabled);

if( get_class($newEvent) != 'Event' ) {
	send_failure_redirect('create-event');
}

send_success_redirect('create-event');