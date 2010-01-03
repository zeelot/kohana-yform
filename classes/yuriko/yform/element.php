<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

abstract class Yuriko_YForm_Element extends YForm {

	/**
	 * An array of YForm_Message objects organized into groups
	 *
	 * @var array
	 */
	protected $_messages = array();

	public function __construct($name)
	{
		parent::__construct();

		$this->name = $name;

		// create the default label element
		$this->label = YF::label($name, $name);

		// create the attributes object for this element
		$this->attributes = YF::attributes()
			->set('name', $name);
	}

	/**
	 * Loads the current element with defaults from a YForm_Settings object.
	 * This will override anything currently set in this element.
	 * @TODO: finish this, possibly needs to be abstracted.
	 *
	 * @param YForm_Settings $settings
	 * @return self
	 */
	public function load(YForm_Settings $settings)
	{
		if ($value = $settings->value($this->attributes->name))
		{
			$this->attributes->value = $value;
		}

		if ($theme = $settings->get('theme'))
		{
			$this->_theme = $theme;
		}

		foreach ($settings->messages($this->attributes->name, array()) as $group => $message)
		{
			$this->add_message(YF::message($group, $message));
		}

		return $this;
	}

	/**
	 * This is an alias for YForm_Attributes::set() which allows you
	 * to change element attributes by chaining the method calls onto
	 * the element itself.
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return self
	 */
	public function set_attribute($key, $value)
	{
		$this->attributes->set($key, $value);

		return $this;
	}

	/**
	 * Adds a message to this element in the group specified in
	 * the YForm_Message object
	 *
	 * @param YForm_Message $message
	 * @return self
	 */
	public function add_message(YForm_Message $message)
	{
		$this->_messages[$message->group][] = $message;

		return $this;
	}

	/**
	 * Returns the YForm_Message objects in $group or $default if none are set
	 *
	 * @param string $group
	 * @param mixed $default
	 * @return array
	 * @return mixed
	 */
	public function messages($group, $default = NULL)
	{
		if (isset($this->_messages[$group]))
		{
			return $this->_messages[$group];
		}

		return $default;
	}

	/**
	 * Returns an array of YForm_Message objects for this element
	 * Excludes any group specified in $exclude
	 *
	 * @param array $exclude
	 * @return array
	 */
	public function all_messages(array $exclude = NULL)
	{
		if ( ! $exclude)
		{
			return $this->_messages;
		}

		$keys = array_diff(array_keys($this->_messages), $exclude);

		$messages = array();
		foreach ($keys as $key)
		{
			$messages = array_merge($messages, $this->_messages[$key]);
		}

		return $messages;
	}

} // End Yuriko_YForm_Element