<?php
/**
 * Sample Payment form using YForm
 */
$settings = YF::settings()
	->set_values((array)$post)
	->add_messages('error', (array)$errors);
?>

<?php echo form::open(); ?>

	<?php echo YF::item('text', 'first_name')->load($settings); ?>
	<?php echo YF::item('text', 'last_name')->load($settings); ?>
	<?php echo YF::item('text', 'city')->load($settings); ?>
	<?php echo YF::item('text', 'state')->load($settings); ?>
	<?php echo YF::item('text', 'zip')->load($settings); ?>
	<?php echo YF::item('submit', 'submit'); ?>

<?php echo form::close(); ?>