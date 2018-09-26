<?php
/**
 *
 * Custom CSS. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\customcss\acp;

/**
 * Custom CSS ACP module info.
 */
class main_info
{
	public function module()
	{
		return array(
			'filename'	=> '\phpbb\customcss\acp\main_module',
			'title'		=> 'ACP_PHPBB_CUSTOMCSS_TITLE',
			'modes'		=> array(
				'manage'	=> array(
					'title'	=> 'ACP_PHPBB_CUSTOMCSS_TITLE',
					'auth'	=> 'ext_phpbb/customcss && acl_a_board',
					'cat'	=> array('ACP_PHPBB_CUSTOMCSS_TITLE')
				),
			),
		);
	}
}
