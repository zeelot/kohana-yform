<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Field_Checkbox extends YForm_Element {

	public function __construct(YForm_Settings $settings, $name)
	{
		parent::__construct($settings, $name);

		$this->attributes->set('type', 'checkbox');
	}

	/**
	 * Overwrites this method to check the box if $value is anything but NULL
	 *
	 * @param mixed $value
	 * @return self
	 */
	public function set_value($value)
	{
		if ($value !== NULL)
		{
			$this->attributes->set('checked', 'checked');
		}

		return $this;
	}
	
} // End Yuriko_YForm_Field_Text