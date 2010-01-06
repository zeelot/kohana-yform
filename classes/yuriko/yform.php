<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

abstract class Yuriko_YForm {

	/**
	 * Values directly accessible by __get()
	 * The Element View will mostly be interested in these values
	 *
	 * @var array
	 */
	protected $_object = array();

	/**
	 * The directory path to the view
	 *
	 * @var string
	 */
	protected $_theme = 'yform/themes/default';

	/**
	 * The name of the View
	 *
	 * @var string
	 */
	protected $_filename;

	/**
	 * Sets the View to be the name of the element type
	 */
	public function  __construct()
	{
		$array = explode('_', get_class($this));
		$this->_filename = strtolower(array_pop($array));
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
				array(':property' => $column, ':class' => get_class($this)));
		}
	}

	/**
	 * Alias for set()
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return self
	 */
	public function __set($key, $value)
	{
		return $this->set($key, $value);
	}

	/**
	 * Renders the view
	 *
	 * @return string
	 */
	public function  __toString()
	{
		return $this->render();
	}

	/**
	 * Sets a value in $_object
	 * @TODO: probably needs to do more
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return self
	 */
	public function set($key, $value)
	{
		$this->_object[$key] = $value;

		return $this;
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
		return (isset($this->_object[$key]))? $this->$key : $default;
	}

	/**
	 * Returns the full path to the View file
	 *
	 * @return string
	 */
	public function view()
	{
		return $this->_theme.'/'.$this->_filename;
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

} // End Yuriko_YForm