<?php
require_once dirname(__FILE__) . '/../shared/core.php';

is_post_action_only('update-feature-types','Invalid method sent to update-feature-types');

if (!isset($_POST['featureTypes']) || !is_array($_POST['featureTypes'])) {
	send_failure_redirect('update-feature-types');
}

//todo

/* Delete deletables */

/* Update featureTypes that have been changed */


exit();
