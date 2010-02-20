<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Controller_YForm_Demo extends Controller_Yuriko_Template {

	public function action_index()
	{
		$view = $this->request->param('view');

		$this->template->content =  View::factory('yform/demo/'.$view)
			->bind('values', $_POST)
			->bind('errors', $errors);

		$this->title = 'YForm Demo!';

		$errors = array
		(
			'name' => 'This Field is Required!',
		);

		$this->request->response = $this->template;
	}

}