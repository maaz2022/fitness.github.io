<?php

namespace MasterAddons\Addons;

/**
 * Author Name: Liton Arefin
 * Author URL : https: //jeweltheme.com
 * Date       : 6/26/19
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Stack;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Core\Schemes\Color;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use MasterAddons\Inc\Helper\Master_Addons_Helper;


if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Flipbox extends Widget_Base
{

	public function get_name()
	{
		return 'ma-flipbox';
	}

	public function get_title()
	{
		return esc_html__('Flipbox', 'master-addons' );
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-flip-box';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/flipbox/';
	}

	protected function register_controls()
	{


		/*-----------------------------------------------------------------------------------*/
		/*	STYLE PRESETS
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'section_flipbox_style',
			[
				'label' => esc_html__('Style Preset', 'master-addons' )
			]
		);



		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {

			$this->add_control(
				'ma_flipbox_layout_style',
				[
					'label'   => __('Design Variation', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'one'   => __('Default', 'master-addons' ),
						'two'   => __('Front Image', 'master-addons' ),
						'three' => __('Diagnonal', 'master-addons' ),
						'four'  => __('Front Icon', 'master-addons' )
					],
					'default' => 'one',
				]
			);

			//Free Codes
		} else {
			$this->add_control(
				'ma_flipbox_layout_style',
				[
					'label'   => __('Design Variation', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'one'           => __('Default', 'master-addons' ),
						'four'          => __('Front Icon', 'master-addons' ),
						'flipbox-pro-1' => __('Front Image (Pro)', 'master-addons' ),
						'flipbox-pro-2' => __('Diagnonal (Pro)', 'master-addons' ),

					],
					'default'     => 'one',
					'description' => sprintf(
						'2+ more Variations on <a href="%s" target="_blank">%s</a>',
						esc_url_raw(admin_url('admin.php?page=master-addons-settings-pricing')),
						__('Upgrade Now', 'master-addons' )
					)
				]
			);
		}




		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {

			$this->add_control(
				'animation_style',
				[
					'label'   => __('Animation Style', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'horizontal'                          => esc_html__('Flip Horizontal', 'master-addons' ),
						'vertical'                            => esc_html__('Flip Vertical', 'master-addons' ),
						'fade'                                => esc_html__('Fade', 'master-addons' ),
						'flipcard flipcard-rotate-top-down'   => esc_html__('Cube - Top Down', 'master-addons' ),
						'flipcard flipcard-rotate-down-top'   => esc_html__('Cube - Down Top', 'master-addons' ),
						'flipcard flipcard-rotate-left-right' => esc_html__('Cube - Left Right', 'master-addons' ),
						'flipcard flipcard-rotate-right-left' => esc_html__('Cube - Right Left', 'master-addons' ),
						'flip box'                            => esc_html__('Flip Box', 'master-addons' ),
						'flip box fade'                       => esc_html__('Flip Box Fade', 'master-addons' ),
						'flip box fade up'                    => esc_html__('Fade Up', 'master-addons' ),
						'flip box fade hideback'              => esc_html__('Fade Hideback', 'master-addons' ),
						'flip box fade up hideback'           => esc_html__('Fade Up Hideback', 'master-addons' ),
						'nananana'                            => esc_html__('Nananana', 'master-addons' ),
						'rollover'                            => esc_html__('Rollover', 'master-addons' ),
						'flip3d'                              => esc_html__('3d Flip', 'master-addons' ),

						// New Styles
						'left-to-right'       => esc_html__('Left to Right', 'master-addons' ),
						'right-to-left'       => esc_html__('Right to Left', 'master-addons' ),
						'top-to-bottom'       => esc_html__('Top to Bottom', 'master-addons' ),
						'bottom-to-top'       => esc_html__('Bottom to Top', 'master-addons' ),
						'top-to-bottom-angle' => esc_html__('Diagonal (Top to Bottom)', 'master-addons' ),
						'bottom-to-top-angle' => esc_html__('Diagonal (Bottom to Top)', 'master-addons' ),
						'fade-in-out'         => esc_html__('Fade In Out', 'master-addons' ),


					],
					'default'      => 'vertical',
					'prefix_class' => 'jltma-flip-animate-'
				]
			);


			//Free Codes

		} else {

			$this->add_control(
				'animation_style',
				[
					'label'   => __('Animation Style', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'horizontal'       => esc_html__('Flip Horizontal', 'master-addons' ),
						'vertical'         => esc_html__('Flip Vertical', 'master-addons' ),
						'fade'             => esc_html__('Fade', 'master-addons' ),
						'flipbox-anim-1'   => esc_html__('Cube - Top Down (Pro)', 'master-addons' ),
						'flipbox-anim-2'   => esc_html__('Cube - Down Top (Pro)', 'master-addons' ),
						'flipbox-anim-3'   => esc_html__('Cube - Left Right (Pro)', 'master-addons' ),
						'flipbox-anim-4'   => esc_html__('Cube - Right Left (Pro)', 'master-addons' ),
						'flip box'         => esc_html__('Flip Box', 'master-addons' ),
						'flip box fade'    => esc_html__('Flip Box Fade', 'master-addons' ),
						'flip box fade up' => esc_html__('Fade Up', 'master-addons' ),
						'flipbox-anim-5'   => esc_html__('Fade Hideback (Pro)', 'master-addons' ),
						'flipbox-anim-6'   => esc_html__('Fade Up Hideback (Pro)', 'master-addons' ),
						'flipbox-anim-14'  => esc_html__('Nananana (Pro)', 'master-addons' ),
						'flipbox-anim-15'  => esc_html__('Rollover (Pro)', 'master-addons' ),
						//not
						// working


						// New Styles
						'flipbox-anim-16' => esc_html__('3d Flip (Pro)', 'master-addons' ),
						'flipbox-anim-7'  => esc_html__('Left to Right (Pro)', 'master-addons' ),
						'flipbox-anim-8'  => esc_html__('Right to Left (Pro)', 'master-addons' ),
						'flipbox-anim-9'  => esc_html__('Top to Bottom (Pro)', 'master-addons' ),
						'flipbox-anim-10' => esc_html__('Bottom to Top (Pro)', 'master-addons' ),
						'flipbox-anim-11' => esc_html__('Diagonal (Top to Bottom) (Pro)', 'master-addons' ),
						'flipbox-anim-12' => esc_html__('Diagonal (Bottom to Top) (Pro)', 'master-addons' ),
						'flipbox-anim-13' => esc_html__('Fade In Out (Pro)', 'master-addons' ),


					],
					'default'      => 'vertical',
					'prefix_class' => 'jltma-flip-animate-',
					'description'  => sprintf(
						'15+ more Flipbox Variations on <a href="%s" target="_blank">%s</a>',
						esc_url_raw(admin_url('admin.php?page=master-addons-settings-pricing')),
						__('Upgrade Now', 'master-addons' )
					)
				]
			);
		}

		$this->end_controls_section();



		/*-----------------------------------------------------------------------------------*/
		/*	Front Box
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'section_front_box',
			[
				'label' => esc_html__('Front Box', 'master-addons' )
			]
		);

		$this->add_control(
			'front_icon_view',
			[
				'label'   => esc_html__('Icon Style', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__('Default', 'master-addons' ),
					'stacked' => esc_html__('Stacked', 'master-addons' ),
					'framed'  => esc_html__('Framed', 'master-addons' ),
				],
				'default' => 'default',

			]
		);

		$this->add_control(
			'front_icon_shape',
			[
				'label'   => __('Shape', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'circle' => __('Circle', 'master-addons' ),
					'square' => __('Square', 'master-addons' ),
				],
				'default'   => 'circle',
				'condition' => [
					'front_icon_view!' => 'default',
				],

			]
		);

		$this->add_control(
			'front_icon',
			[
				'label'            => esc_html__('Icon', 'master-addons' ),
				'description'      => esc_html__('Please choose an icon from the list.', 'master-addons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fab fa-elementor',
					'library' => 'brand',
				],
				'render_type' => 'template'
			]
		);


		$this->add_control(
			'front_title',
			[
				'label'   => esc_html__('Title', 'master-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__('Enter text', 'master-addons' ),
				'default'     => esc_html__('Front Title Here', 'master-addons' ),
			]
		);


		$this->add_control(
			'front_text',
			[
				'label'   => esc_html__('Description', 'master-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__('Enter text', 'master-addons' ),
				'default'     => esc_html__('Add some nice text here.', 'master-addons' ),
			]
		);

		$this->add_responsive_control(
			'front_box_front_text_align',
			[
				'label'       => esc_html__('Alignment', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => Master_Addons_Helper::jltma_content_alignment(),
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-front' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'front_title_html_tag',
			[
				'label'   => esc_html__('Title HTML Tag', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => Master_Addons_Helper::jltma_title_tags(),
				'default' => 'h3',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_back_box',
			[
				'label' => __('Back Box', 'master-addons' )
			]
		);

		$this->add_control(
			'back_icon_view',
			[
				'label'   => __('View', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'default' => __('Default', 'master-addons' ),
					'stacked' => __('Stacked', 'master-addons' ),
					'framed'  => __('Framed', 'master-addons' ),
				],
				'default' => 'default',

			]
		);

		$this->add_control(
			'back_icon_shape',
			[
				'label'   => __('Shape', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'circle' => __('Circle', 'master-addons' ),
					'square' => __('Square', 'master-addons' ),
				],
				'default'   => 'circle',
				'condition' => [
					'back_icon_view!' => 'default',
				],

			]
		);


		$this->add_control(
			'back_icon',
			[
				'label'            => esc_html__('Icon', 'master-addons' ),
				'description'      => esc_html__('Please choose an icon from the list.', 'master-addons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fab fa-wordpress',
					'library' => 'brand',
				],
				'render_type' => 'template'
			]
		);



		$this->add_control(
			'back_title',
			[
				'label'   => __('Title', 'master-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __('Enter text', 'master-addons' ),
				'default'     => __('Text Title', 'master-addons' ),
			]
		);

		$this->add_control(
			'back_text',
			[
				'label'   => __('Description', 'master-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __('Enter text', 'master-addons' ),
				'default'     => __('Add some nice text here.', 'master-addons' ),
			]
		);


		$this->add_responsive_control(
			'front_box_back_text_align',
			[
				'label'       => esc_html__('Alignment', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => Master_Addons_Helper::jltma_content_alignment(),
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-back' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'back_title_html_tag',
			[
				'label'   => __('HTML Tag', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => Master_Addons_Helper::jltma_title_tags(),
				'default' => 'h3',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section-action-button',
			[
				'label' => __('Action Button', 'master-addons' ),
			]
		);

		$this->add_control(
			'action_text',
			[
				'label'       => __('Button Text', 'master-addons' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __('Buy', 'master-addons' ),
				'default'     => __('Buy Now', 'master-addons' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label'   => __('Link to', 'master-addons' ),
				'type'    => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __('http://your-link.com', 'master-addons' ),
				'separator'   => 'before',
			]
		);

		$this->end_controls_section();




		/*-----------------------------------------------------------------------------------*/
		/*	STYLE TAB
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'section-general-style',
			[
				'label' => __('General', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_control(
			'ma_el_flip_3d',
			[
				'label'   => __('3d Flip Style', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'flip_3d_left'   => __('Slide Right to Left', 'master-addons' ),
					'flip_3d_right'  => __('Slide Left to Right', 'master-addons' ),
					'flip_3d_top'    => __('Slide Top to Bottom', 'master-addons' ),
					'flip_3d_bottom' => __('Slide Bottom to Top', 'master-addons' ),
				],
				'default'   => '3d_left',
				'condition' => [
					'animation_style' => 'flip3d'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'flip_box_border',
				'label'    => __('Box Border', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-flip-box-inner > div',
			]
		);



		$this->add_control(
			'box_border_radius',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-flip-box-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .jltma-flip-box-back'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_height',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => __('Flip Box Height', 'master-addons' ),
				'placeholder' => __('250', 'master-addons' ),
				'default'     => __('250', 'master-addons' ),
				'selectors'   => [
					'{{WRAPPER}} .jltma-flip-box-inner'                           => 'height: {{VALUE}}px;',
					'{{WRAPPER}}.jltma-flip-animate-flipcard .jltma-flip-box-front' => 'transform-origin: center center calc(-{{VALUE}}px/2);-webkit-transform-origin:center center calc(-{{VALUE}}px/2);',
					'{{WRAPPER}}.jltma-flip-animate-flipcard .jltma-flip-box-back'  => 'transform-origin: center center calc(-{{VALUE}}px/2);-webkit-transform-origin:center center calc(-{{VALUE}}px/2);',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section-front-box-style',
			[
				'label' => __('Front Box', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);



		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'front_box_bg_color',
				'label'     => __('Background', 'master-addons' ),
				'types'     => ['classic', 'gradient'],
				'default'   => '#fff',
				'selector'  => '{{WRAPPER}} .jltma-flip-box-front',
				'condition' => [
					'ma_flipbox_layout_style' => ['one', 'three', 'four']
				]
			]
		);


		$this->add_control(
			'front_box_image',
			[
				'label'   => __('Image', 'master-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'ma_flipbox_layout_style' => 'two',
				],
			]
		);


		$this->add_control(
			'front_box_background_color',
			[
				'label'     => esc_html__('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-front' => 'background-color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'front_box_title_color',
			[
				'label'  => __('Title', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#393c3f',
				'selectors' => [
					'{{WRAPPER}} .front-icon-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'front_title!' => ''
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'front_box_title_typography',
				'label'    => __('Title Typography', 'master-addons' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .front-icon-title',
			]
		);

		$this->add_control(
			'front_box_text_color',
			[
				'label'  => __('Description Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#78909c',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-front p' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'front_box_text_typography',
				'label'    => __('Description Typography', 'master-addons' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .jltma-flip-box-front p',
			]
		);


		/**
		 *  Front Box icons styles
		 **/
		$this->add_control(
			'front_box_icon_color',
			[
				'label'  => __('Icon Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#4b00e7',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-front .icon-wrapper i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-flip-box-front .icon-wrapper svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'front_icon!' => ''
				],
			]
		);

		$this->add_control(
			'front_box_icon_fill_color',
			[
				'label'  => __('Icon Fill Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#41dcab',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-icon-view-stacked' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'front_icon_view' => 'stacked'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'front_box_icon_border',
				'label'       => __('Box Border', 'master-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-flip-box-front .jltma-flip-icon-view-framed, {{WRAPPER}} .jltma-flip-box-front .jltma-flip-icon-view-stacked',
				'label_block' => true,
				'condition'   => [
					'front_icon_view!' => 'default'
				],
			]
		);

		$this->add_control(
			'front_icon_size',
			[
				'label' => __('Icon Size', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-front .icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-flip-box-front .icon-wrapper svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'front_icon_padding',
			[
				'label'     => __('Icon Padding', 'master-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-front .icon-wrapper' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'size' => 1.5,
					'unit' => 'em',
				],
				'range' => [
					'em' => [
						'min' => 0,
					],
				],
				'condition' => [
					'front_icon_view!' => 'default',
				],
			]
		);





		$this->end_controls_section();



		$this->start_controls_section(
			'section-back-box-style',
			[
				'label' => esc_html__('Back Box', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'back_box_background',
				'label'    => __('Back Box Background', 'master-addons' ),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .jltma-flip-box-back',
			]
		);

		$this->add_control(
			'back_box_title_color',
			[
				'label'  => __('Title', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .back-icon-title' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'back_box_title_typography',
				'label'    => __('Title Typography', 'master-addons' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .back-icon-title',
			]
		);

		$this->add_control(
			'back_box_text_color',
			[
				'label'  => __('Description Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-back p' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'back_box_text_typography',
				'label'    => __('Description Typography', 'master-addons' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .jltma-flip-box-back p',
			]
		);


		/**
		 *  Back Box icons styles
		 **/
		$this->add_control(
			'back_box_icon_color',
			[
				'label'  => __('Icon Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-back .icon-wrapper i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-flip-box-back .icon-wrapper svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'back_icon!' => ''
				],
			]
		);

		$this->add_control(
			'back_box_icon_fill_color',
			[
				'label'  => __('Icon Fill Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-back .jltma-flip-icon-view-stacked' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'front_icon_view' => 'stacked'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'back_box_icon_border',
				'label'       => __('Box Border', 'master-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-flip-box-back .jltma-flip-icon-view-framed, {{WRAPPER}} .jltma-flip-box-back .jltma-flip-icon-view-stacked',
				'label_block' => true,
				'condition'   => [
					'back_icon_view!' => 'default'
				],
			]
		);

		$this->add_control(
			'back_icon_size',
			[
				'label' => __('Icon Size', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-back .icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-flip-box-front .icon-wrapper svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'back_icon_padding',
			[
				'label'     => __('Icon Padding', 'master-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-back .icon-wrapper' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'size' => 1.5,
					'unit' => 'em',
				],
				'range' => [
					'em' => [
						'min' => 0,
					],
				],
				'condition' => [
					'back_icon_view!' => 'default',
				],
			]
		);



		$this->end_controls_section();

		$this->start_controls_section(
			'section_action_button_style',
			[
				'label' => __('Action Button', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs('jltma_flipbox_action_btn_style');

		$this->start_controls_tab(
			'jltma_flipbox_action_btn_style_normal',
			[
				'label' => esc_html__('Normal', 'master-addons' )
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4b00e7',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => __('Typography', 'master-addons' ),
				'scheme'    			=> Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button',
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'  => __('Background Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border',
				'label'       => __('Border', 'master-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_padding',
			[
				'label'      => __('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->end_controls_tab();

		$this->start_controls_tab(
			'jltma_flipbox_action_btn_style_hover',
			[
				'label' => esc_html__('Hover', 'master-addons' )
			]
		);


		$this->add_control(
			'button_text_color_hover',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4b00e7',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		// $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'typography',
		// 		'label' => __( 'Typography', 'master-addons' ),
		// 'scheme'    			=> Typography::TYPOGRAPHY_4,
		// 		'selector' => '{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button:hover',
		// 	]
		// );

		$this->add_control(
			'background_color_hover',
			[
				'label'  => __('Background Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_4
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border_hover',
				'label'       => __('Border', 'master-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button:hover',
			]
		);

		$this->add_control(
			'border_radius_hover',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_padding_hover',
			[
				'label'      => __('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-flip-box-wrapper .jltma-flip-box-back .jltma-flipbox-content .jltma-flip-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/flipbox/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/how-to-configure-flipbox-element/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=f-B35-xWqF0" target="_blank" rel="noopener">', '</a>'),
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

		$this->add_render_attribute(
			'ma_el_flipbox',
			'class',
			[
				'jltma-flip-box'
			]
		);


		$this->add_render_attribute('front-icon-wrapper', 'class', 'icon-wrapper');
		$this->add_render_attribute('front-icon-wrapper', 'class', 'jltma-flip-icon-view-' . esc_attr($settings['front_icon_view']));
		$this->add_render_attribute('front-icon-wrapper', 'class', 'jltma-flip-icon-shape-' . esc_attr($settings['front_icon_shape']));
		$this->add_render_attribute('front-icon-title', 'class', 'front-icon-title');
		$this->add_render_attribute('front-icon', 'class', $settings['front_icon']);


		$this->add_render_attribute('back-icon-wrapper', 'class', 'icon-wrapper');
		$this->add_render_attribute('back-icon-wrapper', 'class', 'jltma-flip-icon-view-' . esc_attr($settings['back_icon_view']));
		$this->add_render_attribute('back-icon-wrapper', 'class', 'jltma-flip-icon-shape-' . esc_attr($settings['back_icon_shape']));
		$this->add_render_attribute('back-icon-title', 'class', 'back-icon-title');
		$this->add_render_attribute('back-icon', 'class', $settings['back_icon']);

		$this->add_render_attribute('button', 'class', 'jltma-flip-button');
		if (!empty($settings['link']['url'])) {
			$this->add_render_attribute('button', 'href', esc_url($settings['link']['url']));

			if (!empty($settings['link']['is_external'])) {
				$this->add_render_attribute('button', 'target', '_blank');
			}
		}



		$flip_box = $this->get_settings_for_display('front_box_image');

		if (isset($flip_box['id']) && $flip_box['id'] != "") {
			$flip_box_url_src = Group_Control_Image_Size::get_attachment_image_src(
				$flip_box['id'],
				'full',
				$settings
			);
		}

		if (!empty($flip_box['url'])) {
			$flip_box_url = $flip_box['url'];
		} else {
			$flip_box_url = isset($flip_box_url_src);
		}
?>

		<div class="jltma-flip-box-wrapper <?php echo esc_attr($settings['ma_flipbox_layout_style']); ?> <?php if ($settings['ma_el_flip_3d']) {
																												echo esc_attr($settings['ma_el_flip_3d']);
																											}; ?>">

			<div class="jltma-flip-box-inner">
				<div class="jltma-flip-box-front">
					<div class="jltma-flipbox-content">

						<?php if ($settings['ma_flipbox_layout_style'] == "two") { ?>

							<?php if (isset($flip_box_url) && $flip_box_url != "") { ?>
								<img src="<?php echo esc_url($flip_box_url); ?>" alt="<?php echo get_post_meta($flip_box['id'], '_wp_attachment_image_alt', true); ?>">
							<?php } ?>

						<?php } else if (($settings['ma_flipbox_layout_style'] == "one") || ($settings['ma_flipbox_layout_style'] == "three")) { ?>


							<?php if ((!empty($settings['icon']) || !empty($settings['front_icon']['value']))) { ?>
								<div <?php echo $this->get_render_attribute_string('front-icon-wrapper'); ?>>
									<?php Master_Addons_Helper::jltma_fa_icon_picker('fab fa-elementor', 'icon', $settings['front_icon'], '', 'front-icon'); ?>
								</div>
							<?php } ?>

							<?php if (!empty($settings['front_title'])) { ?>
								<<?php echo tag_escape($settings['front_title_html_tag']); ?> <?php echo $this->get_render_attribute_string('front-icon-title'); ?>>
									<?php echo $this->parse_text_editor($settings['front_title']); ?>
								</<?php echo tag_escape($settings['front_title_html_tag']); ?>>
							<?php } ?>

							<?php if (!empty($settings['front_text'])) {
							?>
								<p>
									<?php echo $this->parse_text_editor($settings['front_text']); ?>
								</p>
							<?php }
							?>

						<?php } ?>


						<?php //else if( $settings['ma_flipbox_layout_style'] == "three") {}
						?>



						<?php if ($settings['ma_flipbox_layout_style'] == "four") { ?>

							<?php if (!empty($settings['front_icon'])) { ?>
								<div <?php echo $this->get_render_attribute_string('front-icon-wrapper'); ?>>
									<?php Master_Addons_Helper::jltma_fa_icon_picker('fab fa-elementor', 'icon', $settings['front_icon'], '', 'front-icon'); ?>
								</div>
							<?php } ?>

						<?php } ?>


					</div>
				</div>

				<div class="jltma-flip-box-back">
					<div class="jltma-flipbox-content">
						<?php if (!empty($settings['back_icon'])) { ?>
							<div <?php echo $this->get_render_attribute_string('back-icon-wrapper'); ?>>
								<?php Master_Addons_Helper::jltma_fa_icon_picker('fab fa-elementor', 'icon', $settings['back_icon'], '', 'back-icon'); ?>
							</div>
						<?php } ?>

						<?php if (!empty($settings['back_title'])) { ?>
							<<?php echo tag_escape($settings['back_title_html_tag']); ?> <?php echo $this->get_render_attribute_string('back-icon-title'); ?>>
								<?php echo $this->parse_text_editor($settings['back_title']); ?>
							</<?php echo tag_escape($settings['back_title_html_tag']); ?>>
						<?php } ?>

						<?php if (!empty($settings['back_text'])) { ?>
							<p>
								<?php echo $this->parse_text_editor($settings['back_text']); ?>
							</p>
						<?php } ?>

						<?php if (!empty($settings['action_text'])) { ?>
							<div class="jltma-flip-button-wrapper">
								<a <?php echo $this->get_render_attribute_string('button'); ?>>
									<span class="elementor-button-text">
										<?php echo $this->parse_text_editor($settings['action_text']); ?>
									</span>
								</a>
							</div>
						<?php  }  ?>
					</div>
				</div>
			</div>
		</div>
<?php
	}

	protected function content_template()
	{
	}
}
