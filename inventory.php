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
				<pre>
					<?php print_r($items); ?>
				</pre>
			</div>
		</div><!-- ends header started div. -->
