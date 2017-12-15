<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

do_action('woo_envy_blog_breadcrumb'); // WC Breadcrumb section

    /**
     * woocommerce_before_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     * @hooked WC_Structured_Data::generate_website_data() - 30
     */
    do_action( 'woocommerce_before_main_content' );

    $default_img_url                = get_theme_mod( 'envy-blog_archive_page_header_background_image' );
    $archive_content_color_scheme   = get_theme_mod ( 'envy-blog_archive_page_header_content_color_scheme', 'dark' );
    $archive_content_text_alignment = get_theme_mod ( 'envy-blog_archive_page_header_content_text_alignment', 'align-left' );
    $archive_header_class           =  array( 'woocommerce-products-header page-header' );

    if ( $archive_content_color_scheme == 'light' ) {
        $archive_header_class[]         = 'light';
    }

    if ( $archive_content_text_alignment == 'align-center' ) {
        $archive_header_class[]         = 'content-align-center';
    } elseif ( $archive_content_text_alignment == 'align-right' ) {
        $archive_header_class[]         = 'content-align-right';
    }
    ?>

    <div class="row">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <header class="<?php echo esc_attr( implode( ' ', $archive_header_class ) ); ?>">
                    <div class=" woocommerce-products-header-content page-header-content<?php if ( !empty( $image_id ) ) { echo ' has-featured-img'; }?>">

                        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                            <h1 class="woocommerce-products-header__title page-title">
                                <?php if ( is_product_category() ) : ?>
                                    <label><span><?php esc_html_e( 'CATEGORY', 'envy-blog' ); ?></span></label>
                                <?php endif; ?>
                                <?php if ( is_product_tag() ) : ?>
                                    <label><span><?php esc_html_e( 'TAG', 'envy-blog' ); ?></span></label>
                                <?php endif; ?>
                                <?php woocommerce_page_title(); ?>
                            </h1>

                        <?php endif; ?>

                        <?php
                        /**
                         * woocommerce_archive_description hook.
                         *
                         * @hooked woocommerce_taxonomy_archive_description - 10
                         * @hooked woocommerce_product_archive_description - 10
                         */
                        do_action( 'woocommerce_archive_description' );
                        ?>

                    </div><!-- .woocommerce-products-header-content -->
                </header>

                <?php if ( have_posts() ) : $col = absint( 4 ); ?>

                    <?php
                    /**
                     * woocommerce_before_shop_loop hook.
                     *
                     * @hooked wc_print_notices - 10
                     * @hooked woocommerce_result_count - 20
                     * @hooked woocommerce_catalog_ordering - 30
                     */
                    do_action( 'woocommerce_before_shop_loop' );
                    ?>
                    <div class="product-list has-col-<?php echo esc_attr( $col ); ?>">

                        <?php woocommerce_product_loop_start(); ?>

                        <?php woocommerce_product_subcategories(); ?>

                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php
                            /**
                             * woocommerce_shop_loop hook.
                             *
                             * @hooked WC_Structured_Data::generate_product_data() - 10
                             */
                            do_action( 'woocommerce_shop_loop' );

                            ?>
                            <li <?php post_class( 'col-' . esc_attr( $col ) ); ?>>

                                <?php wc_get_template_part( 'content', 'product' ); ?>

                            </li>

                        <?php endwhile; // end of the loop. ?>

                        <?php woocommerce_product_loop_end(); ?>

                    </div>

                    <?php
                    /**
                     * woocommerce_after_shop_loop hook.
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action( 'woocommerce_after_shop_loop' );
                    ?>

                <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                    <?php
                    /**
                     * woocommerce_no_products_found hook.
                     *
                     * @hooked wc_no_products_found - 10
                     */
                    do_action( 'woocommerce_no_products_found' );
                    ?>

                <?php endif; ?>

                <?php
                /**
                 * woocommerce_after_main_content hook.
                 *
                 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                 */
                do_action( 'woocommerce_after_main_content' );
                ?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .row -->

<?php get_footer( 'shop' );
