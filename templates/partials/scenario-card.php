<?php
/**
 * Scenario Card partial: Single scenario block display.
 *
 * @package I18n_Parser_Test_Suite_For_Devs
 * @var array $scenario Current scenario data passed from admin-page.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wp-i18n-test-suite-card <?php echo null === $scenario['is_pass'] ? 'informational' : ( true === $scenario['is_pass'] ? 'pass' : 'fail' ); ?>">
	<h2>
		<span class="wp-i18n-test-suite-status-indicator"></span>
		<?php
		printf(
			/* translators: 1: Scenario ID, 2: File name, 3: Scenario title */
			esc_html__( 'Scenario %1$d: %2$s — %3$s', 'i18n-parser-test-suite-for-devs' ),
			(int) $scenario['id'],
			esc_html( $scenario['file'] ),
			esc_html( $scenario['title'] )
		);
		?>
	</h2>

	<div class="wp-i18n-test-suite-meta">
		<?php if ( null !== $scenario['expected_count'] ) : ?>
			<span class="wp-i18n-test-suite-badge">
				<?php
				printf(
					/* translators: %d: Expected extraction count */
					esc_html__( 'Expected: %d', 'i18n-parser-test-suite-for-devs' ),
					(int) $scenario['expected_count']
				);
				?>
			</span>
		<?php endif; ?>

		<span class="wp-i18n-test-suite-badge">
			<?php
			printf(
				/* translators: %d: Actual extraction count */
				esc_html__( 'Actual: %d', 'i18n-parser-test-suite-for-devs' ),
				(int) $scenario['actual_count']
			);
			?>
		</span>
	</div>

	<pre class="wp-i18n-test-suite-code"><code><?php echo esc_html( $scenario['raw_code'] ); ?></code></pre>

	<?php if ( ! empty( $scenario['extractions'] ) ) : ?>
		<?php 
		// Pass extractions to the result table partial.
		$extractions = $scenario['extractions']; 
		include I18N_PARSER_TEST_SUITE_PATH . 'templates/partials/result-table.php';
		?>
	<?php else : ?>
		<p><em><?php esc_html_e( 'No i18n function calls extracted.', 'i18n-parser-test-suite-for-devs' ); ?></em></p>
	<?php endif; ?>
</div>
