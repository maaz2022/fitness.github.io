<?php

namespace MasterAddons\Addons;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 6/26/19
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Stack;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Infobox extends Widget_Base
{

	public function get_name()
	{
		return 'jltma-infobox';
	}
	public function get_title()
	{
		return esc_html__('Info Box', 'master-addons' );
	}
	public function get_icon()
	{
		return 'jltma-icon eicon-info-box';
	}
	public function get_categories()
	{
		return ['master-addons'];
	}
	public function get_style_depends()
	{
		return [
			'font-awesome-5-all',
			'font-awesome-4-shim'
		];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/infobox/';
	}

	protected function register_controls()
	{

		/*
			* Master Addons: Infobox Image
			*/
		$this->start_controls_section(
			'ma_el_section_infobox_content',
			[
				'label' => esc_html__('Content', 'master-addons' )
			]
		);


		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {


			$this->add_control(
				'ma_el_infobox_preset',
				[
					'label' => esc_html__('Style Preset', 'master-addons' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'one',
					'options' => [
						'one'           => esc_html__('Variation One', 'master-addons' ),
						'two'           => esc_html__('Variation Two', 'master-addons' ),
						'three'         => esc_html__('Variation Three', 'master-addons' ),
						'four'          => esc_html__('Variation Four', 'master-addons' ),
						'five'          => esc_html__('Variation Five', 'master-addons' ),
						'six'           => esc_html__('Variation Six', 'master-addons' ),
						'seven'         => esc_html__('Variation Seven', 'master-addons' ),
						'eight'         => esc_html__('Variation Eight', 'master-addons' ),
						'nine'          => esc_html__('Variation Nine', 'master-addons' ),
						'ten'           => esc_html__('Variation Ten', 'master-addons' ),
					],
				]
			);


			$this->add_control(
				'ma_el_infobox_gradient_bg_heading',
				[
					'label' => __('Icon Color', 'master-addons' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'after',
					'condition' => [
						'ma_el_infobox_preset' => 'six'
					],

				]
			);



			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'ma_el_infobox_gradient_color_scheme',
					'label' => __('Background Color', 'master-addons' ),
					'types' => ['gradient'],
					'selector' => '{{WRAPPER}} .jltma-infobox.six .jltma-infobox-item .jltma-infobox-icon',
					'condition' => [
						'ma_el_infobox_preset' => 'six'
					],
				]
			);

			//Free Version Codes
		} else {
			$this->add_control(
				'ma_el_infobox_preset',
				[
					'label' => esc_html__('Style Preset', 'master-addons' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'one',
					'options' => [
						'one'           => esc_html__('Variation One', 'master-addons' ),
						'two'           => esc_html__('Variation Two', 'master-addons' ),
						'three'         => esc_html__('Variation Three', 'master-addons' ),
						'four'          => esc_html__('Variation Four', 'master-addons' ),
						'five'          => esc_html__('Variation Five', 'master-addons' ),
						'info-pro-1'    => esc_html__('Variation Six (Pro)', 'master-addons' ),
						'info-pro-2'    => esc_html__('Variation Seven (Pro)', 'master-addons' ),
						'info-pro-3'    => esc_html__('Variation Eight (Pro)', 'master-addons' ),
						'info-pro-4'    => esc_html__('Variation Nine (Pro)', 'master-addons' ),
						'info-pro-5'    => esc_html__('Variation Ten (Pro)', 'master-addons' ),
					],
					'description' => sprintf(
						'5+ more Variations on <a href="%s" target="_blank">%s</a>',
						esc_url_raw(admin_url('admin.php?page=master-addons-settings-pricing')),
						__('Upgrade Now', 'master-addons' )
					)
				]
			);
		}


		$this->add_control(
			'ma_el_infobox_img_or_icon',
			[
				'label' => esc_html__('Image or Icon', 'master-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'none' => [
						'title' => esc_html__('None', 'master-addons' ),
						'icon' => 'eicon-ban',
					],
					'icon' => [
						'title' => esc_html__('Icon', 'master-addons' ),
						'icon' => 'eicon-icon-box',
					],
					'img' => [
						'title' => esc_html__('Image', 'master-addons' ),
						'icon' => 'eicon-image',
					]
				],
				'default' => 'icon',
			]
		);


		$this->add_control(
			'ma_el_infobox_icon',
			[
				'label'         	=> esc_html__('Icon', 'master-addons' ),
				'description' 		=> esc_html__('Please choose an icon from the list.', 'master-addons' ),
				'type'          	=> Controls_Manager::ICONS,
				'fa4compatibility' 	=> 'icon',
				'default'       	=> [
					'value'     => 'fas fa-tag',
					'library'   => 'solid',
				],
				'render_type'      => 'template',
				'condition' => [
					'ma_el_infobox_img_or_icon' => 'icon'
				]
			]
		);

		$this->add_control(
			'ma_el_infobox_image',
			[
				'label' => esc_html__('Image', 'master-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'ma_el_infobox_img_or_icon' => 'img'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'ma_el_infobox_img_or_icon' => 'img'
				]
			]
		);


		$this->add_control(
			'ma_el_infobox_title',
			[
				'label' => esc_html__('Title', 'master-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Infobox Title', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_infobox_title_link',
			[
				'label' => __('Title URL', 'master-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'master-addons' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$this->add_control(
			'ma_el_infobox_description',
			[
				'label' 		=> esc_html__('Description', 'master-addons' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> esc_html__('Basic description about the Infobox', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_infobox_readmore_text',
			[
				'label' 		=> esc_html__('Read More Text', 'master-addons' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'default' 		=> esc_html__('Learn More', 'master-addons' ),
				'condition' 	=> [
					'ma_el_infobox_preset' => 'six'
				]
			]
		);

		$this->add_control(
			'ma_el_infobox_readmore_link',
			[
				'label' 		=> __('Read More Link', 'master-addons' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __('https://master-addons.com/demo', 'master-addons' ),
				'label_block' 	=> true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> true,
				],
				'condition' 	=> [
					'ma_el_infobox_preset' => 'six'
				]
			]
		);

		$this->end_controls_section();



		/*
			* Infobox Styling Section
			*/
		$this->start_controls_section(
			'ma_el_section_infobox_styles_preset',
			[
				'label' => esc_html__('General Styles', 'master-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'info_box_icon_border',
				'label' => __('Box Border', 'master-addons' ),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .jltma-infobox .jltma-infobox-item',
				'label_block' => true,
			]
		);

		$this->add_control(
			'info_box_border_radius',
			[
				'label' => esc_html__('Border Radius', 'master-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'info_box_padding',
			[
				'label'                 => esc_html__('Padding', 'master-addons' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'selectors'         => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'info_box_margin',
			[
				'label'                 => esc_html__('Margin', 'master-addons' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'selectors'         => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'ma_el_infobox_bg_heading',
			[
				'label' => __('Background', 'master-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);


		$this->start_controls_tabs('ma_el_infobox_style');

		$this->start_controls_tab(
			'ma_el_infobox_normal',
			[
				'label'                 => __('Normal', 'master-addons' ),
			]
		);

		// $this->add_control(
		// 	'ma_el_infobox_bg',
		// 	[
		// 		'label'                 => esc_html__('Background Color', 'master-addons' ),
		// 		'type'                  => Controls_Manager::COLOR,
		// 		'default' => '#fff',
		// 		'selectors'	=> [
		// 			'{{WRAPPER}} .jltma-infobox-item' => 'border-color: {{VALUE}}'
		// 		],
		// 	]
		// );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ma_el_infobox_gradient_bg',
				'label' => __('Background', 'master-addons' ),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .jltma-infobox .jltma-infobox-item',

			]
		);


		$this->end_controls_tab();


		$this->start_controls_tab(
			'ma_el_infobox_hover',
			[
				'label'                 => __('Hover', 'master-addons' ),
			]
		);


		// $this->add_control(
		// 	'ma_el_infobox_hover_bg',
		// 	[
		// 		'label'                 => esc_html__('Background Color', 'master-addons' ),
		// 		'type'                  => Controls_Manager::COLOR,
		// 		'selectors'	=> [
		// 			'{{WRAPPER}} .jltma-infobox.four .jltma-infobox-item:hover,
		// 			{{WRAPPER}} .jltma-infobox.five .jltma-infobox-item:hover,
		// 			{{WRAPPER}} .jltma-infobox.seven .jltma-infobox-item:hover,
		// 			{{WRAPPER}} .jltma-infobox.eight .jltma-infobox-item:hover,
		// 			{{WRAPPER}} .jltma-infobox.nine .jltma-infobox-item .jltma-infobox-content,
		// 			{{WRAPPER}} .jltma-infobox.ten .jltma-infobox-item:hover .jltma-infobox-icon' => 'background-color: {{VALUE}};',
		// 			'{{WRAPPER}} .jltma-infobox.ten .jltma-infobox-item:hover .jltma-infobox-icon' => 'border-top-color:{{VALUE}};border-bottom-color:{{VALUE}};',
		// 		],
		// 		'default'               => '#4b00e7',
		// 	]
		// );

		$this->add_control(
			'ma_el_infobox_bg_hover_border_color',
			[
				'label'                 => esc_html__('Border Color', 'master-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors'	=> [
					'{{WRAPPER}} .jltma-infobox-item:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ma_el_infobox_hover_gradient_bg',
				'label' => __('Backgroundß', 'master-addons' ),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .jltma-infobox .jltma-infobox-item:hover',

			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_control(
			'ma_el_infobox_hover_animation',
			[
				'label'        => __('Hover Animation', 'master-addons' ),
				'type'         => Controls_Manager::HOVER_ANIMATION,
				'separator'    => 'before',
				'prefix_class' => 'elementor-animation-',

			]
		);


		$this->end_controls_section();






		// Icon Style
		$this->start_controls_section(
			'section_infobox_icon',
			[
				'label' => __('Icon Style', 'master-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ma_el_infobox_img_or_icon' => 'icon'
				]
			]
		);

		$this->start_controls_tabs('ma_el_infobox_icon_color_style');

		$this->start_controls_tab(
			'ma_el_infobox_icon_color_normal',
			[
				'label'                 => __('Normal', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_infobox_icon_size',
			[
				'label' => __('Icon Size', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item .jltma-infobox-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item .jltma-infobox-icon svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ma_el_infobox_bg_fade_icon_size',
			[
				'label' => __('BG Icon Size', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item .bg-fade-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item .bg-fade-icon svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ma_el_infobox_preset' => 'two',
					'ma_el_infobox_preset' => 'three',
				],
			]
		);

		$this->add_control(
			'ma_el_infobox_icon_color_scheme',
			[
				'label' => __('Icon Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item .jltma-infobox-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item .jltma-infobox-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_infobox_icon_bg_fade_color_scheme',
			[
				'label' => __('BG Icon Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bg-fade-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bg-fade-icon svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'ma_el_infobox_preset' => 'two',
					'ma_el_infobox_preset' => 'three',
				],
			]
		);

		$this->add_control(
			'ma_el_infobox_icon_bg',
			[
				'label'                 => __('Background Color', 'master-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-icon' => 'background-color:{{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_infobox_hexagon_bg',
			[
				'label'                 => __('Haxagon BG', 'master-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .jltma-infobox.eight .jltma-infobox-item .jltma-infobox-icon .jltma-hexagon-shape:before' => 'background-color:{{VALUE}};',
				],
				'condition' => [
					'ma_el_infobox_preset' => 'five',
					'ma_el_infobox_preset' => 'eight',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_infobox_icon_alignment',
			[
				'label'       => esc_html__('Alignment', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => Master_Addons_Helper::jltma_content_alignment(),
				'default'     => 'center',
				'selectors'   => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item .jltma-infobox-icon,
					{{WRAPPER}} .jltma-infobox.eight .jltma-infobox-item' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_infobox_icon_padding',
			[
				'label'         => __('Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_infobox_bg_fade_icon_margin',
			[
				'label'         => __('Margin', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .bg-fade-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'ma_el_infobox_preset' => 'two',
					'ma_el_infobox_preset' => 'three',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ma_el_infobox_icon_hover',
			[
				'label'                 => __('Hover', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_infobox_icon_hover_color_scheme',
			[
				'label' => __('Icon Hover Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item:hover .jltma-infobox-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item:hover .jltma-infobox-icon svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ma_el_infobox_icon_hover_fade_color_scheme',
			[
				'label' => __('Icon Hover Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-infobox-item:hover .bg-fade-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .jltma-infobox-item:hover .bg-fade-icon svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'ma_el_infobox_preset' => 'two',
					'ma_el_infobox_preset' => 'three',
					'ma_el_infobox_preset' => 'six',
				],
			]
		);


		$this->add_control(
			'ma_el_infobox_icon_hover_bg',
			[
				'label'                 => esc_html__('Background Color', 'master-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item:hover .jltma-infobox-icon' => 'background-color:{{VALUE}};',
				]
			]
		);

		$this->add_control(
			'ma_el_infobox_icon_bg_fade_hover_color_scheme',
			[
				'label' => __('BG Icon Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item .bg-fade-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item .bg-fade-icon svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'ma_el_infobox_preset' => 'two',
					'ma_el_infobox_preset' => 'three',
				],
			]
		);

		$this->add_control(
			'ma_el_infobox_hexagon_hover_bg',
			[
				'label'                 => __('Haxagon BG', 'master-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .jltma-infobox-item:hover .jltma-hexagon-shape:before' => 'background-color:{{VALUE}};',
				],
				'condition' => [
					'ma_el_infobox_preset' => 'five',
					'ma_el_infobox_preset' => 'eight'
				],
			]
		);


		$this->add_responsive_control(
			'ma_el_infobox_icon_hover_alignment',
			[
				'label'       => esc_html__('Alignment', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => Master_Addons_Helper::jltma_content_alignment(),
				'default'     => 'center',
				'selectors'   => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item:hover .jltma-infobox-icon' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_infobox_icon_hover_padding',
			[
				'label'         => __('Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-item:hover .jltma-infobox-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();




		$this->end_controls_section();






		// Title , Description Font Color and Typography
		$this->start_controls_section(
			'section_infobox_title',
			[
				'label' => __('Title', 'master-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ma_el_title_typography',
				'selector' => '{{WRAPPER}} .jltma-infobox-content-title',
			]
		);


		$this->start_controls_tabs('ma_el_infobox_title_color_style');

		$this->start_controls_tab(
			'ma_el_infobox_title_color_normal',
			[
				'label'                 => __('Normal', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_title_color',
			[
				'label' => __('Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .jltma-infobox-content-title' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_responsive_control(
			'ma_el_infobox_title_alignment',
			[
				'label' => esc_html__('Alignment', 'master-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => Master_Addons_Helper::jltma_content_alignment(),
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .jltma-infobox-content-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_infobox_title_padding',
			[
				'label'         => __('Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-infobox-content-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ma_el_infobox_title_hover',
			[
				'label'                 => __('Hover', 'master-addons' ),
			]
		);


		$this->add_control(
			'ma_el_infobox_title_color_hover',
			[
				'label' => __('Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-infobox-item:hover .jltma-infobox-content-title' => 'color: {{VALUE}};',

				],
			]
		);


		$this->add_responsive_control(
			'ma_el_infobox_title_hover_alignment',
			[
				'label'       => esc_html__('Alignment', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => Master_Addons_Helper::jltma_content_alignment(),
				'default'     => 'center',
				'selectors'   => [
					'{{WRAPPER}} .jltma-infobox-item:hover .jltma-infobox-content-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_infobox_title_hover_padding',
			[
				'label'         => __('Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-infobox-item:hover .jltma-infobox-content-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();



		// Description Style
		$this->start_controls_section(
			'section_infobox_description',
			[
				'label' => __('Description', 'master-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ma_el_description_typography',
				'selector' => '{{WRAPPER}} .jltma-infobox-content-description',
			]
		);

		$this->start_controls_tabs('ma_el_infobox_desc_color_style');

		$this->start_controls_tab(
			'ma_el_infobox_desc_color_normal',
			[
				'label'                 => __('Normal', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_description_color',
			[
				'label' => __('Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#797c80',
				'selectors' => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-content-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_infobox_desc_alignment',
			[
				'label'       => esc_html__('Alignment', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => Master_Addons_Helper::jltma_content_alignment(),
				'default'     => 'center',
				'selectors'   => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-content-description' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_infobox_desc_padding',
			[
				'label'         => __('Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-infobox .jltma-infobox-content-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'ma_el_infobox_desc_hover',
			[
				'label'                 => __('Hover', 'master-addons' ),
			]
		);


		$this->add_control(
			'ma_el_infobox_desc_color_hover',
			[
				'label' => __('Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-infobox-item:hover .jltma-infobox-content-description' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-infobox.four .jltma-infobox-item:hover .jltma-infobox-content-description,
							{{WRAPPER}} .jltma-infobox.five .jltma-infobox-item:hover .jltma-infobox-content-description,
							{{WRAPPER}} .jltma-infobox.seven .jltma-infobox-item:hover .jltma-infobox-content-description,
							{{WRAPPER}} .jltma-infobox.eight .jltma-infobox-item:hover .jltma-infobox-content-description,
							{{WRAPPER}} .jltma-infobox.nine .jltma-infobox-item:hover .jltma-infobox-content-description' =>
					'color: {{VALUE}};',
				],
			]
		);


		$this->add_responsive_control(
			'ma_el_infobox_desc_hover_alignment',
			[
				'label'       => esc_html__('Alignment', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => Master_Addons_Helper::jltma_content_alignment(),
				'default'     => 'center',
				'selectors'   => [
					'{{WRAPPER}} .jltma-infobox-item:hover .jltma-infobox-content-description' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_infobox_desc_hover_padding',
			[
				'label'         => __('Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-infobox-item:hover .jltma-infobox-content-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/infobox/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/infobox-element/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=2-ymXAZfrF0" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);
		$this->end_controls_section();


		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'ma_el_section_pro_style_section',
				[
					'label' => esc_html__('Upgrade to Pro for More Features', 'master-addons' ),
					'tab' => Controls_Manager::TAB_STYLE
				]
			);

			$this->add_control(
				'ma_el_control_get_pro_style_tab',
				[
					'label' => esc_html__('Unlock more possibilities', 'master-addons' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', 'master-addons' ),
							'icon' => 'fa fa-unlock-alt',
						],
					],
					'default' => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with
Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}
	}
	protected function render()
	{
		$settings = $this->get_settings_for_display();


		// Read more Link
		// if( $settings['ma_el_infobox_readmore_link']['is_external'] ) {
		// 	$this->add_render_attribute( 'ma_el_infobox_readmore', 'target', '_blank' );
		// }

		// if( $settings['ma_el_infobox_readmore_link']['nofollow'] ) {
		// 	$this->add_render_attribute( 'ma_el_infobox_readmore', 'rel', 'nofollow' );
		// }

		if (!empty($settings['ma_el_infobox_readmore_link']['url'])) {
			$this->add_render_attribute('ma_el_infobox_readmore_link', 'href', $settings['ma_el_infobox_readmore_link']['url']);

			if (!empty($settings['ma_el_infobox_readmore_link']['is_external'])) {
				$this->add_render_attribute('ma_el_infobox_readmore_link', 'target', '_blank');
			}

			if ($settings['ma_el_infobox_readmore_link']['nofollow']) {
				$this->add_render_attribute('ma_el_infobox_readmore_link', 'rel', 'nofollow');
			}
		}


		// Infobox Link
		if ($settings['ma_el_infobox_title_link']['is_external']) {
			$this->add_render_attribute('ma_el_infobox_title_link_attr', 'target', '_blank');
		}

		if ($settings['ma_el_infobox_title_link']['nofollow']) {
			$this->add_render_attribute('ma_el_infobox_title_link_attr', 'rel', 'nofollow');
		}


		$infobox_image = $this->get_settings_for_display('ma_el_infobox_image');
		if (!empty($infobox_image['url'])) {
			$infobox_image_url = Group_Control_Image_Size::get_attachment_image_src($infobox_image['id'], 'thumbnail', $settings);

			if (empty($infobox_image_url)) {
				$infobox_image_url = $infobox_image['url'];
			} else {
				$infobox_image_url = $infobox_image_url;
			}
		}


?>

		<div id="jltma-infobox-<?php echo esc_attr($this->get_id()); ?>" class="jltma-infobox <?php echo esc_attr($settings['ma_el_infobox_preset']); ?>">
			<div class="jltma-infobox-item">

				<?php if ($settings['ma_el_infobox_img_or_icon'] != 'none') : ?>

					<?php if ( ($settings['ma_el_infobox_preset'] === "two") || ($settings['ma_el_infobox_preset'] === "three") ) { ?>
						<div class="bg-fade-icon">
							<?php if ('img' == $settings['ma_el_infobox_img_or_icon']) : ?>
								<img src="<?php echo esc_url($infobox_image_url); ?>" alt="<?php echo get_post_meta($infobox_image['id'], '_wp_attachment_image_alt', true); ?>">
							<?php else: ?>
								<?php Master_Addons_Helper::jltma_fa_icon_picker('fas fa-tag', 'icon', $settings['ma_el_infobox_icon'], '', 'ma_el_infobox_icon'); ?>
							<?php endif; ?>
						</div>
					<?php } ?>

					<div class="jltma-infobox-icon <? echo esc_attr(('img' == $settings['ma_el_infobox_img_or_icon']) ? 'image' : ''); ?>">
						
						<div class="jltma-inner-content">

							<?php if ('icon' == $settings['ma_el_infobox_img_or_icon']) { ?>
								<?php Master_Addons_Helper::jltma_fa_icon_picker('fas fa-tag', 'icon', $settings['ma_el_infobox_icon'], '', 'ma_el_infobox_icon'); ?>
							<?php } ?>

							<?php if ('img' == $settings['ma_el_infobox_img_or_icon']) : ?>
								<img src="<?php echo esc_url($infobox_image_url); ?>" alt="<?php echo get_post_meta($infobox_image['id'], '_wp_attachment_image_alt', true); ?>">
							<?php endif; ?>


							<?php if ($settings['ma_el_infobox_preset'] == "nine") { ?>

								<?php if ($settings['ma_el_infobox_title_link']['url']) { ?>
									<a href="<?php echo esc_url_raw($settings['ma_el_infobox_title_link']['url']); ?>" <?php echo $this->get_render_attribute_string('ma_el_infobox_title_link_attr'); ?>>
										<h3 class="jltma-infobox-content-title">
											<?php echo $this->parse_text_editor($settings['ma_el_infobox_title']); ?>
										</h3>
									</a>
								<?php } else { ?>
									<h3 class="jltma-infobox-content-title">
										<?php echo $this->parse_text_editor($settings['ma_el_infobox_title']); ?>
									</h3>
								<?php } ?>

							<?php } ?>

							<?php if ($settings['ma_el_infobox_preset'] == "five" || $settings['ma_el_infobox_preset'] == "eight") { ?>
								<div class="jltma-hexagon-shape">
									<div class="jltma-shape-inner"></div>
								</div>
							<?php } ?>
						</div><!-- /.jltma-inner-content -->
					</div>
				<?php endif; ?>

				<div class="jltma-infobox-content">
					<div class="jltma-inner-content"> 
						<?php if ($settings['ma_el_infobox_title_link']['url']) { ?>
							<a href="<?php echo esc_url_raw($settings['ma_el_infobox_title_link']['url']); ?>" <?php echo $this->get_render_attribute_string('ma_el_infobox_title_link_attr'); ?>>
								<h3 class="jltma-infobox-content-title">
									<?php echo $this->parse_text_editor($settings['ma_el_infobox_title']); ?>
								</h3>
							</a>
						<?php } else { ?>
							<h3 class="jltma-infobox-content-title">
								<?php echo $this->parse_text_editor($settings['ma_el_infobox_title']); ?>
							</h3>
						<?php } ?>

						<p class="jltma-infobox-content-description">
							<?php echo $this->parse_text_editor($settings['ma_el_infobox_description']); ?>
						</p>

						<?php if ($settings['ma_el_infobox_preset'] == "six") { ?>
							<a <?php echo $this->get_render_attribute_string('ma_el_infobox_readmore_link'); ?> class="jltma-btn-learn" <?php echo $this->get_render_attribute_string('ma_el_infobox_readmore'); ?>>
								<?php echo esc_html($settings['ma_el_infobox_readmore_text']); ?>
								<i class="ti-arrow-right"></i>
							</a>
						<?php } ?>
					</div><!-- /.jltma-inner-content -->
				</div>
			</div>
		</div>

<?php
	}
}
