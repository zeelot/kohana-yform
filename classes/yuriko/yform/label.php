<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Label extends YForm_Element {

	public function __construct(YForm_Settings $settings, $for, $text)
	{		
		$this->_object += array
		(
			'text'			=> $text,
			// create the attributes object for this element
			'attributes'	=> YForm_Attributes::factory()
				->set('for', $for),
		);

		$this->_options += array
		(
			'theme'		=> $settings->theme,
			'view'		=> $settings->view(strtolower(str_replace('YForm_', '', get_class($this)))),
		);
	}

} // End Yuriko_YForm_Label