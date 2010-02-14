<?php
/**
 * Sample form using YForm
 */
?>

<?php

// uses the default config group
$form = YForm::factory('payment')
	->values((array)$values)
	//->messages('error', (array)$errors);

?>

<?php echo $form->open(); ?>
	<?php echo $form->text('name'); ?>
	<?php echo $form->checkbox('remember'); ?>
	<?php echo $form->submit('submit'); ?>
<?php echo $form->close(); ?>