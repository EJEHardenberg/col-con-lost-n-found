<?php
require_once dirname(__FILE__) . '/../shared/core.php';

is_post_action_only('create-event','Invalid method sent to create-event');

if( !isset($_POST['name']) || empty($_POST['name'])) {
	send_failure_redirect('create-event');
}

$enabled = isset($_POST['enabled']) ? 
	($_POST['enabled'] == 'true' ? true : null ) 
	: false;

if (is_null($enabled)) {
	send_failure_redirect('create-event');
}

$name = $_POST['name'];
$newEvent = EventService::createEvent($name,$enabled);

if( $newEvent === false || get_class($newEvent) != 'Event' ) {
	send_failure_redirect('create-event');
}

send_success_redirect('create-event');