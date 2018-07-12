<?php
/**
 * Functions to provide support for the One Click Demo Import plugin (wordpress.org/plugins/one-click-demo-import)
 *
 * @package Envy Blog
 */

/*Import content data*/
if ( ! function_exists( 'envy_blog_import_files' ) ) :
    function envy_blog_import_files() {
        return array(

            array(
                'import_file_name'             => 'Envy Blog',
                'local_import_file'            => ENVY_BLOG_THEME_DIR . '/inc/demo-importer/demos/default/dummy-data/dummy-data.xml',
                'local_import_widget_file'     => ENVY_BLOG_THEME_DIR . '/inc/demo-importer/demos/default/dummy-data/dummy-widgets.wie',
                'local_import_customizer_file' => ENVY_BLOG_THEME_DIR . '/inc/demo-importer/demos/default/dummy-data/dummy-customizer.dat',
                'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'envy-blog' ),
                'preview_url'                  => 'https://precisethemes.com/demo/envy-blog/',
            ),

        );
    }
    add_filter( 'pt-ocdi/import_files', 'envy_blog_import_files' );
endif;

/**
 * Define actions that happen after import
 */

if ( ! function_exists( 'envy_blog_set_after_import_mods' ) ) :
    function envy_blog_set_after_import_mods( $selected_import ) {

        if ( 'Envy Blog' === $selected_import['import_file_name'] ) {

            //Assign the menu
            $primary_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
            set_theme_mod( 'nav_menu_locations' , array(
                    'primary' => $primary_menu->term_id,
                )
            );
        }
    }
    add_action( 'pt-ocdi/after_import', 'envy_blog_set_after_import_mods' );
endif;
