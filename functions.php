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
 * Fix product search to use Advanced WooCommerce Search (AWS) plugin
 * Issue #4 from UX Audit: Search results showing blog-style excerpts instead of product grid
 *
 * The site uses AWS plugin for product search indexing. Vanilla WordPress search
 * doesn't index WooCommerce products by default, so we redirect to AWS plugin search.
 */
function canvasnest_redirect_to_aws_product_search() {
    // Only redirect on search pages, not admin
    if ( ! is_admin() && is_search() ) {
        // Check if this is already an AWS search (has type_aws parameter)
        if ( ! isset( $_GET['type_aws'] ) ) {
            // Get the search term
            $search_term = get_search_query();

            // Only redirect if there's a search term
            if ( ! empty( $search_term ) ) {
                // Redirect to AWS plugin search with product post type
                $redirect_url = home_url( '/?s=' . urlencode( $search_term ) . '&post_type=product&type_aws=true' );
                wp_redirect( $redirect_url, 301 );
                exit;
            }
        }
    }
}
add_action( 'template_redirect', 'canvasnest_redirect_to_aws_product_search', 1 );

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
