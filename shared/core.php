<?php
/* Core file is to load classes and functions, not for output */
$dir = dirname(__FILE__);
require_once $dir . '/../php-util/init.php';
require_once $dir . '/models.php';

//todo: load services neccesary for usage as well

logMessage('Core Libraries Loaded',LOG_LVL_DEBUG);