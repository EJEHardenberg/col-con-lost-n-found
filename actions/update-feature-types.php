<?php
require_once dirname(__FILE__) . '/../shared/core.php';

is_post_action_only('update-feature-types','Invalid method sent to update-feature-types');

if (!isset($_POST['featureTypes']) || !is_array($_POST['featureTypes'])) {
	send_failure_redirect('update-feature-types');
}

/* Delete deletables */
if (isset($_POST['delete']) && is_array($_POST['delete'])) {
	$allDeleted = FeatureTypeService::deleteFeatureTypes($_POST['delete']);
	if (!$allDeleted) {
		send_failure_redirect('update-feature-types');
	}
}

/* Update featureTypes that have been changed */
$featureTypes = FeatureTypeService::getFeatureTypes();
$featureTypesById = array();
foreach ($featureTypes as $type) {
	$featureTypesById[$type->id] = $type;
}

$allUpdated = true;
foreach ($_POST['featureTypes'] as $featureTypeArray) {
	if (FeatureTypeService::validateFeatureTypeArray($featureTypeArray)) {
		if (!isset($featureTypesById[$featureTypeArray['id']])) {
			continue;
		}
		$featureType = new FeatureType();
		$featureType->id = $featureTypeArray['id'];
		$featureType->event_id = $featureTypeArray['event_id'];
		$featureType->name = $featureTypeArray['name'];
		$featureType->is_multi = $featureTypeArray['is_'] == 'multi';
		$featureType->is_dropdown = $featureTypeArray['is_'] == 'dropdown';

		$old = $featureTypesById[$featureTypeArray['id']];

		if ($featureType->event_id != $old->event_id  		||
			$featureType->name != $old->name 				||
			$featureType->is_multi != $old->is_multi		||
			$featureType->is_dropdown != $old->is_dropdown 	){
			$allUpdated = false !== FeatureTypeService::updateFeature($featureType) && $allUpdated;
		}
	}
}


if (!$allUpdated) {
	send_failure_redirect('update-feature-types');
}

send_success_redirect('update-feature-types');