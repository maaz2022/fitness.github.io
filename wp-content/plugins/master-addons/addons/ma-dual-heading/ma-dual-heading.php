<?php

namespace MasterAddons\Addons;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Controls_Stack;
use \Elementor\Group_Control_Border;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Dual_Heading extends Widget_Base
{

	public function get_name()
	{
		return 'ma-dual-heading';
	}

	public function get_title()
	{
		return esc_html__('Dual Heading', 'master-addons' );
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-heading';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_keywords()
	{
		return ['heading', 'headlines', 'dual headline', 'gradient', 'gradient heading', 'gradient headlines'];
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
		return 'https://master-addons.com/demos/dual-heading/';
	}


	protected function register_controls()
	{

		/**
		 * Master Addons: Dual Heading Content Section
		 */
		$this->start_controls_section(
			'ma_el_dual_heading_content',
			[
				'label' => esc_html__('Content', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_dual_heading_styles_preset',
			[
				'label'   => esc_html__('Style Preset', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '-style2',
				'options' => [
					'-style1' => esc_html__('Style 1', 'master-addons' ),
					'-style2' => esc_html__('Style 2', 'master-addons' ),
					// '-style3' => esc_html__('Background Text', 'master-addons' ),
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_dual_heading_alignment',
			[
				'label'       => esc_html__('Alignment', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left' => [
						'title' => esc_html__('Left', 'master-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'master-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'master-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .jltma-dual-heading .jltma-dual-heading-wrapper, {{WRAPPER}} .jltma-sec-head-style' => 'text-align: {{VALUE}};',
				],
			]
		);



		$this->add_control(
			'ma_el_dual_first_heading',
			[
				'label'       => esc_html__('First Heading', 'master-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__('First', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_dual_second_heading',
			[
				'label'       => esc_html__('Second Heading', 'master-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__('Second', 'master-addons' ),
			]
		);




		$this->add_control(
			'ma_el_dual_heading_title_link',
			[
				'label'       => esc_html__('Heading URL', 'master-addons' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__('https://master-addons.com', 'master-addons' ),
				'label_block' => true,
				'condition'   => [
					'ma_el_dual_heading_styles_preset' => '-style2',
				],
			]
		);

		$this->add_control(
			'ma_el_dual_heading_description',
			[
				'label'       => esc_html__('Sub Heading', 'master-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'dynamic'     => ['active' => true],
				'default'     => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto modi vel repudiandae reiciendis, cupiditate quod voluptatibus, placeat ad assumenda molestiae alias quisquam', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_dual_heading_icon_show',
			[
				'label'        => esc_html__('Enable Icon', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'condition'    => [
					'ma_el_dual_heading_styles_preset' => '-style2',
				],
			]
		);

		$this->add_control(
			'ma_el_dual_heading_icon',
			[
				'label'            => esc_html__('Icon', 'master-addons' ),
				'description'      => esc_html__('Please choose an icon from the list.', 'master-addons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fab fa-elementor',
					'library' => 'brand',
				],
				'render_type' => 'template',
				'condition'   => [
					'ma_el_dual_heading_icon_show'     => 'yes',
					'ma_el_dual_heading_styles_preset' => '-style2',
				]
			]
		);


		$this->add_control(
			'title_html_tag',
			[
				'label'   => __('Heading Tag', 'master-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => Master_Addons_Helper::jltma_heading_tags(),
				'default' => 'h1',
			]
		);

		$this->end_controls_section();


		/*
			* Master Addons: Dual Heading First Part Styling Section
			*/
		$this->start_controls_section(
			'ma_el_dual_first_heading_styles',
			[
				'label' => esc_html__('First Heading', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ma_el_dual_heading_first_text_color',
			[
				'label'		=> esc_html__('Text Color', 'master-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#1fb5ac',
				'selectors'	=> [
					'{{WRAPPER}} .jltma-dual-heading .jltma-dual-heading-wrapper .jltma-dual-heading-title .jltma-first-heading, {{WRAPPER}} .jltma-section-title span'
					=> 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_dual_heading_first_bg_color',
			[
				'label'     => __('Background', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#704aff',
				'selectors' => [
					'{{WRAPPER}} .jltma-dual-heading .jltma-dual-heading-wrapper .jltma-dual-heading-title .jltma-first-heading, {{WRAPPER}} .jltma-sec-head-container .jltma-sec-head-style:after'
					=> 'background-color: {{VALUE}};',
				],
			]
		);


		// $this->add_responsive_control(
		// 	'ma_el_dual_first_heading_alignment',
		// 	[
		// 		'label'       => esc_html__('Alignment', 'master-addons' ),
		// 		'type'        => Controls_Manager::CHOOSE,
		// 		'label_block' => false,
		// 		'options'     => [
		// 			'left' => [
		// 				'title' => esc_html__('Left', 'master-addons' ),
		// 				'icon'  => 'eicon-text-align-left',
		// 			],
		// 			'center' => [
		// 				'title' => esc_html__('Center', 'master-addons' ),
		// 				'icon'  => 'eicon-text-align-center',
		// 			],
		// 			'right' => [
		// 				'title' => esc_html__('Right', 'master-addons' ),
		// 				'icon'  => 'eicon-text-align-right',
		// 			],
		// 		],
		// 		'default'   => 'center',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .jltma-dual-heading-title' => 'text-align: {{VALUE}};',
		// 		],
		// 		'condition' 	=> [
		// 			'ma_el_dual_heading_styles_preset' => '-style2',
		// 		],
		// 	]
		// );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ma_el_dual_first_heading_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-dual-heading .jltma-dual-heading-wrapper .jltma-dual-heading-title  .jltma-first-heading,{{WRAPPER}} .jltma-section-title span',
			]
		);

		$this->add_responsive_control(
			'ma_el_dual_first_heading_padding',
			[
				'label'         => __('Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-dual-heading .jltma-dual-heading-wrapper .jltma-dual-heading-title  .jltma-first-heading,{{WRAPPER}} .jltma-section-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_dual_first_heading_margin',
			[
				'label'         => __('Margin', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-dual-heading .jltma-dual-heading-wrapper .jltma-dual-heading-title  .jltma-first-heading,{{WRAPPER}} .jltma-section-title span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_section();

		/*
			* Master Addons: Dual Heading Second Part Styling Section
			*/
		$this->start_controls_section(
			'ma_el_dual_second_heading_styles',
			[
				'label' => esc_html__('Second Heading', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ma_el_dual_heading_second_text_color',
			[
				'label'		=> esc_html__('Text Color', 'master-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#132C47',
				'selectors'	=> [
					'{{WRAPPER}} .jltma-dual-heading .jltma-dual-heading-wrapper .jltma-dual-heading-title .jltma-second-heading,
						{{WRAPPER}} .jltma-section-title' =>
					'color: {{VALUE}};',
				],

			]
		);

		$this->add_control(
			'ma_el_dual_heading_second_bg_color',
			[
				'label'     => __('Background', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-dual-heading .jltma-dual-heading-wrapper .jltma-dual-heading-title .jltma-second-heading' =>
					'background-color: {{VALUE}};',
				],

				'condition' => [
					'ma_el_dual_heading_styles_preset' => '-style2',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_dual_second_heading_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' =>
				'{{WRAPPER}} .jltma-dual-heading .jltma-dual-heading-wrapper .jltma-dual-heading-title .jltma-second-heading,                          {{WRAPPER}} .jltma-section-title',
			]
		);


		$this->add_responsive_control(
			'ma_el_dual_second_heading_padding',
			[
				'label'         => __('Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-dual-heading .jltma-second-heading,
						{{WRAPPER}} .jltma-section-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_dual_second_heading_margin',
			[
				'label'         => __('Margin', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-dual-heading .jltma-second-heading,
						{{WRAPPER}} .jltma-section-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		$this->end_controls_section();

		/*
				* Master Addons: Dual Heading description Styling Section
			*/
		$this->start_controls_section(
			'ma_el_dual_heading_description_styles',
			[
				'label' => esc_html__('Description', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		// $this->add_responsive_control(
		// 	'ma_el_dual_desc_heading_alignment',
		// 	[
		// 		'label'       => esc_html__('Alignment', 'master-addons' ),
		// 		'type'        => Controls_Manager::CHOOSE,
		// 		'label_block' => false,
		// 		'options'     => [
		// 			'left' => [
		// 				'title' => esc_html__('Left', 'master-addons' ),
		// 				'icon'  => 'eicon-text-align-left',
		// 			],
		// 			'center' => [
		// 				'title' => esc_html__('Center', 'master-addons' ),
		// 				'icon'  => 'eicon-text-align-center',
		// 			],
		// 			'right' => [
		// 				'title' => esc_html__('Right', 'master-addons' ),
		// 				'icon'  => 'eicon-text-align-right',
		// 			],
		// 		],
		// 		'default'   => 'center',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .jltma-dual-heading-description' => 'text-align: {{VALUE}};',
		// 		],
		// 		'condition' 	=> [
		// 			'ma_el_dual_heading_styles_preset' => '-style2',
		// 		],
		// 	]
		// );
		$this->add_control(
			'ma_el_dual_heading_description_text_color',
			[
				'label'		=> esc_html__('Text Color', 'master-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#989B9E',
				'selectors'	=> [
					'{{WRAPPER}} .jltma-dual-heading .jltma-dual-heading-wrapper .jltma-dual-heading-description,
						{{WRAPPER}} .jltma-section-description' =>
					'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ma_el_dual_heading_description_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-dual-heading .jltma-dual-heading-wrapper .jltma-dual-heading-description,
					{{WRAPPER}} .jltma-section-description',
			]
		);
		$this->add_responsive_control(
			'ma_el_dual_description_padding',
			[
				'label'         => __('Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-dual-heading .jltma-dual-heading-description,
						{{WRAPPER}} .jltma-section-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_dual_description_margin',
			[
				'label'         => __('Margin', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-dual-heading .jltma-dual-heading-description,
						{{WRAPPER}} .jltma-section-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_section();




		/*
			 * Master Addons: Icon Styling
			 */
		$this->start_controls_section(
			'ma_el_dual_heading_icon_style',
			[
				'label' => esc_html__('Icon Style', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ma_el_dual_heading_icon_show'     => 'yes',
					'ma_el_dual_heading_styles_preset' => '-style2'
				],
			]
		);

		$this->start_controls_tabs('ma_el_dual_heading_icon_style_tabs');

		$this->start_controls_tab('normal', ['label' => esc_html__('Normal', 'master-addons' )]);

		$this->add_control(
			'ma_el_dual_heading_icon_size',
			[
				'label'   => __('Size', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => 40,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-dual-heading-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ma_el_dual_heading_icon_style_color',
			[
				'label'     => esc_html__('Icon Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8c8c8c',
				'selectors' => [
					'{{WRAPPER}} .jltma-dual-heading-icon i' => 'color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ma_el_dual_heading_icon_hover_color',
			[
				'label' => esc_html__('Hover', 'master-addons' )
			]
		);

		$this->add_control(
			'ma_el_dual_heading_icon_size_hover',
			[
				'label'   => __('Size', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => 40,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-dual-heading-icon i:hover' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ma_el_dual_heading_icon_style_hover_text_color',
			[
				'label'     => esc_html__('Icon Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8c8c8c',
				'selectors' => [
					'{{WRAPPER}} .jltma-dual-heading-icon i:hover'                               => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();


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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/dual-heading/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/dual-heading/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=kXyvNe6l0Sg" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);
		$this->end_controls_section();




		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'ma_el_section_pro_style_section',
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
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

?>


		<?php if ($settings['ma_el_dual_heading_styles_preset'] == '-style1') { ?>

			<div class="jltma-sec-head-container">
				<div class="jltma-sec-head-style">
					<<?php echo tag_escape($settings['title_html_tag']); ?> class="jltma-section-title">
						<span>
							<?php echo esc_html($settings['ma_el_dual_first_heading']); ?>
						</span><br>

						<?php echo esc_html($settings['ma_el_dual_second_heading']); ?>

					</<?php echo tag_escape($settings['title_html_tag']); ?>><!-- /.section-title -->

					<div class="jltma-section-description">
						<?php echo esc_html($settings['ma_el_dual_heading_description']); ?>
					</div><!-- /.section-description -->
				</div><!-- /.sec-head-style -->
			</div><!-- /.sec-head-container -->

		<?php } elseif ($settings['ma_el_dual_heading_styles_preset'] == '-style2') { ?>

			<div id="jltma-heading-<?php echo esc_attr($this->get_id()); ?>" class="jltma-dual-heading">
				<div class="jltma-dual-heading-wrapper">
					<?php if ($settings['ma_el_dual_heading_icon_show'] == 'yes') : ?>
						<span class="jltma-dual-heading-icon">
							<?php Master_Addons_Helper::jltma_fa_icon_picker('fab fa-elementor', 'icon', $settings['ma_el_dual_heading_icon'], 'ma_el_dual_heading_icon'); ?>
						</span>
					<?php endif; ?>
					<<?php echo esc_attr($settings['title_html_tag']); ?> class="jltma-dual-heading-title">

						<?php if (isset($settings['ma_el_dual_heading_title_link']['url']) && $settings['ma_el_dual_heading_title_link']['url'] != "") { ?>
							<a href="<?php echo esc_url($settings['ma_el_dual_heading_title_link']['url']); ?>">
							<?php } ?>

							<span class="jltma-first-heading">
								<?php echo $this->parse_text_editor($settings['ma_el_dual_first_heading']); ?>
							</span>

							<span class="jltma-second-heading">
								<?php echo $this->parse_text_editor($settings['ma_el_dual_second_heading']); ?>
							</span>

							<?php if (isset($settings['ma_el_dual_heading_title_link']['url']) && $settings['ma_el_dual_heading_title_link']['url'] != "") { ?>
							</a>
						<?php } ?>

					</<?php echo esc_attr($settings['title_html_tag']); ?>>
					<?php if ($settings['ma_el_dual_heading_description'] != "") : ?>
						<p class="jltma-dual-heading-description"><?php echo $this->parse_text_editor($settings['ma_el_dual_heading_description']); ?></p>
					<?php endif; ?>
				</div>
			</div>

		<?php } ?>


	<?php
	}

	protected function content_template()
	{ ?>

		<# if ( '-style1'==settings.ma_el_dual_heading_styles_preset ) { #>

			<div class="jltma-sec-head-container">
				<div class="jltma-sec-head-style">
					<h2 class="jltma-section-title">
						<span>{{{ settings.ma_el_dual_first_heading }}}</span> {{{ settings.ma_el_dual_second_heading }}}
					</h2><!-- /.section-title -->

					<div class="jltma-section-description">
						{{{ settings.ma_el_dual_heading_description }}}
					</div><!-- /.section-description -->
				</div><!-- /.sec-head-style -->
			</div><!-- /.sec-head-container -->

			<# } else{ #>

				<div id="jltma-heading" class="jltma-dual-heading">
					<div class="jltma-dual-heading-wrapper">
						<# if ( settings.ma_el_dual_heading_icon_show=='yes' ) { #>
							<span class="jltma-dual-heading-icon"><i class="{{ settings.ma_el_dual_heading_icon.value }}"></i></span>
							<# } #>
								<h1 class="jltma-dual-heading-title">
									<a href="{{{ settings.ma_el_dual_heading_title_link }}}">
										<span class="jltma-first-heading">{{{ settings.ma_el_dual_first_heading }}}</span><span class="jltma-second-heading">{{{ settings.ma_el_dual_second_heading }}}</span>
									</a>
								</h1>
								<# if ( settings.ma_el_dual_heading_description !="" ) { #>
									<p class="jltma-dual-heading-description">{{{ settings.ma_el_dual_heading_description }}}</p>
									<# } #>
					</div>
				</div>
				<# } #>

			<?php
		}
	}
