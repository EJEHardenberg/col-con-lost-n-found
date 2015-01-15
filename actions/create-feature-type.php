<?php
require_once dirname(__FILE__) . '/../shared/core.php';


is_post_action_only('create-feature-type','Invalid method sent to create-feature-type');

if( !isset($_POST['name']) || empty($_POST['name'])) {
	send_failure_redirect('create-feature-type');
}

if( !isset($_POST['is_']) || !in_array($_POST['is_'], array('multi','dropdown'))) {
	send_failure_redirect('create-feature-type');
}

if( !isset($_POST['event_id']) || !is_numeric($_POST['event_id'])) {
	send_failure_redirect('create-feature-type');
}

$featureType = new FeatureType();

$featureType->name = $_POST['name'];
$featureType->event_id = intval($_POST['event_id']);
$featureType->is_multi = $_POST['is_'] == 'multi';
$featureType->is_dropdown = $_POST['is_'] == 'dropdown';

//continue here todo