<?php
require_once dirname(__FILE__) . '/../shared/core.php';

is_post_action_only('create-event','Invalid method sent to create-event');

//todo: write service to create the event and create validations
