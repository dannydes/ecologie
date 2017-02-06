<?php

/**
 * Returns theme options' default values.
 *
 * @return array Default values.
 */
function ecologie_get_default_options() {
	$options = array(
		'add_this_script_url' => '',
		'cta_block_text' => 'Veggies es bonus vobis, proinde vos postulo essum magis kohlrabi welsh onion daikon amaranth tatsoi tomatillo melon azuki bean garlic.',
		'cta_block_btn_text' => 'Join us',
		'cta_block_btn_url' => '#',
		'add_this_enabled' => true,
		'blog_posts_per_page' => 10,
		'recent_posts' => 5,
		'copyright_text_addition' => '',
	);
	return $options;
}

/**
 * Attach new controls to the site customizer.
 *
 * @param object $wp_customize Instance of WP_Customize_Manager.
 */
function ecologie_customize_register( $wp_customize ) {
	$defaults = ecologie_get_default_options();
	
	$settings = array(
		array( 'cta_block_text', array(
			'type' => 'text',
			'label' => 'Call for Action Text',
			'section' => 'cta_block',
		) ),
		array( 'cta_block_btn_text', array(
			'type' => 'text',
			'label' => 'Call for Action Button Text',
			'section' => 'cta_block',
		) ),
		array( 'cta_block_btn_url', array(
			'type' => 'url',
			'label' => 'Call for Action Button URL',
			'section' => 'cta_block',
		) ),
		array( 'add_this_script_url', array(
			'type' => 'text',
			'label' => 'AddThis script URL',
			'section' => 'add_this',
			'description' => 'Enter the <b>src</b> of the <b>script</b> given by AddThis.',
		) ),
		array( 'add_this_enabled', array(
			'type' => 'checkbox',
			'label' => 'Enable AddThis sharing buttons',
			'section' => 'add_this',
		) ),
		array( 'blog_posts_per_page', array(
			'type' => 'number',
			'label' => 'Blog posts per page',
			'section' => 'blog',
		) ),
		array( 'recent_posts', array(
			'type' => 'number',
			'label' => 'Number of recent posts',
			'section' => 'blog',
		) ),
		array( 'copyright_text_addition', array(
			'type' => 'text',
			'label' => 'Text to add to copyright notice',
			'section' => 'footer',
		) ),
	);
	
	$wp_customize->add_panel( 'ecologie', array(
		'title' => __( 'Ecologie Settings' ),
		'description' => __( 'Settings related to Ecologie theme' ),
	) );
	
	$wp_customize->add_section( 'cta_block', array(
		'title' => __( 'Home Call to Action Block' ),
		'description' => __( 'Configures the appearance of the home\'s call-to-action block.' ),
		'panel' => 'ecologie',
	) );
	
	$wp_customize->add_section( 'add_this', array(
		'title' => __( 'AddThis Social Sharing Tool' ),
		'description' => __( 'Configures the AddThis tool.' ),
		'panel' => 'ecologie',
	) );
	
	$wp_customize->add_section( 'blog', array(
		'title' => __( 'Blog' ),
		'description' => __( 'Configures blog.' ),
		'panel' => 'ecologie',
	) );
	
	$wp_customize->add_section( 'footer', array(
		'title' => __( 'Footer' ),
		'description' => __( 'Configures footer.' ),
		'panel' => 'ecologie',
	) );
	
	foreach ( $settings as $setting ) {
		$wp_customize->add_setting( $setting[0], array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => $defaults[$setting[0]],
			//'transport' => 'postmessage',
		) );
		
		$wp_customize->add_control( $setting[0], $setting[1] );
	}
}

add_action( 'customize_register', 'ecologie_customize_register' );

/**
 * Enqueue scripts to be used by customizer live preview.
 */
function ecologie_customizer_live_preview() {
		wp_enqueue_script( 'theme-customize',
			get_template_directory_uri() . '/js/theme-customize.js',
			array( 'jquery', 'customize-preview' ),
			wp_get_theme()->get( 'Version' ),
			true );
}

add_action( 'customize_preview_init', 'ecologie_customizer_live_preview' );