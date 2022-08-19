<?php

namespace MasterAddons\Inc\Traits;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use MasterAddons\Inc\Helper\Master_Addons_Helper;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 7/14/21
 */
if (!defined('ABSPATH')) exit; // If this file is called directly, abort.


trait JLTMA_Swiper_Controls
{

    protected function jltma_tooltip_tab($name){

        $name->add_control(
            'jltma_logo_slider_tooltip_enable',
            [
                'label'              => __('Tooltip', 'master-addons' ),
                'type'               => Controls_Manager::SWITCHER,
                'label_on'           => __('Yes', 'master-addons' ),
                'label_off'          => __('No', 'master-addons' ),
                'return_value'       => 'yes',
            ]
        );

        $name->start_controls_tabs('tooltip_element_settings');

        $name->start_controls_tab('tooltip_element_settings_tab', [
            'label'     => __('Settings', 'master-addons' ),
            'condition' => [
                'jltma_logo_slider_tooltip_enable' => 'yes',
            ],
        ]);

        $name->add_control(
            'jltma_logo_slider_tooltip_text',
            [
                'label'              => esc_html__('Content', 'master-addons' ),
                'type'               => Controls_Manager::TEXTAREA,
                'default'            => __('This is Element Tooltip', 'master-addons' ),
                'dynamic'            => ['active' => true],
                'condition'          => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
                'render_type'        => 'template',
            ]
        );

        $name->add_control(
            'jltma_logo_slider_tooltip_placement',
            [
                'label'   => esc_html__('Placement', 'master-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top'       => esc_html__('Top (Default)', 'master-addons' ),
                    'top-start' => esc_html__('Top Start', 'master-addons' ),
                    'top-end'   => esc_html__('Top End', 'master-addons' ),

                    'right'       => esc_html__('Right', 'master-addons' ),
                    'right-start' => esc_html__('Right Start', 'master-addons' ),
                    'right-end'   => esc_html__('Right End', 'master-addons' ),

                    'bottom'       => esc_html__('Bottom', 'master-addons' ),
                    'bottom-start' => esc_html__('Bottom Start', 'master-addons' ),
                    'bottom-end'   => esc_html__('Bottom End', 'master-addons' ),

                    'left'       => esc_html__('Left', 'master-addons' ),
                    'left-start' => esc_html__('Left Start', 'master-addons' ),
                    'left-end'   => esc_html__('Left End', 'master-addons' ),
                ],
                'render_type'        => 'template',
                'condition'          => [
                    'jltma_logo_slider_tooltip_enable'        => 'yes',
                    'jltma_logo_slider_tooltip_follow_cursor' => ''
                ],
            ]
        );

        $name->add_control(
            'jltma_logo_slider_tooltip_follow_cursor',
            [
                'label'              => esc_html__('Follow Cursor', 'master-addons' ) . JLTMA_NF,
                'type'               => Controls_Manager::SWITCHER,
                'render_type'        => 'template',
                'condition'          => [
                    'jltma_logo_slider_tooltip_enable'               => 'yes',
                ],
            ]
        );


        $name->add_control(
            'jltma_logo_slider_tooltip_animation',
            [
                'label'   => esc_html__('Animation', 'master-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'scale',
                'options' => [
                    'none'         => esc_html__('None', 'master-addons' ),
                    ''             => esc_html__('Fade', 'master-addons' ),
                    'shift-away'   => esc_html__('Shift-Away', 'master-addons' ),
                    'shift-toward' => esc_html__('Shift-Toward', 'master-addons' ),
                    'scale'        => esc_html__('Scale', 'master-addons' ),
                    'perspective'  => esc_html__('Perspective', 'master-addons' ),
                    'fill'         => esc_html__('Fill Effect', 'master-addons' ),
                ],
                'render_type'        => 'template',
                'condition'          => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
            ]
        );


        $name->add_control(
            'jltma_logo_slider_tooltip_trigger',
            [
                'label'   => esc_html__('Trigger', 'master-addons' ) . JLTMA_NF,
                'type'    => Controls_Manager::SELECT,
                'default' => 'mouseenter',
                'options' => [
                    'mouseenter' => esc_html__('Hover', 'master-addons' ),
                    'click'      => esc_html__('Click', 'master-addons' ),
                    // 'manual'     => esc_html__('Custom Trigger', 'master-addons' ),

                ],
                'render_type'        => 'template',
                'condition'          => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
            ]
        );

        $name->add_control(
            'jltma_logo_slider_tooltip_duration',
            [
                'label'              => __('Duration', 'master-addons' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'max'                => 5000,
                'step'               => 10,
                'default'            => 300,
                'condition'          => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
            ]
        );

        $name->add_control(
            'jltma_logo_slider_tooltip_delay',
            [
                'label'              => __('Delay out (s)', 'master-addons' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'max'                => 5000,
                'step'               => 5,
                'default'            => 400,
                'condition'          => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
            ]
        );


        $name->add_control(
            'jltma_logo_slider_tooltip_x_offset',
            [
                'label'              => esc_html__('X Offset', 'master-addons' ),
                'type'               => Controls_Manager::SLIDER,
                'size_units'         => ['px'],
                'range'              => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                ],
                'render_type'        => 'template',
                'condition'          => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
            ]
        );

        $name->add_control(
            'jltma_logo_slider_tooltip_y_offset',
            [
                'label'              => esc_html__('Y Offset', 'master-addons' ),
                'type'               => Controls_Manager::SLIDER,
                'size_units'         => ['px'],
                'range'              => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                ],
                'render_type'        => 'template',
                'condition'          => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
            ]
        );


        $name->add_control(
            'jltma_logo_slider_tooltip_arrow',
            [
                'label'              => esc_html__('Arrow', 'master-addons' ),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => true,
                'render_type'        => 'template',
                'condition'          => [
                    'jltma_logo_slider_tooltip_enable'     => 'yes',
                    'jltma_logo_slider_tooltip_animation!' => 'fill'
                ],
            ]
        );

        $name->add_control(
            'jltma_logo_slider_tooltip_arrow_type',
            [
                'label' => __('Arrow Type', 'master-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'sharp',
                'options' => [
                    'sharp' => __('Sharp', 'master-addons' ),
                    'round' => __('Round', 'master-addons' ),
                ],
                'render_type'        => 'template',
                'condition' => [
                    'jltma_logo_slider_tooltip_enable'     => 'yes',
                    'jltma_logo_slider_tooltip_arrow!' => '',
                ],
            ]
        );


        $name->end_controls_tab();


        $name->start_controls_tab('tooltip_element_style_tab', [
            'label'     => __('Style', 'master-addons' ),
            'condition'    => [
                'jltma_logo_slider_tooltip_enable' => 'yes',
            ],
        ]);

        $name->add_responsive_control(
            'jltma_logo_slider_tooltip_width',
            [
                'label'       => esc_html__('Max Width', 'master-addons' ),
                'type'        => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '350',
                ],
                'size_units'  => [
                    'px',
                    'em',
                ],
                'range'       => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'selectors'          => [
                    '{{CURRENT_ITEM}} .tippy-box' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'condition'   => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
            ]
        );


        $name->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'jltma_logo_slider_tooltip_typography',
                'selector' => '{{CURRENT_ITEM}} .tippy-box',
                'condition' => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
            ]
        );

        $name->add_control(
            'jltma_logo_slider_tooltip_color',
            [
                'label'     => esc_html__('Text Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{CURRENT_ITEM}} .tippy-box .tippy-content' => 'color: {{VALUE}} !important',
                ],
                'condition' => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
            ]
        );

        $name->add_control(
            'jltma_logo_slider_tooltip_background',
            [
                'label'     => __('Background Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{CURRENT_ITEM}} .tippy-box'                                      => 'background-color: {{VALUE}};',
                    '{{CURRENT_ITEM}} .tippy-box[data-placement^=top] .tippy-arrow, {{CURRENT_ITEM}} .tippy-box[data-placement^=bottom] .tippy-arrow, {{CURRENT_ITEM}} .tippy-box[data-placement^=left] .tippy-arrow, {{CURRENT_ITEM}} .tippy-box[data-placement^=right] .tippy-arrow'    => 'color: {{VALUE}};',
                    '{{CURRENT_ITEM}} .tippy-box .tippy-svg-arrow'                    => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
            ]
        );

        $name->add_control(
            'jltma_logo_slider_tooltip_arrow_color',
            [
                'label'     => esc_html__('Arrow Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{CURRENT_ITEM}} .tippy-box[data-placement^=top]>.tippy-arrow:before'    => 'border-top-color: {{VALUE}};',
                    '{{CURRENT_ITEM}} .tippy-box[data-placement^=bottom]>.tippy-arrow:before' => 'border-bottom-color: {{VALUE}};',
                    '{{CURRENT_ITEM}} .tippy-box[data-placement^=left]>.tippy-arrow:before'   => 'border-left-color: {{VALUE}};',
                    '{{CURRENT_ITEM}} .tippy-box[data-placement^=righ]>.tippy-arrow:before'   => 'border-righ-color: {{VALUE}};',
                ],
                'condition' => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
                'separator' => 'after',
            ]
        );

        $name->add_responsive_control(
            'jltma_logo_slider_tooltip_padding',
            [
                'label'      => __('Padding', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{CURRENT_ITEM}} .tippy-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
            ]
        );

        $name->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'jltma_logo_slider_tooltip_border',
                'label'       => esc_html__('Border', 'master-addons' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{CURRENT_ITEM}} .tippy-box',
                'condition'   => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
            ]
        );

        $name->add_responsive_control(
            'jltma_logo_slider_tooltip_border_radius',
            [
                'label'      => __('Border Radius', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{CURRENT_ITEM}} .tippy-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
            ]
        );


        $name->add_control(
            'jltma_logo_slider_tooltip_text_align',
            [
                'label'     => esc_html__('Text Alignment', 'master-addons' ),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'center',
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'master-addons' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'master-addons' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'master-addons' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{CURRENT_ITEM}} .tippy-box .tippy-content' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $name->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'jltma_logo_slider_tooltip_box_shadow',
                'selector' => '{{CURRENT_ITEM}} .tippy-box',
                'condition' => [
                    'jltma_logo_slider_tooltip_enable' => 'yes',
                ],
            ]
        );

        $name->end_controls_tab();

        $name->end_controls_tabs();
    }


    // Controls for Navigation
    protected function jltma_swiper_navigation_controls()
    {
        $this->add_control(
            'navigation',
            [
                'label'        => __('Navigation', 'master-addons' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'arrows',
                'options'      => [
                    'both'            => esc_html__('Arrows and Dots', 'master-addons' ),
                    'arrows-fraction' => esc_html__('Arrows and Fraction', 'master-addons' ),
                    'arrows'          => esc_html__('Arrows', 'master-addons' ),
                    'dots'            => esc_html__('Dots', 'master-addons' ),
                    'progressbar'     => esc_html__('Progress', 'master-addons' ),
                    'none'            => esc_html__('None', 'master-addons' ),
                ],
                'prefix_class' => 'jltma-navigation-type-',
                'render_type'  => 'template',
            ]
        );


        $this->add_control(
            'dynamic_bullets',
            [
                'label'     => __('Dynamic Bullets?', 'master-addons' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'navigation' => ['dots', 'both'],
                ],
            ]
        );

        $this->add_control(
            'show_scrollbar',
            [
                'label' => __('Show Scrollbar?', 'master-addons' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'both_position',
            [
                'label'     => __('Arrows and Dots Position', 'master-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'center',
                'options'   => Master_Addons_Helper::jltma_carousel_navigation_position(),
                'condition' => [
                    'navigation' => 'both',
                ],

            ]
        );

        $this->add_control(
            'arrows_fraction_position',
            [
                'label'     => __('Arrows and Fraction Position', 'master-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'center',
                'options'   => Master_Addons_Helper::jltma_carousel_navigation_position(),
                'condition' => [
                    'navigation' => 'arrows-fraction',
                ],

            ]
        );

        $this->add_control(
            'arrows_position',
            [
                'label'     => __('Arrows Position', 'master-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'center',
                'options'   => Master_Addons_Helper::jltma_carousel_navigation_position(),
                'condition' => [
                    'navigation' => 'arrows',
                ],

            ]
        );

        $this->add_control(
            'arrows_placement',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => __('Placement', 'master-addons' ),
                'default' => 'inside',
                'options' => [
                    'inside'  => __('Inside', 'master-addons' ),
                    'outside' => __('Outside', 'master-addons' ),
                ],
                'condition'        => [
                    'navigation' => 'arrows',
                ]
            ]
        );

        $this->add_control(
            'dots_position',
            [
                'label'     => __('Dots Position', 'master-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'bottom-center',
                'options'   => Master_Addons_Helper::jltma_carousel_pagination_position(),
                'condition' => [
                    'navigation' => 'dots',
                ],

            ]
        );

        $this->add_control(
            'progress_position',
            [
                'label'     => __('Progress Position', 'master-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'bottom',
                'options'   => [
                    'bottom' => esc_html__('Bottom', 'master-addons' ),
                    'top'    => esc_html__('Top', 'master-addons' ),
                ],
                'condition' => [
                    'navigation' => 'progressbar',
                ],

            ]
        );


        // Arrow Icons
        $this->start_controls_tabs('carousel_arrow_controls_tabs');

        // Next Icon Tab
        $this->start_controls_tab(
            'carousel_arrow_next_tab',
            [
                'label'         => __('Next', 'master-addons' ),
                'condition'        => [
                    'navigation' => ['arrows-fraction', 'both', 'arrows'],
                ]

            ]
        );

        $this->add_control(
            'nav_arrows_next_icon',
            [
                'label'            => esc_html__('Next Icon', 'master-addons' ),
                'description'      => esc_html__('Please choose an icon from the list.', 'master-addons' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'eicon-chevron-right',
                    'library' => 'solid',
                ],
                'render_type' => 'template',
                'condition'   => [
                    'navigation' => ['arrows-fraction', 'both', 'arrows'],
                ],
            ]
        );

        $this->end_controls_tab();


        // Previous Icon Tab
        $this->start_controls_tab(
            'carousel_arrow_prev_tab',
            [
                'label'         => __('Previous', 'master-addons' ),
                'condition'        => [
                    'navigation' => ['arrows-fraction', 'both', 'arrows'],
                ]

            ]
        );

        $this->add_control(
            'nav_arrows_prev_icon',
            [
                'label'            => esc_html__('Previous Icon', 'master-addons' ),
                'description'      => esc_html__('Please choose an icon from the list.', 'master-addons' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'eicon-chevron-left',
                    'library' => 'solid',
                ],
                'render_type' => 'template',
                'condition'   => [
                    'navigation' => ['arrows-fraction', 'both', 'arrows'],
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();




        $this->add_control(
            'hide_arrow_on_mobile',
            [
                'label'     => __('Hide Arrow on Mobile', 'master-addons' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'navigation' => ['arrows-fraction', 'arrows', 'both'],
                ],
            ]
        );
    }


    // Controls Settings for Carousel
    protected function jltma_swiper_settings_controls()
    {

        $this->add_control(
            'skin',
            [
                'label'        => esc_html__('Layout', 'master-addons' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'carousel',
                'options'      => [
                    'carousel'  => esc_html__('Carousel', 'master-addons' ),
                    'coverflow' => esc_html__('Coverflow', 'master-addons' ),
                ],
                'prefix_class' => 'jltma-carousel-style-',
                'render_type'  => 'template',
            ]
        );


        $this->add_control(
            'autoheight',
            [
                'type'               => Controls_Manager::SWITCHER,
                'label'              => __('Auto Height', 'master-addons' ),
                'default'            => 'yes',
                'frontend_available' => true
            ]
        );

        $this->add_control(
            'carousel_height',
            [
                'label'         => __('Custom Height', 'master-addons' ),
                'description'    => __('The carousel needs to have a fixed defined height to work in vertical mode.', 'master-addons' ),
                'type'             => Controls_Manager::SLIDER,
                'size_units'     => [
                    'px', '%', 'vh'
                ],
                'default' => [
                    'size' => 500,
                    'unit' => 'px',
                ],
                'range'         => [
                    'px'         => [
                        'min' => 200,
                        'max' => 2000,
                    ],
                    '%'         => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vh'         => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .jltma-swiper__container' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'        => [
                    'autoheight!' => 'yes'
                ],
            ]
        );


        $this->add_control(
            'coverflow_toggle',
            [
                'label'        => __('Coverflow Effect', 'master-addons' ),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition'    => [
                    'skin' => 'coverflow'
                ]
            ]
        );

        $this->start_popover();

        $this->add_control(
            'coverflow_rotate',
            [
                'label'       => esc_html__('Rotate', 'master-addons' ),
                'type'        => Controls_Manager::SLIDER,
                'default'     => [
                    'size' => 50,
                ],
                'range'       => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'condition'   => [
                    'coverflow_toggle' => 'yes'
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'coverflow_stretch',
            [
                'label'       => __('Stretch', 'master-addons' ),
                'type'        => Controls_Manager::SLIDER,
                'default'     => [
                    'size' => 0,
                ],
                'range'       => [
                    'px' => [
                        'min'  => 0,
                        'step' => 10,
                        'max'  => 100,
                    ],
                ],
                'condition'   => [
                    'coverflow_toggle' => 'yes'
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'coverflow_modifier',
            [
                'label'       => __('Modifier', 'master-addons' ),
                'type'        => Controls_Manager::SLIDER,
                'default'     => [
                    'size' => 1,
                ],
                'range'       => [
                    'px' => [
                        'min'  => 1,
                        'step' => 1,
                        'max'  => 10,
                    ],
                ],
                'condition'   => [
                    'coverflow_toggle' => 'yes'
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'coverflow_depth',
            [
                'label'       => __('Depth', 'master-addons' ),
                'type'        => Controls_Manager::SLIDER,
                'default'     => [
                    'size' => 100,
                ],
                'range'       => [
                    'px' => [
                        'min'  => 0,
                        'step' => 10,
                        'max'  => 1000,
                    ],
                ],
                'condition'   => [
                    'coverflow_toggle' => 'yes'
                ],
                'render_type' => 'template',
            ]
        );

        $this->end_popover();

        $this->add_control(
            'hr_005',
            [
                'type'      => Controls_Manager::DIVIDER,
                'condition' => [
                    'skin' => 'coverflow'
                ]
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'   => __('Autoplay', 'master-addons' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'     => esc_html__('Autoplay Speed', 'master-addons' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pauseonhover',
            [
                'label' => esc_html__('Pause on Hover', 'master-addons' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_responsive_control(
            'slides_to_scroll',
            [
                'type'           => Controls_Manager::SELECT,
                'label'          => esc_html__('Slides to Scroll', 'master-addons' ),
                'default'        => 1,
                'tablet_default' => 1,
                'mobile_default' => 1,
                'options'        => [
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                ],
            ]
        );

        $this->add_control(
            'centered_slides',
            [
                'label'       => __('Center Slide', 'master-addons' ),
                'description' => __('Use even items from Layout > Columns settings for better preview.', 'master-addons' ),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'grab_cursor',
            [
                'label' => __('Grab Cursor', 'master-addons' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'free_mode',
            [
                'label' => __('Drag Free Mode', 'master-addons' ) . JLTMA_NEW_FEATURE,
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label'   => __('Loop', 'master-addons' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );


        $this->add_control(
            'speed',
            [
                'label'   => __('Animation Speed (ms)', 'master-addons' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 500,
                ],
                'range' => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 5000,
                        'step' => 50,
                    ],
                ],
            ]
        );

        $this->add_control(
            'observer',
            [
                'label'       => __('Observer', 'master-addons' ),
                'description' => __('When you use carousel in any hidden place (in tabs, accordion etc) keep it yes.', 'master-addons' ),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );
    }


    // Item Style Tab
    protected function jltma_swiper_item_style_controls($name)
    {

        //Style
        $this->start_controls_section(
            'section_style_item',
            [
                'label' => esc_html__('Carousel Items', 'master-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_item_style');

        $this->start_controls_tab(
            'tab_item_normal',
            [
                'label' => esc_html__('Normal', 'master-addons' ),
            ]
        );

        $this->add_control(
            'item_background',
            [
                'label'     => esc_html__('Background', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-swiper__slide' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'item_border',
                'label'       => esc_html__('Border Color', 'master-addons' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-swiper__slide',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-swiper__slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_shadow',
                'selector' => '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-swiper__slide',
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__('Padding', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-swiper__slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item_gap',
            [
                'label'              => esc_html__('Item Gap', 'master-addons' ),
                'type'               => Controls_Manager::SLIDER,
                'default'            => [
                    'size' => 35,
                ],
                'range'              => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'shadow_mode',
            [
                'label'        => esc_html__('Shadow Mode', 'master-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'jltma-shadow-mode-',
            ]
        );

        $this->add_control(
            'shadow_color',
            [
                'label'     => esc_html__('Shadow Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'shadow_mode' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:before' => is_rtl() ? 'background: linear-gradient(to left, {{VALUE}} 5%,rgba(255,255,255,0) 100%);' : 'background: linear-gradient(to right, {{VALUE}} 5%,rgba(255,255,255,0) 100%);',
                    '{{WRAPPER}} .elementor-widget-container:after'  => is_rtl() ? 'background: linear-gradient(to left, rgba(255,255,255,0) 0%, {{VALUE}} 95%);' : 'background: linear-gradient(to right, rgba(255,255,255,0) 0%, {{VALUE}} 95%);',
                ],
            ]
        );

        $this->add_control(
            'item_opacity',
            [
                'label'      => esc_html__('Opacity', 'master-addons' ) . JLTMA_NEW_FEATURE,
                'type'       => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'step' => 0.1,
                        'max'  => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-swiper__slide' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_item_hover',
            [
                'label' => esc_html__('Hover', 'master-addons' ),
            ]
        );

        $this->add_control(
            'item_hover_background',
            [
                'label'     => esc_html__('Background', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-swiper__slide:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'item_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-swiper__slide:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_hover_shadow',
                'selector' => '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-swiper__slide:hover',
            ]
        );

        $this->add_responsive_control(
            'item_shadow_padding',
            [
                'label'       => __('Match Padding', 'master-addons' ),
                'description' => __('You have to add padding for matching overlaping hover shadow', 'master-addons' ),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min'  => 0,
                        'step' => 1,
                        'max'  => 50,
                    ]
                ],
                'default'     => [
                    'size' => 10
                ],
                'selectors'   => [
                    '{{WRAPPER}} .swiper-container' => 'padding: {{SIZE}}{{UNIT}}; margin: 0 -{{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'item_hover_opacity',
            [
                'label'      => esc_html__('Opacity', 'master-addons' ) . JLTMA_NEW_FEATURE,
                'type'       => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'step' => 0.1,
                        'max'  => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-swiper__slide:hover' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_item_active',
            [
                'label' => __('Active', 'master-addons' ) . JLTMA_NEW_FEATURE,
            ]
        );

        $this->add_control(
            'item_active_background',
            [
                'label'     => __('Background', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-swiper__slide.swiper-slide-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_active_border_color',
            [
                'label'     => __('Border Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'item_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-swiper__slide.swiper-slide-active' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_active_shadow',
                'selector' => '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-swiper__slide.swiper-slide-active',
            ]
        );

        $this->add_control(
            'item_active_opacity',
            [
                'label'      => esc_html__('Opacity', 'master-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'step' => 0.1,
                        'max'  => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-swiper__slide.swiper-slide-active' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    // Controls for Navigation
    protected function jltma_swiper_navigation_style_controls($name)
    {

        $this->add_control(
            'arrows_heading',
            [
                'label'     => __('A R R O W S', 'master-addons' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'navigation!' => ['dots', 'progressbar', 'none'],
                ],
            ]
        );

        $this->start_controls_tabs('tabs_navigation_arrows_style');

        $this->start_controls_tab(
            'tabs_nav_arrows_normal',
            [
                'label'     => __('Normal', 'master-addons' ),
                'condition' => [
                    'navigation!' => ['dots', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_control(
            'arrows_color',
            [
                'label'     => __('Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-arrows .jltma-arrow--prev i, {{WRAPPER}} .jltma-arrows .jltma-arrow--next i,{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--prev i, {{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--next i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation!' => ['dots', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_control(
            'arrows_background',
            [
                'label'     => __('Background', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-arrows .jltma-arrow--prev, {{WRAPPER}} .jltma-arrows .jltma-arrow--next,{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--prev, {{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--next' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation!' => ['dots', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'nav_arrows_border',
                'selector'  => '{{WRAPPER}} .jltma-arrows .jltma-arrow--prev, {{WRAPPER}} .jltma-arrows .jltma-arrow--next,{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--prev, {{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--next', 
                'condition' => [
                    'navigation!' => ['dots', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label'      => __('Border Radius', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-arrows .jltma-arrow--prev, {{WRAPPER}} .jltma-arrows .jltma-arrow--next,{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--prev, {{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'navigation!' => ['dots', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_padding',
            [
                'label'      => esc_html__('Padding', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-arrows .jltma-arrow--prev, {{WRAPPER}} .jltma-arrows .jltma-arrow--next,{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--prev, {{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'navigation!' => ['dots', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_size',
            [
                'label'     => __('Size', 'master-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-arrows .jltma-arrow--prev i, {{WRAPPER}} .jltma-arrows .jltma-arrow--next i,{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--prev i, {{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--next i' => 'font-size: {{SIZE || 24}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation!' => ['dots', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_space',
            [
                'label'     => __('Space Between Arrows', 'master-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--prev' => 'margin-right: {{SIZE}}px;',
                    '{{WRAPPER}} .jltma-arrows .jltma-arrow--prev' => 'margin-right: {{SIZE}}px !important;',
                    '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--next' => 'margin-left: {{SIZE}}px;',
                    '{{WRAPPER}} .jltma-arrows .jltma-arrow--next' => 'margin-left: {{SIZE}}px !important;',
                ],
                'condition' => [
                    'navigation!' => ['dots', 'progressbar', 'none'],
                    'arrows_position!' => 'center',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'arrows_box_shadow',
                'selector' => '{{WRAPPER}} .jltma-arrows .jltma-arrow--prev, {{WRAPPER}} .jltma-arrows .jltma-arrow--next,{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--prev, {{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--next',
                'condition' => [
                    'navigation!' => ['dots', 'progressbar', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_nav_arrows_hover',
            [
                'label'     => __('Hover', 'master-addons' ),
                'condition' => [
                    'navigation!' => ['dots', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_control(
            'arrows_hover_color',
            [
                'label'     => __('Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--prev:hover i, {{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--next:hover i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation!' => ['dots', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_control(
            'arrows_hover_background',
            [
                'label'     => __('Background', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--prev:hover, {{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--next:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation!' => ['dots', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_control(
            'nav_arrows_hover_border_color',
            [
                'label'     => __('Border Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--prev:hover, {{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--next:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'nav_arrows_border_border!' => '',
                    'navigation!'               => ['dots', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'arrows_hover_box_shadow',
                'selector' => '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--prev:hover, {{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--next:hover',
                'condition' => [
                    'navigation!' => ['dots', 'progressbar', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'hr_1',
            [
                'type'      => Controls_Manager::DIVIDER,
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_control(
            'dots_heading',
            [
                'label'     => __('D O T S', 'master-addons' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                ],
            ]
        );

        $this->start_controls_tabs('tabs_navigation_dots_style');

        $this->start_controls_tab(
            'tabs_nav_dots_normal',
            [
                'label'     => __('Normal', 'master-addons' ),
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label'     => __('Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_space_between',
            [
                'label'     => __('Space Between', 'master-addons' ) . JLTMA_NEW_FEATURE,
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-bullet' => 'margin:0 {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_size',
            [
                'label'     => __('Size', 'master-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 5,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                    'advanced_dots_size' => ''
                ],
            ]
        );

        $this->add_control(
            'advanced_dots_size',
            [
                'label'     => __('Advanced Size', 'master-addons' ) . JLTMA_NEW_FEATURE,
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_responsive_control(
            'advanced_dots_width',
            [
                'label'     => __('Width(px)', 'master-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                    'advanced_dots_size' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'advanced_dots_height',
            [
                'label'     => __('Height(px)', 'master-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                    'advanced_dots_size' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'advanced_dots_radius',
            [
                'label'      => esc_html__('Border Radius', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                    'advanced_dots_size' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'dots_box_shadow',
                'selector' => '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-bullet',
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_nav_dots_active',
            [
                'label'     => __('Active', 'master-addons' ),
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_control(
            'active_dot_color',
            [
                'label'     => __('Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                ],
            ]
        );

        $this->add_responsive_control(
            'active_dots_size',
            [
                'label'     => __('Size', 'master-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 5,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}' => '--jltma-swiper-dots-active-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                    'advanced_dots_size' => ''
                ],
            ]
        );

        $this->add_responsive_control(
            'active_advanced_dots_width',
            [
                'label'     => __('Width(px)', 'master-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                    'advanced_dots_size' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'active_advanced_dots_height',
            [
                'label'     => __('Height(px)', 'master-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}' => '--jltma-swiper-dots-active-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                    'advanced_dots_size' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'active_advanced_dots_radius',
            [
                'label'      => esc_html__('Border Radius', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-bullet-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                    'advanced_dots_size' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'active_advanced_dots_align',
            [
                'label'   => __('Alignment', 'master-addons' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Top', 'master-addons' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __('Center', 'master-addons' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => __('Bottom', 'master-addons' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    
                    '{{WRAPPER}}' => '--jltma-swiper-dots-align: {{VALUE}};',
                ],
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                    'advanced_dots_size' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'dots_active_box_shadow',
                'selector' => '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-bullet-active',
                'condition' => [
                    'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'hr_2',
            [
                'type'      => Controls_Manager::DIVIDER,
                'condition' => [
                    'navigation' => 'arrows-fraction',
                ],
            ]
        );

        $this->add_control(
            'fraction_heading',
            [
                'label'     => __('F R A C T I O N', 'master-addons' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'navigation' => 'arrows-fraction',
                ],
            ]
        );

        $this->add_control(
            'hr_12',
            [
                'type'      => Controls_Manager::DIVIDER,
                'condition' => [
                    'navigation' => 'arrows-fraction',
                ],
            ]
        );

        $this->add_control(
            'fraction_color',
            [
                'label'     => __('Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-fraction' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation' => 'arrows-fraction',
                ],
            ]
        );

        $this->add_control(
            'active_fraction_color',
            [
                'label'     => __('Active Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-current' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation' => 'arrows-fraction',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'fraction_typography',
                'label'     => esc_html__('Typography', 'master-addons' ),
                'selector'  => '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-fraction',
                'condition' => [
                    'navigation' => 'arrows-fraction',
                ],
            ]
        );

        $this->add_control(
            'hr_3',
            [
                'type'      => Controls_Manager::DIVIDER,
                'condition' => [
                    'navigation' => 'progressbar',
                ],
            ]
        );

        $this->add_control(
            'progresbar_heading',
            [
                'label'     => __('P R O G R E S B A R', 'master-addons' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'navigation' => 'progressbar',
                ],
            ]
        );

        $this->add_control(
            'hr_13',
            [
                'type'      => Controls_Manager::DIVIDER,
                'condition' => [
                    'navigation' => 'progressbar',
                ],
            ]
        );

        $this->add_control(
            'progresbar_color',
            [
                'label'     => __('Bar Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-progressbar' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation' => 'progressbar',
                ],
            ]
        );

        $this->add_control(
            'progres_color',
            [
                'label'     => __('Progress Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-progressbar .swiper-pagination-progressbar-fill' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'navigation' => 'progressbar',
                ],
            ]
        );

        $this->add_control(
            'hr_4',
            [
                'type'      => Controls_Manager::DIVIDER,
                'condition' => [
                    'show_scrollbar' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'scrollbar_heading',
            [
                'label'     => __('S C R O L L B A R', 'master-addons' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'show_scrollbar' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'hr_14',
            [
                'type'      => Controls_Manager::DIVIDER,
                'condition' => [
                    'show_scrollbar' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'scrollbar_color',
            [
                'label'     => __('Bar Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-scrollbar, {{WRAPPER}} .jltma-' . $name . '-wrapper .swiper-scrollbar' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'show_scrollbar' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'scrollbar_drag_color',
            [
                'label'     => __('Drag Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-scrollbar .swiper-scrollbar-drag, {{WRAPPER}} .jltma-' . $name . '-wrapper .swiper-scrollbar .swiper-scrollbar-drag' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'show_scrollbar' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'scrollbar_height',
            [
                'label'     => __('Height', 'master-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-scrollbar, {{WRAPPER}} .jltma-' . $name . '-wrapper .swiper-container-horizontal > .swiper-scrollbar' => 'height: {{SIZE}}px;',
                ],
                'condition' => [
                    'show_scrollbar' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'hr_05',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'navi_offset_heading',
            [
                'label'     => __('O F F S E T', 'master-addons' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'hr_6',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'arrows_ncx_position',
            [
                'label'          => __('Arrows Horizontal Offset', 'master-addons' ),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range'          => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'conditions'     => [
                    'terms' => [
                        [
                            'name'  => 'navigation',
                            'value' => 'arrows',
                        ],
                        [
                            'name'     => 'arrows_position',
                            'operator' => '!=',
                            'value'    => 'center',
                        ],
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--prev,{{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--next' => 'left: {{SIZE}}px;',
                    // '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--next' => 'right: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_ncy_position',
            [
                'label'          => __('Arrows Vertical Offset', 'master-addons' ),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'size' => 40,
                ],
                'tablet_default' => [
                    'size' => 40,
                ],
                'mobile_default' => [
                    'size' => 40,
                ],
                'range'          => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--prev,{{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--next' => 'top: {{SIZE}}px;',
                    // '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--next' => 'bottom: {{SIZE}}px;',
                ],
                'conditions'     => [
                    'terms' => [
                        [
                            'name'  => 'navigation',
                            'value' => 'arrows',
                        ],
                        [
                            'name'     => 'arrows_position',
                            'operator' => '!=',
                            'value'    => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_acx_position',
            [
                'label'      => __('Arrows Horizontal Offset', 'master-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => -60,
                ],
                'range'      => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--prev' => 'left: {{SIZE}}px;',
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--next' => 'right: {{SIZE}}px;',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name'  => 'navigation',
                            'value' => 'arrows',
                        ],
                        [
                            'name'  => 'arrows_position',
                            'value' => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nnx_position',
            [
                'label'          => __('Dots Horizontal Offset', 'master-addons' ),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range'          => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'conditions'     => [
                    'terms' => [
                        [
                            'name'  => 'navigation',
                            'value' => 'dots',
                        ],
                        [
                            'name'     => 'dots_position',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
                'selectors'      => [
                    // '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-bullets' => 'left: {{SIZE}}px;',
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-position-bottom-right,{{WRAPPER}} .jltma-' . $name . '-slider .jltma-position-top-right' => 'right: {{SIZE}}px;',
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-position-bottom-left,{{WRAPPER}} .jltma-' . $name . '-slider .jltma-position-top-left' => 'left: {{SIZE}}px;',
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-position-bottom-center,{{WRAPPER}} .jltma-' . $name . '-slider .jltma-position-top-center' => 'left: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nny_position',
            [
                'label'          => __('Dots Vertical Offset', 'master-addons' ),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'size' => 30,
                ],
                'tablet_default' => [
                    'size' => 30,
                ],
                'mobile_default' => [
                    'size' => 30,
                ],
                'range'          => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'conditions'     => [
                    'terms' => [
                        [
                            'name'  => 'navigation',
                            'value' => 'dots',
                        ],
                        [
                            'name'     => 'dots_position',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-position-top-left,{{WRAPPER}} .jltma-' . $name . '-slider .jltma-position-top-center,{{WRAPPER}} .jltma-' . $name . '-slider .jltma-position-top-right' => 'top:calc(0% - {{SIZE}}px );',
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-position-bottom-left,{{WRAPPER}} .jltma-' . $name . '-slider .jltma-position-bottom-center,{{WRAPPER}} .jltma-' . $name . '-slider .jltma-position-bottom-right' => 'bottom:calc(0% - {{SIZE}}px );',
                ],
            ]
        );

        $this->add_responsive_control(
            'both_ncx_position',
            [
                'label'          => __('Arrows & Dots Horizontal Offset', 'master-addons' ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['%', 'px'],
                'default'        => [
                    'size' => '',
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'range'          => [
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'conditions'     => [
                    'terms' => [
                        [
                            'name'  => 'navigation',
                            'value' => 'both',
                        ],
                        [
                            'name'     => 'both_position',
                            'operator' => '!=',
                            'value'    => 'center',
                        ],
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .jltma-position-bottom-right,
                    {{WRAPPER}} .jltma-position-top-right' => 'right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jltma-position-bottom-left,
                    {{WRAPPER}} .jltma-position-top-left' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'both_ncy_position',
            [
                'label'          => __('Arrows & Dots Vertical Offset', 'master-addons' ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['%', 'px'],
                'default'        => [
                    'size' => '',
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'range'          => [
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'conditions'     => [
                    'terms' => [
                        [
                            'name'  => 'navigation',
                            'value' => 'both',
                        ],
                        [
                            'name'     => 'both_position',
                            'operator' => '!=',
                            'value'    => 'center',
                        ],
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .jltma-position-bottom-right,
                    {{WRAPPER}} .jltma-position-bottom-left' => 'bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .jltma-position-top-right,
                    {{WRAPPER}} .jltma-position-top-left' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'both_cx_position',
            [
                'label'      => __('Arrows Offset', 'master-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => -60,
                ],
                'range'      => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--prev, {{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--prev' => 'margin-left: {{SIZE}}px;',
                    '{{WRAPPER}} .jltma-' . $name . '-wrapper .jltma-arrows .jltma-arrow--next, {{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--next' => 'margin-right: {{SIZE}}px;',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name'  => 'navigation',
                            'value' => 'both',
                        ],
                        [
                            'name'  => 'both_position',
                            'value' => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'both_cy_position',
            [
                'label'      => __('Dots Offset', 'master-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 30,
                ],
                'range'      => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-' . $name . ' .jltma-dots-container' => 'transform: translateY({{SIZE}}px);',
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .swiper-pagination-bullets' => 'top:calc(100% + {{SIZE}}px);',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name'  => 'navigation',
                            'value' => 'both',
                        ],
                        [
                            'name'  => 'both_position',
                            'value' => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_fraction_ncx_position',
            [
                'label'          => __('Arrows & Fraction Horizontal Offset', 'master-addons' ),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range'          => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'conditions'     => [
                    'terms' => [
                        [
                            'name'  => 'navigation',
                            'value' => 'arrows-fraction',
                        ],
                        [
                            'name'     => 'arrows_fraction_position',
                            'operator' => '!=',
                            'value'    => 'center',
                        ],
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}}' => '--jltma-' . $name . '-arrows-fraction-ncx: {{SIZE}}px;'
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_fraction_ncy_position',
            [
                'label'          => __('Arrows & Fraction Vertical Offset', 'master-addons' ),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'size' => 40,
                ],
                'tablet_default' => [
                    'size' => 40,
                ],
                'mobile_default' => [
                    'size' => 40,
                ],
                'range'          => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'conditions'     => [
                    'terms' => [
                        [
                            'name'  => 'navigation',
                            'value' => 'arrows-fraction',
                        ],
                        [
                            'name'     => 'arrows_fraction_position',
                            'operator' => '!=',
                            'value'    => 'center',
                        ],
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}}' => '--jltma-' . $name . '-arrows-fraction-ncy: {{SIZE}}px;'
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_fraction_cx_position',
            [
                'label'      => __('Arrows Offset', 'master-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => -60,
                ],
                'range'      => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--prev' => 'margin-left: {{SIZE}}px;',
                    '{{WRAPPER}} .jltma-' . $name . '-slider .jltma-arrows .jltma-arrow--next' => 'margin-right: {{SIZE}}px;',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name'  => 'navigation',
                            'value' => 'arrows-fraction',
                        ],
                        [
                            'name'  => 'arrows_fraction_position',
                            'value' => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_fraction_cy_position',
            [
                'label'      => __('Fraction Offset', 'master-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 30,
                ],
                'range'      => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-fraction' => 'transform: translateY({{SIZE}}px);',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name'  => 'navigation',
                            'value' => 'arrows-fraction',
                        ],
                        [
                            'name'  => 'arrows_fraction_position',
                            'value' => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'progress_y_position',
            [
                'label'     => __('Progress Offset', 'master-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 15,
                ],
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-' . $name . '-slider .swiper-pagination-progressbar' => 'transform: translateY({{SIZE}}px);',
                ],
                'condition' => [
                    'navigation' => 'progressbar',
                ],
            ]
        );

        $this->add_responsive_control(
            'scrollbar_vertical_offset',
            [
                'label'     => __('Scrollbar Offset', 'master-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-scrollbar, {{WRAPPER}} .jltma-' . $name . ' .swiper-container-horizontal > .swiper-scrollbar' => 'top: {{SIZE}}px;',
                ],
                'condition' => [
                    'show_scrollbar' => 'yes'
                ],
            ]
        );
    }


    // Swiper Header Attributes
    public function jltma_render_swiper_header_attribute($name)
    {
        $id = 'jltma-' . $name . '-' . $this->get_id();
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('carousel', 'id', $id);

        $elementor_vp_lg = get_option('elementor_viewport_lg');
        $elementor_vp_md = get_option('elementor_viewport_md');
        $viewport_lg = !empty($elementor_vp_lg) ? $elementor_vp_lg - 1 : 1023;
        $viewport_md = !empty($elementor_vp_md) ? $elementor_vp_md - 1 : 767;


        if ('arrows' == $settings['navigation']) {
            $this->add_render_attribute('carousel', 'class', 'jltma-arrows-align-' . esc_attr($settings['arrows_position']));
        } elseif ('dots' == $settings['navigation']) {
            $this->add_render_attribute('carousel', 'class', 'jltma-dots-align-' . esc_attr($settings['dots_position']));
        } elseif ('both' == $settings['navigation']) {
            $this->add_render_attribute('carousel', 'class', 'jltma-arrows-dots-align-' . esc_attr($settings['both_position']));
        } elseif ('arrows-fraction' == $settings['navigation']) {
            $this->add_render_attribute('carousel', 'class', 'jltma-arrows-dots-align-' . esc_attr($settings['arrows_fraction_position']));
        }

        if ('arrows-fraction' == $settings['navigation']) {
            $pagination_type = 'fraction';
        } elseif ('both' == $settings['navigation'] or 'dots' == $settings['navigation']) {
            $pagination_type = 'bullets';
        } elseif ('progressbar' == $settings['navigation']) {
            $pagination_type = 'progressbar';
        } else {
            $pagination_type = '';
        }

        $this->add_render_attribute(
            [
                'carousel' => [
                    'data-settings' => [
                        wp_json_encode(array_filter([
                            "autoplay"        => ("yes" == $settings["autoplay"]) ? ["delay" => $settings["autoplay_speed"]] : false,
                            "loop"            => ($settings["loop"] == "yes") ? true : false,
                            "speed"           => $settings["speed"]["size"],
                            "pauseOnHover"    => ("yes" == $settings["pauseonhover"]) ? true : false,
                            "slidesPerView"   => isset($settings["columns_mobile"]) ? (int)$settings["columns_mobile"] : 1,
                            "slidesPerGroup"  => isset($settings["slides_to_scroll_mobile"]) ? (int)$settings["slides_to_scroll_mobile"] : 1,
                            "spaceBetween"    => $settings["item_gap"]["size"],
                            "centeredSlides"  => ($settings["centered_slides"] === "yes") ? true : false,
                            "grabCursor"      => ($settings["grab_cursor"] === "yes") ? true : false,
                            "freeMode"        => ($settings["free_mode"] === "yes") ? true : false,
                            "effect"          => $settings["skin"],
                            "observer"        => ($settings["observer"]) ? true : false,
                            "observeParents" => ($settings["observer"]) ? true : false,
                            "breakpoints"     => [
                                (int)$viewport_md => [
                                    "slidesPerView"  => isset($settings["columns_tablet"]) ? (int)$settings["columns_tablet"] : 2,
                                    "spaceBetween"   => $settings["item_gap"]["size"],
                                    "slidesPerGroup" => isset($settings["slides_to_scroll_tablet"]) ? (int)$settings["slides_to_scroll_tablet"] : 1,
                                ],
                                (int)$viewport_lg => [
                                    "slidesPerView"  => isset($settings["columns"]) ? (int)$settings["columns"] : 3,
                                    "spaceBetween"   => $settings["item_gap"]["size"],
                                    "slidesPerGroup" => isset($settings["slides_to_scroll"]) ? (int)$settings["slides_to_scroll"] : 1,
                                ]
                            ],
                            "navigation"      => [
                                "nextEl" => "#" . $id . " .jltma-arrow--next",
                                "prevEl" => "#" . $id . " .jltma-arrow--prev",
                            ],
                            "pagination"      => [
                                "el"             => "#" . $id . " .swiper-pagination",
                                "type"           => $pagination_type,
                                "clickable"      => "true",
                                'dynamicBullets' => ("yes" == $settings["dynamic_bullets"]) ? true : false,
                            ],
                            "scrollbar"       => [
                                "el"   => "#" . $id . " .swiper-scrollbar",
                                "hide" => "true",
                            ],
                            'coverflowEffect' => [
                                'rotate'       => ("yes" == $settings["coverflow_toggle"]) ? $settings["coverflow_rotate"]["size"] : 50,
                                'stretch'      => ("yes" == $settings["coverflow_toggle"]) ? $settings["coverflow_stretch"]["size"] : 0,
                                'depth'        => ("yes" == $settings["coverflow_toggle"]) ? $settings["coverflow_depth"]["size"] : 100,
                                'modifier'     => ("yes" == $settings["coverflow_toggle"]) ? $settings["coverflow_modifier"]["size"] : 1,
                                'slideShadows' => true,
                            ],

                        ]))
                    ]
                ]
            ]
        );
    }


    // Render Navigation
    public function render_swiper_navigation()
    {

        $settings = $this->get_settings_for_display();
        $hide_arrow_on_mobile = $settings['hide_arrow_on_mobile'] ? 'jltma-visible-mobile' : '';

        $this->add_render_attribute([
            'navigation' => [
                'class' => [
                    'jltma-arrows',
                    'jltma-swiper__navigation',
                ],
                'id' => 'jltma-arrows-' . $this->get_id(),
            ],
        ]);


        if (!empty($settings['arrows_position'])) {
            $this->add_render_attribute(
                [
                    'navigation' => [
                        'class' => [
                            'jltma-swiper__navigation--' . esc_attr($settings['arrows_placement']),
                            'jltma-swiper__navigation--' . esc_attr($settings['arrows_position'])
                        ]
                    ]
                ]
            );
        }

        if ('both' !== $settings['navigation'] or 'arrows-fraction' !== $settings['navigation']) {
            $this->add_render_attribute('navigation', 'class', [
                'jltma-swiper__pagination',
                'jltma-swiper__pagination--' . esc_attr($settings['navigation']),
                'jltma-position-z-index',
                'jltma-swiper__pagination-' . $this->get_id(),
                // 'swiper-pagination',
                $hide_arrow_on_mobile
            ]);
        }


        // Dots
        if ('dots' == $settings['navigation']) {
            $this->add_render_attribute('navigation', 'class', [
                'jltma-position-' . esc_attr($settings['dots_position']),
                'swiper-pagination'
            ]);
        }

        // Fraction
        if ('arrows-fraction' == $settings['navigation']) {
            $this->add_render_attribute('navigation', 'class', [
                'jltma-position-' . esc_attr($settings['arrows_fraction_position']),
            ]);
        }

        // Progressbar
        if ('progressbar' == $settings['navigation']) {
            $this->add_render_attribute('navigation', 'class', [
                'jltma-position-' . esc_attr($settings['progress_position']),
                'swiper-pagination'
            ]);
        }

?>
        <div <?php echo $this->get_render_attribute_string('navigation'); ?>>
            <?php if ('arrows' == $settings['navigation']) { ?>
                <?php $this->render_swiper_arrows(); ?>
            <?php } elseif ('both' == $settings['navigation']) {
                $this->jltma_render_both_navigation();
            } elseif ('arrows-fraction' == $settings['navigation']) {
                $this->render_swiper_arrows();
                $this->jltma_render_arrows_fraction();
            }
            ?>
        </div>

    <?php
    }

    protected function render_swiper_arrows()
    {
        $settings = $this->get_settings_for_display();
        $prev = is_rtl() ? 'right' : 'left';
        $next = is_rtl() ? 'left' : 'right';
        $prev_icon = !empty($settings['nav_arrows_prev_icon']['value']) ? ($settings['nav_arrows_prev_icon']['value']) : ('eicon-chevron-' . $prev);
        $next_icon = !empty($settings['nav_arrows_next_icon']['value']) ? ($settings['nav_arrows_next_icon']['value']) : ('eicon-chevron-' . $next);

        $this->add_render_attribute([
            'button-prev' => [
                'class' => [
                    'jltma-swiper__button',
                    'jltma-swiper__button--prev',
                    'jltma-arrow',
                    'jltma-arrow--prev',
                    'jltma-swiper__button--prev-' . $this->get_id(),
                ],
            ],
            'button-prev-icon' => [
                'class' => $prev_icon,
            ],
            'button-next' => [
                'class' => [
                    'jltma-swiper__button',
                    'jltma-swiper__button--next',
                    'jltma-arrow',
                    'jltma-arrow--next',
                    'jltma-swiper__button--next-' . $this->get_id(),
                ],
            ],
            'button-next-icon' => [
                'class' => $next_icon,
            ],
        ]);
    ?>
        <div <?php echo $this->get_render_attribute_string('button-prev'); ?>>
            <i <?php echo $this->get_render_attribute_string('button-prev-icon'); ?>></i>
        </div>
        <div <?php echo $this->get_render_attribute_string('button-next'); ?>>
            <i <?php echo $this->get_render_attribute_string('button-next-icon'); ?>></i>
        </div>
        <?php
    }


    public function render_swiper_pagination()
    {
        $settings = $this->get_settings_for_display();

        if ('dots' == $settings['navigation'] or 'arrows-fraction' == $settings['navigation']) {
            $this->add_render_attribute('pagination', 'class', [
                'jltma-position-' . esc_attr($settings['dots_position'])
            ]);
        ?>
            <div <?php echo $this->get_render_attribute_string('pagination'); ?>></div>

        <?php } elseif ('progressbar' == $settings['navigation']) {

            $this->add_render_attribute('pagination', 'class', [
                'jltma-position-' . esc_attr($settings['progress_position']),
            ]);
        ?>
            <div <?php echo $this->get_render_attribute_string('pagination'); ?>></div>
        <?php
        }
    }


    // Render both Arrow and Dots Navigation
    public function jltma_render_both_navigation()
    {
        $settings = $this->get_settings_for_display();
        $hide_arrow_on_mobile = $settings['hide_arrow_on_mobile'] ? 'jltma-visible-mobile' : '';

        $this->add_render_attribute('both_nagivation', 'class', [
            'jltma-carousel-both-navigation',
            'jltma-position-' . esc_attr($settings['both_position']),
            $hide_arrow_on_mobile
        ]);

        ?>
        <div <?php echo $this->get_render_attribute_string('both_nagivation'); ?>>
            <?php $this->render_swiper_arrows(); ?>
            <div class="swiper-pagination"></div>
        </div>
    <?php
    }


    // Controls for Navigation
    public function jltma_render_arrows_fraction()
    { ?>
        <div class="swiper-pagination"></div>
<?php
    }
}
