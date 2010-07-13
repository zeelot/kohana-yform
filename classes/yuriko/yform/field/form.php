<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */
class Yuriko_YForm_Field_Form extends YForm_Element {

	protected $_has_label = FALSE;

	protected $_view  = 'form';

	public function __construct($name)
	{
		parent::__construct($name);
	}
	
	
	/**
	 * Renders the view for opening a form
	 *
	 * @return string
	 */
	public function open($action = NULL, array $attributes = NULL)
	{
		if ($action === NULL)
		{
			// Use the current URI
			$action = Request::instance()->uri;
		}

		if ($action === '')
		{
			// Use only the base URI
			$action = Kohana::$base_url;
		}
		elseif (strpos($action, '://') === FALSE)
		{
			// Make the URI absolute
			$action = URL::site($action);
		}

		// Add the form action to the attributes
		$attributes['action'] = $action;

		// Only accept the default character set
		$attributes['accept-charset'] = Kohana::$charset;

		if ( ! isset($attributes['method']))
		{
			// Use POST method
			$attributes['method'] = 'post';
		}

		$attributes += $this->get_attributes();

		return View::factory($this->view())
			->set('object', $this)
			->set('attributes', $attributes)
			->set('open', TRUE)
			->render();
	}
	
	public function open_multipart($action = NULL, array $attributes = NULL)
	{
		// Set multi-part form type
		$attributes['enctype'] = 'multipart/form-data';

		return $this->open($action, $attributes);
	}
	
	/**
	 * Renders the view for closing a form
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
	
} // End Yuriko_YForm_Field_Form
