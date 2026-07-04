<?php
/**
 * Admin page template shell.
 *
 * THIS FILE MUST BE A PURE TEMPLATE. 
 * It must NOT contain a class definition, only HTML and template logic.
 *
 * @package I18n_Parser_Test_Suite_For_Devs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include I18N_PARSER_TEST_SUITE_PATH . 'templates/partials/header.php';

if ( ! empty( $results['scenarios'] ) ) :
	?>
	<div class="wp-i18n-test-suite-scenarios">
		<?php foreach ( $results['scenarios'] as $scenario ) : ?>
			<?php include I18N_PARSER_TEST_SUITE_PATH . 'templates/partials/scenario-card.php'; ?>
		<?php endforeach; ?>
	</div>
	<?php
endif;

include I18N_PARSER_TEST_SUITE_PATH . 'templates/partials/footer.php';
