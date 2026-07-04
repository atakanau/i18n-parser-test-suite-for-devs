```php
<?php
/**
 * Test Corpus C: Syntax & Edge Cases
 */

// SCENARIO 1: Whitespace Edge Cases /* EXPECTED: 8 */
// translators: Comment with one blank line after it.

__( 'String after one blank line', 'my-text-domain' );

// translators: Comment with two blank lines after it.


__( 'String after two blank lines', 'my-text-domain' );

// translators: Comment with three blank lines after it.



__( 'String after three blank lines', 'my-text-domain' );

// translators: Comment followed by spaces and then a newline.    
__( 'String after trailing spaces in comment line', 'my-text-domain' );

// translators: Comment followed by tabs between it and function.		
		__( 'String after tabs', 'my-text-domain' );

// translators: Comment followed by mixed whitespace.  	
  	__( 'String after mixed whitespace', 'my-text-domain' );

// translators: Comment with only newline
__( 'String after single newline', 'my-text-domain' );

// translators: Comment with carriage return and newline (Windows style)
__( 'String after CRLF', 'my-text-domain' );


// SCENARIO 2: Case Variations /* EXPECTED: 8 */
// Translators: Capitalized "Translators"
__( 'Capitalized translators comment', 'my-text-domain' );

// TRANSLATORS: All uppercase "TRANSLATORS"
__( 'Uppercase translators comment', 'my-text-domain' );

// translators: Standard lowercase (baseline)
__( 'Lowercase translators comment', 'my-text-domain' );

/* Translators: Capitalized in block comment */
__( 'Capitalized block comment', 'my-text-domain' );

/* TRANSLATORS: Uppercase in block comment */
__( 'Uppercase block comment', 'my-text-domain' );

/* translators: Lowercase in block comment (baseline) */
__( 'Lowercase block comment', 'my-text-domain' );

// TRANSLATORS: Uppercase with extra whitespace after colon.   
__( 'Uppercase with extra whitespace', 'my-text-domain' );

// Translators:  Capitalized with extra whitespace after colon.  
__( 'Capitalized with extra whitespace', 'my-text-domain' );


// SCENARIO 3: String Concatenation /* EXPECTED: 11 */
// translators: This uses string concatenation with a variable
__( 'Prefix: ' . $variable . ' suffix', 'my-text-domain' );

// translators: Concatenation with multiple strings and variables
__( 'Hello ' . $first_name . ' ' . $last_name . '!', 'my-text-domain' );

// translators: Concatenation with function calls
__( 'Date: ' . date( 'Y-m-d' ) . ' Time: ' . current_time( 'H:i' ), 'my-text-domain' );

// translators: Concatenation in plural form
_n( 'One item: ' . $item_name, '%d items: ' . $item_name, $count, 'my-text-domain' );

// translators: Concatenation with context
_x( 'View ' . $post_type . ' list', 'admin menu', 'my-text-domain' );

// translators: Complex concatenation with ternary operator
__( 'Status: ' . ( $is_active ? 'Active' : 'Inactive' ), 'my-text-domain' );

// translators: Concatenation spanning multiple lines
__(
    'Part one ' .
    $variable .
    ' part two ' .
    'part three',
    'my-text-domain'
);

// translators: Concatenation with array access
__( 'User: ' . $user['name'] . ' (ID: ' . $user['id'] . ')', 'my-text-domain' );

// translators: Concatenation with object property
__( 'Site: ' . $site->name . ' - ' . $site->url, 'my-text-domain' );

// translators: Concatenation with method call
__( 'Author: ' . $post->get_author_name(), 'my-text-domain' );

/* translators: Concatenation in plural with context */
_nx(
    'One ' . $type . ' item',
    '%d ' . $type . ' items',
    $count,
    'item count',
    'my-text-domain'
);


// SCENARIO 4: Heredoc and Nowdoc Strings /* EXPECTED: 5 */
// translators: Heredoc string translation
__( <<<EOT
This is a heredoc string
that spans multiple lines
for translation.
EOT
, 'my-text-domain' );

// translators: Nowdoc string (no variable parsing)
__( <<<'EOT'
This is a nowdoc string
with literal content
no variables parsed.
EOT
, 'my-text-domain' );

// translators: Heredoc with placeholder
__( <<<HEREDOC
Hello %s,

Your account has been created successfully.
Welcome to our platform!
HEREDOC
, 'my-text-domain' );

// translators: Heredoc in plural form
_n(
    <<<EOT
One item in your cart.
EOT
    ,
    <<<EOT
%d items in your cart.
EOT
    ,
    $count,
    'my-text-domain'
);

// translators: Heredoc with context
_x(
    <<<EOT
View all
EOT
    ,
    'button label',
    'my-text-domain'
);


// SCENARIO 5: Escaped Characters /* EXPECTED: 10 */
// translators: String with escaped single quotes
__( 'It\'s a beautiful day', 'my-text-domain' );

// translators: String with escaped double quotes (in single-quoted string)
__( 'He said "hello" to me', 'my-text-domain' );

// translators: String with backslash escapes
__( 'Path: C:\\Users\\Documents', 'my-text-domain' );

// translators: String with newline escape
__( "Line one\nLine two", 'my-text-domain' );

// translators: String with tab escape
__( "Column 1\tColumn 2\tColumn 3", 'my-text-domain' );

// translators: String with carriage return
__( "Header\r\nBody content", 'my-text-domain' );

// translators: String with escaped dollar sign
__( 'Price: \$100', 'my-text-domain' );

// translators: String with multiple escaped characters
__( 'File: \'C:\\\\path\\\\to\\\\file.txt\'', 'my-text-domain' );

// translators: Double-quoted string with escaped quotes
__( "She said, \"Hello there!\"", 'my-text-domain' );

// translators: String with octal and hex escapes
__( "Special: \x41\x42\x43 and \101\102\103", 'my-text-domain' );


// SCENARIO 6: Tab and Mixed Indentation /* EXPECTED: 12 */
	
	// translators: Comment with TAB-only indentation
	__( 'TAB-only indented string', 'my-text-domain' );
	
		// translators: Deep TAB-only indentation
		__( 'Deep TAB-only string', 'my-text-domain' );

	  
	  // translators: TAB then spaces indentation
	  __( 'TAB+spaces indented string', 'my-text-domain' );
	  
	  	// translators: TAB, spaces, TAB pattern
	  	__( 'Mixed TAB-spaces pattern string', 'my-text-domain' );

  		
  		// translators: Spaces then TAB indentation
  		__( 'Spaces-then-TAB string', 'my-text-domain' );

// translators: Comment followed by TAB-only whitespace		
		__( 'TAB whitespace after comment', 'my-text-domain' );

// translators: Comment followed by mixed whitespace	 	
		__( 'Mixed whitespace after comment', 'my-text-domain' );

if ( $outer ) {
	
	if ( $inner ) {
		
		// translators: Deeply nested with TAB-only
		__( 'Deeply nested TAB string', 'my-text-domain' );
		
		/* translators: Block comment deep with TABs */
		_x( 'Deep', 'context', 'my-text-domain' );
	}
}

__(
	'TAB-indented first argument',
	'my-text-domain'
);

_n(
	'TAB-indented singular',
	'TAB-indented plural',
	$count,
	'my-text-domain'
);

_x(
	'TAB-indented string',
	'TAB-indented context',
	'my-text-domain'
);
