# i18n Parser Test Suite for Devs

A WordPress plugin designed for regression testing PHP token parsers that extract WordPress internationalization (i18n) translator comments and function patterns. 

This plugin provides a scenario-driven testing framework and an interactive admin dashboard to verify that a reference parser correctly identifies, extracts, and associates `translators:` comments with WordPress i18n functions across a wide variety of complex, real-world, and edge-case PHP syntaxes.

## Key Features

- **Token-Based Extraction Engine:** Utilizes PHP's `token_get_all()` to accurately parse code without executing it, safely skipping method calls (e.g., `$obj->__()`) and non-i18n functions.
- **Scenario-Driven Architecture:** Easily define test cases using simple, structured PHP comment markers. No complex testing frameworks required.
- **Comprehensive Test Corpus:** Includes 100+ out-of-the-box scenarios covering standard functions, plurals, contexts, string concatenation, Heredoc/Nowdoc, escaped characters, mixed whitespace, and negative tests (false positives).
- **Interactive Admin Dashboard:** View results in a clean, card-based UI under the WordPress Tools menu. Features summary statistics, pass/fail scoring, and an extraction details table.
- **Frontend Filtering:** Client-side JavaScript allows administrators to instantly filter the test suite view by Passed, Failed, or Informational statuses.
- **WP 6.7+ Compatible:** Strictly hooks text domain loading and admin UI initialization to `init` and `admin_menu` to prevent "load_textdomain_just_in_time" errors.

## Prerequisites

- **WordPress:** 5.0 or higher
- **PHP:** 7.4 or higher (uses typed properties and null safe operators)
- **Permissions:** Administrator privileges required to view the test suite dashboard

## Step-by-Step Installation

1. **Download the Plugin:** Download the plugin ZIP file or clone the repository to your local machine.
2. **Upload to WordPress:** Navigate to **Plugins > Add New > Upload Plugin** in your WordPress admin dashboard. Select the plugin ZIP file and click **Install Now**.
3. **Activate the Plugin:** Once installed, click **Activate Plugin**.
4. **Access the Test Suite:** In your WordPress admin sidebar, go to **Tools > i18n Parser Tests** to view the dashboard and test results.

## Usage Examples

### Viewing Test Results
Upon navigating to **Tools > i18n Parser Tests**, the plugin dynamically runs the test suite. The dashboard displays:
- **Summary Counters:** Total scenarios processed, total i18n extractions found, and the overall pass rate percentage.
- **Scenario Cards:** Each scenario displays its status indicator (Passed/Failed/Informational), the expected vs. actual extraction counts, the raw PHP code being tested, and a detailed table of the extracted function names, arguments, line numbers, and associated translator comments.
- **Filtering:** Use the filter dropdown above the results to show only Passed, Failed, or Informational scenarios.

### Writing Custom Scenarios
You can add your own test cases by creating new `.php` files inside the `/scenarios/` directory. The `Scenario_Loader` will automatically discover and run them.

Use the following comment marker syntax to define a test block:

```php
// SCENARIO <ID>: <Title> /* EXPECTED: <Count> */
// translators: Your translator comment here.
__( 'Your translation string', 'your-text-domain' );
```

* **`<ID>`**: A unique numeric identifier for the scenario.
* **`<Title>`**: A descriptive name for the scenario.
* **`/* EXPECTED: <Count> */`**: (Optional) The exact number of valid i18n extractions the parser should find. If omitted, the scenario is marked as *Informational* and will not affect the pass/fail rate.

**Example Scenario:**
```php
// SCENARIO 1: Basic Plural Extraction /* EXPECTED: 1 */
// translators: %d: Number of items in the cart
_n( '%d item', '%d items', $count, 'my-text-domain' );
```

## Folder Structure Breakdown

```text
i18n-parser-test-suite-for-devs/
│
├── i18n-parser-test-suite-for-devs.php      # Plugin entry point. Defines constants and boots the Core class.
│
├── includes/
│   ├── class-admin-page.php                 # Registers the Tools menu page and dispatches the render method.
│   ├── class-core.php                       # Singleton orchestrator. Manages lifecycle, dependency loading, and asset enqueueing.
│   ├── class-reference-parser.php           # The engine. Uses token_get_all() to extract i18n functions and translator comments.
│   ├── class-result-formatter.php           # Calculates summary statistics (pass rate, counts) and normalizes data for the UI.
│   ├── class-scenario-loader.php            # Discovers scenario files and parses them into structured arrays using Regex.
│   └── class-test-runner.php                # Compares the Reference_Parser output against the scenario's EXPECTED count.
│
├── scenarios/
│   ├── scenario-a.php                       # Tests: Comments & Contexts (single, multi-line, inline, PHPDoc).
│   ├── scenario-b.php                       # Tests: Core functions, plurals, domains, placeholders.
│   ├── scenario-c.php                       # Tests: Syntax & edge cases (whitespace, concatenation, Heredoc, escapes).
│   └── scenario-d.php                       # Tests: Negative cases (false positives) & complex real-world code.
│
├── templates/
│   ├── admin-page.php                       # Main admin template shell.
│   └── partials/
│       ├── header.php                       # Displays page title and global summary counters.
│       ├── result-table.php                 # Renders the widefat WP table showing extracted token data.
│       └── scenario-card.php                # Renders individual scenario blocks (status, code block, badges).
│
├── assets/
│   ├── css/
│   │   └── admin.css                        # Styles for cards, code blocks, responsive grid, and status indicators.
│   └── js/
│       └── admin.js                         # Handles client-side filtering, collapsible sections, and UI interactions.
│
└── README.md                                # This documentation file.
```

## Contributing

Contributions, bug reports, and feature requests are welcome! To contribute:

1. Fork the repository.
2. Create a new feature branch (`git checkout -b feature/new-scenario-tests`).
3. Add your test scenarios to the `/scenarios/` directory following the standard marker syntax.
4. Commit your changes (`git commit -m 'Add new edge case scenarios'`).
5. Push to the branch (`git push origin feature/new-scenario-tests`).
6. Open a Pull Request.

Please ensure your code follows WordPress coding standards and includes appropriate documentation comments.

## License

This plugin is licensed under the [GPL-2.0-or-later](https://www.gnu.org/licenses/gpl-2.0.html) license as specified in the plugin header.