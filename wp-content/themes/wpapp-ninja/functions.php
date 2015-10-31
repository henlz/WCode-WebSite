<?php
/**
 * Material Design functions and definitions
 *
 * @package material-design-par-amauri
 */

if ( ! function_exists( 'material_design_par_amauri_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function material_design_par_amauri_setup() {
	
	// setting content width
    global $content_width;
    if ( ! isset( $content_width ) ){
        $content_width = 807;
    }
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Material Design, use a find and replace
	 * to change 'material-design-par-amauri' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'material-design-par-amauri', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'material-design-par-amauri' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'gallery',
		'link',
		'image',
		'quote',
		'status',
		'video',
		'audio',
		'chat',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'material_design_par_amauri_custom_background_args', array(
		'default-color' => 'eeeeee',
		'default-image' => '',
	) ) );
}
endif; // material_design_par_amauri_setup
add_action( 'after_setup_theme', 'material_design_par_amauri_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function material_design_par_amauri_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'material-design-par-amauri' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'material-design-par-amauri' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'material_design_par_amauri_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function material_design_par_amauri_scripts() {
	wp_enqueue_style( 'material-design-par-amauri-style', get_stylesheet_uri() );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'material_design_par_amauri_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Format the chat format.
 */
require get_template_directory() . '/inc/chat-transcript.php';

/**
 * Format the quote format.
 */
require get_template_directory() . '/inc/quote.php';

/**
 * Format the link format.
 */
require get_template_directory() . '/inc/link.php';

/**
 * Add a Read More link after excerpt.
 */
function material_design_par_amauri_excerpt_more( $text ) {
	return $text . '<a class="more-link" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More', 'material-design-par-amauri' ) . '</a>';
}
add_filter( 'the_excerpt', 'material_design_par_amauri_excerpt_more' );

/**
 * Return an image for the post
 *
 * - featured if available
 * - one image on the post
 */
function material_design_par_amauri_getImage($id) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' );
	if ($image[0] != '') {
		return $image[0];
	}
	
	$images = get_attached_media('image', $id);
	foreach($images as $img) {
		$i = wp_get_attachment_image_src($img->ID, 'large');
		if ($i[0] != '') {
			return $i[0];
		}
	}
	
	return '';
}

/**
 * Get and format the title for be sharing friendly.
 */
function material_design_par_amauri_get_title() {
	$title = wp_title('|', false, 'right');
	if ($title == '') {
		$title = esc_textarea(get_bloginfo('name'));
	} else {
		$title_arr = explode('|', $title);
		$title = trim($title_arr[0]);
	}
	
	return $title;
}

/**
 * Construct the current url.
 * HTTPS supported.
 */
function material_design_par_amauri_current_url() {
	$host = 'http://';
	if (isset($_SERVER['HTTPS'])) {$host = 'https://';}

	return $host . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * Extract the first link on link post.
 */
function material_design_par_amauri_get_link() {
	$link_url	= get_the_permalink();
	$link_txt	= get_the_title();
	$content	= get_the_content();
	
	// try to get an url.
	if (preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $content, $match_url)) {
		$link_url = $match_url[0][0];
	}
	
	// try to get an anchor.
	if (preg_match_all("|<a.*(?=href=\"([^\"]*)\")[^>]*>([^<]*)</a>|i", $content, $match_txt)) {
		$link_txt = $match_txt[0][0];
	}
	
	if ($link_url != '' && $link_txt != '') {
		return '<h1 class="entry-title"><img width="36" height="36" src="' . esc_url(get_template_directory_uri().'/image/icon/_' . get_post_format() . '.png') . '" alt="' . get_post_format() . '" /> <a href="' . esc_url($link_url) . '" rel="bookmark">' . $link_txt . '</a></h1>';
	}
}

/**
 * Output links for social sharing.
 */
function material_design_par_amauri_share() {
	$page_courante	= material_design_par_amauri_current_url();
	$tweet			= urlencode(html_entity_decode(material_design_par_amauri_get_title()));
	
	$html = '<b>Partager</b>';
	
	// twitter
	$html .= '<a href="https://twitter.com/intent/tweet?text=' . $tweet . '%20' . $page_courante . '" target="_blank">
		<img width="24" height="24" src="' . esc_url( get_template_directory_uri() ) . '/image/social/twitter.png" alt="Twitter" /> Twitter
	</a>';
	
	// facebook
	$html .= '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $page_courante . '" target="_blank">
		<img width="24" height="24" src="' . esc_url( get_template_directory_uri() ) . '/image/social/facebook.png" alt="Facebook" /> Facebook
	</a>';
	
	// linkedin
	$html .= '<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=' . $page_courante . '" target="_blank">
		<img width="24" height="24" src="' . esc_url( get_template_directory_uri() ) . '/image/social/linkedin.png" alt="Linkedin" /> Linkedin
	</a>';
	
	// google+
	$html .= '<a href="https://plus.google.com/share?url=' . $page_courante . '" target="_blank">
		<img width="24" height="24" src="' . esc_url( get_template_directory_uri() ) . '/image/social/google_plus.png" alt="Google+" /> Google+
	</a>';
	
	// pinterest
	$html .= '<a class="lien_partage_pinterest" href="http://pinterest.com/pin/create/button/?url=' . $page_courante . '" target="_blank" >
		<img alt="Pinterest" width="24" height="24" src="' . esc_url( get_template_directory_uri() ) . '/image/social/pinterest.png" /> Pinterest
	</a>';
	
	$html .= '<br/>';
	
	return $html;
}

/**
 * Inject CSS and JS.
 */
function material_design_par_amauri_js_css() {
	$primary = substr(get_option('material_design_par_amauri_primary_color'), 1, 6);
	$secondary = substr(get_option('material_design_par_amauri_secondary_color'), 1, 6);

	// Live preview on ThemeCustomizer.
	if (isset($_POST['customized'])) {
		$json_data = json_decode(preg_replace('#\\\"#', '"', $_POST['customized']), TRUE);
		if (isset($json_data['material_design_par_amauri_primary_color'])) {
			$primary = substr($json_data['material_design_par_amauri_primary_color'], 1, 6);
		}
		if (isset($json_data['material_design_par_amauri_secondary_color'])) {
			$secondary = substr($json_data['material_design_par_amauri_secondary_color'], 1, 6);
		}
	}
	
	// sanitize colors
	if (!preg_match('|^([A-Fa-f0-9]{3}){1,2}$|', $primary)) {
		$primary = '03A9F4';
	}
	if (!preg_match('|^([A-Fa-f0-9]{3}){1,2}$|', $secondary)) {
		$secondary = 'FF5252';
	}
	
	wp_enqueue_style( 'material_design_par_amauri_dynamic_color', get_template_directory_uri() . '/css/material.php?p='.$primary.'&amp;s='.$secondary );
    wp_enqueue_script( 'material_design_par_amauri_main', get_template_directory_uri() . '/js/material.js', array( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'material_design_par_amauri_js_css' );

/**
 * Add Editor Style
 */
function material_design_par_amauri_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'material_design_par_amauri_add_editor_styles' );
