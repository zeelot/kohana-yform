<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

abstract class Yuriko_YForm_Element {

	/**
	 * The config options for this element.
	 */
	protected $_theme = 'default';
	protected $_view  = 'element';

	/**
	 * Label text for this element (not the i18n string)
	 *
	 * @var string
	 */
	protected $_has_label = TRUE;
	protected $_label;
	protected $_name;
	protected $_path;

	/**
	 * Values directly accessible by __get()
	 * The Element View will mostly be interested in these values
	 *
	 * @var array
	 */
	protected $_object = array();

	/**
	 * Attributes for this element
	 *
	 * @var array
	 */
	protected $_attributes = array
	(
		'class' => array(),
	);

	/**
	 * An array of messages organized into groups
	 *
	 * @var array
	 */
	protected $_messages = array();

	/**
	 * The settings element (usually YForm)
	 *
	 * @var object
	 */
	protected $_settings;

	public function __construct($name)
	{
		$this->_name = $name;

		$this->_path = preg_replace('#\[([^\[\]]++)\]#', '.\1', $name);
		if ($this->_has_label === TRUE)
		{
			$this->_label = $this->_path;
		}

		$this->set_attribute('name', $name);

		// Namespace the ID properly if the name is something like form[name]
		$id = preg_replace('#\[([^\[\]]++)\]#', '-\1', $name);
		$this->set_attribute('id', $id);
	}

	public function load_settings(YForm $settings)
	{
		// Store for later use
		$this->_settings = $settings;

		// Using the dot-notated path to grab the value
		if ($settings->get_value($this->_path))
		{
			$this->set_value($settings->get_value($this->_path));
		}

		// Using the dot-notated path to grab messages
		$this->_messages = Arr::merge($this->_messages, $settings->get_messages($this->_path, array()));

		return $this;
	}

	/**
	 * Appends classes to this object
	 *
	 * @param mixed $class
	 * @return self
	 */
	public function add_class($class)
	{
		$this->_attributes['class'] += (array)$class;

		return $this;
	}

	/**
	 * Sets a value in $_attributes. Can take an array of values
	 *
	 * @param   string|array  name of variable or an array of variables
	 * @param   mixed         value when using a named variable
	 * @return  object
	 */
	public function set_attribute($name, $value = NULL)
	{
		if (is_array($name))
		{
			foreach ($name as $key => $value)
			{
				$this->_attributes[$key] = $value;
			}
		}
		else
		{
			$this->_attributes[$name] = $value;
		}

		return $this;
	}

	/**
	 * Returns the element's attributes in an array.
	 *
	 * @return  array
	 */
	public function get_attributes()
	{
		$attributes = $this->_attributes;

		// Turn classes from arrays to strings
		if (empty($attributes['class']))
		{
			unset($attributes['class']);
		}
		else
		{
			$attributes['class'] = implode(' ', $attributes['class']);
		}

		return $attributes;
	}

	public function get_attribute($key, $default = FALSE)
	{
		return Arr::get($this->_attributes, $key, $default);
	}

	/**
	 * Sets a value in $_object
	 * @TODO: probably needs to do more
	 *
	 * @param   string|array  name of variable or an array of variables
	 * @param   mixed         value when using a named variable
	 * @return  object
	 */
	public function set($name, $value = NULL)
	{
		if (is_array($name))
		{
			foreach ($name as $key => $value)
			{
				$this->__set($key, $value);
			}
		}
		else
		{
			$this->__set($name, $value);
		}

		return $this;
	}

	/**
	 * Magically sets a value in $_object
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return self
	 */
	public function __set($key, $value)
	{
		$this->_object[$key] = $value;
	}

	/**
	 * Returns a value from $_object or $default if it is not set
	 *
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function get($key, $default = FALSE)
	{
		return Arr::get($this->_object, $key, $default);
	}

	/**
	 * Easy access to element properties
	 * @TODO: probably needs to do more
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function __get($key)
	{
		if (isset($this->_object[$key]))
		{
			return $this->_object[$key];
		}
		else
		{
			throw new Kohana_Exception('The :property property does not exist in the :class class',
				array(':property' => $key, ':class' => get_class($this)));
		}
	}

	public function set_config($name, $value)
	{
		if (is_array($name))
		{
			foreach ($name as $key => $value)
			{
				$this->_config[$key] = $value;
			}
		}
		else
		{
			$this->_config[$name] = $value;
		}

		return $this;
	}

	public function set_value($value)
	{
		$this->set_attribute('value', $value);

		return $this;
	}

	/**
	 * Adds a message to this element in the group specified in
	 * the YForm_Message object
	 *
	 * @param YForm_Message $message
	 * @return self
	 */
	public function add_message($group, $message)
	{
		$this->_messages[$group][] = $message;

		return $this;
	}

	/**
	 * Returns the messages in $group or $default if none are set
	 *
	 * @param string|array $groups
	 * @param mixed $default
	 * @return array
	 */
	public function get_messages()
	{
		return $this->_messages;
	}

	public function set_label($label)
	{
		$this->_label = $label;
		return $this;
	}

	public function get_label()
	{
		if ( ! $this->_has_label)
			return FALSE;

		if ($label = Kohana::message('yform/labels', $this->_label))
		{
			// Found the label defined in the most granular location
		}
		else
		{
			// Travel in towards to field to find the nearest match
			$segments = explode('.', $this->_label);
			// Already tried the full path, shift the first element out
			array_shift($segments);

			while (count($segments) > 0)
			{
				if ($label = Kohana::message('yform/labels', implode('.', $segments)))
					break;

				// Keep shifting the array until we run out of attempts
				array_shift($segments);
			}
		}

		// Return the possible match or the label (path) unmodified
		return $label ? $label : $this->_label;
	}

	public function __toString()
	{
		try
		{
			return $this->render();
		}
		catch (Exception $e)
		{
			// Display the exception message
			Kohana::exception_handler($e);

			return '';
		}
	}

	/**
	 * Renders the View for this element
	 *
	 * @return string
	 */
	public function render()
	{
		return View::factory($this->view())
			->set('object', $this)
			->set('attributes', $this->get_attributes())
			->set('messages', $this->get_messages())
			->set('label', $this->get_label())
			->render();
	}

	/**
	 * Returns the full path to the View file
	 *
	 * @return string
	 */
	public function view()
	{
		return 'yform/themes/'.$this->_theme.'/'.$this->_view;
	}

} // End Yuriko_YForm_Element
