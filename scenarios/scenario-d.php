<?php
/**
 * Test Corpus D: Negative Tests & Complex Real-World Scenarios
 */

// SCENARIO 1: Negative Test Cases /* EXPECTED: 14 */
// --- Missing colon after "translators" ---
// translators This has no colon
__( 'Should not have translator comment extracted', 'my-text-domain' );

// translators This also has no colon
__( 'Another string without valid comment', 'my-text-domain' );

/* translators This block has no colon */
__( 'Block without colon - invalid', 'my-text-domain' );

/** translators Missing colon in PHPDoc */
__( 'PHPDoc without colon - invalid', 'my-text-domain' );

// --- Singular "translator" instead of "translators" ---
// translator: Singular form (should not match)
__( 'Singular translator comment', 'my-text-domain' );

/* translator: Singular in block */
__( 'Singular block translator', 'my-text-domain' );

// --- Extra text before "translators:" ---
// Note: translators: With prefix text before the keyword
__( 'Prefixed comment - invalid', 'my-text-domain' );

// Please translators: Read this comment
__( 'Please prefixed - invalid', 'my-text-domain' );

// --- Comment after the function (not before) ---
__( 'Comment after function', 'my-text-domain' );
// translators: This comment comes AFTER the function
// Should NOT be associated with the string above

/* translators: This block is after */
__( 'Another after-function string', 'my-text-domain' );

// --- Comment before non-i18n functions ---
// translators: Before strlen
strlen( 'test string' );

// translators: Before print_r
print_r( $array );

// translators: Before var_dump
var_dump( $variable );

// translators: Before custom function
my_custom_function( 'arg1', 'arg2' );

// translators: Before array creation
$items = [ 'a', 'b', 'c' ];

// --- Translators comment with no function following ---
// translators: Orphan comment with nothing after
$unrelated_var = true;

// translators: Another orphan comment
if ( $condition ) {
    // do something
}

// --- Function that looks similar but isn't i18n ---
// translators: Before non-i18n function with underscore prefix
_my_custom_func( 'not a translation', 'domain' );

// translators: Before function ending in underscore
_something_( 'also not translation' );

// --- HTML comment (not PHP comment) ---
<!-- translators: This is an HTML comment, not PHP -->
<p><?php __( 'HTML comment before - invalid', 'my-text-domain' ); ?></p>

// --- Comment inside string literal ---
__( '// translators: This is inside a string, not a real comment', 'my-text-domain' );

__( '/* translators: Also inside a string */', 'my-text-domain' );

// --- Hash comment (not valid PHP) ---
# translators: Hash comment style (not standard PHP)
__( 'Hash comment - invalid', 'my-text-domain' );


// SCENARIO 2: Realistic Complex Scenarios /* EXPECTED: 47 */
class Admin_Settings_Page {
    public function render() {
        // translators: Page heading for settings
        echo '<h1>' . esc_html__( 'Plugin Settings', 'my-text-domain' ) . '</h1>';
        
        // translators: Submit button text
        submit_button( __( 'Save Changes', 'my-text-domain' ) );
        
        // translators: Section title for general settings
        echo '<h2>' . __( 'General Settings', 'my-text-domain' ) . '</h2>';
    }
}

$labels = array(
    'name'                  => /* translators: Post type general name */ __( 'Books', 'my-text-domain' ),
    'singular_name'         => /* translators: Post type singular name */ __( 'Book', 'my-text-domain' ),
    'menu_name'             => /* translators: Admin menu name */ _x( 'Books', 'admin menu', 'my-text-domain' ),
    'name_admin_bar'        => /* translators: Admin bar name */ _x( 'Book', 'add new on admin bar', 'my-text-domain' ),
    'add_new'               => /* translators: Add new item label */ __( 'Add New', 'my-text-domain' ),
    'add_new_item'          => /* translators: Add new item dialog title */ __( 'Add New Book', 'my-text-domain' ),
    'edit_item'             => /* translators: Edit item dialog title */ __( 'Edit Book', 'my-text-domain' ),
    'new_item'              => /* translators: New item dialog title */ __( 'New Book', 'my-text-domain' ),
    'view_item'             => /* translators: View item button */ __( 'View Book', 'my-text-domain' ),
    'search_items'          => /* translators: Search items button */ __( 'Search Books', 'my-text-domain' ),
    'not_found'             => /* translators: No items found message */ __( 'No books found.', 'my-text-domain' ),
    'not_found_in_trash'    => /* translators: No items in trash message */ __( 'No books found in Trash.', 'my-text-domain' ),
);

function send_notification( $user_name, $post_count, $comment_count ) {
    // translators: %s: User name, %d: Number of posts
    $message = sprintf( __( 'Hello %s, you have %d posts.', 'my-text-domain' ), $user_name, $post_count );
    
    /* translators: %d: Number of new comments.
       Shown in the notification email body. */
    $message .= "\n" . sprintf( _n( 'You have %d new comment.', 'You have %d new comments.', $comment_count, 'my-text-domain' ), $comment_count );
    
    return $message;
}

$bulk_messages = array(
    'updated'   => /* translators: %d: Number of items updated */ _n( '%d item updated.', '%d items updated.', $count, 'my-text-domain' ),
    'deleted'   => /* translators: %d: Number of items deleted */ _n( '%d item permanently deleted.', '%d items permanently deleted.', $count, 'my-text-domain' ),
    'trashed'   => /* translators: %d: Number of items trashed */ _n( '%d item moved to the Trash.', '%d items moved to the Trash.', $count, 'my-text-domain' ),
    'untrashed' => /* translators: %d: Number of items restored */ _n( '%d item restored from the Trash.', '%d items restored from the Trash.', $count, 'my-text-domain' ),
);

function render_dashboard_widget() {
    // translators: Widget title
    echo '<h3>' . esc_html__( 'Site Overview', 'my-text-domain' ) . '</h3>';
    
    // translators: %d: Number of total users
    echo '<p>' . sprintf( __( 'Total Users: %d', 'my-text-domain' ), get_user_count() ) . '</p>';
    
    /* translators: %1$d: Number of published posts, %2$d: Number of drafts */
    echo '<p>' . sprintf(
        __( 'Published: %1$d | Drafts: %2$d', 'my-text-domain' ),
        $published,
        $drafts
    ) . '</p>';
    
    // translators: Link text to view all content
    echo '<a href="#">' . _x( 'View All', 'dashboard link', 'my-text-domain' ) . '</a>';
}

try {
    $result = perform_action();
} catch ( Exception $e ) {
    // translators: %s: Error message from exception
    wp_die( sprintf( __( 'An error occurred: %s', 'my-text-domain' ), $e->getMessage() ) );
}

if ( is_singular() ) {
    // translators: Shown on single post pages
    _e( 'Reading this article', 'my-text-domain' );
} elseif ( is_archive() ) {
    // translators: Shown on archive pages
    _e( 'Browsing archives', 'my-text-domain' );
} elseif ( is_search() ) {
    /* translators: %s: Search query. Shown on search results page. */
    printf( __( 'Search results for: %s', 'my-text-domain' ), get_search_query() );
}

$script_data = array(
    'confirm_delete' => /* translators: Confirmation dialog for deletion */ __( 'Are you sure you want to delete this item?', 'my-text-domain' ),
    'no_results'     => /* translators: Message when AJAX returns no results */ __( 'No results found.', 'my-text-domain' ),
    'loading'        => /* translators: Loading indicator text */ __( 'Loading...', 'my-text-domain' ),
    
    // translators: No-op plural for JS. %d: Number of items to delete.
    'delete_plural'  => _n_noop( 'Delete %d item?', 'Delete %d items?', 'my-text-domain' ),
    
    /* translators: No-op with context for JS.
       %s: Item name being processed. */
    'processing'     => _nx_noop( 'Processing %s...', 'Processing %s...', 'ajax status', 'my-text-domain' ),
);

// translators: %%s is a literal percent-s, %s is a placeholder
__( 'Discount: %%s off! Use code %s at checkout.', 'my-text-domain' );

// translators: %%d is literal percent-d, %1$d and %2$d are placeholders
__( 'Progress: %%d complete (%1$d of %2$d tasks)', 'my-text-domain' );

// translators: Multiple same placeholders
__( '%1$s met with %1$s to discuss %2$s', 'my-text-domain' );

// translators: Mixed ordered and unordered placeholders (unusual but valid)
__( 'User %s has %2$d posts in %1$s category', 'my-text-domain' );

// translators: Empty string translation (edge case)
__( '', 'my-text-domain' );

// translators: String with only whitespace
__( '   ', 'my-text-domain' );

// translators: String that is just a newline
__( "\n", 'my-text-domain' );

// translators: Very short string (single character)
__( 'A', 'my-text-domain' );

// translators: Ternary expression as string argument
__( $is_enabled ? 'Enabled' : 'Disabled', 'my-text-domain' );

// translators: Null coalescing as string argument
__( $custom_text ?? 'Default fallback text', 'my-text-domain' );

// translators: Function call as string argument
__( get_translatable_string(), 'my-text-domain' );

// translators: Constant as string argument
__( MY_PLUGIN_DEFAULT_MESSAGE, 'my-text-domain' );

// translators: Complex expression as argument
__( ( $count > 0 ) ? sprintf( 'Has %d items', $count ) : 'Has no items', 'my-text-domain' );


// SCENARIO 3: Additional Complex Scenarios /* EXPECTED: 34 */
/* translators: %1$s: User role, %2$d: Number of permissions.
   Context: Shown in the capabilities table.
   Keep the HTML tags in the translation. */
_x( 'Role: %1$s has %2$d permissions.', 'capabilities table', 'my-text-domain' );

/* translators: %d: Number of downloads */ _n( '%d download', '%d downloads', $count, 'my-text-domain' );

// TRANSLATORS: Uppercase with tabs after.		
		__( 'Complex edge case: uppercase with tabs', 'my-text-domain' );

/* translators: %1$d: Number of approved, %2$d: Number of pending.
   Shown in the comments moderation queue. */
_n(
    '%1$d approved, %2$d pending',
    '%1$d approved, %2$d pending',
    $total,
    'my-text-domain'
);

// translators: Wrapping in esc_html for safety
esc_html__( 'Safe translated string', 'my-text-domain' );

// translators: Using esc_attr for attribute context
esc_attr__( 'Attribute value', 'my-text-domain' );

// translators: Escaped with context
esc_html_x( 'Read', 'button label', 'my-text-domain' );

// translators: Escaped attribute with context
esc_attr_x( 'Search', 'input placeholder', 'my-text-domain' );

// translators: 
__( 'Empty translator comment', 'my-text-domain' );

/* translators: */
__( 'Empty block translator comment', 'my-text-domain' );

// translators: First comment for first function
__( 'First string', 'my-text-domain' );
// translators: Second comment for second function
__( 'Second string', 'my-text-domain' );
// translators: Third comment for third function
__( 'Third string', 'my-text-domain' );

// translators: Comment with "quotes", 'apostrophes', and <html> tags.
__( 'String after special chars in comment', 'my-text-domain' );

// translators: Comment with backslash \ and dollar sign $variable
__( 'String after escape chars in comment', 'my-text-domain' );

/* translators: Comment with 
   various line breaks
   and indentation
     even nested
       deeply */
__( 'String after complex whitespace in block', 'my-text-domain' );

// translators: This comment is before a non-i18n function
strlen( 'Some string' );

// translators: This comment is before a regular function call
some_custom_function( 'argument' );

// translators: This comment is before a variable assignment
$var = 'value';

// translators: This comment mentions __() and _x() but shouldn't break parsing
__( 'Comment mentioning function names', 'my-text-domain' );

// translators: Comment with Unicode: ñ, ö, ü, 中文, 日本語
__( 'String after Unicode in comment', 'my-text-domain' );

// translators: This is a very long translators comment that exceeds typical line lengths and continues to provide extensive context about the translation string that follows, explaining every nuance of where it appears and how it should be translated.
__( 'String after very long comment', 'my-text-domain' );

// translators: Note: the colon after "Note" is part of the comment, not the prefix.
__( 'String with colon in comment text', 'my-text-domain' );

// translators: Format: %s is the name, use it carefully.
__( 'String with colon in middle of comment', 'my-text-domain' );

// translators: Comment before PHP close tag
?>
<?php
// translators: Comment after PHP reopen tag
__( 'String after PHP tag reopen', 'my-text-domain' );

class My_Class {
    public function get_strings() {
        // translators: Comment inside class method
        __( 'String in class method', 'my-text-domain' );
        
        /* translators: Block comment inside method */
        _x( 'Context string', 'context', 'my-text-domain' );
    }
    
    private function helper() {
        // translators: Comment in private method with placeholder. %d: Count
        _n( '%d item', '%d items', $count, 'my-text-domain' );
    }
}

if ( is_admin() ) {
    // translators: Admin-only string
    __( 'Admin message', 'my-text-domain' );
} else {
    // translators: Frontend-only string
    __( 'Frontend message', 'my-text-domain' );
}

switch ( $action ) {
    case 'save':
        /* translators: Shown when saving settings */
        __( 'Settings saved', 'my-text-domain' );
        break;
    case 'delete':
        /* translators: Shown when deleting an item */
        __( 'Item deleted', 'my-text-domain' );
        break;
}

$strings = [
    'save'    => /* translators: Save button */ __( 'Save', 'my-text-domain' ),
    'cancel'  => /* translators: Cancel button */ __( 'Cancel', 'my-text-domain' ),
    'delete'  => /* translators: Delete confirmation */ __( 'Delete', 'my-text-domain' ),
];

// translators: Comment with function call argument
__( call_user_func( 'get_string' ), 'my-text-domain' );

// translators: Comment with constant as argument
__( MY_CONSTANT_STRING, 'my-text-domain' );


// SCENARIO 4: Final Regression Tests /* EXPECTED: 18 */
// translators: Multi-blank with TABs
	


		__( 'Multi-blank TABs string', 'my-text-domain' );

	
	/* TRANSLATORS: UPPERCASE BLOCK WITH TABS */
	__( 'Uppercase block TABs', 'my-text-domain' );

	
	/**
	 * translators: PHPDoc with TABs
	 * and multiple lines
	 */
	
	
		__( 'PHPDoc TABs multi-blank', 'my-text-domain' );

/* translators: Inline concat with context */ _x( 'Type: ' . $post_type, 'admin column', 'my-text-domain' );

// translators: Long concatenation chain
__(
    'Part 1 ' .
    $var1 .
    ' Part 2 ' .
    $var2 .
    ' Part 3 ' .
    $var3 .
    ' Part 4 ' .
    $var4 .
    ' Part 5',
    'my-text-domain'
);

// translators: Nested calls with concat
__( 'Count: ' . count( $items ) . ' Total: ' . array_sum( $values ), 'my-text-domain' );

// translators: Literal percent signs in string
__( 'Discount: 50% off! Save $$ now!', 'my-text-domain' );

// translators: Mix of literal and placeholder percent signs
__( 'Use %% discount code %s for %%d more savings', 'my-text-domain' );

// translators: Placeholder-only string. %s: Value to display.
__( '%s', 'my-text-domain' );

// translators: Context with special chars
_x( 'Click', 'button: "click here"', 'my-text-domain' );

// translators: Identical singular and plural forms. %d: Count.
_n( '%d sheep', '%d sheep', $count, 'my-text-domain' );

/* translators: Inline no-op */ _n_noop( '%s item', '%s items', 'my-text-domain' );

/* translators: Inline no-op with context */ _nx_noop( 'One %s', '%s items', 'context', 'my-text-domain' );

// translators: TAB-indented heredoc
__(
	<<<EOT
		Indented heredoc content
		with TABs preserved
	EOT
	, 'my-text-domain' );

// translators: Near end of file
__( 'End of file string', 'my-text-domain' );

/* translators: Final block comment */
__( 'Final block string', 'my-text-domain' );

/** translators: Final PHPDoc */
__( 'Final PHPDoc string', 'my-text-domain' );

// translators: The very last translators comment
__( 'Very last string', 'my-text-domain' );
