<?php
require_once dirname(__FILE__) . '/../shared/core.php';

is_post_action_only('update-features','Invalid method sent to update-features');

if (!isset($_POST['features']) || !is_array($_POST['features'])) {
	send_failure_redirect('update-features');
}

echo '<pre>'; print_r($_POST); exit();