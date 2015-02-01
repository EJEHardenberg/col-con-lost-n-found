<?php
$pageTitle = 'Search Results';
include dirname(__FILE__) . '/shared/core.php'; 

is_post_action_only('text-search','Please use the inventory form to search');

if (!isset($_POST['search_term']) || empty($_POST['search_term'])) {
	send_failure_redirect('text-search');
}

/* Get search results */
$searchTerm = $_POST['search_term'];

include dirname(__FILE__) . '/shared/header.php';


$items = ItemService::textSearchForItems($searchTerm);
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
				<div id="inventory-search">
					<form method="POST" action="/search.php">
						<div class="flakes-search">
							<input class="search-box search" placeholder="Search Items by Title/Description" autofocus="">
						</div>
						<div class="flakes-actions-bar">
							<a class="action button-gray smaller right" href="/search.php">Advanced Search</a>
							<a class="action button-gray smaller right" href="/criteria.php">Edit Criteria</a>
							<input type="submit" class="action button-gray smaller right" value="Search">
						</div>
					</form>
				</div>
				<table class="flakes-table">
					<colgroup>
						<col span="1" style="20px">
						<col span="1" style="20%">
					</colgroup>
					<thead>
						<tr>
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
								<td><?php echo $eventsById[$item->event_id]->name; ?></td>
								<td><?php echo $item->name; ?></td>
								<td><?php echo $item->is_found ? 'Found' : 'Lost' ?> 
								</td>
								<td><?php echo date('m/d/Y', strtotime($item->submitted_time)); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div><!-- ends header started div. -->
