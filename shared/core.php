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
	)
);

logMessage('Loading common functions', LOG_LVL_DEBUG);
require_once $dir . '/functions.php';
logMessage('Finished loading common functions', LOG_LVL_DEBUG);

logMessage('Loading Services', LOG_LVL_DEBUG);
require_once $dir . '/../services/EventService.php';
require_once $dir . '/../services/FeatureTypeService.php';
logMessage('Finished loading services',LOG_LVL_DEBUG);

logMessage('Core Libraries Loaded',LOG_LVL_DEBUG);