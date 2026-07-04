<?php
/**
 * Result Table partial: Extracted tokens table per scenario.
 *
 * @package I18n_Parser_Test_Suite_For_Devs
 * @var array $extractions Array of extraction data passed from scenario-card.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<table class="wp-i18n-test-suite-table widefat fixed striped">
	<thead>
		<tr>
			<th><?php esc_html_e( 'Function', 'i18n-parser-test-suite-for-devs' ); ?></th>
			<th><?php esc_html_e( 'Arguments', 'i18n-parser-test-suite-for-devs' ); ?></th>
			<th><?php esc_html_e( 'Line', 'i18n-parser-test-suite-for-devs' ); ?></th>
			<th><?php esc_html_e( 'Translator Comment', 'i18n-parser-test-suite-for-devs' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $extractions as $extraction ) : ?>
			<tr>
				<td><code><?php echo esc_html( $extraction['function'] ); ?></code></td>
				<td>
					<?php
					$args_display = [];

					if ( ! empty( $extraction['singular'] ) ) {
						$args_display[] = 'Singular: <strong>' . esc_html( $extraction['singular'] ) . '</strong>';
					}
					if ( ! empty( $extraction['plural'] ) ) {
						$args_display[] = 'Plural: <strong>' . esc_html( $extraction['plural'] ) . '</strong>';
					}
					if ( ! empty( $extraction['context'] ) ) {
						$args_display[] = 'Context: <strong>' . esc_html( $extraction['context'] ) . '</strong>';
					}
					if ( ! empty( $extraction['domain'] ) && $extraction['domain'] !== 'default' ) {
						$args_display[] = 'Domain: <strong>' . esc_html( $extraction['domain'] ) . '</strong>';
					}

					echo empty( $args_display ) 
						? '—' 
						: implode( '<br>', $args_display );
					?>
				</td>
				<td><?php echo (int) $extraction['line']; ?></td>
				<td><?php echo ! empty( $extraction['comment'] ) ? esc_html( $extraction['comment'] ) : '—'; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>