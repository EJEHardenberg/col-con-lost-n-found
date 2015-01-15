<?php
require_once dirname(__FILE__) . '/../php-util/init.php';

logMessage("Loading models", LOG_LVL_DEBUG);

class Event extends Entity
{
	public $name;
	public $enabled;
}

class Item extends Entity
{
	public $event_id = -1;
	public $name = '';
	public $description = '';
	public $is_found = false;
	public $submitted_time = NULL;
}


class FeatureType extends Entity
{	
	public $event_id = -1;
	public $name = '';
	public $is_multi = false;
	public $is_dropdown = false;
}

class Feature extends Entity
{
	public $feature_type = -1;
	public $name = '';		
}

logMessage("Models loaded", LOG_LVL_DEBUG);