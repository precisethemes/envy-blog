<?php
/**
 * envy-blog Customizer Hero Image Panel
 *
 * @package Envy Blog
 */

/*--------------------------------------------------------------
# Panel Hero Section
--------------------------------------------------------------*/
Kirki::add_panel( 'envy-blog_hero_panel', array(
    'priority'  =>  103,
    'title'     =>  esc_html__( 'Hero Section', 'envy-blog' ),
));

/*--------------------------------------------------------------
# Hero Settings Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_hero_section', array(
    'priority'      => 1,
    'title'         => esc_html__( 'Activate', 'envy-blog' ),
    'panel'         => 'envy-blog_hero_panel',
    'capability'    => 'edit_theme_options',
));

/*------------------------------------------------------
# Activate Hero Section Control
-------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'toggle',
    'settings'    => 'envy-blog_hero_section_activate',
    'label'       => esc_html__( 'Homepage', 'envy-blog' ),
    'description' =>  esc_html__( 'Enable it to display hero section on Homepage of the site.', 'envy-blog' ),
    'section'     => 'envy-blog_hero_section',
) );

/*------------------------------------------------------
# Activate Static Front Control
-------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'toggle',
    'settings'    => 'envy-blog_hero_section_on_static_page_activate',
    'label'       => esc_html__( 'Static Homepage', 'envy-blog' ),
    'description' =>  esc_html__( 'Enable it to display hero section on static Homepage of the site.', 'envy-blog' ),
    'section'     => 'envy-blog_hero_section',
) );

/*------------------------------------------------------
# Layout Section
-------------------------------------------------------*/
Kirki::add_section( 'envy-blog_hero_layout_section', array(
    'priority'       => 2,
    'title'          => esc_html__( 'Layout', 'envy-blog' ),
    'panel'          => 'envy-blog_hero_panel',
    'capability'     => 'edit_theme_options',
) );

/*------------------------------------------------------
# Hero Header Layout Control
-------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'radio-image',
    'settings'    => 'envy-blog_hero_layout',
    'label'       => esc_html__( 'Layout', 'envy-blog' ),
    'section'     => 'envy-blog_hero_layout_section',
    'default'     => 'hero-layout-1',
    'choices'     => array(
        'hero-layout-1'  => ENVY_BLOG_THEME_URI . '/inc/assets/images/hero/hero-layout-1.svg',
        'hero-layout-2'  => ENVY_BLOG_THEME_URI . '/inc/assets/images/hero/hero-layout-2.svg',
    ),
) );

/*------------------------------------------------------
# Hero Header Custom Control
-------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'custom',
    'settings'    => 'envy-blog_hero_layout_2_custom_message',
    'section'     => 'envy-blog_hero_layout_section',
    'default'     => '<div class="customize-control-description customize-description description">' . esc_html__( 'To see the effect, upload background image through Customize -> Hero section -> Content', 'envy-blog' ) . '</div>',
    'active_callback'  => array(
        array(
            'setting'  => 'envy-blog_hero_layout',
            'operator' => '==',
            'value'    => 'hero-layout-2',
        ),
    ),
) );

/*------------------------------------------------------
# Content Section
-------------------------------------------------------*/
Kirki::add_section( 'envy-blog_hero_content_section', array(
    'priority'       => 3,
    'title'          => esc_html__( 'Content', 'envy-blog' ),
    'panel'          => 'envy-blog_hero_panel',
    'capability'     => 'edit_theme_options',
) );

/*------------------------------------------------------
# Hero Title Control
-------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'text',
    'settings'    => 'envy-blog_hero_title_text',
    'label'       => esc_html__( 'Title', 'envy-blog' ),
    'section'     => 'envy-blog_hero_content_section',
    'default'     => '',
    'transport'     => 'postMessage',
    'js_vars'       => array(
        array(
            'element'  => '.hero-section .hero-content .entry-title h2',
            'function' => 'html',
        ),
    ),
) );

/*------------------------------------------------------
# Hero SubTitle Control
-------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'text',
    'settings'    => 'envy-blog_hero_subtitle_text',
    'label'       => esc_html__( 'Subtitle', 'envy-blog' ),
    'section'     => 'envy-blog_hero_content_section',
    'default'     => '',
    'transport'     => 'postMessage',
    'js_vars'       => array(
        array(
            'element'  => '.hero-section .hero-content .entry-title h3',
            'function' => 'html',
        ),
    ),
) );

/*------------------------------------------------------
# Hero Description Control
-------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'textarea',
    'settings'    => 'envy-blog_hero_description_text',
    'label'       => esc_html__( 'Description', 'envy-blog' ),
    'section'     => 'envy-blog_hero_content_section',
    'default'     => '',
    'transport'     => 'postMessage',
    'js_vars'       => array(
        array(
            'element'  => '.hero-section .hero-content .entry-content p',
            'function' => 'html',
        ),
    ),
) );

/*------------------------------------------------------
# Hero Image Control
-------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'image',
    'settings'    => 'envy-blog_hero_background_image',
    'label'       => esc_html__( 'Background Image', 'envy-blog' ),
    'description' => esc_html__( 'The recommended size for the hero content image is 1200x675 pixels.', 'envy-blog' ),
    'section'     => 'envy-blog_hero_content_section',
    'choices'     => array(
        'save_as' => 'id',
    ),
) );

/*--------------------------------------------------------------
# Hero Content Text Alignment Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'select',
    'settings'    => 'envy-blog_hero_text_alignment',
    'label'       => esc_html__( 'Text Alignment', 'envy-blog' ),
    'section'     => 'envy-blog_hero_content_section',
    'default'     => 'center',
    'choices'     => array(
        'left'          => esc_attr__( 'Left', 'envy-blog' ),
        'center'        => esc_attr__( 'Center', 'envy-blog' ),
        'right'         => esc_attr__( 'Right', 'envy-blog' ),
    ),
) );

/*--------------------------------------------------------------
# Hero Settings Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_hero_settings_section', array(
    'priority'      => 4,
    'title'         => esc_html__( 'Button', 'envy-blog' ),
    'panel'         => 'envy-blog_hero_panel',
    'capability'    => 'edit_theme_options',
));

/*------------------------------------------------------
# Activate Hero Section Control
-------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'toggle',
    'settings'    => 'envy-blog_hero_settings_button_activate',
    'label'       => esc_html__( 'Activate', 'envy-blog' ),
    'description' =>  esc_html__( 'Enable it to display button in hero slide.', 'envy-blog' ),
    'section'     => 'envy-blog_hero_settings_section',
    'default'     => '1',
) );

/*------------------------------------------------------
# Hero Button Text Control
-------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'text',
    'settings'    => 'envy-blog_hero_settings_button_text',
    'label'       => esc_html__( 'Text', 'envy-blog' ),
    'section'     => 'envy-blog_hero_settings_section',
    'default'     => esc_html__( 'Discover', 'envy-blog' ),
    'transport'     => 'postMessage',
    'js_vars'       => array(
        array(
            'element'  => '.hero-content .entry-footer a',
            'function' => 'html',
        ),
    ),
) );


/*------------------------------------------------------
# Hero Button URL Control
-------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'text',
    'settings'    => 'envy-blog_hero_settings_button_url',
    'label'       => esc_html__( 'URL', 'envy-blog' ),
    'section'     => 'envy-blog_hero_settings_section',
    'default'     => '#',
) );

/*------------------------------------------------------
# Hero Button Target Control
-------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'select',
    'settings'    => 'envy-blog_hero_settings_button_link_target',
    'label'       => esc_html__( 'Link Open', 'envy-blog' ),
    'section'     => 'envy-blog_hero_settings_section',
    'default'     => '_self',
    'choices'     => array(
        '_self'          => esc_attr__( 'Same Tab', 'envy-blog' ),
        '_blank'        => esc_attr__( 'New Tab', 'envy-blog' ),
    ),
) );


/*--------------------------------------------------------------
# Button Type Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'select',
    'settings'    => 'envy-blog_hero_settings_button_type',
    'label'       => esc_html__( 'Type', 'envy-blog' ),
    'section'     => 'envy-blog_hero_settings_section',
    'default'     => 'arrow',
    'choices'     => array(
        'rounded'       => esc_attr__( 'Rounded', 'envy-blog' ),
        'arrow'         => esc_attr__( 'Arrow', 'envy-blog' ),
        'underline'     => esc_attr__( 'Underline', 'envy-blog' ),
    ),
) );

/*--------------------------------------------------------------
# Button Radius Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'slider',
    'settings'    => 'envy-blog_hero_settings_button_radius',
    'label'       => esc_attr__( 'Border Radius', 'envy-blog' ),
    'section'     => 'envy-blog_hero_settings_section',
    'default'     => 3,
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '1',
    ),
    'transport'        =>  'postMessage',
    'active_callback'  => array(
        array(
            'setting'  => 'envy-blog_hero_settings_button_type',
            'operator' => '==',
            'value'    => 'rounded',
        ),
    ),
    'js_vars' => array(
        array(
            'element'  => '.hero-content a.btn.rounded',
            'property' => 'border-radius',
            'units'    => 'px',
        ),
    ),
    'output' => array(
        array(
            'element'  => '.hero-content a.btn.rounded',
            'property' => 'border-radius',
            'units'    => 'px',
        ),
    ),
) );

/*--------------------------------------------------------------
# Button Transparency Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'        => 'toggle',
    'settings'    => 'envy-blog_hero_settings_button_transparency',
    'label'       => esc_html__( 'Background Transparent', 'envy-blog' ),
    'section'     => 'envy-blog_hero_settings_section',
    'default'     => '1',
    'active_callback'  => array(
        array(
            'setting'  => 'envy-blog_hero_settings_button_type',
            'operator' => 'in',
            'value'    => array( 'rounded' ),
        ),
    ),
) );

