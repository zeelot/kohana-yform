
<!-- BEGIN YForm_Textarea Element -->
<div class="yform-item yform-textarea<?php echo empty($errors) ? '' : ' errors'; ?>">
	<?php echo $object->label->render(); ?>
	<textarea <?php echo HTML::attributes($attributes); ?>><?php echo $object->value; ?></textarea>

	<?php foreach (Arr::get($messages, 'errors', array()) as $error): ?>
		<div class="error"><?php echo $error; ?></div>
	<?php endforeach; ?>

</div>
<!-- END YForm_Textarea Element -->
