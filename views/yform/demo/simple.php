<?php
/**
 * Sample Payment form using YForm
 */
?>

<?php

// uses the default config group
$form = YForm::factory('payment');

?>

<?php echo $form->open(); ?>
	<?php echo $form->text('name'); ?>
	<?php echo $form->submit('submit'); ?>
<?php echo $form->close(); ?>