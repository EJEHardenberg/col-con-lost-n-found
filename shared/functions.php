<?php

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