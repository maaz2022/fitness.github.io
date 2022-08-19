<?php

namespace MasterAddons\Addons;

// Elementor Classes
use Elementor\Widget_Base;
use \Elementor\Controls_Stack;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Core\Schemes\Color;
use MasterAddons\Inc\Helper\Master_Addons_Helper;


if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_WP_Forms extends Widget_Base
{

	public function get_name()
	{
		return 'ma-wpforms';
	}

	public function get_title()
	{
		return esc_html__('WPForms', 'master-addons' );
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

		/*-----------------------------------------------------------------------------------*/
		/*	Content Tab
			/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'section_info_box',
			[
				'label' => __('WPForms', 'master-addons' ),
			]
		);

		$this->add_control(
			'contact_form_list',
			[
				'label'       => esc_html__('Contact Form', 'master-addons' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => Master_Addons_Helper::ma_el_get_wpforms_forms(),
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
				'default'      => 'no',
			]
		);

		$this->add_control(
			'form_title',
			[
				'label'        => __('Title', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'master-addons' ),
				'label_off'    => __('Hide', 'master-addons' ),
				'return_value' => 'yes',
				'condition'    => [
					'custom_title_description!' => 'yes',
				],
				'default' => 'no',
			]
		);

		$this->add_control(
			'form_description',
			[
				'label'        => __('Description', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'master-addons' ),
				'label_off'    => __('Hide', 'master-addons' ),
				'return_value' => 'yes',
				'condition'    => [
					'custom_title_description!' => 'yes',
				],
				'default' => 'no',
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
				'prefix_class' => 'jltma-wpforms-labels-',
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
					'{{WRAPPER}} .jltma-wpforms label.wpforms-error' => 'display: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_section();

		/*-----------------------------------------------------------------------------------*/
		/*	STYLE TAB
			/*-----------------------------------------------------------------------------------*/


		/**
		 * Style Tab: Form Title & Description
		 * -------------------------------------------------
		 */

		$this->start_controls_section(
			'ma_wpform_section_style',
			[
				'label' => esc_html__('Design Layout', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {
			$this->add_control(
				'ma_wpform_layout_style',
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
						'6'  => __('Floating Label', 'master-addons' ),
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
				'ma_wpform_layout_style',
				[
					'label'   => __('Design Variations', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '1',
					'options' => [
						'1'         => __('Style One', 'master-addons' ),
						'2'         => __('Style Two', 'master-addons' ),
						'3'         => __('Style Three', 'master-addons' ),
						'4'         => __('Style Four', 'master-addons' ),
						'wpf-pro-1' => __('Style Five (Pro)', 'master-addons' ),
						'wpf-pro-2' => __('Style Six (Pro)', 'master-addons' ),
						'wpf-pro-3' => __('Style Seven (Pro)', 'master-addons' ),
						'wpf-pro-4' => __('Style Eight (Pro)', 'master-addons' ),
						'wpf-pro-5' => __('Style Nine (Pro)', 'master-addons' ),
						'wpf-pro-6' => __('Style Ten (Pro)', 'master-addons' ),
						'wpf-pro-7' => __('Style Eleven (Pro)', 'master-addons' ),
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
			'section_form_title_style',
			[
				'label' => __('Title & Description', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'heading_alignment',
			[
				'label'     => __('Alignment', 'master-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => Master_Addons_Helper::jltma_content_alignment(),
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .wpforms-head-container, {{WRAPPER}} .jltma-wpforms-heading' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label'     => __('Title', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'form_title_text_color',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-contact-form-title, {{WRAPPER}} .wpforms-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'form_title_typography',
				'label'    => __('Typography', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-contact-form-title, {{WRAPPER}} .wpforms-title',
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
					'{{WRAPPER}} .jltma-contact-form-title, {{WRAPPER}} .wpforms-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'description_heading',
			[
				'label'     => __('Description', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'form_description_text_color',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-contact-form-description, {{WRAPPER}} .wpforms-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'form_description_typography',
				'label'    => __('Typography', 'master-addons' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .jltma-contact-form-description, {{WRAPPER}} .wpforms-description',
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
					'{{WRAPPER}} .jltma-contact-form-description, {{WRAPPER}} .wpforms-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-field label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_label',
				'label'    => __('Typography', 'master-addons' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .jltma-wpforms .wpforms-field label',
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
				'label'     => __('Alignment', 'master-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => Master_Addons_Helper::jltma_content_alignment(),
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-wpforms .wpforms-field textarea, {{WRAPPER}} .jltma-wpforms .wpforms-field select' => 'text-align: {{VALUE}};',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-wpforms .wpforms-field textarea, {{WRAPPER}} .jltma-wpforms .wpforms-field select' => 'background-color: {{VALUE}}',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-wpforms .wpforms-field textarea, {{WRAPPER}} .jltma-wpforms .wpforms-field select' => 'color: {{VALUE}}',
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
				'selector'    => '{{WRAPPER}} .jltma-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-wpforms .wpforms-field textarea, {{WRAPPER}} .jltma-wpforms .wpforms-field select',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-wpforms .wpforms-field textarea, {{WRAPPER}} .jltma-wpforms .wpforms-field select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_indent',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-wpforms .wpforms-field textarea, {{WRAPPER}} .jltma-wpforms .wpforms-field select' => 'text-indent: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-wpforms .wpforms-field select' => 'width: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-wpforms .wpforms-field select' => 'height: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-field textarea' => 'width: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-field textarea' => 'height: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-wpforms .wpforms-field textarea, {{WRAPPER}} .jltma-wpforms .wpforms-field select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-field' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'field_typography',
				'label'     => __('Typography', 'master-addons' ),
				'scheme'    => Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .jltma-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-wpforms .wpforms-field textarea, {{WRAPPER}} .jltma-wpforms .wpforms-field select',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'field_box_shadow',
				'selector'  => '{{WRAPPER}} .jltma-wpforms .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-wpforms .wpforms-field textarea, {{WRAPPER}} .jltma-wpforms .wpforms-field select',
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

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'focus_input_border',
				'label'       => __('Border', 'master-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-wpforms .wpforms-field input:focus, {{WRAPPER}} .jltma-wpforms .wpforms-field textarea:focus',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'focus_box_shadow',
				'selector'  => '{{WRAPPER}} .jltma-wpforms .wpforms-field input:focus, {{WRAPPER}} .jltma-wpforms .wpforms-field textarea:focus',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-field .wpforms-field-description, {{WRAPPER}} .jltma-wpforms .wpforms-field .wpforms-field-sublabel' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'field_description_typography',
				'label'    => __('Typography', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-wpforms .wpforms-field .wpforms-field-description, {{WRAPPER}} .jltma-wpforms .wpforms-field .wpforms-field-sublabel',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-field .wpforms-field-description, {{WRAPPER}} .jltma-wpforms .wpforms-field .wpforms-field-sublabel' => 'padding-top: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-field input::-webkit-input-placeholder, {{WRAPPER}} .jltma-wpforms .wpforms-field textarea::-webkit-input-placeholder' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .jltma-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .jltma-custom-radio-checkbox input[type="radio"]' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}}',
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
			'radio_checkbox_border_width',
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
			'radio_checkbox_border_color',
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
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-wpforms .wpforms-submit-container'                 => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .jltma-wpforms .wpforms-submit-container .wpforms-submit' => 'display:inline-block;'
				],
				'condition'             => [
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
				'prefix_class' => 'jltma-wpforms-form-button-',
			]
		);

		$this->add_responsive_control(
			'button_width',
			[
				'label'   => __('Width', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => '100',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-submit-container .wpforms-submit' => 'width: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-submit-container .wpforms-submit' => 'background-color: {{VALUE}}',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-submit-container .wpforms-submit' => 'color: {{VALUE}}',
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
				'selector'    => '{{WRAPPER}} .jltma-wpforms .wpforms-submit-container .wpforms-submit',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-wpforms .wpforms-submit-container .wpforms-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-submit-container .wpforms-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-submit-container' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'button_typography',
				'label'     => __('Typography', 'master-addons' ),
				'scheme'    => Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .jltma-wpforms .wpforms-submit-container .wpforms-submit',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'button_box_shadow',
				'selector'  => '{{WRAPPER}} .jltma-wpforms .wpforms-submit-container .wpforms-submit',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-submit-container .wpforms-submit:hover' => 'background-color: {{VALUE}}',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-submit-container .wpforms-submit:hover' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .jltma-wpforms .wpforms-submit-container .wpforms-submit:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Style Tab: Errors
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_error_style',
			[
				'label'     => __('Errors', 'master-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'error_messages' => 'show',
				],
			]
		);

		$this->add_control(
			'error_message_text_color',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-wpforms label.wpforms-error' => 'color: {{VALUE}}',
				],
				'condition'             => [
					'error_messages' => 'show',
				],
			]
		);

		$this->add_control(
			'error_field_input_border_color',
			[
				'label'     => __('Error Field Input Border Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-wpforms input.wpforms-error, {{WRAPPER}} .jltma-wpforms textarea.wpforms-error'
					=>  'border-color: {{VALUE}}',
				],
				'condition'             => [
					'error_messages' => 'show',
				],
			]
		);

		$this->add_control(
			'error_field_input_border_width',
			[
				'label'     => __('Error Field Input Border Width', 'master-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'min'       => 1,
				'max'       => 10,
				'step'      => 1,
				'selectors' => [
					'{{WRAPPER}} .jltma-wpforms input.wpforms-error, {{WRAPPER}} .jltma-wpforms textarea.wpforms-error'
					=>  'border-width: {{VALUE}}px',
				],
				'condition'             => [
					'error_messages' => 'show',
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
		$settings = $this->get_settings();

		// if WP Forms Missing
		if (!function_exists('wpforms')) {
			Master_Addons_Helper::jltma_elementor_plugin_missing_notice(array('plugin_name' => esc_html__('WP Forms', 'master-addons' )));
			return;
		}


		$this->add_render_attribute(
			'contact-form',
			'class',
			[
				'jltma-contact-form',
				'jltma-wpforms',
				'ma-cf',
				'ma-cf-' . esc_attr($settings['ma_wpform_layout_style']),
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

		if (class_exists('WPForms')) {
			if (!empty($settings['contact_form_list'])) { ?>
				<div <?php echo $this->get_render_attribute_string('contact-form'); ?>>
					<?php if ($settings['custom_title_description'] == 'yes') { ?>
						<div class="jltma-wpforms-heading">
							<?php if ($settings['form_title_custom'] != '') { ?>
								<h3 class="jltma-contact-form-title jltma-wpforms-title">
									<?php echo esc_attr($settings['form_title_custom']); ?>
								</h3>
							<?php } ?>
							<?php if ($settings['form_description_custom'] != '') { ?>
								<div class="jltma-contact-form-description jltma-wpforms-description">
									<?php echo $this->parse_text_editor($settings['form_description_custom']); ?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
					<?php
					$ma_el_form_title       = $settings['form_title'];
					$ma_el_form_description = $settings['form_description'];

					if ($settings['custom_title_description'] == 'yes') {
						$ma_el_form_title       = false;
						$ma_el_form_description = false;
					}

					echo wpforms_display(
						$settings['contact_form_list'],
						$ma_el_form_title,
						$ma_el_form_description
					);
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
