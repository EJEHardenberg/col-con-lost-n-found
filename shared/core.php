<?php
/* Core file is to load classes and functions, not for output */
$dir = dirname(__FILE__);
require_once $dir . '/../php-util/init.php';
require_once $dir . '/models.php';

//todo: load services neccesary for usage as well

$urlMappings = array(
	'create-event' => array(
		'fail' => '/criteria.php?e=1&s=event',
		'success' => '/criteria.php?e=0&s=event'
	)
);

logMessage('Loading common functions', LOG_LVL_DEBUG);
require_once $dir . '/functions.php';
logMessage('Finished loading common functions', LOG_LVL_DEBUG);

logMessage('Core Libraries Loaded',LOG_LVL_DEBUG);