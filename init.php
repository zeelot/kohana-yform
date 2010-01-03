<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * @package    YurikoCMS
 * @author     Lorenzo Pisani - Zeelot
 * @copyright  (c) 2008-2010 Lorenzo Pisani
 * @license    http://yurikocms.com/license
 */

Route::set('yform', 'yform(/<controller>(/<action>))')
	->defaults(array(
		'controller' => 'demo',
		'action'     => 'index',
		'directory'  => 'yform',
	));