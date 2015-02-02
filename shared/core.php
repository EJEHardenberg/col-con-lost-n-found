<?php
/* Core file is to load classes and functions, not for output */
$dir = dirname(__FILE__);
require_once $dir . '/../php-util/init.php';
require_once $dir . '/models.php';

//todo: load services neccesary for usage as well

$urlMappings = array(
	'create-event' => array(
		'fail' => '/criteria.php?e=1&s=event#create-event',
		'success' => '/criteria.php?e=0&s=event#create-event'
	),
	'update-events' => array(
		'fail' => '/criteria.php?e=1&s=event-update#update-events',
		'success' => '/criteria.php?e=0&s=event-update#update-events'
	),
	'create-feature-type' => array(
		'fail' => '/criteria.php?e=1&s=feature-type#create-feature-type',
		'success' => '/criteria.php?e=0&s=feature-type#create-feature-type',
	),
	'update-feature-types' => array(
		'fail' => '/criteria.php?e=1&s=update-feature-types#update-feature-types',
		'success' => '/criteria.php?e=0&s=update-feature-types#update-feature-types',
	),
	'create-feature' => array(
		'fail' => '/criteria.php?e=1&s=create-feature#create-feature',
		'success' => '/criteria.php?e=0&s=create-feature#create-feature'
	),
	'update-features' => array(
		'fail' => '/criteria.php?e=1&s=update-features#update-features',
		'success' => '/criteria.php?e=0&s=update-features#update-features'	
	),
	'report-item' => array(
		'fail' => '/report-item.php?e=1&s=report-item',
		'success' => '/report-item.php?e=0&s=report-item'		
	),
	'update-items' => array(
		'fail' => '/inventory.php?e=1&s=update-items',
		'success' => '/inventory.php?e=0&s=update-items'
	),
	'text-search' => array(
		'fail' => '/inventory.php?e=1&s=text-search',
		'success' => '/inventory.php?e=1&s=text-search'
	)
);

logMessage('Loading common functions', LOG_LVL_DEBUG);
require_once $dir . '/functions.php';
logMessage('Finished loading common functions', LOG_LVL_DEBUG);

logMessage('Loading Services', LOG_LVL_DEBUG);
require_once $dir . '/../services/EventService.php';
require_once $dir . '/../services/FeatureTypeService.php';
require_once $dir . '/../services/FeatureService.php';
require_once $dir . '/../services/ItemService.php';
logMessage('Finished loading services',LOG_LVL_DEBUG);

logMessage('Core Libraries Loaded',LOG_LVL_DEBUG);
