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
 
	wp.customize( 'primary_color',         function( value ) {value.bind( function( to ) {$( '.Primary-color'         ).css( 'color', to )     ;	$( '.Primary-color *'         ).css( 'color', to )     ;	var body = $( "body" );	$( "body" ).css("--primary", to);} );} );
	//wp.customize( 'primary_color',         function( value ) {value.bind( function( to ) {$( '.Primary-color'         ).css( 'color', to )     ;	$( '.Primary-color *'         ).css( 'color', to )     ;	var body = $( "body" );	$( "body" ).css("--primary", to);} );} );
	wp.customize( 'dark-primary-color',    function( value ) {value.bind( function( to ) {$( '.dark-primary-color'    ).css( 'background', to );	$( '.dark-primary-color    *' ).css( 'background', to );	var body = $( "body" );	$( "body" ).css("--dark-primary-color", to);} );} );
	wp.customize( 'default-primary-color', function( value ) {value.bind( function( to ) {$( '.default-primary-color' ).css( 'background', to );	$( '.default-primary-color *' ).css( 'background', to );	var body = $( "body" );	$( "body" ).css("--default-primary-color", to);} );} );
	wp.customize( 'light-primary-color',   function( value ) {value.bind( function( to ) {$( '.light-primary-color'   ).css( 'background', to );	$( '.light-primary-color   *' ).css( 'background', to );	var body = $( "body" );	$( "body" ).css("--light-primary-color", to);} );} );
	wp.customize( 'text-primary-color',    function( value ) {value.bind( function( to ) {$( '.text-primary-color'    ).css( 'color', to )     ;	$( '.text-primary-color    *' ).css( 'color', to )     ;	var body = $( "body" );	$( "body" ).css("--text-primary-color", to);} );} );
	wp.customize( 'accent-color',          function( value ) {value.bind( function( to ) {$( '.accent-color'          ).css( 'background', to );	$( '.accent-color          *' ).css( 'background', to );	var body = $( "body" );	$( "body" ).css("--accent-color", to);} );} );
	wp.customize( 'primary-text-color',    function( value ) {value.bind( function( to ) {$( '.primary-text-color'    ).css( 'color', to )     ;	$( '.primary-text-color    *' ).css( 'color', to )     ;	var body = $( "body" );	$( "body" ).css("--primary-text-color", to);} );} );
	wp.customize( 'secondary-text-color',  function( value ) {value.bind( function( to ) {$( '.secondary-text-color'  ).css( 'color', to )     ;	$( '.secondary-text-color  *' ).css( 'color', to )     ;	var body = $( "body" );	$( "body" ).css("--secondary-text-color", to);} );} );
	wp.customize( 'divider-color',         function( value ) {value.bind( function( to ) {$( '.divider-color'         ).css( 'background', to );	$( '.divider-color         *' ).css( 'background', to );	var body = $( "body" );	$( "body" ).css("--divider-color", to);} );} );
	
 
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
 