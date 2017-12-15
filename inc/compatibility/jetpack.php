<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package Envy Blog
 */

/*----------------------------------------------------------------------
    # Jetpack Setup Function
-------------------------------------------------------------------------*/
if( !function_exists( 'envy_blog_jetpack_setup' ) ) {
	function envy_blog_jetpack_setup() {

		// Add theme support for Infinite Scroll.
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'render'    => 'envy_blog_inifite_scroll_render',
			'footer'    => 'page',
		) );

		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );
	}
	add_action( 'after_setup_theme', 'envy_blog_jetpack_setup' );
}

/*----------------------------------------------------------------------
    # Jetpack Infinite Scroll.
-------------------------------------------------------------------------*/
if( !function_exists( 'envy_blog_inifite_scroll_render' ) ) {
	function envy_blog_inifite_scroll_render() {
		/* Start the Loop */
		while( have_posts() ) {
			the_post();
			if( is_search() ) :
				get_template_part( 'template-parts/content', 'search' );
			else :
				get_template_part( 'template-parts/content', get_post_format() );
			endif;
		}
	}
}
