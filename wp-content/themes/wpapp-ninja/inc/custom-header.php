<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @package material-design-par-amauri
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses material_design_par_amauri_header_style()
 * @uses material_design_par_amauri_admin_header_style()
 * @uses material_design_par_amauri_admin_header_image()
 */
function material_design_par_amauri_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'material_design_par_amauri_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'FFFFFF',
		'width'                  => 1000,
		'height'                 => 420,
		'flex-height'            => true,
		'wp-head-callback'       => 'material_design_par_amauri_header_style',
		'admin-head-callback'    => 'material_design_par_amauri_admin_header_style',
		'admin-preview-callback' => 'material_design_par_amauri_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'material_design_par_amauri_custom_header_setup' );

if ( ! function_exists( 'material_design_par_amauri_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see material_design_par_amauri_custom_header_setup().
 */
function material_design_par_amauri_header_style() {
	
	$backIMG = '';
	if (is_front_page() && get_header_image() != '') {
		$backIMG = get_header_image();
	} elseif (material_design_par_amauri_getImage(get_the_ID()) != '' && is_singular()) {
		$backIMG = material_design_par_amauri_getImage(get_the_ID());
	}
	?>

	<style type="text/css">
	.site-header {
		<?php
		// if featured image
		if($backIMG != '') {
			echo 'background-image:url('.$backIMG.');';
			echo 'background-image:-moz-linear-gradient(top, rgba(0,0,0,0) 0%, rgba(0,0,0,0.65) 100%), url('.$backIMG.');'; /* FF3.6+ */
			echo 'background-image:-webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))), url('.$backIMG.');'; /* Chrome,Safari4+ */
			echo 'background-image:-webkit-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.65) 100%), url('.$backIMG.');'; /* Chrome10+,Safari5.1+ */
			echo 'background-image:-o-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.65) 100%), url('.$backIMG.');'; /* Opera 11.10+ */
			echo 'background-image:-ms-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.65) 100%), url('.$backIMG.');'; /* IE10+ */
			echo 'background-image:linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0.65) 100%), url('.$backIMG.');'; /* W3C */
			echo 'background-repeat: no-repeat;background-position: center center;';
			echo 'background-size:cover !important;';
		}
		?>
		height:420px;
	}
	</style>
	
	<?php
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value.
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		#drawer .header b {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
		#drawer .header .site-description {
			<?php list($r, $g, $b) = sscanf($header_text_color, "%02x%02x%02x"); ?>
			color: rgba(<?php echo $r . ', ' . $g . ', ' . $b . ', 0.68'; ?>);
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // material_design_par_amauri_header_style

if ( ! function_exists( 'material_design_par_amauri_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see material_design_par_amauri_custom_header_setup().
 */
function material_design_par_amauri_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // material_design_par_amauri_admin_header_style

if ( ! function_exists( 'material_design_par_amauri_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see material_design_par_amauri_custom_header_setup().
 */
function material_design_par_amauri_admin_header_image() {
?>
	<div id="headimg">
		<h1 class="displaying-header-text">
			<a id="name" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<div class="displaying-header-text" id="desc" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>"><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // material_design_par_amauri_admin_header_image
