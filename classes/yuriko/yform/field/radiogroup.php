<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Field_RadioGroup extends YForm_Element {

	protected $_options = array();

	protected $_settings;

	public function __construct($name)
	{
		parent::__construct($name);
	}

	/**
	 * Overwrites this method to check the box if $value is anything but NULL
	 *
	 * @param mixed $value
	 * @return self
	 */
	public function set_value($value)
	{
		

		return $this;
	}

	public function add_options(array $options)
	{
		foreach ($options as $value => $name)
		{
			$this->_options[$value] = new YForm_Field_Radio($this->_settings, $name, $value);
		}

		return $this;
	}

	public function options()
	{
		return $this->_options;
	}
	
} // End Yuriko_YForm_Field_Text
