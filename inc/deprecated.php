<?php
/**
 * Rest in peace
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'understrap_adjust_body_class' ) ) {
	/**
	 * Setup body classes.
	 *
	 * @param array $classes CSS classes.
	 *
	 * @deprecated 0.9.4 Styling of tag has been removed in Bootstrap v4 Alpha 6.
	 * @link https://github.com/twbs/bootstrap/issues/20939
	 */
	function understrap_adjust_body_class( $classes ) {

		foreach ( $classes as $key => $value ) {
			if ( 'tag' == $value ) {
				unset( $classes[ $key ] );
			}
		}

		return $classes;

	}
}
 
