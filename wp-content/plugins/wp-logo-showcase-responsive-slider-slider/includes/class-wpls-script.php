<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP Logo Showcase Responsive Slider
 * @since 1.2.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wpls_Script {

	function __construct() {

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wpls_admin_style_script') );

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpls_logoshowcase_style_css' ));
	
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpls_logoshowcase_script') );

	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 2.7.2
	 */
	function wpls_register_admin_assets(){

		/* Styles */
		// Registring admin css
		wp_register_style( 'wpls-admin-style', WPLS_URL.'assets/css/logo-showcase-admin.css', array(), WPLS_VERSION );

		/* Scripts */
		// Registring admin script
		wp_register_script( 'wpls-admin-script', WPLS_URL.'assets/js/wpls-admin.js', array('jquery'), WPLS_VERSION, true );

	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 2.5
	 */
	function wpls_admin_style_script( $hook ) {

		$this->wpls_register_admin_assets();

		global $typenow, $wp_version;

		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts

		// Taking pages array
		$pages_arr = array( WPLS_POST_TYPE );

		if( in_array($typenow, $pages_arr) ) {
			wp_enqueue_style( 'wpls-admin-style' );
		}

		if( $hook == WPLS_POST_TYPE.'_page_wpls-designs' ){
			wp_enqueue_script( 'wpls-admin-script' );
		}
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 1.0.0
	 */
	function wpls_logoshowcase_style_css() {
		// Registring and enqueing slick slider css
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', WPLS_URL.'assets/css/slick.css', array(), WPLS_VERSION );
			wp_enqueue_style( 'wpos-slick-style' );
		}

		wp_register_style( 'logo_showcase_style', WPLS_URL.'assets/css/logo-showcase.css', array(), WPLS_VERSION );
		wp_enqueue_style( 'logo_showcase_style');

	}

	/**
	 * Function to add style at front side
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 1.0.0
	 */
	function wpls_logoshowcase_script(){

		global $post;

		// Registring slick slider js
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WPLS_URL.'assets/js/slick.min.js', array('jquery'), WPLS_VERSION, true );
		}

		// Register Elementor script
		wp_register_script( 'wpls-elementor-js', WPLS_URL.'assets/js/elementor/wpls-elementor.js', array('jquery'), WPLS_VERSION, true );

		wp_register_script( 'wpls-public-js', WPLS_URL.'assets/js/wpls-public.js', array('jquery'), WPLS_VERSION, true );		
		wp_localize_script( 'wpls-public-js', 'Wpls', array(
															'is_mobile' =>	(wp_is_mobile()) ? 1 : 0,
															'is_rtl' 	=>	(is_rtl()) ? 1 : 0,
															'is_avada' 	=> (class_exists( 'FusionBuilder' ))	? 1 : 0,
		));

		// Enqueue Script for Elementor Preview
		if ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_GET['elementor-preview'] ) && $post->ID == (int) $_GET['elementor-preview'] ) {

			wp_enqueue_script( 'wpos-slick-jquery' );
			wp_enqueue_script( 'wpls-public-js' );
			wp_enqueue_script( 'wpls-elementor-js' );
		}

		// Enqueue Style & Script for Beaver Builder
		if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {

			$this->wpls_register_admin_assets();

			wp_enqueue_style( 'wpls-admin-style');
			wp_enqueue_script( 'wpls-admin-script' );
			wp_enqueue_script( 'wpos-slick-jquery' );
			wp_enqueue_script( 'wpls-public-js' );
		}

		// Enqueue Admin Style & Script for Divi Page Builder
		if( function_exists( 'et_core_is_fb_enabled' ) && isset( $_GET['et_fb'] ) && $_GET['et_fb'] == 1 ) {
			$this->wpls_register_admin_assets();

			wp_enqueue_style( 'wpls-admin-style');
		}

		// Enqueue Admin Style for Fusion Page Builder
		if( class_exists( 'FusionBuilder' ) && (( isset( $_GET['builder'] ) && $_GET['builder'] == 'true' ) ) ) {
			$this->wpls_register_admin_assets();

			wp_enqueue_style( 'wpls-admin-style');
		}
	}
}

$wpls_script = new Wpls_Script();