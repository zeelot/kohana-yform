<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Settings {

	protected $_settings = array
	(
		'theme'		=> 'default',
		'values'	=> array(),
	);

	/**
	 * Array of message strings organized into the element name they belong to
	 * and in the group they were added as
	 *
	 * ex: $_messages['first_name']['error'] = 'required'
	 *
	 * @var array
	 */
	protected $_messages = array();

	public static function factory($group = 'default')
	{
		return new self($group);
	}

	public function __construct($group = 'default')
	{
		$config = Kohana::config('yform.'.$group);
		$this->_settings = array_merge($this->_settings, $config);
	}

	public function __get($key)
	{
		return $this->_settings[$key];
	}

	public function __set($key, $value)
	{
		$this->_settings[$key] = $value;
	}

	public function set($key, $value)
	{
		$this->__set($key, $value);

		return $this;
	}

	/**
	 * Merges arrays into the values array
	 *
	 * ex: set_values($_POST, $user->as_array())
	 *
	 * @param array $args
	 * @return object
	 */
	public function values()
	{
		$args = func_get_args();

		foreach ($args as $array)
		{
			if (is_array($array))
			{
				$this->_settings['values'] = array_merge($this->_settings['values'], $array);
			}
		}

		return $this;
	}
	
	public function value($field)
	{
		if (isset($this->_settings['values'][$field]))
		{
			return $this->_settings['values'][$field];
		}
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
			$this->_messages[$field][$group] = $message;
		}

		return $this;
	}

	public function view($element)
	{
		return $this->_settings['views'][$element];
	}

	/**
	 * Returns all the messages for a field or $default if it is not set
	 *
	 * @param string $field
	 * @param mixed $default
	 * @return mixed
	 */
	public function messages($field, $default = FALSE)
	{
		if (isset($this->_messages[$field]))
		{
			return $this->_messages[$field];
		}

		return $default;
	}

} // End Yuriko_YForm_Settings