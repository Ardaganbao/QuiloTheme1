/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
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
	wp.customize( 'logo_text_color', function( value ) {
		value.bind( function( to ) {
			// Add background color to header and footer wrappers.
			$( '.logo_text-color' ).css( 'color', to );			
			$( '.logo_text-color *' ).css( 'color', to );
		 
		} );
	} ); 
	wp.customize( 'primary_color', function( value ) {
		value.bind( function( to ) {
			// Add background color to header and footer wrappers.
			$( '.Primary-color' ).css( 'color', to );			
			$( '.Primary-color *' ).css( 'color', to );
			 
			var body = $( "body" );
			$( "body" ).css("--primary", to);
		} );
	} );
 
	wp.customize( 'secondary_color', function( value ) {
		value.bind( function( to ) {
			// Add background color to header and footer wrappers.
			$( '.secondary-color' ).css( 'color', to );			
			$( '.secondary-color *' ).css( 'color', to );
			 
			var body = $( "body" );
			$( "body" ).css("--secondary", to);
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );
