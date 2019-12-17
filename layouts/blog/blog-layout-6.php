<?php
/**
 * The Blog Layout 6
 *
 * @package Envy Blog
 */
global $post;
$default_order = array(
    'blog-meta',
    'blog-title',
);
$content_order_lists    = get_theme_mod( 'envy-blog_archive_page_layout6_content_order_list', $default_order );
$defined_size           = 'envy-blog-600-4x3';
$columns                = 'child-element';

while ( have_posts() ) : the_post();
    $post_wrap_class    = array('post-wrap');
    $post_wrap_class[]  = 'post-flex';

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
                $imgInfo        = $thumbnail_meta['sizes'][$thumbnail_size]; ?>

                <figure class="featured-image">
                    <a class="post-format" href="<?php the_permalink(); ?>">
                        <?php echo '<img width="'.esc_attr($imgInfo['width']).'" height="'.esc_attr($imgInfo['height']).'" src="'.esc_url($image_path[0]).'" class="'.esc_attr( implode( ' ', $thumbnail_class ) ).'" alt="'.esc_attr($alt).'">'; ?>
                    </a>
                </figure><!-- .featured-image -->

            <?php endif; ?>

            <div class="content-holder">


                <?php if ( ! empty( $content_order_lists ) ) : ?>
                    <?php foreach ( $content_order_lists as $key => $content_order ) :
                        if ( $content_order == 'blog-meta' ) { ?>

                            <div class="entry-meta order-position order-position-<?php echo esc_attr( $key ); ?>">
                                <?php
                                echo '<span class="posted-date">';
                                echo envy_blog_posts_date();
                                echo '</span>';

                                echo '<span class="posted-author">';
                                echo envy_blog_posts_author();
                                echo '</span>';
                                ?>
                            </div><!-- .entry-meta -->

                        <?php } elseif ( $content_order == 'blog-title' ) { ?>
                            <h2 class="entry-title order-position order-position-<?php echo esc_attr( $key ); ?>">
                                <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                        <?php
                        }
                    endforeach; ?>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    $content = wp_trim_words( get_the_excerpt(), 18, '...' );
                    echo '<p>'.wp_kses_post( $content ).'</p>';
                    ?>
                </div><!-- .entry-summary -->

                <footer class="entry-footer">
                    <?php echo envy_blog_blog_read_more_button(); ?>
                </footer><!-- .entry-footer -->

            </div><!-- .content-holder -->
            
        </div><!-- .post-wrap -->
    </article><!-- #post-<?php the_ID(); ?> -->

<?php endwhile;
