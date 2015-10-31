<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package material-design-par-amauri
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><span class="material_design_par_amauri_navigate">&#x2770;</span> <?php next_posts_link( esc_html__( 'Older posts', 'material-design-par-amauri' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'material-design-par-amauri' ) ); ?> <span class="material_design_par_amauri_navigate">&#x2771;</span></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '<span class="material_design_par_amauri_navigate">&#x2770;</span> %title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title <span class="material_design_par_amauri_navigate">&#x2771;</span>' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'material_design_par_amauri_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function material_design_par_amauri_posted_on() {
	
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html__( 'Posted on %s', 'material-design-par-amauri' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html__( 'by %s', 'material-design-par-amauri' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	if (is_singular()) {
		echo '<img width="36" height="36" src="' . esc_url(get_template_directory_uri().'/image/icon/_' . get_post_format() . '.png') . '" alt="' . get_post_format() . '" /> ';
	}
	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span> ';
	
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'material-design-par-amauri' ) );
		if ( $categories_list && material_design_par_amauri_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'in %1$s', 'material-design-par-amauri' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'material-design-par-amauri' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( ', tagged: %1$s', 'material-design-par-amauri' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}


}
endif;

if ( ! function_exists( 'material_design_par_amauri_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function material_design_par_amauri_entry_footer() {
	edit_post_link( esc_html__( 'Edit', 'material-design-par-amauri' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( 'Category: %s', 'material-design-par-amauri' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Tag: %s', 'material-design-par-amauri' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Author: %s', 'material-design-par-amauri' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Year: %s', 'material-design-par-amauri' ), get_the_date( esc_html__( 'Y', 'material-design-par-amauri' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Month: %s', 'material-design-par-amauri' ), get_the_date( esc_html__( 'F Y', 'material-design-par-amauri' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Day: %s', 'material-design-par-amauri' ), get_the_date( esc_html__( 'F j, Y', 'material-design-par-amauri' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html__( 'Asides', 'material-design-par-amauri' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html__( 'Galleries', 'material-design-par-amauri' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html__( 'Images', 'material-design-par-amauri' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html__( 'Videos', 'material-design-par-amauri' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html__( 'Quotes', 'material-design-par-amauri' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html__( 'Links', 'material-design-par-amauri' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html__( 'Statuses', 'material-design-par-amauri' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html__( 'Audio', 'material-design-par-amauri' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html__( 'Chats', 'material-design-par-amauri' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: %s', 'material-design-par-amauri' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'material-design-par-amauri' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'material-design-par-amauri' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;  // WPCS: XSS OK.
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function material_design_par_amauri_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'material_design_par_amauri_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'material_design_par_amauri_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so material_design_par_amauri_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so material_design_par_amauri_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in material_design_par_amauri_categorized_blog.
 */
function material_design_par_amauri_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'material_design_par_amauri_categories' );
}
add_action( 'edit_category', 'material_design_par_amauri_category_transient_flusher' );
add_action( 'save_post',     'material_design_par_amauri_category_transient_flusher' );
