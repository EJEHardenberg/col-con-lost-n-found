<?php
$pageTitle = 'Lost Form';
include dirname(__FILE__) . '/shared/header.php';
include dirname(__FILE__) . '/shared/core.php';

/* Get the feature types and features and construct a decent looking form
 * to display a submission form for lost things.
*/
$event_id = 1; //todo: replace with query based arg
$featureTypes = FeatureTypeService::getFeatureTypes($event_id);
?>
	<div class="view-wrap">
		<h1>Lost Form</h1>
		<hr>
		<div>
			<?php
			foreach ($featureTypes as $key => $featureType) {
				include 'shared/featuretypeform.php';
			}
			?>
		</div>
	</div>

</div>