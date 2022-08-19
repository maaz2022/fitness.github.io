<?php

namespace MasterAddons\Admin\Dashboard\Addons\Elements;

if (!class_exists('JLTMA_Icons_Library')) {
    class JLTMA_Icons_Library
    {
        private static $instance = null;
        public static $jltma_icons_library;

        public function __construct()
        {
            self::$jltma_icons_library = [
                'jltma-icons-library'      => [
                    'title'             => esc_html__('Icons Library', 'master-addons' ),
                    'libraries'          => [
                        [
                            'key'      => 'simple-line-icons',
                            'title'    => esc_html__('Simple Line Icons', 'master-addons' ),
                            'demo_url' => '',
                            'docs_url' => '',
                            'tuts_url' => '',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'elementor-icon',
                            'title'    => esc_html__('Elementor Icons', 'master-addons' ),
                            'demo_url' => '',
                            'docs_url' => '',
                            'tuts_url' => '',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'iconic-fonts',
                            'title'    => esc_html__('Ionic Font', 'master-addons' ),
                            'class'    => '',
                            'demo_url' => '',
                            'docs_url' => '',
                            'tuts_url' => '',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'linear-icons',
                            'title'    => esc_html__('Linear Icons', 'master-addons' ),
                            'class'    => '',
                            'demo_url' => '',
                            'docs_url' => '',
                            'tuts_url' => '',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'material-icons',
                            'title'    => esc_html__('Material Icons', 'master-addons' ),
                            'class'    => '',
                            'demo_url' => '',
                            'docs_url' => '',
                            'tuts_url' => '',
                            'is_pro'   => false
                        ],


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
    JLTMA_Icons_Library::get_instance();
}
