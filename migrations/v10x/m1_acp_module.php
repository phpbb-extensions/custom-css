<?php
/**
 *
 * Custom CSS. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\customcss\migrations\v10x;

/**
* Migration stage 1: ACP Module
*/
class m1_acp_module extends \phpbb\db\migration\migration
{
	/**
	 * {@inheritDoc}
	 */
	public function effectively_installed()
	{
		$sql = 'SELECT module_id
			FROM ' . $this->table_prefix . "modules
			WHERE module_class = 'acp'
				AND module_langname = 'ACP_PHPBB_CUSTOMCSS_TITLE'";
		$result = $this->db->sql_query($sql);
		$module_id = (int) $this->db->sql_fetchfield('module_id');
		$this->db->sql_freeresult($result);
		return $module_id;
	}

	/**
	 * {@inheritDoc}
	 */
	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v320\v320'];
	}

	/**
	 * Add the ACP module
	 *
	 * @return array Array of data update instructions
	 */
	public function update_data()
	{
		return [
			['module.add', [
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_PHPBB_CUSTOMCSS_TITLE'
			]],
			['module.add', [
				'acp',
				'ACP_PHPBB_CUSTOMCSS_TITLE',
				[
					'module_basename'	=> '\phpbb\customcss\acp\main_module',
					'modes'				=> ['manage'],
				],
			]],
		];
	}
}
