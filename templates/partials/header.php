<?php
/**
 * Header partial: Page title and summary stats.
 *
 * @package I18n_Parser_Test_Suite_For_Devs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Safely handle $results scope in case of early execution or partial loading.
if ( ! isset( $results ) || ! is_array( $results ) ) {
	$results = array( 'summary' => array(), 'scenarios' => array() );
}

$summary = wp_parse_args( 
	$results['summary'] ?? array(), 
	array(
		'total_scenarios'   => 0,
		'total_extractions' => 0,
		'passed'            => 0,
		'failed'            => 0,
		'informational'     => 0,
		'pass_rate'         => 0.0,
	) 
);
?>
<div class="wrap">
	<h1><?php esc_html_e( 'i18n Parser Test Suite for Devs', 'i18n-parser-test-suite-for-devs' ); ?></h1>

	<div class="wp-i18n-test-suite-summary">
		<p>
			<strong><?php esc_html_e( 'Total Scenarios:', 'i18n-parser-test-suite-for-devs' ); ?></strong> 
			<?php echo esc_html( $summary['total_scenarios'] ); ?> |
			
			<strong><?php esc_html_e( 'Total Extractions:', 'i18n-parser-test-suite-for-devs' ); ?></strong> 
			<?php echo esc_html( $summary['total_extractions'] ); ?> |
			
			<strong><?php esc_html_e( 'Passed:', 'i18n-parser-test-suite-for-devs' ); ?></strong> 
			<span class="wp-i18n-test-suite-pass"><?php echo esc_html( $summary['passed'] ); ?></span> |
			
			<strong><?php esc_html_e( 'Failed:', 'i18n-parser-test-suite-for-devs' ); ?></strong> 
			<span class="wp-i18n-test-suite-fail"><?php echo esc_html( $summary['failed'] ); ?></span> |
			
			<strong><?php esc_html_e( 'Pass Rate:', 'i18n-parser-test-suite-for-devs' ); ?></strong> 
			<?php echo esc_html( $summary['pass_rate'] ); ?>%
		</p>
	</div>

	<div class="tablenav top wp-i18n-test-suite-filter-bar">
		<div class="alignleft actions filter-radios">
			<strong><?php esc_html_e( 'Filter:', 'i18n-parser-test-suite-for-devs' ); ?></strong>
			<label>
				<input type="radio" name="wp-i18n-radio-filter" value="all" checked>
				<?php esc_html_e( 'All', 'i18n-parser-test-suite-for-devs' ); ?>
			</label>
			<label>
				<input type="radio" name="wp-i18n-radio-filter" value="pass">
				<?php esc_html_e( 'Passed', 'i18n-parser-test-suite-for-devs' ); ?>
			</label>
			<label>
				<input type="radio" name="wp-i18n-radio-filter" value="fail">
				<?php esc_html_e( 'Failed', 'i18n-parser-test-suite-for-devs' ); ?>
			</label>
			<label>
				<input type="radio" name="wp-i18n-radio-filter" value="informational">
				<?php esc_html_e( 'Informational', 'i18n-parser-test-suite-for-devs' ); ?>
			</label>
		</div>
		<div class="alignright actions">
			<button type="button" id="wp-i18n-expand-all" class="button"><?php esc_html_e( 'Expand All', 'i18n-parser-test-suite-for-devs' ); ?></button>
			<button type="button" id="wp-i18n-collapse-all" class="button"><?php esc_html_e( 'Collapse All', 'i18n-parser-test-suite-for-devs' ); ?></button>
		</div>
		<br class="clear" />
	</div>

	<?php if ( empty( $results['scenarios'] ) ) : ?>
		<div class="notice notice-warning">
			<p><?php esc_html_e( 'No scenario corpus files found in the /scenarios directory.', 'i18n-parser-test-suite-for-devs' ); ?></p>
		</div>
	<?php endif; ?>
