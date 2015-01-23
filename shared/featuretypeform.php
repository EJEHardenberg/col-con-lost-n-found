<?php

if (!isset($featureType) || !is_object($featureType)) {
	logMessage('NonFeatureType passed to featuretypeform', LOG_LVL_WARN);
	return; //no.
}

if (get_class($featureType) != 'FeatureType') {
	logMessage('NonFeatureType passed to featuretypeform', LOG_LVL_WARN);
	return; //no
}

?>
<div>
	<input type="hidden" name="featuretype[$featureType->id][id]" value="<?php echo $featureType->id; ?> ?>" />
	<fieldset>
		<?php if ($featureType->is_multi) : ?>
			<legend><?php echo htmlentities($featureType->name) ?></legend>
			<?php /* list features as checkboxes */ ?>
		<?php else: //is_dropdown ?>
			<legend><?php echo htmlentities($featureType->name) ?>
				<select>
					<?php /* list features for this type */ ?>
				</select>
			</legend>
		<?php endif; ?>
	</fieldset>
</div>