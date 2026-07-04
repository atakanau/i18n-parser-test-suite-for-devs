<?php
/**
 * Test Corpus B: Core Functions, Plurals, Domains & Placeholders
 */

// SCENARIO 1: Placeholders /* EXPECTED: 7 */
// translators: %s: Name of the user
__( 'Hello, %s!', 'my-text-domain' );

// translators: %d: Number of items in the cart
__( 'You have %d items in your cart.', 'my-text-domain' );

// translators: %1$s: First name, %2$s: Last name
__( 'Welcome, %1$s %2$s!', 'my-text-domain' );

// translators: %1$d: Number of comments, %2$s: Post title
__( 'There are %1$d comments on "%2$s".', 'my-text-domain' );

// translators: %s: Search query, %d: Number of results
sprintf(
    /* translators: %1$s: Search query, %2$d: Number of results */
    __( 'Found %2$d results for "%1$s".', 'my-text-domain' ),
    $query,
    $count
);

// translators: %1$s: Plugin name, %2$s: Version number, %3$s: Author name
__( '%1$s version %2$s by %3$s', 'my-text-domain' );

// translators: %f: Price value (will be formatted with 2 decimal places)
__( 'Total price: $%f', 'my-text-domain' );


// SCENARIO 2: With Context /* EXPECTED: 7 */
// translators: Context: verb, as in "to post content"
_x( 'Post', 'verb', 'my-text-domain' );

// translators: Context: noun, as in "a blog post"
_x( 'Post', 'noun', 'my-text-domain' );

/* translators: Context: abbreviation for "number" */
_ex( 'No.', 'abbreviation', 'my-text-domain' );

// translators: Context: button label, not the action of closing something
_x( 'Close', 'button label', 'my-text-domain' );

// translators: Context: date format used in comments section
_x( 'F j, Y', 'comment date format', 'my-text-domain' );

/* translators: Context: used as a navigation direction */
_x( 'Next', 'navigation', 'my-text-domain' );

// translators: Context: standalone adjective describing state
_x( 'Active', 'status adjective', 'my-text-domain' );


// SCENARIO 3: With Plurals /* EXPECTED: 6 */
// translators: %s: Number of comments
_n( 'One comment', '%s comments', $count, 'my-text-domain' );

/* translators: %d: Number of items.
   This is shown in the shopping cart summary. */
_n( '%d item', '%d items', $count, 'my-text-domain' );

// translators: %s: Name of the user. Context: notification message.
_nx( 'One new message from %s', '%s new messages from %s', $count, 'notification', 'my-text-domain' );

/* translators: %d: Number of days. Context: subscription period. */
_nx( '%d day remaining', '%d days remaining', $days, 'subscription period', 'my-text-domain' );

// translators: %d: Number of views. Shown on post listings.
_n( '%d view', '%d views', $views, 'my-text-domain' );

/* translators: %d: Number of replies. Context: forum thread. */
_nx( '%d reply', '%d replies', $replies, 'forum thread', 'my-text-domain' );


// SCENARIO 4: Additional i18n Function Variations /* EXPECTED: 15 */
// translators: Echo variant for page title
_e( 'Page not found', 'my-text-domain' );

/* translators: Echo variant for error message */
_e( 'Access denied', 'my-text-domain' );

// translators: Escaped HTML echo for display name
esc_html_e( 'Display Name', 'my-text-domain' );

// translators: Escaped HTML echo with user-provided context
esc_html_e( 'Unknown user', 'my-text-domain' );

// translators: Escaped attribute echo for input placeholder
esc_attr_e( 'Enter your email', 'my-text-domain' );

// translators: Escaped attribute echo for aria label
esc_attr_e( 'Close dialog', 'my-text-domain' );

// translators: Base translate function call
translate( 'Raw translated string', 'my-text-domain' );

/* translators: Base translate with longer comment */
translate( 'Another raw translation', 'my-text-domain' );

// translators: No-op plural for JS use. %d: Number of items.
_n_noop( '%d item', '%d items', 'my-text-domain' );

/* translators: No-op plural with context for JS.
   %s: Post type name. */
_n_noop( '%s published', '%s published', 'my-text-domain' );

// translators: No-op plural with context for JS. %d: Days remaining.
_nx_noop( '%d day left', '%d days left', 'subscription', 'my-text-domain' );

/* translators: No-op plural with context.
   %1$d: Approved count, %2$d: Pending count. */
_nx_noop(
    '%1$d approved, %2$d pending',
    '%1$d approved, %2$d pending',
    'comment status',
    'my-text-domain'
);

/* translators: Inline with _ex */ _ex( 'Edit', 'action', 'my-text-domain' );

/* translators: Inline with _nx */ _nx( 'One child', '%s children', $count, 'taxonomy', 'my-text-domain' );

/* translators: Inline with _n */ _n( 'One vote', '%s votes', $votes, 'my-text-domain' );


// SCENARIO 5: Text-Domain Variations /* EXPECTED: 7 */
// translators: Standard text domain
__( 'Standard domain', 'my-text-domain' );

// translators: Variable text domain
__( 'Variable domain string', $text_domain );

// translators: Hyphenated text domain
__( 'Hyphenated domain', 'my-text-domain-long' );

// translators: Underscored text domain
__( 'Underscored domain', 'my_plugin_text_domain' );

// translators: Empty text domain
__( 'Empty domain string', '' );

// translators: Numeric-like text domain
__( 'Numeric domain string', 'domain123' );

// translators: Namespaced text domain
__( 'Namespaced domain string', 'vendor/plugin-name' );
