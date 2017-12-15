<?php
/**
 * Envy Blog Customizer WooCommerce Panel
 *
 * @package Envy Blog
 */

if( !class_exists( 'WooCommerce' ) )
    return;

/*--------------------------------------------------------------
# WooCommerce Panel
--------------------------------------------------------------*/
Kirki::add_panel( 'envy-blog_wc_panel', array(
    'priority'      => 121,
    'title'         => esc_html__( 'WooCommerce', 'envy-blog' ),
));

/*--------------------------------------------------------------
# WooCommerce Sidebar Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_wc_product_page_sidebar_section', array(
    'priority'      => 4,
    'title'         => esc_html__( 'Product Sidebar', 'envy-blog' ),
    'panel'         => 'envy-blog_wc_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# WooCommerce Product Page Sidebar Layout
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'radio-image',
    'settings'    => 'envy-blog_wc_product_page_global_sidebar',
    'label'       => esc_html__( 'Sidebar Layout', 'envy-blog' ),
    'description' => esc_html__( 'Select default sidebar layout. This layout will be reflected on product page of WooCommerce.', 'envy-blog' ),
    'section'     => 'envy-blog_wc_product_page_sidebar_section',
    'default'     => 'full-width',
    'choices'     => array(
        'left-sidebar'      => THEME_URI . '/inc/assets/images/sidebar/left-sidebar.svg',
        'full-width'        => THEME_URI . '/inc/assets/images/sidebar/no-sidebar.svg',
        'right-sidebar'     => THEME_URI . '/inc/assets/images/sidebar/right-sidebar.svg',

    ),
) );
