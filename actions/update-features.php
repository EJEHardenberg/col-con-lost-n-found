<?php
require_once dirname(__FILE__) . '/../shared/core.php';

is_post_action_only('update-features','Invalid method sent to update-features');

if (!isset($_POST['features']) || !is_array($_POST['features'])) {
	send_failure_redirect('update-features');
}

/* Delete first so we don't do unneccesary updates  */
if (isset($_POST['delete']) && is_array($_POST['delete'])) {
	$allDeleted = FeatureService::deleteFeatures($_POST['delete']);
	if (!$allDeleted) {
		send_failure_redirect('update-features');
	}
}

/* Update any features that require updating */
$allUpdated = true;
$features = FeatureService::getFeatures();
$oldFeatures = array();
foreach ($features as $feature) {
	$oldFeatures[$feature->id] = $feature;
}

/* Do Stuff */
foreach ($_POST['features'] as $featureArray) {
	if (!isset($featureArray['id']) || !is_numeric($featureArray['id'])) {
		continue;
	}
	if (!isset($featureArray['feature_type']) || !is_numeric($featureArray['feature_type'])) {
		continue;
	}
	if (!isset($featureArray['name'])) {
		continue;
	}
	$feature = new Feature();
	$feature->id = $featureArray['id'];
	$feature->name = $featureArray['name'];
	$feature->feature_type = $featureArray['feature_type'];

	if (!isset($oldFeatures[$feature->id])) {
		continue;
	}

	$oldFeature = $oldFeatures[$feature->id];
	if ($oldFeature->name != $feature->name 				|| 
		$oldFeature->feature_type != $feature->feature_type ){
		$allUpdated = false !== FeatureService::updateFeature($feature) && $allUpdated;
	}

}

if (!$allUpdated) {
	send_failure_redirect('update-features');
}

send_success_redirect('update-features');