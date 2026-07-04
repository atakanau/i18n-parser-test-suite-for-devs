<?php
/**
 * Reference i18n parser using token_get_all().
 *
 * @package I18n_Parser_Test_Suite_For_Devs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class I18n_Parser_Test_Suite_Reference_Parser
 */
class I18n_Parser_Test_Suite_Reference_Parser {

	/**
	 * WordPress i18n function map.
	 *
	 * Key is function name, value maps argument indices to entry keys.
	 *
	 * @var array
	 */
	private static $i18n_functions = array(
		'__'          => array( 'singular' => 0, 'domain' => 1 ),
		'_e'          => array( 'singular' => 0, 'domain' => 1 ),
		'_x'          => array( 'singular' => 0, 'context' => 1, 'domain' => 2 ),
		'_ex'         => array( 'singular' => 0, 'context' => 1, 'domain' => 2 ),
		'_n'          => array( 'singular' => 0, 'plural' => 1, 'domain' => 3 ),
		'_nx'         => array( 'singular' => 0, 'plural' => 1, 'context' => 3, 'domain' => 4 ),
		'esc_html__'  => array( 'singular' => 0, 'domain' => 1 ),
		'esc_html_e'  => array( 'singular' => 0, 'domain' => 1 ),
		'esc_html_x'  => array( 'singular' => 0, 'context' => 1, 'domain' => 2 ),
		'esc_attr__'  => array( 'singular' => 0, 'domain' => 1 ),
		'esc_attr_e'  => array( 'singular' => 0, 'domain' => 1 ),
		'esc_attr_x'  => array( 'singular' => 0, 'context' => 1, 'domain' => 2 ),
		'_n_noop'     => array( 'singular' => 0, 'plural' => 1, 'domain' => 2 ),
		'_nx_noop'    => array( 'singular' => 0, 'plural' => 1, 'context' => 2, 'domain' => 3 ),
		'translate'   => array( 'singular' => 0, 'domain' => 1 ),
	);

	/**
	 * Extract i18n function calls and translator comments from PHP code.
	 *
	 * @param string $code The raw PHP code.
	 * @return array Array of extracted call data.
	 */
	public function extract( string $code ): array {
		$tokens = token_get_all( '<?php ' . $code );
		$results = array();
		$total = count( $tokens );

		for ( $i = 0; $i < $total; $i++ ) {
			$token = $tokens[ $i ];

			if ( ! is_array( $token ) || T_STRING !== $token[0] ) {
				continue;
			}

			$function = $token[1];

			if ( ! isset( self::$i18n_functions[ $function ] ) ) {
				continue;
			}

			// Skip methods (e.g. $obj->__()).
			$prev_token = $this->get_previous_significant_token( $tokens, $i );
			if ( T_OBJECT_OPERATOR === $prev_token || T_DOUBLE_COLON === $prev_token ) {
				continue;
			}

			// Find opening parenthesis.
			$open_paren_index = $this->get_next_significant_token( $tokens, $i );
			if ( false === $open_paren_index || '(' !== $tokens[ $open_paren_index ] ) {
				continue;
			}

			$args = $this->parse_arguments( $tokens, $open_paren_index );

			$entry = array(
				'function' => $function,
				'singular' => null,
				'plural'   => null,
				'context'  => null,
				'domain'   => 'default',
				'line'     => $token[2],
			);

			$mapping = self::$i18n_functions[ $function ];
			foreach ( $mapping as $key => $arg_index ) {
				if ( isset( $args[ $arg_index ] ) ) {
					$entry[ $key ] = $args[ $arg_index ];
				}
			}

			$comment = $this->find_translator_comment( $tokens, $i );
			if ( null !== $comment ) {
				$entry['comment'] = $comment;
			}

			$results[] = $entry;
		}

		return $results;
	}

	/**
	 * Parse function arguments from token stream.
	 *
	 * @param array $tokens      The token array.
	 * @param int   $open_paren  The index of the opening parenthesis.
	 * @return array Array of parsed argument strings.
	 */
	private function parse_arguments( array $tokens, int $open_paren ): array {
		$args        = array();
		$current_arg = array();
		$paren_depth = 1;
		$total       = count( $tokens );

		for ( $i = $open_paren + 1; $i < $total; $i++ ) {
			$token = $tokens[ $i ];

			if ( '(' === $token ) {
				$paren_depth++;
				$current_arg[] = is_array( $token ) ? $token[1] : $token;
				continue;
			}

			if ( ')' === $token ) {
				$paren_depth--;
				if ( 0 === $paren_depth ) {
					if ( ! empty( $current_arg ) || count( $args ) > 0 ) {
						$args[] = $this->evaluate_arg_tokens( $current_arg );
					}
					break;
				}
				$current_arg[] = $token;
				continue;
			}

			if ( 1 === $paren_depth && ',' === $token ) {
				$args[] = $this->evaluate_arg_tokens( $current_arg );
				$current_arg = array();
				continue;
			}

			if ( is_array( $token ) && T_WHITESPACE === $token[0] ) {
				continue;
			}

			$current_arg[] = is_array( $token ) ? $token[1] : $token;
		}

		return $args;
	}

	/**
	 * Evaluate argument tokens into a string representation.
	 *
	 * @param array $arg_tokens Tokens forming the argument.
	 * @return string|null Evaluated string or null.
	 */
	private function evaluate_arg_tokens( array $arg_tokens ) {
		if ( empty( $arg_tokens ) ) {
			return null;
		}

		$result  = '';
		$has_dot = false;
		$parts   = array();

		foreach ( $arg_tokens as $token_part ) {
			if ( '.' === $token_part ) {
				$has_dot = true;
				continue;
			}
			$parts[] = $token_part;
		}

		if ( ! $has_dot ) {
			if ( preg_match( '/^(["\'])(.*)\1$/', $parts[0] ?? '', $m ) ) {
				return $m[2] ?: null;
			}
			return $parts[0] ?: null;
		}

		foreach ( $parts as $part ) {
			if ( preg_match( '/^(["\'])(.*)\1$/', $part, $m ) ) {
				$result .= $m[2];
			} else {
				$result .= $part;
			}
		}

		return $result ?: null;
	}

	/**
	 * Find the translators comment associated with a function call.
	 *
	 * @param array $tokens        The token array.
	 * @param int   $function_index The index of the function name token.
	 * @return string|null The comment string or null.
	 */
	private function find_translator_comment( array $tokens, int $function_index ): ?string {
		for ( $i = $function_index - 1; $i >= 0; $i-- ) {
			$token = $tokens[ $i ];

			if ( ! is_array( $token ) ) {
				continue;
			}

			if ( T_WHITESPACE === $token[0] ) {
				continue;
			}

			if ( T_COMMENT === $token[0] || T_DOC_COMMENT === $token[0] ) {
				$comment = $token[1];

				// Strip block comment delimiters
				$comment = preg_replace( '#^\s*/\*+\s*#', '', $comment );
				$comment = preg_replace( '#\s*\*+/\s*$#', '', $comment );

				// Strip single-line comment delimiters
				$comment = preg_replace( '#^\s*//\s*#', '', $comment );

				// Strip leading asterisks
				$comment = preg_replace( '#^\s*\* ?#m', '', $comment );

				if ( preg_match( '/translators:\s*(.+)/is', $comment, $matches ) ) {
					return trim( $matches[1] );
				}

				return trim( $comment );
			}

			break;
		}

		return null;
	}

	/**
	 * Get the next significant token index.
	 */
	private function get_next_significant_token( array $tokens, int $index ) {
		$total = count( $tokens );
		for ( $i = $index + 1; $i < $total; $i++ ) {
			if ( is_array( $tokens[ $i ] ) && T_WHITESPACE === $tokens[ $i ][0] ) {
				continue;
			}
			return $i;
		}
		return false;
	}

	/**
	 * Get the previous significant token type.
	 *
	 * @param array $tokens The token array.
	 * @param int   $index  The starting index.
	 * @return int|false Previous significant token type or false.
	 */
	private function get_previous_significant_token( array $tokens, int $index ) {
		for ( $i = $index - 1; $i >= 0; $i-- ) {
			if ( is_array( $tokens[ $i ] ) && T_WHITESPACE === $tokens[ $i ][0] ) {
				continue;
			}
			return is_array( $tokens[ $i ] ) ? $tokens[ $i ][0] : $tokens[ $i ];
		}
		return false;
	}
}