
<!-- BEGIN YForm_Text Element -->
<div class="yform-item yform-checkbox">

	<?php foreach ($object->messages('error', array()) as $message): ?>
		<?php echo $message->render(); ?>
	<?php endforeach; ?>
	
	<input <?php echo $object->attributes; ?>/>
	<?php echo $object->label->render(); ?>
	<?php foreach ($object->messages_exclude(array('error')) as $message): ?>
		<?php echo $message->render(); ?>
	<?php endforeach; ?>
	
</div>
<!-- END YForm_Text Element -->