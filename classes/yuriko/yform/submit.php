<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Submit extends YForm_Element {

	public function __construct($name)
	{
		parent::__construct($name);

		$this->attributes->set('type', 'submit');
	}
	
} // End Yuriko_YForm_Submit