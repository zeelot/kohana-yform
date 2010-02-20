<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Field_Radio extends YForm_Element {

	public function __construct(YForm_Settings $settings, $name, $value)
	{
		parent::__construct($settings, $name);

		$this->attributes
			->set('type', 'radio')
			->set('value', $value)
			->set('id', array($name.'_'.$value));

		$this->label
			->set('text', Kohana::message('yform', 'labels.'.$value, $value))
			->attributes
				->set('for', $name.'_'.$value);

		$this->set_value($settings->value($name));
	}

	/**
	 * Overwrites this method to check the box if $value is anything but NULL
	 *
	 * @param mixed $value
	 * @return self
	 */
	public function set_value($value)
	{
		$this_radio = $this->attributes->get('value', NULL);

		if ($this_radio AND $value === $this_radio)
		{
			$this->attributes->set('checked', 'checked');
		}

		return $this;
	}
	
} // End Yuriko_YForm_Field_Text