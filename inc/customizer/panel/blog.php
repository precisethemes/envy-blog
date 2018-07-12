<?php
/**
 * Envy Blog Customizer Archive/Blog Panel
 *
 * @package Envy Blog
 */

/*--------------------------------------------------------------
# Blog Panel
--------------------------------------------------------------*/
Kirki::add_panel( 'envy-blog_archive_page_panel', array(
    'priority'      => 124,
    'title'         => esc_html__( 'Archive/Blog', 'envy-blog' ),
));

/*--------------------------------------------------------------
# Sidebar Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_archive_page_layout_section', array(
    'priority'      => 1,
    'title'         => esc_html__( 'Layout', 'envy-blog' ),
    'panel'         => 'envy-blog_archive_page_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Layout Section
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'radio-image',
    'settings'    => 'envy-blog_archive_page_layout',
    'label'       => esc_html__( 'Layout', 'envy-blog' ),
    'description' => esc_html__( 'Select the layout for the blog.', 'envy-blog' ),
    'section'     => 'envy-blog_archive_page_layout_section',
    'default'     => 'blog-layout-1',
    'choices'     => array(
        'blog-layout-1'         => ENVY_BLOG_THEME_URI . '/inc/assets/images/blog/blog-layout-1.svg',
        'blog-layout-6'         => ENVY_BLOG_THEME_URI . '/inc/assets/images/blog/blog-layout-6.svg',
    ),
) );

/*--------------------------------------------------------------
# Settings Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_archive_page_settings_section', array(
    'priority'      => 2,
    'title'         => esc_html__( 'Settings', 'envy-blog' ),
    'panel'         => 'envy-blog_archive_page_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Layout 1 columns Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'select',
    'settings'    => 'envy-blog_archive_page_layout1_display_columns',
    'label'       => esc_html__( 'Columns Per Row', 'envy-blog' ),
    'section'     => 'envy-blog_archive_page_settings_section',
    'default'     => 'col-3',
    'choices'     => array(
        'col-2'     => '2',
        'col-3'     => '3',
        'col-4'     => '4',
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'envy-blog_archive_page_layout',
            'operator' => '==',
            'value'    => 'blog-layout-1',
        ),
    ),
) );

/*--------------------------------------------------------------
# Layout 6 Content Ordering Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'sortable',
    'settings'    => 'envy-blog_archive_page_layout6_content_order_list',
    'label'       => esc_html__( 'Content Order', 'envy-blog' ),
    'description' => esc_html__( 'Drag & Drop items to re-arrange order of appearance.', 'envy-blog' ),
    'section'     => 'envy-blog_archive_page_settings_section',
    'default'     => array(
        'blog-meta',
        'blog-title',
    ),
    'choices'     => array(
        'blog-meta'      => esc_attr__( 'Meta', 'envy-blog' ),
        'blog-title'    => esc_attr__( 'Title', 'envy-blog' ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'envy-blog_archive_page_layout',
            'operator' => '==',
            'value'    => 'blog-layout-6',
        ),
    ),
) );

/*--------------------------------------------------------------
# Sidebar Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_archive_page_sidebar_section', array(
    'priority'      => 3,
    'title'         => esc_html__( 'Sidebar', 'envy-blog' ),
    'panel'         => 'envy-blog_archive_page_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Global Blog Sidebar Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'radio-image',
    'settings'    => 'envy-blog_archive_page_global_sidebar',
    'label'       => esc_html__( 'Archive/Blog Sidebar', 'envy-blog' ),
    'description' => esc_html__( 'Select default sidebar. This sidebar will be reflected in whole site archives, categories, search page etc. Info:- there is no any sidebar layout for the blog layout 1 and 2.', 'envy-blog' ),
    'section'     => 'envy-blog_archive_page_sidebar_section',
    'default'     => 'right-sidebar',
    'choices'     => array(
        'left-sidebar'      => ENVY_BLOG_THEME_URI . '/inc/assets/images/sidebar/left-sidebar.svg',
        'full-width'        => ENVY_BLOG_THEME_URI . '/inc/assets/images/sidebar/no-sidebar.svg',
        'right-sidebar'     => ENVY_BLOG_THEME_URI . '/inc/assets/images/sidebar/right-sidebar.svg',

    ),
) );


