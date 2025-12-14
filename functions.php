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

/**
 * Force product search results to use WooCommerce product grid layout
 * Issue #4 from UX Audit: Search results showing blog-style excerpts instead of product grid
 * This hooks into WordPress search and redirects product searches to use the shop template
 */
function canvasnest_fix_product_search_layout( $query ) {
    // Only affect main query on search pages, not admin or other queries
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        // Check if we're searching for products specifically
        // WooCommerce adds 'product' post type to search by default when products exist
        if ( ! isset( $query->query_vars['post_type'] ) || $query->query_vars['post_type'] == '' ) {
            // Force search to only show products (not blog posts)
            $query->set( 'post_type', 'product' );
        }
    }
}
add_action( 'pre_get_posts', 'canvasnest_fix_product_search_layout' );

/**
 * Use WooCommerce shop template for product search results
 * This ensures product searches display in grid format, not blog excerpt format
 */
function canvasnest_use_shop_template_for_search( $template ) {
    global $wp_query;

    // If this is a search page AND we're showing products
    if ( is_search() && isset( $wp_query->query_vars['post_type'] ) && $wp_query->query_vars['post_type'] == 'product' ) {
        // Check if WooCommerce shop template exists
        $shop_template = locate_template( 'woocommerce/archive-product.php' );
        if ( ! $shop_template ) {
            // Fallback to WooCommerce plugin template
            $shop_template = WC()->plugin_path() . '/templates/archive-product.php';
        }

        if ( file_exists( $shop_template ) ) {
            return $shop_template;
        }
    }

    return $template;
}
add_filter( 'template_include', 'canvasnest_use_shop_template_for_search', 99 );

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
 * Inject critical CSS to override Woo Discount Rules badge styling
 * Plugin CSS loads AFTER child theme CSS, so we need wp_head injection with max priority
 * This restyles the percentage badge professionally without creating duplicate badges
 */
function canvasnest_override_badge_styling() {
    // Load on shop pages, categories, tags, products, and front page (shop is set as landing page)
    if ( ! is_shop() && ! is_front_page() && ! is_product_category() && ! is_product_tag() && ! is_product() ) {
        return;
    }
    ?>
    <style id="canvasnest-badge-override">
        /* Override Woo Discount Rules green circular badge with professional styling */

        /* Hide Astra's duplicate "Sale!" badge */
        body.woocommerce .ast-on-card-button.ast-onsale-card,
        body.woocommerce-shop .ast-on-card-button.ast-onsale-card,
        .ast-on-card-button.ast-onsale-card,
        .ast-onsale-card {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
        }

        /* Restyle Woo Discount Rules percentage badge - maximum specificity */
        body.woocommerce ul.products li.product span.onsale,
        body.woocommerce-shop ul.products li.product span.onsale,
        body.archive.woocommerce ul.products li.product span.onsale,
        .woocommerce ul.products li.product span.onsale,
        ul.products li.product span.onsale,
        span.onsale {
            /* Remove green circular styling, add professional brand colors */
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%) !important;
            color: #ffffff !important;

            /* Remove circular shape - make it a clean rectangle */
            border-radius: 6px !important;
            width: auto !important;
            height: auto !important;
            min-width: unset !important;
            min-height: unset !important;

            /* Professional typography */
            font-size: 13px !important;
            font-weight: 700 !important;
            letter-spacing: 0.5px !important;
            line-height: 1.2 !important;
            text-transform: uppercase !important;

            /* Clean spacing */
            padding: 8px 12px !important;
            margin: 0 !important;

            /* Professional shadow instead of heavy border */
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.25) !important;
            border: none !important;

            /* Smooth transitions */
            transition: transform 0.2s ease, box-shadow 0.2s ease !important;
        }

        /* Hover effect */
        body.woocommerce ul.products li.product:hover span.onsale,
        ul.products li.product:hover span.onsale {
            transform: scale(1.05) !important;
            box-shadow: 0 4px 12px rgba(44, 62, 80, 0.35) !important;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'canvasnest_override_badge_styling', 999 );
