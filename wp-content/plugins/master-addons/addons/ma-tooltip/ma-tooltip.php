<?php

namespace MasterAddons\Addons;

use \Elementor\Widget_Base;
use \Elementor\Utils;
use \Elementor\Icons_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Tooltip extends Widget_Base
{

	public function get_name()
	{
		return 'ma-tooltip';
	}

	public function get_title()
	{
		return esc_html__('Tooltip', 'master-addons' );
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-tools';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_keywords()
	{
		return ['tooltip', 'tooltips', 'image tooltips', 'icon tooltip', 'icons', 'hover content', 'content'];
	}

	public function get_script_depends()
	{
		return [
			'jltma-popper',
			'jltma-tippy',
			'font-awesome-4-shim'
		];
	}
	public function get_style_depends()
	{
		return [
			'jltma-tippy',
			'font-awesome-5-all',
			'font-awesome-4-shim'
		];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/tooltip/';
	}


	protected function register_controls()
	{

		$this->start_controls_section(
			'tooltip_button_content',
			[
				'label' => __('Content Settings', 'master-addons' ),
			]
		);


		$this->add_control(
			'ma_el_tooltip_type',
			[
				'label'       => esc_html__('Content Type', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options'     => [
					'icon' => [
						'title' => esc_html__('Icon', 'master-addons' ),
						'icon'  => 'fa fa-info',
					],
					'text' => [
						'title' => esc_html__('Text', 'master-addons' ),
						'icon'  => 'fa fa-text-width',
					],
					'image' => [
						'title' => esc_html__('Image', 'master-addons' ),
						'icon'  => 'fa fa-image',
					],
				],
				'default' => 'icon',
			]
		);

		$this->add_control(
			'ma_el_tooltip_content',
			[
				'label'       => esc_html__('Content', 'master-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default'     => esc_html__('Hover Me!', 'master-addons' ),
				'condition'   => [
					'ma_el_tooltip_type' => ['text']
				]
			]
		);

		$this->add_control(
			'ma_el_tooltip_icon_content',
			[
				'label'            => esc_html__('Icon', 'master-addons' ),
				'description'      => esc_html__('Please choose an icon from the list.', 'master-addons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fas fa-umbrella-beach',
					'library' => 'solid',
				],
				'render_type' => 'template',
				'condition'   => [
					'ma_el_tooltip_type' => ['icon']
				]
			]
		);

		$this->add_control(
			'ma_el_tooltip_img_content',
			[
				'label'   => esc_html__('Image', 'master-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'ma_el_tooltip_type' => ['image']
				]
			]
		);

		$this->add_control(
			'tooltip_button_img',
			[
				'label'   => __('Image', 'master-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'tooltip_type' => ['image']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'tooltip_button_imgsize',
				'default'   => 'large',
				'separator' => 'none',
				'condition' => [
					'tooltip_type' => ['image']
				]
			]
		);

		$this->add_control(
			'tooltip_style_section_align',
			[
				'label'   => __('Alignment', 'master-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => Master_Addons_Helper::jltma_content_alignment(),
				'default'      => 'center',
				'prefix_class' => 'jltma-align-',
			]
		);


		$this->add_control(
			'jltma_tootltip_tag',
			[
				'label'              => esc_html__('Placement', 'master-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'button',
				'label_block'        => false,
				'render_type'        => 'none',
				'frontend_available' => true,
				'options'            => Master_Addons_Helper::jltma_title_tags(),
			]
		);


		// $this->add_control(
		// 	'ma_el_tooltip_enable_link',
		// 	[
		// 		'label'        => __('Show Link', 'master-addons' ),
		// 		'type'         => Controls_Manager::SWITCHER,
		// 		'label_on'     => __('Show', 'master-addons' ),
		// 		'label_off'    => __('Hide', 'master-addons' ),
		// 		'return_value' => 'yes',
		// 		'default'      => 'no',
		// 	]
		// );

		$this->add_control(
			'ma_el_tooltip_link',
			[
				'label'         => __('Link', 'master-addons' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __('https://your-link.com', 'master-addons' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'condition' => [
					'jltma_tootltip_tag' => 'a',
				]
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'tooltip_options',
			[
				'label' => __('Tooltip Options', 'master-addons' ),
			]
		);
		$this->add_control(
			'ma_el_tooltip_text',
			[
				'label'              => esc_html__('Tooltip Text', 'master-addons' ),
				'type'               => Controls_Manager::TEXTAREA,
				'label_block'        => true,
				'default'            => esc_html__('Tooltip contents here.', 'master-addons' ),
				'dynamic'            => ['active' => true],
				'render_type'        => 'none',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'jltma_tooltip_follow_cursor',
			[
				'label'              => esc_html__('Follow Cursor', 'master-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'render_type'        => 'none',
				'frontend_available' => true
			]
		);

		$this->add_control(
			'ma_el_tooltip_direction',
			[
				'label'              => esc_html__('Placement', 'master-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'top',
				'label_block'        => false,
				'render_type'        => 'none',
				'frontend_available' => true,
				'options'            => Master_Addons_Helper::jltma_tooltip_options(),
				'condition'          => [
					'jltma_tooltip_follow_cursor' => ''
				],
			]
		);

		$this->add_control(
			'jltma_tooltip_animation',
			[
				'label'              => esc_html__('Animation', 'master-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'shift-away',
				'options'            => Master_Addons_Helper::jltma_tooltip_animations(),
				'render_type'        => 'none',
				'frontend_available' => true
			]
		);

		$this->add_control(
			'jltma_tooltip_trigger',
			[
				'label'   => esc_html__('Trigger on', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''       => esc_html__('Hover', 'master-addons' ),
					'click'  => esc_html__('Click', 'master-addons' ),
					'manual' => esc_html__('Custom Trigger', 'master-addons' ),

				],
				'default'            => '',
				'render_type'        => 'none',
				'frontend_available' => true
			]
		);

		$this->add_control(
			'jltma_tooltip_custom_trigger',
			[
				'label'       => esc_html__('Custom Trigger', 'master-addons' ),
				'placeholder' => '.class-name',
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => ['active' => true],
				'condition'   => [
					'jltma_tooltip_trigger' => 'manual',
				],
				'render_type'        => 'none',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'jltma_tooltip_duration',
			[
				'label'              => __('Duration', 'master-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 100,
				'max'                => 1000,
				'step'               => 10,
				'default'            => 300,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'jltma_tooltip_delay',
			[
				'label'              => __('Delay out (s)', 'master-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 100,
				'max'                => 1000,
				'step'               => 5,
				'default'            => 300,
				'frontend_available' => true,
			]
		);


		// $this->add_control(
		// 	'ma_el_tooltip_visible_hover',
		// 	[
		// 		'label' 		=> __('Visible on Hover', 'master-addons' ),
		// 		'type' 			=> Controls_Manager::SWITCHER,
		// 		'label_on' 		=> __('Yes', 'master-addons' ),
		// 		'label_off' 	=> __('No', 'master-addons' ),
		// 		'return_value' 	=> 'yes',
		// 		'default' 		=> 'no',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item:hover .jltma-tooltip-text' => 'visibility: visible;opacity: 1; display:block;',
		// 		]

		// 	]
		// );


		$this->add_control(
			'jltma_tooltip_x_offset',
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
				'render_type'        => 'none',
				'frontend_available' => true
			]
		);

		$this->add_control(
			'jltma_tooltip_y_offset',
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
				'render_type'        => 'none',
				'frontend_available' => true
			]
		);

		$this->add_control(
			'jltma_tooltip_arrow',
			[
				'label'              => esc_html__('Arrow', 'master-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'render_type'        => 'none',
				'frontend_available' => true,
				'condition'          => [
					'jltma_tooltip_animation!' => 'fill'
				],
			]
		);

		$this->add_control(
			'jltma_tooltip_arrow_type',
			[
				'label' => __('Arrow Type', 'master-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sharp',
				'options' => [
					'sharp' => __('Sharp', 'master-addons' ),
					'round' => __('Round', 'master-addons' ),
				],
				'frontend_available' => true,
				'condition' => [
					'jltma_tooltip_arrow!' => '',
				],
			]
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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/tooltip/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/adding-tooltip-in-elementor-editor/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=Av3eTae9vaE" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);
		$this->end_controls_section();



		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'ma_el_section_pro_style',
				[
					'label' => esc_html__('Upgrade to Pro for More Features', 'master-addons' )
				]
			);

			$this->add_control(
				'ma_el_control_get_pro',
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
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with
Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}





		// Style tab section
		$this->start_controls_section(
			'tooltip_style_section',
			[
				'label' => __('General Styles', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'ma_el_tooltip_content_width',
			[
				'label' => __('Content Width', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => ['px', '%'],
				'default'    => [
					'unit' => 'px',
					'size' => 150,
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-tooltip' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'ma_el_tooltip_content_padding',
			[
				'label'      => esc_html__('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'      => 20,
					'right'    => 20,
					'bottom'   => 20,
					'left'     => 20,
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs('ma_el_tooltip_content_style_tabs');
		// Normal State Tab
		$this->start_controls_tab('ma_el_tooltip_content_normal', ['label' => esc_html__('Normal', 'master-addons' )]);
		$this->add_control(
			'ma_el_tooltip_content_bg_color',
			[
				'label'     => esc_html__('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f9f9f9',
				'selectors' => [
					'{{WRAPPER}} .jltma-tooltip' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ma_el_tooltip_content_color',
			[
				'label'     => esc_html__('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#826EFF',
				'selectors' => [
					'{{WRAPPER}} .jltma-tooltip, {{WRAPPER}} .jltma-tooltip a'
					=> 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ma_el_tooltip_content_shadow',
				'selector' => '{{WRAPPER}} .jltma-tooltip',
			]
		);

		$this->end_controls_tab();

		// Hover State Tab
		$this->start_controls_tab('ma_el_tooltip_content_hover', ['label' => esc_html__('Hover', 'master-addons' )]);
		$this->add_control(
			'ma_el_tooltip_content_hover_bg_color',
			[
				'label'     => esc_html__('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f9f9f9',
				'selectors' => [
					'{{WRAPPER}} .jltma-tooltip:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ma_el_tooltip_content_hover_color',
			[
				'label'     => esc_html__('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#212121',
				'selectors' => [
					'{{WRAPPER}} .jltma-tooltip:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-tooltip a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ma_el_tooltip_hover_shadow',
				'selector' => '{{WRAPPER}} .jltma-tooltip:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();



		$this->add_control(
			'ma_el_shadow-separator',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ma_el_tooltip_content_typography',
				'selector' => '{{WRAPPER}} .jltma-tooltip',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ma_el_tooltip_hover_border',
				'label' => esc_html__('Border', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-tooltip',
			]
		);


		$this->add_control(
			'ma_el_tooltip_content_radius',
			[
				'label'      => esc_html__('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'      => 4,
					'right'    => 4,
					'bottom'   => 4,
					'left'     => 4,
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Tooltip Style tab section
		$this->start_controls_section(
			'ma_el_tooltip_style_section',
			[
				'label' => __('Tooltip Styles', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ma_el_tooltip_text_width',
			[
				'label'      => __('Tooltip Width', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 1000,
						'step' => 5,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 200,
				],
				'label_block' => true,
				'selectors'   => [
					// '{{WRAPPER}} .jltma-tooltip .jltma-tooltip-text' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tippy-box' => 'max-width: calc({{SIZE}}{{UNIT}} - 10px) !important;',
				]
			]
		);

		$this->add_control(
			Group_Control_Background::get_type(),
			[
				'name'		=> 'ma_el_tooltip_bg_color',
				'label'     => __('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#826EFF',
				// 'selectors' => [
				// 	'{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item .jltma-tooltip-text' => 'background: {{VALUE}};'
				// ],
				'selector' => [
					'{{WRAPPER}} .tippy-box' => 'background-color: {{VALUE}}',
					// '{{WRAPPER}} .tippy-popper[data-tippy-popper-id="{{ID}}"] .tippy-tooltip, .tippy-popper[data-tippy-popper-id="{{ID}}"] .tippy-tooltip .tippy-backdrop' => 'background-color: {{VALUE}};',
					// '{{WRAPPER}} .tippy-popper[data-tippy-popper-id="{{ID}}"][x-placement^=top] .tippy-tooltip .tippy-arrow' => 'border-top-color: {{VALUE}};',
					// '{{WRAPPER}} .tippy-popper[data-tippy-popper-id="{{ID}}"][x-placement^=bottom] .tippy-tooltip .tippy-arrow' => 'border-bottom-color: {{VALUE}};',
					// '{{WRAPPER}} .tippy-popper[data-tippy-popper-id="{{ID}}"][x-placement^=left] .tippy-tooltip .tippy-arrow' => 'border-left-color: {{VALUE}};',
					// '{{WRAPPER}} .tippy-popper[data-tippy-popper-id="{{ID}}"][x-placement^=right] .tippy-tooltip .tippy-arrow' => 'border-right-color: {{VALUE}};',
					// '{{WRAPPER}} .tippy-popper[data-tippy-popper-id="{{ID}}"] .tippy-tooltip .tippy-roundarrow' => 'fill: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'ma_el_tooltip_style_color',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					// '{{WRAPPER}} .jltma-tooltip .jltma-tooltip-item .jltma-tooltip-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tippy-box' => 'color: {{VALUE}}',
				],
			]
		);

		// $this->add_group_control(
		// 	Group_Control_Background::get_type(),
		// 	[
		// 		'name' => 'hover_tooltip_content_background',
		// 		'label' => __('Background', 'master-addons' ),
		// 		'types' => ['classic', 'gradient'],
		// 		'selector' => '{{WRAPPER}} .jltma-tooltip .jltma-tooltip-text',
		// 	]
		// );

		// Arrow Tab Start
		$this->add_control(
			'ma_el_tooltip_arrow_color',
			[
				'label'     => __('Arrow Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#826EFF',
				'selectors' => [
					'{{WRAPPER}} .tippy-box .tippy-arrow' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hover_tooltip_content_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				// 'selector' => '{{WRAPPER}} .jltma-tooltip .jltma-tooltip-text',
				'selector'  => '.tippy-box',
			]
		);

		$this->add_control(
			'ma_el_tooltip_text_padding',
			[
				'label'      => __('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default'    => [
					'top'      => 10,
					'right'    => 10,
					'bottom'   => 10,
					'left'     => 10,
					'isLinked' => true,
				],
				'selectors' => [
					// '{{WRAPPER}} .jltma-tooltip .jltma-tooltip-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tippy-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'jltma_tooltip_border',
				'label'       => esc_html__('Border', 'master-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .tippy-box',
			]
		);


		$this->add_responsive_control(
			'ma_el_tooltip_content_border_radius',
			[
				'label'   => esc_html__('Border Radius', 'master-addons' ),
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					// '{{WRAPPER}} .jltma-tooltip .jltma-tooltip-text' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px !important;',
					'{{WRAPPER}} .tippy-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'jltma_tooltip_distance',
			[
				'label'              => __('Distance', 'essential-addons-elementor'),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 05,
				'max'                => 50,
				'step'               => 2,
				'default'            => 10,
				'label_block'        => false,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'jltma_tooltip_text_align',
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
					'{{WRAPPER}} .tippy-box' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'jltma_tooltip_box_shadow',
				'selector'  => '.tippy-box',
			]
		);

		$this->end_controls_section();


		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'ma_el_section_pro_style_section',
				[
					'label' => esc_html__('Upgrade to Pro for More Features', 'master-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE
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
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute(
			'jltma_tooltip_wrapper',
			[
				'class' => ['jltma-tooltip'],
				'id' => 'jltma-tooltip-' . $this->get_id(),
			]
		);

		$this->add_inline_editing_attributes('ma_el_tooltip_content', 'basic');

		// If link type tags
		if (!empty($settings['ma_el_tooltip_link']['url'])) {
			$this->add_render_attribute('jltma_tooltip_wrapper', [
				'href'  => esc_url_raw($settings['ma_el_tooltip_link']['url']),
			]);
			if ($settings['ma_el_tooltip_link']['is_external']) {
				$this->add_render_attribute('jltma_tooltip_wrapper', 'target', '_blank');
			}

			if ($settings['ma_el_tooltip_link']['nofollow']) {
				$this->add_render_attribute('jltma_tooltip_wrapper', 'rel', 'nofollow');
			}
		}

		$this->add_render_attribute('jltma_tooltips', 'class', 'jltma-tooltip-item');

		$jltma_tootltip_tag = !empty($settings['jltma_tootltip_tag']) ? $settings['jltma_tootltip_tag'] : 'button';
?>
		<<?php echo esc_attr($jltma_tootltip_tag); ?> <?php echo $this->get_render_attribute_string('jltma_tooltip_wrapper'); ?>>

			<?php if ($settings['ma_el_tooltip_type'] === 'text') { ?>
				<?php echo $this->parse_text_editor($settings['ma_el_tooltip_content']); ?>
			<?php } elseif ($settings['ma_el_tooltip_type'] === 'icon') {
				Master_Addons_Helper::jltma_fa_icon_picker('fab fa-linux', 'icon', $settings['ma_el_tooltip_icon_content'], 'ma_el_tooltip_icon_content');
			} elseif ($settings['ma_el_tooltip_type'] === 'image') { ?>
				<img src="<?php echo esc_url($settings['ma_el_tooltip_img_content']['url']); ?>">
			<?php } ?>

		</<?php echo esc_attr($jltma_tootltip_tag); ?>>
<?php

	}
}
