<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */
class Yuriko_YForm_Field_Hidden extends YForm_Element {

	protected $_has_label = FALSE;

	protected $_view = 'input/hidden';

	public function __construct($name, $value)
	{
		parent::__construct($name);

		$this->set_attribute('type', 'hidden')
			->set_value($value);
	}
	
} // End Yuriko_YForm_Field_Hidden
