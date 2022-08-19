<?php

namespace MasterAddons\Addons;

/**
 * Author Name: Liton Arefin
 * Author URL : https: //jeweltheme.com
 * Date       : 6/27/19
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Countdown_Timer extends Widget_Base
{
	public function get_name()
	{
		return 'ma-el-countdown-timer';
	}
	public function get_title()
	{
		return esc_html__('Countdown Timer', 'master-addons' );
	}
	public function get_icon()
	{
		return 'jltma-icon eicon-countdown';
	}
	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_script_depends()
	{
		return ['master-addons-countdown'];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/countdown-timer/';
	}


	protected function register_controls()
	{

		/**
		 * Master Addons: Countdown Timer Settings
		 */
		$this->start_controls_section(
			'ma_el_section_countdown_settings_general',
			[
				'label' => esc_html__('Timer Settings', 'master-addons' )
			]
		);

		$this->add_control(
			'ma_el_countdown_style',
			[
				'label'   => esc_html__('Style', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'block'         => esc_html__('Block', 'master-addons' ),
					'inline'        => esc_html__('Inline', 'master-addons' ),
					'block-table'   => esc_html__('Block Table', 'master-addons' ),
					'inline-table+' => esc_html__('Inline Table', 'master-addons' ),
				],
			]
		);


		$this->add_control(
			'ma_el_countdown_time',
			[
				'label'       => esc_html__('Countdown Date & Time', 'master-addons' ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => date("Y/m/d", strtotime("+ 52 week")),
				'description' => esc_html__('Set Datetime here', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_seperator',
			array(
				'label'   => __('Seperator', 'master-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '/'
			)
		);


		$this->add_control(
			'ma_el_show_year',
			array(
				'label'        => __('Display Years', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('On', 'master-addons' ),
				'label_off'    => __('Off', 'master-addons' ),
				'return_value' => '1',
				'default'      => '1'
			)
		);

		$this->add_control(
			'ma_el_show_month',
			array(
				'label'        => __('Display Month', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('On', 'master-addons' ),
				'label_off'    => __('Off', 'master-addons' ),
				'return_value' => '1',
				'default'      => '1'
			)
		);

		$this->add_control(
			'ma_el_show_day',
			array(
				'label'        => __('Display Days', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('On', 'master-addons' ),
				'label_off'    => __('Off', 'master-addons' ),
				'return_value' => '1',
				'default'      => '1'
			)
		);

		$this->add_control(
			'ma_el_show_hour',
			array(
				'label'        => __('Display Hours', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('On', 'master-addons' ),
				'label_off'    => __('Off', 'master-addons' ),
				'return_value' => '1',
				'default'      => '1'
			)
		);

		$this->add_control(
			'ma_el_show_min',
			array(
				'label'        => __('Display Mintues', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('On', 'master-addons' ),
				'label_off'    => __('Off', 'master-addons' ),
				'return_value' => '1',
				'default'      => '1'
			)
		);

		$this->add_control(
			'ma_el_show_sec',
			array(
				'label'        => __('Display Seconds', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('On', 'master-addons' ),
				'label_off'    => __('Off', 'master-addons' ),
				'return_value' => '1',
				'default'      => '1'
			)
		);


		$this->add_responsive_control(
			'ma_el_countdown_alignment',
			[
				'label'       => esc_html__('Alignment', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => Master_Addons_Helper::jltma_content_alignment(),
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .jltma-widget-countdown .jltma-countdown-wrapper.jltma-countdown-block' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();


		/*
			 * Countdown Timer Styling Section
			 */

		$this->start_controls_section(
			'ma_el_section_countdown_item_wrapper',
			[
				'label' => esc_html__('Item Wrapper', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'ma_el_section_item_wrapper_background',
				'label'    => __('Background', 'master-addons' ),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-item'
			]
		);


		$this->add_responsive_control(
			'ma_el_item_wrapper_border_radius',
			array(
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				)
			)
		);

		$this->add_responsive_control(
			'ma_el_item_wrapper_margin',
			array(
				'label'      => __('Margin', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				)
			)
		);

		$this->add_responsive_control(
			'ma_el_item_wrapper_padding',
			array(
				'label'      => __('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				)
			)
		);

		$this->end_controls_section();


		/*
			* Value Style
			*/

		$this->start_controls_section(
			'ma_el_value_style_section',
			array(
				'label' => __('Value', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			)
		);

		$this->start_controls_tabs('ma_el_value_colors');

		$this->start_controls_tab(
			'ma_el_value_color_normal',
			array(
				'label' => __('Normal', 'master-addons' ),
			)
		);

		$this->add_control(
			'ma_el_value_color',
			array(
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-value' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ma_el_value_color_hover',
			array(
				'label' => __('Hover', 'master-addons' ),
			)
		);

		$this->add_control(
			'ma_el_value_hover_color',
			array(
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-value:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ma_el_value_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-value',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'ma_el_value_shadow',
				'label'    => __('Text Shadow', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-value',
			]
		);

		$this->end_controls_section();


		/*
			* Separator Style
			*/


		$this->start_controls_section(
			'ma_el_seperator_style_section',
			array(
				'label' => __('Seperator', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			)
		);

		$this->start_controls_tabs('ma_el_seperator_colors');

		$this->start_controls_tab(
			'ma_el_seperator_color_normal',
			array(
				'label' => __('Normal', 'master-addons' ),
			)
		);

		$this->add_control(
			'ma_el_seperator_color',
			array(
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-seperator' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ma_el_seperator_color_hover',
			array(
				'label' => __('Hover', 'master-addons' ),
			)
		);

		$this->add_control(
			'ma_el_seperator_hover_color',
			array(
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-seperator:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ma_el_seperator_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-seperator',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'ma_el_seperator_shadow',
				'label'    => __('Text Shadow', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-seperator',
			]
		);

		$this->add_responsive_control(
			'ma_el_seperator_padding',
			array(
				'label'      => __('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-countdown-wrapper.jltma-countdown-inline .jltma-countdown-seperator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'   => array(
					'ma_el_countdown_style' => ['inline']
				)
			)
		);

		$this->add_responsive_control(
			'ma_el_seperator_margin',
			array(
				'label'      => __('Margin', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-seperator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				)
			)
		);

		$this->end_controls_section();








		/*
			* Box Style
			*/


		$this->start_controls_section(
			'ma_el_section_countdown_box_style',
			[
				'label'     => esc_html__('Box Style', 'master-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ma_el_countdown_preset' => 'block',
				],
			]
		);



		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ma_el_countdown_background',
				'label'     => __('Background', 'master-addons' ),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .jltma-countdown.block .jltma-countdown-container',
				'condition' => [
					'ma_el_countdown_preset' => 'block',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'box_shadow',
				'label'     => __('Box Shadow', 'master-addons' ),
				'selector'  => '{{WRAPPER}} .jltma-countdown-container',
				'condition' => [
					'ma_el_countdown_preset' => 'block',
				],
			]
		);

		$this->add_control(
			'ma_el_before_border',
			[
				'type'      => Controls_Manager::DIVIDER,
				'style'     => 'thin',
				'condition' => [
					'ma_el_countdown_preset' => 'block',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'border',
				'label'     => __('Border', 'master-addons' ),
				'selector'  => '{{WRAPPER}} .jltma-countdown.block .jltma-countdown-container',
				'condition' => [
					'ma_el_countdown_preset' => 'style-1',
				],
			]
		);

		$this->add_control(
			'ma_el_countdown_image_border_radius',
			[
				'label'     => esc_html__('Border Radius', 'master-addons' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .jltma-countdown.style-1 .jltma-countdown-container' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'default' => [
					'top'      => 4,
					'right'    => 4,
					'bottom'   => 4,
					'left'     => 4,
					'unit'     => 'px',
					'isLinked' => true,
				],
				'condition' => [
					'ma_el_countdown_preset' => 'style-1',
				],
			]
		);


		$this->end_controls_section();

		// Counter Styles

		$this->start_controls_section(
			'ma_el_section_countdown_styles_counter',
			[
				'label' => esc_html__('Counter Style', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'counter_typography',
				'selector' => '{{WRAPPER}} .jltma-countdown-count',
			]
		);

		$this->add_control(
			'ma_el_progress_bar_count_color',
			[
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .jltma-countdown-count' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();






		$this->start_controls_section(
			'ma_el_title_style_section',
			array(
				'label' => __('Title', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			)
		);

		$this->start_controls_tabs('ma_el_title_colors');

		$this->start_controls_tab(
			'ma_el_title_color_normal',
			array(
				'label' => __('Normal', 'master-addons' ),
			)
		);

		$this->add_control(
			'ma_el_title_color',
			array(
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-title' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ma_el_title_color_hover',
			array(
				'label' => __('Hover', 'master-addons' ),
			)
		);

		$this->add_control(
			'ma_el_title_hover_color',
			array(
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-title:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ma_el_title_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-title',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'ma_el_title_shadow',
				'label'    => __('Text Shadow', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-title',
			]
		);

		$this->add_responsive_control(
			'ma_el_title_margin',
			array(
				'label'      => __('Margin', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-countdown-wrapper .jltma-countdown-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				)
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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/countdown-timer/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/count-down-timer/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=1lIbOLM9C1I" target="_blank" rel="noopener">', '</a>'),
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





	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$countdown_style = $settings['ma_el_countdown_style'];
		$countdown_time  = $settings['ma_el_countdown_time'];
		$seperator       = $settings['ma_el_seperator'];
		$show_year       = $settings['ma_el_show_year'];
		$show_month      = $settings['ma_el_show_month'];
		$show_day        = $settings['ma_el_show_day'];
		$show_hour       = $settings['ma_el_show_hour'];
		$show_min        = $settings['ma_el_show_min'];
		$show_sec        = $settings['ma_el_show_sec'];

		$data_value  = '';
		$attr_markup = '';
		$date_attr   = array();
		$data_attr   = '';

		$datetime = explode(" ", $countdown_time);

		$date = $datetime[0];
		$time = !empty($datetime[1]) ? $datetime[1] : '';

		$date = explode("-", $date);
		$time = explode(":", $time);


		$date_attr = array(
			'year' => array(
				'value' => $date[0],
				// 'value'   => explode("-", $countdown_time)[0],
				'display' => $show_year,
				'title'   => __('Years', 'master-addons' ),
			),
			'month' => array(
				'value' => !empty($date[1]) ? $date[1] - 1 : '',
				// 'value'   => explode("-", $countdown_time)[1],
				'display' => $show_month,
				'title'   => __('Months', 'master-addons' ),
			),
			'day' => array(
				'value' => !empty($date[2]) ? $date[2] : '',
				// 'value'   => explode("-", $countdown_time)[2],
				'display' => !empty($show_day) ? $show_day : '',
				'title'   => __('Days', 'master-addons' ),
			),
			'hour' => array(
				'value'   => !empty($time[0]) ? $time[0] : '',
				'display' => !empty($show_hour) ? $show_hour : '',
				'title'   => __('Hours', 'master-addons' ),
			),
			'min' => array(
				'value'   => !empty($time[1]) ? $time[1] : '',
				'display' => !empty($show_min) ? $show_min : '',
				'title'   => 'Mintues'
			),
			'sec' => array(
				'value'   => !empty($time[1]) ? $time[1] : '',
				'display' => !empty($show_sec) ? $show_sec : '',
				'title'   => 'Seconds'
			),
		);

		foreach ($date_attr as $attr => $key) {

			$this->add_render_attribute(
				'jltma_countdown_keys',
				[
					'data-countdown-' . $attr      => $key['value'],
				]
			);

			if ($key['display']) {
				$attr_markup .= '<div class="jltma-countdown-item">';
				$attr_markup .= '<span class="jltma-countdown-value jltma-countdown-' . esc_attr($attr) . '">' . __('0', 'master-addons' ) . '</span>';
				$attr_markup .= ('inline' === $countdown_style || 'inline-table' === $countdown_style) && !empty($seperator) ? '<span class="jltma-countdown-seperator">' . esc_attr($seperator) . '</span>' : '';
				$attr_markup .= '<span class="jltma-countdown-title">' . esc_html($key['title']) . '</span>';
				$attr_markup .= '</div>';
				$attr_markup .= ('block' === $countdown_style || 'block-table' === $countdown_style) &&  'sec' !== $attr ? '<span class="jltma-countdown-seperator">' . esc_attr($seperator) . '</span>' : '';
			}
		}

		$this->add_render_attribute(
			'ma_el_countdown_timer',
			[
				'class'    => [
					'jltma-countdown-wrapper',
					'jltma-countdown',
					'jltma-countdown-' . esc_attr($countdown_style),
				],
				'id' => 'jltma-countdown-' . esc_attr($this->get_id()),
			]
		);

		$output = '<section class="widget-container jltma-widget-countdown"><div ' . $this->get_render_attribute_string('ma_el_countdown_timer')  . ' ' . $this->get_render_attribute_string('jltma_countdown_keys')  . '>';
		$output .= $attr_markup;
		$output .= '</div></section>';

		echo wp_kses_post($output);
	}
}
