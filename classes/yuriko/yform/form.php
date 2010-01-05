<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Form extends YForm_Element {

	public function __construct($name)
	{
		parent::__construct($name);

		$this->attributes
			->set('method', 'POST')
			->set('action', Request::instance()->uri());
	}

	/**
	 * Factory method for YForm Elements
	 * This uses the form object to apply default settings to the elements
	 *
	 * @param string $element
	 * @param string $name
	 * @return class
	 */
	public function element($element, $name)
	{
		$class = 'YForm_'.ucfirst($element);

		return new $class($name);
	}

	public function open()
	{

	}

	public function close()
	{
		
	}
	
} // End Yuriko_YForm_Form