<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Envy Blog
 */

get_header();

$error_title            = get_theme_mod( 'envy-blog_404_error_page_title', 'Oops! That page can\'t be found.' );
$error_description      = get_theme_mod( 'envy-blog_404_error_page_description', 'It looks like nothing was found at this location. Maybe try one of the links below or a search?' );
$activate_search        = get_theme_mod( 'envy-blog_404_error_page_search_activate', true );
$activate_recent_posts  = get_theme_mod( 'envy-blog_404_error_page_recent_post_activate' );
$activate_categories    = get_theme_mod( 'envy-blog_404_error_page_categories_activate' );
$activate_archives      = get_theme_mod( 'envy-blog_404_error_page_archives_activate' );
$activate_tags          = get_theme_mod( 'envy-blog_404_error_page_tags_activate' );
?>

<div class="row">
    <div id="primary" class="content-area full-width">
        <main id="main" class="site-main" role="main">
            <article class="error-404 not-found">
                <div class="page-content align-left">

                    <header class="entry-header">
                        <h1 class="entry-title"><?php echo esc_html( $error_title ); ?></h1>
                    </header><!-- .page-header -->

                    <div class="entry-content">
                        <p><?php echo wp_kses_post( $error_description ); ?></p>

                        <?php
                        if ( true == $activate_search ) :
                            get_search_form();
                        endif;

                        if ( true == $activate_recent_posts ) :
                            the_widget('WP_Widget_Recent_Posts');
                        endif;

                        if ( true == $activate_categories ) :
                            // Only show the widget if site has multiple categories.
                            if (envy_blog_categorized_blog()) :
                                ?>

                                <div class="widget widget_categories">
                                    <h3 class="widget-title"><?php esc_html_e('Most Used Categories', 'envy-blog'); ?></h3>
                                    <ul>
                                        <?php
                                        wp_list_categories(array(
                                            'orderby' => 'count',
                                            'order' => 'DESC',
                                            'show_count' => 1,
                                            'title_li' => '',
                                            'number' => 10,
                                        ));
                                        ?>
                                    </ul>
                                </div><!-- .widget -->

                                <?php
                            endif;
                        endif;

                        if ( true == $activate_archives ) :
                            /* translators: %1$s: smiley */
                            $archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'envy-blog' ), convert_smilies( ':)' ) ) . '</p>';
                            the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h3>$archive_content" );
                        endif;

                        if ( true == $activate_tags ) :
                            the_widget( 'WP_Widget_Tag_Cloud' );
                        endif;
                        ?>

                    </div><!-- .entry-content -->
                </div><!-- .page-content -->
            </article><!-- .error-404 -->
        </main><!-- #main -->
    </div><!-- #primary -->
</div>

<?php get_footer();
