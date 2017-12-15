<?php
/**
 * Envy Blog Customizer 404 Panel
 *
 * @package Envy Blog
 */

/*--------------------------------------------------------------
# 404 Error Panel
--------------------------------------------------------------*/
Kirki::add_panel( 'envy-blog_404_error_page_panel', array(
    'priority'      => 122,
    'title'         => esc_html__( '404 Error Page', 'envy-blog' ),
));

/*--------------------------------------------------------------
# 404 Error Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_404_error_page_section', array(
    'priority'      => 1,
    'title'         => esc_html__( 'Page Settings', 'envy-blog' ),
    'panel'         => 'envy-blog_404_error_page_panel',
    'capability'    => 'edit_theme_options',
));


/*--------------------------------------------------------------
# Error Page Title Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'          =>  'text',
    'settings'      =>  'envy-blog_404_error_page_title',
    'label'         =>  esc_html__( 'Title', 'envy-blog' ),
    'section'       =>  'envy-blog_404_error_page_section',
    'default'       =>  __( 'Oops! That page can\'t be found.', 'envy-blog' ),
));

/*--------------------------------------------------------------
# Error Page Description Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'          =>  'textarea',
    'settings'      =>  'envy-blog_404_error_page_description',
    'label'         =>  esc_html__( 'Short Description', 'envy-blog' ),
    'section'       =>  'envy-blog_404_error_page_section',
    'default'       =>  esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'envy-blog' ),
));

/*--------------------------------------------------------------
# Activate Search Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'      =>  'toggle',
    'settings'  =>  'envy-blog_404_error_page_search_activate',
    'label'     =>  esc_html__( 'Search Bar', 'envy-blog' ),
    'section'   =>  'envy-blog_404_error_page_section',
    'default'   =>  '1',
));

/*--------------------------------------------------------------
# Activate Recent Posts Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'      =>  'toggle',
    'settings'  =>  'envy-blog_404_error_page_recent_post_activate',
    'label'     =>  esc_html__( 'Recent Post', 'envy-blog' ),
    'section'   =>  'envy-blog_404_error_page_section',
));

/*--------------------------------------------------------------
# Activate Tags Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'      =>  'toggle',
    'settings'  =>  'envy-blog_404_error_page_tags_activate',
    'label'     =>  esc_html__( 'Tag', 'envy-blog' ),
    'section'   =>  'envy-blog_404_error_page_section',
));

/*--------------------------------------------------------------
# Activate Categories Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'      =>  'toggle',
    'settings'  =>  'envy-blog_404_error_page_categories_activate',
    'label'     =>  esc_html__( 'Categories', 'envy-blog' ),
    'section'   =>  'envy-blog_404_error_page_section',
));

/*--------------------------------------------------------------
# Activate Archives Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'      =>  'toggle',
    'settings'  =>  'envy-blog_404_error_page_archives_activate',
    'label'     =>  esc_html__( 'Archives', 'envy-blog' ),
    'section'   =>  'envy-blog_404_error_page_section',
));
