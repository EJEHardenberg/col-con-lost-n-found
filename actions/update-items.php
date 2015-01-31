<?php
require_once dirname(__FILE__) . '/../shared/core.php';

is_post_action_only('update-items','Invalid method sent to update-items');

if (!isset($_POST['items']) || !is_array($_POST['items'])) {
	send_failure_redirect('update-items');
}

/* Delete first so we don't do unneccesary updates  */
if (isset($_POST['delete']) && is_array($_POST['delete'])) {
	$allDeleted = ItemService::deleteitems($_POST['delete']);
	if (!$allDeleted) {
		send_failure_redirect('update-items');
	}
}

/* Mark each item found or not found if it has changed */
$items = ItemService::getItems();
$itemsById = array();
foreach ($items as $item) {
	$itemsById[$item->id] = $item;
}

function hasChanged($item, $postedArr) {
	$found = isset($postedArr['is_found']);
	if ($item->is_found != $found) {
		return true;
	}
	return false;
}

$allUpdated = true;
foreach ($_POST['items'] as $itemArr) {
	if (!isset($itemArr['id'])) continue; //skip items without ids
	if (!isset($itemsById[$itemArr['id']])) continue; //skip items that don't exist

	if (hasChanged($itemsById[$itemArr['id']], $itemArr )) {
		$item = $itemsById[$itemArr['id']];
		$item->is_found = isset($itemArr['is_found']) ? '1' : '0';
		$allUpdated = ItemService::updateItem($item) && $allUpdated;
	}
}

if (!$allUpdated) {
	send_failure_redirect('update-items');
}
send_success_redirect('update-items');