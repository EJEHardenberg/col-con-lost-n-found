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
							<a class="action button-gray smaller right" href="/advsearch.php">Advanced Search</a>
							<a class="action button-gray smaller right" href="/criteria.php">Edit Criteria</a>
							<input type="submit" class="action button-gray smaller right" value="Search">
						</div>
					</form>
				</div>
				<!-- Table andd all those wonderful things here -->
				<?php include dirname(__FILE__) . '/shared/inventory-list.php'; ?>
			</div>
		</div><!-- ends header started div. -->
