<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Envy Blog
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
    $img_size = 'envy-blog-960-16x9';

	$image_id               = get_post_thumbnail_id();
	$image_path             = wp_get_attachment_image_src( $image_id, $img_size, true );
	$image_alt              = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	$alt 					= !empty( $image_alt ) ? $image_alt : the_title_attribute( 'echo=0' ) ;
	?>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure>
			<img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" title="<?php the_title_attribute(); ?>" />
		</figure>
	<?php endif; ?>

    <div class="page-content">
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
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

            <?php

            // We don't want to output .entry-footer if it will be empty, so make sure its not.
            if ( get_edit_post_link() ) {
                envy_blog_edit_link();
            }
            ?>

        </footer><!-- .entry-footer -->
    </div><!-- .page-content -->
</article><!-- #post-## -->