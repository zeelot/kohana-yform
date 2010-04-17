
<!-- BEGIN YForm_Checkbox Element -->
<div class="yform-item yform-checkbox">
	<input <?php echo HTML::attributes($attributes); ?>/>

	<?php if ( ! empty($label)): ?>
		<label for="<?php echo Arr::get($attributes, 'id'); ?>" ><?php echo $label; ?></label>
	<?php endif; ?>
</div>
<!-- END YForm_Radio Element -->
