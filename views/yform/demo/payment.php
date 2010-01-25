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

<?php echo $form->text('name')
	// will look in views/yform/themes/default for this field
	->set_option('theme', 'default')
	// will render with theme path from above + input/text as the full path to view file
    ->set_option('view', 'input/text')
    // you can also pass any value into the corresponding view
    ->set('foo', 'bar')
    // you can alter the attributes for the element
    ->set_attribute('value', 'Lorenzo')
    // pass in message objects
    ->add_message($form->message('info', 'Info Text')
    // this message object can have methods chained to it as well
        ->set('class', 'special-info')
    ); ?>

<?php echo $form->submit('submit'); ?>

<?php echo $form->close(); ?>