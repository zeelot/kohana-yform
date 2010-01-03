<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Attributes extends YForm {

	/**
	 * Returns a string of attributes
	 * Also takes care of turning an array of ids and classes into strings
	 *
	 * @return string
	 */
	public function  __toString()
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

	/**
	 * Appends classes to this object
	 *
	 * @param mixed $class
	 * @return self
	 */
	public function add_class($class)
	{
		$this->class = array_merge($this->class, (array)$class);

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
		$this->id = array_merge($this->id, (array)$id);

		return $this;
	}

} // End Yuriko_YForm_Attributes