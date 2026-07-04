<?php
/**
 * Footer partial: Legend and export controls.
 *
 * @package I18n_Parser_Test_Suite_For_Devs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wp-i18n-test-suite-footer" style="margin-top: 20px; padding: 15px 0; border-top: 1px solid #ccd0d4;">
	<h3><?php esc_html_e( 'Legend', 'i18n-parser-test-suite-for-devs' ); ?></h3>
	<p>
		<span class="wp-i18n-test-suite-pass" style="font-weight: 600;">●</span> <?php esc_html_e( 'Passed: Actual extraction count matches expected.', 'i18n-parser-test-suite-for-devs' ); ?><br>
		<span class="wp-i18n-test-suite-fail" style="font-weight: 600;">●</span> <?php esc_html_e( 'Failed: Actual extraction count does not match expected.', 'i18n-parser-test-suite-for-devs' ); ?><br>
		<span style="color: #72aee6; font-weight: 600;">●</span> <?php esc_html_e( 'Informational: No expected count was defined (informational only).', 'i18n-parser-test-suite-for-devs' ); ?>
	</p>

	<button type="button" class="button" onclick="navigator.clipboard.writeText(document.querySelector('.wp-i18n-test-suite-scenarios').innerText)">
		<?php esc_html_e( 'Copy Scenario Data', 'i18n-parser-test-suite-for-devs' ); ?>
	</button>
</div>

</div> <!-- .wrap -->
