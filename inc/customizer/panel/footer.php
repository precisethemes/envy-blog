<?php
/**
 * Envy Blog Customizer Footer Panel
 *
 * @package Envy Blog
 */
/*--------------------------------------------------------------
# Footer Panel
--------------------------------------------------------------*/
Kirki::add_panel( 'envy-blog_footer_panel', array(
    'priority'      => 126,
    'title'         => esc_html__( 'Footer', 'envy-blog' ),
));

/*--------------------------------------------------------------
# Back To Top Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_footer_back_to_top_section', array(
    'priority'      => 1,
    'title'         => esc_html__( 'Back to Top', 'envy-blog' ),
    'panel'         => 'envy-blog_footer_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Activate Back to Top Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'      =>  'toggle',
    'settings'  =>  'envy-blog_footer_back_to_top_activate',
    'label'     =>  esc_html__( 'Activate Button', 'envy-blog' ),
    'description' =>  esc_html__( 'Enable it to display back to top button.', 'envy-blog' ),
    'section'   =>  'envy-blog_footer_back_to_top_section',
    'default'   =>  '1',
));

/*--------------------------------------------------------------
# Back to Top Text Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'      =>  'text',
    'settings'  =>  'envy-blog_footer_back_to_top_text',
    'label'     =>  esc_html__( 'Button Text', 'envy-blog' ),
    'section'   =>  'envy-blog_footer_back_to_top_section',
    'default'   =>  esc_html__( 'Back to Top', 'envy-blog' ),
    'transport' => 'postMessage',
    'js_vars'   => array(
        array(
            'element'  => '.back-to-top',
            'function' => 'html',
        ),
    ),
));

/*--------------------------------------------------------------
# Footer Widget Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_footer_widgets_section', array(
    'priority'      => 2,
    'title'         => esc_html__( 'Footer Widgets', 'envy-blog' ),
    'panel'         => 'envy-blog_footer_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Activate Footer Widgets Setting & Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'          =>  'toggle',
    'settings'      =>  'envy-blog_footer_widgets_section_activate',
    'label'         =>  esc_html__( 'Activate', 'envy-blog' ),
    'description'   =>  esc_html__( 'Enable it to display Footer Widget Area on all Pages.', 'envy-blog' ),
    'section'       =>  'envy-blog_footer_widgets_section',
    'default'       =>  '1',
));

/*--------------------------------------------------------------
# Layout Setting & Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'radio-image',
    'settings'    => 'envy-blog_footer_widgets_area_layout',
    'label'       => esc_html__( 'Layout', 'envy-blog' ),
    'description' => esc_html__( 'Select layout for footer widget columns. It generates some widget areas for Footer based on the layout.', 'envy-blog' ),
    'section'     => 'envy-blog_footer_widgets_section',
    'default'     => 'footer-layout-8',
    'choices'     => array(
        'footer-layout-8'           => ENVY_BLOG_THEME_URI . '/inc/assets/images/footer/footer-layout-8.svg',
    ),
) );

/*--------------------------------------------------------------
# Footer Bar Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_footer_bar_section', array(
    'priority'      => 3,
    'title'         => esc_html__( 'Footer Bar', 'envy-blog' ),
    'panel'         => 'envy-blog_footer_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Footer Bar Content Ordering Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'sortable',
    'settings'    => 'envy-blog_footer_bar_content_order_list',
    'label'       => esc_html__( 'Content Order', 'envy-blog' ),
    'description' => esc_html__( 'Drag & Drop items to re-arrange order of appearance.', 'envy-blog' ),
    'section'     => 'envy-blog_footer_bar_section',
    'default'     => array(
        'footer-bar-text',
    ),
    'choices'     => array(
        'footer-bar-text'       => esc_attr__( 'Copyright Text', 'envy-blog' ),
        'footer-bar-social'     => esc_attr__( 'Social Icons', 'envy-blog' ),
    ),
) );
