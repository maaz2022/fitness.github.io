<?php

namespace MasterAddons\Admin\Dashboard;

use MasterAddons\Master_Elementor_Addons;

use MasterAddons\Admin\Dashboard\Addons\Elements\JLTMA_Addon_Elements;
use MasterAddons\Admin\Dashboard\Addons\Elements\JLTMA_Addon_Forms;
use MasterAddons\Admin\Dashboard\Addons\Elements\JLTMA_Addon_Marketing;
use MasterAddons\Admin\Dashboard\Addons\Elements\JLTMA_Icons_Library;
use MasterAddons\Admin\Dashboard\Addons\Extensions\JLTMA_Addon_Extensions;
use MasterAddons\Admin\Dashboard\Addons\Extensions\JLTMA_Third_Party_Extensions;
use MasterAddons\Inc\Classes\Master_Addons_White_Label;
/*
	* Master Admin Dashboard Page
	* Jewel Theme < Liton Arefin >
	*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit();
}

class Master_Addons_Admin_Settings
{

	public $menu_title;

	// Master Addons Elements Property
	private $jltma_default_element_settings;
	private $maad_el_settings;
	private $jltma_get_element_settings;

	// Master Addons Elements Property
	private $jltma_default_extension_settings;
	private $maad_el_extension_settings;
	private $jltma_get_extension_settings;
	private $jltma_get_icons_library_settings;

	// Master Addons Third Party Plugins Property
	private $jltma_default_third_party_plugins_settings;
	private $jltma_third_party_plugins_settings;
	private $jltma_get_third_party_plugins_settings;


	public function __construct()
	{
		add_action('admin_menu', [$this, 'master_addons_admin_menu'],  '', 10);
		add_action('network_admin_menu', [$this, 'master_addons_admin_menu'],  '', 10);
		add_action('admin_enqueue_scripts', [$this, 'master_addons_el_admin_scripts'], 99);
		add_action('admin_head', [$this, 'jltma_admin_head_script']);
		add_action('admin_body_class', [$this, 'jltma_admin_body_class']);


		// Master Addons Elements
		add_action('wp_ajax_jltma_save_elements_settings', [$this, 'jltma_save_elements_settings']);

		// Master Addons Extensions
		add_action('wp_ajax_master_addons_save_extensions_settings', [$this, 'master_addons_save_extensions_settings']);

		// Master Addons Icons Library
		add_action('wp_ajax_jltma_save_icons_library_settings', [$this, 'jltma_save_icons_library_settings']);

		// Master Addons API Settings
		add_action('wp_ajax_jltma_save_api_settings', [$this, 'jltma_save_api_settings']);


		$this->ma_el_include_files();
	}


	/**
	 * Admin Body Class
	 */
	public function jltma_admin_body_class($class)
	{
		$bodyclass = '';
		$bodyclass .= ' jltma-admin ';
		return $class . $bodyclass;
	}

	public function ma_el_include_files()
	{
		include_once JLTMA_PATH . '/inc/admin/promotions.php';

		include_once JLTMA_PATH . '/inc/admin/jltma-elements/ma-forms.php';
		include_once JLTMA_PATH . '/inc/admin/jltma-elements/ma-elements.php';
		include_once JLTMA_PATH . '/inc/admin/jltma-elements/ma-extensions.php';
		include_once JLTMA_PATH . '/inc/admin/jltma-elements/ma-icons-library.php';
		include_once JLTMA_PATH . '/inc/admin/jltma-elements/ma-marketing.php';
		include_once JLTMA_PATH . '/inc/admin/jltma-elements/ma-third-party-plugins.php';
	}

	public function get_menu_title()
	{
		return ($this->menu_title) ? $this->menu_title : $this->get_page_title();
	}

	protected function get_page_title()
	{
		return __('Master Addons', 'master-addons' );
	}

	// Main Menu
	public function master_addons_admin_menu()
	{
		$jltma_white_label_setting = jltma_get_options('jltma_white_label_settings');
		if ( empty($jltma_white_label_setting) ) {
			$jltma_white_label_setting = Master_Addons_White_Label::jltma_white_label_default_options();
		}
		$image_id = jltma_check_options($jltma_white_label_setting['jltma_wl_plugin_logo']);

		if ($image = wp_get_attachment_image_src($image_id)) {
			$jltma_logo_image = $image[0];
		} else {
			$jltma_logo_image = JLTMA_IMAGE_DIR . 'icon.png';
		}
		$page_title = (isset($jltma_white_label_setting['jltma_wl_plugin_menu_label']) && $jltma_white_label_setting['jltma_wl_plugin_menu_label']) ? $jltma_white_label_setting['jltma_wl_plugin_menu_label'] : __('Master Addons for Elementor', 'master-addons' );
		$menut_label = (isset($jltma_white_label_setting['jltma_wl_plugin_menu_label']) && $jltma_white_label_setting['jltma_wl_plugin_menu_label']) ? $jltma_white_label_setting['jltma_wl_plugin_menu_label'] : __('Master Addons', 'master-addons' );
		add_menu_page(
			$page_title, // Page Title
			$menut_label,    // Menu Title
			'manage_options',
			'master-addons-settings',
			[$this, 'jltma_admin_settings_page_content'],
			$jltma_logo_image,
			57
		);
	}

	public function jltma_admin_head_script()
	{
		$jltma_white_label_setting = jltma_get_options('jltma_white_label_settings');
		if ( empty($jltma_white_label_setting) ) {
			$jltma_white_label_setting = Master_Addons_White_Label::jltma_white_label_default_options();
		}
		$image_id = jltma_check_options($jltma_white_label_setting['jltma_wl_plugin_logo']);
		if ($image = wp_get_attachment_image_src($image_id)) {
			$jltma_logo_image = $image[0];
		} else {
			$jltma_logo_image = JLTMA_IMAGE_DIR . 'icon.png';
		}
		if ($image_id) { ?>
			<style>
				.svg .wp-badge.welcome__logo {
					background: url('<?php echo esc_url($jltma_logo_image); ?>') left center no-repeat;
				}

				#adminmenu li.wp-has-current-submenu .wp-menu-image img {
					width: 16px;
					height: 25px;
				}

				.master_addons .header .ma_el_logo .wp-badge {
					width: none;
				}

				#adminmenu .wp-menu-image img {
					width: 20px;
				}
			</style>
<?php }
	}


	public function master_addons_el_admin_scripts($hook)
	{
		$screen = get_current_screen();

		// Load Scripts only Master Addons Admin Page
		if ($screen->id == 'toplevel_page_master-addons-settings' || $screen->id == 'toplevel_page_master-addons-settings-network') {

			//CSS
			wp_enqueue_style('master-addons-el-admin', JLTMA_ADMIN_ASSETS . 'css/master-addons-admin.css');
			wp_enqueue_style('sweetalert', JLTMA_ADMIN_ASSETS . 'css/sweetalert2.min.css');
			wp_enqueue_style('master-addons-el-switch', JLTMA_ADMIN_ASSETS . 'css/switch.css');

			//JS
			if (!did_action('wp_enqueue_media')) {
				wp_enqueue_media();
			}
			wp_enqueue_script('master-addons-el-welcome-tabs', JLTMA_ADMIN_ASSETS . 'js/welcome-tabs.js', ['jquery'], JLTMA_VER, true);
			wp_enqueue_script('sweetalert', JLTMA_ADMIN_ASSETS . 'js/sweetalert2.min.js', ['jquery', 'master-addons-el-admin'], JLTMA_VER, true);
			wp_enqueue_script('master-addons-el-admin', JLTMA_ADMIN_ASSETS . 'js/master-addons-admin.js', ['jquery'], JLTMA_VER, true);


			$jltma_localize_admin_script = array(
				'ajaxurl'                  => admin_url('admin-ajax.php'),
				'ajax_nonce'               => wp_create_nonce('jltma_options_settings_nonce_action'),
				'ajax_extensions_nonce'    => wp_create_nonce('jltma_extensions_settings_nonce_action'),
				'ajax_api_nonce'           => wp_create_nonce('jltma_api_settings_nonce_action'),
				'ajax_icons_library_nonce' => wp_create_nonce('jltma_icons_library_settings_nonce_action'),

				'home_url' => home_url(),
				'rollback' => [
					'rollback_confirm'             => __('Are you sure you want to reinstall version ?', 'master-addons' ),
					'rollback_to_previous_version' => __('Rollback to Previous Version', 'master-addons' ),
					'yes'                          => __('Yes', 'master-addons' ),
					'cancel'                       => __('Cancel', 'master-addons' ),
				]
			);

			wp_localize_script('master-addons-el-admin', 'jltma_options_settings', $jltma_localize_admin_script);
		}

		// Localize Script
		if (is_customize_preview()) {
			return;
		}

		// Admin Notice Dismiss
		wp_enqueue_script('jltma-dismiss-notice', JLTMA_ADMIN_ASSETS . 'js/dismiss-notice.js', ['jquery', 'common'], JLTMA_VER, true);
		wp_localize_script('jltma-dismiss-notice', 'dismissible_notice', array('notice_nonce' => wp_create_nonce('jltma-admin-notice-nonce')));
	}


	public function jltma_admin_settings_page_content()
	{
		// Master Addons Elements Settings
		$this->jltma_default_element_settings = array_fill_keys(self::jltma_addons_array(), true);
		$this->jltma_get_element_settings     = get_option('maad_el_save_settings', $this->jltma_default_element_settings);

		// Master Addons Extensions Settings
		$this->jltma_default_extension_settings = array_fill_keys(self::jltma_addons_extensions_array(), true);
		$this->jltma_get_extension_settings     = get_option('ma_el_extensions_save_settings', $this->jltma_default_extension_settings);

		// Master Addons Third Party Plugins Settings
		$this->jltma_default_third_party_plugins_settings = array_fill_keys(self::jltma_addons_third_party_plugins_array(), true);
		$this->jltma_get_third_party_plugins_settings     = get_option('ma_el_third_party_plugins_save_settings', $this->jltma_default_third_party_plugins_settings);

		// Master Addons Icons Library Settings
		$this->jltma_default_icons_library_settings = array_fill_keys(self::jltma_addons_icons_library_array(), true);
		$this->jltma_get_icons_library_settings     = get_option('jltma_icons_library_save_settings', $this->jltma_default_icons_library_settings);

		// Welcome Page
		include JLTMA_PATH . '/inc/admin/welcome.php';
	}



	public static function jltma_addons_array()
	{
		// Separated Addons on new Format
		$jltma_new_widgets = [];

		foreach (JLTMA_Addon_Elements::$jltma_elements['jltma-addons']['elements'] as $key => $widget) {
			$jltma_new_widgets[] = $widget['key'];
		}
		foreach (JLTMA_Addon_Forms::$jltma_forms['jltma-forms']['elements'] as $key => $widget) {
			$jltma_new_widgets[] = $widget['key'];
		}
		foreach (JLTMA_Addon_Marketing::$jltma_marketing['jltma-marketing']['elements'] as $key => $widget) {
			$jltma_new_widgets[] = $widget['key'];
		}

		return $jltma_new_widgets;
	}


	// Merged All Addon Elements
	public static function jltma_merged_addons_array()
	{
		// Separated All Addons on new Format
		// $jltma_new_merged_widgets = [];
		$jltma_new_merged_widgets1 = JLTMA_Addon_Elements::$jltma_elements['jltma-addons']['elements'];
		$jltma_new_merged_widgets2 = JLTMA_Addon_Forms::$jltma_forms['jltma-forms']['elements'];
		$jltma_new_merged_widgets3 = JLTMA_Addon_Marketing::$jltma_marketing['jltma-marketing']['elements'];

		$jltma_merged_addons = array_merge($jltma_new_merged_widgets1, $jltma_new_merged_widgets2, $jltma_new_merged_widgets3);

		return $jltma_merged_addons;
	}


	// Extensions Array
	public static function jltma_addons_extensions_array()
	{
		// Separated Addons on new Format
		$jltma_new_extensions = [];

		foreach (JLTMA_Addon_Extensions::$jltma_extensions['jltma-extensions']['extension'] as $key => $extension) {
			$jltma_new_extensions[] = $extension['key'];
		}

		return $jltma_new_extensions;
	}


	// Third Party Plugins Array
	public static function jltma_addons_third_party_plugins_array()
	{
		// Separated Addons on new Format
		$jltma_new_third_party_plugins = [];

		foreach (JLTMA_Third_Party_Extensions::$jltma_third_party_plugins['jltma-plugins']['plugin'] as $key => $plugin) {
			$jltma_new_third_party_plugins[] = $plugin['key'];
		}
		return $jltma_new_third_party_plugins;
	}


	// Icons Library Array
	public static function jltma_addons_icons_library_array()
	{
		// Separated Addons on new Format
		$jltma_new_icons_library = [];

		foreach (JLTMA_Icons_Library::$jltma_icons_library['jltma-icons-library']['libraries'] as $key => $icons_library) {
			$jltma_new_icons_library[] = $icons_library['key'];
		}
		return $jltma_new_icons_library;
	}


	public function jltma_save_elements_settings()
	{
		check_ajax_referer('jltma_options_settings_nonce_action', 'security');

		if (isset($_POST['fields'])) {
			parse_str($_POST['fields'], $settings);
		} else {
			return;
		}

		$this->maad_el_settings = [];

		foreach (self::jltma_addons_array() as $value) {

			if (isset($settings[$value])) {
				$this->maad_el_settings[$value] = 1;
			} else {
				$this->maad_el_settings[$value] = 0;
			}
		}

		update_option('maad_el_save_settings', $this->maad_el_settings);

		return true;
		die();
	}


	public function master_addons_save_extensions_settings()
	{

		check_ajax_referer('jltma_extensions_settings_nonce_action', 'security');

		if (isset($_POST['fields'])) {
			parse_str($_POST['fields'], $settings);
		} else {
			return;
		}

		$this->maad_el_extension_settings = [];

		foreach (self::jltma_addons_extensions_array() as $value) {

			if (isset($settings[$value])) {
				$this->maad_el_extension_settings[$value] = 1;
			} else {
				$this->maad_el_extension_settings[$value] = 0;
			}
		}
		update_option('ma_el_extensions_save_settings', $this->maad_el_extension_settings);


		// Third Party Plugin Settings
		$this->jltma_third_party_plugins_settings = [];

		// New Format for Third Party Extensions
		$jltma_new_third_party_extensions = [];
		foreach (JLTMA_Third_Party_Extensions::$jltma_third_party_plugins['jltma-plugins']['plugin'] as $key => $plugin) {
			$jltma_new_third_party_extensions[] = $plugin['key'];
		}
		$jltma_new_third_party_extensions;

		foreach ($jltma_new_third_party_extensions as $value) {

			if (isset($settings[$value])) {
				$this->jltma_third_party_plugins_settings[$value] = 1;
			} else {
				$this->jltma_third_party_plugins_settings[$value] = 0;
			}
		}
		update_option('ma_el_third_party_plugins_save_settings', $this->jltma_third_party_plugins_settings);


		return true;
		die();
	}


	// API Settings Ajax Call
	public function jltma_save_api_settings()
	{

		check_ajax_referer('jltma_api_settings_nonce_action', 'security');

		$jltma_api_settings = [];
		if( isset($_POST['fields']) ){
			foreach ($_POST['fields'] as $value) {
				$jltma_api_settings[ sanitize_key($value['name']) ] = sanitize_text_field($value['value']);
			}
		}

		update_option('jltma_api_save_settings', $jltma_api_settings);

		return true;
		die();
	}


	// Icons Library Settings Ajax Call
	public function jltma_save_icons_library_settings()
	{
		check_ajax_referer('jltma_icons_library_settings_nonce_action', 'security');

		if (isset($_POST['fields'])) {
			parse_str($_POST['fields'], $settings);
		} else {
			return;
		}

		$this->jltma_icons_library_settings = [];

		foreach (self::jltma_addons_icons_library_array() as $value) {

			if (isset($settings[$value])) {
				$this->jltma_icons_library_settings[ sanitize_key($value) ] = 1;
			} else {
				$this->jltma_icons_library_settings[ sanitize_key($value) ] = 0;
			}
		}

		update_option('jltma_icons_library_save_settings', $this->jltma_icons_library_settings);

		return true;
		die();
	}
}

new Master_Addons_Admin_Settings();
