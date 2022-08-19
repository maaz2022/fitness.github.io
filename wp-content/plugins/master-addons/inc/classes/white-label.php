<?php

namespace MasterAddons\Inc\Classes;

use MasterAddons\Master_Elementor_Addons;

class Master_Addons_White_Label
{
    private static $instance = null;

    public function __construct()
    {
        $settings = self::get_settings();
        // Master Addons White Label Settings
        add_action('wp_ajax_jltma_save_white_label_settings', [$this, 'jltma_save_white_label_settings']);

        add_action('all_plugins', [$this, 'jltma_save_white_label_settings_update']);

        add_filter('plugin_row_meta', [$this, 'jltma_plugin_row_meta'], 900, 2);
        // register_activation_hook(__FILE__, [__CLASS__, 'jltma_white_label_activation_hook']);

        // Placeholder image replacement
        if($settings['jltma_wl_placeholder_image'] != 1 ){
            add_filter('elementor/utils/get_placeholder_image_src', [$this, 'jltma_replace_placeholder_image'], 900);
        }

    }

    public function jltma_replace_placeholder_image()
    {
        return JLTMA_IMAGE_DIR . 'placeholder.png';
    }

    public function jltma_white_label_activation_hook()
    {
        $settings = self::get_settings();
        update_option($settings['jltma_wl_plugin_tab_welcome'], 0);
        update_option($settings['jltma_wl_plugin_tab_addons'], 0);
        update_option($settings['jltma_wl_plugin_tab_extensions'], 0);
        update_option($settings['jltma_wl_plugin_tab_icons_library'], 0);
        update_option($settings['jltma_wl_plugin_tab_api'], 0);
        update_option($settings['jltma_wl_plugin_tab_white_label'], 0);
        update_option($settings['jltma_wl_plugin_tab_version'], 0);
        update_option($settings['jltma_wl_plugin_tab_version'], 0);
        update_option($settings['jltma_wl_plugin_tab_changelogs'], 0);
        update_option($settings['jltma_wl_plugin_tab_system_info'], 0);
    }

    public function jltma_plugin_row_meta($plugin_meta, $plugin_file)
    {
        $settings = self::get_settings();
        if ($settings['jltma_wl_plugin_row_links'] !== "1") {
            return $plugin_meta;
        }
    }


    public function jltma_save_white_label_settings_update($all_plugins)
    {
        $settings = self::get_settings();

        if (!empty($all_plugins[JLTMA_BASE]) && is_array($all_plugins[JLTMA_BASE])) {
            $all_plugins[JLTMA_BASE]['Name']           = !empty($settings['jltma_wl_plugin_name']) ? $settings['jltma_wl_plugin_name'] : $all_plugins[JLTMA_BASE]['Name'];
            $all_plugins[JLTMA_BASE]['PluginURI']      = !empty($settings['jltma_wl_plugin_url']) ? $settings['jltma_wl_plugin_url'] : $all_plugins[JLTMA_BASE]['PluginURI'];
            $all_plugins[JLTMA_BASE]['Description']    = !empty($settings['jltma_wl_plugin_desc']) ? $settings['jltma_wl_plugin_desc'] : $all_plugins[JLTMA_BASE]['Description'];
            $all_plugins[JLTMA_BASE]['Author']         = !empty($settings['jltma_wl_plugin_author_name']) ? $settings['jltma_wl_plugin_author_name'] : $all_plugins[JLTMA_BASE]['Author'];
            $all_plugins[JLTMA_BASE]['AuthorURI']      = !empty($settings['jltma_wl_plugin_url']) ? $settings['jltma_wl_plugin_url'] : $all_plugins[JLTMA_BASE]['AuthorURI'];
            $all_plugins[JLTMA_BASE]['Title']          = !empty($settings['jltma_wl_plugin_name']) ? $settings['jltma_wl_plugin_name'] : $all_plugins[JLTMA_BASE]['Title'];
            $all_plugins[JLTMA_BASE]['AuthorName']     = !empty($settings['jltma_wl_plugin_author_name']) ? $settings['jltma_wl_plugin_author_name'] : $all_plugins[JLTMA_BASE]['AuthorName'];

            return $all_plugins;
        }
    }

    // White Label Settings Ajax Call
    public function jltma_save_white_label_settings()
    {

        check_ajax_referer('jltma_options_settings_nonce_action', 'security');

        if (isset($_POST['fields'])) {
            parse_str($_POST['fields'], $settings);
        } else {
            return;
        }

        $jltma_white_label_options = array(
            'jltma_wl_plugin_logo'              => sanitize_text_field($settings['jltma_wl_plugin_logo']),
            'jltma_wl_plugin_name'              => sanitize_text_field($settings['jltma_wl_plugin_name']),
            'jltma_wl_plugin_desc'              => sanitize_text_field($settings['jltma_wl_plugin_desc']),
            'jltma_wl_plugin_author_name'       => sanitize_text_field($settings['jltma_wl_plugin_author_name']),
            'jltma_wl_plugin_menu_label'        => sanitize_text_field($settings['jltma_wl_plugin_menu_label']),
            'jltma_wl_plugin_url'               => sanitize_text_field($settings['jltma_wl_plugin_url']),
            'jltma_wl_plugin_row_links'         => empty($settings['jltma_wl_plugin_row_links']) ? 0 : 1,
            'jltma_wl_placeholder_image'        => empty($settings['jltma_wl_placeholder_image']) ? 0 : 1,
            'jltma_wl_plugin_tab_welcome'       => empty($settings['jltma_wl_plugin_tab_welcome']) ? 0 : 1,
            'jltma_wl_plugin_tab_addons'        => empty($settings['jltma_wl_plugin_tab_addons']) ? 0 : 1,
            'jltma_wl_plugin_tab_extensions'    => empty($settings['jltma_wl_plugin_tab_extensions']) ? 0 : 1,
            'jltma_wl_plugin_tab_icons_library' => empty($settings['jltma_wl_plugin_tab_icons_library']) ? 0 : 1,
            'jltma_wl_plugin_tab_api'           => empty($settings['jltma_wl_plugin_tab_api']) ? 0 : 1,
            'jltma_wl_plugin_tab_white_label'   => empty($settings['jltma_wl_plugin_tab_white_label']) ? 0 : 1,
            'jltma_wl_plugin_tab_version'       => empty($settings['jltma_wl_plugin_tab_version']) ? 0 : 1,
            'jltma_wl_plugin_tab_changelogs'    => empty($settings['jltma_wl_plugin_tab_changelogs']) ? 0 : 1,
            'jltma_wl_plugin_tab_system_info'   => empty($settings['jltma_wl_plugin_tab_system_info']) ? 0 : 1
        );

        update_option('jltma_white_label_settings', $jltma_white_label_options);

        return true;
        die();
    }

    public static function jltma_white_label_default_options()
    {
        $jltma_white_label_defaul_options = array(
            'jltma_wl_plugin_logo'              => '',
            'jltma_wl_plugin_name'              => JLTMA,
            'jltma_wl_plugin_desc'              => JLTMA_PLUGIN_DESC,
            'jltma_wl_plugin_author_name'       => JLTMA_PLUGIN_AUTHOR,
            'jltma_wl_plugin_menu_label'        => __('Master Addons', 'master-addons' ),
            'jltma_wl_plugin_url'               => JLTMA_PLUGIN_URI,
            'jltma_wl_plugin_row_links'         => 0,
            'jltma_wl_placeholder_image'        => 0,
            'jltma_wl_plugin_tab_welcome'       => 0,
            'jltma_wl_plugin_tab_addons'        => 0,
            'jltma_wl_plugin_tab_extensions'    => 0,
            'jltma_wl_plugin_tab_icons_library' => 0,
            'jltma_wl_plugin_tab_api'           => 0,
            'jltma_wl_plugin_tab_white_label'   => 0,
            'jltma_wl_plugin_tab_version'       => 0,
            'jltma_wl_plugin_tab_changelogs'    => 0,
            'jltma_wl_plugin_tab_system_info'   => 0
        );
        return $jltma_white_label_defaul_options;
    }

    public static function get_settings()
    {
        $default_settings = array(
            'jltma_wl_plugin_logo'              => '',
            'jltma_wl_plugin_name'              => '',
            'jltma_wl_plugin_desc'              => '',
            'jltma_wl_plugin_author_name'       => '',
            'jltma_wl_plugin_url'               => '',
            'jltma_wl_plugin_menu_label'        => __('Master Addons', 'master-addons' ),
            'jltma_wl_plugin_row_links'         => '',
            'jltma_wl_placeholder_image'        => '',
            'jltma_wl_plugin_tab_welcome'       => '',
            'jltma_wl_plugin_tab_addons'        => '',
            'jltma_wl_plugin_tab_extensions'    => '',
            'jltma_wl_plugin_tab_icons_library' => '',
            'jltma_wl_plugin_tab_api'           => '',
            'jltma_wl_plugin_tab_white_label'   => '',
            'jltma_wl_plugin_tab_version'       => '',
            'jltma_wl_plugin_tab_changelogs'    => '',
            'jltma_wl_plugin_tab_system_info'   => ''
        );

        $settings = jltma_get_options('jltma_white_label_settings', true);

        if (!is_array($settings) || empty($settings)) {
            return $default_settings;
        }

        if (is_array($settings) && !empty($settings)) {
            return array_merge($default_settings, $settings);
        }
    }


    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}

Master_Addons_White_Label::get_instance();
