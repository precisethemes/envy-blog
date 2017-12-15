<?php
/**
 * Envy Blog functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Envy Blog
 */

/**
 * Define constants
 */
$theme_options  = wp_get_theme();
$theme_name     = $theme_options->get( 'Name' );
$theme_author   = $theme_options->get( 'Author' );
$theme_desc     = $theme_options->get( 'Description' );
$theme_version  = $theme_options->get( 'Version' );

define( 'THEME_NAME', $theme_name );
define( 'THEME_AUTHOR', $theme_author );
define( 'THEME_DESCRIPTION', $theme_desc );
define( 'THEME_VERSION', $theme_version );
define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_DIR', get_template_directory() );

if ( ! function_exists( 'envy_blog_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function envy_blog_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on envy-blog, use a find and replace
	 * to change 'envy-blog' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'envy-blog', THEME_DIR . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Indicate widget sidebars can use selective refresh in the Customizer.
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
    add_theme_support( 'post-thumbnails' );

    /* Image Ratio - Wider */
    add_image_size( 'envy-blog-1200-16x4', 1360, 320, true );

	/* Image Ratio - 16:9 */
    add_image_size( 'envy-blog-1200-16x9', 1200, 675, true );
    add_image_size( 'envy-blog-960-16x9', 960, 540, true );
    add_image_size( 'envy-blog-600-16x9', 600, 337, true );

    /* Image Ratio - 4:3 */
    add_image_size( 'envy-blog-1200-4x3', 1200, 900, true );
    add_image_size( 'envy-blog-960-4x3', 960, 720, true );
    add_image_size( 'envy-blog-600-4x3', 600, 450, true );

    /* Image Ratio - 3:4 */
    add_image_size( 'envy-blog-600-3x4', 600, 800, true );

    /* Image Ratio - full width:height auto */
    add_image_size( 'envy-blog-600-auto', 600, 9999, false );

    /**
	 * Increase image quality compression
	 */
	add_filter( 'jpeg_quality', function() {
		return 100;
	} );

    /*
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'flex-height' => true,
		'flex-width' => true,
	) );

	/*
	 * This theme uses wp_nav_menu() in one location.
	 *
	 */
	register_nav_menus( array(
		'primary' 	=> esc_html__( 'Primary', 'envy-blog' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

    /*
	 * Set up the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'envy_blog_custom_background_args', array(
		'default-color' => '#f1f1f1',
	) ) );

	/*
	 * Add Excerpt for the Pages.
	 */
	add_post_type_support( 'page', 'excerpt' );
}
endif;
add_action( 'after_setup_theme', 'envy_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function envy_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'envy_blog_content_width', 960 );
}
add_action( 'after_setup_theme', 'envy_blog_content_width', 0 );

/**
 * Custom template tags for this theme.
 */
require THEME_DIR . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require THEME_DIR . '/inc/extras.php';

/**
 * Kirki Toolkit.
 */
require THEME_DIR . '/inc/compatibility/kirki/kirki.php';

/**
 * Customizer additions.
 */
require THEME_DIR . '/inc/customizer/customizer.php';

/**
 * Meta-Box Custom function
 */
require THEME_DIR . '/inc/meta-boxes/class-meta-box.php';

/**
 * Load theme custom widgets and register custom widget sidebar.
 */
require THEME_DIR . '/inc/widgets/widgets.php';

/**
 * Load JetPack compatibility file.
 */
require THEME_DIR . '/inc/compatibility/jetpack.php';

/**
 * Load envy-blog extra/custom functions file
 */
require THEME_DIR . '/inc/functions.php';

/**
 * Load WooCommerce functions file
 */
require THEME_DIR . '/inc/compatibility/woocommerce/woocommerce.php';

/**
 * Demo Importer
 */
require THEME_DIR . '/inc/demo-importer/demo-importer.php';

/**
 * Admin notice
 */
require THEME_DIR . '/inc/notices/persist-admin-notices-dismissal.php';

/**
 * Welcome Screen.
 */
require THEME_DIR . '/inc/welcome-screen/class-welcome-screen.php';

/**
 * Load TGM Activation file.
 */
require THEME_DIR . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'envy_blog_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function envy_blog_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // Contact Form 7
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
        // One Click Demo Import
        array(
            'name'      => 'One Click Demo Import',
            'slug'      => 'one-click-demo-import',
            'required'  => false,
        ),
    );
    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'envy-blog' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'envy-blog' ),
            /* translators: %s: plugin name. */
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'envy-blog' ),
            /* translators: %s: plugin name. */
            'updating'                        => esc_html__( 'Updating Plugin: %s', 'envy-blog' ),
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'envy-blog' ),
            'notice_can_install_required'     => _n_noop(
            /* translators: 1: plugin name(s). */
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'envy-blog'
            ),
            'notice_can_install_recommended'  => _n_noop(
            /* translators: 1: plugin name(s). */
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'envy-blog'
            ),
            'notice_ask_to_update'            => _n_noop(
            /* translators: 1: plugin name(s). */
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'envy-blog'
            ),
            'notice_ask_to_update_maybe'      => _n_noop(
            /* translators: 1: plugin name(s). */
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'envy-blog'
            ),
            'notice_can_activate_required'    => _n_noop(
            /* translators: 1: plugin name(s). */
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'envy-blog'
            ),
            'notice_can_activate_recommended' => _n_noop(
            /* translators: 1: plugin name(s). */
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'envy-blog'
            ),
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'envy-blog'
            ),
            'update_link' 					  => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'envy-blog'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'envy-blog'
            ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'envy-blog' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'envy-blog' ),
            'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'envy-blog' ),
            /* translators: 1: plugin name. */
            'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'envy-blog' ),
            /* translators: 1: plugin name. */
            'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'envy-blog' ),
            /* translators: 1: dashboard link. */
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'envy-blog' ),
            'dismiss'                         => esc_html__( 'Dismiss this notice', 'envy-blog' ),
            'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'envy-blog' ),
            'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'envy-blog' ),
            'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
        ),
    );
    tgmpa( $plugins, $config );
}


