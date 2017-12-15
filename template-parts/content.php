<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Envy Blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php
    $sidebar_class = envy_blog_layout_class();
    if ( $sidebar_class == 'full-width' ) {
        $img_size = 'envy-blog-1200-16x9';
    } else {
        $img_size = 'envy-blog-960-16x9';
    }
    $image_id               = get_post_thumbnail_id();
    $image_path             = wp_get_attachment_image_src( $image_id, $img_size, true );
    $image_alt              = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
    $alt                    = !empty( $image_alt ) ? $image_alt : the_title_attribute( 'echo=0' ) ;
    ?>

    <?php if( has_post_thumbnail() ) : ?>
        <figure>
            <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" title="<?php the_title_attribute(); ?>" />
        </figure>
    <?php endif; ?>

    <div class="content-wrap">
        <header class="entry-header">
            <?php
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

            ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
            $content = wp_trim_words( get_the_excerpt(), 18, '...' );
            echo '<p>'.wp_kses_post( $content ).'</p>';

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'envy-blog' ),
                'after'  => '</div>',
            ) );
            ?>
        </div><!-- .entry-content -->
    </div><!-- .content-wrap -->

</article><!-- #post-## -->
