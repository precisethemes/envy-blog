<?php
/**
 * Envy Blog Customizer Post Panel
 *
 * @package Envy Blog
 */

/*--------------------------------------------------------------
# Post Panel
--------------------------------------------------------------*/
Kirki::add_panel( 'envy-blog_post_panel', array(
    'priority'      => 123,
    'title'         => esc_html__( 'Post Settings', 'envy-blog' ),
));

/*--------------------------------------------------------------
# Layout Settings Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_post_layout_section', array(
    'priority'      => 1,
    'title'         => esc_html__( 'Layout', 'envy-blog' ),
    'panel'         => 'envy-blog_post_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Single Post Layout Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'radio-image',
    'settings'    => 'envy-blog_post_layout',
    'label'       => esc_html__( 'Layout', 'envy-blog' ),
    'section'     => 'envy-blog_post_layout_section',
    'default'     => 'post-layout-1',
    'choices'     => array(
        'post-layout-1'         => ENVY_BLOG_THEME_URI . '/inc/assets/images/post/post-layout-1.svg',
    ),
) );

/*--------------------------------------------------------------
# Settings Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_post_settings_section', array(
    'priority'      => 2,
    'title'         => esc_html__( 'Settings', 'envy-blog' ),
    'panel'         => 'envy-blog_post_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Content Ordering layout 1 Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'sortable',
    'settings'    => 'envy-blog_post_layout1_content_order_list',
    'label'       => esc_html__( 'Content Order', 'envy-blog' ),
    'description' => esc_html__( 'Drag & Drop items to re-arrange order of appearance.', 'envy-blog' ),
    'section'     => 'envy-blog_post_settings_section',
    'default'     => array(
        'post-featured-image',
        'post-title',
        'post-meta',
        'post-content',
    ),
    'choices'     => array(
        'post-featured-image'   => esc_attr__( 'Featured Image', 'envy-blog' ),
        'post-title'            => esc_attr__( 'Title', 'envy-blog' ),
        'post-meta'             => esc_attr__( 'Meta', 'envy-blog' ),
        'post-content'          => esc_attr__( 'Content', 'envy-blog' ),
    ),
) );

/*--------------------------------------------------------------
# Sidebar Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_post_sidebar_section', array(
    'priority'      => 3,
    'title'         => esc_html__( 'Sidebar', 'envy-blog' ),
    'panel'         => 'envy-blog_post_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Global Post Sidebar Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'radio-image',
    'settings'    => 'envy-blog_post_global_sidebar',
    'label'       => esc_html__( 'Post Sidebar', 'envy-blog' ),
    'description' => esc_html__( 'Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post.', 'envy-blog' ),
    'section'     => 'envy-blog_post_sidebar_section',
    'default'     => 'right-sidebar',
    'choices'     => array(
        'left-sidebar'      => ENVY_BLOG_THEME_URI . '/inc/assets/images/sidebar/left-sidebar.svg',
        'full-width'        => ENVY_BLOG_THEME_URI . '/inc/assets/images/sidebar/no-sidebar.svg',
        'right-sidebar'     => ENVY_BLOG_THEME_URI . '/inc/assets/images/sidebar/right-sidebar.svg',
    ),
) );

/*--------------------------------------------------------------
# Navigation Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_post_navigation_section', array(
    'priority'      => 5,
    'title'         => esc_html__( 'Navigation', 'envy-blog' ),
    'panel'         => 'envy-blog_post_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Activate Next/Prev Navigation Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'          =>  'toggle',
    'settings'      =>  'envy-blog_post_navigation_activate',
    'label'         =>  esc_html__( 'Activate', 'envy-blog' ),
    'description'   =>  esc_html__( 'Enable it to display post navigation in the post page.', 'envy-blog' ),
    'section'       =>  'envy-blog_post_navigation_section',
    'default'       =>  '1',
));

/*--------------------------------------------------------------
# Single Post Navigation Layout Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'radio-image',
    'settings'    => 'envy-blog_post_navigation_layout',
    'label'       => esc_html__( 'Navigation Layout', 'envy-blog' ),
    'section'     => 'envy-blog_post_navigation_section',
    'default'     => 'navigation-layout-2',
    'choices'     => array(
        'navigation-layout-2'   => ENVY_BLOG_THEME_URI . '/inc/assets/images/post/post-navigation/post-navigation-layout-2.svg',
    ),
) );

/*--------------------------------------------------------------
# Author Bio Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_post_author_section', array(
    'priority'      => 6,
    'title'         => esc_html__( 'Author Info Box', 'envy-blog' ),
    'panel'         => 'envy-blog_post_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Activate Author Bio Section Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'          =>  'toggle',
    'settings'      =>  'envy-blog_post_author_activate',
    'label'         =>  esc_html__( 'Activate', 'envy-blog' ),
    'description'   =>  esc_html__( 'Enable it to display Author Bio Section after post content.', 'envy-blog' ),
    'section'       =>  'envy-blog_post_author_section',
));

