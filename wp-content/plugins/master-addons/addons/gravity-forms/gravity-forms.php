<?php

namespace MasterAddons\Addons;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 6/27/19
 */
if (!defined('ABSPATH')) exit; // If this file is called directly, abort.


class JLTMA_Gravity_Forms extends Widget_Base
{

	public function get_name()
	{
		return 'ma-gravity-forms';
	}

	public function get_title()
	{
		return esc_html__('Gravity Forms', 'master-addons' );
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
					'label' => esc_html__('Unlock more possibilities', 'master-addons' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', 'master-addons' ),
							'icon' => 'fa fa-unlock-alt',
						],
					],
					'default' => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}


		if (ma_el_fs()->can_use_premium_code()) {



			/**
			 * Master Addons: Gravity Form
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_gravity_form',
				[
					'label'                 => __('Gravity Forms', 'master-addons' ),
				]
			);

			$this->add_control(
				'jltma_gf_layout_style',
				[
					'label' => __('Design Variations', 'master-addons' ),
					'type' => Controls_Manager::SELECT,
					'default' => '1',
					'options' => [
						'1'   => __('Style One', 'master-addons' ),
						'2'   => __('Style Two', 'master-addons' ),
						'3'   => __('Style Three', 'master-addons' ),
						'4'   => __('Style Four', 'master-addons' ),
						'5'   => __('Style Five', 'master-addons' ),
						'6'   => __('Style Six', 'master-addons' ),
						'7'   => __('Style Seven', 'master-addons' ),
						'8'   => __('Style Eight', 'master-addons' ),
						'9'   => __('Style Nine', 'master-addons' ),
						'10'   => __('Style Ten', 'master-addons' ),
						'11'   => __('Style Eleven', 'master-addons' ),
					]
				]
			);



			$this->add_control(
				'contact_form_list',
				[
					'label'                 => esc_html__('Contact Form', 'master-addons' ),
					'type'                  => Controls_Manager::SELECT,
					'label_block'           => true,
					'options'               => Master_Addons_Helper::ma_el_get_gravity_forms(),
					'default'               => '0',
				]
			);

			$this->add_control(
				'custom_title_description',
				[
					'label'                 => __('Custom Title & Description', 'master-addons' ),
					'type'                  => Controls_Manager::SWITCHER,
					'label_on'              => __('Yes', 'master-addons' ),
					'label_off'             => __('No', 'master-addons' ),
					'return_value'          => 'yes',
				]
			);

			$this->add_control(
				'form_title',
				[
					'label'                 => __('Title', 'master-addons' ),
					'type'                  => Controls_Manager::SWITCHER,
					'default'               => 'yes',
					'label_on'              => __('Show', 'master-addons' ),
					'label_off'             => __('Hide', 'master-addons' ),
					'return_value'          => 'yes',
					'condition'             => [
						'custom_title_description!'   => 'yes',
					],
				]
			);

			$this->add_control(
				'form_description',
				[
					'label'                 => __('Description', 'master-addons' ),
					'type'                  => Controls_Manager::SWITCHER,
					'default'               => 'yes',
					'label_on'              => __('Show', 'master-addons' ),
					'label_off'             => __('Hide', 'master-addons' ),
					'return_value'          => 'yes',
					'condition'             => [
						'custom_title_description!'   => 'yes',
					],
				]
			);

			$this->add_control(
				'form_title_custom',
				[
					'label'                 => esc_html__('Title', 'master-addons' ),
					'type'                  => Controls_Manager::TEXT,
					'label_block'           => true,
					'default'               => '',
					'condition'             => [
						'custom_title_description'   => 'yes',
					],
				]
			);

			$this->add_control(
				'form_description_custom',
				[
					'label'                 => esc_html__('Description', 'master-addons' ),
					'type'                  => Controls_Manager::TEXTAREA,
					'default'               => '',
					'condition'             => [
						'custom_title_description'   => 'yes',
					],
				]
			);

			$this->add_control(
				'labels_switch',
				[
					'label'                 => __('Labels', 'master-addons' ),
					'type'                  => Controls_Manager::SWITCHER,
					'default'               => 'yes',
					'label_on'              => __('Show', 'master-addons' ),
					'label_off'             => __('Hide', 'master-addons' ),
					'return_value'          => 'yes',
				]
			);

			$this->add_control(
				'placeholder_switch',
				[
					'label'                 => __('Placeholder', 'master-addons' ),
					'type'                  => Controls_Manager::SWITCHER,
					'default'               => 'yes',
					'label_on'              => __('Show', 'master-addons' ),
					'label_off'             => __('Hide', 'master-addons' ),
					'return_value'          => 'yes',
				]
			);

			$this->add_control(
				'form_ajax',
				[
					'label'                 => __('Use Ajax', 'master-addons' ),
					'type'                  => Controls_Manager::SWITCHER,
					'description'           => __('Use ajax to submit the form', 'master-addons' ),
					'label_on'              => __('Yes', 'master-addons' ),
					'label_off'             => __('No', 'master-addons' ),
					'return_value'          => 'yes',
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
					'label'                 => __('Errors', 'master-addons' ),
				]
			);

			$this->add_control(
				'error_messages',
				[
					'label'                 => __('Error Messages', 'master-addons' ),
					'type'                  => Controls_Manager::SELECT,
					'default'               => 'show',
					'options'               => [
						'show'          => __('Show', 'master-addons' ),
						'hide'          => __('Hide', 'master-addons' ),
					],
					'selectors_dictionary'  => [
						'show'          => 'block',
						'hide'          => 'none',
					],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .validation_message' => 'display: {{VALUE}} !important;',
					],
				]
			);

			$this->add_control(
				'validation_errors',
				[
					'label'                 => __('Validation Errors', 'master-addons' ),
					'type'                  => Controls_Manager::SELECT,
					'default'               => 'show',
					'options'               => [
						'show'          => __('Show', 'master-addons' ),
						'hide'          => __('Hide', 'master-addons' ),
					],
					'selectors_dictionary'  => [
						'show'          => 'block',
						'hide'          => 'none',
					],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .validation_error' => 'display: {{VALUE}} !important;',
					],
				]
			);

			$this->end_controls_section();

			/*-----------------------------------------------------------------------------------*/
			/*	STYLE TAB
			/*-----------------------------------------------------------------------------------*/

			/**
			 * Style Tab: Title and Description
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_general_style',
				[
					'label'                 => __('Title & Description', 'master-addons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'heading_alignment',
				[
					'label'                 => __('Alignment', 'master-addons' ),
					'type'                  => Controls_Manager::CHOOSE,
					'options'               => [
						'left'        => [
							'title'   => __('Left', 'master-addons' ),
							'icon'    => 'eicon-h-align-left',
						],
						'center'      => [
							'title'   => __('Center', 'master-addons' ),
							'icon'    => 'eicon-h-align-center',
						],
						'right'       => [
							'title'   => __('Right', 'master-addons' ),
							'icon'    => 'eicon-h-align-right',
						],
					],
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gform_title, {{WRAPPER}} .jltma-gravity-form .jltma-gravity-form-heading' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_heading',
				[
					'label'                 => __('Title', 'master-addons' ),
					'type'                  => Controls_Manager::HEADING,
					'separator'             => 'before',
				]
			);

			$this->add_control(
				'title_text_color',
				[
					'label'                 => __('Text Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gform_title, {{WRAPPER}} .jltma-gravity-form .jltma-gravity-form-title' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'title_typography',
					'label'                 => __('Typography', 'master-addons' ),
					'scheme'    			=> Typography::TYPOGRAPHY_4,
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gform_title, {{WRAPPER}} .jltma-gravity-form .jltma-gravity-form-title',
				]
			);

			$this->add_control(
				'description_heading',
				[
					'label'                 => __('Description', 'master-addons' ),
					'type'                  => Controls_Manager::HEADING,
					'separator'             => 'before',
				]
			);

			$this->add_control(
				'description_text_color',
				[
					'label'                 => __('Text Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gform_description, {{WRAPPER}} .jltma-gravity-form .jltma-gravity-form-description' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'description_typography',
					'label'                 => __('Typography', 'master-addons' ),
					'scheme'    			=> Typography::TYPOGRAPHY_4,
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gform_description, {{WRAPPER}} .jltma-gravity-form .jltma-gravity-form-description',
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
					'label'                 => __('Labels', 'master-addons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
					'condition'             => [
						'labels_switch'   => 'yes',
					],
				]
			);

			$this->add_control(
				'text_color_label',
				[
					'label'                 => __('Text Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield label' => 'color: {{VALUE}}',
					],
					'condition'             => [
						'labels_switch'   => 'yes',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'typography_label',
					'label'                 => __('Typography', 'master-addons' ),
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gfield label',
					'condition'             => [
						'labels_switch'   => 'yes',
					],
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
					'label'                 => __('Input & Textarea', 'master-addons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'input_alignment',
				[
					'label'                 => __('Alignment', 'master-addons' ),
					'type'                  => Controls_Manager::CHOOSE,
					'options'               => [
						'left'        => [
							'title'   => __('Left', 'master-addons' ),
							'icon'    => 'eicon-h-align-left',
						],
						'center'      => [
							'title'   => __('Center', 'master-addons' ),
							'icon'    => 'eicon-h-align-center',
						],
						'right'       => [
							'title'   => __('Right', 'master-addons' ),
							'icon'    => 'eicon-h-align-right',
						],
					],
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield input[type="text"], {{WRAPPER}} .jltma-gravity-form .gfield textarea' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->start_controls_tabs('tabs_fields_style');

			$this->start_controls_tab(
				'tab_fields_normal',
				[
					'label'                 => __('Normal', 'master-addons' ),
				]
			);

			$this->add_control(
				'field_bg_color',
				[
					'label'                 => __('Background Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-gravity-form .gfield textarea, {{WRAPPER}} .jltma-gravity-form .gfield select' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'field_text_color',
				[
					'label'                 => __('Text Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-gravity-form .gfield textarea, {{WRAPPER}} .jltma-gravity-form .gfield select' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'field_spacing',
				[
					'label'                 => __('Spacing', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 100,
							'step'  => 1,
						],
					],
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'field_padding',
				[
					'label'                 => __('Padding', 'master-addons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => ['px', 'em', '%'],
					'default'               => [
						'top'       => '10',
						'right'     => '10',
						'bottom'    => '10',
						'left'      => '10',
						'unit'      => '',
						'isLinked'  => true,
					],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-gravity-form .gfield textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'text_indent',
				[
					'label'                 => __('Text Indent', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 60,
							'step'  => 1,
						],
						'%'         => [
							'min'   => 0,
							'max'   => 30,
							'step'  => 1,
						],
					],
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-gravity-form .gfield textarea, {{WRAPPER}} .jltma-gravity-form .gfield select' => 'text-indent: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'input_width',
				[
					'label'                 => __('Input Width', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px' => [
							'min'   => 0,
							'max'   => 1200,
							'step'  => 1,
						],
					],
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-gravity-form .gfield select' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'input_height',
				[
					'label'                 => __('Input Height', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px' => [
							'min'   => 0,
							'max'   => 80,
							'step'  => 1,
						],
					],
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-gravity-form .gfield select' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'textarea_width',
				[
					'label'                 => __('Textarea Width', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px' => [
							'min'   => 0,
							'max'   => 1200,
							'step'  => 1,
						],
					],
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield textarea' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'textarea_height',
				[
					'label'                 => __('Textarea Height', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px' => [
							'min'   => 0,
							'max'   => 400,
							'step'  => 1,
						],
					],
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield textarea' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'                  => 'field_border',
					'label'                 => __('Border', 'master-addons' ),
					'placeholder'           => '1px',
					'default'               => '1px',
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-gravity-form .gfield textarea, {{WRAPPER}} .jltma-gravity-form .gfield select',
					'separator'             => 'before',
				]
			);

			$this->add_control(
				'field_radius',
				[
					'label'                 => __('Border Radius', 'master-addons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-gravity-form .gfield textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'field_typography',
					'label'                 => __('Typography', 'master-addons' ),
					'scheme'    			=> Typography::TYPOGRAPHY_4,
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-gravity-form .gfield textarea, {{WRAPPER}} .jltma-gravity-form .gfield select',
					'separator'             => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'                  => 'field_box_shadow',
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .jltma-gravity-form .gfield textarea, {{WRAPPER}} .jltma-gravity-form .gfield select',
					'separator'             => 'before',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_fields_focus',
				[
					'label'                 => __('Focus', 'master-addons' ),
				]
			);

			$this->add_control(
				'field_bg_color_focus',
				[
					'label'                 => __('Background Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield input:focus, {{WRAPPER}} .jltma-gravity-form .gfield textarea:focus' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'                  => 'focus_input_border',
					'label'                 => __('Border', 'master-addons' ),
					'placeholder'           => '1px',
					'default'               => '1px',
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gfield input:focus, {{WRAPPER}} .jltma-gravity-form .gfield textarea:focus',
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'                  => 'focus_box_shadow',
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gfield input:focus, {{WRAPPER}} .jltma-gravity-form .gfield textarea:focus',
					'separator'             => 'before',
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
					'label'                 => __('Field Description', 'master-addons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'field_description_text_color',
				[
					'label'                 => __('Text Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield .gfield_post_tags_hint' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'field_description_typography',
					'label'                 => __('Typography', 'master-addons' ),
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gfield .gfield_post_tags_hint',
				]
			);

			$this->add_responsive_control(
				'field_description_spacing',
				[
					'label'                 => __('Spacing', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 100,
							'step'  => 1,
						],
					],
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield .gfield_post_tags_hint' => 'padding-top: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->end_controls_section();

			/**
			 * Style Tab: Section Field
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_field_style',
				[
					'label'                 => __('Section Field', 'master-addons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'section_field_text_color',
				[
					'label'                 => __('Text Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield.gsection .gsection_title' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'section_field_typography',
					'label'                 => __('Typography', 'master-addons' ),
					'scheme'    			=> Typography::TYPOGRAPHY_4,
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gfield.gsection .gsection_title',
					'separator'             => 'before',
				]
			);

			$this->add_control(
				'section_field_border_type',
				[
					'label'                 => __('Border Type', 'master-addons' ),
					'type'                  => Controls_Manager::SELECT,
					'default'               => 'solid',
					'options'               => [
						'none'      => __('None', 'master-addons' ),
						'solid'     => __('Solid', 'master-addons' ),
						'double'    => __('Double', 'master-addons' ),
						'dotted'    => __('Dotted', 'master-addons' ),
						'dashed'    => __('Dashed', 'master-addons' ),
					],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield.gsection' => 'border-bottom-style: {{VALUE}}',
					],
					'separator'             => 'before',
				]
			);

			$this->add_responsive_control(
				'section_field_border_height',
				[
					'label'                 => __('Border Height', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'default'               => [
						'size'  => 1,
					],
					'range'                 => [
						'px' => [
							'min'   => 1,
							'max'   => 20,
							'step'  => 1,
						],
					],
					'size_units'            => ['px'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield.gsection' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
					],
					'condition'             => [
						'section_field_border_type!'   => 'none',
					],
				]
			);

			$this->add_control(
				'section_field_border_color',
				[
					'label'                 => __('Border Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield.gsection' => 'border-bottom-color: {{VALUE}}',
					],
					'condition'             => [
						'section_field_border_type!'   => 'none',
					],
				]
			);

			$this->add_responsive_control(
				'section_field_margin',
				[
					'label'                 => __('Margin', 'master-addons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield.gsection' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'             => 'before',
				]
			);

			$this->end_controls_section();

			/**
			 * Style Tab: Section Field
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_price_style',
				[
					'label'                 => __('Price', 'master-addons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'price_label_color',
				[
					'label'                 => __('Price Label Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper .ginput_product_price_label' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'price_text_color',
				[
					'label'                 => __('Price Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper .ginput_product_price_wrapper .ginput_product_price' => 'color: {{VALUE}} !important',
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
					'label'                 => __('Placeholder', 'master-addons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
					'condition'             => [
						'placeholder_switch'   => 'yes',
					],
				]
			);

			$this->add_control(
				'text_color_placeholder',
				[
					'label'                 => __('Text Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield input::-webkit-input-placeholder, {{WRAPPER}} .jltma-gravity-form .gfield textarea::-webkit-input-placeholder' => 'color: {{VALUE}}',
					],
					'condition'             => [
						'placeholder_switch'   => 'yes',
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
					'label'                 => __('Radio & Checkbox', 'master-addons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'custom_radio_checkbox',
				[
					'label'                 => __('Custom Styles', 'master-addons' ),
					'type'                  => Controls_Manager::SWITCHER,
					'label_on'              => __('Yes', 'master-addons' ),
					'label_off'             => __('No', 'master-addons' ),
					'return_value'          => 'yes',
				]
			);

			$this->add_responsive_control(
				'radio_checkbox_size',
				[
					'label'                 => __('Size', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'default'               => [
						'size'      => '15',
						'unit'      => 'px'
					],
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 80,
							'step'  => 1,
						],
					],
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
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
					'label'                 => __('Normal', 'master-addons' ),
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->add_control(
				'radio_checkbox_color',
				[
					'label'                 => __('Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
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
					'label'                 => __('Border Width', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 15,
							'step'  => 1,
						],
					],
					'size_units'            => ['px'],
					'selectors'             => [
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
					'label'                 => __('Border Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
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
					'label'                 => __('Checkbox', 'master-addons' ),
					'type'                  => Controls_Manager::HEADING,
					'separator'             => 'before',
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->add_control(
				'checkbox_border_radius',
				[
					'label'                 => __('Border Radius', 'master-addons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
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
					'label'                 => __('Radio Buttons', 'master-addons' ),
					'type'                  => Controls_Manager::HEADING,
					'separator'             => 'before',
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->add_control(
				'radio_border_radius',
				[
					'label'                 => __('Border Radius', 'master-addons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
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
					'label'                 => __('Checked', 'master-addons' ),
					'condition'             => [
						'custom_radio_checkbox' => 'yes',
					],
				]
			);

			$this->add_control(
				'radio_checkbox_color_checked',
				[
					'label'                 => __('Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
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
					'label'                 => __('Submit Button', 'master-addons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'button_align',
				[
					'label'                 => __('Alignment', 'master-addons' ),
					'type'                  => Controls_Manager::CHOOSE,
					'options'               => [
						'left'        => [
							'title'   => __('Left', 'master-addons' ),
							'icon'    => 'eicon-h-align-left',
						],
						'center'      => [
							'title'   => __('Center', 'master-addons' ),
							'icon'    => 'eicon-h-align-center',
						],
						'right'       => [
							'title'   => __('Right', 'master-addons' ),
							'icon'    => 'eicon-h-align-right',
						],
					],
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_footer,
                    {{WRAPPER}} .jltma-gravity-form .gform_page_footer'   => 'text-align: {{VALUE}};',
					],
					'condition'             => [
						'button_width_type!' => 'full-width',
					],
				]
			);

			$this->add_control(
				'button_width_type',
				[
					'label'                 => __('Width', 'master-addons' ),
					'type'                  => Controls_Manager::SELECT,
					'default'               => 'custom',
					'options'               => [
						'auto'          => __('Auto', 'master-addons' ),
						'full-width'    => __('Full Width', 'master-addons' ),
						'custom'        => __('Custom', 'master-addons' ),
					],
					'prefix_class'          => 'ma-el-gravity-form-button-',
				]
			);

			$this->add_responsive_control(
				'button_width',
				[
					'label'                 => __('Width', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'default'               => [
						'size'      => '',
						'unit'      => 'px'
					],
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 1200,
							'step'  => 1,
						],
					],
					'size_units'            => ['px', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_footer input[type="submit"], {{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="submit"]' => 'width: {{SIZE}}{{UNIT}}',
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
					'label'                 => __('Normal', 'master-addons' ),
				]
			);

			$this->add_control(
				'button_bg_color_normal',
				[
					'label'                 => __('Background Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_footer input[type="submit"],
                    {{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="submit"]' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_text_color_normal',
				[
					'label'                 => __('Text Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_footer input[type="submit"],
                    {{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="submit"]' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'                  => 'button_border_normal',
					'label'                 => __('Border', 'master-addons' ),
					'placeholder'           => '1px',
					'default'               => '1px',
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_footer input[type="submit"], {{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="submit"]',
				]
			);

			$this->add_control(
				'button_border_radius',
				[
					'label'                 => __('Border Radius', 'master-addons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_footer input[type="submit"], {{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'button_padding',
				[
					'label'                 => __('Padding', 'master-addons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_footer input[type="submit"], {{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'button_margin',
				[
					'label'                 => __('Margin Top', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 100,
							'step'  => 1,
						],
					],
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_footer input[type="submit"], {{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="submit"]' => 'margin-top: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'button_typography',
					'label'                 => __('Typography', 'master-addons' ),
					'scheme'    			=> Typography::TYPOGRAPHY_4,
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_footer input[type="submit"], {{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="submit"]',
					'separator'             => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'                  => 'button_box_shadow',
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_footer input[type="submit"], {{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="submit"]',
					'separator'             => 'before',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_button_hover',
				[
					'label'                 => __('Hover', 'master-addons' ),
				]
			);

			$this->add_control(
				'button_bg_color_hover',
				[
					'label'                 => __('Background Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_footer input[type="submit"]:hover, {{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="submit"]:hover' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_text_color_hover',
				[
					'label'                 => __('Text Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_footer input[type="submit"]:hover, {{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="submit"]:hover' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_border_color_hover',
				[
					'label'                 => __('Border Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_footer input[type="submit"]:hover, {{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="submit"]:hover' => 'border-color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->end_controls_section();

			/**
			 * Style Tab: Pagination
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_pagination_style',
				[
					'label'                 => __('Pagination', 'master-addons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'pagination_buttons_width_type',
				[
					'label'                 => __('Width', 'master-addons' ),
					'type'                  => Controls_Manager::SELECT,
					'default'               => 'auto',
					'options'               => [
						'auto'          => __('Auto', 'master-addons' ),
						'full-width'    => __('Full Width', 'master-addons' ),
						'custom'        => __('Custom', 'master-addons' ),
					],
					'prefix_class'          => 'ma-el-gravity-form-pagination-buttons-',
				]
			);

			$this->add_responsive_control(
				'pagination_buttons_width',
				[
					'label'                 => __('Width', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'default'               => [
						'size'      => '100',
						'unit'      => 'px'
					],
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 1200,
							'step'  => 1,
						],
					],
					'size_units'            => ['px', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="button"]' => 'width: {{SIZE}}{{UNIT}}',
					],
					'condition'             => [
						'pagination_buttons_width_type' => 'custom',
					],
				]
			);

			$this->start_controls_tabs('tabs_pagination_buttons_style');

			$this->start_controls_tab(
				'tab_pagination_buttons_normal',
				[
					'label'                 => __('Normal', 'master-addons' ),
				]
			);

			$this->add_control(
				'pagination_buttons_bg_color_normal',
				[
					'label'                 => __('Background Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="button"]' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'pagination_buttons_text_color_normal',
				[
					'label'                 => __('Text Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="button"]' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'                  => 'pagination_buttons_border_normal',
					'label'                 => __('Border', 'master-addons' ),
					'placeholder'           => '1px',
					'default'               => '1px',
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="button"]',
				]
			);

			$this->add_control(
				'pagination_buttons_border_radius',
				[
					'label'                 => __('Border Radius', 'master-addons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="button"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'pagination_buttons_padding',
				[
					'label'                 => __('Padding', 'master-addons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="button"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'pagination_buttons_margin',
				[
					'label'                 => __('Margin Top', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 100,
							'step'  => 1,
						],
					],
					'size_units'            => ['px', 'em', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="button"]' => 'margin-top: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'pagination_buttons_typography',
					'label'                 => __('Typography', 'master-addons' ),
					'scheme'    			=> Typography::TYPOGRAPHY_4,
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="button"]',
					'separator'             => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'                  => 'pagination_buttons_box_shadow',
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="button"]',
					'separator'             => 'before',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_pagination_buttons_hover',
				[
					'label'                 => __('Hover', 'master-addons' ),
				]
			);

			$this->add_control(
				'pagination_buttons_bg_color_hover',
				[
					'label'                 => __('Background Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="button"]:hover' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'pagination_buttons_text_color_hover',
				[
					'label'                 => __('Text Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="button"]:hover' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'pagination_buttons_border_color_hover',
				[
					'label'                 => __('Border Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_page_footer input[type="button"]:hover' => 'border-color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->end_controls_section();

			/**
			 * Style Tab: Progress Bar
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_progress_bar_style',
				[
					'label'                 => __('Progress Bar', 'master-addons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->start_controls_tabs('tabs_progress_bar_style');

			$this->start_controls_tab(
				'tab_progress_bar_default',
				[
					'label'                 => __('Default', 'master-addons' ),
				]
			);

			$this->add_control(
				'progress_bar_default_bg',
				[
					'label'                 => __('Background Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'progress_bar_text_color',
				[
					'label'                 => __('Text Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar_percentage span' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'progress_bar_typography',
					'label'                 => __('Typography', 'master-addons' ),
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar_percentage span',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'                  => 'progress_bar_default_border',
					'label'                 => __('Border', 'master-addons' ),
					'placeholder'           => '1px',
					'default'               => '1px',
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar',
				]
			);

			$this->add_control(
				'progress_bar_border_radius',
				[
					'label'                 => __('Border Radius', 'master-addons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => ['px', '%'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar, {{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar_percentage, {{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'progress_bar_default_padding',
				[
					'label'                 => __('Padding', 'master-addons' ),
					'type'                  => Controls_Manager::DIMENSIONS,
					'size_units'            => ['px'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'                  => 'progress_bar_default_box_shadow',
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_progress_bar_progress',
				[
					'label'                 => __('Progress', 'master-addons' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'                  => 'progress_bar_bg',
					'label'                 => __('Background', 'master-addons' ),
					'types'                 => ['classic', 'gradient'],
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar_percentage',
					'exclude'               => ['image'],
				]
			);

			$this->add_responsive_control(
				'progress_bar_height',
				[
					'label'                 => __('Height', 'master-addons' ),
					'type'                  => Controls_Manager::SLIDER,
					'range'                 => [
						'px'        => [
							'min'   => 0,
							'max'   => 100,
							'step'  => 1,
						],
					],
					'size_units'            => ['px'],
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar_percentage, {{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar:after' => 'height: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar:after' => 'margin-top: -{{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'                  => 'progress_bar_progress_box_shadow',
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar:after',
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control(
				'progress_bar_label_heading',
				[
					'label'                 => __('Label', 'master-addons' ),
					'type'                  => Controls_Manager::HEADING,
					'separator'             => 'before',
				]
			);

			$this->add_control(
				'progress_bar_label_color',
				[
					'label'                 => __('Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar_wrapper .gf_progressbar_title, {{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_step' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'                  => 'progress_bar_label_typography',
					'label'                 => __('Typography', 'master-addons' ),
					'selector'              => '{{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_progressbar_wrapper .gf_progressbar_title, {{WRAPPER}} .jltma-gravity-form .gform_wrapper .gf_step',
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
					'label'                 => __('Errors', 'master-addons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'error_messages_heading',
				[
					'label'                 => __('Error Messages', 'master-addons' ),
					'type'                  => Controls_Manager::HEADING,
					'condition'             => [
						'error_messages' => 'show',
					],
				]
			);

			$this->add_control(
				'error_message_text_color',
				[
					'label'                 => __('Text Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield .validation_message' => 'color: {{VALUE}}',
					],
					'condition'             => [
						'error_messages' => 'show',
					],
				]
			);

			$this->add_control(
				'validation_errors_heading',
				[
					'label'                 => __('Validation Errors', 'master-addons' ),
					'type'                  => Controls_Manager::HEADING,
					'separator'             => 'before',
					'condition'             => [
						'validation_errors' => 'show',
					],
				]
			);

			$this->add_control(
				'validation_error_description_color',
				[
					'label'                 => __('Error Description Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper .validation_error' => 'color: {{VALUE}}',
					],
					'condition'             => [
						'validation_errors' => 'show',
					],
				]
			);

			$this->add_control(
				'validation_error_border_color',
				[
					'label'                 => __('Error Border Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper .validation_error' => 'border-top-color: {{VALUE}}; border-bottom-color: {{VALUE}}',
						'{{WRAPPER}} .jltma-gravity-form .gfield_error' => 'border-top-color: {{VALUE}}; border-bottom-color: {{VALUE}}',
					],
					'condition'             => [
						'validation_errors' => 'show',
					],
				]
			);

			$this->add_control(
				'validation_errors_bg_color',
				[
					'label'                 => __('Error Field Background Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield_error' => 'background: {{VALUE}}',
					],
					'condition'             => [
						'validation_errors' => 'show',
					],
				]
			);

			$this->add_control(
				'validation_error_field_label_color',
				[
					'label'                 => __('Error Field Label Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gfield_error .gfield_label' => 'color: {{VALUE}}',
					],
					'condition'             => [
						'validation_errors' => 'show',
					],
				]
			);

			$this->add_control(
				'validation_error_field_input_border_color',
				[
					'label'                 => __('Error Field Input Border Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper li.gfield_error input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .gform_wrapper li.gfield_error textarea' => 'border-color: {{VALUE}}',
					],
					'condition'             => [
						'validation_errors' => 'show',
					],
				]
			);

			$this->add_control(
				'validation_error_field_input_border_width',
				[
					'label'                 => __('Error Field Input Border Width', 'master-addons' ),
					'type'                  => Controls_Manager::NUMBER,
					'default'               => 1,
					'min'                   => 1,
					'max'                   => 10,
					'step'                  => 1,
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_wrapper li.gfield_error input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .gform_wrapper li.gfield_error textarea' => 'border-width: {{VALUE}}px',
					],
					'condition'             => [
						'validation_errors' => 'show',
					],
				]
			);

			$this->end_controls_section();

			/**
			 * Style Tab: Thank You Message
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_ty_style',
				[
					'label'                 => __('Thank You Message', 'master-addons' ),
					'tab'                   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'ty_message_text_color',
				[
					'label'                 => __('Text Color', 'master-addons' ),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '',
					'selectors'             => [
						'{{WRAPPER}} .jltma-gravity-form .gform_confirmation_wrapper .gform_confirmation_message' => 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_section();
		} //Premium Code use block end
	}


	protected function render()
	{
		$settings = $this->get_settings();


		if (!class_exists('GFCommon')) {
			Master_Addons_Helper::jltma_elementor_plugin_missing_notice(array('plugin_name' => esc_html__('Gravity Form', 'master-addons' )));
			return;
		}


		$this->add_render_attribute('jltma-gf', 'class', [
			'jltma-gf',
			'ma-cf',
			'jltma-gravity-form',
			'ma-cf-' . esc_attr($settings['jltma_gf_layout_style']),
			'jltma-gf-' . esc_attr($this->get_id())
		]);

		if ($settings['labels_switch'] != 'yes') {
			$this->add_render_attribute('jltma-gf', 'class', 'labels-hide');
		}

		if ($settings['placeholder_switch'] != 'yes') {
			$this->add_render_attribute('jltma-gf', 'class', 'placeholder-hide');
		}

		if ($settings['custom_title_description'] == 'yes') {
			$this->add_render_attribute('jltma-gf', 'class', 'title-description-hide');
		}

		if ($settings['custom_radio_checkbox'] == 'yes') {
			$this->add_render_attribute('jltma-gf', 'class', 'ma-el-custom-radio-checkbox');
		}

		if (class_exists('GFCommon')) {
			if (!empty($settings['contact_form_list'])) { ?>
				<div <?php echo $this->get_render_attribute_string('jltma-gf'); ?>>
					<?php if ($settings['custom_title_description'] == 'yes') { ?>
						<div class="jltma-gravity-form-heading">
							<?php if ($settings['form_title_custom'] != '') { ?>
								<h3 class="jltma-gravity-form-title">
									<?php echo esc_attr($settings['form_title_custom']); ?>
								</h3>
							<?php } ?>
							<?php if ($settings['form_description_custom'] != '') { ?>
								<div class="jltma-gravity-form-description">
									<?php echo $this->parse_text_editor($settings['form_description_custom']); ?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
					<?php
					$jltma_form_id = $settings['contact_form_list'];
					$jltma_form_title = $settings['form_title'];
					$jltma_form_description = $settings['form_description'];
					$jltma_form_ajax = $settings['form_ajax'];

					gravity_form($jltma_form_id, $jltma_form_title, $jltma_form_description, $display_inactive = false, $field_values = null, $jltma_form_ajax, '', $echo = true);
					?>
				</div>
<?php
			} else {
				esc_html__e('Please select a Contact Form!', 'master-addons' );
			}
		}
	}

	protected function content_template()
	{
	}
}
