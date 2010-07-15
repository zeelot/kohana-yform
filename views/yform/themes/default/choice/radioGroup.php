
<!-- BEGIN YForm_RadioGroup Element -->
<fieldset class="yform-item yform-radioGroup">

	<?php if( ! empty($label)): ?>
		<legend><?php echo $label; ?></legend>
	<?php endif; ?>

	<?php foreach ($object->options() as $option): ?>
	<?php echo $option; ?>
	<?php endforeach; ?>

	<?php foreach (Arr::get($messages, 'errors', array()) as $error): ?>
		<div class="error"><?php echo $error; ?></div>
	<?php endforeach; ?>
</fieldset>
<!-- END YForm_RadioGroup Element -->
