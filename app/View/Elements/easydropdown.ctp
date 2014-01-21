<select class="dropdown" name="<?php echo $name; ?>">
	<?php foreach($options as $key => $value): ?>
	<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
	<?php endforeach; ?>
</select>