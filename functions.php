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
 * CRITICAL FIX: Disable Astra's WooCommerce Integration
 * This reverts WooCommerce styling to standard WordPress/WooCommerce defaults
 * Allows us to easily customize sale badges and other WooCommerce elements
 * without fighting Astra's aggressive CSS specificity
 */
add_filter( 'astra_enable_woocommerce_integration', '__return_false' );

/**
 * Inject critical CSS with maximum priority
 * This overrides Astra theme's sale badge styles that can't be overridden via style.css
 * Uses inline CSS in <head> with ultra-specific selectors
 */
function canvasnest_critical_sale_badge_css() {
    // Only load on shop pages
    if ( ! is_shop() && ! is_product_category() && ! is_product_tag() && ! is_product() ) {
        return;
    }
    ?>
    <style id="canvasnest-critical-badges">
        /* CRITICAL: Hide ALL Astra sale badges with maximum specificity */

        /* Hide green circular percentage badge */
        body.woocommerce-shop ul.products li.product .astra-shop-thumbnail-wrap span.onsale,
        body.woocommerce ul.products li.product .astra-shop-thumbnail-wrap span.onsale,
        body.archive.woocommerce ul.products li.product .astra-shop-thumbnail-wrap span.onsale,
        body.woocommerce-page ul.products li.product .astra-shop-thumbnail-wrap span.onsale,
        .astra-shop-thumbnail-wrap span.onsale {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            width: 0 !important;
            height: 0 !important;
            position: absolute !important;
            left: -9999px !important;
        }

        /* Hide "Sale!" text badge */
        body.woocommerce-shop .ast-on-card-button.ast-onsale-card,
        body.woocommerce .ast-on-card-button.ast-onsale-card,
        body.archive.woocommerce .ast-on-card-button.ast-onsale-card,
        body.woocommerce-page .ast-on-card-button.ast-onsale-card,
        span.ast-onsale-card,
        .ast-onsale-card {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            width: 0 !important;
            height: 0 !important;
            position: absolute !important;
            left: -9999px !important;
        }

        /* Create our clean sale badge */
        body.woocommerce ul.products li.product.sale .astra-shop-thumbnail-wrap::before,
        body.woocommerce-shop ul.products li.product.sale .astra-shop-thumbnail-wrap::before,
        body.archive.woocommerce ul.products li.product.sale .astra-shop-thumbnail-wrap::before {
            content: "SALE" !important;
            display: block !important;
            position: absolute !important;
            top: 12px !important;
            left: 12px !important;
            z-index: 999 !important;
            background: linear-gradient(135deg, #d63031 0%, #c0392b 100%) !important;
            color: #ffffff !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            line-height: 1 !important;
            padding: 8px 14px !important;
            border-radius: 6px !important;
            box-shadow: 0 2px 8px rgba(214, 48, 49, 0.3) !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease !important;
        }

        /* Ensure thumbnail wrap is positioned */
        body.woocommerce ul.products li.product .astra-shop-thumbnail-wrap,
        body.woocommerce-shop ul.products li.product .astra-shop-thumbnail-wrap {
            position: relative !important;
        }

        /* Hover effect */
        body.woocommerce ul.products li.product.sale:hover .astra-shop-thumbnail-wrap::before {
            transform: scale(1.05) !important;
            box-shadow: 0 4px 12px rgba(214, 48, 49, 0.4) !important;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'canvasnest_critical_sale_badge_css', 999 );
