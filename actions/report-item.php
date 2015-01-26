<?php
require_once dirname(__FILE__) . '/../shared/core.php';

is_post_action_only('report-item-lost','Invalid method sent to report-item-lost');

if (!isset($_POST['event_id']) || !is_numeric($_POST['event_id'])) {
	send_failure_redirect('report-item-lost');
}

if (!isset($_POST['name']) || empty($_POST['name'])) {
	send_failure_redirect('report-item-lost');
}

if (!isset($_POST['features']) || !is_array($_POST['features']) || count($_POST['features']) == 0) {
	send_failure_redirect('report-item-lost');
}

$event_id =  intval($_POST['event_id']);
$name = $_POST['name'];
$description = $_POST['description'];
$is_found = isset($_POST['is_found']) ? false : ($_POST['is_found'] == 'true');

//make item then link all features to it
$item = new Item();
$item->event_id = $event_id;
$item->name = $name;
$item->description = htmlentities($_POST['description']);
$item->is_found = $is_found;
$item->submitted_time = date('c');

$madeItem = ItemService::createItem($item);
if ($madeItem === false) {
	send_failure_redirect('report-item-lost');
}

$allSuccess = true;
foreach ($_POST['features'] as $feature_id) {
	if (is_numeric($feature_id)) {
		$feature = new Feature();
		$feature->id = $feature_id;
		$linked = ItemService::assignFeatureToItem($feature, $madeItem);	
		$allSuccess = $linked && $allSuccess;
	}
}

if ($allSuccess) {
	send_success_redirect('report-item-lost');
}
send_failure_redirect('report-item-lost');