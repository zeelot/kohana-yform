
<!-- BEGIN YForm_Password Element -->
<div class="yform-item yform-password<?php echo empty($errors) ? '' : ' errors'; ?>" id="<?php echo Arr::get($attributes, 'id'); ?>-container">
	<?php if ( ! empty($label)): ?>
		<label for="<?php echo Arr::get($attributes, 'id'); ?>" >
			<?php echo $label; ?>
			<?php if ($object->get('required') !== FALSE): ?>

				<span class="required"><?php echo ($object->required === TRUE)?'*':$object->required; ?></span>

			<?php endif; ?>
		</label>
	<?php endif; ?>

	<input <?php echo HTML::attributes($attributes); ?>/>

	<?php foreach ($messages as $type => $array): ?>
		<?php if ($type !== 'errors'): // We want errors last ?>
			<?php foreach ($array as $message): ?>

		<div class="message <?php echo $type; ?>"><?php echo $message; ?></div>

			<?php endforeach; ?>
		<?php endif; ?>
	<?php endforeach; ?>

	<?php foreach (Arr::get($messages, 'errors', array()) as $error): ?>
		<div class="message error"><?php echo $error; ?></div>
	<?php endforeach; ?>
</div>
<!-- END YForm_Password Element -->
