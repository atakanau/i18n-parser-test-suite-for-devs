<?php
/**
 * Admin page UI handler.
 *
 * @package I18n_Parser_Test_Suite_For_Devs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class I18n_Parser_Test_Suite_Admin_Page
 */
class I18n_Parser_Test_Suite_Admin_Page {

	/**
	 * Register the management page under Tools.
	 *
	 * @return void
	 */
	public function register(): void {
		add_management_page(
			__( 'i18n Parser Test Suite', 'i18n-parser-test-suite-for-devs' ),
			__( 'i18n Parser Tests', 'i18n-parser-test-suite-for-devs' ),
			'manage_options',
			'i18n-parser-test-suite-for-devs',
			array( $this, 'render' )
		);
	}

	/**
	 * Render the admin page.
	 *
	 * @return void
	 */
	public function render(): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$runner    = new I18n_Parser_Test_Suite_Test_Runner();
		$raw_run   = $runner->run();
		
		$formatter = new I18n_Parser_Test_Suite_Result_Formatter();
		$results   = $formatter->format( $raw_run );

		include I18N_PARSER_TEST_SUITE_PATH . 'templates/admin-page.php';
	}
}