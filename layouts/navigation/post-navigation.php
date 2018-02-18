<?php
/**
 * The post navigation
 *
 * @package Envy Blog
 */

$post_navigation_activate   = get_theme_mod( 'envy-blog_post_navigation_activate', true );
$post_navigation_layout     = get_theme_mod( 'envy-blog_post_navigation_layout', 'navigation-layout-2' );

if ( true == $post_navigation_activate ) :
    if ( 'navigation-layout-2' == $post_navigation_layout ) : ?>

        <div class="post-navigation-wrap <?php echo esc_attr( $post_navigation_layout ); ?>">
            <?php the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Post', 'envy-blog' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Next post:', 'envy-blog' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous Post', 'envy-blog' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Previous post:', 'envy-blog' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
            ) ); ?>
        </div><!-- .post-navigation-wrap -->

    <?php
    endif;
endif;
