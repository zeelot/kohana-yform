<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Attributes {

	protected $_object = array();

	public static function factory()
	{
		return new self();
	}

	/**
	 * Returns a string of attributes
	 * Also takes care of turning an array of ids and classes into strings
	 *
	 * @return string
	 */
	public function  __toString()
	{
		return $this->render();
	}

	/**
	 * Appends classes to this object
	 *
	 * @param mixed $class
	 * @return self
	 */
	public function add_class($class)
	{
		$this->_object['class'] = $this->get('class', array()) + (array)$class;

		return $this;
	}

	/**
	 * Appends ids to this object
	 *
	 * @param mixed $id
	 * @return self
	 */
	public function add_id($id)
	{
		$this->_object['id'] = $this->get('id', array()) + (array)$id;

		return $this;
	}

	/**
	 * Easy access to attributes
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

	public function as_array()
	{
		$attributes = $this->_object;

		// turn id and class from arrays to strings
		if ($this->get('class'))
		{
			$attributes['class'] = implode(' ', $this->class);
		}
		if ($this->get('id'))
		{
			$attributes['id'] = implode(' ', $this->id);
		}

		return $attributes;
	}

	public function render()
	{
		$attributes = $this->_object;

		// turn id and class from arrays to strings
		if ($this->get('class'))
		{
			$attributes['class'] = implode(' ', $this->class);
		}
		if ($this->get('id'))
		{
			$attributes['id'] = implode(' ', $this->id);
		}
		
		return html::attributes($attributes);
	}

} // End Yuriko_YForm_Attributes