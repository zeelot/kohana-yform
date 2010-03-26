<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Label extends YForm_Element {

	protected $_has_label = FALSE;

	public function __construct($for, $text)
	{
		$this->_object += array
		(
			'text' => $text,
		);

		$this->set_attribute('for', $for);
	}

	protected function element_name()
	{
		return strtolower(str_replace('YForm_', '', get_class($this)));
	}

} // End Yuriko_YForm_Label
