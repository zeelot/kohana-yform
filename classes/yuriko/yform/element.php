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
	 *
	 * @var array
	 */
	protected $_config = array
	(
		'theme' => 'default',
		'view' => 'default',
	);

	/**
	 * Determines of an element has a label object automatically
	 * created in the constructor
	 *
	 * @var array
	 */
	protected $_has_label = TRUE;

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
		'id'    => array(),
		'class' => array(),
	);

	/**
	 * An array of YForm_Message objects organized into groups
	 *
	 * @var array
	 */
	protected $_messages = array();

	public function __construct($name)
	{
		$this->_object += array
		(
			'name' => $name,
		);

		$this->set_attribute('name', $name)
			->add_id($name);
	}

	public function load_settings(YForm $settings = NULL)
	{
		$this->set_config('view', $settings->view($this->element_name()))
			->set_config('theme', $settings->theme);

		if ($this->_has_label)
		{
			$this->label = $settings->label($this->name, $this->name);
		}

		return $this;
	}

	protected function element_name()
	{
		return strtolower(str_replace('YForm_Field_', '', get_class($this)));
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
	 * Appends IDs to this object
	 *
	 * @param mixed $id
	 * @return self
	 */
	public function add_id($id)
	{
		$this->_attributes['class'] += (array)$id;

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

		// Turn IDs and classes from arrays to strings
		if (empty($attributes['class']))
		{
			unset($attributes['class']);
		}
		else
		{
			$attributes['class'] = implode(' ', $attributes['class']);
		}
			
		if (empty($attributes['id']))
		{
			unset($attributes['id']);
		}
		else
		{
			$attributes['class'] = implode(' ', $attributes['class']);
		}

		return $attributes;
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
	public function add_message(YForm_Message $message)
	{
		$this->_messages[$message->group][] = $message;

		return $this;
	}

	/**
	 * Returns the YForm_Message objects in $group or $default if none are set
	 *
	 * @param string|array $groups
	 * @param mixed $default
	 * @return array
	 */
	public function get_messages()
	{
		return $this->_messages;
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
			->render();
	}

	/**
	 * Returns the full path to the View file
	 *
	 * @return string
	 */
	public function view()
	{
		return 'yform/themes/'.$this->_config['theme'].'/'.$this->_config['view'];
	}

} // End Yuriko_YForm_Element
