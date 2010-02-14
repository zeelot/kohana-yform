<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm {

	/**
	 * Settings object for elements created by this object
	 *
	 * @var array
	 */
	protected $_settings;
	
	/**
	 * The main Form element for this form
	 *
	 * @var object
	 */
	protected $_form;

	public function __construct($name = NULL, YForm_Settings $settings = NULL)
	{
		$this->_settings = ($settings)? $settings : new YForm_Settings();

		$this->_form = $this->form($name);
	}

	/**
	 * Returns an instance of an element
	 *
	 * @param string $method
	 * @param array $args
	 * @return object
	 */
	public function __call($method, $args)
	{
		$element = 'YForm_Field_'.ucfirst($method);

		$args = (array)$args;

		// add settings object as first parameter
		array_unshift($args, $this->_settings);

		$class = new ReflectionClass($element);

		$instance = $class->newInstanceArgs($args);

		return $instance;
	}

	public function message($group, $text)
	{
		return new YForm_Message($group, $text);
	}
	
	public function values(array $values)
	{
		$this->_settings->values($values);
		
		return $this;
	}

	public static function factory($name = NULL, YForm_Settings $settings = NULL)
	{
		return new YForm($name, $settings);
	}

	/**
	 * Renders the view for opening a form
	 *
	 * @return string
	 */
	public function open($action = NULL, array $attributes = NULL)
	{
		return $this->_form->open($action, $attributes);
	}

	public function open_multipart($action = NULL, array $attributes = NULL)
	{
		// Set multi-part form type
		$attributes['enctype'] = 'multipart/form-data';

		return $this->open($action, $attributes);
	}

	/**
	 * Renders the view for closing a form
	 *
	 * @return string
	 */
	public function close()
	{
		return $this->_form->close();
	}

} // End Yuriko_YForm