<?php

/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('understrap_container_type');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>

	<?php do_action('wp_body_open'); ?>
	<div class="site-container" id="main-canvas">
		<div class="site site-pusher" id="page">

			<!-- ******************* The Navbar Area ******************* -->
			<div id="header">





				<!-- Your site title as branding in the menu -->
				<div class="logo-branding">
					<?php $tagline = get_bloginfo('description'); ?>
					<?php if (!has_custom_logo()) { ?>
						<h1 class="logo_text logo_text-only logo_text-color"><a rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a></h1>
						<?php if ($tagline != '') { ?> <p class="logo_tagline logo_tagline-only logo_text-color"><?php bloginfo('description'); ?></p><?php } ?>
					<?php
					} else {
						$custom_logo_id = get_theme_mod('custom_logo');
						$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
						echo '<div class="custom-logo-link"><a rel="home" href="' . esc_url(home_url('/')) . '"><img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '"></a></div>';
					?>
						<h1 class="logo_text logo_text-color"><a rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a></h1>
						<?php if ($tagline != '') {  ?> <p class="logo_tagline logo_text-color"><?php bloginfo('description'); ?></p><?php } ?>
					<?php
					}
					?>


				</div>
				<!-- end custom logo -->
				<nav id="main-nav" class="navbar">
					<?php if ('container' === $container) : ?>
						<div class="container flex-grow-max flex-order-1">
						<?php endif; ?>



						<a class="navbar-toggler" id="menu_toggle_icon" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"></a>

						<!-- The WordPress Menu goes here -->
						<?php
						$menu  = wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'container_class' => 'collapse navbar-collapse',
								'container_id'    => 'navbarNavDropdown',
								'menu_class'      => 'navbar-nav Menu1',
								'fallback_cb'     => '',
								'menu_id'         => 'main-menu',
								'depth'           => 2,
							)
						);

						echo strip_tags($menu, '<a>');
						?>
						<?php if ('container' === $container) : ?>
						</div><!-- .container -->
					<?php endif; ?>

				</nav><!-- .site-navigation -->
			<?php
			if (function_exists('yoast_breadcrumb')) {
				yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
			}
			?>
			</div><!-- #wrapper-navbar end -->

			<div id="allpages">