<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package material-design-par-amauri
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

// Get the logo url.
if ( get_theme_mod( 'material_design_par_amauri_logo' ) ) :
	$material_design_par_amauri_image_url = get_theme_mod( 'material_design_par_amauri_logo' );
else :
	$material_design_par_amauri_image_url = get_template_directory_uri().'/image/drawer/ic_launcher.png';
endif;
?>
<div id="drawer">
	<div class="header">
		<img src="<?php echo esc_url($material_design_par_amauri_image_url); ?>" height="72" width="72" alt="<?php echo esc_attr(get_bloginfo('name'));?>" /><br/>
		<a href="<?php echo esc_url(home_url());?>" class="site-title"><b><?php echo esc_attr(get_bloginfo('name'));?></b></a>
		<div class="site-description"><?php echo esc_attr(get_bloginfo('description'));?></div>
	</div>

	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary -->
</div><!-- #drawer -->