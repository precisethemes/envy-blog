<?php
/**
 * Envy Blog Customizer Social Panel
 *
 * @package Envy Blog
 */
/*--------------------------------------------------------------
# Social Panel
--------------------------------------------------------------*/
Kirki::add_panel( 'envy-blog_social_panel', array(
    'priority'      => 102,
    'title'         => esc_html__( 'Social', 'envy-blog' ),
));

/*--------------------------------------------------------------
# Social Profile Section
--------------------------------------------------------------*/
Kirki::add_section( 'envy-blog_social_profile_section', array(
    'priority'      => 1,
    'title'         => esc_html__( 'Social Profiles', 'envy-blog' ),
    'panel'         => 'envy-blog_social_panel',
    'capability'    => 'edit_theme_options',
));

/*--------------------------------------------------------------
# Repeatable Social Profile Setting & Control
--------------------------------------------------------------*/
Kirki::add_field( 'envy-blog_config', array(
    'type'                  => 'repeater',
    'label'                 => esc_html__( 'Add Social Profile', 'envy-blog' ),
    'description'           => esc_html__( 'Drag & Drop items to re-arrange order of appearance.', 'envy-blog' ),
    'section'               => 'envy-blog_social_profile_section',
    'choices'               => array(
        'limit'             => '5'
    ),
    'row_label'             => array(
        'type'              => 'field',
        'value'             => esc_html__('Social', 'envy-blog' ),
        'field'             => 'social_name',
    ),
    'settings'              => 'envy-blog_social_repeatable_social_profiles',
    'default'               => array(
        array(
            'social_name'   => esc_html__( 'Facebook', 'envy-blog' ),
            'social_url'    => 'https://facebook.com/',
            'social_icon'   => 'fa-facebook',
            'social_image'  => '',

        ),
    ),
    'fields'                => array(
        'social_name'       => array(
            'type'          => 'text',
            'label'         => esc_html__( 'Profile Name', 'envy-blog' ),
            'default'       => '',
        ),
        'social_url'        => array(
            'type'          => 'text',
            'label'         => esc_html__( 'URL', 'envy-blog' ),
            'default'       => '',
        ),
        'social_icon'       => array(
            'label'         => esc_html__( 'Icon', 'envy-blog' ),
            'type'          => 'select',
            'default'       => 'fa-facebook',
            'choices'       => array(
                'fa-behance'        => esc_html__( 'Behance', 'envy-blog' ),
                'fa-delicious'      => esc_html__( 'Delicious', 'envy-blog' ),
                'fa-digg'           => esc_html__( 'Digg', 'envy-blog' ),
                'fa-dribbble'       => esc_html__( 'Dribbble', 'envy-blog' ),
                'fa-facebook'       => esc_html__( 'Facebook', 'envy-blog' ),
                'fa-flickr'         => esc_html__( 'Flickr', 'envy-blog' ),
                'fa-foursquare'     => esc_html__( 'Foursquare', 'envy-blog' ),
                'fa-github'         => esc_html__( 'Github', 'envy-blog' ),
                'fa-google-plus'     => esc_html__( 'Google Plus', 'envy-blog' ),
                'fa-instagram'      => esc_html__( 'Instagram', 'envy-blog' ),
                'fa-linkedin'       => esc_html__( 'LinkedIn', 'envy-blog' ),
                'fa-envelope'           => esc_html__( 'Mail', 'envy-blog' ),
                'fa-medium'         => esc_html__( 'Medium', 'envy-blog' ),
                'fa-pinterest'      => esc_html__( 'Pinterest', 'envy-blog' ),
                'fa-reddit'         => esc_html__( 'Reddit', 'envy-blog' ),
                'fa-skype'          => esc_html__( 'Skype', 'envy-blog' ),
                'fa-slack'          => esc_html__( 'Slack', 'envy-blog' ),
                'fa-stackoverflow'  => esc_html__( 'Stackoverflow', 'envy-blog' ),
                'fa-twitter'        => esc_html__( 'Twitter', 'envy-blog' ),
                'fa-tumblr'         => esc_html__( 'Tumblr', 'envy-blog' ),
                'fa-vimeo'          => esc_html__( 'Vimeo', 'envy-blog' ),
                'fa-youtube'        => esc_html__( 'Youtube', 'envy-blog' ),
            )
        ),
        'social_image'      => array(
            'type'          => 'image',
            'label'         => esc_html__( 'Custom Icon', 'envy-blog' ),
            'default'       => '',
        ),
    ),
) );
