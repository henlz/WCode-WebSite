/**
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
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			function hex2rgb(hex) {
				return ['0x' + hex[1] + hex[2] | 0, '0x' + hex[3] + hex[4] | 0, '0x' + hex[5] + hex[6] | 0];
			}
			
			var rgb = hex2rgb(to);
			
			if ( 'blank' === to ) {
				$( 'h1.h1header, #drawer .header b, #drawer .header .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( 'h1.h1header, #drawer .header b' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );

				$( 'h1.h1header span, #drawer .header .site-description' ).css( {
					'clip': 'auto',
					'color': 'rgba(' + rgb[0] + ', ' + rgb[1] + ', ' + rgb[2] + ', 0.68)',
					'position': 'relative'
				} );
			}
		} );
	} );
} )( jQuery );
