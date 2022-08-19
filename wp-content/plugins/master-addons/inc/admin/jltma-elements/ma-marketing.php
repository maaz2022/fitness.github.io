<?php

namespace MasterAddons\Admin\Dashboard\Addons\Elements;


if (!class_exists('JLTMA_Addon_Marketing')) {
    class JLTMA_Addon_Marketing
    {

        private static $instance = null;
        public static $jltma_marketing;

        public function __construct()
        {
            self::$jltma_marketing = [
                'jltma-marketing'      => [
                    'title'     => esc_html__('Marketing Elements', 'master-addons' ),
                    'elements'      => [
                        [
                            'key'      => 'ma-mailchimp',
                            'class'    => 'MasterAddons\Addons\JLTMA_Mailchimp',
                            'title'    => esc_html__('Mailchimp', 'master-addons' ),
                            'demo_url' => 'https://master-addons.com/demos/mailchimp/',
                            'docs_url' => 'https://master-addons.com/docs/addons/mailchimp-element/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=hST5tycqCsw',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-comparison-table',
                            'class'    => 'MasterAddons\Addons\JLTMA_Comparison_Table',
                            'title'    => esc_html__('Comparison Table', 'master-addons' ),
                            'demo_url' => 'https://master-addons.com/demos/comparison-table/',
                            'docs_url' => 'https://master-addons.com/docs/addons/elementor-comparison-table/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=qUkY1YwPz2Y',
                            'is_pro'   => true
                        ],
                        [
                            'key'      => 'ma-featured-product',
                            'class'    => 'MasterAddons\Addons\JLTMA_Featured_Product',
                            'title'    => esc_html__('Featured Product', 'master-addons' ),
                            'demo_url' => 'https://master-addons.com/demos/featured-product/',
                            'docs_url' => 'https://master-addons.com/docs/addons/elementor-featured-product/',
                            'tuts_url' => '',
                            'is_pro'   => true
                        ],
                        // [
                        //     'key'      => 'ma-pros-and-cons',
                        //     'class'    => 'MasterAddons\Addons\JLTMA_Pros_Cons',
                        //     'title'    => esc_html__('Pros and Cons', 'master-addons' ),
                        //     'demo_url' => 'https://master-addons.com/demos/pros-and-cons/',
                        //     'docs_url' => 'https://master-addons.com/docs/addons/elementor-pros-and-cons/',
                        //     'tuts_url' => '',
                        //     'is_pro'   => true
                        // ],

                        // [
                        //     'key'      => 'ma-product-listing',
                        //     'class'    => 'MasterAddons\Addons\JLTMA_Product_Listing',
                        //     'title'    => esc_html__('Product Listing', 'master-addons' ),
                        //     'demo_url' => 'https://master-addons.com/demos/product-listing/',
                        //     'docs_url' => 'https://master-addons.com/docs/addons/elementor-product-listing/',
                        //     'tuts_url' => '',
                        //     'is_pro'   => true
                        // ],
                        // [
                        //     'key'      => 'ma-product-review',
                        //     'class'    => 'MasterAddons\Addons\JLTMA_Product_Review',
                        //     'title'    => esc_html__('Product Review', 'master-addons' ),
                        //     'demo_url' => 'https://master-addons.com/demos/product-review/',
                        //     'docs_url' => 'https://master-addons.com/docs/addons/elementor-product-review/',
                        //     'tuts_url' => '',
                        //     'is_pro'   => true
                        // ],
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
    JLTMA_Addon_Marketing::get_instance();
}
