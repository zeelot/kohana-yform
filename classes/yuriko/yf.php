<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Yuriko_YF {

	/**
	 * Factory method for YForm Elements
	 *
	 * @param string $element
	 * @param string $name
	 * @return class
	 */
	public static function element($element, $name)
	{
		$class = 'YForm_Element_'.ucfirst($element);

		return new $class($name);
	}

	/**
	 * Factory method for YForm Messages
	 *
	 * @param string $group
	 * @param string $text
	 * @return class
	 */
	public static function message($group, $text)
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
	public static function label($for, $text)
	{
		return new YForm_Label($for, $text);
	}

	/**
	 * Factory method for YForm Attributes
	 *
	 * @return class
	 */
	public static function attributes()
	{
		return new YForm_Attributes();
	}

	/**
	 * Factory method for YForm Settings
	 *
	 * @return class
	 */
	public static function settings()
	{
		return new YForm_Settings();
	}

} // End Yuriko_YF