<?php

namespace MasterAddons\Admin\Dashboard\Addons\Extensions;

if (!class_exists('JLTMA_Addon_Extensions')) {
    class JLTMA_Addon_Extensions
    {
        private static $instance = null;
        public static $jltma_extensions;

        public function __construct()
        {
            self::$jltma_extensions = [
                'jltma-extensions'         => [
                    'title'     => esc_html__('Extensions', 'master-addons' ),
                    'extension' => [
                        [
                            'key'      => 'particles',
                            'title'    => esc_html__('Particles', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Particles',
                            'demo_url' => 'https://master-addons.com/demos/particles-background/',
                            'docs_url' => 'https://master-addons.com/docs/addons/particles-extension/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=sNC0pik_g3Q',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'animated-gradient',
                            'title'    => esc_html__('Animated Gradient BG', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Animated_Gradient_Backgrounds',
                            'demo_url' => 'https://master-addons.com/demos/gradient-background/',
                            'docs_url' => 'https://master-addons.com/docs/addons/animated-gradient-background-extension/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=jANMWGDaeG0',
                            'is_pro'   => true
                        ],
                        [
                            'key'      => 'reading-progress-bar',
                            'title'    => esc_html__('Reading Progress Bar', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Reading_Progress_Bar',
                            'demo_url' => 'https://master-addons.com/100-best-elementor-addons/',
                            'docs_url' => '',
                            'tuts_url' => '',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'bg-slider',
                            'title'    => esc_html__('Background Slider', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Background_Slider',
                            'demo_url' => 'https://master-addons.com/demos/background-slider/',
                            'docs_url' => 'https://master-addons.com/docs/addons/background-slider-extension/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=Z6ujz7Hunjg',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'custom-css',
                            'title'    => esc_html__('Custom CSS', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Custom_CSS',
                            'demo_url' => 'https://master-addons.com/docs/addons/custom-css-extension/',
                            'docs_url' => 'https://master-addons.com/docs/addons/custom-css-extension/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=ajXVVGJZuuM',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'custom-js',
                            'title'    => esc_html__('Custom JS', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Custom_JS',
                            'demo_url' => 'https://master-addons.com/docs/addons/custom-js-extension/',
                            'docs_url' => 'https://master-addons.com/docs/addons/custom-js-extension/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=8G4JLw0s8sI',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'positioning',
                            'title'    => esc_html__('Positioning', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Positioning',
                            'demo_url' => 'https://master-addons.com/demos/positioning/',
                            'docs_url' => 'https://master-addons.com/docs/addons/positioning-extension/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=sXPZv3zVlmY',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'extras',
                            'title'    => esc_html__('Container Extras', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Container_Extras',
                            'demo_url' => '',
                            'docs_url' => '',
                            'tuts_url' => '',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'mega-menu',
                            'title'    => esc_html__('Mega Menu', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\MegaMenu\Master_Menu',
                            'demo_url' => 'https://master-addons.com/elementor-mega-menu/',
                            'docs_url' => 'https://master-addons.com/docs/addons/navigation-menu/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=HIf0ud-5Wpo',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'transition',
                            'title'    => esc_html__('Entrance Animation', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Entrance_Animation',
                            'demo_url' => 'https://master-addons.com/demos/entrance-animation/',
                            'docs_url' => 'https://master-addons.com/docs/addons/entrance-animation/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=kphJEszEAFQ',
                            'is_pro'   => true
                        ],
                        [
                            'key'      => 'transforms',
                            'title'    => esc_html__('Transforms', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Transform_Extension',
                            'demo_url' => 'https://master-addons.com/demos/transforms-extension/',
                            'docs_url' => 'https://master-addons.com/docs/addons/transforms-extension/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=sH2BQT0xOnY',
                            'is_pro'   => true
                        ],
                        [
                            'key'      => 'rellax',
                            'title'    => esc_html__('Rellax', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Rellax',
                            'demo_url' => 'https://master-addons.com/demos/rellax/',
                            'docs_url' => 'https://master-addons.com/docs/addons/rellax-extension/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=xYvMVXoZ_NE',
                            'is_pro'   => true
                        ],
                        [
                            'key'      => 'reveal',
                            'title'    => esc_html__('Reveal', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Reveal',
                            'demo_url' => 'https://master-addons.com/demos/reveal/',
                            'docs_url' => 'https://master-addons.com/docs/addons/reveal-extension/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=xEG1fi_lY1M',
                            'is_pro'   => true
                        ],
                        [
                            'key'      => 'header-footer-comment',
                            'title'    => esc_html__('Header,Footer,Comment Form', 'master-addons' ),
                            'class'    => 'MasterHeaderFooter\Master_Header_Footer',
                            'demo_url' => 'https://master-addons.com/demos/header-footer-comment-builder/',
                            'docs_url' => 'https://master-addons.com/docs/addons/header-footer-comment-builder/',
                            'tuts_url' => '',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'display-conditions',
                            'title'    => esc_html__('Display Conditions', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Display_Conditions',
                            'demo_url' => 'https://master-addons.com/demos/display-conditions/',
                            'docs_url' => 'https://master-addons.com/docs/addons/display-conditions/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=6hDqKVQmsr8',
                            'is_pro'   => true
                        ],
                        [
                            'key'      => 'dynamic-tags',
                            'title'    => esc_html__('Dynamic Tags', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\DynamicTags\JLTMA_Extension_Dynamic_Tags',
                            'demo_url' => 'https://master-addons.com/demos/dynamic-tags/',
                            'docs_url' => 'https://master-addons.com/docs/addons/dynamic-tags/',
                            'tuts_url' => 'https://youtu.be/vvhhMq8uz1g',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'floating-effects',
                            'title'    => esc_html__('Floating Effects', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Floating_Effects',
                            'demo_url' => 'https://master-addons.com/demos/floating-effect/',
                            'docs_url' => 'https://master-addons.com/floating-effect-elementor/',
                            'tuts_url' => '',
                            'is_pro'   => true
                        ],
                        [
                            'key'      => 'wrapper-link',
                            'title'    => esc_html__('Wrapper Link', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Wrapper_Link',
                            'demo_url' => '',
                            'docs_url' => 'https://master-addons.com/docs/addons/wrapper-link/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=fsbK4G9T-qM',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'duplicator',
                            'title'    => esc_html__('Post/Page Duplicator', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Post_Page_Duplicator',
                            'demo_url' => '',
                            'docs_url' => '',
                            'tuts_url' => '',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'glassmorphism',
                            'title'    => esc_html__('Glassmorphism', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Glassmorphism',
                            'demo_url' => '',
                            'docs_url' => '',
                            'tuts_url' => '',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'icons-extended',
                            'title'    => esc_html__('Icons Extended', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Icons_Extended',
                            'demo_url' => 'https://master-addons.com/elementor-icons-and-4-font-library/',
                            'docs_url' => 'https://master-addons.com/elementor-icons-and-4-font-library/',
                            'tuts_url' => 'https://master-addons.com/elementor-icons-and-4-font-library/',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'tooltips',
                            'title'    => esc_html__('Tooltips', 'master-addons' ),
                            'class'    => 'MasterAddons\Modules\JLTMA_Extension_Tooltip',
                            'demo_url' => 'https://master-addons.com/demos/ext-tooltips/',
                            'docs_url' => 'https://master-addons.com/docs/addons/tooltip-extension-for-elementor/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=x-9tBsm6yCg',
                            'is_pro'   => true
                        ],

                        // [
                        //     'key'      => 'ribbon',
                        //     'title'    => esc_html__('Ribbon', 'master-addons' ),
                        //     'class'    => 'MasterAddons\Modules\JLTMA_Ribbon',
                        //     'demo_url' => '',
                        //     'docs_url' => '',
                        //     'tuts_url' => '',
                        //     'is_pro'   => true
                        // ],
                        // [
                        //     'key'           => 'nested-sections',
                        //     'title'         => esc_html__('Nested Sections', 'master-addons' ),
                        //     'class'    => 'MasterAddons\Modules\JLTMA_Extension_Nested_Sections',
                        //     'demo_url'      => '',
                        //     'docs_url'      => '',
                        //     'tuts_url'      => '',
                        //     'is_pro'   => false
                        // ],
                        // [
                        //     'key'           => 'sticky',
                        //     'title'         => esc_html__('Sticky', 'master-addons' ),
                        //      'class'    => 'MasterAddons\Modules\JLTMA_Extension_Sticky',
                        //     'demo_url'      => '',
                        //     'docs_url'      => '',
                        // 'tuts_url'      => '',
                        // 'is_pro'   => false
                        // ],
                        // [
                        //     'key'           => 'content-protection',
                        //     'title'         => esc_html__('Content Protection', 'master-addons' ),
                        //      'class'    => 'MasterAddons\Modules\JLTMA_Extension_Content_Protection',
                        //     'demo_url'      => '',
                        //     'docs_url'      => '',
                        //     'tuts_url'      => '',
                        // 'is_pro'   => false
                        // ],
                        // [
                        //     'key'           => 'morphing-effects',
                        //     'title'         => esc_html__( 'Morphing Effects', 'master-addons' ),
                        //      'class'    => 'MasterAddons\Modules\JLTMA_Extension_Morphing_Effects',
                        //     'demo_url'      => '',
                        //     'docs_url'      => '',
                        //     'tuts_url'      => '',
                        // 'is_pro'   => false
                        // ]
                        // [
                        //     'key'           => 'magic-copy',
                        //     'title'         => esc_html__( 'Live Copy', 'master-addons' ),
                        //      'class'    => 'MasterAddons\Modules\JLTMA_Extension_Magic_Copy',
                        //     'demo_url'      => '',
                        //     'docs_url'      => '',
                        //     'tuts_url'      => '',
                        // 'is_pro'   => false
                        // ]

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
    JLTMA_Addon_Extensions::get_instance();
}
