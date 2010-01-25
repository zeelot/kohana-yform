<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

class Controller_YForm_Demo extends Controller_Yuriko_Template {

	public function action_payment()
	{
		$this->template->content =  View::factory('yform/demo/payment')
			->bind('post', $_POST)
			->bind('errors', $errors);
		$this->title = 'YForm Demo!';

		$errors = array
		(
			'last_name' => 'required',
		);

		$this->request->response = $this->template;
	}

}