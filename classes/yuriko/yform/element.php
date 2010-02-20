<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

abstract class Yuriko_YForm_Element {

	protected $_config = array();
	
	
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
	 * An array of YForm_Message objects organized into groups
	 *
	 * @var array
	 */
	protected $_messages = array();

	public function __construct(YForm_Settings $settings, $name)
	{
		$this->_object += array
		(
			'name'			=> $name,
			// create the attributes object for this element
			'attributes'	=> YForm_Attributes::factory()
				->set('name', $name)
				->add_id($name),
		);
		
		if ($this->_has_label)
		{
			$this->_object += array
			(
				'label'		=> new YForm_Label($settings, $name, Kohana::message('yform', 'labels.'.$name, $name)),
			);
		}
		
		$type = strtolower(str_replace(array
		(
			'YForm_Field_',
			'YForm_',
		), '', get_class($this)));

		$this->_config += array
		(
			'theme'		=> $settings->theme,
			'view'		=> $settings->view($type),
		);

		$this->set_value($settings->value($name));

		$this->_messages = $settings->messages($name, array());
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

	public function config($name, $value)
	{
		$this->_config[$name] = $value;

		return $this;
	}
	
	public function configs(array $configs)
	{
		foreach ($configs as $key => $value)
		{
			$this->_config[$key] = $value;
		}
	}

	/**
	 * This is an alias for YForm_Attributes::set() which allows you
	 * to change element attributes by chaining the method calls onto
	 * the element itself.
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return self
	 */
	public function attribute($key, $value)
	{
		$this->attributes->set($key, $value);

		return $this;
	}
	
	public function attributes(array $attributes)
	{
		foreach ($attributes as $key => $value)
		{
			$this->attributes->set($key, $value);
		}

		return $this;
	}

	public function set_value($value)
	{
		$this->attributes->set('value', $value);

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
	public function messages($groups, $default = NULL)
	{
		if (is_array($groups))
		{
			$messages = array();

			foreach ($groups as $group)
			{
				if (isset($this->_messages[$group]))
				{
					$messages = $this->_messages[$group];
				}
			}

			return (empty($messages))? $default : $messages ;
		}

		return Arr::get($this->_messages, $groups, $default);
	}

	/**
	 * Returns an array of YForm_Message objects for this element
	 * Excludes any group specified in $exclude
	 *
	 * @param array $exclude
	 * @return array
	 */
	public function messages_exclude(array $exclude = NULL)
	{
		if ( ! $exclude)
		{
			return $this->_messages;
		}

		$keys = array_diff(array_keys($this->_messages), $exclude);

		$messages = array();

		foreach ($keys as $key)
		{
			$messages = array_merge($messages, $this->_messages[$key]);
		}

		return $messages;
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