<?php
/**
 *
 * Custom CSS. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\customcss\tests\functional;

/**
* @group functional
*/
class functional_base extends \phpbb_functional_test_case
{
	/**
	* {@inheritDoc}
	*/
	protected static function setup_extensions()
	{
		return array('phpbb/customcss');
	}

	/**
	* {@inheritDoc}
	*/
	public function setUp()
	{
		parent::setUp();

		$this->add_lang_ext('phpbb/customcss', array(
			'acp',
			'info_acp_phpbb_customcss',
		));

		$this->login();
		$this->admin_login();
	}
}
