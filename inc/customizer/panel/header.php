<?php
/**
 * Envy Blog Customizer Header Panel
 *
 * @package Envy Blog
 */

/*--------------------------------------------------------------
# Panel Header
--------------------------------------------------------------*/
Kirki::add_panel( 'envy-blog_header_panel', array(
    'priority'  =>  2,
    'title'     =>  esc_html__( 'Header', 'envy-blog' ),
));

/*--------------------------------------------------------------
# Header Layouts
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_header_layout_section', array(
    'priority'      =>  1,
    'title'         => esc_html__( 'Layout', 'envy-blog' ),
    'panel'         => 'envy-blog_header_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Header Layout Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'radio-image',
    'settings'    => 'envy-blog_header_layout',
    'label'       => esc_html__( 'Layout', 'envy-blog' ),
    'section'     => 'envy-blog_header_layout_section',
    'default'     => 'header-layout-1',
    'choices'     => array(
        'header-layout-1'         => ENVY_BLOG_THEME_URI . '/inc/assets/images/header/layout-1.svg',
        'header-layout-6'         => ENVY_BLOG_THEME_URI . '/inc/assets/images/header/layout-6.svg',
    ),
) );

/*--------------------------------------------------------------
# Header Settings
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_sticky_header_section', array(
    'priority'      =>  2,
    'title'         => esc_html__( 'Sticky Header', 'envy-blog' ),
    'panel'         => 'envy-blog_header_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Activate Sticky Header Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'      =>  'toggle',
    'settings'  =>  'envy-blog_sticky_header_activate',
    'section'   =>  'envy-blog_sticky_header_section',
    'label'     =>  esc_html__( 'Activate', 'envy-blog' ),
    'description' =>  esc_html__( 'Enable it to set Header Sticky', 'envy-blog' ),
));

/*--------------------------------------------------------------
# Site Title & Tag-Line Section
--------------------------------------------------------------*/
Kirki::add_section( 'title_tagline', array(
    'priority'      =>  3,
    'title'         => esc_html__( 'Site Title & Tagline', 'envy-blog' ),
    'panel'         => 'envy-blog_header_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Site Title Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'      =>  'toggle',
    'settings'  =>  'envy-blog_header_site_title_activate',
    'section'   =>  'title_tagline',
    'label'     =>  esc_html__( 'Display Site Title', 'envy-blog' ),
    'default'   =>  '1',
));
/*--------------------------------------------------------------
# Site Title color Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'      =>  'color',
    'settings'  =>  'envy-blog_header_site_title_color',
    'section'   =>  'title_tagline',
    'label'     =>  esc_html__( 'Logo Color', 'envy-blog' ),
    'default'   =>  '#1e1f1f',
    'choices'   => array(
        'alpha' => false,
    ),
    'transport'     =>  'postMessage',
    'js_vars'       =>  array(
        array(
            'element'   =>  array( '.site-branding h1 a' ),
            'function'  =>  'css',
            'property'  =>  'color'
        )
    ),
    'output'        =>  array(
        array(
            'element'   =>  array( '.site-branding h1 a' ),
            'function'  =>  'css',
            'property'  =>  'color'
        )
    )
));

/*--------------------------------------------------------------
# Site Title Hover color Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'      =>  'color',
    'settings'  =>  'envy-blog_header_site_title_hover_color',
    'section'   =>  'title_tagline',
    'label'     =>  esc_html__( 'Logo Hover Color', 'envy-blog' ),
    'default'   =>  '#42414e',
    'choices'   => array(
        'alpha' => false,
    ),
    'transport'     =>  'postMessage',
    'js_vars'       =>  array(
        array(
            'element'   =>  array( '.site-branding h1 a:hover' ),
            'function'  =>  'css',
            'property'  =>  'color'
        )
    ),
    'output'        =>  array(
        array(
            'element'   =>  array( '.site-branding h1 a:hover' ),
            'function'  =>  'css',
            'property'  =>  'color'
        )
    )
));

/*--------------------------------------------------------------
# Tag Line Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'      =>  'toggle',
    'settings'  =>  'envy-blog_header_site_tagline_activate',
    'section'   =>  'title_tagline',
    'label'     =>  esc_html__( 'Display Tagline', 'envy-blog' ),
    'default'   =>  '1',
));

/*--------------------------------------------------------------
# Tag Line Color Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'      =>  'color',
    'settings'  =>  'envy-blog_header_site_tagline_color',
    'section'   =>  'title_tagline',
    'label'     =>  esc_html__( 'Tagline Color', 'envy-blog' ),
    'default'   =>  '#828089',
    'choices'   => array(
        'alpha' => false,
    ),
    'transport'     =>  'postMessage',
    'js_vars'       =>  array(
        array(
            'element'   =>  array( '.site-branding p' ),
            'function'  =>  'css',
            'property'  =>  'color'
        )
    ),
    'output'        =>  array(
        array(
            'element'   =>  array( '.site-branding p' ),
            'function'  =>  'css',
            'property'  =>  'color'
        )
    )
));

/*--------------------------------------------------------------
# Header Search Icon Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_header_search_icon_section', array(
    'priority'      =>  4,
    'title'         => esc_html__( 'Search Icon', 'envy-blog' ),
    'panel'         => 'envy-blog_header_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Activate Search Icon Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'          =>  'toggle',
    'settings'      =>  'envy-blog_header_search_icon_activate',
    'section'       =>  'envy-blog_header_search_icon_section',
    'label'         =>  esc_html__( 'Activate', 'envy-blog' ),
    'description'   => esc_html__( 'Enable it to display search icon in header section.', 'envy-blog' ),
    'default'       =>  '1',
));

if( class_exists( 'WooCommerce' ) ) {
    /*--------------------------------------------------------------
    # Header Search Icon Section
    --------------------------------------------------------------*/
    Kirki::add_section( 'envy-blog_header_wc_cart_icon_section', array(
        'priority'      =>  5,
        'title'         => esc_html__( 'Shopping Cart Icon', 'envy-blog' ),
        'panel'         => 'envy-blog_header_panel',
        'capability'    => 'edit_theme_options',
    ));

    /*--------------------------------------------------------------
    # Header WooCommerce Cart Icon Control
    --------------------------------------------------------------*/
    Kirki::add_field( 'envy-blog_config', array(
        'type'          =>  'toggle',
        'settings'      =>  'envy-blog_header_wc_cart_icon_activate',
        'section'       =>  'envy-blog_header_wc_cart_icon_section',
        'label'         =>  esc_html__( 'Activate', 'envy-blog' ),
        'description'   => esc_html__( 'Enable it to display WooCommerce shopping cart icon in header section.', 'envy-blog' ),
        'default'       =>  '1',
    ));
}
