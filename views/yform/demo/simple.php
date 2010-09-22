<?php
/**
 * Sample form using YForm
 */
?>

<?php
	// Lets go back to basics without a settings object
	$field = new YForm_Field_Text('hello[world]');
	echo $field;

	$field = new YForm_Field_Hidden('hello[hidden]', 'haha!');
	echo $field;

	$field = new YForm_Field_Password('hello[password]');
	echo $field;

	$field = new YForm_Field_Radio('hello[color]', 'red');
	echo $field;

	$field = new YForm_Field_RadioGroup('hello[color]');
	echo $field->add_options(array
	(
		'red' => 'red',
	));

	$field = new YForm_Field_Checkbox('hello[checkme]');
	echo $field;

	$field = new YForm_Field_Textarea('hello[textarea]');
	echo $field;

	$field = new YForm_Field_Submit('hello[submit]');
	echo $field;

	$field = new YForm_Field_Reset('hello[reset]');
	echo $field;

	$field = new YForm_Field_Button('hello[button]');
	echo $field;
?>
