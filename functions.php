<?php
/**
 * Astra Child Theme Functions
 * Canvas Nest Custom Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue parent and child theme styles
 * CRITICAL: This loads the child theme's style.css
 */
function astra_child_enqueue_styles() {
    // Enqueue parent theme stylesheet
    wp_enqueue_style( 'astra-parent-theme', get_template_directory_uri() . '/style.css' );

    // Enqueue child theme stylesheet (this loads our custom CSS!)
    wp_enqueue_style( 'astra-child-theme',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'astra-parent-theme' ),
        wp_get_theme()->get('Version') // Cache busting with version number
    );
}
add_action( 'wp_enqueue_scripts', 'astra_child_enqueue_styles', 15 );

/**
 * WooCommerce Hooks & Customizations
 * Add your custom functions, filters, and actions here
 */

// Example WooCommerce hook placeholder
// add_filter( 'woocommerce_product_loop_columns', function( $columns ) {
//     return 3; // 3 product columns
// });

/**
 * Template & CSS Customizations
 * Claude Code can add custom styling and template overrides here
 */

/**
 * REMOVED: Astra WooCommerce disable filter
 * Reason: It disabled ALL WooCommerce styling, not just badges!
 * This broke the entire product grid layout
 * Using targeted CSS in style.css instead to hide ONLY badges
 */

/**
 * REMOVED: Inline CSS badge injection
 * Reason: This was creating conflicting ::before pseudo-element badges
 * The proper surgical CSS approach in style.css handles badge styling correctly:
 * - Hides Astra's duplicate "Sale!" badge
 * - Restyles Woo Discount Rules percentage badge professionally
 * - No need for inline CSS injection
 */
