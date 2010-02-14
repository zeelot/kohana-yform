<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	/**
	 * Setting group chosen by default when creating the YForm object
	 */
	'default' => array
	(
		/**
		 * Wether or not to automatically look up message keys
		 * for displaying the label of a field
		 * Ex:
		 * YForm::factory('login')
		 *		->text('name');
		 * the text input will look in the following locations (cascading)
		 * yform/labels.login.name
		 * yform/labels.name
		 */
		'message_lookup'	=> TRUE,
		/**
		 * Directory in views/yform/themes to use for this form
		 * Each element must have a view inside this directory
		 */
		'theme'				=> 'default',
		/**
		 * Default Views for each element
		 * (This list needs added to if new elements are added)
		 */
		'views'				=> array
		(
			'text'				=> 'input/text',
			'password'			=> 'input/password',
			'hidden'			=> 'input/hidden',
			'file'				=> 'input/file',
			'checkbox'			=> 'input/checkbox',
			'radio'				=> 'input/radio',

			'checkbox_group'	=> 'choice/checkbox_group',
			'radio_group'		=> 'choice/radio_group',
			'select'			=> 'choice/select',

			'textarea'			=> 'input/textarea',

			'submit'			=> 'button/submit',
			'reset'				=> 'button/submit',

			'label'				=> 'html/label',
			'message'			=> 'html/message',

			'form'				=> 'form',
		),
	),
);