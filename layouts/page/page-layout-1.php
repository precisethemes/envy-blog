<?php
/**
 * Template part for displaying single Page layout - 1
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Envy Blog
 */

$default_order = array (
    'page-featured-image',
    'page-title',
    'page-content',
);

$content_order_lists    = get_theme_mod( 'envy-blog_page_setting_content_order_list', $default_order );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="page-content align-left">

        <?php
        if ( ! empty( $content_order_lists ) ) :

            foreach ( $content_order_lists as $key => $content_order ) :

                if ( $content_order == 'page-featured-image' && has_post_thumbnail() ) {

                    $img_size = 'envy-blog-960-16x9';

                    if ( envy_blog_layout_class() == 'full-width' ) {
                        $img_size = 'envy-blog-1200-16x9';
                    }

                    $image_id       = get_post_thumbnail_id();
                    $image_path     = wp_get_attachment_image_src( $image_id, $img_size, true );
                    $image_alt      = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                    $alt            = !empty( $image_alt ) ? $image_alt : the_title_attribute( 'echo=0' ) ; ?>

                    <figure class="featured-image order-position order-position-<?php echo esc_attr( $key ); ?>">
                        <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" title="<?php the_title_attribute(); ?>" />
                    </figure><!-- .featured-image -->

                <?php
                } elseif ( $content_order == 'page-title' ) { ?>

                    <header class="entry-header order-position order-position-<?php echo esc_attr( $key ); ?>">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    </header><!-- .entry-header -->

                <?php
                } elseif ( $content_order == 'page-content' ) { ?>

                    <div class="entry-content order-position order-position-<?php echo esc_attr( $key ); ?>">
                        <?php
                        /* translators: %s: Name of current post */
                        the_content(
                            sprintf(
                                __( '<span class="screen-reader-text"> "%s"</span>', 'envy-blog' ),
                                get_the_title()
                            )
                        );

                        wp_link_pages(
                            array(
                                'before'      => '<div class="page-links">' . __( 'Pages:', 'envy-blog' ),
                                'after'       => '</div>',
                                'link_before' => '<span class="page-number">',
                                'link_after'  => '</span>',
                            )
                        );
                        ?>
                    </div><!-- .entry-content -->

                <?php
                }
            endforeach;
        endif;
        ?>

        <footer class="entry-footer">

            <?php

            // We don't want to output .entry-footer if it will be empty, so make sure its not.
            if ( get_edit_post_link() ) {
                envy_blog_edit_link();
            }
            ?>

        </footer><!-- .entry-footer -->

    </div><!-- .page-content -->
</article><!-- #post- -->
