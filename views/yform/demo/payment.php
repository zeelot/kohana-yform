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
	->config('theme', 'default')
	// will render with theme path from above + input/text as the full path to view file
    ->config('view', 'input/text')
    // you can also pass any value into the corresponding view
    ->set('foo', 'bar')
    // you can alter the attributes for the element
    ->attribute('value', 'Lorenzo')
    // pass in message objects
    ->add_message($form->message('info', 'Info Text')
    // this message object can have methods chained to it as well
        ->set('class', 'special-info')
    ); ?>

<?php echo $form->submit('submit'); ?>

<?php echo $form->close(); ?>