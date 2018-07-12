<?php
/**
 *  Define custom or extra function which needed for Envy Blog
 *
 * @package Envy Blog
 */

/*----------------------------------------------------------------------
# Exit if accessed directly
-------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*----------------------------------------------------------------------
# Enqueue Front-End Scripts and Styles
-------------------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_scripts' ) ) {
    function envy_blog_scripts() {

        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

        // Default Theme Font - Roboto
        wp_enqueue_style( 'Roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900', false );

        // Load Font Awesome File
        wp_enqueue_style( 'font-awesome', ENVY_BLOG_THEME_URI .'/assets/css/font-awesome.min.css', false, '4.7.0', 'all' );

        wp_enqueue_style( 'envy-blog-style', get_stylesheet_uri() );

        // Enqueue Masonry
        $blog_layout = get_theme_mod( 'envy-blog_archive_page_layout', 'blog-layout-1' );
        if ( $blog_layout == 'blog-layout-1' ) {
            wp_enqueue_script( 'masonry' );
        }

        // Custom JS
        wp_enqueue_script( 'envy-blog-custom', ENVY_BLOG_THEME_URI . '/assets/js/theme-custom'.$suffix.'.js', array( 'jquery' ), ENVY_BLOG_THEME_VERSION, true );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'envy_blog_scripts' );

/*----------------------------------------------------------------------
# Register Back-End Scripts and Styles
-------------------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_admin_scripts' ) ) {
    function envy_blog_admin_scripts() {

        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

        // Get Current Screen Name
        $current_screen = get_current_screen();

        if ( $current_screen->id == "customize" || $current_screen->id == "widgets" ) {
            // Run some code, only on the customizer and widgets page
            wp_enqueue_style( 'envy-blog-customizer-style', ENVY_BLOG_THEME_URI .'/inc/assets/css/customizer-style'.$suffix.'.css', false, ENVY_BLOG_THEME_VERSION, 'all' );
        }
        else {
            // Run some code, only on the post and page
            wp_enqueue_style( 'envy-blog-backend-style', ENVY_BLOG_THEME_URI .'/inc/assets/css/backend-style'.$suffix.'.css', false, ENVY_BLOG_THEME_VERSION, 'all' );

            wp_enqueue_script( 'envy-blog-backend-script', ENVY_BLOG_THEME_URI . '/inc/assets/js/backend-script'.$suffix.'.js', array('jquery'),ENVY_BLOG_THEME_VERSION, true );
        }

    }
}
add_action( 'admin_enqueue_scripts', 'envy_blog_admin_scripts' );

/*--------------------------------------------------------------
# Footer Credits
--------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_footer_credits' ) ) {
    function envy_blog_footer_credits() {

        printf( __( 'Copyright &copy; %1$s %3$s. %2$s.', 'envy-blog' ), date('Y'), esc_html__('All rights reserved','envy-blog'), '<a href="'.esc_url( home_url( '/' ) ) .'">' . esc_html( get_bloginfo( 'name', 'display' ) ) . '</a>' );
        echo '<span class="sep"> | </span>';
        printf( __( 'Designed by %2$s', 'envy-blog' ), '', '<a href="'.esc_url( __('http://precisethemes.com/','envy-blog' ) ) .'" rel="designer" target="_blank">Precise Themes</a>' );

    }
}
add_action( 'envy_blog_footer', 'envy_blog_footer_credits', 10 );

/*----------------------------------------------------------------------
# Blog Read More Button
-------------------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_blog_read_more_button ' ) ) {
    function envy_blog_blog_read_more_button() {
        $blog_class         = array();

        $blog_read_more_text                    = esc_html__( 'Discover', 'envy-blog' );
        $blog_read_more_button_type             = 'arrow';
        $blog_read_more_button_scheme           = 'light';
        $blog_read_more_button_transparency     = 'transparent';

        if ( is_single() ) {
            $blog_read_more_text                    = esc_html__( 'Discover', 'envy-blog' );
            $blog_read_more_button_type             = 'arrow';
            $blog_read_more_button_scheme           = 'light';
        }

        // Arrow
        if ( $blog_read_more_button_type == 'arrow' ) :
            $blog_class[] = $blog_read_more_button_type; ?>
            <a class="btn <?php echo esc_attr( implode( ' ', $blog_class ) ); ?>" href="<?php the_permalink(); ?>"><?php echo esc_html( $blog_read_more_text ); ?></a>
        <?php
        // Rounded
        elseif ( $blog_read_more_button_type == 'rounded' ) :
            $blog_class[] = $blog_read_more_button_type;
            $blog_class[] = $blog_read_more_button_scheme;
            $blog_class[] = $blog_read_more_button_transparency; ?>
            <a class="btn <?php echo esc_attr( implode( ' ', $blog_class ) ); ?>" href="<?php the_permalink(); ?>"><?php echo esc_html( $blog_read_more_text ); ?></a>
        <?php
        // Underlined
        elseif ( $blog_read_more_button_type == 'underline' ) :
            $blog_class[] = $blog_read_more_button_type; ?>
            <a class="btn <?php echo esc_attr( implode( ' ', $blog_class ) ); ?>" href="<?php the_permalink(); ?>"><?php echo esc_html( $blog_read_more_text ); ?></a>
        <?php
        endif;
    }
}

/*----------------------------------------------------------------------
# Select and show sidebar based on post meta and customizer default settings
-------------------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_layout_class' ) ) {
    function envy_blog_layout_class() {
        global $post;

        // Get Layout Customizer
        $layout = get_theme_mod('envy-blog_archive_page_global_sidebar', 'right-sidebar');
        // Get Layout meta
        $layout_meta = get_post_meta($post->ID, 'specific_page_layout', true);

        // Home page if Posts page is assigned
        if (is_home() && !(is_front_page())) {
            $queried_id = get_option('page_for_posts');
            $layout_meta = get_post_meta($queried_id, 'specific_page_layout', true);

            if ($layout_meta != 'default-sidebar' && $layout_meta != '') {
                $layout = get_post_meta($queried_id, 'specific_page_layout', true);
            }
        } elseif (is_page()) {
            $layout = get_theme_mod('envy-blog_page_global_sidebar', 'right-sidebar');
            if ($layout_meta != 'default-sidebar' && $layout_meta != '') {
                $layout = get_post_meta($post->ID, 'specific_page_layout', true);
            }
        } elseif (is_single()) {
            $layout = get_theme_mod('envy-blog_post_global_sidebar', 'right-sidebar');
            if ( class_exists( 'WooCommerce' ) ){
                $layout = get_theme_mod( 'envy-blog_wc_product_page_global_sidebar', 'full-width' );
            }
            if ($layout_meta != 'default-sidebar' && $layout_meta != '') {
                $layout = get_post_meta($post->ID, 'specific_page_layout', true);
            }
        }
        return esc_html($layout);
    }
}

/*----------------------------------------------------------------------
# Dynamic Classes for Post, Page, Archive, Search etc.
-------------------------------------------------------------------------*/
if ( !function_exists( 'envy_blog_post_classes' ) ) {
    function envy_blog_post_classes( $classes ) {
        $classes[] = 'content-wrap';
        return $classes;
    }
}
add_filter( 'post_class', 'envy_blog_post_classes' );

/*--------------------------------------------------------------
# Return attachment id from Image URL. attachment
--------------------------------------------------------------*/
if ( ! function_exists( 'envy_blog_get_attachment_id_from_url' ) ) {
    function envy_blog_get_attachment_id_from_url( $url ) {
        $attachment_id = 0;
        $dir = wp_upload_dir();
        if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
            $file = basename( $url );
            $query_args = array(
                'post_type'   => 'attachment',
                'post_status' => 'inherit',
                'fields'      => 'ids',
                'meta_query'  => array(
                    array(
                        'value'   => $file,
                        'compare' => 'LIKE',
                        'key'     => '_wp_attachment_metadata',
                    ),
                )
            );
            $query = new WP_Query( $query_args );
            if ( $query->have_posts() ) {
                foreach ( $query->posts as $post_id ) {
                    $meta = wp_get_attachment_metadata( $post_id );
                    $original_file       = basename( $meta['file'] );
                    $cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
                    if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
                        $attachment_id = $post_id;
                        break;
                    }
                }
            }
        }
        return $attachment_id;
    }
}

/* ---------------------------------------------
# Return All Available Categories
---------------------------------------------*/
if( ! function_exists( 'envy_blog_categories_lists' ) ) {
    function envy_blog_categories_lists( $categories_lists = array() ) {
        $categories = get_categories( array(
            'orderby' => 'id',
            'order'   => 'ASC'
        ) );
        foreach( $categories as $category ) {
            $categories_lists[$category->slug] = $category->name;
        }
        return $categories_lists;
    }
}
