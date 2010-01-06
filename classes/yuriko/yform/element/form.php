<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YForm_Element_Form extends YForm_Element {

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

	/**
	 * Factory method for YForm Messages
	 *
	 * @param string $group
	 * @param string $text
	 * @return class
	 */
	public function message($group, $text)
	{
		return new YForm_Message($group, $text);
	}

	/**
	 * Factory method for YForm Label
	 *
	 * @param string $for
	 * @param string $text
	 * @return class
	 */
	public function label($for, $text)
	{
		return new YForm_Label($for, $text);
	}

	/**
	 * Factory method for YForm Attributes
	 *
	 * @return class
	 */
	public function attributes()
	{
		return new YForm_Attributes();
	}

	/**
	 * Factory method for YForm Settings
	 *
	 * @return class
	 */
	public function settings()
	{
		return new YForm_Settings();
	}

	/**
	 * Factory method for YForm Elements
	 *
	 * @param string $method - Element type
	 * @param array $args - arguments to pass
	 */
	public function __call($method, array $args)
	{
		$class = 'YForm_Element_'.ucfirst($method);

		switch (count($args))
		{
			case 0:
				return new $class();
			break;
			case 1:
				return new $class($args[0]);
			break;
			case 2:
				return new $class($args[0], $args[1]);
			break;
			case 3:
				return new $class($args[0], $args[1], $args[2]);
			break;
			case 4:
				return new $class($args[0], $args[1], $args[2], $args[3]);
			break;
			default:
				// Here comes the snail...
				$object = new ReflectionClass($class);
				// use Reflection to create a new instance, using $args
				return $object->newInstanceArgs($args);
			break;
		}
	}

	public function open()
	{
		return View::factory($this->view())
			->set('object', $this)
			->set('open', TRUE)
			->render();
	}

	public function close()
	{
		return View::factory($this->view())
			->set('object', $this)
			->set('open', FALSE)
			->render();
	}

	public function render()
	{
		// alternate between open() and close()
		static $count = 0;
		$count++;

		if ($count % 2 === 1)
		{
			return $this->open();
		}
		else
		{
			return $this->close();
		}
	}
	
} // End Yuriko_YForm_Form