<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */
class Yuriko_YForm_Field_Textarea extends YForm_Element {

	protected $_view = 'input/textarea';

	public function __construct($name)
	{
		parent::__construct($name);

		$this->set_attribute('type', 'textarea');
	}
	
	public function render()
	{
		// Make the value available in $object->value
		$this->value = $this->get_attribute('value', '');
		
		// Remove the value from the attributes
		unset($this->_attributes['value']);
		
		return parent::render();
	}
	
} // End Yuriko_YForm_Field_Textarea
