<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package material-design-par-amauri
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="toolbar">
		<div class="toolbar-wrap">
			<img width="32" height="32" src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/image/icon/ic_drawer.png" id="ic_drawer" alt="Menu" />
			<h2 id="subtitle"><?php echo material_design_par_amauri_get_title();?></h2>
			<img width="32" height="32" src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/image/icon/ic_menu.png" class="right" id="ic_menu" alt="Menu" />
			<?php get_search_form(); ?>
		</div>
	</div>
	<div id="menu">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
	</div>

	<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'material-design-par-amauri' ); ?></a>
	<header id="masthead" class="site-header" role="banner"></header><!-- #masthead -->

	<div id="content" class="site-content">
