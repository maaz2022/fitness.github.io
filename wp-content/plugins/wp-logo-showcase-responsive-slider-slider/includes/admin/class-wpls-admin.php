<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wpls_Admin {

	function __construct() {

		// Admin init process
		add_action( 'admin_init', array( $this, 'wpls_admin_init_process') );

		// Admin for the Solutions & Features
		add_action( 'admin_init', array($this, 'wpls_admin_init_sf_process') );

		// Action to add metabox
		add_action( 'add_meta_boxes', array( $this, 'wpls_post_sett_metabox'), 10, 2 );

		// Action to save metabox value
		add_action( 'save_post_'.WPLS_POST_TYPE, array( $this, 'wpls_save_meta_box_data') );
		
		// Action to add admin menu
		add_action( 'admin_menu', array( $this, 'wpls_register_menu') );
		
		// Action to add custom column to Logo listing
		add_filter("manage_wplss_logo_showcase_cat_custom_column", array( $this, 'wplss_logoshowcase_cat_columns'), 10, 3);
		
		// Action to add custom column data to Logo listing
		add_filter("manage_edit-wplss_logo_showcase_cat_columns", array( $this, 'wplss_logoshowcase_cat_manage_columns') ); 
	
		// Action to add little JS code in admin footer
		add_action( 'admin_footer', array($this, 'wpls_upgrade_page_link_blank') );
	}

	/**
	 * Function to notification transient
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 1.0.0
	 */
	function wpls_admin_init_process() {

		global $typenow, $pagenow;

		$current_page = isset( $_REQUEST['page'] ) ? $_REQUEST['page'] : '';

		// If plugin notice is dismissed
		if( isset($_GET['message']) && $_GET['message'] == 'wpls-plugin-notice' ) {
			set_transient( 'wpls_install_notice', true, 604800 );
		}

		// Redirect to external page for upgrade to menu
		if( $typenow == WPLS_POST_TYPE ) {

			if( $current_page == 'wpls-upgrade-pro' ) {

				wp_redirect( WPLS_PLUGIN_LINK_UPGRADE );
				exit;
			}

			if( $current_page == 'wpls-bundle-deal' ) {

				wp_redirect( WPLS_PLUGIN_BUNDLE_LINK );
				exit;
			}
		}
	}

	/**
	 * Admin Prior Process for Solutions & Features Page Redirect
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 2.0.11
	 */
	function wpls_admin_init_sf_process() {

		if ( get_option( 'wpls_sf_optin', false ) ) {

			delete_option( 'wpls_sf_optin' );

			$redirect_link = add_query_arg( array( 'post_type' => WPLS_POST_TYPE, 'page' => 'wpls-solutions-features' ), admin_url( 'edit.php' ) );

			wp_safe_redirect( $redirect_link );

			exit;
		}
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 2.5
	 */
	function wpls_post_sett_metabox( $post_type, $post ) {
		add_meta_box( 'wpls-post-metabox', __('WP Logo Showcase Responsive Slider - Settings', 'wp-logo-showcase-responsive-slider-slider'), array($this, 'wpls_post_sett_box_callback'), WPLS_POST_TYPE, 'normal', 'high' );
		add_meta_box( 'wpls-post-metabox-pro', __('More Premium - Settings', 'wp-logo-showcase-responsive-slider-slider'), array($this, 'wpls_post_sett_box_callback_pro'), WPLS_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Function to handle 'Add Link URL' metabox HTML
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 2.5
	 */
	function wpls_post_sett_box_callback( $post ) {
		include_once( WPLS_DIR .'/includes/admin/metabox/wpls-post-setting-metabox.php');		
	}
	
	/**
	 * Function to handle 'premium ' metabox HTML
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 2.5
	 */
	function wpls_post_sett_box_callback_pro( $post ) {		
		include_once( WPLS_DIR .'/includes/admin/metabox/wpls-post-setting-metabox-pro.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 2.5
	 */
	function wpls_save_meta_box_data( $post_id ){

		global $post_type;

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  WPLS_POST_TYPE ) )              				// Check if current post type is supported.
		{
			return $post_id;
		}

		$prefix = WPLS_META_PREFIX; // Taking metabox prefix

		$logo_link 	= isset($_POST[$prefix.'logo_link']) ? wpls_clean_url( $_POST[$prefix.'logo_link'] ) : '';

		// Updating Post Meta
		update_post_meta( $post_id, 'wplss_slide_link', $logo_link );
	}

	/**
	 * Function to add menu
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 1.0.0
	 */
	function wpls_register_menu() {

		// How it work page
		add_submenu_page( 'edit.php?post_type='.WPLS_POST_TYPE, __('How it works, our plugins and offers', 'wp-logo-showcase-responsive-slider-slider'), __('How It Works', 'wp-logo-showcase-responsive-slider-slider'), 'manage_options', 'wpls-designs', array($this, 'wpls_designs_page') );

		// Setting page
		add_submenu_page( 'edit.php?post_type='.WPLS_POST_TYPE, __('Solutions & Features - Logo Showcase Responsive Slider', 'wp-logo-showcase-responsive-slider-slider'), '<span style="color:#2ECC71">'. __('Solutions & Features', 'wp-logo-showcase-responsive-slider-slider').'</span>', 'manage_options', 'wpls-solutions-features', array($this, 'wpls_solutions_features_page') );

		// Register plugin premium page
		add_submenu_page( 'edit.php?post_type='.WPLS_POST_TYPE, __('Upgrade To PRO - Logo Showcase Responsive Slider', 'wp-logo-showcase-responsive-slider-slider'), '<span style="color:#ff2700">'.__('Upgrade To PRO', 'wp-logo-showcase-responsive-slider-slider').'</span>', 'manage_options', 'wpls-premium', array($this, 'wpls_premium_page') );
		//add_submenu_page( 'edit.php?post_type='.WPLS_POST_TYPE, __('Upgrade To PRO - Logo Showcase Responsive Slider', 'wp-logo-showcase-responsive-slider-slider'), '<span class="wpos-upgrade-pro" style="color:#ff2700">' . __('Upgrade To Premium ', 'wp-logo-showcase-responsive-slider-slider') . '</span>', 'manage_options', 'wpls-upgrade-pro', array($this, 'wpls_redirect_page') );
		add_submenu_page( 'edit.php?post_type='.WPLS_POST_TYPE, __('Bundle Deal - Logo Showcase Responsive Slider', 'wp-logo-showcase-responsive-slider-slider'), '<span class="wpos-upgrade-pro" style="color:#ff2700">' . __('Bundle Deal', 'wp-logo-showcase-responsive-slider-slider') . '</span>', 'manage_options', 'wpls-bundle-deal', array($this, 'wpls_redirect_page') );
	}

	/**
	 * Getting Started Page Html
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 1.0.0
	 */
	function wpls_premium_page() {
		include_once( WPLS_DIR . '/includes/admin/settings/premium.php' );
	}

	/**
	 * Solutions & Features Page Html
	 * 
	 * @package Popup Anything on Click
	 * @since 2.0.11
	 */
	function wpls_solutions_features_page() {
		include_once( WPLS_DIR . '/includes/admin/settings/solutions-features.php' );
	}

	/**
	 * How It Work Page Html
	 * 
	 * @since 1.0
	 */
	function wpls_redirect_page() {
	}

	/**
	 * How It Work Page Html
	 * 
	 * @since 1.0
	 */
	function wpls_designs_page() {
		include_once( WPLS_DIR . '/includes/admin/settings/how-it-work.php' );
	}

	/**
	 * Add custom column to Logo listing page
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 1.0.0
	 */
	function wplss_logoshowcase_cat_columns($ouput, $column_name, $tax_id) {
		if( $column_name == 'wpls_logo_shortcode' ) {
			$ouput .= '[logoshowcase cat_id="' . $tax_id. '"]';
		}
		return $ouput;
	}

	/**
	 * Add custom column data to Logo listing page
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 1.0.0
	 */
	function wplss_logoshowcase_cat_manage_columns($columns) {
		$new_columns['wpls_logo_shortcode'] = __( 'Category Shortcode', 'wp-logo-showcase-responsive-slider-slider' );
		$columns = wpls_logo_add_array( $columns, $new_columns, 2 );
		return $columns;
	}

	/**
	 * Add JS snippet to admin footer to add target _blank in upgrade link
	 * 
	 * @package WP Logo Showcase Responsive Slider
	 * @since 1.0.0
	 */
	function wpls_upgrade_page_link_blank() {

		global $wpos_upgrade_link_snippet;

		// Redirect to external page
		if( empty( $wpos_upgrade_link_snippet ) ) {

			$wpos_upgrade_link_snippet = 1;
	?>
		<script type="text/javascript">
			(function ($) {
				$('.wpos-upgrade-pro').parent().attr( { target: '_blank', rel: 'noopener noreferrer' } );
			})(jQuery);
		</script>
	<?php }
	}
}

$wpls_Admin = new Wpls_Admin();