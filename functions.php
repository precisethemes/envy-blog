<?php
/**
 * Envy Blog functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Envy Blog
 */

/**
 * Envy Blog only works on PHP v5.4.0 or later.
 */
if ( version_compare( PHP_VERSION, '5.4.0', '<' ) ) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}

/**
 * Define constants
 */
$envy_blog_theme_options  = wp_get_theme();
$envy_blog_theme_name     = $envy_blog_theme_options->get( 'Name' );
$envy_blog_theme_author   = $envy_blog_theme_options->get( 'Author' );
$envy_blog_theme_desc     = $envy_blog_theme_options->get( 'Description' );
$envy_blog_theme_version  = $envy_blog_theme_options->get( 'Version' );

define( 'ENVY_BLOG_THEME_NAME', $envy_blog_theme_name );
define( 'ENVY_BLOG_THEME_AUTHOR', $envy_blog_theme_author );
define( 'ENVY_BLOG_THEME_DESC', $envy_blog_theme_desc );
define( 'ENVY_BLOG_THEME_VERSION', $envy_blog_theme_version );
define( 'ENVY_BLOG_THEME_URI', get_template_directory_uri() );
define( 'ENVY_BLOG_THEME_DIR', get_template_directory() );

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
	load_theme_textdomain( 'envy-blog', ENVY_BLOG_THEME_DIR . '/languages' );

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
require ENVY_BLOG_THEME_DIR . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require ENVY_BLOG_THEME_DIR . '/inc/extras.php';

/**
 * Kirki Toolkit.
 */
require ENVY_BLOG_THEME_DIR . '/inc/compatibility/kirki/kirki.php';

/**
 * Customizer additions.
 */
require ENVY_BLOG_THEME_DIR . '/inc/customizer/customizer.php';

/**
 * Meta-Box Custom function
 */
require ENVY_BLOG_THEME_DIR . '/inc/meta-boxes/class-meta-box.php';

/**
 * Load theme custom widgets and register custom widget sidebar.
 */
require ENVY_BLOG_THEME_DIR . '/inc/widgets/widgets.php';

/**
 * Load JetPack compatibility file.
 */
require ENVY_BLOG_THEME_DIR . '/inc/compatibility/jetpack.php';

/**
 * Load envy-blog extra/custom functions file
 */
require ENVY_BLOG_THEME_DIR . '/inc/functions.php';

/**
 * Load WooCommerce functions file
 */
require ENVY_BLOG_THEME_DIR . '/inc/compatibility/woocommerce/woocommerce.php';

/**
 * Demo Importer
 */
require ENVY_BLOG_THEME_DIR . '/inc/demo-importer/demo-importer.php';

/**
 * Admin notice
 */
require ENVY_BLOG_THEME_DIR . '/inc/notices/persist-admin-notices-dismissal.php';

/**
 * Welcome Screen.
 */
require ENVY_BLOG_THEME_DIR . '/inc/welcome-screen/class-welcome-screen.php';

/**
 * Polylang Compatible For Customizer Settings.
 */

require ENVY_BLOG_THEME_DIR . '/inc/compatibility/polylang/customizer-polylang.php';


/**
 * Load TGM Activation file.
 */
require ENVY_BLOG_THEME_DIR . '/inc/class-tgm-plugin-activation.php';

if ( ! function_exists( 'envy_blog_register_recommended_plugins' ) ) :

    /**
     * Register recommended plugins.
     *
     * @since 1.0.0
     */
    function envy_blog_register_recommended_plugins() {
        $plugins = array(
            array(
                'name'     => esc_html__( 'Contact Form 7', 'envy-blog' ),
                'slug'     => 'contact-form-7',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'One Click Demo Import', 'envy-blog' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),
        );

        $config = array();

        tgmpa( $plugins, $config );
    }

endif;

add_action( 'tgmpa_register', 'envy_blog_register_recommended_plugins' );