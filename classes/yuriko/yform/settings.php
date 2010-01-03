<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Settings {

	/**
	 * @TODO: clean this up
	 *
	 * @var array
	 */
	protected $_settings = array
	(
		'values' => array(),
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

	/**
	 * Returns a specific setting or $default if it is not set
	 *
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function get($key, $default = FALSE)
	{
		if (isset($this->_settings[$key]))
		{
			return $this->_settings[$key];
		}

		return $default;
	}

	/**
	 * Returns a value for a specific element or $default if it is not set
	 *
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function value($key, $default = FALSE)
	{
		if (isset($this->_settings['value'][$key]))
		{
			return $this->_settings['value'][$key];
		}

		return $default;
	}

	/**
	 * Merges arrays into the values array
	 *
	 * ex: set_values($_POST, $user->as_array())
	 *
	 * @param array $args
	 * @return self
	 */
	public function set_values()
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

	/**
	 * Changes the theme for a form (no trailing slash)
	 *
	 * ex: set_theme('yform/themes/pretty')
	 *
	 * @param string $theme
	 * @return self
	 */
	public function set_theme($theme)
	{
		$this->_settings['theme'] = $theme;

		return $this;
	}

	/**
	 * Adds an array of messages into a specific group
	 * 
	 * ex: add_messages('error', (array)$errors)
	 *
	 * @param string $group
	 * @param array $messages
	 * @return self
	 */
	public function add_messages($group, array $messages)
	{
		foreach ($messages as $field => $message)
		{
			$this->_messages[$field][$group] = $message;
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
	public function messages($field, $default = FALSE)
	{
		if (isset($this->_messages[$field]))
		{
			return $this->_messages[$field];
		}

		return $default;
	}

} // End Yuriko_YForm_Settings