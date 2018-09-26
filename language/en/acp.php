<?php
/**
 *
 * Custom CSS. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_PHPBB_CUSTOMCSS_EXPLAIN'	=> 'Here you can directly edit CSS file that is loaded on every page. Most users use this to do small edits to the styles without loosing the changes after updating.',
	'CUSTOM_CSS'					=> 'Custom CSS',
	'CUSTOM_CSS_EXPLAIN'			=> 'Type your CSS here. We will take care that changes are loaded in your user browsers immediately.',
));
