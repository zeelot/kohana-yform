<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */
class Yuriko_YForm_Field_Group extends YForm_Element {

	protected $_has_label = FALSE;

	protected $_view  = 'group';

	/**
	 * Returns an instance of an element
	 * Uses the YForm instance set in the settings
	 * Will prepend the name of this group
	 * ex: user[username] when this group is called `user` and the field is called `username`
	 *
	 * @param string $method
	 * @param array $args
	 * @return object
	 */
	public function __call($method, $args)
	{
		// Element name is always first
		$name = array_shift($args);

		if (preg_match('#\[([^\[\]]++)\]#', $name))
		{
			// This already has brackets so we want foo[bar][moo] not foo[bar[moo]]
			$pos = strpos($name, '[');
			$name = $this->_name.'['.substr($name, 0, $pos).']'.substr($name, $pos);
		}
		else
		{
			$name = $this->_name.'['.$name.']';
		}

		// Push the new name back onto the front of $args
		array_unshift($args, $name);

		return ($this->_settings !== NULL)
			// Use the above settings object to create our element
			? $this->_settings->__call($method, $args)
			// We are creating elements without a form object
			: YForm::create_element($method, $args);
	}

	/**
	 * Renders the view for opening a form group
	 *
	 * @return string
	 */
	public function open($action = NULL, array $attributes = NULL)
	{
		return View::factory($this->view())
			->set('object', $this)
			->set('attributes', $attributes)
			->set('open', TRUE)
			->render();
	}

	/**
	 * Renders the view for closing a form group
	 *
	 * @return string
	 */
	public function close()
	{
		return View::factory($this->view())
			->set('object', $this)
			->set('open', FALSE)
			->render();
	}
} // End Yuriko_YForm_Field_Group
