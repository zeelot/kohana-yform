<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Message extends YForm_Element {

	public function __construct($group, $text, YForm_Settings $settings = NULL)
	{
		($settings === NULL) AND $settings = new YForm_Settings();

		parent::__construct($settings, $group);
		
		$this->group = $group;
		
		$this->text = $text;
	}

} // End Yuriko_YForm_Message