<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package material-design-par-amauri
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
	if (material_design_par_amauri_getImage(get_the_ID()) != '') {
		echo '<div class="material_feat" style="background-image:url('.material_design_par_amauri_getImage(get_the_ID()).')"></div>';
	}
	?>
	<header class="entry-header">
		<?php
		if (get_post_format() == 'link') {
			echo material_design_par_amauri_get_link();
		} else {
			the_title( sprintf( '<h1 class="entry-title"><img width="36" height="36" src="%s" alt="%s" /> <a href="%s" rel="bookmark">', esc_url(get_template_directory_uri().'/image/icon/_' . get_post_format() . '.png'), get_post_format(), esc_url( get_permalink() ) ), '</a></h1>' );
		}
		?>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php material_design_par_amauri_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php
		if (has_excerpt()) {
			the_excerpt();
		} else {
			the_content( sprintf(
				wp_kses( __( 'Read more', 'material-design-par-amauri' ), array( 'span' => array( 'class' => array('read-more') ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		}
		?>
	</div><!-- .entry-summary -->
	
	<footer class="entry-footer">
		<?php material_design_par_amauri_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

