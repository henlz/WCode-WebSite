<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package material-design-par-amauri
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if (is_home()) { ?>
			<h1 class="page-title h1header">
				<?php echo esc_attr(get_bloginfo('name'));?></b>
				<span class="site-description"><?php echo esc_attr(get_bloginfo('description'));?></span>
			</h1>
		<?php } ?>
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(
				array(
					'prev_text'          => '<span class="material_design_par_amauri_navigate">&#x2770;</span> ' . __( 'Older posts' , 'material-design-par-amauri'),
					'next_text'          => __( 'Newer posts', 'material-design-par-amauri' ) . ' <span class="material_design_par_amauri_navigate">&#x2771;</span>'
				)
			); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
