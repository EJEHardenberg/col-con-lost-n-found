<?php
$pageTitle = 'Search';
include dirname(__FILE__) . '/shared/header.php';
include dirname(__FILE__) . '/shared/core.php';
?>
	<div class="view-wrap">
		<h1>Manage Criteria</h1>
		<div class="grid-3 gutter-40">
			<div class="span-1">
				<div>
					<form class="grid-form" method="post" action="#">
						<fieldset>
							<legend>Event</legend>
							<div data-row-span="1">
								<div data-field-span="1">
									<label>Name</label>
									<input name="name" type="text">
								</div>
							</div>
							<div data-row-span="1">
								<div data-field-span="1">
									<label>Enabled
										<input type="checkbox" checked name="enabled">
									</label>
								</div>
							</div>
							<input type="submit" value="Create" class="button-green bigger">
						</fieldset>
					</form>
				</div>
			</div>
			<div class="span-1">
				<div>
					<form class="grid-form" method="post" action="#">
						<fieldset>
							<legend>Feature Type</legend>
							<div data-row-span="1">
								<div data-field-span="1">
									<label>Event</label>
									<select>
										<!-- Populate with event, maybe use a cookie to keep track of preference or something -->
									</select>
								</div>
							</div>
							<div data-row-span="2">
								<div data-field-span="1">
									<label>Name</label>
									<input type="text">
								</div>
								<div data-field-span="1">
									<label>
										<input type="radio" checked name="is_[]">Multiple Choice
									</label>
									<label>
										<input type="radio" checked name="is_[]">Dropdown Option
									</label>
								</div>
							</div>
							<input type="submit" class="button-green bigger" value="Create" />
						</fieldset>
						
					</form>
				</div>
			</div>
			<div class="span-1">
				<form class="grid-form" method="post" action="#">
						<fieldset>
							<legend>Feature</legend>
							<div data-row-span="2">
								<div data-field-span="1">
									<label>Type</label>
									<select name="feature_type">
										<!-- Populate With Feature types -->
									</select>
								</div>
								<div data-field-span="1">
									<label>Name</label>
									<input type="text">
								</div>
							</div>
							<input type="submit" class="button-green bigger" value="Create" />
						</fieldset>
						
					</form>
			</div>
		</div>
	</div>

</div>