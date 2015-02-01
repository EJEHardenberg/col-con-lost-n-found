<?php
$pageTitle = 'Report Item';
include dirname(__FILE__) . '/shared/core.php';
if (defined('REPORT_ITEM_NO_BAR') && REPORT_ITEM_NO_BAR == true) {
	include dirname(__FILE__) . '/shared/header-no-bar.php';
} else {
	include dirname(__FILE__) . '/shared/header.php';
}
/* Get the feature types and features and construct a decent looking form
 * to display a submission form for lost things.
*/
$event_id = isset($_GET['event_id']) 
	? (is_numeric($_GET['event_id']) 
		? intval($_GET['event_id'])
		: 1
	  ) 
	: 1; //default to 1
$featureTypes = FeatureTypeService::getFeatureTypes($event_id);

?>
	<div class="view-wrap">
		<h1>Report Item</h1>
		<hr>
		<div>
			<form method="POST" action="/actions/report-item.php" class="grid-form" id="report-item">	
				<?php
				conditional_error_success(
					'There was an issue creating the record of the reported item',
					'Successfully submitted a report.',
					'report-item'
				);
				?>	
				<input type="hidden" name="event_id" value="<?php echo $event_id ?>" />
				<h2>Describe what you saw</h2>
				<p>
					By filling out what features the item you're reporting has, we'll 
					be able to better search our database and help it get to the right home.
				</p>
				<fieldset>
					<legend>General</legend>
					<div data-row-span="3">
						<div data-field-span="2">
							<label>Name of item</label>
							<input type="text" name="name"> 
						</div>
						<div data-field-span="1">
							<label>Found
								<input type="checkbox" name="is_found" value="true" />
							</label>
						</div>
					</div>
					<div data-row-span="1">
						<div data-field-span="1">
							<label>Description</label>
							<textarea name="description"></textarea>
						</div>
					</div>
				</fieldset>
				<?php
				foreach ($featureTypes as $key => $featureType) {
					$features = FeatureService::getFeatures($featureType->id);
					include 'shared/featuretypeform.php';
				}
				?>
				<input type="submit" class="button-green button-bigger">
			</form>
		</div>
	</div>

</div>
<link rel="stylesheet" type="text/css" href="flakes/bower_components/gridforms/gridforms/gridforms.css">
<?php 
/* If we are in no sidebar mode, then widen the content area */
if (REPORT_ITEM_NO_BAR) : ?>
	<style>
		.flakes-frame .flakes-content {
			width: 100%;
		}
	</style>
<?php endif; ?>
