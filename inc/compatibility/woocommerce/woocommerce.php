<?php
/**
 * WooCommerce Compatibility
 *
 * @package Envy Blog
 */

if( !class_exists( 'WooCommerce' ) )
    return;

/*----------------------------------------------------------------------
# WooCommerce Support Declare
-------------------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_woocommerce_support' ) ) {
    function envy_blog_woocommerce_support() {
        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
}
add_action( 'after_setup_theme', 'envy_blog_woocommerce_support' );

/*----------------------------------------------------------------------
# WooCommerce Add, Remove and Filter Actions
-------------------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_woo_actions' ) ) {
    function envy_blog_woo_actions() {

        // Remove Hook Action
        remove_action( 'woocommerce_before_main_content',           'woocommerce_breadcrumb',                   20 );
        remove_action( 'woocommerce_before_main_content',           'woocommerce_output_content_wrapper',       10 );
        remove_action( 'woocommerce_before_shop_loop',              'woocommerce_result_count',                 20 );
        remove_action( 'woocommerce_after_main_content',            'woocommerce_output_content_wrapper_end',   10 );
        remove_action( 'woocommerce_sidebar',                       'woocommerce_get_sidebar',                  10 );
        remove_action( 'woocommerce_after_single_product_summary',  'woocommerce_upsell_display',               15 );

        // Add Custom Hook Action
        add_action( 'woocommerce_before_main_content',              'envy_blog_wc_before_main_content',         10, 2 );
        add_action( 'woocommerce_after_main_content',               'envy_blog_wc_after_main_content',          10, 2 );
        
        // WooCommerce Hook Filters
        add_filter('woocommerce_show_page_title',                   '__return_false');
        add_filter( 'woocommerce_product_thumbnails_columns',       'envy_blog_wc_single_product_thumbnails_cols',10, 1 );
        add_filter( 'loop_shop_per_page',                           'envy_blog_wc_shop_per_page',               10, 1 );

        if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
            add_filter( 'woocommerce_add_to_cart_fragments',        'envy_blog_wc_add_to_cart_fragments',       10, 1 );
        } else {
            add_filter( 'add_to_cart_fragments',                    'envy_blog_wc_add_to_cart_fragments',       10, 1 );
        }
    }
}
add_action( 'wp','envy_blog_woo_actions' );

/*--------------------------------------------------------------
# Before Main Content
--------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_wc_before_main_content' ) ) {
    function envy_blog_wc_before_main_content() {
        $sidebar_class = ' has-'.envy_blog_layout_class();
        if ( is_shop() ) {
            $sidebar_class = 'has-full-width';
        }
        if ( ! is_product() ):
        ?>
        <div class="row">
            <header class="page-header">
                <div class="page-header-content">
                    <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
                    <?php do_action( 'woocommerce_archive_description' ); ?>
                </div><!-- .page-header-content -->
            </header><!-- .page-header -->
        </div><!-- .row -->
        <?php endif; ?>
        <div class="row<?php echo esc_attr( $sidebar_class ); ?>">
            <div id="primary" class="content-area<?php echo esc_attr( $sidebar_class ); ?>">
                <main id="main" class="site-main" role="main">
        <?php
    }
}

/*--------------------------------------------------------------
# After Main Content
--------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_wc_after_main_content' ) ) {
    function envy_blog_wc_after_main_content() { ?>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php
        if ( !is_shop() ) {
            get_sidebar();
        }
        echo '</div><!-- .row -->';
    }
}

/*--------------------------------------------------------------
# Product gallery thumbnail columns
--------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_wc_single_product_thumbnails_cols' ) ) {
    function envy_blog_wc_single_product_thumbnails_cols() {
        $columns = 4;
        return intval( $columns );
    }
}

/*--------------------------------------------------------------
# Products per page
--------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_wc_shop_per_page' ) ) {
    function envy_blog_wc_shop_per_page() {
        // Default number of products if < WooCommerce 3.3.
        if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '<' ) ) {
            $number = 12;
        }
        return absint( $number );
    }
}

/*--------------------------------------------------------------
# Ajax Cart Update
--------------------------------------------------------------*/
if ( ! function_exists( 'envy_blog_wc_add_to_cart_fragments' ) ) {
    function envy_blog_wc_add_to_cart_fragments( $fragments ) {
        ob_start();
        ?>
        <span class="nav-bar-cart">
            <span class="nav-bar-cart-value">
                <?php echo wp_kses_data ( WC()->cart->get_cart_contents_count() ); ?>
            </span>
        </span>
        <?php

        $fragments['span.nav-bar-cart'] = ob_get_clean();
        return $fragments;
    }
}
