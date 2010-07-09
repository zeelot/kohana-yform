
<!-- BEGIN YForm_Upload Element -->
<div class="yform-item yform-upload<?php echo empty($errors) ? '' : ' errors'; ?>">

	<?php if ( ! empty($label)): ?>
		<label for="<?php echo Arr::get($attributes, 'id'); ?>" ><?php echo $label; ?></label>
	<?php endif; ?>

	<input <?php echo HTML::attributes($attributes); ?>/>

	<?php foreach (Arr::get($messages, 'errors', array()) as $error): ?>
		<div class="error"><?php echo $error; ?></div>
	<?php endforeach; ?>

</div>
<!-- END YForm_Upload Element -->
