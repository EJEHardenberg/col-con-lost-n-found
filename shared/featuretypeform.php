<?php

if (!isset($feature) || !is_object($feature)) {
	logMessage('NonFeatureType passed to featuretypeform', LOG_LVL_WARN);
	return; //no.
}

if (get_class($feature) != 'FeatureType') {
	logMessage('NonFeatureType passed to featuretypeform', LOG_LVL_WARN);
	return; //no
}

?><div>
	<form class="grid-form">
		<fieldset>
			<legend>Feature Type</legend>
			<div data-row-span="2">
				<div data-field-span="1">
					<label>Name</label>
					<input type="text">
				</div>
				<div data-field-span="1">
					<label>
						<input type="radio" checked name="is_">Multiple Choice
					</label>
					<label>
						<input type="radio" checked name="is_">Dropdown Option
					</label>
				</div>
			</div>
		</fieldset>
		<input type="submit" class="button-green bigger" value="Create" />
	</form>
</div>