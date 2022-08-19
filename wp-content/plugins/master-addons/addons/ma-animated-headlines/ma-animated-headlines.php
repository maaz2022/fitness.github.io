<?php

namespace MasterAddons\Addons;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Animated_Headlines extends Widget_Base
{

	public function get_name()
	{
		return 'ma-headlines';
	}

	public function get_title()
	{
		return esc_html__('Animated Headlines', 'master-addons' );
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-animated-headline';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_script_depends()
	{
		return [
			'master-addons-scripts',
		];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/animated-headline/';
	}


	protected function register_controls()
	{

		/**
		 * Master Headlines Content Section
		 */
		$this->start_controls_section(
			'ma_el_headlines_content',
			[
				'label' => esc_html__('Content', 'master-addons' ),
			]
		);

		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {

			$this->add_control(
				'ma_el_headlines_style_preset',
				[
					'label'       => esc_html__('Style Preset', 'master-addons' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'rotate-1',
					'label_block' => false,
					'options'     => [
						'rotate-1'    => esc_html__('Rotate 1', 'master-addons' ),
						'rotate-2'    => esc_html__('Rotate 2', 'master-addons' ),
						'rotate-3'    => esc_html__('Rotate 3', 'master-addons' ),
						'type'        => esc_html__('Typing', 'master-addons' ),
						'loading-bar' => esc_html__('Loading Bar', 'master-addons' ),
						'slide'       => esc_html__('Slide', 'master-addons' ),
						'clip'        => esc_html__('Clip', 'master-addons' ),
						'zoom'        => esc_html__('Zoom', 'master-addons' ),
						'scale'       => esc_html__('Scale', 'master-addons' ),
						'push'        => esc_html__('Push', 'master-addons' )
					],
				]
			);

			//Free Version Codes
		} else {
			$this->add_control(
				'ma_el_headlines_style_preset',
				[
					'label'       => esc_html__('Style Preset', 'master-addons' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'rotate-1',
					'label_block' => false,
					'options'     => [
						'rotate-1'         => esc_html__('Rotate 1', 'master-addons' ),
						'rotate-2'         => esc_html__('Rotate 2', 'master-addons' ),
						'rotate-3'         => esc_html__('Rotate 3', 'master-addons' ),
						'loading-bar'      => esc_html__('Loading Bar', 'master-addons' ),
						'ma-heading-pro-1' => esc_html__('Typing (Pro)', 'master-addons' ),
						'ma-heading-pro-2' => esc_html__('Slide (Pro)', 'master-addons' ),
						'ma-heading-pro-3' => esc_html__('Clip (Pro)', 'master-addons' ),
						'ma-heading-pro-4' => esc_html__('Zoom (Pro)', 'master-addons' ),
						'ma-heading-pro-5' => esc_html__('Scale (Pro)', 'master-addons' ),
						'ma-heading-pro-6' => esc_html__('Push (Pro)', 'master-addons' )
					],
					'description' => sprintf(
						'7+ more effects on <a href="%s" target="_blank">%s</a>',
						esc_url_raw(admin_url('admin.php?page=master-addons-settings-pricing')),
						__('Upgrade Now', 'master-addons' )
					)
				]
			);
		}


		$this->add_control(
			'ma_el_headlines_first_heading',
			[
				'label'       => esc_html__('First Heading', 'master-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__('Master Addons', 'master-addons' ),
			]
		);

		$repeater = new Repeater();


		$repeater->add_control(
			'ma_el_headlines_second_heading',
			[
				'label'   => __('More Titles', 'master-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Minimal Template', 'master-addons' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);



		$this->add_control(
			'tabs',
			[
				'type'    => Controls_Manager::REPEATER,
				'default' => [
					['ma_el_headlines_second_heading' => esc_html__('Ultimate Addons', 'master-addons' )],
					['ma_el_headlines_second_heading' => esc_html__('Elementor Widgets', 'master-addons' )],
					['ma_el_headlines_second_heading' => esc_html__('Unique Design', 'master-addons' )],
					['ma_el_headlines_second_heading' => esc_html__('Unlimited Variations', 'master-addons' )],
					['ma_el_headlines_second_heading' => esc_html__('Unlimited Possibilities', 'master-addons' )],
				],
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{ma_el_headlines_second_heading}}',
			]
		);


		$this->add_responsive_control(
			'ma_el_headlines_alignment',
			[
				'label'   => esc_html__('Alignment', 'master-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'master-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'master-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'master-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .jltma-animated-headline' => 'justify-content: {{VALUE}};',
				],
			]
		);



		$this->add_control(
			'title_html_tag',
			[
				'label'   => __('HTML Tag', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => Master_Addons_Helper::jltma_title_tags(),
				'default' => 'h3',
			]
		);

		$this->end_controls_section();





		/**
		 * Content Tab: Animation Settings
		 */
		$this->start_controls_section(
			'jltma_section_animated_headlines_settings',
			[
				'label' => esc_html__('Animation Settings', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			]
		);

		// Animation Effect
		$this->add_control(
			'anim_delay',
			[
				'label'              => esc_html__('Animation Delay', 'master-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 2500,
				'frontend_available' => true
			]
		);

		// Bar Effect
		$this->add_control(
			'bar_anim_delay',
			[
				'label'              => esc_html__('Animation Delay', 'master-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 3800,
				'frontend_available' => true,
				'condition'          => [
					'ma_el_headlines_style_preset' => ['loading-bar']
				]
			]
		);

		// Letter Effect
		$this->add_control(
			'letters_anim_delay',
			[
				'label'              => esc_html__('Letters Delay', 'master-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 50,
				'frontend_available' => true,
				'condition'          => [
					'ma_el_headlines_style_preset' => ['rotate-2']
				]
			]
		);

		//Type Effect
		$this->add_control(
			'type_anim_delay',
			[
				'label'              => esc_html__('Type Letters Delay', 'master-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 150,
				'frontend_available' => true,
				'condition'          => [
					'ma_el_headlines_style_preset' => ['type']
				]
			]
		);

		$this->add_control(
			'type_selection_delay',
			[
				'label'              => esc_html__('Selection Duration', 'master-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 500,
				'frontend_available' => true,
				'condition'          => [
					'ma_el_headlines_style_preset' => ['type']
				]
			]
		);


		// Clip Effect
		$this->add_control(
			'clip_reveal_delay',
			[
				'label'              => esc_html__('Reveal Duration', 'master-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 600,
				'frontend_available' => true,
				'condition'          => [
					'ma_el_headlines_style_preset' => ['clip']
				]
			]
		);

		$this->add_control(
			'clip_anim_duration',
			[
				'label'              => esc_html__('Reveal Animation Delay', 'master-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 1500,
				'frontend_available' => true,
				'condition'          => [
					'ma_el_headlines_style_preset' => ['clip']
				]
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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/animated-headline/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/animated-headline-elementor/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=09QIUPdUQnM" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);
		$this->end_controls_section();



		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'ma_el_section_pro',
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


		/*
	        * Master Headlines First Part Styling Section
	        */

		$this->start_controls_section(
			'ma_el_headlines_first_heading_styles',
			[
				'label' => esc_html__('First Heading', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'ma_el_headlines_first_text_color',
			[
				'label'		=> esc_html__('Text Color', 'master-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors'	=> [
					'{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .first-heading'
					=> 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_headlines_first_bg_color',
			[
				'label'     => __('Background', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#704aff',
				'selectors' => [
					'{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .first-heading'
					=> 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ma_el_headlines_first_heading_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .first-heading',
			]
		);


		$this->add_control(
			'ma_el_headlines_first_heading_padding',
			[
				'label' 		=> esc_html__('Padding', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> ['px', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .first-heading' 	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'ma_el_headlines_first_heading_margin',
			[
				'label' 		=> esc_html__('Margin', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> ['px', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .first-heading' 	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'ma_el_headlines_first_heading_border',
				'label' 	=> esc_html__('Border', 'master-addons' ),
				'selector' 	=> '{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .first-heading',
				'separator' => ''
			]
		);

		$this->add_control(
			'ma_el_headlines_first_heading_radius',
			[
				'label' 		=> esc_html__('Border Radius', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> ['px', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .first-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'ma_el_headlines_first_heading_box_shadow',
				'selector' 	=> '{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .first-heading',
				'separator'	=> ''
			]
		);

		$this->end_controls_section();

		/*
			* Master Headlines Second Part Styling Section
			*/
		$this->start_controls_section(
			'ma_el_headlines_second_heading_styles',
			[
				'label' => esc_html__('Second Heading', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ma_el_headlines_second_text_color',
			[
				'label'		=> esc_html__('Text Color', 'master-addons' ),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#132C47',
				'selectors'	=> [
					'{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .second-heading' =>
					'color: {{VALUE}}; font-style: normal; font-weight: normal;',
				],
			]
		);

		$this->add_control(
			'ma_el_headlines_second_bg_color',
			[
				'label'     => __('Background', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .second-heading' =>
					'background-color: {{VALUE}}; line-height:1.3;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ma_el_headlines_second_heading_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .second-heading',
			]
		);

		$this->add_control(
			'ma_el_headlines_second_heading_padding',
			[
				'label' 		=> esc_html__('Padding', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> ['px', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .second-heading' 	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'ma_el_headlines_second_heading_margin',
			[
				'label' 		=> esc_html__('Margin', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> ['px', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .second-heading' 	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'ma_el_headlines_second_heading_border',
				'label' 	=> esc_html__('Border', 'master-addons' ),
				'selector' 	=> '{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .second-heading',
				'separator' => ''
			]
		);

		$this->add_control(
			'ma_el_headlines_second_heading_radius',
			[
				'label' 		=> esc_html__('Border Radius', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> ['px', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .second-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'ma_el_headlines_second_heading_box_shadow',
				'selector' 	=> '{{WRAPPER}} .jltma-animated-heading .jltma-animated-heading-wrapper .jltma-animated-heading-title .second-heading',
				'separator'	=> ''
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

		switch ($settings['ma_el_headlines_style_preset']) {
			case "rotate-2":
				$letters_class = "letters";
				break;
			case "rotate-3":
				$letters_class = "letters";
				break;
			case "type":
				$letters_class = "letters";
				break;
			case "scale":
				$letters_class = "letters";
				break;
			default:
				$letters_class = "";
		}

		$jltma_animated_headlines_id       = 'jltma-heading-' . $this->get_id();

		$this->add_render_attribute([
			'jltma_animated_headlines' => [
				'id'    => esc_attr($jltma_animated_headlines_id),
				'class' => 'jltma-animated-heading'
			]
		]);


		$this->add_render_attribute('jltma_animated_header_wrapper', [
			'class'	=> [
				'jltma-animated-heading-title',
				'jltma-animated-headline',
				$letters_class,
				$settings['ma_el_headlines_style_preset'],
				'main-title'
			],
			'id' => 'jltma-animated-heading-' . $this->get_id()
		]);


?>
		<div <?php echo $this->get_render_attribute_string('jltma_animated_headlines'); ?>>
			<div class="jltma-animated-heading-wrapper">
				<<?php echo tag_escape($settings['title_html_tag']) . ' ' . $this->get_render_attribute_string('jltma_animated_header_wrapper'); ?>>
					<span class="first-heading">
						<?php echo $this->parse_text_editor($settings['ma_el_headlines_first_heading']); ?>
					</span>
					<span class="jltma-words-wrapper">
						<?php foreach ($settings['tabs'] as $index => $tab) { ?>
							<b class="second-heading <?php echo ($index == 0) ? "is-visible" : ""; ?>">
								<?php echo $this->parse_text_editor($tab['ma_el_headlines_second_heading']); ?>
							</b>
						<?php } ?>
					</span>
				</<?php echo tag_escape($settings['title_html_tag']); ?>>
			</div>
		</div>

<?php
	}
}
