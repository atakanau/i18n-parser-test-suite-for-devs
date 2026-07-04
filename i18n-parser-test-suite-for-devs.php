<?php
/**
 * Plugin Name:       i18n Parser Test Suite for Devs
 * Plugin URI:        https:///programs.com.tr/i18n-parser-test-suite-for-devs
 * Description:       Regression testing for PHP token parsers that extract WordPress i18n translator comments and function patterns.
 * Version:           1.0.0
 * Requires at least: 6.7
 * Requires PHP:      8.1
 * Author:            atakanau
 * Author URI:        https://programs.com.tr/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       i18n-parser-test-suite-for-devs
 * Domain Path:       /languages
 * Update URI:        false
 *
 * @package I18n_Parser_Test_Suite_For_Devs
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin constants.
if ( ! defined( 'I18N_PARSER_TEST_SUITE_VERSION' ) ) {
	define( 'I18N_PARSER_TEST_SUITE_VERSION', '1.0.1' );
}

if ( ! defined( 'I18N_PARSER_TEST_SUITE_PATH' ) ) {
	define( 'I18N_PARSER_TEST_SUITE_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'I18N_PARSER_TEST_SUITE_URL' ) ) {
	define( 'I18N_PARSER_TEST_SUITE_URL', plugin_dir_url( __FILE__ ) );
}

// Load core.
require_once I18N_PARSER_TEST_SUITE_PATH . 'includes/class-core.php';

/**
 * Boot the plugin.
 *
 * @return void
 */
function i18n_parser_test_suite_boot() {
	I18n_Parser_Test_Suite_Core::get_instance()->boot();
}
add_action( 'plugins_loaded', 'i18n_parser_test_suite_boot' );
