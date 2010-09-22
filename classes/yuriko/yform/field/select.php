<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */
class Yuriko_YForm_Field_Select extends YForm_Element {

	protected $_has_label = TRUE;

	protected $_view = 'choice/select';

	protected $_options = array();
	protected $_option_attributes = array();

	protected $_settings;

	public function __construct($name)
	{
		parent::__construct($name);
	}

	public function add_option($value, $name, array $attributes = array())
	{
		$this->_options[$value] = $name;
		$this->_option_attributes[$value] = $attributes;

		return $this;
	}

	public function add_options(array $options)
	{
		foreach ($options as $value => $name)
		{
			$this->add_option($value, $name);
		}
		return $this;
	}

	public function options()
	{
		return $this->_options;
	}

	public function option_attributes($value)
	{
		return Arr::get($this->_option_attributes, $value, array());
	}
} // End Yuriko_YForm_Field_Select
