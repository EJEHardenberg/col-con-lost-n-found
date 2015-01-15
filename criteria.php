<?php
$pageTitle = 'Search';
include dirname(__FILE__) . '/shared/header.php';
include dirname(__FILE__) . '/shared/core.php';

$events = EventService::getEvents();
if ($events === false) {
	internal_error();
}
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
					<form class="grid-form" method="post" action="#">
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
									<select>
										<?php foreach ($events as $event) : ?>
											<option value="<?php echo $event->id ?>"><?php echo htmlentities($event->name); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div data-row-span="2">
								<div data-field-span="1">
									<label>Name</label>
									<input type="text">
								</div>
								<div data-field-span="1">
									<label>
										<input type="radio" checked name="is_[]" value="multi">Multiple Choice
									</label>
									<label>
										<input type="radio" checked name="is_[]" value="dropdown">Dropdown Option
									</label>
								</div>
							</div>
							<input type="submit" class="button-green bigger" value="Create" />
						</fieldset>
						
					</form>
				</div>
			</div>
			<div class="span-1">
				<form class="grid-form" method="post" action="#">
						<fieldset>
							<?php
							conditional_error_success(
								'There was an issue creating the feature',
								'Successfully created a feature.',
								'feature'
							);
							?>
							<legend>Feature</legend>
							<div data-row-span="2">
								<div data-field-span="1">
									<label>Type</label>
									<select name="feature_type">
										<!-- Populate With Feature types -->
									</select>
								</div>
								<div data-field-span="1">
									<label>Name</label>
									<input type="text">
								</div>
							</div>
							<input type="submit" class="button-green bigger" value="Create" />
						</fieldset>
						
					</form>
			</div>
		</div>
		<hr>
		<h2>Update and Delete</h2>
		<div class="grid-2 gutter-40">
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
						<p class="flakes-message information">
							To delete an event check the left column
						</p>
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
										<td>Enabled</td>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($events as $event) : ?>
										<tr>
											<td><input name="delete[]" value="<?php echo $event->id ?>" type="checkbox" /></td>
											<input type="hidden" value="<?php echo $event->id ?>" name="events[<?php echo $event->id ?>][id]">
											<td><input name="events[<?php echo $event->id ?>][name]" value="<?php echo htmlentities($event->name); ?>" /></td>
											<td><input name="events[<?php echo $event->id ?>][enabled]" <?php echo $event->enabled ? 'checked' : '';?> type="checkbox" value="true" /></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<input class="button-green" type="submit" value="Update">
						</form>
					<?php endif; ?>
				</fieldset>
			</div>
			<div class="span-1">
				<fieldset>
					<legend>Feature Types &amp; Features</legend>
				</fieldset>
			</div>
		</div>
	</div>

</div>