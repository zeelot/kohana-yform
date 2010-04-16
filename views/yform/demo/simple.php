<?php
/**
 * Sample form using YForm
 */
?>

<?php
	// Lets go back to basics without a settings object
	$field = new YForm_Field_Text('hello[world]');
	echo $field;
?>
