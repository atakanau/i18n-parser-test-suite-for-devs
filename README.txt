=== i18n Parser Test Suite for Devs ===
Contributors: atakanau
Donate link: https://buymeacoffee.com/atakanau
Tags: i18n, translation, parser, testing, regression, token, gettext, developers, tools
Requires at least: 5.0
Tested up to: 7.0
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A scenario-driven regression testing framework and admin dashboard for PHP token parsers extracting WordPress i18n translator comments and function patterns.

== Description ==

This plugin provides a scenario-driven testing framework and an interactive admin dashboard to verify that a reference parser correctly identifies, extracts, and associates `translators:` comments with WordPress i18n functions across a wide variety of complex, real-world, and edge-case PHP syntaxes.

= Key Features =

* Token-Based Extraction Engine: Utilizes PHP's `token_get_all()` to accurately parse code without executing it, safely skipping method calls (e.g., `$obj->__()`) and non-i18n functions.
* Scenario-Driven Architecture: Easily define test cases using simple, structured PHP comment markers. No complex testing frameworks required.
* Comprehensive Test Corpus: Includes 100+ out-of-the-box scenarios covering standard functions, plurals, contexts, string concatenation, Heredoc/Nowdoc, escaped characters, mixed whitespace, and negative tests (false positives).
* Interactive Admin Dashboard: View results in a clean, card-based UI under the WordPress Tools menu. Features summary statistics, pass/fail scoring, and an extraction details table.
* Frontend Filtering: Client-side JavaScript allows administrators to instantly filter the test suite view by Passed, Failed, or Informational statuses.
* WP 6.7+ Compatible: Strictly hooks text domain loading and admin UI initialization to `init` and `admin_menu` to prevent "load_textdomain_just_in_time" errors.

= Writing Custom Scenarios =

You can add your own test cases by creating new `.php` files inside the `/scenarios/` directory. The plugin will automatically discover and run them.

Use the following comment marker syntax to define a test block:

`// SCENARIO <ID>: <Title> /* EXPECTED: <Count> */`

* `<ID>`: A unique numeric identifier for the scenario.
* `<Title>`: A descriptive name for the scenario.
* `/* EXPECTED: <Count> */`: (Optional) The exact number of valid i18n extractions the parser should find. If omitted, the scenario is marked as Informational and will not affect the pass/fail rate.

Example Scenario:

    // SCENARIO 1: Basic Plural Extraction /* EXPECTED: 1 */
    // translators: %d: Number of items in the cart
    _n( '%d item', '%d items', $count, 'my-text-domain' );

= Supported i18n Functions =

The test suite includes scenarios for all standard WordPress translation functions:
`__`, `_e`, `_x`, `_n`, `_nx`, `_ex`, `translate`, `esc_html__`, `esc_html_e`, `esc_html_x`, `esc_attr__`, `esc_attr_e`, `esc_attr_x`, `_n_noop`, and `_nx_noop`.

== Installation ==

1. Download the plugin ZIP file.
2. Navigate to **Plugins > Add New > Upload Plugin** in your WordPress admin dashboard.
3. Select the plugin ZIP file and click **Install Now**.
4. Once installed, click **Activate Plugin**.
5. Go to **Tools > i18n Parser Tests** to view the dashboard and test results.

== Screenshots ==

1. Admin dashboard showing global summary counters, total extractions, and the overall pass rate percentage.
2. A scenario card displaying the raw PHP test code, expected vs. actual extraction badges, and the detailed token extraction table.
3. The frontend filtering dropdown allowing users to quickly isolate Passed, Failed, or Informational test results.

== Changelog ==

= 1.0.0 =
* Initial release.
* Includes a robust token-based reference parser supporting all standard WP i18n functions (`__`, `_e`, `_x`, `_n`, `_nx`, `_ex`, `_n_noop`, `_nx_noop`, and escaped variants).
* Added 100+ out-of-the-box scenarios covering comments, contexts, plurals, placeholders, concatenation, Heredoc/Nowdoc, edge cases, and negative false-positive tests.
* Built interactive Tools admin page with summary statistics, responsive scenario cards, and detailed extraction tables.
* Implemented client-side filtering for test result statuses.