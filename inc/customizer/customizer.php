<?php
/**
 * Envy Blog Theme Customizer.
 *
 * @package Envy Blog
 */

/*--------------------------------------------------------------
# Configuration for Kirki Toolkit
--------------------------------------------------------------*/
function envy_blog_kirki_configuration() {
    return array( 'url_path'     => THEME_URI . '/inc/compatibility/kirki/' );
}
add_filter( 'kirki/config', 'envy_blog_kirki_configuration' );

/*--------------------------------------------------------------
# Envy Blog Kirki Config
--------------------------------------------------------------*/
Kirki::add_config( 'envy-blog_config', array(
    'capability'    => 'edit_theme_options',
    'option_type'   => 'theme_mod',
) );

/*--------------------------------------------------------------
# Widget Panel Position
--------------------------------------------------------------*/
Kirki::add_panel( 'widgets', array(
    'title'			=> esc_html__( 'Widgets', 'envy-blog' ),
    'priority'		=> 125
) );

// panel
get_template_part( 'inc/customizer/panel/header', get_post_format() );
get_template_part( 'inc/customizer/panel/general', get_post_format() );
get_template_part( 'inc/customizer/panel/social', get_post_format() );
get_template_part( 'inc/customizer/panel/hero', get_post_format() );
get_template_part( 'inc/customizer/panel/page', get_post_format() );
get_template_part( 'inc/customizer/panel/woocommerce', get_post_format() );
get_template_part( 'inc/customizer/panel/404-error', get_post_format() );
get_template_part( 'inc/customizer/panel/post', get_post_format() );
get_template_part( 'inc/customizer/panel/blog', get_post_format() );
get_template_part( 'inc/customizer/panel/footer', get_post_format() );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function envy_blog_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

    // Remove
    $wp_customize->remove_control( 'display_header_text' );
    $wp_customize->remove_control( 'header_textcolor' );
    $wp_customize->remove_section( 'background_image' );

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'envy_blog_customizer_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'envy_blog_customizer_partial_blogdescription',
        ) );
    }

}
add_action( 'customize_register', 'envy_blog_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function envy_blog_customizer_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function envy_blog_customizer_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function envy_blog_customize_preview_js() {
    wp_enqueue_script( 'envy_blog_customizer', THEME_URI . '/inc/assets/js/customizer-preview.js', array( 'customize-preview' ), THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'envy_blog_customize_preview_js' );
