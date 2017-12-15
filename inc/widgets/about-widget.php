<?php
/**
 * Display Author details through About Widget.
 * @package Envy Blog
 */

/*----------------------------------------------------------------------
# Exit if accessed directly
-------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Envy_Blog_About_Us_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'about-section', 'description' => esc_html__('Display author details.', 'envy-blog'));
        $control_ops = array('width' => 200, 'height' => 250);
        parent::__construct(false, $name = esc_html__('PT: About', 'envy-blog'), $widget_ops, $control_ops);
    }

    function form($instance) {
        $instance = wp_parse_args(
            (array)$instance, array(
                'title'                 => '',
                'author'                => 0,
                'alignment'             => 'content-align-left',
                'img_border_radius'     => 2,

            )
        );
        ?>

        <div class="about-us">
            <div class="admin-input-wrap">
                <p>
                    <em><?php esc_html_e('Tip: This widget is used to display user details. Go to Users-> All Users-> Edit and update options.', 'envy-blog'); ?></em>
                </p>
            </div><!-- .admin-input-wrap -->

            <div class="admin-input-wrap">
                <div class="admin-input-label">
                    <label
                    for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'envy-blog'); ?></label>
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
                    <label for="<?php echo $this->get_field_id('author'); ?>"><?php esc_html_e('Author', 'envy-blog'); ?></label>
                </div><!-- .admin-input-label -->

                <div class="admin-input-holder">
                    <select id="<?php echo $this->get_field_id( 'author' ); ?>" name="<?php echo $this->get_field_name( 'author' ); ?>">
                        <option value="0"><?php esc_html_e( 'Select an user', 'envy-blog' ); ?></option>
                        <?php $users = get_users();
                        foreach ( $users as $user ) {
                            echo '<option value="'.esc_attr( $user->ID ).'" '.selected( $user->ID, $instance['author'], true ).'>'.esc_html( $user->display_name ).'</option>';
                        } ?>
                    </select>
                </div><!-- .admin-input-holder -->

                <div class="clear"></div>
            </div><!-- .admin-input-wrap -->

            <div class="admin-input-wrap">
                <div class="admin-input-label">
                    <label for="<?php echo $this->get_field_id('alignment'); ?>"><?php esc_html_e('Content Alignment', 'envy-blog'); ?></label>
                </div><!-- .admin-input-label -->

                <div class="admin-input-holder">
                    <select id="<?php echo $this->get_field_id('alignment'); ?>" name="<?php echo $this->get_field_name('alignment'); ?>">
                        <option value="content-align-left" <?php selected( $instance['alignment'], 'content-align-left' ); ?>><?php esc_html_e( 'Left', 'envy-blog' );?></option>
                        <option value="content-align-center" <?php selected( $instance['alignment'], 'content-align-center' ); ?>><?php esc_html_e( 'Center', 'envy-blog' );?></option>
                    </select>
                </div><!-- .admin-input-holder -->

                <div class="clear"></div>
            </div><!-- .admin-input-wrap -->

            <div class="admin-input-wrap">
                <div class="admin-input-label">
                    <label for="<?php echo $this->get_field_id('img_border_radius'); ?>"><?php esc_html_e('Rounded Image', 'envy-blog'); ?></label>
                </div><!-- .admin-input-label -->

                <div class="admin-input-holder">
                    <input type="number" max="100" min="1" id="<?php echo $this->get_field_id('img_border_radius'); ?>"
                           name="<?php echo $this->get_field_name('img_border_radius'); ?>"
                           value="<?php echo esc_attr($instance['img_border_radius']); ?>">
                </div><!-- .admin-input-holder -->

                <div class="clear"></div>
            </div><!-- .admin-input-wrap -->

        </div><!-- .about-us -->
    <?php }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title']              = sanitize_text_field( $new_instance['title'] );
        $instance['author']             = absint( $new_instance['author'] );
        $instance['alignment']          = sanitize_text_field( $new_instance['alignment'] );
        $instance['img_border_radius']  = absint( $new_instance['img_border_radius'] );

        return $instance;
    }

    function widget($args, $instance) {
        ob_start();
        extract($args);
        
        $title              = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
        $author_id          = isset( $instance['author'] ) ? $instance['author'] : '';
        $text_alignment     = isset( $instance['alignment'] ) ? $instance['alignment'] : 'content-align-left';
        $border_radius      = isset( $instance['img_border_radius'] ) ? $instance['img_border_radius'] : '';
        $inline_style       = '';

        if ( $border_radius != '' ) {
            $inline_style = ' style=border-radius:'.esc_attr( $border_radius ).'px;';
        }

        echo $args['before_widget']; ?>

        <div class="about-widget">
            <?php if ( !empty( $title ) ) : ?>
                <h3 class="widget-title"><?php echo esc_html( $title ); ?></h3>
            <?php endif; ?>

            <?php $user = get_userdata( $author_id );

            if ( !is_wp_error( $user ) && $user ) :
                $author_website = get_the_author_meta( 'url', $user->ID );
                $author_description = $user->description; ?>
                <div class="user-info <?php echo esc_attr( $text_alignment ); ?>">
                    <figure<?php echo $inline_style; ?>>
                        <?php echo get_avatar( $user->ID, 200 ); ?>
                    </figure>

                    <?php printf( '<h4><a href="%1$s" title="%2$s" rel="author">%3$s</a></h4>',
                        esc_url( get_author_posts_url( $user->ID ) ),
                        /* translators: %s: author's display name */
                        esc_attr( $user->display_name ),
                        wp_kses_post( $user->display_name )
                    ); ?>

                    <?php if( $author_website != '' ) : ?>
                        <span class="user-url"><a href="<?php echo esc_url( $author_website ); ?>"><?php echo esc_url( $author_website ); ?></a> </span>
                    <?php endif; ?>

                    <?php if( $author_description != '' ) { echo '<p>'.wp_kses_post( $author_description ).'</p>'; } ?>
                </div><!-- .user-info -->
            <?php endif; ?>
        </div><!-- .about-widget -->

        <?php echo $args['after_widget'];
        ob_end_flush();
    }
}