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
class frontend_test extends functional_base
{
	public function test_custom_css_is_present()
	{
		// Confirm custom CSS file is present
		$crawler = self::request('GET', 'index.php');
		$this->assertContains('phpbb/customcss/styles/all/theme/custom.css', $crawler->filter('head')->html());
	}
}
