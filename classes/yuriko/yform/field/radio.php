<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */
class Yuriko_YForm_Field_Radio extends YForm_Element {

	protected $_view = 'input/radio';

	public function __construct($name, $value)
	{
		parent::__construct($name);

		$this->set_attribute('type', 'radio')
			->set_attribute('value', $value)
			->set_attribute('id', $this->get_attribute('id').'_'.$value);
	}

	/**
	 * Overwrites this method to check the box if $value is anything but NULL
	 *
	 * @param mixed $value
	 * @return self
	 */
	public function set_value($value)
	{
		$this_radio = $this->get_attribute('value', NULL);

		if ($this_radio AND (string)$value === (string)$this_radio)
		{
			$this->set_attribute('checked', 'checked');
		}

		return $this;
	}
	
} // End Yuriko_YForm_Field_Text
