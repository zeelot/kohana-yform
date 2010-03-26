
<!-- BEGIN YForm_RadioGroup Element -->
<fieldset class="yform-item yform-radioGroup">
	<legend><?php echo $object->label->text; ?></legend>
	<?php foreach ($object->options() as $option): ?>
	<?php echo $option; ?>
	<?php endforeach; ?>
</fieldset>
<!-- END YForm_RadioGroup Element -->
