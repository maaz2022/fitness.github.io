<?php

namespace MasterAddons\Addons;

use \Elementor\Widget_Base;
use \Elementor\Controls_Stack;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Text_Shadow;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Gradient_Headline extends Widget_Base
{

	public function get_name()
	{
		return 'ma-gradient-headline';
	}

	public function get_title()
	{
		return esc_html__('Gradient Headline', 'master-addons' );
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
		return ['heading', 'headlines', 'color headline', 'gradient', 'gradient heading', 'gradient headlines'];
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
		return 'https://master-addons.com/demos/gradient-headline/';
	}


	protected function register_controls()
	{
		/**
		 * Master Addons: Gradient Heading Content Section
		 */

		$this->start_controls_section(
			'jltma_gradient_heading_content',
			[
				'label' => esc_html__('Content', 'master-addons' ),
			]
		);

		$this->add_control(
			'jltma_gradient_heading_title',
			[
				'label'       => esc_html__('Heading', 'master-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default'     => esc_html__('Master Addons Gradient Headline', 'master-addons' ),
			]
		);


		$this->add_control(
			'jltma_gradient_heading_link',
			[
				'label'       => esc_html__('Heading URL', 'master-addons' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__('https://master-addons.com', 'master-addons' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
				]
			]
		);

		$this->add_responsive_control(
			'jltma_gradient_heading_alignment',
			[
				'label'       => esc_html__('Alignment', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => Master_Addons_Helper::jltma_content_alignment(),
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .jltma-gradient-headline' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'   => __('Title HTML Tag', 'master-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => Master_Addons_Helper::jltma_heading_tags(),
				'default' => 'h2',
				'toggle'  => false,
			]
		);


		$this->end_controls_section();



		/*
			* Master Addons: Gradient Style Colors
			*/
		$this->start_controls_section(
			'jltma_gradient_heading_styles',
			[
				'label' => esc_html__('Gradient Style', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'jltma_gradient_heading_color_type',
			[
				'label'       => _x('Text Color', 'Background Control', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'render_type' => 'ui',
				'default'     => 'classic',
				'options'     => [
					'classic' => [
						'title' => _x('Classic', 'Text Color Control', 'master-addons' ),
						'icon'  => 'fa fa-paint-brush',
					],
					'gradient' => [
						'title' => _x('Gradient', 'Text Color Control', 'master-addons' ),
						'icon'  => 'fa fa-barcode',
					],
				],
			]
		);


		$this->add_control(
			'jltma_gradient_heading_color',
			[
				'label'     => esc_html__('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1fb5ac',
				'selectors' => [
					'{{WRAPPER}} .jltma-gradient-headline' => 'color: {{VALUE}};',
				],
				'condition' => [
					'jltma_gradient_heading_color_type' => ['classic', 'gradient'],
				],

			]
		);

		$this->add_control(
			'jltma_gradient_heading_color_stop',
			[
				'label'      => _x('Location', 'Background Control', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'default'    => [
					'unit' => '%',
					'size' => 0,
				],
				'render_type' => 'ui',
				'condition'   => [
					'jltma_gradient_heading_color_type' => ['gradient'],
				],
				'of_type' => 'gradient',
			]
		);


		$this->add_control(
			'jltma_gradient_heading_second_color',
			[
				'label'       => esc_html__('Second Color', 'Background Control', 'master-addons' ),
				'type'        => Controls_Manager::COLOR,
				'default'     => '#1fb5ac',
				'render_type' => 'ui',
				'condition'   => [
					'jltma_gradient_heading_color_type' => ['gradient'],
				],
				'of_type' => 'gradient',

			]
		);


		$this->add_control(
			'jltma_gradient_heading_b_stop',
			[
				'label'      => _x('Location', 'Background Control', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'default'    => [
					'unit' => '%',
					'size' => 100,
				],
				'render_type' => 'ui',
				'condition'   => [
					'jltma_gradient_heading_color_type' => ['gradient'],
				],
				'of_type' => 'gradient',
			]
		);



		$this->add_control(
			'jltma_gradient_heading_type',
			[
				'label'   => _x('Type', 'Background Control', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'linear' => _x('Linear', 'Background Control', 'master-addons' ),
					'radial' => _x('Radial', 'Background Control', 'master-addons' ),
				],
				'default'     => 'linear',
				'render_type' => 'ui',
				'condition'   => [
					'jltma_gradient_heading_color_type' => ['gradient'],
				],
				'of_type' => 'gradient',
			]
		);



		$this->add_control(
			'jltma_gradient_heading_angle',
			[
				'label'      => _x('Angle', 'Background Control', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'default'    => [
					'unit' => 'deg',
					'size' => 180,
				],
				'range' 		=> [
					'deg' 	=> [
						'step' => 10,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-gradient-headline' => '-webkit-background-clip: text; -webkit-text-fill-color: transparent; background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{jltma_gradient_heading_color.VALUE}} {{jltma_gradient_heading_color_stop.SIZE}}{{jltma_gradient_heading_color_stop.UNIT}}, {{jltma_gradient_heading_second_color.VALUE}} {{jltma_gradient_heading_b_stop.SIZE}}{{jltma_gradient_heading_b_stop.UNIT}})',
				],
				'condition' 	=> [
					'jltma_gradient_heading_color_type' => ['gradient'],
					'jltma_gradient_heading_type'       => 'linear',
				],
				'of_type' => 'gradient',
			]
		);



		$this->add_control(
			'jltma_gradient_heading_position',
			[
				'label'   => _x('Position', 'Background Control', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'center center' => _x('Center Center', 'Background Control', 'master-addons' ),
					'center left'   => _x('Center Left', 'Background Control', 'master-addons' ),
					'center right'  => _x('Center Right', 'Background Control', 'master-addons' ),
					'top center'    => _x('Top Center', 'Background Control', 'master-addons' ),
					'top left'      => _x('Top Left', 'Background Control', 'master-addons' ),
					'top right'     => _x('Top Right', 'Background Control', 'master-addons' ),
					'bottom center' => _x('Bottom Center', 'Background Control', 'master-addons' ),
					'bottom left'   => _x('Bottom Left', 'Background Control', 'master-addons' ),
					'bottom right'  => _x('Bottom Right', 'Background Control', 'master-addons' ),
				],
				'default'   => 'center center',
				'selectors' => [
					'{{WRAPPER}} .jltma-gradient-headline' => '-webkit-background-clip: text; -webkit-text-fill-color: transparent; background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{jltma_gradient_heading_color.VALUE}} {{jltma_gradient_heading_color_stop.SIZE}}{{jltma_gradient_heading_color_stop.UNIT}}, {{jltma_gradient_heading_second_color.VALUE}} {{jltma_gradient_heading_b_stop.SIZE}}{{jltma_gradient_heading_b_stop.UNIT}})',
				],
				'condition' 	=> [
					'jltma_gradient_heading_color_type' => ['gradient'],
					'jltma_gradient_heading_type'       => 'radial',
				],
				'of_type' => 'gradient',
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'jltma_gradient_heading_title_typo',
				'selector' => '{{WRAPPER}} .jltma-gradient-headline',
				'scheme'   => Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'jltma_gradient_heading_title_blend_mode',
			[
				'label'   => __('Blend Mode', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''            => __('Normal', 'master-addons' ),
					'multiply'    => __('Multiply', 'master-addons' ),
					'screen'      => __('Screen', 'master-addons' ),
					'overlay'     => __('Overlay', 'master-addons' ),
					'darken'      => __('Darken', 'master-addons' ),
					'lighten'     => __('Lighten', 'master-addons' ),
					'color-dodge' => __('Color Dodge', 'master-addons' ),
					'saturation'  => __('Saturation', 'master-addons' ),
					'color'       => __('Color', 'master-addons' ),
					'difference'  => __('Difference', 'master-addons' ),
					'exclusion'   => __('Exclusion', 'master-addons' ),
					'hue'         => __('Hue', 'master-addons' ),
					'luminosity'  => __('Luminosity', 'master-addons' )
				],
				'selectors' 		=> [
					'{{WRAPPER}} .jltma-gradient-headline' => 'mix-blend-mode: {{VALUE}};',
				],
				'separator' => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'jltma_gradient_heading_text_shadow',
				'label'    => __('Text Shadow', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-gradient-headline',
			)
		);


		$this->end_controls_section();
	}


	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes('jltma_gradient_heading_title', 'basic');
		$this->add_render_attribute('jltma_gradient_heading_title', 'class', 'jltma-gradient-headline');

		$title = $settings['jltma_gradient_heading_title'];

		if (!empty($settings['jltma_gradient_heading_link']['url'])) {
			$this->add_link_attributes('link', $settings['jltma_gradient_heading_link']);

			$title = sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('link'), $this->parse_text_editor($title));
		}

		printf(
			'<%1$s %2$s>%3$s</%1$s>',
			tag_escape($settings['title_html_tag']),
			$this->get_render_attribute_string('jltma_gradient_heading_title'),
			$title
		);
	}


	protected function content_template()
	{
?>
		<# view.addInlineEditingAttributes( 'jltma_gradient_heading_title' , 'basic' ); view.addRenderAttribute( 'jltma_gradient_heading_title' , 'class' , 'jltma-gradient-headline' ); var title=_.isEmpty(settings.jltma_gradient_heading_link.url) ? settings.jltma_gradient_heading_title : '<a href="' +settings.jltma_gradient_heading_link.url+'">'+settings.jltma_gradient_heading_title+'</a>';
			#>
			<{{ settings.title_html_tag }} {{{ view.getRenderAttributeString( 'jltma_gradient_heading_title' ) }}}>{{{ title }}}</{{ settings.title_html_tag }}>
	<?php
	}
}
