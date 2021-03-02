<?php
/**
 * UnderStrap functions and definitions
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = get_template_directory() . '/inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once $understrap_inc_dir . $file;
}



if ( ! function_exists( 'quilo_get_customizer_css' ) ) {
 
	function quilo_get_customizer_css() {

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
	 
		ob_start();
		  $idimgLeft = get_theme_mod( 'leftSide_Setting'  );
		  $idimgRight = get_theme_mod( 'rightSide_Setting'  );
		  $idimgHeader = get_theme_mod( 'Header_Setting'  );
		  
		 
		?> 
		body.custom-background { <?php echo trim( $style ); ?> } 
		<?php
		if( $idimgHeader ){
		?>
		#main-nav {
			background: url(<?php echo trim(wp_get_attachment_url( $idimgHeader ) ); ?>); 
		}	
		<?php
		}
		?>
				<?php
		if( $idimgRight ){
		?>
		#right-sidebar{
			background: url(<?php echo trim(wp_get_attachment_url( $idimgRight ) ); ?>); 
		}	
		<?php
		}
		?>
		<?php
		if( $idimgLeft ){
		?>
		#left-sidebar{
			background: url(<?php echo trim(wp_get_attachment_url( $idimgLeft ) ); ?>); 
		}	
		<?php
		}
		?>
		
		:root {
			--primary: <?php echo trim( get_theme_mod( 'primary_color', '#4e5367' )); ?>;
			--secondary: <?php echo trim( get_theme_mod( 'secondary_color', '#000000' )); ?>;			
			--logo_text: <?php echo trim( get_theme_mod( 'logo_text_color', '#FFE380' )); ?>;
			--background: #<?php echo trim( get_theme_mod( $color, 'e3edf2' )); ?>;

			--light: #f8f9fa;
			--dark: #343a40;
		}
		<?php
		$css = ob_get_clean();
		return $css;
	}
}

