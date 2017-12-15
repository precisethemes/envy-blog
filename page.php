<?php
/**
 * The template for displaying single pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Envy Blog
 */

get_header();

$page_layout   = get_theme_mod( 'envy-blog_page_layout', 'page-layout-1' );
$sidebar_class = envy_blog_layout_class();

$row_class      = array('row');
$row_class[]    = 'page-layout';
$row_class[]    = 'has-'.$sidebar_class;
$row_class[]    = $page_layout;

?>

<div class="<?php echo esc_attr( implode( ' ', $row_class ) ); ?>">
    <div id="primary" class="content-area <?php echo esc_attr( 'has-'.$sidebar_class ); ?>">
        <main id="main" class="site-main" role="main">

            <?php
            while ( have_posts() ) : the_post();

                if ( $page_layout == 'page-layout-1' ) {
                    get_template_part( 'layouts/page/page-layout-1', get_post_format() );
                } else {
                    get_template_part('template-parts/content', 'page');
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
