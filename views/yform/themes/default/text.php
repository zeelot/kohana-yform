
<!-- BEGIN YForm_Text Element -->
<div class="yform-item yform-text">
	<?php foreach ($object->messages('error', array()) as $message): ?>
		<?php echo $message->render(); ?>
	<?php endforeach; ?>
	<?php echo $object->label->render(); ?>
	<input <?php echo $object->attributes; ?>/>
	<?php foreach ($object->all_messages(array('error')) as $message): ?>
		<?php echo $message->render(); ?>
	<?php endforeach; ?>
</div>
<!-- END YForm_Text Element -->