<?php

if (!isset($feature) || !is_object($feature)) {
	logMessage('NonFeatureType passed to featuretypeform', LOG_LVL_WARN);
	return; //no.
}

if (get_class($feature) != 'FeatureType') {
	logMessage('NonFeatureType passed to featuretypeform', LOG_LVL_WARN);
	return; //no
}

?>