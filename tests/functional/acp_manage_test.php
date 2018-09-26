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
class acp_manage_test extends functional_base
{
	/**
	* Test that Custom CSS ACP module appears
	*/
	public function test_acp_manage_module()
	{
		// Load Custom CSS ACP page
		$crawler = $this->get_manage_page();

		// Assert Custom CSS module appears in sidebar
		$this->assertContainsLang('ACP_PHPBB_CUSTOMCSS_TITLE', $crawler->filter('.menu-block')->text());
		$this->assertContainsLang('ACP_PHPBB_CUSTOMCSS_TITLE', $crawler->filter('#activemenu')->text());

		// Assert Custom CSS display appears
		$this->assertContainsLang('CUSTOM_CSS', $crawler->filter('#main')->text());
	}

	/**
	* Test Custom CSS ACP submit
	*/
	public function test_acp_submit()
	{
		// Load Custom CSS ACP page
		$crawler = $this->get_manage_page();

		// Jump to the add page
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$form_data = [
			'custom_css' => '.custom_css{display: block;}',
		];
		$crawler = self::submit($form, $form_data);
		$this->assertContains('.custom_css{display: block;}', $crawler->filter('#custom_css')->text());
	}

	protected function get_manage_page()
	{
		return self::request('GET', "adm/index.php?i=-phpbb-customcss-acp-main_module&mode=manage&sid={$this->sid}");
	}
}
