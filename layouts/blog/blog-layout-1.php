<?php
/**
 * The Blog Layout 1
 *
 * @package Envy Blog
 */
global $post;
$columns        = get_theme_mod( 'envy-blog_archive_page_layout1_display_columns', 'col-3' );
$defined_size   = 'envy-blog-600-auto';
$columns        .= ' child-element';

while ( have_posts() ) : the_post();
    $post_wrap_class = array('post-wrap');
    if ( !has_post_thumbnail() ) {
        $post_wrap_class[] = 'no-featured-img';
    }
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( $columns ); ?>>
        <div class="<?php echo esc_attr( implode(' ',$post_wrap_class) ); ?>">

            <?php if ( has_post_thumbnail() ) :
                $image_id               = get_post_thumbnail_id( $post->ID );
                $image_alt              = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                $alt 					= !empty( $image_alt ) ? $image_alt : the_title_attribute( 'echo=0' ) ;
                $thumbnail_meta         = wp_get_attachment_metadata ( $image_id );
                if ( isset($thumbnail_meta['sizes'][$defined_size] ) ) { // change image size to default 'thumbnail' if not match to theme required size.
                    $thumbnail_size = $defined_size;
                    $thumbnail_class = array('wp-post-image');
                    $thumbnail_class[] = 'attachment-'.$thumbnail_size;
                    $thumbnail_class[] = 'size-'.$thumbnail_size;
                } else {
                    $thumbnail_size = 'thumbnail';
                    $thumbnail_class = array('wp-post-image object-fit-cover');
                    $thumbnail_class[] = 'attachment-'.$thumbnail_size;
                    $thumbnail_class[] = 'size-'.$thumbnail_size;
                }
                $image_path     = wp_get_attachment_image_src( $image_id, $thumbnail_size, true );
                $imgInfo        = $thumbnail_meta['sizes'][$thumbnail_size];
                $padding_top    = ( $imgInfo['height']/$imgInfo['width'] ) * 100; ?>

                <figure class="featured-image" style="padding-top: <?php echo esc_attr( $padding_top ); ?>%;">
                    <a class="post-format" href="<?php the_permalink(); ?>">
                        <?php echo '<img width="'.esc_attr($imgInfo['width']).'" height="'.esc_attr($imgInfo['height']).'" src="'.esc_url($image_path[0]).'" class="'.esc_attr( implode( ' ', $thumbnail_class ) ).'" alt="'.esc_attr($alt).'">'; ?>
                    </a>
                </figure><!-- .featured-image -->

            <?php endif; ?>

            <div class="content-holder">

                <div class="entry-meta">
                    <span class="post-date">
                        <?php echo envy_blog_posts_date(); ?>
                    </span>
                </div><!-- .entry-meta -->

                <h2 class="entry-title">

                    <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                        <?php the_title(); ?>
                    </a>

                </h2>

            <div class="entry-content">
                <?php
                $content = wp_trim_words( get_the_excerpt(), 18, '...' );
                echo '<p>'.wp_kses_post( $content ).'</p>';
                ?>
            </div><!-- .entry-summary -->


            <footer class="entry-footer">
                <?php echo envy_blog_blog_read_more_button(); ?>
            </footer><!-- .entry-footer -->

        </div><!-- .post-wrap -->
    </article><!-- #post-<?php the_ID(); ?> -->

<?php endwhile;
