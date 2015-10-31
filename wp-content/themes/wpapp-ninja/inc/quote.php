<?php

/* Filter the content of quote posts. */
add_filter( 'the_content', 'material_design_par_amauri_quote_content' );

/**
 * Add blockquote if none.
 */
function material_design_par_amauri_quote_content( $content ) {
	/* If this is not a 'quote' post, return the content. */
	if ( !has_post_format( 'quote' ) )
		return $content;

	if (!preg_match('#<blockquote#', $content)) {
		$content = '<blockquote>'.$content.'</blockquote>';
	}
	
	return $content;
}
