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
			<form method="POST" action="/actions/report-item.php" class="grid-form" id="report-lost">	
				<?php
				conditional_error_success(
					'There was an issue creating the record of the lost item',
					'Successfully submitted a lost item.',
					'report-lost'
				);
				?>	
				<input type="hidden" name="is_found" value="false" />
				<input type="hidden" name="event_id" value="<?php echo $event_id ?>" />
				<h2>Describe what you saw</h2>
				<p>
					By filling out what features the item you lost has, we'll 
					be able to better search our database and help you find it!
				</p>
				<fieldset>
					<legend>General</legend>
					<div data-row-span="1">
						<div data-field-span="1">
							<label>Name of item</label>
							<input type="text" name="name"> 
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