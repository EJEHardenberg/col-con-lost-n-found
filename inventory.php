<?php
$pageTitle = 'Inventory';
include dirname(__FILE__) . '/shared/header.php';
include dirname(__FILE__) . '/shared/core.php'; 

$items = ItemService::getItems();
$events = EventService::getEvents();
$eventsById = array();
foreach ($events as $event) {
	$eventsById[$event->id] = $event;
}
?>
			<div class="view-wrap">
				<h1>Inventory Management</h1>
				<p>
				</p>
				<!-- Table andd all those wonderful things here -->
				<form method="POST" action="/actions/update-items.php"  class="grid-form">
				<table class="flakes-table">
					<colgroup>
						<col span="1" style="20px">
						<col span="1" style="20px">
						<col span="1" style="20%">
					</colgroup>
					<thead>
						<tr>
							<th></th>
							<th>Event</th>
							<th>Name</th>
							<th>Found</th>
							<th>Submitted</th>
							<!-- Maybe show # of features -->
						</tr>
					</thead>
					<tbody>
						<?php foreach ($items as $item) : ?>
							<tr>
								<td><input type="checkbox" name="delete[]" value="<?php echo $item->id ?>"></td>
								<td><?php echo $eventsById[$item->event_id]->name; ?></td>
								<td><?php echo $item->name; ?></td>
								<td><label>
									<input 
										type="checkbox" 
										<?php echo $item->is_found ? 'checked' : '' ?> 
										name="is_found[]" 
										value="<?php echo $item->id ?>">
									</label> is found
								</td>
								<td><?php echo date('m/d/Y', strtotime($item->submitted_time)); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
					<input type="submit" class="button-red" value="Delete Selected" > 
				</form>
			</div>
		</div><!-- ends header started div. -->
