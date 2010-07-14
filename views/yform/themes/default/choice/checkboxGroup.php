
<!-- BEGIN YForm_CheckboxGroup Element -->
<fieldset class="yform-item yform-checkboxGroup">

	<?php if( ! empty($label)): ?>
		<legend><?php echo $label; ?></legend>
	<?php endif; ?>

	<?php foreach ($object->options() as $option): ?>
	<?php echo $option; ?>
	<?php endforeach; ?>
</fieldset>
<!-- END YForm_CheckboxGroup Element -->
