<?php

/* Filter the content of quote posts. */
add_filter( 'the_content', 'material_design_par_amauri_link_content' );

/**
 * remove the main link from content.
 */
function material_design_par_amauri_link_content( $content ) {
	/* If this is not a 'link' post, return the content. */
	if ( !has_post_format( 'link' ) || is_singular() )
		return $content;

	if (preg_match('|<a.*(?=href=\"([^\"]*)\")[^>]*>([^<]*)</a>|i', $content)) {
		$content = preg_replace("|<a.*(?=href=\"([^\"]*)\")[^>]*>([^<]*)</a>|i", '', $content, 1);
	} else {
		$content = preg_replace("#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#", '', $content, 1);
	}
	
	return $content;
}
