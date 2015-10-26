<?php
/**
 * The header for the theme.
 *
 * @package Slimmy
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="wrapper">
		<header id="header">
			<?php if (get_theme_mod('slimmy_logo')): ?>
			<div class="site-logo">
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
					<img src="<?php echo esc_url(get_theme_mod('slimmy_logo')); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
				</a>
			</div>
			<?php else: ?>
			<div id="logo" class="units-row">
			    <h1><a href="<?php echo site_url(); ?>">
					<?php bloginfo('name'); ?>
				</a></h1>
				<div class="tagline"><em><?php bloginfo('description'); ?></em></div>
			</div>
			<?php endif; ?>
			<div class="header-image">
				<?php $header_image = get_header_image();
					if (!empty($header_image)) {
				?>
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
						<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height;?>" alt="" />
					</a>
				<?php
					} // if ( ! empty( $header_image ) ) 
				?>
			</div>
			<nav class="navbar navbar-pills">
				<ul id="nav">
					<?php wp_nav_menu(array('theme_location' => 'header-menu','depth' => 3)); ?>
				</ul>
			</nav>
		</header>
		<div id="main">
