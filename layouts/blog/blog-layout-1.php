<?php
/**
 * The Blog Layout 1
 *
 * @package Envy Blog
 */

$columns = get_theme_mod( 'envy-blog_archive_page_layout1_display_columns', 'col-3' );
$img_size = 'envy-blog-600-auto';
$columns .= ' child-element';

while ( have_posts() ) : the_post();
    $post_wrap_class = array('post-wrap');
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
