<?php

namespace MasterAddons\Addons;

use \Elementor\Controls_Stack;
use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Widget_Base as Widget_Base;
use MasterAddons\Inc\Helper\Master_Addons_Helper;


/**
 * Author Name: Liton Arefin
 * Author URL : https: //jeweltheme.com
 * Date       : 6/25/19
 */


if (!defined('ABSPATH')) exit; // If this file is called directly, abort.


class JLTMA_Weforms extends Widget_Base
{

	public function get_name()
	{
		return 'ma-weforms';
	}

	public function get_title()
	{
		return esc_html__('weForms', 'master-addons' );
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-mail';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}


	public function get_help_url()
	{
		return 'https://master-addons.com/demos/wp-forms/';
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'ma_el_section_weform',
			[
				'label' => esc_html__('Select weForm', 'master-addons' )
			]
		);



		$this->add_control(
			'wpuf_contact_form',
			[
				'label'       => esc_html__('Select weForm', 'master-addons' ),
				'description' => esc_html__('Please save and refresh the page after selecting the form', 'master-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT,
				'options'     => Master_Addons_Helper::ma_el_get_weforms(),
				'default'     => '0',
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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/wp-forms/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/how-to-edit-contact-form-7/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=1fU6lWniRqo" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);
		$this->end_controls_section();




		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'jltma_section_upgrade_pro',
				[
					'label' => esc_html__('Upgrade to Pro for More Features', 'master-addons' )
				]
			);

			$this->add_control(
				'maad_el_control_get_pro',
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



		$this->start_controls_section(
			'ma_weform_section_style',
			[
				'label' => esc_html__('Design Layout', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {

			$this->add_control(
				'ma_weform_layout_style',
				[
					'label'   => __('Design Variations', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '1',
					'options' => [
						'1'  => __('Style One', 'master-addons' ),
						'2'  => __('Style Two', 'master-addons' ),
						'3'  => __('Style Three', 'master-addons' ),
						'4'  => __('Style Four', 'master-addons' ),
						'5'  => __('Style Five', 'master-addons' ),
						'6'  => __('Style Six', 'master-addons' ),
						'7'  => __('Style Seven', 'master-addons' ),
						'8'  => __('Style Eight', 'master-addons' ),
						'9'  => __('Style Nine', 'master-addons' ),
						'10' => __('Style Ten', 'master-addons' ),
						'11' => __('Style Eleven', 'master-addons' ),
					],
				]
			);
		} else {
			$this->add_control(
				'ma_weform_layout_style',
				[
					'label'   => __('Design Variations', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '1',
					'options' => [
						'1'         => __('Style One', 'master-addons' ),
						'2'         => __('Style Two', 'master-addons' ),
						'3'         => __('Style Three', 'master-addons' ),
						'4'         => __('Style Four', 'master-addons' ),
						'wef-pro-1' => __('Style Five (Pro)', 'master-addons' ),
						'wef-pro-2' => __('Style Six (Pro)', 'master-addons' ),
						'wef-pro-3' => __('Style Seven (Pro)', 'master-addons' ),
						'wef-pro-4' => __('Style Eight (Pro)', 'master-addons' ),
						'wef-pro-5' => __('Style Nine (Pro)', 'master-addons' ),
						'wef-pro-6' => __('Style Ten (Pro)', 'master-addons' ),
						'wef-pro-7' => __('Style Eleven (Pro)', 'master-addons' ),
					],
					'description' => sprintf(
						'10+ more Variations on <a href="%s" target="_blank">%s</a>',
						esc_url_raw(admin_url('admin.php?page=master-addons-settings-pricing')),
						__('Upgrade Now', 'master-addons' )
					)
				]
			);
		}


		$this->end_controls_section();



		$this->start_controls_section(
			'ma_el_section_weform_styles',
			[
				'label' => esc_html__('Form Container Styles', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ma_el_weform_background',
			[
				'label'     => esc_html__('Form Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_weform_alignment',
			[
				'label'        => esc_html__('Form Alignment', 'master-addons' ),
				'type'         => Controls_Manager::CHOOSE,
				'label_block'  => true,
				'options'      => Master_Addons_Helper::jltma_content_alignment(),
				'default'      => 'left',
				'prefix_class' => 'jltma-contact-form-align-',
			]
		);

		$this->add_responsive_control(
			'ma_el_weform_width',
			[
				'label'      => esc_html__('Form Width', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_weform_max_width',
			[
				'label'      => esc_html__('Form Max Width', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'ma_el_weform_margin',
			[
				'label'      => esc_html__('Form Margin', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-weform-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_weform_padding',
			[
				'label'      => esc_html__('Form Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-weform-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'ma_el_weform_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-weform-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'ma_el_weform_border',
				'selector' => '{{WRAPPER}} .jltma-weform-container',
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ma_el_weform_box_shadow',
				'selector' => '{{WRAPPER}} .jltma-weform-container',
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'ma_el_section_weform_field_styles',
			[
				'label' => esc_html__('Form Fields Styles', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ma_el_weform_input_background',
			[
				'label'     => esc_html__('Input Field Background', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="text"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="password"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="email"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="number"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields textarea' => 'background-color: {{VALUE}};',
				],
			]
		);


		$this->add_responsive_control(
			'ma_el_weform_input_width',
			[
				'label'      => esc_html__('Input Width', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="text"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="password"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="email"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="number"]' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_weform_textarea_width',
			[
				'label'      => esc_html__('Textarea Width', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields textarea' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_weform_input_padding',
			[
				'label'      => esc_html__('Fields Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="text"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="password"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="email"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="number"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->add_control(
			'ma_el_weform_input_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="text"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="password"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="email"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="number"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'ma_el_weform_input_border',
				'selector' => '{{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="text"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="password"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="email"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="number"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields textarea',
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ma_el_weform_input_box_shadow',
				'selector' => '{{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="text"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="password"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="email"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="number"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields textarea',
			]
		);

		$this->add_control(
			'ma_el_weform_focus_heading',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => esc_html__('Focus State Style', 'master-addons' ),
				'separator' => 'before',
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ma_el_weform_input_focus_box_shadow',
				'selector' => '{{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="text"]:focus,
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="password"]: focus,
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="email"]   : focus,
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"]     : focus,
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"]     : focus,
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="number"]  : focus,
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields textarea              : focus',
			]
		);

		$this->add_control(
			'ma_el_weform_input_focus_border',
			[
				'label'     => esc_html__('Border Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="text"]:focus,
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="password"]: focus,
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="email"]   : focus,
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"]     : focus,
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"]     : focus,
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="number"]  : focus,
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields textarea              : focus' => 'border-color: {{VALUE}};',
				],
			]
		);



		$this->end_controls_section();


		$this->start_controls_section(
			'ma_el_section_weform_typography',
			[
				'label' => esc_html__('Color & Typography', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_control(
			'ma_el_weform_label_color',
			[
				'label'     => esc_html__('Label Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container, {{WRAPPER}} .jltma-weform-container .wpuf-label label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_weform_field_color',
			[
				'label'     => esc_html__('Field Font Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="text"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="password"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="email"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="number"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields textarea' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_weform_placeholder_color',
			[
				'label'     => esc_html__('Placeholder Font Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container ::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-weform-container ::-moz-placeholder'          => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-weform-container ::-ms-input-placeholder'     => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'ma_el_weform_label_heading',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => esc_html__('Label Typography', 'master-addons' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_weform_label_typography',
				'selector' => '{{WRAPPER}} .jltma-weform-container, {{WRAPPER}} .jltma-weform-container .wpuf-label label',
			]
		);


		$this->add_control(
			'ma_el_weform_heading_input_field',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => esc_html__('Input Fields Typography', 'master-addons' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_weform_input_field_typography',
				'selector' => '{{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="text"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="password"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="email"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="url"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields input[type="number"],
					 {{WRAPPER}} .jltma-weform-container ul.wpuf-form li .wpuf-fields textarea',
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'ma_el_section_weform_submit_button_styles',
			[
				'label' => esc_html__('Submit Button Styles', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'ma_el_weform_submit_btn_width',
			[
				'label'      => esc_html__('Button Width', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form .wpuf-submit input[type="submit"]' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_weform_submit_btn_alignment',
			[
				'label'       => esc_html__('Button Alignment', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options'     => Master_Addons_Helper::jltma_content_alignments(),
				'default'      => 'justify',
				'prefix_class' => 'jltma-contact-form-btn-align-',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_weform_submit_btn_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-weform-container ul.wpuf-form .wpuf-submit input[type="submit"]',
			]
		);

		$this->add_responsive_control(
			'ma_el_weform_submit_btn_margin',
			[
				'label'      => esc_html__('Margin', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form .wpuf-submit input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'ma_el_weform_submit_btn_padding',
			[
				'label'      => esc_html__('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form .wpuf-submit input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->start_controls_tabs('ma_el_weform_submit_button_tabs');

		$this->start_controls_tab('normal', ['label' => esc_html__('Normal', 'master-addons' )]);

		$this->add_control(
			'ma_el_weform_submit_btn_text_color',
			[
				'label'     => esc_html__('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form .wpuf-submit input[type="submit"]' => 'color: {{VALUE}};',
				],
			]
		);



		$this->add_control(
			'ma_el_weform_submit_btn_background_color',
			[
				'label'     => esc_html__('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form .wpuf-submit input[type="submit"]' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'ma_el_weform_submit_btn_border',
				'selector' => '{{WRAPPER}} .jltma-weform-container ul.wpuf-form .wpuf-submit input[type="submit"]',
			]
		);

		$this->add_control(
			'ma_el_weform_submit_btn_border_radius',
			[
				'label' => esc_html__('Border Radius', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form .wpuf-submit input[type="submit"]' => 'border-radius: {{SIZE}}px;',
				],
			]
		);



		$this->end_controls_tab();

		$this->start_controls_tab('ma_el_weform_submit_btn_hover', ['label' => esc_html__('Hover', 'master-addons' )]);

		$this->add_control(
			'ma_el_weform_submit_btn_hover_text_color',
			[
				'label'     => esc_html__('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form .wpuf-submit input[type="submit"]:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_weform_submit_btn_hover_background_color',
			[
				'label'     => esc_html__('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form .wpuf-submit input[type="submit"]:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_weform_submit_btn_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-weform-container ul.wpuf-form .wpuf-submit input[type="submit"]:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ma_el_weform_submit_btn_box_shadow',
				'selector' => '{{WRAPPER}} .jltma-weform-container ul.wpuf-form .wpuf-submit input[type="submit"]',
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

		$settings = $this->get_settings();

		// if We Forms Missing
		if (!class_exists('WeForms')) {
			Master_Addons_Helper::jltma_elementor_plugin_missing_notice(array('plugin_name' => esc_html__('WeForms', 'master-addons' )));
			return;
		} ?>


		<?php if (!empty($settings['wpuf_contact_form'])) : ?>
			<div class="jltma-weform-container ma-cf ma-cf-<?php echo esc_attr($settings['ma_weform_layout_style']); ?>">
				<?php echo do_shortcode('[weforms id="' . esc_attr($settings['wpuf_contact_form']) . '" ]'); ?>
			</div>
		<?php endif; ?>

<?php

	}



	protected function content_template()
	{
	}
}
