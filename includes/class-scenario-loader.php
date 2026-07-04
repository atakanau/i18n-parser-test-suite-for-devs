<?php
/**
 * Scenario corpus file loader.
 *
 * @package I18n_Parser_Test_Suite_For_Devs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class I18n_Parser_Test_Suite_Scenario_Loader
 */
class I18n_Parser_Test_Suite_Scenario_Loader {

	/**
	 * Discover and parse all scenario corpus files.
	 *
	 * @return array Array of scenario block data.
	 */
	public function discover(): array {
		$scenarios = array();
		$files     = glob( I18N_PARSER_TEST_SUITE_PATH . 'scenarios/*.php' );

		if ( ! $files ) {
			return $scenarios;
		}

		foreach ( $files as $file ) {
			$content = file_get_contents( $file );
			if ( false === $content ) {
				continue;
			}

			$file_scenarios = $this->parse_content( $content, basename( $file ) );
			$scenarios      = array_merge( $scenarios, $file_scenarios );
		}

		return $scenarios;
	}

	/**
	 * Parse raw file content into scenario blocks.
	 *
	 * @param string $content The raw file content.
	 * @param string $file    The filename.
	 * @return array Array of scenario block associative arrays.
	 */
	private function parse_content( string $content, string $file ): array {
		$blocks  = array();
		$pattern = '/\/\/\s*SCENARIO\s+(\d+):\s*(.+?)(?:\s*\/\*\s*EXPECTED:\s*(\d+)\s*\*\/)?\s*$/m';

		if ( ! preg_match_all( $pattern, $content, $matches, PREG_OFFSET_CAPTURE ) ) {
			return $blocks;
		}

		for ( $i = 0; $i < count( $matches[0] ); $i++ ) {
			$marker_start = $matches[0][ $i ][1];
			$marker_end   = $marker_start + strlen( $matches[0][ $i ][0] );
			$code_end     = isset( $matches[0][ $i + 1 ] ) ? $matches[0][ $i + 1 ][1] : strlen( $content );

			$raw_code = substr( $content, $marker_start, $code_end - $marker_start );

			$blocks[] = array(
				'id'       => (int) $matches[1][ $i ][0],
				'title'    => trim( $matches[2][ $i ][0] ),
				'expected' => isset( $matches[3][ $i ][0] ) && '' !== $matches[3][ $i ][0] ? (int) $matches[3][ $i ][0] : null,
				'raw_code' => trim( $raw_code ),
				'file'     => $file,
			);
		}

		return $blocks;
	}
}
