<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package purp
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'purp' ); ?></a>

    <?php if ( get_header_image() ) { ?>
    	<header id="masthead" class="site-header" role="banner">
    <?php } else { ?>
    	<header id="masthead" class="site-header" role="banner">
	        <?php } ?>
	                
			<?php // Display site icon or first letter as logo ?>	
			<div class="identity-wrap" style="background-image: url(<?php echo get_header_image(); ?>)">
  
		        <div class="site-branding">

					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php
					endif; ?>
				</div><!-- .site-branding -->
			</div>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				<div class="contact">
					<p><a href="http://rahtz.net/blog/contact">Contact Me</a></p>
		            <?php if (has_custom_logo()) the_custom_logo();?>
				</div>
			</nav><!-- #site-navigation -->
		</header><!-- #masthead -->

	<div id="content" class="site-content">
