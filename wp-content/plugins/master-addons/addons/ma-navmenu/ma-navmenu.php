<?php

namespace MasterAddons\Addons;

// Elementor Classes
use \Elementor\Utils;
use \Elementor\Widget_Base;
use Elementor\Icons_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;

// Master Addons
use MasterAddons\Inc\Controls\MA_Group_Control_Button_Background;
use MasterAddons\Inc\Helper\Master_Addons_Helper;
use MasterAddons\Inc\Classes\Animation;
use MasterAddons\Modules\MegaMenu\JLTMA_Megamenu_Nav_Walker;

/**
 * Author Name: Liton Arefin
 * Author URL : https: //jeweltheme.com
 * Date       : 9/29/19
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Master Mega Menu Addon
 */
class JLTMA_Nav_Menu extends Widget_Base
{

    public function get_name()
    {
        return 'ma-navmenu';
    }
    public function get_title()
    {
        return __('Navigation Menu', 'master-addons' );
    }

    public function get_categories()
    {
        return ['master-addons'];
    }

    public function get_icon()
    {
        return 'jltma-icon eicon-nav-menu';
    }

    public function get_keywords()
    {
        return ['nav', 'navigation', 'menu', 'nav menu', 'header', 'footer', 'sidebar'];
    }

    public function get_style_depends()
    {
        if (!Icons_Manager::is_migration_allowed()) {
            return array();
        }

        return [
            'elementor-icons-fa-solid',
            'elementor-icons-fa-brands',
            'elementor-icons-fa-regular',
            // 'master-addons-main-style'
        ];
    }

    public function get_script_depends()
    {
        return ['jltma-nav-menu'];
    }


    public function get_help_url()
    {
        return 'https://master-addons.com/elementor-mega-menu/';
    }


    public function get_widget_selector()
    {
        return '.' . $this->get_widget_class();
    }

    public function get_widget_class()
    {
        return 'jltma-nav-menu';
    }

    protected $nav_menu_index = 1;


    protected function jltma_nav_menu_help_section()
    {


        /**
         * Content Tab: Docs Links
         */
        $this->start_controls_section(
            'jltma_section_help_docs',
            [
                'label' => esc_html__('Help Docs', 'master-addons' ),
            ]
        );


        $this->add_control(
            'help_doc_1',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/elementor-mega-menu/" target="_blank" rel="noopener">', '</a>'),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_2',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/navigation-menu/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_3',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=WhA5YnE4yJg" target="_blank" rel="noopener">', '</a>'),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );
        $this->end_controls_section();




        //Upgrade to Pro
        if (ma_el_fs()->is_not_paying()) {

            $this->start_controls_section(
                'jltma_section_pro_style_section',
                [
                    'label' => esc_html__('Upgrade to Pro for More Features', 'master-addons' ),
                ]
            );

            $this->add_control(
                'jltma_control_get_pro_style_tab',
                [
                    'label'   => esc_html__('Unlock more possibilities', 'master-addons' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        '1' => [
                            'title' => esc_html__('', 'master-addons' ),
                            'icon'  => 'fa fa-unlock-alt',
                        ],
                    ],
                    'default'     => '1',
                    'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
                ]
            );

            $this->end_controls_section();
        }
    }


    protected function jltma_nav_menu_general_section()
    {
        $widget_selector = $this->get_widget_selector();

        $this->start_controls_section(
            'jltma_content_tab',
            array('label' => __('General', 'master-addons' ))
        );

        $menus = $this->get_available_menus();


        if (!empty($menus)) {

            $ids = array_keys($menus);
            $default = $ids[0];

            /* translators: Navigation Menu widget Select Menu control description. %s: Menus screen link */
            $nav_menu_description = sprintf(__('Add or otherwise manage menus in %s.', 'master-addons' ), sprintf(
                '<a href="%2$s" target="_blank">%1$s</a>',
                __('Menus screen', 'master-addons' ),
                admin_url('nav-menus.php')
            ));

            $this->add_control(
                'jltma_nav_menu',
                array(
                    'label'        => __('Select Menu', 'master-addons' ),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => $default,
                    'save_default' => true,
                    'separator'    => 'after',
                    'description'  => $nav_menu_description,
                )
            );
        } else {
            /* translators: Navigation Menu widget no menus notice. %s: Menus screen link */
            $no_menu_message_part = sprintf(__('Go to the %s to create one.', 'master-addons' ), sprintf(
                '<a href="%2$s" target="_blank">%1$s</a>',
                __('Menus screen', 'master-addons' ),
                admin_url('nav-menus.php?action=edit&menu=0')
            ));
            $no_menu_message = sprintf(
                '<strong>%1$s</strong><br>%2$s',
                __('There are no menus in your site.', 'master-addons' ),
                $no_menu_message_part
            );

            $this->add_control(
                'jltma_nav_menu',
                array(
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => $no_menu_message,
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                )
            );
        }


        $this->add_control(
            'layout',
            array(
                'label'   => __('Layout', 'master-addons' ),
                'type'    => 'jltma-choose-text',
                'options' => array(
                    'horizontal' => array('title' => __('Horizontal', 'master-addons' )),
                    'vertical'   => array('title' => __('Vertical', 'master-addons' )),
                    'dropdown'   => array('title' => __('Dropdown', 'master-addons' )),
                ),
                'default'            => 'horizontal',
                'label_block'        => false,
                'render_type'        => 'template',
                'toggle'             => false,
                'frontend_available' => true,
            )
        );

        $this->add_control(
            'dropdown_menu_type',
            [
                'label'   => __('Type', 'master-addons' ),
                'type'    => 'jltma-choose-text',
                'options' => [
                    'default' => [
                        'title'       => __('Default', 'master-addons' ),
                        'description' => 'Default dropdown view',
                    ],
                    'popup' => [
                        'title'       => __('Popup', 'master-addons' ),
                        'description' => 'Dropdown in popup',
                    ],
                    'offcanvas' => [
                        'title'       => __('Offcanvas', 'master-addons' ),
                        'description' => 'Offcanvas type of dropdown menu',
                    ],
                ],
                'default'     => 'default',
                'toggle'      => false,
                'label_block' => false,
                'render_type' => 'template',
                'condition'   => ['layout' => 'dropdown'],
            ]
        );

        $this->add_control(
            'vertical_menu_type',
            array(
                'label' => __('Type', 'master-addons' ),
                'type' => 'jltma-choose-text',
                'options' => array(
                    'normal' => array(
                        'title' => __('Normal', 'master-addons' ),
                        'description' => 'Dropdown on the side of the menu',
                    ),
                    'toggle' => array(
                        'title' => __('Toggle', 'master-addons' ),
                        'description' => 'Toggle view menu',
                    ),
                    'accordion' => array(
                        'title' => __('Accordion', 'master-addons' ),
                        'description' => 'Accordion view menu',
                    ),
                    'side' => array(
                        'title' => __('Side', 'master-addons' ),
                        'description' => 'Vertical menu on the side of the page. Without dropdown menu',
                    ),
                ),
                'default' => 'normal',
                'toggle' => false,
                'render_type' => 'template',
                'frontend_available' => true,
                'condition' => array('layout' => 'vertical'),
            )
        );

        $this->add_control(
            'side_description',
            array(
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('Only the main menu items are displayed, subitems are hidden.', 'master-addons' ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition' => array(
                    'layout' => 'vertical',
                    'vertical_menu_type' => 'side',
                ),
            )
        );

        $this->add_responsive_control(
            'menu_alignment',
            [
                'label'        => __('Menu Alignment', 'master-addons' ),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => Master_Addons_Helper::jltma_content_flex_alignments(),
                'render_type'  => 'template',
                'default'      => 'center',
                'prefix_class' => 'jltma-menu-alignment%s-',
                'selectors'    => [
                    '{{WRAPPER}} .jltma-layout-horizontal' . $widget_selector . '__main > ul,
					{{WRAPPER}} .jltma-layout-vertical.jltma-vertical-type-normal' . $widget_selector . '__main > ul > li > a' => 'justify-content: {{VALUE}}',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'layout',
                            'operator' => '=',
                            'value'    => 'horizontal',
                        ],
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'layout',
                                    'operator' => '=',
                                    'value'    => 'vertical',
                                ],
                                [
                                    'name'     => 'vertical_menu_type',
                                    'operator' => '=',
                                    'value'    => 'normal',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'side_menu_alignment',
            [
                'label'   => __('Alignment', 'master-addons' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => Master_Addons_Helper::jltma_content_flex_alignments(),
                'default'   => 'center',
                'toggle'    => false,
                'selectors' => [
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'layout'             => 'vertical',
                    'vertical_menu_type' => 'side',
                ],
            ]
        );

        $this->add_control(
            'side_menu_position',
            array(
                'label' => __('Position', 'master-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => __('Left', 'master-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ),
                    'right' => array(
                        'title' => __('Right', 'master-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ),
                ),
                'default' => 'left',
                'toggle' => false,
                'render_type' => 'template',
                'prefix_class' => 'jltma-side-position-',
                'frontend_available' => true,
                'condition' => array(
                    'layout' => 'vertical',
                    'vertical_menu_type' => 'side',
                ),
            )
        );

        $this->add_control(
            'indicator_main_popover',
            [
                'label'       => esc_html__('Dropdown Indicator', 'master-addons' ),
                'type'        => Controls_Manager::POPOVER_TOGGLE,
                'render_type' => 'template',
                'separator'   => 'before',
                'default'     => 'yes',
                'conditions'  => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'layout',
                            'operator' => '=',
                            'value'    => 'horizontal',
                        ],
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'layout',
                                    'operator' => '=',
                                    'value'    => 'vertical',
                                ],
                                [
                                    'name'     => 'vertical_menu_type',
                                    'operator' => '=',
                                    'value'    => 'normal',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->start_popover();

        $this->add_control(
            'indicator_main',
            array(
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'recommended' => array(
                    'fa-solid' => array(
                        'arrow-circle-down',
                        'arrow-down',
                        'long-arrow-alt-down',
                        'angle-double-down',
                        'angle-down',
                        'chevron-down',
                        'caret-down',
                    ),
                    'fa-regular' => array(
                        'arrow-alt-circle-down',
                    ),
                ),
                'default' => array(
                    'value' => 'fas fa-chevron-down',
                    'library' => 'fa-solid',
                ),
                'file' => '',
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'relation' => 'or',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'horizontal',
                                ),
                                array(
                                    'relation' => 'and',
                                    'terms' => array(
                                        array(
                                            'name' => 'layout',
                                            'operator' => '=',
                                            'value' => 'vertical',
                                        ),
                                        array(
                                            'name' => 'vertical_menu_type',
                                            'operator' => '=',
                                            'value' => 'normal',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'name' => 'indicator_main_popover',
                            'operator' => '=',
                            'value' => 'yes',
                        ),
                    ),
                ),
            )
        );

        $this->add_control(
            'icon_position',
            array(
                'label' => __('Position', 'master-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => __('Left', 'master-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ),
                    'right' => array(
                        'title' => __('Right', 'master-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ),
                ),
                'default' => 'right',
                'toggle' => false,
                'render_type' => 'template',
                'prefix_class' => 'jltma-icon-position-',
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'relation' => 'or',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'horizontal',
                                ),
                                array(
                                    'relation' => 'and',
                                    'terms' => array(
                                        array(
                                            'name' => 'layout',
                                            'operator' => '=',
                                            'value' => 'vertical',
                                        ),
                                        array(
                                            'name' => 'vertical_menu_type',
                                            'operator' => '=',
                                            'value' => 'normal',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'name' => 'indicator_main_popover',
                            'operator' => '=',
                            'value' => 'yes',
                        ),
                    ),
                ),
            )
        );

        $this->add_responsive_control(
            'indicator_main_gap',
            array(
                'label' => __('Gap Between', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px',
                    'em',
                    'vw',
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main > ul > li > a > span > span:nth-child(2)' => 'margin-left: {{SIZE}}{{UNIT}}',
                ),
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'relation' => 'or',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'horizontal',
                                ),
                                array(
                                    'relation' => 'and',
                                    'terms' => array(
                                        array(
                                            'name' => 'layout',
                                            'operator' => '=',
                                            'value' => 'vertical',
                                        ),
                                        array(
                                            'name' => 'vertical_menu_type',
                                            'operator' => '=',
                                            'value' => 'normal',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'name' => 'indicator_main_popover',
                            'operator' => '=',
                            'value' => 'yes',
                        ),
                    ),
                ),
            )
        );


        $this->add_control(
            'indicator_main_animation',
            array(
                'label' => __('Animation', 'master-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'none' => __('None', 'master-addons' ),
                    'rotate-left' => __('Rotate Left', 'master-addons' ),
                    'rotate-right' => __('Rotate Right', 'master-addons' ),
                    'rotate-opposite' => __('Rotate Opposite', 'master-addons' ),
                    'opacity' => __('Opacity', 'master-addons' ),
                ),
                'default' => 'none',
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'relation' => 'or',
                            'terms' => array(
                                array(
                                    'relation' => 'and',
                                    'terms' => array(
                                        array(
                                            'name' => 'layout',
                                            'operator' => '=',
                                            'value' => 'horizontal',
                                        ),
                                        array(
                                            'name' => 'indicator_main[value]',
                                            'operator' => '!==',
                                            'value' => '',
                                        ),
                                    ),
                                ),
                                array(
                                    'relation' => 'and',
                                    'terms' => array(
                                        array(
                                            'name' => 'layout',
                                            'operator' => '=',
                                            'value' => 'vertical',
                                        ),
                                        array(
                                            'name' => 'vertical_menu_type',
                                            'operator' => '=',
                                            'value' => 'normal',
                                        ),
                                        array(
                                            'name' => 'indicator_main[value]',
                                            'operator' => '!==',
                                            'value' => '',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'name' => 'indicator_main_popover',
                            'operator' => '=',
                            'value' => 'yes',
                        ),
                    ),
                ),
            )
        );

        $this->add_control(
            'main_hover_transition',
            array(
                'label' => __('Transition Duration', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'max' => 3,
                        'step' => 0.1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main > ul > li > a > span > span' => 'transition-duration: {{SIZE}}s',
                ),
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'relation' => 'or',
                            'terms' => array(
                                array(
                                    'relation' => 'and',
                                    'terms' => array(
                                        array(
                                            'name' => 'layout',
                                            'operator' => '=',
                                            'value' => 'horizontal',
                                        ),
                                        array(
                                            'name' => 'indicator_main_animation',
                                            'operator' => '!==',
                                            'value' => 'none',
                                        ),
                                        array(
                                            'name' => 'indicator_main[value]',
                                            'operator' => '!==',
                                            'value' => '',
                                        ),
                                    ),
                                ),
                                array(
                                    'relation' => 'and',
                                    'terms' => array(
                                        array(
                                            'name' => 'layout',
                                            'operator' => '=',
                                            'value' => 'vertical',
                                        ),
                                        array(
                                            'name' => 'vertical_menu_type',
                                            'operator' => '=',
                                            'value' => 'normal',
                                        ),
                                        array(
                                            'name' => 'indicator_main_animation',
                                            'operator' => '!==',
                                            'value' => 'none',
                                        ),
                                        array(
                                            'name' => 'indicator_main[value]',
                                            'operator' => '!==',
                                            'value' => '',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'name' => 'indicator_main_popover',
                            'operator' => '=',
                            'value' => 'yes',
                        ),
                    ),
                ),
            )
        );

        $this->end_popover();

        $this->add_control(
            'dropdown_breakpoints',
            array(
                'label' => __('Breakpoint', 'master-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'none' => __('None', 'master-addons' ),
                    /* translators: Tablet breakpoint %d: number in pixels. */
                    'tablet' => sprintf(__('Tablet (< %dpx)', 'master-addons' ), Master_Addons_Helper::get_breakpoints('tablet')),
                    /* translators: Mobile breakpoint %d: number in pixels. */
                    'mobile' => sprintf(__('Mobile (< %dpx)', 'master-addons' ), Master_Addons_Helper::get_breakpoints('mobile')),
                ),
                'default' => 'tablet',
                'frontend_available' => true,
                'render_type' => 'template',
                'prefix_class' => 'jltma-dropdown-breakpoints-',
                'condition' => array('layout!' => 'dropdown'),
            )
        );

        $this->add_control(
            'open_by_click',
            array(
                'label' => __('Open link by click (menu item)', 'master-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'master-addons' ),
                'label_off' => __('No', 'master-addons' ),
                'return_value' => 'true',
                'default' => 'false',
                'description' => sprintf(__('If link # or empty, there will be no link', 'master-addons' )),
                'condition' => array(
                    'layout' => 'vertical',
                    'vertical_menu_type' => array(
                        'toggle',
                        'accordion',
                    ),
                ),
            )
        );

        $this->add_control(
            'dropdown_absolute',
            array(
                'label' => __('Overlap Content', 'master-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('Set Dropdown Menu position to absolute. On desktop, this will affect the Layout: Dropdown. When chosen Breakpoint for Tablet or Mobile this will also affect the Layouts: Dropdown, Horizontal, Vertical (except the Side type).', 'master-addons' ),
                'separator' => 'before',
                'render_type' => 'template',
                'prefix_class' => 'jltma-dropdown-absolute-',
                'conditions' => array(
                    'relation' => 'or',
                    'terms' => array(
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'horizontal',
                                ),
                                array(
                                    'name' => 'dropdown_breakpoints',
                                    'operator' => '!==',
                                    'value' => 'none',
                                ),
                            ),
                        ),
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'vertical',
                                ),
                                array(
                                    'name' => 'dropdown_breakpoints',
                                    'operator' => '!==',
                                    'value' => 'none',
                                ),
                                array(
                                    'name' => 'vertical_menu_type',
                                    'operator' => '!==',
                                    'value' => 'side',
                                ),
                            ),
                        ),
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'dropdown',
                                ),
                                array(
                                    'name' => 'dropdown_menu_type',
                                    'operator' => '=',
                                    'value' => 'default',
                                ),
                            ),
                        ),
                    ),
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_absolute_position',
            array(
                'label' => __('Dropdown Position', 'master-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => __('Left Side', 'master-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ),
                    'right' => array(
                        'title' => __('Right Side', 'master-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ),
                ),
                'render_type' => 'template',
                'prefix_class' => 'jltma-dropdown-absolute%s-position-',
                'conditions' => array(
                    'relation' => 'or',
                    'terms' => array(
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'horizontal',
                                ),
                                array(
                                    'name' => 'dropdown_breakpoints',
                                    'operator' => '!==',
                                    'value' => 'none',
                                ),
                                array(
                                    'name' => 'dropdown_absolute',
                                    'operator' => '=',
                                    'value' => 'yes',
                                ),
                            ),
                        ),
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'vertical',
                                ),
                                array(
                                    'name' => 'dropdown_breakpoints',
                                    'operator' => '!==',
                                    'value' => 'none',
                                ),
                                array(
                                    'name' => 'vertical_menu_type',
                                    'operator' => '!==',
                                    'value' => 'side',
                                ),
                                array(
                                    'name' => 'dropdown_absolute',
                                    'operator' => '=',
                                    'value' => 'yes',
                                ),
                            ),
                        ),
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'dropdown',
                                ),
                                array(
                                    'name' => 'dropdown_menu_type',
                                    'operator' => '=',
                                    'value' => 'default',
                                ),
                                array(
                                    'name' => 'dropdown_absolute',
                                    'operator' => '=',
                                    'value' => 'yes',
                                ),
                            ),
                        ),
                    ),
                ),
            )
        );

        $this->add_responsive_control(
            'widget_min_width',
            array(
                'label' => __('Dropdown Min Width', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px',
                    'vw',
                ),
                'range' => array(
                    'px' => array(
                        'min' => 200,
                        'max' => 1920,
                    ),
                    'vw' => array(
                        'min' => 10,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}}.jltma-dropdown-absolute-yes .elementor-widget-container ' . $widget_selector . '__dropdown' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}:not(.jltma-dropdown-absolute-yes) .elementor-widget-container' => 'width: {{SIZE}}{{UNIT}};',
                ),
                'conditions' => array(
                    'relation' => 'or',
                    'terms' => array(
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'horizontal',
                                ),
                                array(
                                    'name' => 'dropdown_breakpoints',
                                    'operator' => '!==',
                                    'value' => 'none',
                                ),
                                array(
                                    'name' => 'dropdown_absolute',
                                    'operator' => '=',
                                    'value' => 'yes',
                                ),
                            ),
                        ),
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'vertical',
                                ),
                                array(
                                    'name' => 'dropdown_breakpoints',
                                    'operator' => '!==',
                                    'value' => 'none',
                                ),
                                array(
                                    'name' => 'dropdown_absolute',
                                    'operator' => '=',
                                    'value' => 'yes',
                                ),
                                array(
                                    'name' => 'vertical_menu_type',
                                    'operator' => '!==',
                                    'value' => 'side',
                                ),
                            ),
                        ),
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'dropdown',
                                ),
                                array(
                                    'name' => 'dropdown_menu_type',
                                    'operator' => '=',
                                    'value' => 'default',
                                ),
                                array(
                                    'name' => 'dropdown_absolute',
                                    'operator' => '=',
                                    'value' => 'yes',
                                ),
                            ),
                        ),
                    ),
                ),
            )
        );

        $this->add_control(
            'dropdown_position',
            array(
                'label' => __('Dropdown Placement', 'master-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => __('Left Side', 'master-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ),
                    'right' => array(
                        'title' => __('Right Side', 'master-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ),
                ),
                'default' => 'right',
                'toggle' => false,
                'prefix_class' => 'jltma-dropdown-position-',
                'condition' => array(
                    'layout' => 'vertical',
                    'vertical_menu_type' => 'normal',
                ),
            )
        );

        $this->end_controls_section();
    }


    /**
     * Toogle Switch Section
     */

    protected function jltma_nav_menu_toggle_switch_section()
    {
        $widget_selector = $this->get_widget_selector();

        $this->start_controls_section(
            'section_dropdown_toggle',
            array(
                'label' => __('Toggle Switch', 'master-addons' ),
                'conditions' => array(
                    'relation' => 'or',
                    'terms' => array(
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'horizontal',
                                ),
                                array(
                                    'name' => 'dropdown_breakpoints',
                                    'operator' => '!==',
                                    'value' => 'none',
                                ),
                            ),
                        ),
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'vertical',
                                ),
                                array(
                                    'name' => 'dropdown_breakpoints',
                                    'operator' => '!==',
                                    'value' => 'none',
                                ),
                                array(
                                    'name' => 'vertical_menu_type',
                                    'operator' => '!==',
                                    'value' => 'side',
                                ),
                            ),
                        ),
                        array(
                            'name' => 'layout',
                            'operator' => '=',
                            'value' => 'dropdown',
                        ),
                    ),
                ),
            )
        );

        $this->add_control(
            'dropdown_toggle_description',
            array(
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('This toggle will appear on resolutions below the one defined in Breakpoint settings.', 'master-addons' ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition' => array(
                    'layout!' => 'dropdown',
                    'dropdown_breakpoints!' => 'none',
                ),
            )
        );

        $this->add_responsive_control(
            'toggle_align',
            array(
                'label' => __('Alignment', 'master-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => __('Left', 'master-addons' ),
                        'icon' => 'fa fa-align-left',
                    ),
                    'center' => array(
                        'title' => __('Center', 'master-addons' ),
                        'icon' => 'fa fa-align-center',
                    ),
                    'right' => array(
                        'title' => __('Right', 'master-addons' ),
                        'icon' => 'fa fa-align-right',
                    ),
                    'stretch' => array(
                        'title' => __('Justified', 'master-addons' ),
                        'icon' => 'fa fa-align-justify',
                    ),
                ),
                'toggle' => true,
                'label_block' => false,
                'selectors_dictionary' => array(
                    'left' => 'flex-start;',
                    'center' => 'center;',
                    'right' => 'flex-end;',
                    'stretch' => 'stretch',
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__toggle-container' => 'align-items: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'dropdown_toggle_type',
            array(
                'label' => __('Type', 'master-addons' ),
                'type' => 'jltma-choose-text',
                'options' => array(
                    'icon' => array(
                        'title' => __('Icon', 'master-addons' ),
                        'description' => 'Switch has only icon',
                    ),
                    'text' => array(
                        'title' => __('Text', 'master-addons' ),
                        'description' => 'Switch has only text',
                    ),
                    'both' => array(
                        'title' => __('Both', 'master-addons' ),
                        'description' => 'Switch has icon and text',
                    ),
                ),
                'default' => 'icon',
                'label_block' => false,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'toggle_view',
            array(
                'label' => __('View', 'master-addons' ),
                'type' => 'jltma-choose-text',
                'options' => array(
                    'default' => array('title' => __('Default', 'master-addons' )),
                    'stacked' => array('title' => __('Stacked', 'master-addons' )),
                    'framed' => array('title' => __('Framed', 'master-addons' )),
                ),
                'default' => 'stacked',
                'label_block' => false,
                'prefix_class' => 'jltma-toggle-view-',
            )
        );

        $this->add_control(
            'toggle_shape',
            array(
                'label' => __('Shape', 'master-addons' ),
                'type' => 'jltma-choose-text',
                'options' => array(
                    'square' => array('title' => __('Square', 'master-addons' )),
                    'circle' => array('title' => __('Circle', 'master-addons' )),
                ),
                'default' => 'square',
                'label_block' => false,
                'prefix_class' => 'jltma-toggle-shape-',
                'condition' => array(
                    'toggle_view!' => 'default',
                    'dropdown_toggle_type' => 'icon',
                    'toggle_align!' => 'stretch',
                ),
            )
        );

        $this->start_controls_tabs(
            'tabs_dropdown_toggle_icon',
            array('condition' => array('dropdown_toggle_type!' => 'text'))
        );

        $this->start_controls_tab(
            'tab_dropdown_toggle_icon_normal',
            array('label' => __('Normal', 'master-addons' ))
        );

        $this->add_control(
            'dropdown_toggle_icon',
            array(
                'label' => __('Icon', 'master-addons' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'recommended' => array(
                    'fa-solid' => array(
                        'align-justify',
                        'hamburger',
                        'list',
                    ),
                ),
                'file' => '',
                'show_label' => false,
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dropdown_toggle_icon_active',
            array('label' => __('Active', 'master-addons' ))
        );

        $this->add_control(
            'dropdown_toggle_icon_active',
            array(
                'label' => __('Icon', 'master-addons' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'recommended' => array(
                    'fa-solid' => array(
                        'times',
                        'times-circle',
                    ),
                    'fa-regular' => array(
                        'times-circle',
                    ),
                ),
                'file' => '',
                'show_label' => false,
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'dropdown_toggle_text',
            array(
                'label' => __('Text', 'master-addons' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Menu', 'master-addons' ),
                'separator' => 'before',
                'condition' => array('dropdown_toggle_type!' => 'icon'),
            )
        );

        $this->add_responsive_control(
            'toggle_text_icon_position',
            array(
                'label' => __('Position', 'master-addons' ),
                'type' => 'jltma-choose-text',
                'description' => __('Will be applied only if Justified Alignment is chosen.', 'master-addons' ),
                'options' => array(
                    'central' => array(
                        'title' => __('Central', 'master-addons' ),
                    ),
                    'on-sides' => array(
                        'title' => __('On Sides', 'master-addons' ),
                    ),
                ),
                'default' => 'central',
                'label_block' => false,
                'prefix_class' => 'jltma-toggle-text-icon%s-position-',
                'condition' => array('dropdown_toggle_type' => 'both'),
            )
        );

        $this->add_control(
            'dropdown_toggle_gap',
            array(
                'label' => __('Horizontal Gap', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range' => array(
                    'px' => array(
                        'min' => 0,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__toggle > span.jltma-toggle-icon-active + span' => 'margin-left: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array('dropdown_toggle_type' => 'both'),
            )
        );

        $this->end_controls_section();
    }


    /**
     * Dropdown Menu
     */
    protected function jltma_nav_menu_dropdown_menu_section()
    {
        $widget_selector = $this->get_widget_selector();

        $this->start_controls_section(
            'section_dropdown_menu',
            array(
                'label' => __('Dropdown Menu', 'master-addons' ),
                'conditions' => array(
                    'relation' => 'or',
                    'terms' => array(
                        array(
                            'name' => 'layout',
                            'operator' => '=',
                            'value' => 'horizontal',
                        ),
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'vertical',
                                ),
                                array(
                                    'name' => 'vertical_menu_type',
                                    'operator' => '!==',
                                    'value' => 'side',
                                ),
                            ),
                        ),
                        array(
                            'name' => 'layout',
                            'operator' => '=',
                            'value' => 'dropdown',
                        ),
                    ),
                ),
            )
        );

        $this->add_control(
            'dropdown_popup_type_width',
            array(
                'label' => __('Max Width', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px',
                    '%',
                ),
                'range' => array(
                    'px' => array(
                        'min' => 200,
                        'max' => 1920,
                    ),
                    '%' => array(
                        'min' => 20,
                        'max' => 100,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown.jltma-menu-dropdown-type-popup > ul' => 'max-width: {{SIZE}}{{UNIT}}',
                ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type' => 'popup',
                ),
            )
        );

        $this->add_control(
            'full_width',
            array(
                'label' => __('Full Width', 'master-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('Stretch the dropdown of the menu to full width.', 'master-addons' ),
                'render_type' => 'template',
                'prefix_class' => 'jltma-nav-menu-',
                'return_value' => 'stretch',
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type' => 'default',
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_width',
            array(
                'label' => __('Width', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range' => array(
                    'px' => array(
                        'min' => 100,
                        'max' => 500,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li ul,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li ul' => 'width: {{SIZE}}{{UNIT}};',
                ),
                'conditions' => array(
                    'relation' => 'or',
                    'terms' => array(
                        array(
                            'name' => 'layout',
                            'operator' => '=',
                            'value' => 'horizontal',
                        ),
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'vertical',
                                ),
                                array(
                                    'name' => 'vertical_menu_type',
                                    'operator' => '=',
                                    'value' => 'normal',
                                ),
                            ),
                        ),
                    ),
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_align',
            [
                'label'        => __('Alignment', 'master-addons' ),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => Master_Addons_Helper::jltma_content_flex_alignments(),
                'default'      => 'flex-start',
                'prefix_class' => 'jltma-dropdown%s-align-',
                'conditions'   => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'layout',
                            'operator' => '=',
                            'value'    => 'horizontal',
                        ],
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'layout',
                                    'operator' => '=',
                                    'value'    => 'vertical',
                                ],
                                [
                                    'name'     => 'vertical_menu_type',
                                    'operator' => '!==',
                                    'value'    => 'side',
                                ],
                            ],
                        ],
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'layout',
                                    'operator' => '=',
                                    'value'    => 'dropdown',
                                ],
                                [
                                    'name'     => 'dropdown_menu_type',
                                    'operator' => '!==',
                                    'value'    => 'popup',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'dropdown_popup_align',
            [
                'label'        => __('Alignment', 'master-addons' ),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => Master_Addons_Helper::jltma_content_flex_alignments(),
                'default'      => 'center',
                'toggle'       => false,
                'prefix_class' => 'jltma-dropdown%s-align-',
                'condition'    => [
                    'layout'             => 'dropdown',
                    'dropdown_menu_type' => 'popup',
                ],
            ]
        );

        $this->add_control(
            'indicator_submenu_popover',
            array(
                'label' => esc_html__('Submenu Indicator', 'master-addons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'render_type' => 'template',
            )
        );

        $this->start_popover();

        $this->add_control(
            'indicator_submenu',
            array(
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'recommended' => array(
                    'fa-solid' => array(
                        'angle-down',
                        'chevron-down',
                        'caret-down',
                        'arrow-down',
                        'long-arrow-alt-down',
                        'chevron-circle-down',
                        'arrow-circle-down',
                        'angle-right',
                        'chevron-right',
                        'caret-right',
                        'arrow-right',
                        'long-arrow-alt-right',
                        'chevron-circle-right',
                        'arrow-circle-right',
                    ),
                    'fa-regular' => array(
                        'arrow-alt-circle-down',
                        'arrow-alt-circle-right',
                    ),
                ),
                'default' => array(
                    'value' => 'fas fa-chevron-down',
                    'library' => 'fa-solid',
                ),
                'file' => '',
                'condition' => array('indicator_submenu_popover' => 'yes'),
            )
        );

        $this->add_control(
            'dropdown_icon_position',
            array(
                'label' => __('Position', 'master-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => __('Left', 'master-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ),
                    'right' => array(
                        'title' => __('Right', 'master-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ),
                ),
                'default' => 'right',
                'toggle' => false,
                'prefix_class' => 'jltma-dropdown-icon-',
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'relation' => 'or',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'horizontal',
                                ),
                                array(
                                    'relation' => 'and',
                                    'terms' => array(
                                        array(
                                            'name' => 'layout',
                                            'operator' => '=',
                                            'value' => 'vertical',
                                        ),
                                        array(
                                            'name' => 'vertical_menu_type',
                                            'operator' => '!==',
                                            'value' => 'side',
                                        ),
                                    ),
                                ),
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'dropdown',
                                ),
                            ),
                        ),
                        array(
                            'name' => 'indicator_submenu_popover',
                            'operator' => '=',
                            'value' => 'yes',
                        ),
                    ),
                ),
            )
        );

        $this->add_responsive_control(
            'indicator_submenu_gap',
            array(
                'label' => __('Gap Between', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px',
                    'em',
                    'vw',
                ),
                'selectors' => array(
                    // '{{WRAPPER}}' => '--indicator-submenu-gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} ' . $widget_selector . '__main > ul > li ul.dropdown-menu a > span > span:nth-child(2)' => 'margin-left: {{SIZE}}{{UNIT}}',
                ),
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'relation' => 'or',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'horizontal',
                                ),
                                array(
                                    'relation' => 'and',
                                    'terms' => array(
                                        array(
                                            'name' => 'layout',
                                            'operator' => '=',
                                            'value' => 'vertical',
                                        ),
                                        array(
                                            'name' => 'vertical_menu_type',
                                            'operator' => '!==',
                                            'value' => 'side',
                                        ),
                                    ),
                                ),
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'dropdown',
                                ),
                            ),
                        ),
                        array(
                            'name' => 'indicator_submenu_popover',
                            'operator' => '=',
                            'value' => 'yes',
                        ),
                    ),
                ),
            )
        );

        $this->add_control(
            'indicator_submenu_animation',
            array(
                'label' => __('Animation', 'master-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'none' => __('None', 'master-addons' ),
                    'rotate-left' => __('Rotate Left', 'master-addons' ),
                    'rotate-right' => __('Rotate Right', 'master-addons' ),
                    'rotate-opposite' => __('Rotate Opposite', 'master-addons' ),
                    'opacity' => __('Opacity', 'master-addons' ),
                ),
                'default' => 'none',
                'condition' => array(
                    'indicator_submenu[value]!' => '',
                    'indicator_submenu_popover' => 'yes',
                ),
            )
        );

        $this->add_control(
            'submenu_hover_transition',
            array(
                'label' => __('Transition Duration', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'max' => 3,
                        'step' => 0.1,
                    ),
                ),
                'selectors' => array(
                    // '{{WRAPPER}} ' . $widget_selector . '__main > ul > li > a > span > span' => 'transition-duration: {{SIZE}}s',
                    '{{WRAPPER}} ' . $widget_selector . '__main > ul > li ul.dropdown-menu a span span' => 'transition-duration: {{SIZE}}s',
                    // '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul a > span,
					// {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul a > span,
					// {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle a > span,
					// {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion a > span,
					// {{WRAPPER}} ' . $widget_selector . '__dropdown a > span' => 'transition-duration: {{SIZE}}s',
                ),
                'condition' => array(
                    'indicator_submenu[value]!' => '',
                    'indicator_submenu_animation!' => 'none',
                    'indicator_submenu_popover' => 'yes',
                ),
            )
        );

        $this->end_popover();

        $this->end_controls_section();
    }



    /**
     * Popup/Offcanvas  Section
     */
    protected function jltma_nav_menu_popup_offcanvas_section()
    {
        $widget_selector = $this->get_widget_selector();

        $this->start_controls_section(
            'section_dropdown_popup_offcanvas',
            array(
                'label' => __('Popup / Offcanvas Settings', 'master-addons' ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                ),
            )
        );

        $this->add_control(
            'offcanvas_position',
            array(
                'label' => __('Position', 'master-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => __('Left', 'master-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ),
                    'right' => array(
                        'title' => __('Right', 'master-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ),
                ),
                'default' => 'right',
                'toggle' => false,
                'prefix_class' => 'jltma-offcanvas-position-',
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type' => 'offcanvas',
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_offcanvas_width',
            array(
                'label' => __('Canvas Width', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 100,
                        'max' => 1000,
                    ),
                    '%' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                    'vw' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                    'vh' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                ),
                'size_units' => array(
                    'px',
                    '%',
                    'vw',
                    'vh',
                ),
                'default' => array(
                    'unit' => 'px',
                    'size' => 300,
                ),
                'tablet_default' => array(
                    'unit' => '%',
                    'size' => 40,
                ),
                'mobile_default' => array(
                    'unit' => '%',
                    'size' => 100,
                ),
                'selectors' => array(
                    '{{WRAPPER}} .jltma-menu-dropdown-type-offcanvas' . $widget_selector . '__dropdown' => 'width: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type' => 'offcanvas',
                ),
            )
        );

        $this->add_control(
            'dropdown_offcanvas_hr',
            array(
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type' => 'offcanvas',
                ),
            )
        );

        $this->add_control(
            'popup_offcanvas_close_heading',
            array(
                'label' => __('Close', 'master-addons' ),
                'type' => Controls_Manager::HEADING,
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                ),
            )
        );

        $this->add_control(
            'popup_offcanvas_close_type',
            array(
                'label' => __('Type', 'master-addons' ),
                'type' => 'jltma-choose-text',
                'options' => array(
                    'icon' => array(
                        'title' => __('Icon', 'master-addons' ),
                        'description' => 'Switch has only icon',
                    ),
                    'text' => array(
                        'title' => __('Text', 'master-addons' ),
                        'description' => 'Switch has only text',
                    ),
                    'both' => array(
                        'title' => __('Both', 'master-addons' ),
                        'description' => 'Switch has icon and text',
                    ),
                ),
                'default' => 'icon',
                'label_block' => false,
                'render_type' => 'template',
                'prefix_class' => 'jltma-close-type-',
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                ),
            )
        );

        $this->add_control(
            'popup_close_view',
            array(
                'label' => __('View', 'master-addons' ),
                'type' => 'jltma-choose-text',
                'options' => array(
                    'default' => array('title' => __('Default', 'master-addons' )),
                    'stacked' => array('title' => __('Stacked', 'master-addons' )),
                    'framed' => array('title' => __('Framed', 'master-addons' )),
                ),
                'default' => 'default',
                'label_block' => false,
                'prefix_class' => 'jltma-close-view-',
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                ),
            )
        );

        $this->add_control(
            'popup_close_shape',
            array(
                'label' => __('Shape', 'master-addons' ),
                'type' => 'jltma-choose-text',
                'options' => array(
                    'square' => array('title' => __('Square', 'master-addons' )),
                    'circle' => array('title' => __('Circle', 'master-addons' )),
                ),
                'default' => 'square',
                'label_block' => false,
                'prefix_class' => 'jltma-close-shape-',
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                    'popup_offcanvas_close_type' => 'icon',
                    'popup_close_view!' => 'default',
                ),
            )
        );

        $this->add_control(
            'close_icon',
            array(
                'label' => __('Icon', 'master-addons' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'recommended' => array(
                    'fa-solid' => array(
                        'times',
                        'times-circle',
                    ),
                    'fa-regular' => array(
                        'times-circle',
                    ),
                ),
                'file' => '',
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                    'popup_offcanvas_close_type!' => 'text',
                ),
            )
        );

        $this->add_control(
            'close_text',
            array(
                'label' => __('Text', 'master-addons' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Close', 'master-addons' ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                    'popup_offcanvas_close_type!' => 'icon',
                ),
            )
        );

        $this->add_responsive_control(
            'popup_close_gap',
            array(
                'label' => __('Gap Between', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close i + span' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close svg + span' => 'margin-left: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                    'popup_offcanvas_close_type' => 'both',
                    'close_text!' => '',
                ),
            )
        );

        $this->add_control(
            'overlay_close',
            array(
                'label' => __('Close With Click on Overlay', 'master-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('Close popup upon click/tap on overlay', 'master-addons' ),
                'frontend_available' => true,
                'separator' => 'before',
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                ),
            )
        );

        $this->add_control(
            'esc_close',
            array(
                'label' => __('Close by ESC Button Click', 'master-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'frontend_available' => true,
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                ),
            )
        );

        $this->add_control(
            'disable_scroll',
            array(
                'label' => __('Disable scroll', 'master-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'frontend_available' => true,
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                ),
            )
        );

        $this->end_controls_section();
    }

    /**
     * Main Menu Item  Section
     */
    protected function jltma_nav_menu_item_section()
    {
        $widget_selector = $this->get_widget_selector();

        $menu_first_level = array(
            'relation' => 'or',
            'terms' => array(
                array(
                    'name' => 'layout',
                    'operator' => '=',
                    'value' => 'horizontal',
                ),
                array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'layout',
                            'operator' => '=',
                            'value' => 'vertical',
                        ),
                        array(
                            'name' => 'vertical_menu_type',
                            'operator' => 'in',
                            'value' => array(
                                'normal',
                                'side',
                            ),
                        ),
                    ),
                ),
            ),
        );

        $this->start_controls_section(
            'section_style_main_menu',
            array(
                'label' => __('Main Menu Item', 'master-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => $menu_first_level,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'main_menu_typography',
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a',
            )
        );

        $this->start_controls_tabs('tabs_menu_item_style');

        $this->start_controls_tab(
            'tab_main_menu_item_normal',
            array('label' => __('Normal', 'master-addons' ))
        );

        $this->add_control(
            'main_menu_item_color',
            array(
                'label' => __('Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'jltma_menubar_background',
            array(
                'label' => __('Item Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'main_menu_item_border_color',
            array(
                'label' => __('Border Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'main_menu_item_border_border' => array(
                        'solid',
                        'double',
                        'dotted',
                        'dashed',
                        'groove',
                    ),
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            array(
                'name' => 'main_menu_item_text_shadow',
                'fields_options' => array(
                    'text_shadow_type' => array('label' => __('Text Shadow', 'master-addons' )),
                ),
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a',
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_main_menu_item_hover',
            array('label' => __('Hover', 'master-addons' ))
        );

        $this->add_control(
            'main_menu_item_color_hover',
            array(
                'label' => __('Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li:hover > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li:hover > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a:focus' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'main_menu_item_bg_hover',
            array(
                'label' => __('Item Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li:hover > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li:hover > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a:focus' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'main_menu_item_border_color_hover',
            array(
                'label' => __('Border Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li:hover > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li:hover > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a:focus' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'main_menu_item_border_border' => array(
                        'solid',
                        'double',
                        'dotted',
                        'dashed',
                        'groove',
                    ),
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            array(
                'name' => 'main_menu_item_text_shadow_hover',
                'fields_options' => array(
                    'text_shadow_type' => array('label' => __('Text Shadow', 'master-addons' )),
                ),
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li:hover > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li:hover > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a:focus',
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_main_menu_item_active',
            array('label' => __('Active', 'master-addons' ))
        );

        $this->add_control(
            'main_menu_item_color_active',
            array(
                'label' => __('Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li.current-menu-ancestor > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li.current-menu-ancestor > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li.current-menu-ancestor > a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li.current-menu-ancestor > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li.current-menu-ancestor > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li.current-menu-ancestor > a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li.current-menu-ancestor > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li.current-menu-ancestor > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li.current-menu-ancestor > a:focus' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'main_menu_item_bg_active',
            array(
                'label' => __('Item Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li.current-menu-ancestor > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li.current-menu-ancestor > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li.current-menu-ancestor > a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li.current-menu-ancestor > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li.current-menu-ancestor > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li.current-menu-ancestor > a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li.current-menu-ancestor > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li.current-menu-ancestor > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li.current-menu-ancestor > a:focus' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'main_menu_item_border_color_active',
            array(
                'label' => __('Border Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li.current-menu-ancestor > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li.current-menu-ancestor > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li.current-menu-ancestor > a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li.current-menu-ancestor > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li.current-menu-ancestor > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li.current-menu-ancestor > a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li.current-menu-ancestor > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li.current-menu-ancestor > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li.current-menu-ancestor > a:focus' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'main_menu_item_border_border' => array(
                        'solid',
                        'double',
                        'dotted',
                        'dashed',
                        'groove',
                    ),
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            array(
                'name' => 'main_menu_item_text_shadow_active',
                'fields_options' => array(
                    'text_shadow_type' => array('label' => __('Text Shadow', 'master-addons' )),
                ),
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li.current-menu-ancestor > a,
				{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li.current-menu-ancestor > a:hover,
				{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li.current-menu-ancestor > a:focus,
				{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li.current-menu-ancestor > a,
				{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li.current-menu-ancestor > a:hover,
				{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li.current-menu-ancestor > a:focus,
				{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li.current-menu-ancestor > a,
				{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li.current-menu-ancestor > a:hover,
				{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li.current-menu-ancestor > a:focus',
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'main_menu_hr',
            array(
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            )
        );

        $this->add_responsive_control(
            'main_menu_item_horizontal_padding',
            [
                'label'   => __('Horizontal Padding', 'master-addons' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => ['max' => 50],
                ],
                'devices' => [
                    'desktop',
                    'tablet',
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $widget_selector . '__main .jltma-nav-menu__item-link-top' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['side_menu_alignment!' => 'space-between'],
            ]
        );

        $this->add_responsive_control(
            'main_menu_item_vertical_padding',
            [
                'label'   => __('Vertical Padding', 'master-addons' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => ['max' => 200],
                ],
                'devices' => [
                    'desktop',
                    'tablet',
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition' => ['side_menu_alignment!' => 'space-between'],
            ]
        );

        $this->add_responsive_control(
            'main_menu_item_space_between',
            array(
                'label' => __('Space Between', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array('max' => 100),
                ),
                'devices' => array(
                    'desktop',
                    'tablet',
                ),
                'selectors' => array(
                    'body:not(.rtl) {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal ' . $widget_selector . '__container-inner > li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
                    'body.rtl {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal ' . $widget_selector . '__container-inner > li:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-vertical-type-normal > ul > li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-vertical-type-side > ul > li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ),
                'condition' => array('side_menu_alignment!' => 'space-between'),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'main_menu_item_border',
                'label' => __('Border', 'master-addons' ),
                'exclude' => array('color'),
                'fields_options' => array(
                    'border' => array(
                        'options' => array(
                            'none' => _x('None', 'Border Control', 'master-addons' ),
                            'default' => _x('Default', 'Border Control', 'master-addons' ),
                            'solid' => _x('Solid', 'Border Control', 'master-addons' ),
                            'double' => _x('Double', 'Border Control', 'master-addons' ),
                            'dotted' => _x('Dotted', 'Border Control', 'master-addons' ),
                            'dashed' => _x('Dashed', 'Border Control', 'master-addons' ),
                            'groove' => _x('Groove', 'Border Control', 'master-addons' ),
                        ),
                        'default' => 'default',
                        'prefix_class' => 'jltma-main-menu-item-border-type-',
                        'selectors' => array(
                            '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a,
							{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a,
							{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a' => 'border-style: {{VALUE}};',
                        ),
                    ),
                    'width' => array(
                        'label' => _x('Border Width', 'Border Control', 'master-addons' ),
                        'selectors' => array(
                            '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > a,
							{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul > li > a,
							{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul > li > a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ),
                        'condition' => array(
                            'border!' => array(
                                'none',
                                'default',
                            ),
                        ),
                    ),
                ),
                'conditions' => $menu_first_level,
            )
        );

        $this->add_responsive_control(
            'main_menu_item_border_radius',
            array(
                'label' => __('Border Radius', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px',
                    '%',
                ),
                'devices' => array(
                    'desktop',
                    'tablet',
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main > ul > li > a' => 'border-radius: {{SIZE}}{{UNIT}}',
                ),
                'conditions' => $menu_first_level,
            )
        );

        $this->end_controls_section();
    }

    /**
     * Side Box Section
     */
    protected function jltma_nav_menu_side_box_section()
    {
        $widget_selector = $this->get_widget_selector();

        $this->start_controls_section(
            'section_style_side_box',
            array(
                'label' => __('Side Box', 'master-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'layout' => 'vertical',
                    'vertical_menu_type' => 'side',
                ),
            )
        );

        $this->add_responsive_control(
            'side_box_width',
            array(
                'label' => __('Box Width', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 50,
                        'max' => 500,
                    ),
                    '%' => array(
                        'min' => 1,
                        'max' => 100,
                    ),
                ),
                'size_units' => array(
                    'px',
                    '%',
                ),
                'default' => array(
                    'size' => 100,
                    'unit' => 'px',
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul' => 'width: {{SIZE}}{{UNIT}};',
                    'html.jltma-side-position-right' => 'padding-right: {{SIZE}}{{UNIT}};',
                    'html.jltma-side-position-left' => 'padding-left: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'layout' => 'vertical',
                    'vertical_menu_type' => 'side',
                ),
            )
        );

        $this->add_control(
            'side_box_bg',
            array(
                'label' => __('Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '.jltma-side-content-{{ID}}' . $widget_selector . '__main.jltma-vertical-type-side > ul' => 'background-color: {{VALUE}}',
                ),
                'condition' => array(
                    'layout' => 'vertical',
                    'vertical_menu_type' => 'side',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'side_box_border',
                'label' => __('Side Border', 'master-addons' ),
                'fields_options' => array(
                    'border' => array(
                        'options' => array(
                            'none' => _x('None', 'Border Control', 'master-addons' ),
                            'default' => _x('Default', 'Border Control', 'master-addons' ),
                            'solid' => _x('Solid', 'Border Control', 'master-addons' ),
                            'double' => _x('Double', 'Border Control', 'master-addons' ),
                            'dotted' => _x('Dotted', 'Border Control', 'master-addons' ),
                            'dashed' => _x('Dashed', 'Border Control', 'master-addons' ),
                            'groove' => _x('Groove', 'Border Control', 'master-addons' ),
                        ),
                        'default' => 'default',
                        'prefix_class' => 'jltma-side-box-border-type-',
                    ),
                    'width' => array(
                        'label' => _x('Border Width', 'Border Control', 'master-addons' ),
                        'condition' => array(
                            'border!' => array(
                                'none',
                                'default',
                            ),
                        ),
                    ),
                    'color' => array(
                        'label' => _x('Border Color', 'Border Control', 'master-addons' ),
                        'condition' => array(
                            'border!' => array(
                                'none',
                                'default',
                            ),
                        ),
                    ),
                ),
                'selector' => '.jltma-side-content-{{ID}}' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-side > ul',
                'condition' => array(
                    'layout' => 'vertical',
                    'vertical_menu_type' => 'side',
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_dropdown_toggle_style',
            [
                'label'      => __('Toggle Switch', 'master-addons' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'layout',
                                    'operator' => '=',
                                    'value'    => 'horizontal',
                                ],
                                [
                                    'name'     => 'dropdown_breakpoints',
                                    'operator' => '!==',
                                    'value'    => 'none',
                                ],
                            ],
                        ],
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'layout',
                                    'operator' => '=',
                                    'value'    => 'vertical',
                                ],
                                [
                                    'name'     => 'dropdown_breakpoints',
                                    'operator' => '!==',
                                    'value'    => 'none',
                                ],
                                [
                                    'name'     => 'vertical_menu_type',
                                    'operator' => '!==',
                                    'value'    => 'side',
                                ],
                            ],
                        ],
                        [
                            'name'     => 'layout',
                            'operator' => '=',
                            'value'    => 'dropdown',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'dropdown_toggle_description_style',
            [
                'raw' => __('This toggle will appear on resolutions below the one defined in Breakpoint settings.', 'master-addons' ),
                'type' => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition' => [
                    'layout!' => 'dropdown',
                    'dropdown_breakpoints!' => 'none',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'dropdown_toggle_typography',
                'fields_options' => array(
                    'text_decoration' => array(
                        'selectors' => array(
                            '{{WRAPPER}}' => '--dropdown-toggle-text-decoration: {{VALUE}};',
                        ),
                    ),
                ),
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__toggle',
                'condition' => array('dropdown_toggle_type!' => 'icon'),
            )
        );

        $this->start_controls_tabs('tabs_toggle_item_style');

        $this->start_controls_tab(
            'tab_dropdown_toggle_normal',
            array('label' => __('Normal', 'master-addons' ))
        );

        $this->add_control(
            'dropdown_toggle_color',
            [
                'label'     => __('Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '                               . $widget_selector . '__toggle' => 'color: {{VALUE}}; fill: {{VALUE}};',
                    '{{WRAPPER}}.jltma-toggle-view-framed ' . $widget_selector . '__toggle' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            MA_Group_Control_Button_Background::JLTMA_BTN_BG_GROUP,
            [
                'name'      => 'dropdown_toggle_bg',
                'exclude'   => ['color'],
                'selector'  => '{{WRAPPER}} ' . $widget_selector . '__toggle',
                'condition' => ['toggle_view!' => 'default'],
            ]
        );

        $this->start_injection(array('of' => 'dropdown_toggle_bg_background'));

        $this->add_control(
            'dropdown_toggle_bg_color',
            array(
                'label' => __('Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__toggle' => '--button-bg-color: {{VALUE}}; ' .
                        'background: var( --button-bg-color );',
                ),
                'condition' => array(
                    'dropdown_toggle_bg_background' => array(
                        'color',
                        'gradient',
                    ),
                    'toggle_view!' => 'default',
                ),
            )
        );

        $this->end_injection();

        $this->add_control(
            'dropdown_toggle_bd_color',
            array(
                'label' => __('Border Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}}.jltma-toggle-view-framed ' . $widget_selector . '__toggle' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'toggle_view' => 'framed',
                    'dropdown_toggle_framed_border_style!' => '',
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_toggle_border_radius',
            array(
                'label' => __('Border Radius', 'master-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array(
                    'px',
                    '%',
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'condition' => array('toggle_view!' => 'default'),
            )
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            array(
                'name' => 'dropdown_toggle_text_shadow',
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__toggle-label',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name' => 'dropdown_toggle_box_shadow',
                'selector' => '{{WRAPPER}}.jltma-toggle-view-framed ' . $widget_selector . '__toggle,
					{{WRAPPER}}.jltma-toggle-view-stacked ' . $widget_selector . '__toggle',
                'condition' => array('toggle_view!' => 'default'),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dropdown_toggle_hover',
            array('label' => __('Hover', 'master-addons' ))
        );

        $this->add_control(
            'dropdown_toggle_color_hover',
            array(
                'label' => __('Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__toggle:hover' => 'color: {{VALUE}}; fill: {{VALUE}};',
                    '{{WRAPPER}}.jltma-toggle-view-framed ' . $widget_selector . '__toggle:hover' => 'border-color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            MA_Group_Control_Button_Background::JLTMA_BTN_BG_GROUP,
            array(
                'name' => 'dropdown_toggle_bg_hover',
                'exclude' => array('color'),
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__toggle:hover',
                'condition' => array('toggle_view!' => 'default'),
            )
        );

        $this->start_injection(array('of' => 'dropdown_toggle_bg_hover_background'));

        $this->add_control(
            'dropdown_toggle_bg_color_hover',
            array(
                'label' => __('Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__toggle:hover' => '--button-bg-color: {{VALUE}}; ' .
                        'background: var( --button-bg-color );',
                ),
                'condition' => array(
                    'dropdown_toggle_bg_hover_background' => array(
                        'color',
                        'gradient',
                    ),
                    'toggle_view!' => 'default',
                ),
            )
        );

        $this->end_injection();

        $this->add_control(
            'dropdown_toggle_bd_color_hover',
            array(
                'label' => __('Border Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}}.jltma-toggle-view-framed ' . $widget_selector . '__toggle:hover' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'toggle_view' => 'framed',
                    'dropdown_toggle_framed_border_style!' => '',
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_toggle_border_radius_hover',
            array(
                'label' => __('Border Radius', 'master-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array(
                    'px',
                    '%',
                ),
                'selectors' => array(
                    '{{WRAPPER}}.jltma-toggle-view-framed ' . $widget_selector . '__toggle:hover,
					{{WRAPPER}}.jltma-toggle-view-stacked ' . $widget_selector . '__toggle:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'condition' => array('toggle_view!' => 'default'),
            )
        );

        $this->add_control(
            'dropdown_toggle_text_decoration_hover',
            [
                'label'   => __('Text Decoration', 'master-addons' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''             => __('Default', 'master-addons' ),
                    'none'         => _x('None', 'Typography Control', 'master-addons' ),
                    'underline'    => _x('Underline', 'Typography Control', 'master-addons' ),
                    'overline'     => _x('Overline', 'Typography Control', 'master-addons' ),
                    'line-through' => _x('Line Through', 'Typography Control', 'master-addons' ),
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--dropdown-toggle-hover-text-decoration: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'dropdown_toggle_text_shadow_hover',
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__toggle:hover ' . $widget_selector . '__toggle-label',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name' => 'dropdown_toggle_box_shadow_hover',
                'selector' => '{{WRAPPER}}.jltma-toggle-view-framed ' . $widget_selector . '__toggle:hover,
					{{WRAPPER}}.jltma-toggle-view-stacked ' . $widget_selector . '__toggle:hover',
                'condition' => array('toggle_view!' => 'default'),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dropdown_toggle_active',
            array('label' => __('Active', 'master-addons' ))
        );

        $this->add_control(
            'dropdown_toggle_color_active',
            array(
                'label' => __('Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__toggle.active' => 'color: {{VALUE}}; fill: {{VALUE}};',
                    '{{WRAPPER}}.jltma-toggle-view-framed ' . $widget_selector . '__toggle.active' => 'border-color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            MA_Group_Control_Button_Background::JLTMA_BTN_BG_GROUP,
            array(
                'name' => 'dropdown_toggle_bg_active',
                'exclude' => array('color'),
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__toggle.active',
                'condition' => array('toggle_view!' => 'default'),
            )
        );

        $this->start_injection(array('of' => 'dropdown_toggle_bg_active_background'));

        $this->add_control(
            'dropdown_toggle_bg_color_active',
            array(
                'label' => __('Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__toggle.active' => '--button-bg-color: {{VALUE}}; ' .
                        'background: var( --button-bg-color );',
                ),
                'condition' => array(
                    'dropdown_toggle_bg_active_background' => array(
                        'color',
                        'gradient',
                    ),
                    'toggle_view!' => 'default',
                ),
            )
        );

        $this->end_injection();

        $this->add_control(
            'dropdown_toggle_bd_color_active',
            array(
                'label' => __('Border Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}}.jltma-toggle-view-framed ' . $widget_selector . '__toggle.active' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'toggle_view' => 'framed',
                    'dropdown_toggle_framed_border_style!' => '',
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_toggle_border_radius_active',
            array(
                'label' => __('Border Radius', 'master-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array(
                    'px',
                    '%',
                ),
                'selectors' => array(
                    '{{WRAPPER}}.jltma-toggle-view-framed ' . $widget_selector . '__toggle.active,
					{{WRAPPER}}.jltma-toggle-view-stacked ' . $widget_selector . '__toggle.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'condition' => array('toggle_view!' => 'default'),
            )
        );

        $this->add_control(
            'dropdown_toggle_text_decoration_active',
            array(
                'label' => __('Text Decoration', 'master-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => __('Default', 'master-addons' ),
                    'none' => _x('None', 'Typography Control', 'master-addons' ),
                    'underline' => _x('Underline', 'Typography Control', 'master-addons' ),
                    'overline' => _x('Overline', 'Typography Control', 'master-addons' ),
                    'line-through' => _x('Line Through', 'Typography Control', 'master-addons' ),
                ),
                'selectors' => array(
                    '{{WRAPPER}}' => '--dropdown-toggle-active-text-decoration: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            array(
                'name' => 'dropdown_toggle_text_shadow_active',
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__toggle.active ' . $widget_selector . '__toggle-label',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name' => 'dropdown_toggle_box_shadow_active',
                'selector' => '{{WRAPPER}}.jltma-toggle-view-framed ' . $widget_selector . '__toggle.active,
					{{WRAPPER}}.jltma-toggle-view-stacked ' . $widget_selector . '__toggle.active',
                'condition' => array('toggle_view!' => 'default'),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'dropdown_toggle_hr',
            array(
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            )
        );

        $this->add_responsive_control(
            'dropdown_toggle_icon_size',
            array(
                'label' => __('Icon Size', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range' => array(
                    'px' => array(
                        'min' => 10,
                        'max' => 100,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__toggle i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} ' . $widget_selector . '__toggle svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array('dropdown_toggle_type!' => 'text'),
            )
        );

        $this->add_responsive_control(
            'dropdown_toggle_padding',
            array(
                'label' => __('Padding', 'master-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px'),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'condition' => array(
                    'toggle_view!' => 'default',
                    'toggle_shape' => 'square',
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_toggle_icon_padding',
            array(
                'label' => __('Padding', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 10,
                        'max' => 50,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__toggle' => 'padding: {{SIZE}}{{UNIT}}',
                ),
                'condition' => array(
                    'dropdown_toggle_type' => 'icon',
                    'toggle_view!' => 'default',
                    'toggle_align!' => 'stretch',
                    'toggle_shape' => 'circle',
                ),
            )
        );

        $this->add_control(
            'dropdown_toggle_framed_border_style',
            array(
                'label' => _x('Border Type', 'Border Control', 'master-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => __('None', 'master-addons' ),
                    'default' => __('Default', 'master-addons' ),
                    'solid' => _x('Solid', 'Border Control', 'master-addons' ),
                    'double' => _x('Double', 'Border Control', 'master-addons' ),
                    'dotted' => _x('Dotted', 'Border Control', 'master-addons' ),
                    'dashed' => _x('Dashed', 'Border Control', 'master-addons' ),
                    'groove' => _x('Groove', 'Border Control', 'master-addons' ),
                ),
                'default' => 'default',
                'prefix_class' => 'jltma-dropdown-toggle-border-type-',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__toggle' => 'border-style: {{VALUE}};',
                ),
                'condition' => array('toggle_view' => 'framed'),
            )
        );

        $this->add_responsive_control(
            'dropdown_toggle_framed_border_width',
            array(
                'label' => __('Border Width', 'master-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px'),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__toggle' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'condition' => array(
                    'toggle_view' => 'framed',
                    'dropdown_toggle_framed_border_style!' => array(
                        '',
                        'default',
                    ),
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_popup_offcanvas',
            array(
                'label' => __('Popup / Offcanvas', 'master-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type' => array(
                        'popup',
                        'offcanvas',
                    ),
                ),
            )
        );

        $this->add_control(
            'popup_offcanvas_vertical_alignment',
            array(
                'label' => __('Vertical Alignment', 'master-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'flex-start' => array(
                        'title' => __('Top', 'master-addons' ),
                        'icon' => 'eicon-v-align-top',
                    ),
                    'center' => array(
                        'title' => __('Middle', 'master-addons' ),
                        'icon' => 'eicon-v-align-middle',
                    ),
                    'flex-end' => array(
                        'title' => __('Bottom', 'master-addons' ),
                        'icon' => 'eicon-v-align-bottom',
                    ),
                ),
                'prefix_class' => 'jltma-popup-offcanvas-ver-alignment-',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown.jltma-menu-dropdown-type-popup' => 'align-items: {{VALUE}}',
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown.jltma-menu-dropdown-type-offcanvas' => 'justify-content: {{VALUE}}',
                ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type' => array(
                        'popup',
                        'offcanvas',
                    ),
                ),
            )
        );

        $this->add_responsive_control(
            'popup_offcanvas_vertical_margin',
            array(
                'label' => __('Margin', 'master-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'allowed_dimensions' => 'vertical',
                'placeholder' => array(
                    'top' => '',
                    'right' => 'auto',
                    'bottom' => '',
                    'left' => 'auto',
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown.jltma-menu-dropdown-type-popup > ul,
					{{WRAPPER}} ' . $widget_selector . '__dropdown.jltma-menu-dropdown-type-offcanvas > ul' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
                ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type' => array(
                        'popup',
                        'offcanvas',
                    ),
                    'popup_offcanvas_vertical_alignment!' => 'center',
                ),
            )
        );

        $this->add_control(
            'popup_bg_color',
            array(
                'label' => __('Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown.jltma-menu-dropdown-type-popup,
					{{WRAPPER}} ' . $widget_selector . '__dropdown.jltma-menu-dropdown-type-offcanvas' => 'background-color: {{VALUE}}',
                ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type' => array(
                        'popup',
                        'offcanvas',
                    ),
                ),
            )
        );

        $this->add_control(
            'popup_offcanvas_close_style_heading',
            array(
                'label' => __('Close Button', 'master-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type' => array(
                        'popup',
                        'offcanvas',
                    ),
                ),
            )
        );

        $this->add_control(
            'popup_offcanvas_close_align',
            array(
                'label' => __('Alignment', 'master-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'flex-start' => array(
                        'title' => __('Left', 'master-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ),
                    'center' => array(
                        'title' => __('Center', 'master-addons' ),
                        'icon' => 'eicon-h-align-center',
                    ),
                    'flex-end' => array(
                        'title' => __('Right', 'master-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ),
                ),
                'label_block' => false,
                'default' => 'flex-end',
                'toggle' => false,
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close-container' => 'justify-content: {{VALUE}}',
                ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                ),
            )
        );

        $this->add_responsive_control(
            'close_top_gap',
            array(
                'label' => __('Top Gap', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range' => array(
                    'px' => array(
                        'min' => 10,
                        'max' => 100,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close' => 'margin-top: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array('layout' => 'dropdown'),
            )
        );

        $this->add_responsive_control(
            'close_side_gap',
            array(
                'label' => __('Side Gap', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range' => array(
                    'px' => array(
                        'min' => 10,
                        'max' => 100,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'popup_offcanvas_close_align!' => 'center',
                ),
            )
        );

        $this->start_controls_tabs('tabs_close_style');

        $this->start_controls_tab(
            'tab_close_normal',
            array('label' => __('Normal', 'master-addons' ))
        );

        $this->add_control(
            'close_color',
            array(
                'label' => __('Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close' => 'color: {{VALUE}}',
                    '{{WRAPPER}}.jltma-close-view-framed ' . $widget_selector . '__dropdown-close' => 'border-color: {{VALUE}}',
                ),
                'condition' => array('popup_offcanvas_close_type!' => 'icon'),
            )
        );

        $this->add_control(
            'close_icon_color',
            array(
                'label' => __('Icon Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close svg' => 'fill: {{VALUE}}',
                    '{{WRAPPER}}.jltma-close-view-framed.jltma-close-type-icon ' . $widget_selector . '__dropdown-close' => 'border-color: {{VALUE}}',
                ),
                'condition' => array('popup_offcanvas_close_type!' => 'text'),
            )
        );

        $this->add_control(
            'close_bg_color',
            array(
                'label' => __('Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close' => 'background-color: {{VALUE}}',
                ),
                'condition' => array('popup_close_view!' => 'default'),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_close_hover',
            array('label' => __('Hover', 'master-addons' ))
        );

        $this->add_control(
            'close_color_hover',
            array(
                'label' => __('Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}}.jltma-close-view-framed ' . $widget_selector . '__dropdown-close:hover' => 'border-color: {{VALUE}}',
                ),
                'condition' => array('popup_offcanvas_close_type!' => 'icon'),
            )
        );

        $this->add_control(
            'close_icon_color_hover',
            array(
                'label' => __('Icon Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close:hover > i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close:hover svg' => 'fill: {{VALUE}}',
                    '{{WRAPPER}}.jltma-close-view-framed.jltma-close-type-icon ' . $widget_selector . '__dropdown-close:hover' => 'border-color: {{VALUE}}',
                ),
                'condition' => array('popup_offcanvas_close_type!' => 'text'),
            )
        );

        $this->add_control(
            'close_bg_color_hover',
            array(
                'label' => __('Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close:hover' => 'background-color: {{VALUE}}',
                ),
                'condition' => array('popup_close_view!' => 'default'),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'close_hr',
            array(
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'close_typography',
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__dropdown-close ' . $widget_selector . '__dropdown-close-label',
                'condition' => array(
                    'layout' => 'dropdown',
                    'popup_offcanvas_close_type!' => 'icon',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name' => 'close_box_shadow',
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__dropdown-close',
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                    'popup_close_view!' => 'default',
                ),
            )
        );

        $this->add_responsive_control(
            'close_icon_size',
            array(
                'label' => __('Icon Size', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range' => array(
                    'px' => array(
                        'min' => 10,
                        'max' => 100,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'popup_offcanvas_close_type!' => 'text',
                ),
            )
        );

        $this->add_responsive_control(
            'popup_close_padding',
            array(
                'label' => __('Padding', 'master-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px'),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                    'popup_close_view!' => 'default',
                    'popup_close_shape!' => 'circle',
                ),
            )
        );

        $this->add_responsive_control(
            'popup_close_icon_padding',
            array(
                'label' => __('Padding', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 10,
                        'max' => 50,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close' => 'padding: {{SIZE}}{{UNIT}}',
                ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                    'popup_close_view!' => 'default',
                    'popup_offcanvas_close_type' => 'icon',
                    'popup_close_shape' => 'circle',
                ),
            )
        );

        $this->add_responsive_control(
            'popup_close_framed_border_width',
            array(
                'label' => __('Border Width', 'master-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px'),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                    'popup_close_view' => 'framed',
                ),
            )
        );

        $this->add_responsive_control(
            'close_border_radius',
            array(
                'label' => __('Border Radius', 'master-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array(
                    'px',
                    '%',
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'condition' => array(
                    'layout' => 'dropdown',
                    'dropdown_menu_type!' => 'default',
                    'popup_close_view!' => 'default',
                ),
            )
        );

        $this->end_controls_section();
    }

    /**
     * Dropdown List Section
     */
    protected function jltma_nav_menu_dropdown_list_section()
    {
        $widget_selector = $this->get_widget_selector();

        $this->start_controls_section(
            'section_style_dropdown_list',
            array(
                'label' => __('Dropdown List', 'master-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'dropdown_bg_color',
            array(
                'label' => __('Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_top_distance',
            array(
                'label' => __('Gap from Top', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => -30,
                        'max' => 70,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul > li > ul,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul' => 'margin-top: {{SIZE}}{{UNIT}};',

                    '{{WRAPPER}} ' . $widget_selector . '__main:not(.jltma-layout-dropdown) > ul > li > ul:before' => 'height: {{SIZE}}{{UNIT}}',
                ),
                'conditions' => array(
                    'relation' => 'or',
                    'terms' => array(
                        array(
                            'name' => 'layout',
                            'operator' => '=',
                            'value' => 'horizontal',
                        ),
                        array(
                            'name' => 'layout',
                            'operator' => '=',
                            'value' => 'vertical',
                        ),
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'dropdown',
                                ),
                                array(
                                    'name' => 'dropdown_menu_type',
                                    'operator' => '=',
                                    'value' => 'default',
                                ),
                            ),
                        ),
                    ),
                ),
            )
        );

        $this->add_control(
            'dropdown_horizontal_distance',
            array(
                'label' => __('Horizontal Gap', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'description' => __('Gap between dropdown list columns.', 'master-addons' ),
                'range' => array(
                    'px' => array(
                        'min' => -30,
                        'max' => 70,
                    ),
                ),
                'frontend_available' => true,
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__dropdown ul li ul' => 'left : {{SIZE}}{{UNIT}}',
                ),
                'conditions' => array(
                    'relation' => 'or',
                    'terms' => array(
                        array(
                            'name' => 'layout',
                            'operator' => '!=',
                            'value' => 'horizontal',
                        ),
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'vertical',
                                ),
                                array(
                                    'name' => 'vertical_menu_type',
                                    'operator' => '=',
                                    'value' => 'normal',
                                ),
                            ),
                        ),
                    ),
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'dropdown_border',
                'label'          => __('Border', 'master-addons' ),
                'fields_options' => [
                    'border' => [
                        'options' => [
                            'none'    => _x('None', 'Border Control', 'master-addons' ),
                            'default' => _x('Default', 'Border Control', 'master-addons' ),
                            'solid'   => _x('Solid', 'Border Control', 'master-addons' ),
                            'double'  => _x('Double', 'Border Control', 'master-addons' ),
                            'dotted'  => _x('Dotted', 'Border Control', 'master-addons' ),
                            'dashed'  => _x('Dashed', 'Border Control', 'master-addons' ),
                            'groove'  => _x('Groove', 'Border Control', 'master-addons' ),
                        ],
                        'default'      => 'default',
                        'prefix_class' => 'jltma-dropdown-border-type-',
                        'selectors'    => [
                            '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul,
                            {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul,
                            {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul,
                            {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul,
                            {{WRAPPER}} ' . $widget_selector . '__dropdown:not(.jltma-menu-dropdown-type-offcanvas) > ul ul,
                            {{WRAPPER}} ' . $widget_selector . '__dropdown.jltma-menu-dropdown-type-offcanvas ul ul' => 'border-style: {{VALUE}};',
                        ],
                    ],

                    'width' => [
                        'label'     => _x('Border Width', 'Border Control', 'master-addons' ),
                        'selectors' => array(
                            '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul,
                            {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul,
                            {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul,
                            {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul,
                            {{WRAPPER}} ' . $widget_selector . '__dropdown:not(.jltma-menu-dropdown-type-offcanvas) > ul ul,
                            {{WRAPPER}} ' . $widget_selector . '__dropdown.jltma-menu-dropdown-type-offcanvas ul ul' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ),
                        'condition' => [
                            'border!' => [
                                'none',
                                'default',
                            ],
                        ],
                    ],
                    'color' => [
                        'label'     => _x('Border Color', 'Border Control', 'master-addons' ),
                        'selectors' => array(
                            '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul,
        					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul,
        					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul,
        					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul,
        					{{WRAPPER}} ' . $widget_selector . '__dropdown: not(.jltma-menu-dropdown-type-offcanvas) > ul ul,
        					{{WRAPPER}} ' . $widget_selector . '__dropdown.jltma-menu-dropdown-type-offcanvas ul ul' => 'border-color: {{VALUE}};',
                        ),
                        'condition' => [
                            'border!' => [
                                'none',
                                'default',
                            ],
                        ],
                    ],
                ],
            ]
        );


        $this->add_responsive_control(
            'dropdown_border_radius',
            array(
                'label' => __('Border Radius', 'master-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array(
                    'px',
                    '%',
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__dropdown:not(.jltma-menu-dropdown-type-offcanvas) > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__dropdown.jltma-menu-dropdown-type-offcanvas ul ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_padding',
            array(
                'label' => __('Padding', 'master-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px'),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__dropdown:not(.jltma-menu-dropdown-type-offcanvas) > ul ul' => 'padding-top: {{TOP}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-left: {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name' => 'dropdown_box_shadow',
                'exclude' => array('box_shadow_position'),
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul,
					{{WRAPPER}} ' . $widget_selector . '__dropdown:not(.jltma-menu-dropdown-type-offcanvas) > ul ul',
                'conditions' => array(
                    'relation' => 'or',
                    'terms' => array(
                        array(
                            'name' => 'layout',
                            'operator' => '=',
                            'value' => 'horizontal',
                        ),
                        array(
                            'name' => 'layout',
                            'operator' => '=',
                            'value' => 'vertical',
                        ),
                        array(
                            'relation' => 'and',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'dropdown',
                                ),
                                array(
                                    'name' => 'dropdown_menu_type',
                                    'operator' => '!==',
                                    'value' => 'offcanvas',
                                ),
                            ),
                        ),
                    ),
                ),
            )
        );

        $this->add_control(
            'dropdown_sublevel_heading',
            array(
                'label' => __('Sublevel', 'master-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'dropdown_sublevel_bg',
            array(
                'label' => __('Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal .sub-menu .sub-menu,
                    {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_sublevel_gap',
            array(
                'label' => __('Sublevel list Gap', 'master-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px'),
                'default' => array(
                    'isLinked' => false,
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal .sub-menu .sub-menu,
                    {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();
    }

    /**
     * Dropdown Item Section
     */
    protected function jltma_nav_menu_dropdown_item_section()
    {
        $widget_selector = $this->get_widget_selector();

        $this->start_controls_section(
            'section_style_dropdown_item',
            array(
                'label' => __('Dropdown Item', 'master-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $dropdown_sublevels_level_conditions = array(
            'relation' => 'or',
            'terms' => array(
                array(
                    'name' => 'layout',
                    'operator' => '=',
                    'value' => 'horizontal',
                ),
                array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'layout',
                            'operator' => '=',
                            'value' => 'vertical',
                        ),
                        array(
                            'name' => 'vertical_menu_type',
                            'operator' => '!==',
                            'value' => 'side',
                        ),
                    ),
                ),
                array(
                    'name' => 'layout',
                    'operator' => '=',
                    'value' => 'dropdown',
                ),
            ),
        );

        $this->add_control(
            'dropdown_main_level_heading',
            array(
                'label' => __('Main Level', 'master-addons' ),
                'type' => Controls_Manager::HEADING,
                'conditions' => $dropdown_sublevels_level_conditions,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'dropdown_main_level_typography',
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul a',
            )
        );

        $this->start_controls_tabs('tabs_dropdown_main_level_style');

        $this->start_controls_tab(
            'tab_dropdown_main_level_normal',
            array('label' => __('Normal', 'master-addons' ))
        );

        $this->add_control(
            'dropdown_main_level_color',
            array(
                'label' => __('Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul a' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'dropdown_main_level_bg',
            array(
                'label' => __('Item Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul a' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'dropdown_main_level_border_color',
            array(
                'label' => __('Border Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul a' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'dropdown_main_level_border_border!' => array(
                        'none',
                        'default',
                    ),
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dropdown_main_level_hover',
            array('label' => __('Hover', 'master-addons' ))
        );

        $this->add_control(
            'dropdown_main_level_color_hover',
            array(
                'label' => __('Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul a:focus,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul a:focus' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'dropdown_main_level_bg_hover',
            array(
                'label' => __('Item Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul a:focus,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul a:focus' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'dropdown_main_level_border_color_hover',
            array(
                'label' => __('Border Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul a:focus,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul a:hover,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul a:focus' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'dropdown_main_level_border_border!' => array(
                        'none',
                        'default',
                    ),
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dropdown_main_level_active',
            array('label' => __('Active', 'master-addons' ))
        );

        $this->add_control(
            'dropdown_main_level_color_active',
            array(
                'label' => __('Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a:focus' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'dropdown_main_level_bg_active',
            array(
                'label' => __('Item Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a:focus' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'dropdown_main_level_border_color_active',
            array(
                'label' => __('Border Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a:focus' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'dropdown_main_level_border_border!' => array(
                        'none',
                        'default',
                    ),
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'dropdown_main_level_hr',
            array(
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            )
        );

        $this->add_responsive_control(
            'dropdown_item_main_horizontal_padding',
            array(
                'label' => __('Horizontal Padding', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array('max' => 50),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array('dropdown_align!' => 'center'),
            )
        );

        $this->add_responsive_control(
            'dropdown_item_main_vertical_padding',
            array(
                'label' => __('Vertical Padding', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array('max' => 50),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul a' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_item_space_main_between',
            array(
                'label' => __('Space Between', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array('max' => 50),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li:not(:first-child)' => 'margin-top: calc( {{SIZE}}{{UNIT}} / 2 ); padding-top: calc( {{SIZE}}{{UNIT}} / 2 );',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'dropdown_main_level_border',
                'label' => __('Border', 'master-addons' ),
                'exclude' => array('color'),
                'fields_options' => array(
                    'border' => array(
                        'options' => array(
                            'none' => _x('None', 'Border Control', 'master-addons' ),
                            'default' => _x('Default', 'Border Control', 'master-addons' ),
                            'solid' => _x('Solid', 'Border Control', 'master-addons' ),
                            'double' => _x('Double', 'Border Control', 'master-addons' ),
                            'dotted' => _x('Dotted', 'Border Control', 'master-addons' ),
                            'dashed' => _x('Dashed', 'Border Control', 'master-addons' ),
                            'groove' => _x('Groove', 'Border Control', 'master-addons' ),
                        ),
                        'default' => 'default',
                        'prefix_class' => 'jltma-dropdown-main-level-border-type-',
                        'selectors' => array(
                            '{{WRAPPER}} ' . $widget_selector . '__main .sub-menu li a,
							{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu li a' => 'border-style: {{VALUE}};',
                        ),
                    ),
                    'width' => array(
                        'label' => _x('Border Width', 'Border Control', 'master-addons' ),
                        'selectors' => array(
                            '{{WRAPPER}} ' . $widget_selector . '__main .sub-menu li a,
							{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu li a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ),
                        'condition' => array(
                            'border!' => array(
                                'none',
                                'default',
                            ),
                        ),
                    ),
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_main_level_border_radius',
            array(
                'label' => __('Border Radius', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px',
                    '%',
                ),
                'devices' => array(
                    'desktop',
                    'tablet',
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main .sub-menu li a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu li a' => 'border-radius: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_control(
            'dropdown_sublevels_level_heading',
            array(
                'label' => __('Custom Sublevel Styles', 'master-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'conditions' => $dropdown_sublevels_level_conditions,
            )
        );

        $this->add_control(
            'dropdown_sublevels_description',
            array(
                'raw' => __('Set these settings if you need to override all or some Main Level settings. If set, these style settings will be applied to all sublevel item display layouts, with the exception of:<br>- Normal and Side Types of Vertical Layout and all Horizontal Layouts for desktop appearance;<br>- Side Type of Vertical Layout for minimized appearance.', 'master-addons' ),
                'type' => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'conditions' => $dropdown_sublevels_level_conditions,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'dropdown_typography',
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal .sub-menu .sub-menu a,
                    {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a',
                'conditions' => $dropdown_sublevels_level_conditions,
            )
        );

        $this->start_controls_tabs(
            'tabs_dropdown_item_style',
            array('conditions' => $dropdown_sublevels_level_conditions)
        );

        $this->start_controls_tab(
            'tab_dropdown_item_normal',
            array('label' => __('Normal', 'master-addons' ))
        );

        $this->add_control(
            'dropdown_item_color',
            array(
                'label' => __('Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal .sub-menu .sub-menu a,
                    {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'dropdown_item_bg_color',
            array(
                'label' => __('Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'none',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal .sub-menu .sub-menu a,
                    {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'dropdown_item_border_color',
            array(
                'label' => __('Border Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal .sub-menu .sub-menu a,
                    {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'dropdown_item_border_border!' => array(
                        'none',
                        'default',
                    ),
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dropdown_item_hover',
            array('label' => __('Hover', 'master-addons' ))
        );

        $this->add_control(
            'dropdown_item_color_hover',
            array(
                'label' => __('Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal .sub-menu .sub-menu a:hover,
                    {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a:focus,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a:hover,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a:focus' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'dropdown_item_bg_color_hover',
            array(
                'label' => __('Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'none',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal .sub-menu .sub-menu a:hover,
                    {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a:focus,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a:hover,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a:focus' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'dropdown_item_border_color_hover',
            array(
                'label' => __('Border Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal .sub-menu .sub-menu a:hover,
                    {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a:focus,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a:hover,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a:focus' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'dropdown_item_border_border!' => array(
                        'none',
                        'default',
                    ),
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dropdown_item_active',
            array(
                'label' => __('Active', 'master-addons' ),
            )
        );

        $this->add_control(
            'dropdown_item_color_active',
            array(
                'label' => __('Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul .current-menu-item a,
                    {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a:focus' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'dropdown_item_bg_color_active',
            array(
                'label' => __('Background Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'none',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul .current-menu-item a,
                    {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a:focus' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'dropdown_item_border_color_active',
            array(
                'label' => __('Border Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul .current-menu-item a,
                    {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle > ul ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul .current-menu-item a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul .current-menu-item a:hover,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion > ul ul .current-menu-item a:focus,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a:hover,
					{{WRAPPER}} ' . $widget_selector . '__dropdown > ul ul li.current-menu-item > a:focus' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'dropdown_item_border_border!' => array(
                        'none',
                        'default',
                    ),
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'dropdown_item_horizontal_padding',
            array(
                'label' => __('Horizontal Padding', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array('max' => 50),
                ),
                'separator' => 'before',
                'selectors' => array(
                    '{{WRAPPER}}:not( [class*=" jltma-dropdown-align-"] ) ' . $widget_selector . '__main.jltma-layout-horizontal .sub-menu .sub-menu a,
                    {{WRAPPER}}:not( [class*=" jltma-dropdown-align-"] ) ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a,
					{{WRAPPER}}:not( [class*=" jltma-dropdown-align-"] ) ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a,
					{{WRAPPER}}:not( [class*=" jltma-dropdown-align-"] ) ' . $widget_selector . '__dropdown .sub-menu .sub-menu a,
					{{WRAPPER}}.jltma-dropdown-align-left ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a,
					{{WRAPPER}}.jltma-dropdown-align-left ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a,
					{{WRAPPER}}.jltma-dropdown-align-left ' . $widget_selector . '__dropdown .sub-menu .sub-menu a,
					{{WRAPPER}}.jltma-dropdown-align-space-between.jltma-dropdown-icon-right ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a,
					{{WRAPPER}}.jltma-dropdown-align-space-between.jltma-dropdown-icon-right ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a,
					{{WRAPPER}}.jltma-dropdown-align-space-between.jltma-dropdown-icon-right ' . $widget_selector . '__dropdown .sub-menu .sub-menu a' => 'padding-left: {{SIZE}}{{UNIT}};',

                    '{{WRAPPER}}.jltma-dropdown-align-space-between.jltma-dropdown-icon-left ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a,
					{{WRAPPER}}.jltma-dropdown-align-space-between.jltma-dropdown-icon-left ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a,
					{{WRAPPER}}.jltma-dropdown-align-space-between.jltma-dropdown-icon-left ' . $widget_selector . '__dropdown .sub-menu .sub-menu a,
					{{WRAPPER}}.jltma-dropdown-align-right ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a,
					{{WRAPPER}}.jltma-dropdown-align-right ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a,
					{{WRAPPER}}.jltma-dropdown-align-right ' . $widget_selector . '__dropdown .sub-menu .sub-menu a' => 'padding-right: {{SIZE}}{{UNIT}};',
                ),
                'conditions' => array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'relation' => 'or',
                            'terms' => array(
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'horizontal',
                                ),
                                array(
                                    'relation' => 'and',
                                    'terms' => array(
                                        array(
                                            'name' => 'layout',
                                            'operator' => '=',
                                            'value' => 'vertical',
                                        ),
                                        array(
                                            'name' => 'vertical_menu_type',
                                            'operator' => '!==',
                                            'value' => 'side',
                                        ),
                                    ),
                                ),
                                array(
                                    'name' => 'layout',
                                    'operator' => '=',
                                    'value' => 'dropdown',
                                ),
                            ),
                        ),
                        array(
                            'name' => 'dropdown_align',
                            'operator' => '!==',
                            'value' => 'center',
                        ),
                    ),
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_item_vertical_padding',
            array(
                'label' => __('Vertical Padding', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array('max' => 50),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal .sub-menu .sub-menu a,
                    {{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu .sub-menu a,
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu .sub-menu a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
                ),
                'conditions' => $dropdown_sublevels_level_conditions,
            )
        );

        $this->add_responsive_control(
            'dropdown_item_space_between',
            array(
                'label' => __('Space Between', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array('max' => 50),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__container.jltma-layout-horizontal .sub-menu li:not(:first-child) > ul,
					{{WRAPPER}} ' . $widget_selector . '__container.jltma-layout-vertical.jltma-vertical-type-normal .sub-menu li:not(:first-child) > ul' => 'top: calc( {{SIZE}}{{UNIT}} / 2 );',

                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle .sub-menu li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion .sub-menu li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu li:not(:first-child)' => 'margin-top: calc( {{SIZE}}{{UNIT}} / 2 ); padding-top: calc( {{SIZE}}{{UNIT}} / 2 );',
                ),
                'conditions' => $dropdown_sublevels_level_conditions,
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'dropdown_item_border',
                'label' => __('Border', 'master-addons' ),
                'exclude' => array('color'),
                'fields_options' => array(
                    'border' => array(
                        'options' => array(
                            'none' => _x('None', 'Border Control', 'master-addons' ),
                            'default' => _x('Default', 'Border Control', 'master-addons' ),
                            'solid' => _x('Solid', 'Border Control', 'master-addons' ),
                            'double' => _x('Double', 'Border Control', 'master-addons' ),
                            'dotted' => _x('Dotted', 'Border Control', 'master-addons' ),
                            'dashed' => _x('Dashed', 'Border Control', 'master-addons' ),
                            'groove' => _x('Groove', 'Border Control', 'master-addons' ),
                        ),
                        'default' => 'default',
                        'prefix_class' => 'jltma-dropdown-item-border-type-',
                        'selectors' => array(
                            '{{WRAPPER}} ' . $widget_selector . '__main .sub-menu .sub-menu a,
							{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a' => 'border-style: {{VALUE}};',
                        ),
                    ),
                    'width' => array(
                        'label' => _x('Border Width', 'Border Control', 'master-addons' ),
                        'selectors' => array(
                            '{{WRAPPER}} ' . $widget_selector . '__main .sub-menu .sub-menu a,
							{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ),
                        'condition' => array(
                            'border!' => array(
                                'none',
                                'default',
                            ),
                        ),
                    ),
                ),
                'conditions' => $dropdown_sublevels_level_conditions,
            )
        );

        $this->add_responsive_control(
            'dropdown_item_border_radius',
            array(
                'label' => __('Border Radius', 'master-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array(
                    'px',
                    '%',
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main .sub-menu .sub-menu a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'conditions' => $dropdown_sublevels_level_conditions,
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name' => 'dropdown_item_box_shadow',
                'exclude' => array('box_shadow_position'),
                'selector' => '{{WRAPPER}} ' . $widget_selector . '__main .sub-menu .sub-menu a,
					{{WRAPPER}} ' . $widget_selector . '__dropdown .sub-menu .sub-menu a',
                'conditions' => $dropdown_sublevels_level_conditions,
            )
        );

        $this->add_control(
            'heading_dropdown_divider',
            array(
                'label' => __('Divider', 'master-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'dropdown_divider_type',
            array(
                'label' => __('Divider Type', 'master-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'none' => __('None', 'master-addons' ),
                    'solid' => __('Solid', 'master-addons' ),
                    'double' => __('Double', 'master-addons' ),
                    'doted' => __('Doted', 'master-addons' ),
                    'dashed' => __('Dashed', 'master-addons' ),
                    'groove' => __('Groove', 'master-addons' ),
                ),
                'default' => 'none',
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__dropdown ul ul li:not(:first-child)' => 'border-top-style: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'dropdown_divider_size',
            array(
                'label' => __('Divider Size', 'master-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array('max' => 15),
                ),
                'default' => array('size' => 1),
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__dropdown ul ul li:not(:first-child)' => 'border-top-width: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array('dropdown_divider_type!' => 'none'),
            )
        );

        $this->add_control(
            'dropdown_divider_color',
            array(
                'label' => __('Divider Color', 'master-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-horizontal > ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-normal > ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-toggle ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__main.jltma-layout-vertical.jltma-vertical-type-accordion ul ul li:not(:first-child),
					{{WRAPPER}} ' . $widget_selector . '__dropdown ul ul li:not(:first-child)' => 'border-top-color: {{VALUE}}',
                ),
                'condition' => array('dropdown_divider_type!' => 'none'),
            )
        );

        $this->end_controls_section();
    }

    /**
     * Menu Conditions
     */

    protected function jltma_nav_menu_condition_section()
    {
        $widget_selector = $this->get_widget_selector();

        $conditions = array(
            'relation' => 'or',
            'terms' => array(
                array(
                    'name' => 'layout',
                    'operator' => '=',
                    'value' => 'horizontal',
                ),
                array(
                    'relation' => 'and',
                    'terms' => array(
                        array(
                            'name' => 'layout',
                            'operator' => '=',
                            'value' => 'vertical',
                        ),
                        array(
                            'name' => 'vertical_menu_type',
                            'operator' => '=',
                            'value' => 'normal',
                        ),
                    ),
                ),
            ),
        );

        Animation::register_sections_controls($this, true, $conditions);
    }


    /**
     * Register Nav Menu Controls Section
     */

    protected function register_controls()
    {
        $this->jltma_nav_menu_general_section();
        $this->jltma_nav_menu_dropdown_menu_section();
        $this->jltma_nav_menu_toggle_switch_section();
        $this->jltma_nav_menu_popup_offcanvas_section();

        $this->jltma_nav_menu_item_section();
        $this->jltma_nav_menu_side_box_section();
        $this->jltma_nav_menu_dropdown_list_section();
        $this->jltma_nav_menu_dropdown_item_section();
        $this->jltma_nav_menu_condition_section();

        $this->jltma_nav_menu_help_section();
    }


    /**
     *
     * @return array menus list
     */
    public function get_available_menus()
    {
        $menus = wp_list_pluck(wp_get_nav_menus(), 'name', 'term_id');

        return $menus;
    }

    /**
     *
     * @return menu index
     */
    protected function get_nav_menu_index()
    {
        return $this->nav_menu_index++;
    }


    /**
     *
     * @return array menus item animation class
     */
    public function change_menu_item_css_classes($args, $item, $depth)
    {
        $settings = $this->get_active_settings();

        $layout = $settings['layout'];

        if (
            0 === $depth &&
            ('horizontal' === $layout || ('vertical' === $layout && 'normal' === $settings['vertical_menu_type'])) &&
            'text' !== $settings['pointer']
        ) {
            $args->link_after = '<span class="' . Animation::get_animation_class() . '"></span>';
        }

        return $args;
    }

    /**
     *
     * @return link classes list
     */
    public function get_link_classes($atts, $item, $args, $depth)
    {
        $settings = $this->get_active_settings();

        $classes = ($depth ? $this->get_widget_class() . '__dropdown-item-sub' : $this->get_widget_class() . '__dropdown-item');

        $is_anchor = false !== strpos($atts['href'], '#');

        if (!$is_anchor && in_array('current-menu-item', $item->classes, true)) {
            $classes .= ' ' . $this->get_widget_class() . '__item-active';
        }

        if ($is_anchor) {
            $classes .= ' ' . $this->get_widget_class() . '__item-anchor';
        }

        if (empty($atts['class'])) {
            $atts['class'] = $classes;
        } else {
            $atts['class'] .= ' ' . $classes;
        }

        $item->title = $this->added_span_in_link($item, $depth);

        $indicator_main_animation = $settings['indicator_main_animation'];
        $indicator_submenu_animation = $settings['indicator_submenu_animation'];
        $vertical_menu_type = $settings['vertical_menu_type'];

        if (0 === $depth) {
            $atts['class'] .= ' ' . $this->get_widget_class() . '__item-link-top';

            if (isset($indicator_main_animation) && 'none' !== $indicator_main_animation) {
                $atts['class'] .= ' jltma-arrow-animation-' . $indicator_main_animation;
            }

            if (
                isset($indicator_submenu_animation) &&
                'none' !== $indicator_submenu_animation &&
                'vertical' === $settings['layout'] &&
                ('toggle' === $vertical_menu_type || 'accordion' === $vertical_menu_type)
            ) {
                $atts['class'] .= ' jltma-arrow-animation-' . $indicator_submenu_animation;
            }
        } else {
            $atts['class'] .= ' ' . $this->get_widget_class() . '__item-link-sub';

            if (isset($indicator_submenu_animation) && 'none' !== $indicator_submenu_animation) {
                $atts['class'] .= ' jltma-arrow-animation-' . $indicator_submenu_animation;
            }
        }

        return $atts;
    }


    /**
     *
     * @return added tag span for link
     */
    public function added_span_in_link($item, $depth)
    {
        $settings = $this->get_active_settings();

        $layout = $settings['layout'];
        $pointer_animation_effect = '';
        $vertical_menu_type = $settings['vertical_menu_type'];

        if (
            0 === $depth &&
            ('horizontal' === $layout || ('vertical' === $layout && 'normal' === $vertical_menu_type)) &&
            'text' === $settings['pointer']
        ) {
            $pointer_animation_effect = ' ' . Animation::get_animation_class();
        }

        $new_title = '';

        if ('horizontal' === $layout || ('vertical' === $layout && 'normal' === $vertical_menu_type)) {
            $new_title .= '<span class="' . $this->get_widget_class() . '__main-item-text-wrap' . esc_attr($pointer_animation_effect) . '">' .
                '<span class="' . $this->get_widget_class() . '__main-item-text">';
        }

        $new_title .= $item->title;

        if ('horizontal' === $layout || ('vertical' === $layout && 'normal' === $vertical_menu_type)) {
            $new_title .= '</span></span>';
        }

        return $new_title;
    }

    /**
     *
     * @return sub menu classes list
     */
    public function get_sub_menu_classes($classes)
    {
        $classes[] = $this->get_widget_class() . '__dropdown-submenu';

        return $classes;
    }



    /**
     * Render toggle menu
     *
     * Written in PHP and used to generate the final HTML.
     */
    public function get_toggle()
    {
        $settings = $this->get_active_settings();

        $dropdown_toggle_type = $settings['dropdown_toggle_type'];

        $this->add_render_attribute('toggle-container', 'class', array(
            $this->get_widget_class() . '__toggle-container',
            'jltma-layout-' . esc_attr($settings['layout']),
            'jltma-menu-dropdown-type-' . esc_attr($settings['dropdown_menu_type']),
        ));

        echo '<div ' . $this->get_render_attribute_string('toggle-container') . '>' .
            '<div class="' . $this->get_widget_class() . '__toggle">';

        if ('text' !== $dropdown_toggle_type) {
            $dropdown_toggle_icon = $settings['dropdown_toggle_icon'];

            echo '<span class="jltma-toggle-icon">';

            if ('' !== $dropdown_toggle_icon['value']) {
                Icons_Manager::render_icon($dropdown_toggle_icon);
            } else {
                echo '<i class="eicon-menu-bar"></i>';
            }

            echo '</span>';

            $dropdown_toggle_icon_active = $settings['dropdown_toggle_icon_active'];

            echo '<span class="jltma-toggle-icon-active">';

            if ('' !== $dropdown_toggle_icon_active['value']) {
                Icons_Manager::render_icon($dropdown_toggle_icon_active);
            } else {
                echo '<i class="eicon-close"></i>';
            }

            echo '</span>';
        }

        if ('icon' !== $dropdown_toggle_type) {
            echo '<span class="' . $this->get_widget_class() . '__toggle-label">';

            $dropdown_toggle_text = $settings['dropdown_toggle_text'];

            if ('' !== $dropdown_toggle_text) {
                echo esc_html($dropdown_toggle_text);
            } else {
                echo esc_html__('Menu', 'master-addons' );
            }

            echo '</span>';
        }

        echo '</div>' .
            '</div>';
    }


    /**
     * Render dropdown type menu
     *
     * Written in PHP and used to generate the final HTML.
     */
    public function get_dropdown()
    {
        $settings = $this->get_active_settings();

        $dropdown_menu_type = $settings['dropdown_menu_type'];

        if ('offcanvas' === $dropdown_menu_type) {
            echo '<div class="' . $this->get_widget_class() . '__dropdown-container">';
        }

        $this->get_dropdown_nav();

        if ('offcanvas' === $dropdown_menu_type) {
            echo '</div>';
        }
    }

    /**
     * Render dropdown nav for dropdown type menu
     *
     * Written in PHP and used to generate the final HTML.
     *
     * Fixed the condition for displaying the icon indicator for php 7.4.
     */
    public function get_dropdown_nav()
    {
        $settings                 = $this->get_active_settings();
        $jltma_extensions_setting = jltma_get_options('ma_el_extensions_save_settings');

        $layout                   = $settings['layout'];
        $dropdown_menu_type       = $settings['dropdown_menu_type'];

        $this->add_render_attribute('dropdown-menu', 'class', array(
            $this->get_widget_class() . '__dropdown',
            $this->get_widget_class() . '__container',
            'jltma-layout-' . esc_attr($layout),
            'jltma-menu-dropdown-type-' . esc_attr($dropdown_menu_type),
        ));

        $indicator_submenu_icon = (isset($settings['indicator_submenu']) && '' !== $settings['indicator_submenu']['value'] ? $settings['indicator_submenu']['value'] : '');

        $this->add_render_attribute('dropdown-menu', array('data-icon-sub' => $indicator_submenu_icon));

        $indicator_submenu_animation = $settings['indicator_submenu_animation'];

        if ('none' !== $indicator_submenu_animation) {
            $this->add_render_attribute('dropdown-menu', 'class', 'jltma-arrow-animation-' . $indicator_submenu_animation);
        }

        if ('vertical' === $layout) {
            $this->add_render_attribute('dropdown-menu', 'class', 'jltma-vertical-type-' . esc_attr($settings['vertical_menu_type']));
        }

        echo '<nav ' . $this->get_render_attribute_string('dropdown-menu') . '>';

        if ('offcanvas' === $dropdown_menu_type) {
            $this->get_dropdown_close();
        }

        $args = array(
            'echo'        => false,
            'menu'        => $settings['jltma_nav_menu'],
            'menu_class'  => $this->get_widget_class() . '__container-inner',
            'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb' => '__return_empty_string',
            'container'   => ''
        );
        if (isset($jltma_extensions_setting['mega-menu']) && ($jltma_extensions_setting['mega-menu'] === 1)) {
            $args['walker'] = new JLTMA_Megamenu_Nav_Walker();
        }

        $args['menu_class'] .= ' jltma-nav-menu-dropdown';

        $args['menu_id'] = 'jltma_menu-' . $this->get_nav_menu_index() . '-' . $this->get_id();

        echo wp_nav_menu($args);

        if ('popup' === $dropdown_menu_type) {
            $this->get_dropdown_close();
        }

        echo '</nav>';
    }


    /**
     * Render dropdown close button
     *
     * Written in PHP and used to generate the final HTML.
     *
     */
    public function get_dropdown_close()
    {
        $settings           = $this->get_active_settings();
        $dropdown_menu_type = $settings['dropdown_menu_type'];
        $close_type         = $settings['popup_offcanvas_close_type'];
        $close_text         = $settings['close_text'];

        if ('text' === $close_type && '' === $close_text) {
            return;
        }

        $this->add_render_attribute('dropdown-close-container', 'class', array(
            $this->get_widget_class() . '__dropdown-close-container',
            'jltma-menu-dropdown-type-' . esc_attr($dropdown_menu_type),
        ));

        echo '<div ' . $this->get_render_attribute_string('dropdown-close-container') . '">';
        echo '<div class="' . $this->get_widget_class() . '__dropdown-close">';

        $close_icon = $settings['close_icon'];

        if ('text' !== $close_type) {
            if ('' !== $close_icon['value']) {
                Icons_Manager::render_icon($close_icon);
            } else {
                echo '<i class="eicon-close"></i>';
            }
        }

        if ('icon' !== $close_type) {
            echo '<span class="' . $this->get_widget_class() . '__dropdown-close-label">';

            if ('' !== $close_text) {
                echo esc_html($close_text);
            } else {
                echo esc_html__('Close', 'master-addons' );
            }

            echo '</span>';
        }

        echo '</div>';
        echo '</div>';
    }


    /**
     * Render widget plain content.
     *
     * Save generated HTML to the database as plain content.
     *
     */
    public function render_plain_content()
    {
    }


    protected function render()
    {
        $available_menus          = $this->get_available_menus();
        $jltma_extensions_setting = jltma_get_options('ma_el_extensions_save_settings');

        if (!$available_menus) {
            return;
        }

        $settings = $this->get_active_settings();

        $layout = $settings['layout'];

        $args = array(
            'echo' => false,
            'menu' => $settings['jltma_nav_menu'],
            'menu_class' => $this->get_widget_class() . '__container-inner',
            'menu_id' => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb' => '__return_empty_string',
            'container' => ''
        );
        if (isset($jltma_extensions_setting['mega-menu']) && ($jltma_extensions_setting['mega-menu'] === 1)) {
            $args['walker'] = new JLTMA_Megamenu_Nav_Walker();
        }

        add_filter('nav_menu_link_attributes', array($this, 'get_link_classes'), 10, 4);
        add_filter('nav_menu_item_args', array($this, 'change_menu_item_css_classes'), 10, 3);
        add_filter('nav_menu_submenu_css_class', array($this, 'get_sub_menu_classes'));

        $menu_html = wp_nav_menu($args);

        if (empty($menu_html)) {
            return;
        }

        $args['menu_id'] = ('jltma_menu-' . $this->get_nav_menu_index() . '-' . $this->get_id());

        remove_filter('nav_menu_link_attributes', array($this, 'get_link_classes'));
        remove_filter('nav_menu_item_args', array($this, 'change_menu_item_css_classes'));
        remove_filter('nav_menu_submenu_css_class', array($this, 'get_sub_menu_classes'));

        $vertical_menu_type = $settings['vertical_menu_type'];

        $indicator_main_icon = (isset($settings['indicator_main']) && '' !== $settings['indicator_main']['value'] ? $settings['indicator_main']['value'] : '');
        $indicator_default_icon = (isset($settings['indicator_main_popover']) && '' !== $settings['indicator_main_popover'] ? 'default-main-icon-hide' : '');
        $indicator_default_submenu_icon = (isset($settings['indicator_submenu_popover']) && '' !== $settings['indicator_submenu_popover'] ? 'default-submenu-icon-hide' : '');

        $indicator_submenu_icon = (isset($settings['indicator_submenu']) && '' !== $settings['indicator_submenu']['value'] ? $settings['indicator_submenu']['value'] : '');

        if ('dropdown' !== $layout) {
            $this->add_render_attribute('main-menu', 'class', array(
                $this->get_widget_class() . '__main',
                $this->get_widget_class() . '__container',
                $indicator_default_icon,
                $indicator_default_submenu_icon,
                'jltma-layout-' . esc_attr($layout),
            ));

            if ('horizontal' === $layout || ('vertical' === $layout && 'normal' === $vertical_menu_type)) {
                $this->add_render_attribute('main-menu', 'data-icon-main', $indicator_main_icon);
            } else {
                $this->add_render_attribute('main-menu', 'data-icon-main', $indicator_submenu_icon);
            }

            $this->add_render_attribute('main-menu', 'data-icon-sub', $indicator_submenu_icon);

            if ('vertical' === $layout) {
                $this->add_render_attribute('main-menu', 'class', 'jltma-vertical-type-' . $vertical_menu_type);

                if ('side' === $vertical_menu_type) {
                    $this->add_render_attribute('main-menu', 'class', 'jltma-side-content-' . $this->get_id());
                }

                if ($settings['open_by_click']) {
                    $this->add_render_attribute('main-menu', 'class', 'jltma-nav-menu-open-link');
                }
            }

            echo '<nav ' . $this->get_render_attribute_string('main-menu') . '>' .
                $menu_html .
                '</nav>';
        } else {
            $this->add_render_attribute('main-menu', 'data-icon-main', $indicator_submenu_icon);
            $this->add_render_attribute('main-menu', 'data-icon-sub', $indicator_submenu_icon);
        }

        $this->get_toggle();

        $this->get_dropdown();
    }
}
