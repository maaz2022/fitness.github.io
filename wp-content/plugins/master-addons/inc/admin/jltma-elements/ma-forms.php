<?php

namespace MasterAddons\Admin\Dashboard\Addons\Elements;

if (!class_exists('JLTMA_Addon_Forms')) {
    class JLTMA_Addon_Forms
    {
        private static $instance = null;
        public static $jltma_forms;

        public function __construct()
        {
            self::$jltma_forms = [
                'jltma-forms'      => [
                    'title'     => esc_html__('Form Elements', 'master-addons' ),
                    'elements'      => [
                        [
                            'key'      => 'contact-form-7',
                            'title'    => esc_html__('Contact Form 7', 'master-addons' ),
                            'class'    => 'MasterAddons\Addons\JLTMA_Contact_Form_7',
                            'demo_url' => 'https://master-addons.com/demos/contact-form-7/',
                            'docs_url' => 'https://master-addons.com/docs/addons/how-to-edit-contact-form-7/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=1fU6lWniRqo',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ninja-forms',
                            'title'    => esc_html__('Ninja Form', 'master-addons' ),
                            'class'    => 'MasterAddons\Addons\JLTMA_Ninja_Form',
                            'demo_url' => 'https://master-addons.com/demos/ninja-form/',
                            'docs_url' => 'https://master-addons.com/docs/addons/how-to-edit-contact-form-7/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=1fU6lWniRqo',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'wpforms',
                            'title'    => esc_html__('WP Forms', 'master-addons' ),
                            'class'    => 'MasterAddons\Addons\JLTMA_WP_Forms',
                            'demo_url' => 'https://master-addons.com/demos/wp-forms/',
                            'docs_url' => 'https://master-addons.com/docs/addons/how-to-edit-contact-form-7/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=1fU6lWniRqo',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'gravity-forms',
                            'title'    => esc_html__('Gravity Forms', 'master-addons' ),
                            'class'    => 'MasterAddons\Addons\JLTMA_Gravity_Forms',
                            'demo_url' => 'https://master-addons.com/demos/wp-forms/',
                            'docs_url' => 'https://master-addons.com/docs/addons/how-to-edit-contact-form-7/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=1fU6lWniRqo',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'caldera-forms',
                            'title'    => esc_html__('Caldera Forms', 'master-addons' ),
                            'class'    => 'MasterAddons\Addons\JLTMA_Caldera_Forms',
                            'demo_url' => 'https://master-addons.com/demos/wp-forms/',
                            'docs_url' => 'https://master-addons.com/docs/addons/how-to-edit-contact-form-7/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=1fU6lWniRqo',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'weforms',
                            'title'    => esc_html__('weForms', 'master-addons' ),
                            'class'    => 'MasterAddons\Addons\JLTMA_Weforms',
                            'demo_url' => 'https://master-addons.com/demos/wp-forms/',
                            'docs_url' => 'https://master-addons.com/docs/addons/how-to-edit-contact-form-7/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=1fU6lWniRqo',
                            'is_pro'   => false
                        ],
                        // [
                        //     'key'      => 'fluent-form',
                        //     'title'    => esc_html__('Fluent Form', 'master-addons' ),
                        //     'class'    => 'MasterAddons\Addons\JLTM_Fluent_Form',
                        //     'demo_url' => '',
                        //     'docs_url' => '',
                        //     'tuts_url' => '',
                        //      'is_pro'   => false
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
    JLTMA_Addon_Forms::get_instance();
}
