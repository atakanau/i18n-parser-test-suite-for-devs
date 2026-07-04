<?php
/**
 * Test Corpus A: Comments & Contexts
 */

// SCENARIO 1: Simple Single-Line /* EXPECTED: 3 */
// translators: This is a simple single-line translator comment.
__( 'Simple translation string', 'my-text-domain' );

// translators: Greeting message shown on the homepage.
__( 'Welcome to our website!', 'my-text-domain' );

// translators: Error message when file upload fails.
__( 'Failed to upload the file. Please try again.', 'my-text-domain' );


// SCENARIO 2: Multi-Line Block /* EXPECTED: 3 */
/* translators: This is a multi-line block comment.
   It provides detailed instructions to translators
   about the context and usage of this string.
   Make sure to keep it professional. */
__( 'Multi-line comment translation', 'my-text-domain' );

/* translators: This string appears in the checkout process.
   It is shown when the user's cart is empty.
   Keep the tone friendly and encouraging.
   Do not translate "cart" as it's a recognized term. */
__( 'Your cart is empty. Would you like to continue shopping?', 'my-text-domain' );

/* translators: This is a longer explanation that spans
   three lines and provides context about where this
   string is displayed in the admin interface. */
__( 'Settings saved successfully.', 'my-text-domain' );


// SCENARIO 3: Inline Block /* EXPECTED: 6 */
/* translators: Inline comment before function */ __( 'Inline block translation', 'my-text-domain' );

/* translators: Button text for submitting form */ __( 'Submit', 'my-text-domain' );

$var = /* translators: Label for username field */ __( 'Username', 'my-text-domain' );

echo /* translators: Page title */ __( 'Dashboard', 'my-text-domain' );

if ( $condition ) {
    $result = /* translators: Success message */ __( 'Operation completed', 'my-text-domain' );
}

$array = [
    'key' => /* translators: Array value description */ __( 'Value', 'my-text-domain' ),
];


// SCENARIO 4: PHPDoc Style Comments /* EXPECTED: 7 */
/** translators: PHPDoc style single-line comment */
__( 'PHPDoc single-line string', 'my-text-domain' );

/**
 * translators: PHPDoc style multi-line comment.
 * This format is commonly used in documented code.
 */
__( 'PHPDoc multi-line string', 'my-text-domain' );

/**
 * translators: PHPDoc with placeholder info.
 * %s: User display name.
 * %d: User ID number.
 */
__( 'User %s (ID: %d)', 'my-text-domain' );

/** translators: PHPDoc inline */ __( 'PHPDoc inline string', 'my-text-domain' );

/**
 * translators: PHPDoc with detailed context for plural.
 * Shown in the media library grid view.
 * %d: Number of selected items.
 */
_n( '%d item selected', '%d items selected', $selected, 'my-text-domain' );

/** translators: PHPDoc with context */ _x( 'Add', 'button', 'my-text-domain' );

/**
 * translators: PHPDoc block spanning multiple lines
 * with various indentation levels
 *    and nested content
 *      that tests parser robustness
 */
__( 'Complex PHPDoc whitespace', 'my-text-domain' );