<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Envy Blog
 */

$layout_class       = envy_blog_layout_class();

if ( $layout_class != "full-width" ) : ?>

    <aside id="secondary" class="<?php echo esc_attr( $layout_class ); ?>" role="complementary">

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

    </aside><!-- .sidebar-wrap -->

<?php endif;
