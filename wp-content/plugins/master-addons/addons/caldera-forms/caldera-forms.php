<?php

namespace MasterAddons\Addons;

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Controls_Stack;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Box_Shadow;

use MasterAddons\Inc\Helper\Master_Addons_Helper;


if (!defined('ABSPATH')) exit; // If this file is called directly, abort.


class JLTMA_Caldera_Forms extends Widget_Base
{

	public function get_name()
	{
		return 'ma-caldera-forms';
	}

	public function get_title()
	{
		return esc_html__('Caldera Forms', 'master-addons' );
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-mail';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}


	protected function register_controls()
	{

		/*-----------------------------------------------------------------------------------*/
		/*	Content Tab
			/*-----------------------------------------------------------------------------------*/

		/**
		 * Content Tab: Caldera Forms
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_info_box',
			[
				'label' => esc_html__('Caldera Forms', 'master-addons' ),
			]
		);

		$this->add_control(
			'contact_form_list',
			[
				'label'       => esc_html__('Contact Form', 'master-addons' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => Master_Addons_Helper::ma_el_get_caldera_forms(),
				'default'     => '0',
			]
		);

		$this->add_control(
			'custom_title_description',
			[
				'label'        => __('Custom Title & Description', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Yes', 'master-addons' ),
				'label_off'    => __('No', 'master-addons' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'form_title_custom',
			[
				'label'       => esc_html__('Title', 'master-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '',
				'condition'   => [
					'custom_title_description' => 'yes',
				],
			]
		);

		$this->add_control(
			'form_description_custom',
			[
				'label'     => esc_html__('Description', 'master-addons' ),
				'type'      => Controls_Manager::TEXTAREA,
				'default'   => '',
				'condition' => [
					'custom_title_description' => 'yes',
				],
			]
		);

		$this->add_control(
			'labels_switch',
			[
				'label'        => __('Labels', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __('Show', 'master-addons' ),
				'label_off'    => __('Hide', 'master-addons' ),
				'return_value' => 'yes',
				'prefix_class' => 'jltma-caldera-form-labels-',
			]
		);

		$this->add_control(
			'placeholder_switch',
			[
				'label'        => __('Placeholder', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __('Show', 'master-addons' ),
				'label_off'    => __('Hide', 'master-addons' ),
				'return_value' => 'yes',
			]
		);

		$this->end_controls_section();

		/**
		 * Content Tab: Errors
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_errors',
			[
				'label' => __('Errors', 'master-addons' ),
			]
		);

		$this->add_control(
			'error_messages',
			[
				'label'   => __('Error Messages', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'show',
				'options' => [
					'show' => __('Show', 'master-addons' ),
					'hide' => __('Hide', 'master-addons' ),
				],
				'selectors_dictionary'  => [
					'show' => 'block',
					'hide' => 'none',
				],
				'selectors'             => [
					'{{WRAPPER}} .jltma-caldera-form .has-error .parsley-required' => 'display: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_section();

		/*-----------------------------------------------------------------------------------*/
		/*	Style Tab
			/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'ma_caldera_form_section_style',
			[
				'label' => esc_html__('Design Layout', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {

			$this->add_control(
				'ma_caldera_form_layout_style',
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
				'ma_caldera_form_layout_style',
				[
					'label'   => __('Design Variations', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '1',
					'options' => [
						'1'         => __('Style One', 'master-addons' ),
						'2'         => __('Style Two', 'master-addons' ),
						'3'         => __('Style Three', 'master-addons' ),
						'4'         => __('Style Four', 'master-addons' ),
						'5'         => __('Style Five', 'master-addons' ),
						'clf-pro-1' => __('Style Five (Pro)', 'master-addons' ),
						'clf-pro-2' => __('Style Six (Pro)', 'master-addons' ),
						'clf-pro-3' => __('Style Seven (Pro)', 'master-addons' ),
						'clf-pro-4' => __('Style Eight (Pro)', 'master-addons' ),
						'clf-pro-5' => __('Style Nine (Pro)', 'master-addons' ),
						'clf-pro-6' => __('Style Ten (Pro)', 'master-addons' ),
						'clf-pro-7' => __('Style Eleven (Pro)', 'master-addons' ),
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



		/**
		 * Style Tab: Form Title & Description
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_form_title_style',
			[
				'label'     => __('Title & Description', 'master-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'custom_title_description' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'heading_alignment',
			[
				'label'   => __('Alignment', 'master-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => Master_Addons_Helper::jltma_content_alignment(),
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form-heading' => 'text-align: {{VALUE}};',
				],
				'condition'             => [
					'custom_title_description' => 'yes',
				],
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label'     => __('Title', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'custom_title_description' => 'yes',
				],
			]
		);

		$this->add_control(
			'form_title_text_color',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-contact-form-title' => 'color: {{VALUE}}',
				],
				'condition'             => [
					'custom_title_description' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'form_title_typography',
				'label'     => __('Typography', 'master-addons' ),
				'selector'  => '{{WRAPPER}} .jltma-contact-form-title',
				'scheme'    => Typography::TYPOGRAPHY_3,
				'condition' => [
					'custom_title_description' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'form_title_margin',
			[
				'label'              => __('Margin', 'master-addons' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', 'em', '%'],
				'allowed_dimensions' => 'vertical',
				'placeholder'        => [
					'top'    => '',
					'right'  => 'auto',
					'bottom' => '',
					'left'   => 'auto',
				],
				'selectors'             => [
					'{{WRAPPER}} .jltma-contact-form-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'custom_title_description' => 'yes',
				],
			]
		);

		$this->add_control(
			'description_heading',
			[
				'label'     => __('Description', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'custom_title_description' => 'yes',
				],
			]
		);

		$this->add_control(
			'form_description_text_color',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-contact-form-description' => 'color: {{VALUE}}',
				],
				'condition'             => [
					'custom_title_description' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'form_description_typography',
				'label'     => __('Typography', 'master-addons' ),
				'scheme'    => Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .jltma-contact-form-description',
				'condition' => [
					'custom_title_description' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'form_description_margin',
			[
				'label'              => __('Margin', 'master-addons' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', 'em', '%'],
				'allowed_dimensions' => 'vertical',
				'placeholder'        => [
					'top'    => '',
					'right'  => 'auto',
					'bottom' => '',
					'left'   => 'auto',
				],
				'selectors'             => [
					'{{WRAPPER}} .jltma-contact-form-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'custom_title_description' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Labels
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_label_style',
			[
				'label' => __('Labels', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color_label',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form .form-group label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_label',
				'label'    => __('Typography', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-caldera-form .form-group label',
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Input & Textarea
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_fields_style',
			[
				'label' => __('Input & Textarea', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'input_alignment',
			[
				'label'   => __('Alignment', 'master-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => Master_Addons_Helper::jltma_content_alignment(),
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-caldera-form .form-group textarea, {{WRAPPER}} .jltma-caldera-form .form-group select' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs('tabs_fields_style');

		$this->start_controls_tab(
			'tab_fields_normal',
			[
				'label' => __('Normal', 'master-addons' ),
			]
		);

		$this->add_control(
			'field_bg_color',
			[
				'label'     => __('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-caldera-form .form-group textarea, {{WRAPPER}} .jltma-caldera-form .form-group select' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'field_text_color',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-caldera-form .form-group textarea, {{WRAPPER}} .jltma-caldera-form .form-group select' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'field_border',
				'label'       => __('Border', 'master-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-caldera-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-caldera-form .form-group textarea, {{WRAPPER}} .jltma-caldera-form .form-group select',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'field_radius',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-caldera-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-caldera-form .form-group textarea, {{WRAPPER}} .jltma-caldera-form .form-group select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'field_text_indent',
			[
				'label' => __('Text Indent', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px'        => [
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					],
					'%'         => [
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-caldera-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-caldera-form .form-group textarea, {{WRAPPER}} .jltma-caldera-form .form-group select' => 'text-indent: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'input_width',
			[
				'label' => __('Input Width', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 1200,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-caldera-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-caldera-form .form-group select' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'input_height',
			[
				'label' => __('Input Height', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 80,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-caldera-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-caldera-form .form-group select' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'textarea_width',
			[
				'label' => __('Textarea Width', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 1200,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-caldera-form .form-group textarea' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'textarea_height',
			[
				'label' => __('Textarea Height', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 400,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-caldera-form .form-group textarea' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'field_padding',
			[
				'label'      => __('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-caldera-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-caldera-form .form-group textarea, {{WRAPPER}} .jltma-caldera-form .form-group select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'field_spacing',
			[
				'label' => __('Spacing', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px'        => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-caldera-form .form-group' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'field_typography',
				'label'     => __('Typography', 'master-addons' ),
				'selector'  => '{{WRAPPER}} .jltma-caldera-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-caldera-form .form-group textarea, {{WRAPPER}} .jltma-caldera-form .form-group select',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'field_box_shadow',
				'selector'  => '{{WRAPPER}} .jltma-caldera-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-caldera-form .form-group textarea, {{WRAPPER}} .jltma-caldera-form .form-group select',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_fields_focus',
			[
				'label' => __('Focus', 'master-addons' ),
			]
		);

		$this->add_control(
			'field_bg_color_focus',
			[
				'label'     => __('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .jltma-caldera-form .form-group textarea:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'focus_input_border',
				'label'       => __('Border', 'master-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-caldera-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .jltma-caldera-form .form-group textarea:focus',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'focus_box_shadow',
				'selector'  => '{{WRAPPER}} .jltma-caldera-form input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .jltma-caldera-form .form-group textarea:focus',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Style Tab: Field Description
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_field_description_style',
			[
				'label' => __('Field Description', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'field_description_text_color',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form .help-block' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'field_description_typography',
				'label'    => __('Typography', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-caldera-form .help-block',
			]
		);

		$this->add_responsive_control(
			'field_description_spacing',
			[
				'label' => __('Spacing', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px'        => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-caldera-form .help-block' => 'padding-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Placeholder
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_placeholder_style',
			[
				'label'     => __('Placeholder', 'master-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'placeholder_switch' => 'yes',
				],
			]
		);

		$this->add_control(
			'text_color_placeholder',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form .form-group input::-webkit-input-placeholder, {{WRAPPER}} .jltma-caldera-form .form-group textarea::-webkit-input-placeholder' => 'color: {{VALUE}}',
				],
				'condition'             => [
					'placeholder_switch' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Radio & Checkbox
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_radio_checkbox_style',
			[
				'label' => __('Radio & Checkbox', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'custom_radio_checkbox',
			[
				'label'        => __('Custom Styles', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Yes', 'master-addons' ),
				'label_off'    => __('No', 'master-addons' ),
				'return_value' => 'yes',
			]
		);

		$this->add_responsive_control(
			'radio_checkbox_size',
			[
				'label'   => __('Size', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => '15',
					'unit' => 'px'
				],
				'range'                 => [
					'px'        => [
						'min'  => 0,
						'max'  => 80,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .jltma-custom-radio-checkbox input[type="radio"]' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				],
				'condition'             => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->start_controls_tabs('tabs_radio_checkbox_style');

		$this->start_controls_tab(
			'radio_checkbox_normal',
			[
				'label'     => __('Normal', 'master-addons' ),
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'radio_checkbox_color',
			[
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .jltma-custom-radio-checkbox input[type="radio"]' => 'background: {{VALUE}}',
				],
				'condition'             => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'checkbox_border_width',
			[
				'label' => __('Border Width', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px'        => [
						'min'  => 0,
						'max'  => 15,
						'step' => 1,
					],
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .jltma-custom-radio-checkbox input[type="radio"]' => 'border-width: {{SIZE}}{{UNIT}}',
				],
				'condition'             => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'checkbox_border_color',
			[
				'label'     => __('Border Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .jltma-custom-radio-checkbox input[type="radio"]' => 'border-color: {{VALUE}}',
				],
				'condition'             => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'checkbox_heading',
			[
				'label'     => __('Checkbox', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'checkbox_border_radius',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .jltma-custom-radio-checkbox input[type="checkbox"]:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'radio_heading',
			[
				'label'     => __('Radio Buttons', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'radio_border_radius',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-custom-radio-checkbox input[type="radio"], {{WRAPPER}} .jltma-custom-radio-checkbox input[type="radio"]:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'radio_checkbox_checked',
			[
				'label'     => __('Checked', 'master-addons' ),
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'radio_checkbox_color_checked',
			[
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-custom-radio-checkbox input[type="checkbox"]:checked:before, {{WRAPPER}} .jltma-custom-radio-checkbox input[type="radio"]:checked:before' => 'background: {{VALUE}}',
				],
				'condition'             => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Style Tab: Submit Button
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_submit_button_style',
			[
				'label' => __('Submit Button', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label'   => __('Alignment', 'master-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'        => [
						'title' => __('Left', 'master-addons' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'      => [
						'title' => __('Center', 'master-addons' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'       => [
						'title' => __('Right', 'master-addons' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'      => '',
				'prefix_class' => 'jltma-caldera-form-button-',
				'condition'    => [
					'button_width_type' => 'custom',
				],
			]
		);

		$this->add_control(
			'button_width_type',
			[
				'label'   => __('Width', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => [
					'full-width' => __('Full Width', 'master-addons' ),
					'custom'     => __('Custom', 'master-addons' ),
				],
				'prefix_class' => 'jltma-caldera-form-button-',
			]
		);

		$this->add_responsive_control(
			'button_width',
			[
				'label'   => __('Width', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => '135',
					'unit' => 'px'
				],
				'range'                 => [
					'px'        => [
						'min'  => 0,
						'max'  => 1200,
						'step' => 1,
					],
				],
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-caldera-form .form-group input[type="submit"], {{WRAPPER}} .jltma-caldera-form .form-group input[type="button"]' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition'             => [
					'button_width_type' => 'custom',
				],
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __('Normal', 'master-addons' ),
			]
		);

		$this->add_control(
			'button_bg_color_normal',
			[
				'label'     => __('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form .form-group input[type="submit"], {{WRAPPER}} .jltma-caldera-form .form-group input[type="button"]' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_text_color_normal',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form .form-group input[type="submit"], {{WRAPPER}} .jltma-caldera-form .form-group input[type="button"]' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'button_border_normal',
				'label'       => __('Border', 'master-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-caldera-form .form-group input[type="submit"], {{WRAPPER}} .jltma-caldera-form .form-group input[type="button"]',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-caldera-form .form-group input[type="submit"], {{WRAPPER}} .jltma-caldera-form .form-group input[type="button"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-caldera-form .form-group input[type="submit"], {{WRAPPER}} .jltma-caldera-form .form-group input[type="button"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' => __('Margin Top', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px'        => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-caldera-form .form-group input[type="submit"], {{WRAPPER}} .jltma-caldera-form .form-group input[type="button"]' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'button_typography',
				'label'     => __('Typography', 'master-addons' ),
				'selector'  => '{{WRAPPER}} .jltma-caldera-form .form-group input[type="submit"], {{WRAPPER}} .jltma-caldera-form .form-group input[type="button"]',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'button_box_shadow',
				'selector'  => '{{WRAPPER}} .jltma-caldera-form .form-group input[type="submit"], {{WRAPPER}} .jltma-caldera-form .form-group input[type="button"]',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __('Hover', 'master-addons' ),
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'label'     => __('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form .form-group input[type="submit"]:hover, {{WRAPPER}} .jltma-caldera-form .form-group input[type="button"]:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form .form-group input[type="submit"]:hover, {{WRAPPER}} .jltma-caldera-form .form-group input[type="button"]:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_border_color_hover',
			[
				'label'     => __('Border Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form .form-group input[type="submit"]:hover, {{WRAPPER}} .jltma-caldera-form .form-group input[type="button"]:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Style Tab: Success Message
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_success_message_style',
			[
				'label' => __('Success Message', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'success_message_bg_color',
			[
				'label'     => __('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form .caldera-grid .alert-success' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'success_message_text_color',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form .caldera-grid .alert-success' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'success_message_border',
				'label'       => __('Border', 'master-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-caldera-form .caldera-grid .alert-success',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'success_message_typography',
				'label'    => __('Typography', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-caldera-form .caldera-grid .alert-success',
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Errors
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_error_style',
			[
				'label' => __('Errors', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'error_messages_heading',
			[
				'label'     => __('Error Messages', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'error_messages' => 'show',
				],
			]
		);

		$this->add_control(
			'error_message_text_color',
			[
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form .has-error .help-block' => 'color: {{VALUE}}',
				],
				'condition'             => [
					'error_messages' => 'show',
				],
			]
		);

		$this->add_control(
			'error_fields_heading',
			[
				'label'     => __('Error Fields', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'error_fields_label_color',
			[
				'label'     => __('Label Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-caldera-form .has-error .control-label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'error_field_border',
				'label'       => __('Input Border', 'master-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-caldera-form .has-error input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-caldera-form .has-error textarea',
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

		// if Caldera Forms Missing
		if (!class_exists('Caldera_Forms')) {
			Master_Addons_Helper::jltma_elementor_plugin_missing_notice(array('plugin_name' => esc_html__('Caldera Forms', 'master-addons' )));
			return;
		}

		$this->add_render_attribute(
			'contact-form',
			'class',
			[
				'ma-cf',
				'jltma-caldera-form',
				'ma-cf',
				'ma-cf-' . esc_attr($settings['ma_caldera_form_layout_style'])
			]
		);

		if ($settings['placeholder_switch'] != 'yes') {
			$this->add_render_attribute('contact-form', 'class', 'placeholder-hide');
		}

		if ($settings['custom_title_description'] == 'yes') {
			$this->add_render_attribute('contact-form', 'class', 'title-description-hide');
		}

		if ($settings['custom_radio_checkbox'] == 'yes') {
			$this->add_render_attribute('contact-form', 'class', 'jltma-custom-radio-checkbox');
		}

		if (class_exists('Caldera_Forms')) {
			if (!empty($settings['contact_form_list'])) { ?>
				<div <?php echo $this->get_render_attribute_string('contact-form'); ?>>
					<?php if ($settings['custom_title_description'] == 'yes') { ?>
						<div class="jltma-caldera-form-heading">
							<?php if ($settings['form_title_custom'] != '') { ?>
								<h3 class="jltma-contact-form-title jltma-caldera-form-title">
									<?php echo esc_attr($settings['form_title_custom']); ?>
								</h3>
							<?php } ?>
							<?php if ($settings['form_description_custom'] != '') { ?>
								<div class="jltma-contact-form-description jltma-caldera-form-description">
									<?php echo $this->parse_text_editor($settings['form_description_custom']); ?>
								</div>
							<?php } ?>
						</div>
					<?php }
					echo do_shortcode('[caldera_form id="' . esc_html($settings['contact_form_list']) . '" ]');
					?>
				</div>
<?php
			}
		}
	}


	protected function content_template()
	{
	}
}
