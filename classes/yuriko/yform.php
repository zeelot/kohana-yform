<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm extends YForm_Element {

	/**
	 * Settings object for elements created by this object
	 *
	 * @var array
	 */
	protected $_settings;

	public function __construct($name = NULL, YForm_Settings $settings = NULL)
	{
		$this->_settings = ($settings)? $settings : new YForm_Settings();

		parent::__construct($this->_settings, $name);
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
		if ($action === NULL)
		{
			// Use the current URI
			$action = Request::instance()->uri;
		}

		if ($action === '')
		{
			// Use only the base URI
			$action = Kohana::$base_url;
		}
		elseif (strpos($action, '://') === FALSE)
		{
			// Make the URI absolute
			$action = URL::site($action);
		}

		// Add the form action to the attributes
		$attributes['action'] = $action;

		// Only accept the default character set
		$attributes['accept-charset'] = Kohana::$charset;

		if ( ! isset($attributes['method']))
		{
			// Use POST method
			$attributes['method'] = 'post';
		}

		$attributes += $this->attributes->as_array();

		return View::factory($this->view())
			->set('object', $this)
			->set('attributes', $attributes)
			->set('open', TRUE)
			->render();
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
		return View::factory($this->view())
			->set('object', $this)
			->set('open', FALSE)
			->render();
	}

} // End Yuriko_YForm