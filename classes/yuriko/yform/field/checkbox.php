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
	
} // End Yuriko_YForm_Field_Text