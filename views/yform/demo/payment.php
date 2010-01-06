<?php
/**
 * Sample Payment form using YForm
 */
?>

<?php $yf = YF::element('form', 'awesome_form'); ?>

<?php echo $yf; ?>
<?php echo $yf->text('Name'); ?>
<?php echo $yf->submit('Submit'); ?>
<?php echo $yf; ?>