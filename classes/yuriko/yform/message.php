<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Message extends YForm {

	public function __construct($group, $text)
	{
		parent::__construct();
		
		$this->group = $group;
		
		$this->text = $text;
	}

} // End Yuriko_YForm_Message