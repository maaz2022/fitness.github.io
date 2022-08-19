<?php

namespace MasterAddons\Admin\Dashboard\Addons\Extensions;

if (!class_exists('JLTMA_Third_Party_Extensions')) {
    class JLTMA_Third_Party_Extensions
    {
        private static $instance = null;
        public static $jltma_third_party_plugins;

        public function __construct()
        {
            self::$jltma_third_party_plugins = [
                'jltma-plugins'         => [
                    'title'                => esc_html__('Extensions', 'master-addons' ),
                    'plugin'             => [
                        [
                            'key'           => 'custom-breakpoints',
                            'class'         => 'MasterCustomBreakPoint\JLTMA_Master_Custom_Breakpoint',
                            'title'         => esc_html__('Custom Breakpoints', 'master-addons' ),
                            'wp_slug'       => 'custom-breakpoints-for-elementor',
                            'download_url'  => '',
                            'plugin_file'   => 'custom-breakpoints-for-elementor/custom-breakpoints-for-elementor.php'
                        ],
                        [
                            'key'           => 'adminify',
                            'class'         => 'WPAdminify\WP_Adminify',
                            'title'         => esc_html__('WP Adminify', 'master-addons' ),
                            'wp_slug'       => 'adminify',
                            'download_url'  => '',
                            'plugin_file'   => 'adminify/adminify.php'
                        ]
                    ]
                ]
            ];
        }

        public static function get_instance()
        {
            if (!self::$instance) {
                self::$instance = new self;
            }
            return self::$instance;
        }
    }
    JLTMA_Third_Party_Extensions::get_instance();
}
