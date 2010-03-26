<?php
/**
 * Sample form using YForm
 */
?>

<?php

// uses the default config group
$form = YForm::factory('payment')
	->add_values((array)$values)
	->add_messages('error', (array)$errors);
?>

<?php echo $form->open(); ?>
<fieldset>
	<legend>Simple Form</legend>
	<?php echo $form->text('name'); ?>
	<?php echo $form->checkbox('remember'); ?>

	<fieldset>
		<legend>Favorite Color</legend>
		<?php echo $form->radio('color', 'red'); ?>
		<?php echo $form->radio('color', 'blue'); ?>
		<?php echo $form->radio('color', 'green'); ?>
		<?php echo $form->radio('color', 'orange'); ?>
	</fieldset>

	<?php echo $form->radioGroup('color')
		// this is usually done with ORM::select_list() in one line
		->add_options(array
		(
			'red'		=> 'red',
			'blue'		=> 'blue',
			'green'		=> 'green',
			'orange'	=> 'orange',
		)); ?>

	<?php echo $form->submit('submit'); ?>
</fieldset>
<?php echo $form->close(); ?>
