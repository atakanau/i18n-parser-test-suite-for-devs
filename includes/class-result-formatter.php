<?php
/**
 * Formats raw test run data into a UI-ready dataset with summary statistics.
 *
 * @package I18n_Parser_Test_Suite_For_Devs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class I18n_Parser_Test_Suite_Result_Formatter
 */
class I18n_Parser_Test_Suite_Result_Formatter {

	/**
	 * Format the raw test run results for admin template consumption.
	 *
	 * @param array $test_run Raw test run data from I18n_Parser_Test_Suite_Test_Runner.
	 * @return array Formatted data containing scenarios and global summary.
	 */
	public function format( array $test_run ): array {
		$summary = array(
			'total_scenarios'   => 0,
			'total_extractions' => 0,
			'passed'            => 0,
			'failed'            => 0,
			'informational'     => 0,
			'pass_rate'         => 0.0,
		);

		$evaluated_count = 0;
		$evaluated_passed = 0;

		// Process and escape scenario data for safe UI rendering.
		foreach ( $test_run['scenarios'] as &$scenario ) {
			$summary['total_scenarios']++;
			$summary['total_extractions'] += $scenario['actual_count'];

			if ( true === $scenario['is_pass'] ) {
				$summary['passed']++;
				$evaluated_count++;
				$evaluated_passed++;
			} elseif ( false === $scenario['is_pass'] ) {
				$summary['failed']++;
				$evaluated_count++;
			} else {
				$summary['informational']++;
			}
		}
		unset( $scenario );

		// Calculate pass rate percentage.
		if ( $evaluated_count > 0 ) {
			$summary['pass_rate'] = round( ( $evaluated_passed / $evaluated_count ) * 100, 1 );
		}

		return array(
			'scenarios' => $test_run['scenarios'],
			'summary'   => $summary,
		);
	}
}
