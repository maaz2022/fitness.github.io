<?php

namespace MasterAddons\Addons;

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Text_Shadow;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

/**
 * Author Name: Liton Arefin
 * Author URL : https: //jeweltheme.com
 * Date       : 02/04/2020
 */

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Current_Time extends Widget_Base
{

    public function get_name()
    {
        return 'ma-el-current-time';
    }

    public function get_title()
    {
        return esc_html__('Current Time', 'master-addons' );
    }

    public function get_icon()
    {
        return 'jltma-icon eicon-clock-o';
    }

    public function get_categories()
    {
        return ['master-addons'];
    }


    public function get_help_url()
    {
        return 'https://master-addons.com/demos/current-time/';
    }

    protected function register_controls()
    {

        /**
         * Current Time
         */
        $this->start_controls_section(
            'ma_el_current_time_content',
            [
                'label' => esc_html__('General', 'master-addons' ),
            ]
        );

        $this->add_control(
            'ma_el_current_time_type',
            array(
                'label'   => __('Type of time', 'master-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => array(
                    'custom'    => __('Custom', 'master-addons' ),
                    'mysql'     => __('MySql', 'master-addons' ),
                    'timestamp' => __('TimeStamp', 'master-addons' )
                )
            )
        );

        $this->add_control(
            'ma_el_current_time_date_format',
            array(
                'label'       => __('Date Format String', 'master-addons' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => get_option('date_format'),
                'description' => '<span class="pro-feature"> <a href="' . esc_url_raw('https://wordpress.org/support/article/formatting-date-and-time/') . '" target="_blank">Date Time Format Examples </a> </span>',
                'condition'   => array(
                    'ma_el_current_time_type' => array('custom'),
                )
            )
        );

        $this->add_responsive_control(
            'ma_el_current_time_date_alignment',
            array(
                'label'     => __('Alignment', 'master-addons' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => Master_Addons_Helper::jltma_content_alignment(),
                'toggle'    => true,
                'selectors' => array(
                    '{{WRAPPER}}' => 'text-align: {{VALUE}}',
                )
            )
        );

        $this->end_controls_section();


        /*
            * Style for Current Time
            */
        $this->start_controls_section(
            'ma_el_current_time_style',
            array(
                'label' => __('Text', 'master-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'ma_el_current_time_text_color',
            array(
                'label'     => __('Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .jltma-current-time' => 'color: {{VALUE}};',
                )
            )
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            array(
                'name'     => 'ma_el_current_time_text_shadow',
                'label'    => __('Text Shadow', 'master-addons' ),
                'selector' => '{{WRAPPER}} .jltma-current-time',
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'ma_el_current_time_text_typography',
                'scheme'   => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .jltma-current-time'
            )
        );

        $this->end_controls_section();



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
                'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/current-time/" target="_blank" rel="noopener">', '</a>'),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_2',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/current-time/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_3',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=Icwi5ynmzkQ" target="_blank" rel="noopener">', '</a>'),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );
        $this->end_controls_section();



        if (ma_el_fs()->is_not_paying()) {

            $this->start_controls_section(
                'ma_el_section_pro_style_section',
                [
                    'label' => esc_html__('Upgrade to Pro', 'master-addons' )
                ]
            );

            $this->add_control(
                'ma_el_control_get_pro_style_tab',
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

    protected function render()
    {
        $settings          = $this->get_settings_for_display();
        $current_time_type = $settings['ma_el_current_time_type'] === 'custom' ? $settings['ma_el_current_time_date_format'] : $settings['ma_el_current_time_type'];

        echo sprintf(__('<div class="jltma-current-time">%s</div>', 'master-addons' ), current_time(esc_html($current_time_type)));
    }
}
