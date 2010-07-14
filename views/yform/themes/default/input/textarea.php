
<!-- BEGIN YForm_Textarea Element -->
<div class="yform-item yform-textarea<?php echo empty($errors) ? '' : ' errors'; ?>">
	<?php if ( ! empty($label)): ?>
		<label for="<?php echo Arr::get($attributes, 'id'); ?>" ><?php echo $label; ?></label>
	<?php endif; ?>

	<textarea <?php echo HTML::attributes($attributes); ?>><?php echo HTML::chars($object->value); ?></textarea>

	<?php foreach (Arr::get($messages, 'errors', array()) as $error): ?>
		<div class="error"><?php echo $error; ?></div>
	<?php endforeach; ?>

</div>
<!-- END YForm_Textarea Element -->
