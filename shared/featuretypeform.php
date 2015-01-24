<?php

if (!isset($featureType) || !is_object($featureType)) {
	logMessage('NonFeatureType passed to featuretypeform', LOG_LVL_WARN);
	return; //no.
}

if (get_class($featureType) != 'FeatureType') {
	logMessage('NonFeatureType passed to featuretypeform', LOG_LVL_WARN);
	return; //no
}

if (!isset($features) || !is_array($features)) {
	logMessage('NonArray passed to featuretypeform for features', LOG_LVL_WARN);
	return; //no.
}

?>
<div class="span-1">
	<fieldset class="grid-form">
		<?php if ($featureType->is_multi) : ?>
			<legend><?php echo htmlentities($featureType->name) ?></legend>
			<?php foreach ($features as $feature) : ?>
				<label>
					<?php echo $feature->name; ?>
					<input type="checkbox" name="features[]" value="<?php echo $feature->id ?>" />
				</label>
			<?php endforeach; ?>
		<?php else: //is_dropdown ?>
			<legend><?php echo htmlentities($featureType->name) ?></legend>
				<select name="features[]">
					<?php foreach ($features as $feature) : ?>
						<option value="<?php echo $feature->id; ?>"><?php echo $feature->name ?></option>	
					<?php endforeach; ?>
				</select>
		<?php endif; ?>
	</fieldset>
</div>