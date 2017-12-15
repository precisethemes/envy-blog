<?php
/**
 * Envy Blog Customizer General Panel
 *
 * @package Envy Blog
 */

/*--------------------------------------------------------------
# Panel General
--------------------------------------------------------------*/
Kirki::add_panel( 'envy-blog_general_panel', array(
    'priority'  =>  100,
    'title'     =>  esc_html__( 'General', 'envy-blog' ),
));

/*--------------------------------------------------------------
# Background Color Section
--------------------------------------------------------------*/
Kirki::add_section( 'colors', array(
    'priority'      => 1,
    'title'         => esc_html__( 'Background Color', 'envy-blog' ),
    'panel'         => 'envy-blog_general_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Breadcrumbs Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_general_breadcrumbs_section', array(
    'priority'      =>  2,
    'title'         => esc_html__( 'Breadcrumbs', 'envy-blog' ),
    'panel'         => 'envy-blog_general_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Activate Breadcrumbs Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'      =>  'toggle',
    'settings'  =>  'envy-blog_general_breadcrumbs_activate',
    'section'   =>  'envy-blog_general_breadcrumbs_section',
    'label'     =>  esc_html__( 'Activate', 'envy-blog' ),
    'description' =>  esc_html__( 'Enable it to display breadcrumbs in site.', 'envy-blog' ),
    'default'   =>  '1',
));

