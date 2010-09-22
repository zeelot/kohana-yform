<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */
class Yuriko_YForm_Field_Reset extends YForm_Element {

	protected $_view = 'button/reset';

	public function __construct($name)
	{
		parent::__construct($name);

		$this->set_attribute('type', 'reset');
	}
	
} // End Yuriko_YForm_Field_Reset
