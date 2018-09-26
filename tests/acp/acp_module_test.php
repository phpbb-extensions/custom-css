<?php
/**
 *
 * Custom CSS. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

require_once __DIR__ . '/../../../../../includes/functions_module.php';

class acp_module_test extends \phpbb_test_case
{
	/** @var \phpbb_mock_extension_manager */
	protected $extension_manager;

	/** @var \phpbb\module\module_manager */
	protected $module_manager;

	public function setUp()
	{
		global $phpbb_dispatcher, $phpbb_extension_manager, $phpbb_root_path, $phpEx;

		$this->extension_manager = new \phpbb_mock_extension_manager(
			$phpbb_root_path,
			array(
				'phpbb/customcss' => array(
					'ext_name' => 'phpbb/customcss',
					'ext_active' => '1',
					'ext_path' => 'ext/phpbb/customcss/',
				),
			));
		$phpbb_extension_manager = $this->extension_manager;

		$this->module_manager = new \phpbb\module\module_manager(
			new \phpbb\cache\driver\dummy(),
			$this->getMockBuilder('\phpbb\db\driver\driver_interface')->getMock(),
			$this->extension_manager,
			MODULES_TABLE,
			$phpbb_root_path,
			$phpEx
		);

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
	}

	public function test_module_info()
	{
		$this->assertEquals(array(
			'\\phpbb\\customcss\\acp\\main_module' => array(
				'filename'	=> '\\phpbb\\customcss\\acp\\main_module',
				'title'		=> 'ACP_PHPBB_CUSTOMCSS_TITLE',
				'modes'		=> array(
					'manage'	=> array(
						'title'	=> 'ACP_PHPBB_CUSTOMCSS_TITLE',
						'auth'	=> 'ext_phpbb/customcss && acl_a_board',
						'cat'	=> array('ACP_PHPBB_CUSTOMCSS_TITLE')
					),
				),
			),
		), $this->module_manager->get_module_infos('acp', 'acp_main_module'));
	}

	public function module_auth_test_data()
	{
		return array(
			// module_auth, expected result
			array('ext_foo/bar', false),
			array('ext_phpbb/customcss', true),
		);
	}

	/**
	 * @dataProvider module_auth_test_data
	 */
	public function test_module_auth($module_auth, $expected)
	{
		$this->assertEquals($expected, p_master::module_auth($module_auth, 0));
	}

	public function main_module_test_data()
	{
		return [
			[false],
			[true],
		];
	}

	/**
	 * @dataProvider main_module_test_data
	 */
	public function test_main_module($submit)
	{
		global $request, $template, $phpbb_container;

		define('IN_ADMIN', true);
		$language = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$request = $this->getMockBuilder('\phpbb\request\request')
			->disableOriginalConstructor()
			->getMock();
		$template = $this->getMockBuilder('\phpbb\template\template')
			->disableOriginalConstructor()
			->getMock();
		$config = $this->getMockBuilder('\phpbb\config\config')
			->disableOriginalConstructor()
			->getMock();
		$phpbb_container = new phpbb_mock_container_builder();
		$phpbb_container->set('language', $language);
		$phpbb_container->set('request', $request);
		$phpbb_container->set('template', $template);
		$phpbb_container->set('config', $config);
		$phpbb_container->setParameter('core.root_path', '');

		$language->expects($this->once())
			->method('add_lang')
			->with('acp', 'phpbb/customcss');

		$request->expects($this->once())
			->method('is_set_post')
			->with('submit')
			->willReturn($submit);
		
		$config->expects($submit ? $this->once() : $this->never())
			->method('increment')
			->with('assets_version', 1);
		
		$template->expects($this->once())
			->method('assign_vars')
			->with([
				'U_ACTION'		=> '',
				'CUSTOM_CSS'	=> '',
			]);

		// mock get_custom_css() and put_custom_css() to avoid file_*_contents() calls
		$acp_module = $this->getMockBuilder('\phpbb\customcss\acp\main_module')
			->setMethods(['get_custom_css', 'put_custom_css'])
			->getMock();
		$acp_module->main();
	}
}
