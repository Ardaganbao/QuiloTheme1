<?php
/**
 * UnderStrap Theme Customizer
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'understrap_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function understrap_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'understrap_customize_register' );

if ( ! function_exists( 'understrap_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function understrap_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'understrap_theme_layout_options',
			array(
				'title'       => __( 'Theme Layout Settings', 'understrap' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'understrap' ),
				'priority'    => apply_filters( 'understrap_theme_layout_options_priority', 160 ),
			)
		);

		 
		function understrap_custom_background_cb() {
			$background = get_background_image();
			$color = get_background_color();
			if ( ! $background && ! $color )
				return;
		 
			$style = $color ? "background-color: #$color;" : '';
		 
			if ( $background ) {
				$image = " background-image: url('$background');";
		 
				$repeat = get_theme_mod( 'background_repeat', 'repeat' );
				if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
					$repeat = 'repeat';
				$repeat = " background-repeat: $repeat;";
		 
				$position = get_theme_mod( 'background_position_x', 'left' );
				if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
					$position = 'left';
				$position = " background-position: top $position;";
		 
				$attachment = get_theme_mod( 'background_attachment', 'scroll' );
				if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
					$attachment = 'scroll';
				$attachment = " background-attachment: $attachment;";
		 
				$style .= $image . $repeat . $position . $attachment;
			}
		?>
		<style type="text/css"  id="custom-background-css"> 
		body.custom-background { <?php echo trim( $style ); ?> } 

		//body .logo_header .logo_text a,.Primary-color {   color: <?php echo trim( get_theme_mod( 'logo_text_color', '#FFE380' )); ?> !important ;}
		:root {
			--primary: <?php echo trim( get_theme_mod( 'primary_color', '#4e5367' )); ?>;
			--secondary: <?php echo trim( get_theme_mod( 'secondary_color', '#FFE380' )); ?>;			
			--logo_text: <?php echo trim( get_theme_mod( 'logo_text_color', '#FFE380' )); ?>;
			--background: #<?php echo trim( get_theme_mod( $color, 'e3edf2' )); ?>;

			--light: #f8f9fa;
			--dark: #343a40;
		}
		</style>
		<?php
		}


		/**
		 * Select sanitization function
		 *
		 * @param string               $input   Slug to sanitize.
		 * @param WP_Customize_Setting $setting Setting instance.
		 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
		 */
		function understrap_theme_slug_sanitize_select( $input, $setting ) {

			// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
			$input = sanitize_key( $input );

			// Get the list of possible select options.
			$choices = $setting->manager->get_control( $setting->id )->choices;

			// If the input is a valid key, return it; otherwise, return the default.
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

		}

		$wp_customize->add_setting(
			'understrap_container_type',
			array(
				'default'           => 'container',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_container_type',
				array(
					'label'       => __( 'Container Width', 'understrap' ),
					'description' => __( 'Choose between Bootstrap\'s container and container-fluid', 'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'understrap_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'understrap' ),
						'container-fluid' => __( 'Full width container', 'understrap' ),
					),
					'priority'    => apply_filters( 'understrap_container_type_priority', 10 ),
				)
			)
		);

		$wp_customize->add_setting(
			'understrap_sidebar_position',
			array(
				'default'           => 'right',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_setting(
			'logo_text_color',
			array(
				'default'           => '#FFE380',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'logo_text_color',
				array(
					'label'   => __( 'Logo Color', 'Quilo' ),
					'section' => 'colors',
				)
			)
		);


		$wp_customize->add_setting(
			'primary_color',
			array(
				'default'           => '#4e5367',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);

		
	 
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'primary_color',
				array(
					'label'   => __( 'Primary color', 'Quilo' ),
					'section' => 'colors',
				)
			)
		);

		$wp_customize->add_setting(
			'secondary_color',
			array(
				'default'           => '#000000',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);

 
	 
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'secondary_color',
				array(
					'label'   => __( 'secondary color', 'Quilo' ),
					'section' => 'colors',
				)
			)
		);		
 
		$wp_customize->add_section(
			'cover_template_options',
			array(
				'title'       => __( 'Session Background Image', 'Quilo' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Settings to setup all background image', 'twentytwenty' ),
			)
		);
		$wp_customize->add_setting(
			'leftSide_Setting',
			array(
				'default-image' => '' ,
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'leftSide_Setting', array(
			'label' => __('left Side Image', 'Quilo'),
			'section' => 'cover_template_options', 
			'width'       => 400,
			'height'      => 1600, 
			'flex_width ' => true,
			'flex_height ' => true, 
			'button_labels' => array( // Optional.
				'select' => __( 'Select Image' ),
				'change' => __( 'Change Image' ),
				'remove' => __( 'Remove' ),
				'default' => __( 'Default' ),
				'placeholder' => __( 'No image selected' ),
				'frame_title' => __( 'Select Image' ),
				'frame_button' => __( 'Choose Image' ),
			 )
			)));
		 
			$wp_customize->add_setting(
				'rightSide_Setting',
				array(
					'default-image' =>  '',
					'transport' => 'refresh',
					'sanitize_callback' => 'absint'
				)
			);
			$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'rightSide_Setting', array(
				'label' => __('right Side Image', 'Quilo'),
				'section' => 'cover_template_options', 
				'width'       => 600,
				'height'      => 1600, 
				'flex_width ' => true,
				'flex_height ' => true, 
				'button_labels' => array( // Optional.
					'select' => __( 'Select Image' ),
					'change' => __( 'Change Image' ),
					'remove' => __( 'Remove' ),
					'default' => __( 'Default' ),
					'placeholder' => __( 'No image selected' ),
					'frame_title' => __( 'Select Image' ),
					'frame_button' => __( 'Choose Image' ),
				 )
				)));	 
				
			$wp_customize->add_setting(
				'Header_Setting',
				array(
					'default-image' =>  '',
					'transport' => 'refresh',
					'sanitize_callback' => 'absint'
				)
			);
			$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'Header_Setting', array(
				'label' => __('Header Image', 'Quilo'),
				'section' => 'cover_template_options', 
				'width'       => 3198,
				'height'      => 382, 
				'flex_width ' => true,
				'flex_height ' => true, 
				'button_labels' => array( // Optional.
					'select' => __( 'Select Image' ),
					'change' => __( 'Change Image' ),
					'remove' => __( 'Remove' ),
					'default' => __( 'Default' ),
					'placeholder' => __( 'No image selected' ),
					'frame_title' => __( 'Select Image' ),
					'frame_button' => __( 'Choose Image' ),
				 )
				)));	 
		/*$wp_customize->selective_refresh->add_partial(
			'leftSide-Setting',
			array(
				'selector' => '.cover-header',
				'type'     => 'cover_fixed',
			)
		);*/

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_sidebar_position',
				array(
					'label'             => __( 'Sidebar Positioning', 'understrap' ),
					'description'       => __(
						'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
						'understrap'
					),
					'section'           => 'understrap_theme_layout_options',
					'settings'          => 'understrap_sidebar_position',
					'type'              => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'           => array(
						'right' => __( 'Right sidebar', 'understrap' ),
						'left'  => __( 'Left sidebar', 'understrap' ),
						'both'  => __( 'Left & Right sidebars', 'understrap' ),
						'none'  => __( 'No sidebar', 'understrap' ),
					),
					'priority'          => apply_filters( 'understrap_sidebar_position_priority', 20 ),
				)
			)
		);
	}
} // End of if function_exists( 'understrap_theme_customize_register' ).
add_action( 'customize_register', 'understrap_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'understrap_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function understrap_customize_preview_js() {
		$theme_version = wp_get_theme()->get( 'Version' );
		wp_enqueue_script(
			'understrap_customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview', 'customize-selective-refresh', 'jquery'  ),
			$theme_version,
			true
		);
	}
}
add_action( 'customize_preview_init', 'understrap_customize_preview_js' ); 

function echo_leftSide_Setting() {
    $id = get_theme_mod('leftSide_Setting');
	if ($id != 0) {
        $url = wp_get_attachment_url($id);
		echo '<div style="margin-bottom: 30px;">';
        echo '<img src="' . $url . '" alt="" />';
        echo '</div>';
      
    }
  
}
