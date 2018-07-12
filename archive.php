<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Envy Blog
 */

get_header();

    $blog_layout    = get_theme_mod( 'envy-blog_archive_page_layout', 'blog-layout-1' );
    ?>

    <div class="row">
        <header class="page-header">
            <div class="page-header-content<?php if ( is_author() ) { echo ' is-author-archive'; }?>">
                <?php if ( is_author() ) {
                    $user_id = get_current_user_id();

                    $author_avatar = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'envy_blog_author_bio_avatar_size', 75 ) );

                    if ( $author_avatar ) { ?>
                        <figure class="author-avatar">
                            <?php echo wp_kses_post( $author_avatar ); ?>
                        </figure><!-- .author-avatar -->
                    <?php } ?>

                    <div class="author-content">
                        <?php envy_blog_archive_title( '<h3 class="page-title">', '</h1>' ); ?>
                    </div><!-- .author-content -->

                    <?php the_archive_description( '<p>', '</p>' ); ?>

                <?php } else {
                    envy_blog_archive_title( '<h1 class="page-title">', '</h1>' );

                    the_archive_description();
                } ?>

            </div><!-- .page-header-content -->
        </header><!-- .page-header -->
    </div><!-- .row -->

    <div class="row">
        <div id="primary" class="content-area">
            <?php
            if ( have_posts() ) :

                // Blog Posts
                $blog_classes = array( 'blog-layout' );
                $blog_classes[] = $blog_layout;

                if ( $blog_layout == 'blog-layout-1' ) {

                    $columns = get_theme_mod( 'envy-blog_archive_page_layout1_display_columns', 'col-3' );
                    $blog_classes[] = 'masonry';
                    $blog_classes[] = 'has-'.$columns;

                    echo '<div class="'.esc_attr( implode( ' ', $blog_classes ) ).'">';
                    get_template_part( 'layouts/blog/blog-layout-1', get_post_format() );
                    echo '</div><!-- .'.esc_attr( $blog_layout ).'-->';

                } elseif ( $blog_layout == 'blog-layout-6' ) {
                    $blog_classes[] = 'has-left-align-image';

                    echo '<div class="'.esc_attr( implode( ' ', $blog_classes ) ).'">';
                    get_template_part( 'layouts/blog/blog-layout-6', get_post_format() );
                    echo '</div><!-- .'.esc_attr( $blog_layout ).'-->';

                }

                // Pagination
                get_template_part( 'layouts/pagination/pagination', get_post_format() );

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif; ?>
        </div>

    </div><!-- .row -->

<?php get_footer();
