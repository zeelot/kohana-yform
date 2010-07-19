
<!-- BEGIN YForm_RadioGroup Element -->
<fieldset class="yform-item yform-radioGroup">

	<?php if( ! empty($label)): ?>
		<legend><?php echo $label; ?></legend>
	<?php endif; ?>

	<?php foreach ($object->options() as $option): ?>
	<?php echo $option; ?>
	<?php endforeach; ?>

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
</fieldset>
<!-- END YForm_RadioGroup Element -->
