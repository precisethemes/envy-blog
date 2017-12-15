<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Envy Blog
 */

get_header();
?>

<div class="row <?php echo esc_attr( 'has-' . envy_blog_layout_class() ); ?>">
    <div id="primary" class="content-area <?php echo esc_attr( 'has-' . envy_blog_layout_class() ); ?>">
        <main id="main" class="site-main" role="main">
            <?php
            if ( have_posts() ) : ?>

                <header class="page-header">
                    <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'envy-blog' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </header><!-- .page-header -->

                <?php
                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */
                    get_template_part( 'template-parts/content', 'search' );

                endwhile;

                the_posts_pagination( array(
                    'mid_size' 				=> 4,
                    'prev_text'          	=> __( 'Prev', 'envy-blog' ),
                    'next_text'          	=> __( 'Next', 'envy-blog' ),
                    'before_page_number' 	=> '<span class="meta-nav screen-reader-text">' . __( 'Page', 'envy-blog' ) . ' </span>',
                ) );

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php get_sidebar(); ?>

</div><!-- .row -->

<?php get_footer();
