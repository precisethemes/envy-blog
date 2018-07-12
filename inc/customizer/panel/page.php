<?php
/**
 * Envy Blog Customizer Page Panel
 *
 * @package Envy Blog
 */

/*--------------------------------------------------------------
# Page Panel
--------------------------------------------------------------*/
Kirki::add_panel( 'envy-blog_page_panel', array(
    'priority'      => 119,
    'title'         => esc_html__( 'Page Settings', 'envy-blog' ),
));

/*--------------------------------------------------------------
# Layout Settings Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_page_layout_section', array(
    'priority'      => 1,
    'title'         => esc_html__( 'Layout', 'envy-blog' ),
    'panel'         => 'envy-blog_page_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Single Page Layout Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'radio-image',
    'settings'    => 'envy-blog_page_layout',
    'label'       => esc_html__( 'Layout', 'envy-blog' ),
    'description' => esc_html__( 'Choose your single page layout.', 'envy-blog' ),
    'section'     => 'envy-blog_page_layout_section',
    'default'     => 'page-layout-1',
    'choices'     => array(
        'page-layout-1'         => ENVY_BLOG_THEME_URI . '/inc/assets/images/page/page-layout-1.svg',
    ),
) );

/*--------------------------------------------------------------
# Settings Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_page_settings_section', array(
    'priority'      => 2,
    'title'         => esc_html__( 'Settings', 'envy-blog' ),
    'panel'         => 'envy-blog_page_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Content Ordering Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'sortable',
    'settings'    => 'envy-blog_page_setting_content_order_list',
    'label'       => esc_html__( 'Content Order', 'envy-blog' ),
    'description' => esc_html__( 'Drag & Drop items to re-arrange order of appearance.', 'envy-blog' ),
    'section'     => 'envy-blog_page_settings_section',
    'default'     => array(
        'page-featured-image',
        'page-title',
        'page-content',
    ),
    'choices'     => array(
        'page-featured-image'   => esc_attr__( 'Featured Image', 'envy-blog' ),
        'page-title'            => esc_attr__( 'Title', 'envy-blog' ),
        'page-content'          => esc_attr__( 'Content', 'envy-blog' ),
    ),
) );

/*--------------------------------------------------------------
# Sidebar Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_page_sidebar_section', array(
    'priority'      => 2,
    'title'         => esc_html__( 'Sidebar', 'envy-blog' ),
    'panel'         => 'envy-blog_page_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Global Page Sidebar Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'radio-image',
    'settings'    => 'envy-blog_page_global_sidebar',
    'label'       => esc_html__( 'Page Sidebar', 'envy-blog' ),
    'description' => esc_html__( 'Select default layout for single page. This layout will be reflected in all single page unless unique layout is set for specific page.', 'envy-blog' ),
    'section'     => 'envy-blog_page_sidebar_section',
    'default'     => 'right-sidebar',
    'choices'     => array(
        'left-sidebar'      => ENVY_BLOG_THEME_URI . '/inc/assets/images/sidebar/left-sidebar.svg',
        'full-width'        => ENVY_BLOG_THEME_URI . '/inc/assets/images/sidebar/no-sidebar.svg',
        'right-sidebar'     => ENVY_BLOG_THEME_URI . '/inc/assets/images/sidebar/right-sidebar.svg',

    ),
) );
