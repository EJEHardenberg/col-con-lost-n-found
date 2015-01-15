<?php
require_once dirname(__FILE__) . '/../shared/core.php';

is_post_action_only('create-feature','Invalid method sent to create-feature');

if( !isset($_POST['name']) || empty($_POST['name'])) {
	send_failure_redirect('create-feature');
}

if( !isset($_POST['feature_type']) || !is_numeric($_POST['feature_type'])) {
	send_failure_redirect('create-feature');
}

$feature = new Feature();
$feature->name = $_POST['name'];
$feature->feature_type = intval($_POST['feature_type']);

$featureCreated = FeatureService::createFeature($feature);

if ($featureCreated === false) {
	send_failure_redirect('create-feature');
}

send_success_redirect('create-feature');