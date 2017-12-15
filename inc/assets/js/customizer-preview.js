/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

    /* Shows a live preview of changing the breadcrumbs delimeter. */
	wp.customize( 'envy_blog_general_breadcrumbs_seperator', function( value ) {
		value.bind( function( to ) {
			$( '.breadcrumbs .breadcrumbs-items .breadcrumbs-delimiter' ).text( to ) ;
		});
	});

	/* Shows a live preview of changing the readmore text. */
	wp.customize( 'envy_blog_blog_read_more_text', function( value ) {
		value.bind( function( to ) {
			$( '.content-wrap .read-more' ).text( to ) ;
		});
	});

} )( jQuery );
