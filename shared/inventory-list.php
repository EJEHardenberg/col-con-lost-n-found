<form method="POST" action="/actions/update-items.php"  class="grid-form">
	<?php
	conditional_error_success(
		'There was an issue updating all items',
		'Successfully updated all items',
		'update-items'
	);
	?>
	<table class="flakes-table">
		<colgroup>
			<col span="1" style="20px">
			<col span="1" style="20px">
			<col span="1" style="20%">
		</colgroup>
		<thead>
			<tr>
				<th></th>
				<th>Event</th>
				<th>Name</th>
				<th>Found</th>
				<th>Submitted</th>
				<!-- Maybe show # of features -->
			</tr>
		</thead>
		<tbody>
			<?php foreach ($items as $item) : ?>
				<tr>
					<td><input type="checkbox" name="delete[]" value="<?php echo $item->id ?>"></td>
					<td><?php echo $eventsById[$item->event_id]->name; ?></td>
					<td>
						<a href="/item.php?id=<?php echo $item->id ?>">
							<?php echo $item->name; ?>
						</a>
					</td>
					<td><label>is found &nbsp;
						<input type="hidden" name="items[<?php echo $item->id; ?>][id]" value="<?php echo $item->id; ?>" />
						<input 
							type="checkbox" 
							<?php echo $item->is_found ? 'checked' : '' ?> 
							name="items[<?php echo $item->id; ?>][is_found]" 
							value="<?php echo $item->id ?>">
						</label>
					</td>
					<td><?php echo date('m/d/Y', strtotime($item->submitted_time)); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<input type="submit" class="button-blue" value="Delete/Update Selected" > 
</form>