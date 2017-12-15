<?php
/**
 * The template for displaying all single post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Envy Blog
 */

get_header();
$sidebar_class  = envy_blog_layout_class();
$post_layout    = get_theme_mod( 'envy-blog_post_layout', 'post-layout-1' );
$row_class      = array('row');
$row_class[]    = 'post-layout';
$row_class[]    = 'has-'.$sidebar_class;
$row_class[]    = $post_layout;

?>

<div class="<?php echo esc_attr( implode( ' ', $row_class ) ); ?>">
    <div id="primary" class="content-area <?php echo esc_attr( 'has-'.$sidebar_class ); ?>">
        <main id="main" class="site-main" role="main">

            <?php
                while ( have_posts() ) : the_post();

                if ( $post_layout == 'post-layout-1' ) {
                    get_template_part( 'layouts/post/post-layout-1', get_post_format() );
                } else {
                    get_template_part('template-parts/content', 'post');
                }

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                comments_template();
                endif;

                endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php get_sidebar(); ?>

</div><!-- .row -->

<?php get_footer();
