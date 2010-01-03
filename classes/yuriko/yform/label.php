<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Label extends YForm {

	public function __construct($for, $text)
	{
		parent::__construct();
		
		$this->text = $text;

		// create the attributes object for this element
		$this->attributes = YF::attributes()
			->set('for', $for);
	}

} // End Yuriko_YForm_Label