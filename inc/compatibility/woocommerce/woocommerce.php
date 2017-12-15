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

        // WooCommerce Default Remove Action
        remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
        remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

        // WooCommerce Default Add Action
        add_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10, 2 );
        add_action( 'woocommerce_before_shop_loop_item_title', 'envy_blog_template_loop_product_thumbnail', 10);
        add_action( 'woocommerce_after_single_product_summary', 'envy_blog_woo_upsell_products_limit', 15 );

        // WooCommerce Default Filters
        add_filter( 'woocommerce_add_to_cart_fragments', 'envy_blog_woocommerce_header_add_to_cart_fragment' );
        add_filter( 'loop_shop_per_page', 'envy_blog_woo_product_per_page', 20 );
        add_filter( 'loop_shop_columns', 'envy_blog_woo_product_per_row' );
        add_filter( 'woocommerce_output_related_products_args', 'envy_blog_woo_related_products_args' );
        add_filter( 'woocommerce_cross_sells_total', 'envy_blog_woocommerce_cross_sells_total', 10, 1 );


    }
}
add_action( 'wp','envy_blog_woo_actions' );

/*--------------------------------------------------------------
# Ajax Cart Update
--------------------------------------------------------------*/
if ( ! function_exists( 'envy_blog_woocommerce_header_add_to_cart_fragment' ) ) {
    function envy_blog_woocommerce_header_add_to_cart_fragment( $fragments ) {
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

/*----------------------------------------------------------------------
# WooCommerce Layout Class
-------------------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_woocommerce_layout_class' ) ) {
    function envy_blog_woocommerce_layout_class() {
        global $post;

        $layout = get_theme_mod( 'envy-blog_archive_page_global_sidebar', 'right-sidebar' );

        // Get Layout meta
        if ( $post ) {
            $layout_meta = get_post_meta( $post->ID, 'specific_page_layout', true );
        }

        // Home page if Posts page is assigned
        if ( is_home() && !( is_front_page() ) ) {
            $queried_id     = get_option( 'page_for_posts' );
            $layout_meta    = get_post_meta( $queried_id, 'specific_page_layout', true );

            if ( $layout_meta != 'default-sidebar' && $layout_meta != '' ) {
                $layout = get_post_meta( $queried_id, 'specific_page_layout', true );
            }
        } elseif ( is_page() ) {
            $layout = get_theme_mod( 'envy-blog_page_global_sidebar', 'right-sidebar' );
            if ( $layout_meta != 'default-sidebar' && $layout_meta != '' ) {
                $layout = get_post_meta( $post->ID, 'specific_page_layout', true );
            }
        } elseif( is_single() ) {
            $layout = get_theme_mod( 'envy-blog_wc_product_page_global_sidebar', 'full-width' );
            if ( $layout_meta != 'default-sidebar' && $layout_meta != '' ) {
                $layout = get_post_meta( $post->ID, 'specific_page_layout', true );
            }
        }
        return esc_html( $layout );
    }
}

/*----------------------------------------------------------------------
# WooCommerce Sidebar Appearance
-------------------------------------------------------------------------*/
if ( ! function_exists( 'woocommerce_get_sidebar' ) ) {
    function woocommerce_get_sidebar(){
        global $post;
        $woo_layout_class   = envy_blog_woocommerce_layout_class();
        $sidebar_class      = array( $woo_layout_class );

        if ( $woo_layout_class != 'full-width' ) { ?>
            <div id="secondary" class="<?php echo esc_attr( implode( ' ', $sidebar_class ) ); ?>" role="complementary">
                <?php
                /**
                 * envy_blog_before_sidebar hook
                 */
                do_action( 'envy_blog_before_sidebar' ); ?>


                <?php dynamic_sidebar( 'envy_blog_sidebar' ); ?>

                <?php
                /**
                 * envy_blog_after_sidebar hook
                 */
                do_action( 'envy_blog_after_sidebar' ); ?>
            </div><!-- #secondary -->
            <?php
        }
    }
}

/*----------------------------------------------------------------------
# Changes the default products per page
-------------------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_woo_product_per_page' ) ) {
    function envy_blog_woo_product_per_page() {
        $products_per_page = 12;
        return absint( $products_per_page );
    }
}

/*----------------------------------------------------------------------
# Changes the default products per row
-------------------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_woo_product_per_row' ) ) {
    function envy_blog_woo_product_per_row() {
        $products_per_row = 4;
        return absint( $products_per_row );
    }
}

/*----------------------------------------------------------------------
# Related Products Args
-------------------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_woo_related_products_args' ) ) {
    function envy_blog_woo_related_products_args() {
        $related_product_per_row    = 4;
        $args['posts_per_page']     = absint( $related_product_per_row );
        $args['columns']            = absint( $related_product_per_row );
        return $args;
    }
}

/*----------------------------------------------------------------------
# Upshell Produts
-------------------------------------------------------------------------*/
function envy_blog_woo_upsell_products_limit() {
    woocommerce_upsell_display(
        absint( 4 ),
        absint( 4 )
    );
}

/*----------------------------------------------------------------------
# Add Product Thumbnail Size
-------------------------------------------------------------------------*/
if ( ! function_exists( 'envy_blog_template_loop_product_thumbnail' ) ) {
    function envy_blog_template_loop_product_thumbnail() {
        global $post, $woocommerce;
        if ( is_archive() ) {
            $size = 'envy-blog-600-3x4';
        } else {
            $size = 'envy-blog-600-3x4';
        }

        $output = '';

        if ( has_post_thumbnail() ) {
            $output .= get_the_post_thumbnail( $post->ID, $size );
        } else {
            $output .= wc_placeholder_img( $size );
            // Or alternatively setting yours width and height shop_catalog dimensions.
            // $output .= '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />';
        }
        echo $output;
    } 
}

/*----------------------------------------------------------------------
# Cross Sell Products
-------------------------------------------------------------------------*/
if ( ! function_exists( 'envy_blog_woocommerce_cross_sells_total' ) ) {
    function envy_blog_woocommerce_cross_sells_total() {
        return absint( 4 );
    }
}
