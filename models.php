<?php
require_once dirname(__FILE__) . '/php-util/init.php';

logMessage("Loading models", LOG_LVL_DEBUG);

class Event extends Entity
{
	public $name;
	public $enabled;

	function __construct()
	{
		$this->name = '';
		$this->enabled = true;	
	}
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

	function __construct()
	{		
		$this->event_id = -1;
		$this->name = '';
		$this->is_multi = false;
		$this->is_dropdown = false;
	}
}

class Feature extends Entity
{
	public $event_id = -1;
	public $feature_type = -1;
	public $name = '';	

	function __construct()
	{
		$this->event_id = -1;
		$this->feature_type = -1;
		$this->name = '';	
	}
	
}

logMessage("Models loaded", LOG_LVL_DEBUG);