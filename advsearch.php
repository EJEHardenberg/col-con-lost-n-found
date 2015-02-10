<?php
$pageTitle = 'Inventory';
include dirname(__FILE__) . '/shared/core.php'; 
include dirname(__FILE__) . '/shared/header.php';

$events = EventService::getEvents();
$eventsById = array();
foreach ($events as $event) {
	$eventsById[$event->id] = $event;
}
$featureTypes = FeatureTypeService::getFeatureTypes();
$features = FeatureService::getFeatures();

$featureTypeNames = array();
foreach ($featureTypes as $featureType) {
	$featureTypeNames[$featureType->id] = $featureType->name;
}

$partionedFeatures = array();
foreach ($features as $feature) {
	if (!isset($partionedFeatures[$feature->feature_type])) {
		$partionedFeatures[$feature->feature_type] = array();
	}
	$partionedFeatures[$feature->feature_type][] = $feature;
}

?>
	<div class="view-wrap">
		<h1>Advanced Search</h1>
		<p>
			Search via the individual features that an item has
		</p><?php
switch ($_SERVER['REQUEST_METHOD']) {
	case 'POST':
		$limit = null;
		if ( isset($_POST['limit']) ) {
			if ($_POST['limit'] != 'none') {
				$limit = $_POST['limit'] == 'found' ? true : false;	
			}
		}
		$items = array();
		$searchTerm = isset($_POST['search_term']) ? $_POST['search_term'] : '';
		if (!empty($searchTerm)) {
			$textItems = ItemService::textSearchForItems($searchTerm);	
			if ($textItems !== false) {
				if (is_null($limit)) {
					$items = array_merge($items, $textItems);	
				} else {
					foreach ($textItems as $item) {
						if ($item->is_found == $limit) {
							$items[] = $item;
						}
					}
				}
			}
		}


		$featuresList = isset($_POST['features']) ? 
			is_array($_POST['features']) ? $_POST['features'] : array()
			: array();
		if (!empty($featuresList)) {
			$ids = array();
			/* Catch any non numerics and ignore them */
			foreach ($featuresList as $id) {
				if (is_numeric($id)) {
					$ids[] = intval($id);
				}
			}

			if (!empty($ids)) {
				$featureItems = ItemService::itemsByFeatureIds($ids, $limit);
				if ($featureItems !== false) {
					$items = array_merge($items, $featureItems);
				}
			}
		}
		?>
		<a href="/advsearch.php" class="action button-gray smaller right">Back to Adv. Search</a>
		<?php 
		include dirname(__FILE__) . '/shared/inventory-list.php';  
		break;
	default:
?>
		<div id="inventory-search">
			<form method="POST" action="/advsearch.php"  class="grid-form">
				<h2>General</h2>
				<div class="flakes-search">
					<input class="search-box search" name="search_term" placeholder="Title/Description" autofocus="">
					<h3>Limit to </h3>
						<select name="limit">
							<option value="none">No limit</option>
							<option value="found">Found Items  Only</option>
							<option value="lost">Lost Items Only</option>
						</select>
					
				</div>
				<h2>Features</h2>
				<div class="grid-3 gutter-40">
					<?php $i = 0; ?>
					<?php foreach($partionedFeatures as $featureList): ?>
						<?php 
							$featureTypeName = $featureTypeNames[$featureList[0]->feature_type];
						?>
						<div class="span-1">
							<h3><?php echo $featureTypeName ?></h3>
							<ul>
								<?php foreach ($featureList as $feature): ?>
									<li>
										<label>
										<?php echo $feature->name ?>
										<input type="checkbox" value="<?php echo $feature->id ?>" name="features[]">
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
						<?php $i++; if ($i % 3 == 0): ?>
							</div>
							<div class="grid-3 gutter-40">
						<?php endif ?>
					<?php endforeach ?>
				</div>
				<div class="flakes-actions-bar">
					<input type="submit" class="action button-gray smaller right" value="Search">
				</div>
			</form>
		</div>
	</div>
<?php 
	break; //end default
} //end switch ?>