<?php
$pageTitle = 'Inventory';
include dirname(__FILE__) . '/shared/header.php';
include dirname(__FILE__) . '/shared/core.php'; 

$items = ItemService::getItems()
?>
			<div class="view-wrap">
				<h1>Inventory Management</h1>
				<p>
				</p>
				<!-- Table andd all those wonderful things here -->
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
								<td><?php echo $item->event_id; //todo put out name ?></td>
								<td><?php echo $item->name; ?></td>
								<td><?php echo $item->is_found ? 'Found' : 'Lost'; ?></td>
								<td><?php echo date('m/d/Y', $item->submitted_time); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div><!-- ends header started div. -->
