<?php
/**
 * Register widget area.
 * @package Envy Blog
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

/*----------------------------------------------------------------------
# Exit if accessed directly
-------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function envy_blog_widgets_init() {

    /* --------------------------------------------- 
    # Theme Default Sidebar
    ---------------------------------------------*/
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'envy-blog' ),
        'id'            => 'envy_blog_sidebar',
        'description'   => esc_html__( 'Add widgets in your sidebar of theme.', 'envy-blog' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>'
    ) );

    /* --------------------------------------------- 
    # Footer Widget Areas
    ---------------------------------------------*/
    $activate_footer_widget_area = get_theme_mod( 'envy-blog_footer_widgets_section_activate', true );
    $footer_widgets_layout = get_theme_mod( 'envy-blog_footer_widgets_area_layout', 'footer-layout-8' );

    if ( true == $activate_footer_widget_area ) {
        $number_of_widgets = '';
        if ( $footer_widgets_layout == 'footer-layout-8' ) {
            $number_of_widgets = '4';
        }
        for ( $i = 1; $i <= $number_of_widgets; $i++ ) {
            register_sidebar(array(
                'name'          => sprintf( /* Translators: %d: widget number */
                    esc_html__('Footer %d', 'envy-blog'), $i),
                'id'            => 'envy-blog-footer-sidebar-' . $i,
                'description'   => sprintf( /* Translators: %d: widget number */
                    esc_html__('Add widgets in your footer widget area %d.', 'envy-blog'), $i),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ));
        }
    }

    register_widget( "Envy_Blog_Recent_Posts_Widget" );
    register_widget( "Envy_Blog_About_Us_Widget" );
    register_widget( "Envy_Blog_Social_Profiles_Widget" );

}
add_action( 'widgets_init', 'envy_blog_widgets_init' );

/**************************************************************************************/

get_template_part( '/inc/widgets/recent-posts-widget', get_post_format() );
get_template_part( '/inc/widgets/about-widget', get_post_format() );
get_template_part( '/inc/widgets/social-profiles-widget', get_post_format() );
