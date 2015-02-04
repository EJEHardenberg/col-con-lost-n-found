<?php

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
	header('Location: /inventory.php');
	exit();
}

$itemId = intval($_GET['id']);

include dirname(__FILE__) . '/shared/core.php';
include dirname(__FILE__) . '/shared/header.php';

$item = ItemService::getItemById($itemId);

if ($item === false) {
	header("HTTP/1.0 404 Not Found");
	die('That Item does not exist');
}

/* Sort features by type for displaying */
$itemFeatures = ItemService::getFeaturesOfItem($item);
function sortFeaturesByFeatureType($a, $b) {
	return 	$a->feature_type == $b->feature_type ? 
			0 : 
			$a->feature_type < $b->feature_type ? -1 : 1;
}
usort($itemFeatures, 'sortFeaturesByFeatureType');

/* Get names for feature Types and index by id */
$featureTypes = FeatureTypeService::getFeatureTypes();
if ($featureTypes === false) {
	internal_error();
}
$featureTypeNames = array();
foreach ($featureTypes as $featureType) {
	$featureTypeNames[$featureType->id] = $featureType->name;
}

/* Partition itemFeatures into Sets by F. Type */
$partionedFeatures = array();
foreach ($itemFeatures as $feature) {
	if (!isset($partionedFeatures[$feature->feature_type])) {
		$partionedFeatures[$feature->feature_type] = array();
	}
	$partionedFeatures[$feature->feature_type][] = $feature;
}

$event = EventService::getEventByItem($item->event_id);

if ($event === false) {
	$event = new StdClass();
	$event->name = 'Unknown';
}

?>
			<div class="view-wrap">
				<h1>Item <?php echo $item->id ?>: <?php echo $item->name ?></h1>
				<h2>General</h2>
				<small><?php echo $item->is_found ? 'Found' : 'Lost' ?> at event: <?php echo $event->name ?></small><br/>
				<small>Reported on <?php echo date('m/d/Y', strtotime($item->submitted_time)) ?></small>
				<p>
					<?php echo htmlentities($item->description) ?>
				</p>
				<h2>Features</h2>
				<div class="grid-3 gutter-40">
					<?php $i = 0; ?>
					<?php foreach($partionedFeatures as $featureList): ?>
						<?php 
							$featureTypeName = $featureTypeNames[$featureList[0]->feature_type];
						?>
						<div class="span-1">
							<h3><?php echo $featureTypeName ?></h3>
							<ul>
								<?php foreach ($featureList as $feature) {
									echo '<li>' . $feature->name . '</li>';
								} ?>
							</ul>
						</div>
						<?php $i++; if ($i % 3 == 0): ?>
							</div>
							<div class="grid-3 gutter-40">
						<?php endif ?>
					<?php endforeach ?>
				</div>
			</div>