<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */
class Yuriko_YForm_Field_CheckboxGroup extends YForm_Field_Group {

	protected $_has_label = TRUE;

	protected $_view = 'choice/checkboxGroup';

	protected $_options = array();

	protected $_settings;

	public function __construct($name)
	{
		parent::__construct($name);
	}

	public function add_options(array $options)
	{
		foreach ($options as $value => $name)
		{
			$this->_options[$value] = $this->checkbox($value)
				->set_label($name);
		}
		return $this;
	}

	public function options()
	{
		return $this->_options;
	}
} // End Yuriko_YForm_Field_Text
