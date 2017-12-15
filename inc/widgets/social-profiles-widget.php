<?php
/**
 * Display Social Profiles Icons through Social Profiles Widget.
 * @package Envy Blog
 */

/*----------------------------------------------------------------------
# Exit if accessed directly
-------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Envy_Blog_Social_Profiles_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'social-profiles-section', 'description' => esc_html__('Display social profiles.', 'envy-blog'));
        $control_ops = array('width' => 200, 'height' => 250);
        parent::__construct(false, $name = esc_html__('PT: Social Profiles', 'envy-blog'), $widget_ops, $control_ops);
    }

    function form($instance) {
        $instance = wp_parse_args(
            (array)$instance, array(
                'title' => '',
            )
        );
        ?>

        <div class="social-profiles">
            <div class="admin-input-wrap">
                <p>
                    <em><?php esc_html_e('Tip: This widget is used to display social profiles for that you have to set profile links through Appearance-> Customize-> Social-> Social Profiles.', 'envy-blog'); ?></em>
                </p>
            </div><!-- .admin-input-wrap -->

            <div class="admin-input-wrap">
                <div class="admin-input-label">
                    <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'envy-blog'); ?></label>
                </div><!-- .admin-input-label -->

                <div class="admin-input-holder">
                    <input type="text" id="<?php echo $this->get_field_id('title'); ?>"
                       name="<?php echo $this->get_field_name('title'); ?>"
                       value="<?php echo esc_attr($instance['title']); ?>"
                       placeholder="<?php esc_attr_e('Title', 'envy-blog'); ?>">
                </div><!-- .admin-input-holder -->

                <div class="clear"></div>
            </div><!-- .admin-input-wrap -->
        </div><!-- .social-profiles -->
    <?php }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = sanitize_text_field( $new_instance['title'] );

        return $instance;
    }

    function widget($args, $instance) {
        ob_start();
        extract($args);
        
        $title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );

        $default_social_profiles = array(
            array(
                'social_name'   => esc_html__( 'Facebook', 'envy-blog' ),
                'social_url'    => 'https://facebook.com/',
                'social_icon'   => 'fa-facebook',
                'social_image'  => '',
            )
        );
        $social_profiles        = get_theme_mod( 'envy-blog_social_repeatable_social_profiles', $default_social_profiles );

        echo $args['before_widget']; ?>

        <div class="social-profiles-widget">
            <?php if ( !empty( $title ) ) : ?>
                <h3 class="widget-title"><?php echo esc_html( $title ); ?></h3>
            <?php endif; ?>

            <?php if ( !empty( $social_profiles ) ) : ?>
                <ul>
                    <?php
                    foreach ( $social_profiles as $social_profile ) {
                        if ( '' != $social_profile['social_url'] ) {
                            $font_icon = $social_profile['social_icon'];
                            $social_icon = '<i class="fa '.esc_attr( $font_icon ). '"></i>';

                            if ( '' != $social_profile['social_image'] ){
                                $image_id = $social_profile['social_image'];
                                $image_path = wp_get_attachment_image_src( $image_id, 'thumbnail', true );
                                $social_icon = '<img src="'.esc_url( $image_path[0] ).'" />';
                            } ?>

                            <li><a href="<?php echo esc_url( $social_profile['social_url'] );?>" target="_blank"><?php echo $social_icon; ?></a></li>

                            <?php
                        }
                    }
                    ?>
                </ul><!-- .social-profiles -->
            <?php endif; ?>
        </div><!-- .social-profiles-sec -->

        <?php echo $args['after_widget'];
        ob_end_flush();
    }
}