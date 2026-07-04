<?php
/**
 * Test runner that orchestrates scenario loading and reference parsing.
 *
 * @package I18n_Parser_Test_Suite_For_Devs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class I18n_Parser_Test_Suite_Test_Runner
 */
class I18n_Parser_Test_Suite_Test_Runner {

	/**
	 * Run the test suite against all discovered scenarios.
	 *
	 * @return array Raw test run data containing scenarios and their extraction results.
	 */
	public function run(): array {
		$loader  = new I18n_Parser_Test_Suite_Scenario_Loader();
		$parser  = new I18n_Parser_Test_Suite_Reference_Parser();
		$results = array( 'scenarios' => array() );

		$scenarios = $loader->discover();

		foreach ( $scenarios as $scenario ) {
			$extractions  = $parser->extract( $scenario['raw_code'] );
			$actual_count = count( $extractions );

			$is_pass = null;
			if ( null !== $scenario['expected'] ) {
				$is_pass = ( $actual_count === $scenario['expected'] );
			}

			$results['scenarios'][] = array(
				'id'             => $scenario['id'],
				'title'          => $scenario['title'],
				'file'           => $scenario['file'],
				'raw_code'       => $scenario['raw_code'],
				'extractions'    => $extractions,
				'expected_count' => $scenario['expected'],
				'actual_count'   => $actual_count,
				'is_pass'        => $is_pass,
			);
		}

		return $results;
	}
}
