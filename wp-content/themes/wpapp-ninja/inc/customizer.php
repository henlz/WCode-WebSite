<?php
/**
 * Material Design Theme Customizer
 *
 * @package material-design-par-amauri
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function material_design_par_amauri_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	$colors = array();
	$colors[] = array(
		'slug'=>'material_design_par_amauri_primary_color', 
		'default' => '#03A9F4',
		'label' => __('Color of the toolbar', 'material-design-par-amauri')
	);
	$colors[] = array(
		'slug'=>'material_design_par_amauri_secondary_color', 
		'default' => '#FF5252',
		'label' => __('Color of links, input, ...', 'material-design-par-amauri')
	);
	foreach( $colors as $color ) {
		$wp_customize->add_setting(
			$color['slug'], array(
				'sanitize_callback' => 'sanitize_hex_color',
				'default' => $color['default'],
				'type' => 'option', 
				'capability' => 'edit_theme_options'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$color['slug'], 
				array('label' => $color['label'], 
					'section' => 'colors',
					'settings' => $color['slug'])
			)
		);
	}
	
	$wp_customize->add_section( 'material_design_par_amauri_logo_section' , array(
		'title'       => __( 'Logo (72x72 - hdpi)', 'material_design' ),
		'priority'    => 30,
		'description' => sprintf(__( 'Upload a logo to replace the default one in the drawer header. <a href="%1$s" target="_blank"><b>Generate for free here!</b></a>', 'material_design' ), esc_url('http://wpapp.ninja/creation-logo/')),
	) );
	$wp_customize->add_setting( 'material_design_par_amauri_logo' , array('sanitize_callback' => 'esc_url_raw'));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'material_design_par_amauri_logo', array(
		'label'    => __( 'Logo', 'material_design' ),
		'section'  => 'material_design_par_amauri_logo_section',
		'settings' => 'material_design_par_amauri_logo',
	) ) );
}
add_action( 'customize_register', 'material_design_par_amauri_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function material_design_par_amauri_customize_preview_js() {
	wp_enqueue_script( 'material_design_par_amauri_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'material_design_par_amauri_customize_preview_js' );
