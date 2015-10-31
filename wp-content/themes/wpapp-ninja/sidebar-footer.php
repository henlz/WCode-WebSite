<?php
/**
 * The sidebar containing the footer widget area.
 *
 * @package material-design-par-amauri
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>
<div class="material_design_par_amauri_footer_sidebar">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</div><!-- #secondary -->