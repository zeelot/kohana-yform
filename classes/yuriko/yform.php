<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm {

	/**
	 * Settings for elements created by this object
	 *
	 * @var array
	 */
	protected $_settings = array();

	/**
	 * Array of message strings organized into the element name they belong to
	 * and in the group they were added as
	 *
	 * ex: $_messages['first_name']['error'] = 'required'
	 *
	 * @var array
	 */
	protected $_messages = array();

	/**
	 * Values for elements created by this object
	 *
	 * @var array
	 */
	protected $_values = array();

	/**
	 * The main Form element for this form
	 *
	 * @var object
	 */
	protected $_form;

	public static function factory($name = NULL, $group = 'default')
	{
		return new YForm($name, $group);
	}

	public function __construct($name = NULL, $group = 'default')
	{
		$config = Kohana::config('yform.'.$group);
		$this->_settings = array_merge($this->_settings, $config);

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

		$class = new ReflectionClass($element);

		$instance = $class->newInstanceArgs($args);

		// Load settings from this form object
		$instance->load_settings($this);

		return $instance;
	}

	/**
	 * Adds an array of messages into a specific group
	 *
	 * ex: add_messages('error', (array)$errors)
	 *
	 * @param string $group
	 * @param array $messages
	 * @return object
	 */
	public function add_messages($group, array $messages)
	{
		foreach ($messages as $field => $message)
		{
			$this->_messages[$field][$group][] = $message;
		}

		return $this;
	}

	/**
	 * Returns all the messages for a field or $default if it is not set
	 *
	 * @param string $field
	 * @param mixed $default
	 * @return mixed
	 */
	public function get_messages($field, $default = FALSE)
	{
		return Arr::get($this->_messages, $field, $default);
	}

	/**
	 * Merges arrays into the values array
	 *
	 * ex: add_values($_POST, $user->as_array())
	 *
	 * @param array $args
	 * @return object
	 */
	public function add_values()
	{
		$args = func_get_args();

		foreach ($args as $array)
		{
			$this->_values = array_merge($this->_values, $array);
		}

		return $this;
	}

	/**
	 * Returns the value for a field or $default if it is not set
	 *
	 * @param string $field
	 * @param mixed $default
	 * @return mixed
	 */
	public function get_value($field, $default = FALSE)
	{
		return Arr::get($this->_values, $field, $default);
	}

	/**
	 * Returns the path to the view in the current theme (defined by settings)
	 *
	 * @param string $element - the element name
	 * @return string
	 */
	public function view($element)
	{
		return $this->_settings['views'][$element];
	}

	/**
	 * Sets a value into the _settings array
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return void
	 */
	public function __set($key, $value)
	{
		$this->_settings[$key] = $value;
	}

	/**
	 * Sets a value into the _settings array
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return self
	 */
	public function set($key, $value)
	{
		$this->__set($key, $value);

		return $this;
	}

	/**
	 * Returns a value from the _settings araay
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function __get($key)
	{
		return $this->_settings[$key];
	}

	/**
	 * Renders the view for opening a form
	 *
	 * @return View
	 */
	public function open($action = NULL, array $attributes = array())
	{
		return $this->_form->open($action, $attributes);
	}

	/**
	 * Renders the view for opening a form (with the multipart attribute)
	 *
	 * @return View
	 */
	public function open_multipart($action = NULL, array $attributes = array())
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
