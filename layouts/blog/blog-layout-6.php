<?php
/**
 * The Blog Layout 6
 *
 * @package Envy Blog
 */

$default_order = array(
    'blog-meta',
    'blog-title',
);
$content_order_lists    = get_theme_mod( 'envy-blog_archive_page_layout6_content_order_list', $default_order );
$excerpt_length         = 18;
$img_size               = 'envy-blog-600-4x3';
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

            <?php if ( has_post_thumbnail() ) : ?>
                <figure class="featured-image">
                    <a class="post-format" href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( $img_size ); ?>
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
