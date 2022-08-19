<?php
/**
 * Plugin Name: WP Logo Showcase Responsive Slider and Carousel
 * Plugin URI: https://www.essentialplugin.com/wordpress-plugin/wp-logo-showcase-responsive-slider/
 * Description: Easy to add and display Logo Showcase Responsive Slider on your website. Also added Gutenberg block support.
 * Author: WP OnlineSupport, Essential Plugin
 * Text Domain: wp-logo-showcase-responsive-slider-slider
 * Domain Path: /languages/
 * Version: 3.1.4
 * Author URI: https://www.essentialplugin.com/wordpress-plugin/wp-logo-showcase-responsive-slider/
 *
 * @package WordPress
 * @author WP OnlineSupport
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( !defined( 'WPLS_VERSION' ) ) {
	define( 'WPLS_VERSION', '3.1.4' ); // Version of plugin
}
if( !defined( 'WPLS_NAME' ) ) {
	define( 'WPLS_NAME', 'Logo Showcase Responsive Slider' ); // Plugin name
}
if( !defined( 'WPLS_DIR' ) ) {
	define( 'WPLS_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPLS_URL' ) ) {
	define( 'WPLS_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPLS_POST_TYPE' ) ) {
	define( 'WPLS_POST_TYPE', 'logoshowcase' ); // Plugin Post Type
}
if( !defined( 'WPLS_CAT_TYPE' ) ) {
	define( 'WPLS_CAT_TYPE', 'wplss_logo_showcase_cat' ); // Plugin Post Type
}
if( !defined( 'WPLS_META_PREFIX' ) ) {
	define( 'WPLS_META_PREFIX', '_wpls_' ); // Plugin metabox prefix
}

if(!defined( 'WPLS_PLUGIN_BUNDLE_LINK' ) ) {
	define('WPLS_PLUGIN_BUNDLE_LINK','https://www.essentialplugin.com/pricing/?utm_source=WP&utm_medium=Logoshowcase&utm_campaign=Welcome-Screen'); // Plugin link
}

if(!defined( 'WPLS_PLUGIN_LINK_UNLOCK' ) ) {
	define('WPLS_PLUGIN_LINK_UNLOCK','https://www.essentialplugin.com/wordpress-plugin/wp-logo-showcase-responsive-slider/?utm_source=WP&utm_medium=Logoshowcase&utm_campaign=Features-PRO#wpos-epb'); // Plugin link
}

if(!defined( 'WPLS_PLUGIN_LINK_UPGRADE' ) ) {
	define('WPLS_PLUGIN_LINK_UPGRADE','https://www.essentialplugin.com/wordpress-plugin/wp-logo-showcase-responsive-slider/?utm_source=WP&utm_medium=Logoshowcase&utm_campaign=Upgrade-PRO#wpos-epb'); // Plugin Check link
}

if(!defined( 'WPLS_PLUGIN_LINK_HOWITWORK' ) ) {
	define('WPLS_PLUGIN_LINK_HOWITWORK','https://www.essentialplugin.com/wordpress-plugin/wp-logo-showcase-responsive-slider/?utm_source=WP&utm_medium=Logoshowcase&utm_campaign=How-It-Work#wpos-epb'); // Plugin Check link
}

if(!defined( 'WPLS_SITE_LINK' ) ) {
	define('WPLS_SITE_LINK','https://www.essentialplugin.com'); // Plugin link
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */
function wpls_load_textdomain() {

	global $wp_version;

	// Set filter for plugin's languages directory
	$wpls_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$wpls_lang_dir = apply_filters( 'wpls_languages_directory', $wpls_lang_dir );

	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale',  $get_locale, 'wp-logo-showcase-responsive-slider-slider' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'wp-logo-showcase-responsive-slider-slider', $locale );

	// Setup paths to current locale file
	$mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WPLS_DIR ) . '/' . $mofile;

	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
		load_textdomain( 'wp-logo-showcase-responsive-slider-slider', $mofile_global );
	} else { // Load the default language files
		load_plugin_textdomain( 'wp-logo-showcase-responsive-slider-slider', false, $wpls_lang_dir );
	}

}
add_action('plugins_loaded', 'wpls_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpls_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wpls_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */
function wpls_install() {

	// Register post type function
	wplss_logo_showcase_post_types();
	wplss_logo_showcase_taxonomies();

	// IMP need to flush rules for custom registered post type
	flush_rewrite_rules();

	// Deactivate free version
	if( is_plugin_active('wp-logo-showcase-responsive-slider-pro/logo-showcase.php') ){
		add_action('update_option_active_plugins', 'wpls_deactivate_free_version');
	}

	// Add option for solutions & features
	add_option( 'wpls_sf_optin', true );
}

/**
 * Plugin Deactivation Function
 * Delete  plugin options
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */
function wpls_uninstall() {
	
	// IMP need to flush rules for custom registered post type
	flush_rewrite_rules();
}

/**
 * Deactivate free plugin
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.2.4
 */
function wpls_deactivate_free_version() {
	deactivate_plugins('wp-logo-showcase-responsive-slider-pro/logo-showcase.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.2.4
 */
function wpls_admin_notice() {
	
	global $pagenow;

	$dir = ABSPATH . 'wp-content/plugins/wp-logo-showcase-responsive-slider-pro/logo-showcase.php';

	$notice_link        = add_query_arg( array('message' => 'wpls-plugin-notice'), admin_url('plugins.php') );
	$notice_transient   = get_transient( 'wpls_install_notice' );
	
	// If Free plugin is active and PRO plugin exist
	if( $notice_transient == false && $pagenow == 'plugins.php' && file_exists( $dir ) && current_user_can( 'install_plugins' ) ) {        
				echo '<div class="updated notice" style="position:relative;">
					<p>
						<strong>'.sprintf( __('Thank you for activating %s', 'wp-logo-showcase-responsive-slider-slider'), 'WP Logo Showcase Responsive Slider').'</strong>.<br/>
						'.sprintf( __('It looks like you had PRO version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'wp-logo-showcase-responsive-slider-slider'), '<strong>(<em>WP Logo Showcase Responsive Slider Pro</em>)</strong>' ).'
					</p>
					<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
				</div>';
	}

}

// Action to display notice
add_action( 'admin_notices', 'wpls_admin_notice');

// Functions file
require_once( WPLS_DIR . '/includes/wpls-functions.php' );

// Post type file
require_once( WPLS_DIR . '/includes/wpls-post-types.php' );

// Admin file for pro vs free
require_once( WPLS_DIR . '/includes/admin/class-wpls-admin.php' );

// Script file
require_once( WPLS_DIR . '/includes/class-wpls-script.php' );

// Shortcode File
require_once( WPLS_DIR . '/includes/shortcode/wpls-logo-slider.php' );

// Gutenberg Block Initializer
if ( function_exists( 'register_block_type' ) ) {
	require_once( WPLS_DIR . '/includes/admin/supports/gutenberg-block.php' );
}

/* Plugin Wpos Analytics Data Starts */
function wpos_analytics_anl23_load() {

	require_once dirname( __FILE__ ) . '/wpos-analytics/wpos-analytics.php';

	$wpos_analytics =  wpos_anylc_init_module( array(
							'id'			=> 23,
							'file'			=> plugin_basename( __FILE__ ),
							'name'			=> 'WP Logo Showcase Responsive Slider',
							'slug'			=> 'wp-logo-showcase-responsive-slider',
							'type'			=> 'plugin',
							'menu'			=> 'edit.php?post_type=logoshowcase',
							'redirect_page'	=> 'edit.php?post_type=logoshowcase&page=wpls-solutions-features',
							'text_domain'	=> 'wp-logo-showcase-responsive-slider-slider',
						));

	return $wpos_analytics;
}

// Init Analytics
wpos_analytics_anl23_load();
/* Plugin Wpos Analytics Data Ends */