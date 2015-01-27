<?php
$pageTitle = 'Manage Criteria';
include dirname(__FILE__) . '/shared/header.php';
include dirname(__FILE__) . '/shared/core.php';

$events = EventService::getEvents();
if ($events === false) {
	internal_error();
}
$eventNames = array();
foreach ($events as $event) {
	$eventNames[$event->id] = $event->name;
}

$featureTypes = FeatureTypeService::getFeatureTypes();
if ($featureTypes === false) {
	internal_error();
}

$featureTypeNames = array();
foreach ($featureTypes as $featureType) {
	$featureTypeNames[$featureType->id] = $featureType->name;
}

$features = FeatureService::getFeatures();
function sortFeaturesByFeatureType($a, $b) {
	return 	$a->feature_type == $b->feature_type ? 
			0 : 
			$a->feature_type < $b->feature_type ? -1 : 1;
}
usort($features, 'sortFeaturesByFeatureType');

?>
	<div class="view-wrap">
		<h1>Manage Criteria</h1>
		<hr>
		<h2>Create</h2>
		<div class="grid-3 gutter-40">
			<div class="span-1">
				<div>
					<form id="create-event" class="grid-form" method="post" action="/actions/create-event.php">
						<fieldset>
							<?php
							conditional_error_success(
								'There was an issue creating the event',
								'Successfully created an event.',
								'event'
							);
							?>
							<legend>Event</legend>
							<div data-row-span="1">
								<div data-field-span="1">
									<label>Name</label>
									<input name="name" type="text">
								</div>
							</div>
							<div data-row-span="1">
								<div data-field-span="1">
									<label>Enabled
										<input type="checkbox" checked name="enabled" value="true">
									</label>
								</div>
							</div>
							<input type="submit" value="Create" class="button-green bigger">
						</fieldset>
					</form>
				</div>
			</div>
			<div class="span-1">
				<div>
					<form class="grid-form" method="post" action="/actions/create-feature-type.php">
						<fieldset>
							<?php
							conditional_error_success(
								'There was an issue creating the feature type',
								'Successfully created a feature type.',
								'feature-type'
							);
							?>
							<legend>Feature Type</legend>
							<div data-row-span="1">
								<div data-field-span="1">
									<label>Event</label>
									<select name="event_id">
										<?php foreach ($events as $event) : ?>
											<option value="<?php echo $event->id ?>"><?php echo htmlentities($event->name); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div data-row-span="2">
								<div data-field-span="1">
									<label>Name</label>
									<input name="name" type="text">
								</div>
								<div data-field-span="1">
									<label>
										<input type="radio" checked name="is_" value="multi">Multiple Choice
									</label>
									<label>
										<input type="radio" name="is_" value="dropdown">Dropdown Option
									</label>
								</div>
							</div>
							<input type="submit" class="button-green bigger" value="Create" />
						</fieldset>
						
					</form>
				</div>
			</div>
			<div class="span-1">
				<form class="grid-form" method="post" action="/actions/create-feature.php">
						<fieldset>
							<?php
							conditional_error_success(
								'There was an issue creating the feature',
								'Successfully created a feature.',
								'create-feature'
							);
							?>
							<legend>Feature</legend>
							<div data-row-span="2">
								<div data-field-span="1">
									<label>Type</label>
									<select name="feature_type">
										<?php foreach ($featureTypes as $type): ?>
											<option value="<?php echo $type->id ?>"><?php echo $type->name ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div data-field-span="1">
									<label>Name</label>
									<input name="name" type="text">
								</div>
							</div>
							<input type="submit" class="button-green bigger" value="Create" />
						</fieldset>
						
					</form>
		</div>
		<hr>
		<h2>Update and Delete</h2>
		<p class="flakes-message information">
			To delete an event,feature type, or feature check the leftmost column
		</p>
		<div class="grid-3 gutter-40">
			<div class="span-1">
				<fieldset>
					<?php
						conditional_error_success(
							'There was an issue updating the events',
							'Successfully updated list of events.',
							'event-update'
						);
					?>
					<legend>Events</legend>
					<?php if (empty($events)): ?>
						<strong>No Events</strong>
					<?php else: ?>
						<form id="update-events" class="grid-form" method="post" action="/actions/update-events.php">
							<table class="flakes-table" style="width:100%">
								<colgroup>
									<col span="1" style="width:20px">
									<col span="1" style="width:80%">
								</colgroup>
								<thead>
									<tr>
								  		<td>X</td>
										<td>Event Name</td>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($events as $event) : ?>
										<tr>
											<td><input name="delete[]" value="<?php echo $event->id ?>" type="checkbox" /></td>
											<input type="hidden" value="<?php echo $event->id ?>" name="events[<?php echo $event->id ?>][id]">
											<td>
												<input 	name="events[<?php echo $event->id ?>][name]"
													value="<?php echo htmlentities($event->name); ?>" />
												<br>
												<label>Enabled
													<input name="events[<?php echo $event->id ?>][enabled]" <?php echo $event->enabled ? 'checked' : '';?> type="checkbox" value="true" />
												</label>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<input class="button-green" type="submit" value="Update">
						</form>
					<?php endif; ?>
				</fieldset>
			</div>
			<div class="span-2">
				<fieldset>
						<legend>Feature Types</legend>
						<?php
							conditional_error_success(
								'There was an issue updating the feature types',
								'Successfully updated list of feature types.',
								'update-feature-types'
							);
						?>
						<form id="update-feature-types" method="post" action="/actions/update-feature-types.php">
							<table class="flakes-table" style="width:100%">
								<colgroup>
									<col span="1" style="width:20px">
									<col span="1" style="width:10%">
									<col span="1" style="width:80%">
								</colgroup>
								<thead>
									<tr>
										<th>X</th>
										<th>Event</th>
										<th>Feature Type</th>
										<th>Is</th>
									</tr>
								</thead>
								<tbody>
										<?php foreach ($featureTypes as $featureType): ?>
										<tr>
											<td>
												<input name="featureTypes[<?php echo $featureType->id ?>][id]" type="hidden" value="<?php echo $featureType->id ?>" />
												<input name="delete[]" value="<?php echo $featureType->id ?>" type="checkbox">
											</td>
											<td>
												<input name="featureTypes[<?php echo $featureType->id ?>][event_id]" type="hidden" value="<?php echo $featureType->event_id ?>" />
												<?php echo htmlentities($eventNames[$featureType->event_id]) ?>
											</td>
											<td>
												<input 
													type="text" 
													value="<?php echo htmlentities($featureType->name); ?>" 
													name="featureTypes[<?php echo $featureType->id ?>][name]"
												/>
											</td>
											<td>
												<label>
													<input 
														type="radio" 
														<?php echo $featureType->is_multi ? 'checked' : ''; ?> 
														name="featureTypes[<?php echo $featureType->id ?>][is_]" 
														value="multi" />Multi
												</label><br/>
												<label>
													<input 
														type="radio" 
														<?php echo $featureType->is_dropdown ? 'checked' : ''; ?> 
														name="featureTypes[<?php echo $featureType->id ?>][is_]" 
														value="dropdown">Dropdown
												</label>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						<input class="button-green" type="submit" value="Update">
					</form>
				</fieldset>
			</div>
		</div>
		<div class="grid-1 gutter-40">
			<div class="span-1">
				<form method="POST" id="update-features" action="/actions/update-features.php">
					<fieldset>
						<legend>Features</legend>
						<?php
							conditional_error_success(
								'There was an issue updating the features',
								'Successfully updated list of features.
								ting',
								'update-features'
							);
						?>
						<table class="flakes-table" style="width:100%">
							<colgroup>
									<col span="1" style="width:20px">
									<col span="1" style="width:80%">
									<col span="1" style="width:20%">
								</colgroup>
							<thead>
								<th>X</th>
								<th>Name</th>
								<th>Type</th>
							</thead>
							<tbody>
								<?php 
									if (!empty($features)) {
										$currentlyShowing = $features[0]->feature_type; 
										$i = 0;
									}
								?>
								<?php foreach ($features as $feature) : ?>
									<?php 
										if($i == 0  || $currentlyShowing != $feature->feature_type) {
											$currentlyShowing = $feature->feature_type;
											?>
											<tr>
												<td colspan="2">
													<strong>Feature Type:</strong> <?php echo $featureTypeNames[$currentlyShowing] ?>
												</td>
											</tr>
											<?php
											
											$i++;
										}
									?>
									<tr>
										<td>
											<input 
												type="hidden" 
												name="features[<?php echo $feature->id ?>][id]" 
												value="<?php echo $feature->id ?>"
											/>
											<label>
												<input type="checkbox" name="delete[]" value="<?php echo $feature->id ?>">
												Delete
											</label>
										</td>										
										<td>
											<input 
												type="text"
												name="features[<?php echo $feature->id ?>][name]" 
												value="<?php echo $feature->name ?>"
											>
										</td>
										<td>
											<select name="features[<?php echo $feature->id ?>][feature_type]" >
												<?php foreach ($featureTypes as $featureType): ?>
													<option value="<?php echo $featureType->id ?>" <?php echo $featureType->id == $feature->feature_type ? 'selected' : '' ?>><?php echo htmlentities($featureType->name) ?></option>
												<?php endforeach; ?>
											</select>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<input class="button-green" type="submit" value="Update">
					</fieldset>
				</form>
			</div>
		</div>
	</div>

</div>
