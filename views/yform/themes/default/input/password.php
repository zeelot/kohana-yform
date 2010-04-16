
<!-- BEGIN YForm_Password Element -->
<div class="yform-item yform-password<?php echo empty($errors) ? '' : ' errors'; ?>">
	<?php echo $object->label->render(); ?>
	<input <?php echo HTML::attributes($attributes); ?>/>

	<?php foreach (Arr::get($messages, 'errors', array()) as $error): ?>
		<div class="error"><?php echo $error; ?></div>
	<?php endforeach; ?>

</div>
<!-- END YForm_Password Element -->
