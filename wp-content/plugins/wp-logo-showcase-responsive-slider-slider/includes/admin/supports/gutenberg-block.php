<?php
/**
 * Blocks Initializer
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 2.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function wpls_register_guten_block() {

	// Block Editor Script
	wp_register_script( 'wpls-free-block-js', WPLS_URL.'assets/js/blocks.build.js', array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-block-editor', 'wp-components' ), WPLS_VERSION, true );

	wp_localize_script( 'wpls-free-block-js', 'Wplsf_Block', array(
																'pro_demo_link' => 'https://demo.wponlinesupport.com/prodemo/pro-logo-showcase-responsive-slider/',
																'free_demo_link' => 'https://demo.wponlinesupport.com/logo-slider-plugin-demo/',
																'pro_link' => WPLS_PLUGIN_LINK_UNLOCK,
															));

	// Register block and explicit attributes for grid
	register_block_type( 'wpls/logoshowcase', array(
		'attributes' => array(
			'limit' => array(
							'type'		=> 'number',
							'default'	=> 15,
						),
			'design' => array(
							'type'		=> 'string',
							'default'	=> 'design-1',
						),
			'cat_id' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'cat_name' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'slides_column' => array(
							'type'		=> 'number',
							'default'	=> 4,
						),
			'slides_scroll' => array(
							'type'		=> 'number',
							'default'	=> 1,
						),
			'dots' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'arrows' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'autoplay' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'autoplay_interval' => array(
							'type'		=> 'number',
							'default'	=> 2000,
						),
			'speed' => array(
							'type'		=> 'number',
							'default'	=> 1000,
						),
			'center_mode' => array(
							'type'		=> 'string',
							'default'	=> 'false',
						),
			'loop' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'lazyload' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'link_target' => array(
							'type'		=> 'string',
							'default'	=> 'self',
						),
			'show_title' => array(
							'type'		=> 'boolean',
							'default'	=> false,
						),
			'image_size' => array(
							'type'		=> 'string',
							'default'	=> 'original',
						),
			'orderby' => array(
							'type'		=> 'string',
							'default'	=> 'date',
						),
			'order' => array(
							'type'		=> 'string',
							'default'	=> 'asc',
						),
			'hide_border' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'max_height' => array(
							'type'		=> 'number',
							'default'	=> 250,
						),
			'align' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'className' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
		),
		'render_callback' => 'wpls_logo_slider',
	));

	if ( function_exists( 'wp_set_script_translations' ) ) {
		wp_set_script_translations( 'wpls-free-block-js', 'wp-logo-showcase-responsive-slider-slider', WPLS_DIR . '/languages' );
	}
}
add_action( 'init', 'wpls_register_guten_block' );

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 2.5
 */
function wpls_editor_assets() {

	// Block Editor CSS
	if( ! wp_style_is( 'wpos-free-guten-block-css', 'registered' ) ) {
		wp_register_style( 'wpos-free-guten-block-css', WPLS_URL.'assets/css/blocks.editor.build.css', array( 'wp-edit-blocks' ), WPLS_VERSION );
	}
	
	// Block Editor Script - Style
	wp_enqueue_style( 'wpos-free-guten-block-css' );
	wp_enqueue_script( 'wpls-free-block-js' );
}
add_action( 'enqueue_block_editor_assets', 'wpls_editor_assets' );

/**
 * Adds an extra category to the block inserter
 *
 * @package WP Logo Showcase Responsive Slider
 * @since 2.5
 */
function wpls_add_block_category( $categories ) {

	$guten_cats = wp_list_pluck( $categories, 'slug' );

	if( ! in_array( 'wpos_guten_block', $guten_cats ) ) {
		$categories[] = array(
							'slug'	=> 'wpos_guten_block',
							'title'	=> esc_html__('WPOS Blocks', 'wp-logo-showcase-responsive-slider-slider'),
							'icon'	=> null,
						);
	}

	return $categories;
}
add_filter( 'block_categories_all', 'wpls_add_block_category' );