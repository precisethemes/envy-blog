<?php
/**
 * Template part for displaying single post layout - 1
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Envy Blog
 */

$default_order = array(
    'post-featured-image',
    'post-title',
    'post-meta',
    'post-content',
);
$content_order_lists    = get_theme_mod( 'envy-blog_post_layout1_content_order_list', $default_order );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-content align-left">

        <?php
        if ( ! empty( $content_order_lists ) ) :

            foreach ( $content_order_lists as $key => $content_order ) :

                if ( $content_order == 'post-featured-image' && has_post_thumbnail() ) {

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
                } elseif ( $content_order == 'post-title' ) { ?>

                    <header class="entry-header order-position order-position-<?php echo esc_attr( $key ); ?>">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    </header><!-- .entry-header -->

                    <?php
                } elseif ( $content_order == 'post-meta' ) { ?>

                    <div class="entry-meta order-position order-position-<?php echo esc_attr( $key ); ?>">
                        <?php
                        echo '<span class="posted-date">';
                        echo envy_blog_posts_date();
                        echo '</span>';

                        echo '<span class="posted-author">';
                        echo envy_blog_posts_author();
                        echo '</span>';

                        echo '<span class="posted-comment">';
                        echo envy_blog_posts_comment();
                        echo '</span>';
                        ?>

                    </div><!-- .entry-meta -->

                    <?php
                } elseif ( $content_order == 'post-content' ) { ?>

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

                    <footer class="entry-footer">


                        <div class="entry-meta">
                            <?php
                            echo '<span class="posted-category">';
                            echo envy_blog_posts_category();
                            echo '</span>';

                            echo '<span class="posted-tag">';
                            echo envy_blog_posts_tags();
                            echo '</span>';
                            ?>
                        </div><!-- .entry-meta -->


                        <?php
                        // We don't want to output .entry-footer if it will be empty, so make sure its not.
                        if ( get_edit_post_link() ) {
                            envy_blog_edit_link();
                        }
                        ?>

                    </footer><!-- .entry-footer -->

                    <?php
                }
            endforeach;
        endif;

        // Post Author
        if ( true == get_theme_mod ( 'envy-blog_post_author_activate' ) ) {
            get_template_part( 'inc/author-bio', get_post_format() );
        }

        // Post Navigation
        get_template_part( 'layouts/navigation/post-navigation', get_post_format() );
        ?>

    </div><!-- .post-content -->
</article><!-- #post- -->
