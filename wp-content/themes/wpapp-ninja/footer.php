<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package material-design-par-amauri
 */
?>
		<div id="loveit"></div>
		<div id="shareit">
			<?php echo material_design_par_amauri_share(); ?>
		</div><!-- #shareit -->
		<div class="clear empty"></div>

	</div><!-- #content -->
	
	<div id="background"></div>	
	<div id="positionning"></div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php get_sidebar('footer'); ?>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'material-design-par-amauri' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'material-design-par-amauri' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'material-design-par-amauri' ), sprintf('<a href="%1$s">wpapp.ninja</a>', esc_url( 'http://wpapp.ninja/theme/' )), 'Amauri'); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
