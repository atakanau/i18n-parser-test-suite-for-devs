<?php

/**
 * Core plugin orchestrator.
 *
 * @package I18n_Parser_Test_Suite_For_Devs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class I18n_Parser_Test_Suite_Core
 */
class I18n_Parser_Test_Suite_Core {

	/**
	 * Singleton instance.
	 *
	 * @var I18n_Parser_Test_Suite_Core|null
	 */
	private static ?I18n_Parser_Test_Suite_Core $instance = null;

	/**
	 * Get singleton instance.
	 *
	 * @return I18n_Parser_Test_Suite_Core
	 */
	public static function get_instance(): I18n_Parser_Test_Suite_Core {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Private constructor to prevent direct instantiation.
	 */
	private function __construct() {}

	/**
	 * Boot the plugin safely by hooking into WordPress lifecycle.
	 *
	 * @return void
	 */
	public function boot(): void {
		$this->load_dependencies();

		// Hook text domain loading and admin UI strictly to init/admin_menu 
		// to prevent WP 6.7+ _load_textdomain_just_in_time errors.
		add_action( 'init', array( $this, 'load_textdomain' ) );
		add_action( 'admin_menu', array( $this, 'register_admin' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
	}

	/**
	 * Load plugin text domain.
	 *
	 * @return void
	 */
	public function load_textdomain(): void {
		load_plugin_textdomain( 'i18n-parser-test-suite-for-devs', false, dirname( plugin_basename( I18N_PARSER_TEST_SUITE_PATH ) ) . '/languages' );
	}

	/**
	 * Register the admin page via I18n_Parser_Test_Suite_Admin_Page class.
	 * Hooked to admin_menu to ensure safe execution context.
	 *
	 * @return void
	 */
	public function register_admin(): void {
		$admin_page = new I18n_Parser_Test_Suite_Admin_Page();
		$admin_page->register();
	}

	/**
	 * Enqueue admin assets safely.
	 *
	 * @param string $hook The current admin page hook.
	 * @return void
	 */
	public function enqueue_admin_assets( string $hook ): void {
		if ( 'tools_page_i18n-parser-test-suite-for-devs' !== $hook ) {
			return;
		}

		wp_enqueue_style(
			'i18n-parser-test-suite-for-devs-admin',
			I18N_PARSER_TEST_SUITE_URL . 'assets/css/admin.css',
			array(),
			I18N_PARSER_TEST_SUITE_VERSION
		);

		wp_enqueue_script(
			'i18n-parser-test-suite-for-devs-admin',
			I18N_PARSER_TEST_SUITE_URL . 'assets/js/admin.js',
			array(),
			I18N_PARSER_TEST_SUITE_VERSION,
			true
		);
	}

	/**
	 * Load required core engine and UI dependencies.
	 *
	 * @return void
	 */
	private function load_dependencies(): void {
		require_once I18N_PARSER_TEST_SUITE_PATH . 'includes/class-scenario-loader.php';
		require_once I18N_PARSER_TEST_SUITE_PATH . 'includes/class-reference-parser.php';
		require_once I18N_PARSER_TEST_SUITE_PATH . 'includes/class-test-runner.php';
		require_once I18N_PARSER_TEST_SUITE_PATH . 'includes/class-result-formatter.php';
		require_once I18N_PARSER_TEST_SUITE_PATH . 'includes/class-admin-page.php';
	}
}
