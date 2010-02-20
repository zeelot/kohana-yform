<?php
	$errors = $object->messages('error', array());
?>
<!-- BEGIN YForm_Text Element -->
<div class="yform-item yform-text<?php echo (empty($errors))? '': ' errors'; ?>">
	<?php echo $object->label->render(); ?>
	<input <?php echo $object->attributes; ?>/>
	<?php foreach ($errors as $error): ?>
	<div class="error"><?php echo $error; ?></div>
	<?php endforeach; ?>
</div>
<!-- END YForm_Text Element -->