<?php
/**
 * Display Featured Posts through Recent Posts Widget.
 * @package Envy Blog
 */

/*----------------------------------------------------------------------
# Exit if accessed directly
-------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Envy_Blog_Recent_Posts_Widget extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'recent-posts-section', 'description' => esc_html__('Display latest posts or posts of specific category.', 'envy-blog'));
        $control_ops = array('width' => 200, 'height' => 250);
        parent::__construct(false, $name = esc_html__('PT: Recent Posts', 'envy-blog'), $widget_ops, $control_ops);

    }

    function form($instance) {
        $instance = wp_parse_args(
            (array)$instance, array(
                'title'             => '',
                'type'              => 'latest',
                'category'          => '',
                'limit'             => 4,
                'excerpt_limit'     => 15,
                'off_read_more'     => 1,
                'layout'            => 'recent-posts-layout-1',
            )
        );
        $enable_read_more   = $instance['off_read_more'] ? 'checked="checked"' : '';
        $envy_blog_categories = envy_blog_categories_lists();
        ?>

        <div class="recent-posts">
            <div class="admin-input-wrap">
                <div class="admin-input-label">
                    <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'envy-blog'); ?></label>
                </div><!-- .admin-input-label -->

                <div class="admin-input-holder">
                    <input type="text" id="<?php echo $this->get_field_id('title'); ?>"
                           name="<?php echo $this->get_field_name('title'); ?>"
                           value="<?php echo esc_attr($instance['title']); ?>">
                </div><!-- .admin-input-holder -->

                <div class="clear"></div>
            </div><!-- .admin-input-wrap -->

            <div class="admin-input-wrap">
                <div class="admin-input-label">
                    <label for="<?php echo $this->get_field_id('type'); ?>"><?php esc_html_e('Post Type', 'envy-blog'); ?></label>
                </div><!-- .admin-input-label -->

                <div class="admin-input-holder">
                    <select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
                        <option value="latest" <?php selected( $instance['type'], 'latest' ); ?>><?php esc_html_e( 'Latest Posts', 'envy-blog' );?></option>
                        <option value="random" <?php selected( $instance['type'], 'random' ); ?>><?php esc_html_e( 'Random Posts', 'envy-blog' );?></option>
                        <option value="category" <?php selected( $instance['type'], 'category' ); ?>><?php esc_html_e( 'By Category', 'envy-blog' );?></option>
                    </select>
                </div><!-- .admin-input-holder -->

                <div class="clear"></div>
            </div><!-- .admin-input-wrap -->

            <div class="admin-input-wrap" id="row_dim">
                <div class="admin-input-label">
                    <label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e('Select Category', 'envy-blog'); ?></label>
                </div><!-- .admin-input-label -->

                <div class="admin-input-holder">
                    <select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
                        <?php foreach ( $envy_blog_categories as $cat_slug => $cat_name ) : ?>
                            <option value="<?php echo esc_attr( $cat_slug ); ?>" <?php selected( $instance['category'], $cat_slug ); ?>><?php echo esc_html( $cat_name ); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p><em><?php esc_html_e('Note:- List the posts by category please select post type as by category.', 'envy-blog'); ?></em></p>
                </div><!-- .admin-input-holder -->

                <div class="clear"></div>
            </div><!-- .admin-input-wrap -->

            <div class="admin-input-wrap">
                <div class="admin-input-label">
                    <label for="<?php echo $this->get_field_id('limit'); ?>"><?php esc_html_e('Number of Posts', 'envy-blog'); ?></label>
                </div><!-- .admin-input-label -->

                <div class="admin-input-holder">
                    <input type="number" max="12" min="1" id="<?php echo $this->get_field_id('limit'); ?>"
                           name="<?php echo $this->get_field_name('limit'); ?>"
                           value="<?php echo esc_attr($instance['limit']); ?>">
                    <p><em><?php esc_html_e('Note:- For layout 3 max post limit is 5.', 'envy-blog'); ?></em></p>
                </div><!-- .admin-input-holder -->

                <div class="clear"></div>
            </div><!-- .admin-input-wrap -->

            <div class="admin-input-wrap">
                <div class="admin-input-label">
                    <label for="<?php echo $this->get_field_id('excerpt_limit'); ?>"><?php esc_html_e('Excerpt Limit', 'envy-blog'); ?></label>
                </div><!-- .admin-input-label -->

                <div class="admin-input-holder">
                    <input type="number" max="30" min="0" id="<?php echo $this->get_field_id('excerpt_limit'); ?>"
                           name="<?php echo $this->get_field_name('excerpt_limit'); ?>"
                           value="<?php echo esc_attr($instance['excerpt_limit']); ?>">
                </div><!-- .admin-input-holder -->

                <div class="clear"></div>
            </div><!-- .admin-input-wrap -->

            <div class="admin-input-wrap">
                <div class="admin-input-label">
                    <label for="<?php echo $this->get_field_id('off_read_more'); ?>"><?php esc_html_e('Show Read More', 'envy-blog'); ?></label>
                </div><!-- .admin-input-label -->

                <div class="admin-input-holder">
                    <input type="checkbox" id="<?php echo $this->get_field_id('off_read_more'); ?>"
                           name="<?php echo $this->get_field_name('off_read_more'); ?>"
                           value="<?php echo esc_attr($instance['off_read_more']); ?>"
                        <?php echo $enable_read_more; ?>>
                </div><!-- .admin-input-holder -->

                <div class="clear"></div>
            </div><!-- .admin-input-wrap -->

            <div class="admin-input-wrap">
                <div class="admin-input-label">
                    <label for="<?php echo $this->get_field_id('layout'); ?>"><?php esc_html_e('Layout', 'envy-blog'); ?></label>
                </div><!-- .admin-input-label -->

                <div class="admin-input-holder">
                    <select id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
                        <option value="recent-posts-layout-1" <?php selected( $instance['layout'], 'recent-posts-layout-1' ); ?>><?php esc_html_e( 'Layout 1', 'envy-blog' );?></option>
                        <option value="recent-posts-layout-2" <?php selected( $instance['layout'], 'recent-posts-layout-2' ); ?>><?php esc_html_e( 'Layout 2', 'envy-blog' );?></option>
                    </select>
                </div><!-- .admin-input-holder -->

                <div class="clear"></div>
            </div><!-- .admin-input-wrap -->
        </div><!-- .recent-posts -->

    <?php }

    function update($new_instance, $old_instance) {
        $instance                       = $old_instance;
        $instance['title']              = sanitize_text_field( $new_instance['title'] );
        $instance['type']               = sanitize_text_field( $new_instance['type'] );
        $instance['category']           = sanitize_text_field( $new_instance['category'] );
        $instance['limit']              = absint( $new_instance['limit'] );
        $instance['excerpt_limit']      = absint( $new_instance['excerpt_limit'] );
        $instance['off_read_more']      = isset( $new_instance['off_read_more'] ) ? 1 : 0;
        $instance['layout']             = sanitize_text_field( $new_instance['layout'] );
        return $instance;
    }

    function widget($args, $instance) {
        ob_start();
        extract($args);

        $title              = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
        $type               = isset( $instance['type'] ) ? $instance['type'] : 'latest';
        $category_slug      = isset( $instance['category'] ) ? $instance['category'] : '';
        $limit              = isset( $instance['limit'] ) ? $instance['limit'] : 4;
        $excerpt_length     = isset( $instance['excerpt_limit'] ) ? $instance['excerpt_limit'] : 15;
        $enable_read_more   = !empty( $instance['off_read_more'] ) ? 'true' : 'false';
        $post_layout        = isset( $instance['layout'] ) ? $instance['layout'] : 'recent-posts-layout-1';

        if ( $type == 'random' ) {
            $get_featured_posts = new WP_Query( array(
                'posts_per_page'    => intval( $limit ),
                'post_type'         => 'post',
                'no_found_rows'     => true,
                'orderby'           => 'rand',
            ) );
        } elseif ( $type == 'category' ) {
            $cat            = get_category_by_slug($category_slug);
            $category_id    = $cat->term_id;
            $get_featured_posts = new WP_Query( array(
                'posts_per_page'    => intval( $limit ),
                'post_type'         => 'post',
                'cat'               =>  absint( $category_id ),
                'no_found_rows'     => true,
            ) );
        } else {
            $get_featured_posts = new WP_Query( array(
                'posts_per_page'    => intval( $limit ),
                'post_type'         => 'post',
                'no_found_rows'     => true,
            ) );
        }

        echo $args['before_widget']; ?>

        <div class="recent-posts-wrap <?php echo esc_attr( $post_layout ); ?>">
            <?php if ( !empty( $title ) ) : ?>

                <h3 class="widget-title"><?php echo esc_html( $title ); ?></h3>

            <?php endif; ?>



            <?php
            if ( $get_featured_posts->have_posts() ) :
                $article_class  = array( 'recent-post-wrap' );

                if ( $post_layout == 'recent-posts-layout-1' ) {
                    $img_size = 'thumbnail';
                } else {
                    $img_size = 'envy-blog-600-4x3';
                }

                while ( $get_featured_posts->have_posts() ) : $get_featured_posts->the_post();
                    // Retrieve an existing value from the database.
                    $image_id       = get_post_thumbnail_id();
                    $image_path     = wp_get_attachment_image_src( $image_id, $img_size, true );
                    $image_alt      = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                    $alt            = !empty( $image_alt ) ? $image_alt : the_title_attribute( 'echo=0' ) ;
                    ?>

                    <article class="<?php echo esc_attr( implode( ' ', $article_class ) ); ?>">
                        <div class="recent-post-title<?php if ( $post_layout == 'recent-posts-layout-1' ) { echo ' ' . 'recent-post-flex'; } ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <figure>
                                    <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" title="<?php the_title_attribute(); ?>" />
                                    </a>
                                </figure>
                            <?php endif; ?>

                            <header class="entry-header<?php if ( !has_post_thumbnail() ) { echo ' ' .esc_attr('no-featured-img'); } ?>">
                                <div class="entry-meta">
                                    <?php
                                    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

                                    if( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                                        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
                                    }

                                    $time_string = sprintf( $time_string,
                                        esc_attr( get_the_date( 'c' ) ),
                                        esc_html( get_the_date() ),
                                        esc_attr( get_the_modified_date( 'c' ) ),
                                        esc_html( get_the_modified_date() )
                                    );

                                    if ( true == get_theme_mod( 'envy-blog_general_human_time_diff_activate', true ) ) {
                                        $time_string = sprintf( _x( '%s ago', '%s = human-readable time difference', 'envy-blog' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
                                    }

                                    $posted_on = '<span class="posted-date">';

                                    $posted_on .= '<a href="' . esc_url( get_permalink() ) . '">';
                                    $posted_on .= $time_string;
                                    $posted_on .= '</a>';
                                    $posted_on .= '</span>';
                                    echo $posted_on; ?>
                                </div><!-- .entry-meta -->
                                <h4 class="entry-title"><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            </header><!-- .entry-header -->
                        </div><!-- .recent-post-flex -->

                        <?php if ( $excerpt_length > 0 ) : ?>
                            <div class="entry-content">
                                <p><?php echo wp_trim_words( get_the_excerpt(), $excerpt_length, '...' ); ?></p>
                            </div><!-- .entry-content -->
                        <?php endif; ?>

                        <?php if ( 'true' == $enable_read_more ) : ?>
                            <footer class="entry-footer">
                                <?php echo envy_blog_blog_read_more_button(); ?>
                            </footer><!-- .entry-footer -->
                        <?php endif; ?>
                    </article><!-- .recent-posts-col -->
                <?php endwhile;
                // Reset Post Data
                wp_reset_postdata();

            endif; ?>
        </div><!-- .recent-posts-wrap -->

        <?php echo $args['after_widget'];
        ob_end_flush();
    }
}