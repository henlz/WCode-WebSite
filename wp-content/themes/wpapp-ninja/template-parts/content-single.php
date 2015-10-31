<?php
/**
 * Template part for displaying single posts.
 *
 * @package material-design-par-amauri
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-meta">
			<?php material_design_par_amauri_posted_on(); ?>
		</div><!-- .entry-meta -->
		
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'material-design-par-amauri' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php material_design_par_amauri_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

