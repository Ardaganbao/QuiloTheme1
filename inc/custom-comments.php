<?php
/**
 * Comment layout
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Add  classes to comment form fields.
add_filter( 'comment_form_default_fields', 'understrap_comment_form_fields' );

if ( ! function_exists( 'understrap_comment_form_fields' ) ) {
	/**
	 * Add  classes to WP's comment form default fields.
	 *
	 * @param array $fields {
	 *     Default comment fields.
	 *
	 *     @type string $author  Comment author field HTML.
	 *     @type string $email   Comment author email field HTML.
	 *     @type string $url     Comment author URL field HTML.
	 *     @type string $cookies Comment cookie opt-in field HTML.
	 * }
	 *
	 * @return array
	 */
	function understrap_comment_form_fields( $fields ) {

		/*$replace = array(
			'<p class="' => '<div class="Quilo-form-group ',
			'<input'     => '<input class="Quilo-form-control" ',
			'</p>'       => '</div>',
		);

		if ( isset( $fields['author'] ) ) {
			$fields['author'] = strtr( $fields['author'], $replace );
		}
		if ( isset( $fields['email'] ) ) {
			$fields['email'] = strtr( $fields['email'], $replace );
		}
		if ( isset( $fields['url'] ) ) {
			$fields['url'] = strtr( $fields['url'], $replace );
		}

		$replace = array(
			'<p class="' => '<div class="Quilo-form-group Quilo-form-check ',
			'<input'     => '<input class="form-check-input" ',
			'<label'     => '<label class="form-check-label" ',
			'</p>'       => '</div>',
		);
		if ( isset( $fields['cookies'] ) ) {
			$fields['cookies'] = strtr( $fields['cookies'], $replace );
		}*/

		return $fields;
	}
} // End of if function_exists( 'understrap_comment_form_fields' )

// Add  classes to comment form submit button and comment field.
add_filter( 'comment_form_defaults', 'understrap_comment_form' );

if ( ! function_exists( 'understrap_comment_form' ) ) {
	/**
	 * Adds  classes to comment form submit button and comment field.
	 *
	 * @param string[] $args Comment form arguments and fields.
	 *
	 * @return string[]
	 */
	function understrap_comment_form( $args ) {
		/*$replace = array(
			'<p class="' => '<div class="form-group ',
			'<textarea'  => '<textarea class="form-control" ',
			'</p>'       => '</div>',
		);

		if ( isset( $args['comment_field'] ) ) {
			$args['comment_field'] = strtr( $args['comment_field'], $replace );
		}

		if ( isset( $args['class_submit'] ) ) {
			$args['class_submit'] = 'btn btn-secondary';
		}
*/
		return $args;
	}
} // End of if function_exists( 'understrap_comment_form' ).


// Add note if comments are closed.
add_action( 'comment_form_comments_closed', 'understrap_comment_form_comments_closed' );

if ( ! function_exists( 'understrap_comment_form_comments_closed' ) ) {
	/**
	 * Displays a note that comments are closed if comments are closed and there are comments.
	 */
	function understrap_comment_form_comments_closed() {
		if ( get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'understrap' ); ?></p>
			<?php
		}
	}
} // End of if function_exists( 'understrap_comment_form_comments_closed' ).
