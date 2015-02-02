<?php


logMessage("Loading functions.php", LOG_LVL_DEBUG);
/* Shows an error or success message based on GET params
 * $errMsg: the error message to show
 * $successMsg: the success message to show
 * $sectionType: the type of error or success we should be responding to
 * $sectionGET: the get parameter key for the sectionType
*/
function conditional_error_success($errMsg ='', $successMsg = '', $sectionType='△', $sectionGet= 's' ) {
	if (isset($_GET[$sectionGet]) && $_GET[$sectionGet] == $sectionType) {
		if (isset($_GET['e']) && intval($_GET['e']) == 1 ) {
			?><p class="flakes-message error"><?php echo $errMsg ?></p><?php
		} elseif ($_GET['e'] == 0) { 
			?><p class="flakes-message success"><?php echo $successMsg ?></p><?php
		}
	}
}

function send_success_redirect($urlKeyForRedirect, $queryParams = '') {
	global $urlMappings;
	header('Location: ' . $urlMappings[$urlKeyForRedirect]['success'] . $queryParams);
	exit();
}

function send_failure_redirect($urlKeyForRedirect, $queryParams = '') {
	global $urlMappings;
	header('Location: ' . $urlMappings[$urlKeyForRedirect]['fail'] . $queryParams);
	exit();
}

/* Ends the request if the server method isn't post, relys on global var $urlMappings
 * $urlKeyForRedirect: the key to look up in the urlMappings for where to redirect
 * $logMsg: message to log to note the event at LOG_LVL_DEBUG
*/
function is_post_action_only($urlKeyForRedirect, $logMsg='Invalid method sent to post only request') {
	if ($_SERVER['REQUEST_METHOD'] != 'POST') { 	
		logMessage($logMsg, LOG_LVL_DEBUG);
		send_failure_redirect($urlKeyForRedirect);	
	}
}

logMessage("Finished loading functions.php", LOG_LVL_DEBUG);