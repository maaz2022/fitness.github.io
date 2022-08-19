<?php

namespace MasterAddons\Addons;

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 10/6/19
 */


// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Master Addons: Table of Contents
 */
class JLTMA_Table_of_Contents extends Widget_Base
{
	public function get_name()
	{
		return 'ma-table-of-contents';
	}
	public function get_title()
	{
		return __('Table of Contents', 'master-addons' );
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-post-list';
	}

	public function get_style_depends()
	{
		return [
			// 'jltma-table-of-content',
			'font-awesome-5-all',
			'font-awesome-4-shim'
		];
	}

	public function get_script_depends()
	{
		return ['jltma-table-of-content', 'master-addons-scripts'];
	}

	public function get_keywords()
	{
		return ['toc', 'tocplus', 'contentlist', 'markcontent', 'marker', 'table', 'content', 'index', 'table of content'];
	}


	public function get_help_url()
	{
		return 'https://master-addons.com/100-best-elementor-addons/';
	}


	protected function jltma_toc_section_content()
	{

		$this->start_controls_section(
			'ma_el_toc_section_start',
			[
				'label' => __('Table of Contents', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_toc_title',
			array(
				'label'       => __('Enter Title Text', 'master-addons' ),
				'default'     => __('Table of Contents', 'master-addons' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
			)
		);

		$this->add_control(
			'ma_el_toc_bullet_icon',
			array(
				'label'       => __('List Style', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'default'     => 'unordered_list',
				'label_block' => false,
				'options'     => array(
					'none'           => [
						'title'	=> __('Default', 'master-addons' ),
						'icon'	=> 'eicon-ban',
					],
					'unordered_list' => [
						'title'	=> __('Bullets', 'master-addons' ),
						'icon'	=> 'eicon-bullet-list',
					],
					'ordered_list'   => [
						'title'	=> __('Numbers', 'master-addons' ),
						'icon'	=> 'eicon-number-field',
					]
				),
			)
		);


		$this->start_controls_tabs('jltma_toc_conent_section_tabs');


		$this->start_controls_tab(
			'jltma_toc_content_include_tab',
			[
				'label' => __('Include', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_toc_heading_tags',
			[
				'label'    => __('Heading Tags', 'master-addons' ),
				'description'    => __('Want to ignore any specific heading? Go to that heading advanced tab and enter <b>ignore-this-tag</b> class in <a href="http://prntscr.com/lvw4iy" target="_blank">CSS Classes</a> input field.', 'master-addons' ),
				'type'     => Controls_Manager::SELECT2,
				'multiple' => true,
				'default'  => ['h2', 'h3', 'h4'],
				'options'  => [
					'h1'  => __('H1', 'master-addons' ),
					'h2'  => __('H2', 'master-addons' ),
					'h3'  => __('H3', 'master-addons' ),
					'h4'  => __('H4', 'master-addons' ),
					'h5'  => __('H5', 'master-addons' ),
					'h6'  => __('H6', 'master-addons' ),
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'jltma_toc_content_exclude_tab',
			[
				'label' => __('Exclude', 'master-addons' ),
			]
		);
		$this->jltma_toc_section_exclude_content_controls();
		$this->end_controls_tab();

		$this->end_controls_tabs();



		$this->add_control(
			'ma_el_toc_heading_separator_style',
			array(
				'label'        => __('Show Separator?', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'master-addons' ),
				'label_off'    => __('Hide', 'master-addons' ),
				'separator'    => 'before',
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => array(
					'ma_el_toc_title!' => '',
				),
			)
		);
		$this->jltma_toc_section_collapsible();
		$this->end_controls_section();
	}


	protected function jltma_toc_section_collapsible()
	{
		$this->add_control(
			'ma_el_toc_collapsible_heading',
			[
				'label'                 => __('Collapsible', 'master-addons' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
			]
		);

		$this->add_control(
			'ma_el_toc_collapsible',
			array(
				'label'        => __('Make Content Collapsible', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Yes', 'master-addons' ),
				'label_off'    => __('No', 'master-addons' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'ma_el_toc_auto_collapsible',
			array(
				'label'        => __('Keep Collapsed Initially', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Yes', 'master-addons' ),
				'label_off'    => __('No', 'master-addons' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => array(
					'ma_el_toc_collapsible' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'ma_el_toc_toc_icon_size',
			array(
				'label'      => __('Icon Size', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'em', 'rem'),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 200,
					),
				),
				'default'    => array(
					'size' => 20,
					'unit' => 'px',
				),
				'condition'  => array(
					'ma_el_toc_collapsible' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-toc-switch .jltma-toc-icon:before' => 'font-size: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}}; text-align: center;',
				),
			)
		);

		$this->add_control(
			'ma_el_toc_switch_icon_color',
			array(
				'label'     => __('Icon Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jltma-toc-header .jltma-toc-switch .jltma-toc-icon:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'ma_el_toc_collapsible' => 'yes',
				),
			)
		);
	}


	protected function jltma_toc_section_dropdown()
	{

		/*
		* TOC: Dropdown Options
		*/
		$this->start_controls_section(
			'ma_el_toc_section_dropdown_option',
			[
				'label'     => __('Dropdown Options', 'master-addons' ),
				'condition' => [
					'ma_el_toc_design_type' => 'dropdown',
				]
			]
		);


		$this->add_control(
			'ma_el_toc_dropdown_position',
			[
				'label'   => __('Dropdown Position', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => Master_Addons_Helper::ma_el_content_positions(),
				'default' => 'top-left'
			]
		);



		$this->add_control(
			'ma_el_toc_drop_mode',
			[
				'label'   => __('Mode', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hover',
				'options' => [
					'click'    => __('Click', 'master-addons' ),
					'hover'  => __('Hover', 'master-addons' ),
				],
			]
		);


		//			$this->add_control(
		//				'ma_el_toc_drop_animation',
		//				[
		//					'label'     => __( 'Animation', 'master-addons' ),
		//					'type'      => Controls_Manager::SELECT,
		//					'default'   => 'fade',
		//					'options'   => Master_Addons_Helper::ma_el_transition_options(),
		//					'separator' => 'before',
		//				]
		//			);


		$this->add_control(
			'ma_el_toc_drop_animation',
			[
				'label' => __('Animation', 'master-addons' ),
				'type' => \Elementor\Controls_Manager::ANIMATION,
				//					'prefix_class' => 'animated ',
				'selectors' => [
					'{{WRAPPER}} .table-of-content-layout-dropdown .ma-el-table-of-content'
				],
			]
		);


		$this->add_control(
			'ma_el_toc_drop_duration',
			[
				'label'   => __('Animation Duration', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => .3,
				],
				'range' => [
					'px' => [
						'max' => 10,
						'step' => .1,
					],
				],
				'condition' => [
					'ma_el_toc_drop_animation!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .table-of-content-layout-dropdown .ma-el-table-of-content' => 'transition: all {{ma_el_toc_drop_duration.SIZE}}s ease;',
				],
			]
		);


		$this->end_controls_section();
	}


	/**
	 * Register Advanced Heading Separator Controls.
	 *
	 * @access protected
	 */
	protected function jltma_toc_section_exclude_content_controls()
	{

		$this->add_control(
			'jltma_toc_exclude_headings_doc',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __('Add the CSS class <b>jltma-toc-hide-heading</b> to the heading you want to exclude from the table.', 'master-addons' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			)
		);

		$this->add_control(
			'jltma_toc_exclude_doc_link',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				/* translators: %1$s doc link */
				'raw'             => sprintf(__('%1$s Learn More » %2$s', 'master-addons' ), '<a href=https://master-addons.com/docs/exclude-specific-headings-from-table/?utm_source=jltma-pro-dashboard&utm_medium=jltma-editor-screen&utm_campaign=jltma-pro-plugin" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc',
			)
		);
	}

	/**
	 * Scroll Controls
	 *
	 * @access protected
	 */
	protected function jltma_toc_section_scroll()
	{

		$this->start_controls_section(
			'jltma_toc_scroll_section',
			array(
				'label' => __('Scroll', 'master-addons' ),
			)
		);

		$this->add_control(
			'jltma_toc_scroll_to_top',
			array(
				'label'        => __('Scroll to Top', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'master-addons' ),
				'label_off'    => __('Hide', 'master-addons' ),
				'description'  => __('This will add a Scroll to Top arrow at the bottom of page.', 'master-addons' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_responsive_control(
			'jltma_toc_scroll_to_top_offset',
			array(
				'label'      => __('Scroll to Top Offset', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px'),
				'range'      => array(
					'px' => array(
						'max' => 200,
					),
				),
				'condition'  => array(
					'jltma_toc_scroll_to_top' => 'yes',
				),
			)
		);

		$this->add_control(
			'jltma_toc_scroll_to_top_size',
			array(
				'label'      => __('Size', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('em'),
				'range'      => array(
					'em' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'condition'  => array(
					'jltma_toc_scroll_to_top' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-scroll-top-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; font-size: calc( {{SIZE}}px / 2 );',
				),
			)
		);

		$this->add_control(
			'jltma_toc_scroll_to_top_color',
			array(
				'label'     => __('Icon Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jltma-scroll-top-icon, {{WRAPPER}} a.jltma-scroll-top-icon:hover, {{WRAPPER}} a.jltma-scroll-top-icon:focus' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'jltma_toc_scroll_to_top' => 'yes',
				),
			)
		);

		$this->add_control(
			'jltma_toc_scroll_to_top_bgcolor',
			array(
				'label'     => __('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jltma-scroll-top-icon' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'jltma_toc_scroll_to_top' => 'yes',
				),
			)
		);

		$this->add_control(
			'jltma_toc_scroll',
			array(
				'label'        => __('Smooth Scroll', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('YES', 'master-addons' ),
				'label_off'    => __('NO', 'master-addons' ),
				'description'  => __('Smooth scroll upto destination.', 'master-addons' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'jltma_toc_scroll_time',
			array(
				'label'      => __('Scroll Animation Delay (ms)', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px'),
				'range'      => array(
					'px' => array(
						'max' => 2000,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 500,
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'jltma_toc_scroll',
							'operator' => '==',
							'value'    => 'yes',
						),
						array(
							'name'     => 'jltma_toc_scroll_to_top',
							'operator' => '==',
							'value'    => 'yes',
						),
					),
				),

			)
		);

		$this->add_responsive_control(
			'jltma_toc_scroll_offset',
			[
				'label'      => __('Smooth Scroll Offset (px)', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px'),
				'range'      => [
					'px' => [
						'max' => 100,
					],
				],
				'condition'  => [
					'jltma_toc_scroll' => 'yes',
				]
			]
		);

		$this->end_controls_section();
	}


	protected function jltma_toc_section_collapsible_style()
	{

		/*
		* Style Tab
		*/

		$this->start_controls_section(
			'ma_el_toc_section_style_ofc_btn',
			[
				'label'     => __('Button', 'master-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('ma_el_toc_tabs_ofc_btn_style');

		$this->start_controls_tab(
			'ma_el_toc_tab_ofc_btn_normal',
			[
				'label' => __('Normal', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_toc_button_background',
			[
				'label'     => __('Background', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ma-el-toggle-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_toc_button_color',
			[
				'label'     => __('Text/Icon Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ma-el-toggle-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ma_el_toc_button_shadow',
				'selector' => '{{WRAPPER}} .ma-el-toggle-button-wrapper a.ma-el-toggle-button'
			]
		);

		$this->add_responsive_control(
			'ma_el_toc_button_padding',
			[
				'label'      => __('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ma-el-toggle-button-wrapper a.ma-el-toggle-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ma_el_toc_button_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .ma-el-toggle-button-wrapper a.ma-el-toggle-button'
			]
		);

		$this->add_control(
			'ma_el_toc_button_radius',
			[
				'label'      => __('Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ma-el-toggle-button-wrapper a.ma-el-toggle-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_toc_button_typography',
				'selector' => '{{WRAPPER}} .ma-el-toggle-button-wrapper a.ma-el-toggle-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ma_el_toc_tab_ofc_btn_hover',
			[
				'label' => __('Hover', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_toc_ofc_btn_hover_color',
			[
				'label'     => __('Text/Icon Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ma-el-toggle-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_toc_ofc_btn_hover_bg',
			[
				'label'     => __('Background', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ma-el-toggle-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		// $this->add_control(
		// 	'ma_el_toc_ofc_btn_hover_border_color',
		// 	[
		// 		'label'     => __('Border Color', 'master-addons' ),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'condition' => [
		// 			'ofc_btn_border_border!' => '',
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .ma-el-toggle-button-wrapper a.ma-el-toggle-button:hover' => 'border-color: {{VALUE}};',
		// 		],
		// 	]
		// );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}



	protected function jltma_toc_section_offcanvas_style()
	{

		// Off Canvas
		$this->start_controls_section(
			'ma_el_toc_section_style_offcanvas',
			[
				'label' => __('Index', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ma_el_toc_index_background',
			[
				'label'     => __('Background', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => "#4b00e7",
				'selectors' => [
					//						'#ma-el-toc-{{ID}} .ma-el-offcanvas-bar' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ma-el-table-of-content'    => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_toc_title_color',
			[
				'label'     => __('Title Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => "#8c8c8c",
				'selectors' => [
					'#ma-el-toc-{{ID}} .toc-list li' => 'color: {{VALUE}};',
					'{{WRAPPER}} .toc-list li'    => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_active_color',
			[
				'label'     => __('Active Title Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => "#54BC4B",
				'selectors' => [
					'#ma-el-toc-{{ID}} .toc-list .is-active-link' => 'color: {{VALUE}};',
					'{{WRAPPER}} .toc-list-item .is-active-link'    => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_active_border_color',
			[
				'label'     => __('Active Border Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => "#54BC4B",
				'selectors' => [
					'#ma-el-toc-{{ID}} .is-active-link::before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_toc_index_typography',
				'selector' => '#ma-el-toc-{{ID}} .toc-list li, {{WRAPPER}} .toc-list li',
			]
		);

		$this->end_controls_section();
	}


	protected function jltma_toc_section_help_docs()
	{


		/**
		 * Content Tab: Docs Links
		 */
		$this->start_controls_section(
			'jltma_toc_section_help_docs',
			[
				'label' => esc_html__('Help Docs', 'master-addons' ),
			]
		);


		$this->add_control(
			'help_doc_1',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/100-best-elementor-addons/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);


		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/dynamic-table-element/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=bn0TvaGf9l8" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->end_controls_section();



		//Upgrade to Pro
		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'jltma_toc_section_pro_style_section',
				[
					'label' => esc_html__('Upgrade to Pro for More Features', 'master-addons' ),
				]
			);

			$this->add_control(
				'jltma_control_get_pro_style_tab',
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
	}



	protected function jltma_toc_section_container_style()
	{
		$this->start_controls_section(
			'jltma_toc_section_container_style',
			array(
				'label' => __('Container', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'jltma_toc_container_padding',
			array(
				'label'      => __('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'default'    => array(
					'top'    => '40',
					'bottom' => '40',
					'left'   => '40',
					'right'  => '40',
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-toc-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}



	protected function jltma_toc_section_heading_style()
	{

		$this->start_controls_section(
			'jltma_toc_section_content_heading',
			array(
				'label' => __('Title', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'jltma_toc_heading_text_align',
			array(
				'label'        => __('Alignment', 'master-addons' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => Master_Addons_Helper::jltma_content_alignment(),
				'default'      => 'left',
				'selectors'    => array(
					'{{WRAPPER}} .jltma-toc-heading' => 'text-align: {{VALUE}};',
				),
				'prefix_class' => 'uael%s-heading-align-',
			)
		);

		$this->add_control(
			'jltma_toc_heading_color',
			array(
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => Global_Colors::COLOR_PRIMARY,
				),
				'selectors' => array(
					'{{WRAPPER}} .jltma-toc-heading, {{WRAPPER}} .jltma-toc-switch .jltma-toc-icon' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'jltma_toc_heading_typography',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .jltma-toc-heading, {{WRAPPER}} .jltma-toc-heading a',
			)
		);

		$this->add_responsive_control(
			'jltma_toc_heading_bottom_space',
			array(
				'label'     => __('Title Bottom Spacing', 'master-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .jltma-toc-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-toc-auto-collapse .jltma-toc-header,
					{{WRAPPER}} .jltma-toc-hidden .jltma-toc-header' => 'margin-bottom: 0px;',
				),
			)
		);

		$this->end_controls_section();
	}



	protected function jltma_toc_section_separator_style()
	{

		$this->start_controls_section(
			'jltma_toc_section_separator_line_style',
			array(
				'label'      => __('Separator', 'master-addons' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'ma_el_toc_heading_separator_style',
							'operator' => '==',
							'value'    => 'yes',
						),
						array(
							'name'     => 'ma_el_toc_title',
							'operator' => '!=',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'jltma_toc_heading_line_style',
			array(
				'label'       => __('Style', 'master-addons' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'solid',
				'label_block' => false,
				'options'     => array(
					'solid'  => __('Solid', 'master-addons' ),
					'dashed' => __('Dashed', 'master-addons' ),
					'dotted' => __('Dotted', 'master-addons' ),
					'double' => __('Double', 'master-addons' ),
				),
				'condition'   => array(
					'jltma_toc_heading_separator_style' => 'yes',
				),
				'selectors'   => array(
					'{{WRAPPER}} .jltma-separator' => 'border-top-style: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'jltma_toc_heading_line_color',
			array(
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ccc',
				'condition' => array(
					'ma_el_toc_heading_separator_style' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .jltma-separator' => 'border-top-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'jltma_toc_heading_line_thickness',
			array(
				'label'      => __('Thickness', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'em', 'rem'),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 200,
					),
				),
				'default'    => array(
					'size' => 1,
					'unit' => 'px',
				),
				'condition'  => array(
					'jltma_toc_heading_separator_style' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-separator' => 'border-top-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'jltma_toc_separator_bottom_space',
			array(
				'label'     => __('Separator Bottom Spacing', 'master-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .jltma-separator-parent' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}


	protected function jltma_toc_section_content_style()
	{

		$this->start_controls_section(
			'jltma_toc_section_content',
			array(
				'label' => __('Content', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'jltma_toc_content_typography',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				),
				'selector' => '{{WRAPPER}} .jltma-toc-content-wrapper, {{WRAPPER}} .jltma-toc-empty-note',
			)
		);

		$this->add_responsive_control(
			'jltma_toc_content_between_space',
			array(
				'label'     => __('Spacing Between Content', 'master-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'   => array(
					'size' => 15,
					'unit' => 'px',
				),
				'selectors' => array(
					'{{WRAPPER}} .jltma-toc-list li' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-toc-content-wrapper #toc-li-0' => 'margin-top: 0px;',
				),
			)
		);

		$this->start_controls_tabs('jltma_toc_content_tabs_style');

		$this->start_controls_tab(
			'jltma_toc_tab_content_normal',
			array(
				'label' => __('Normal', 'master-addons' ),
			)
		);

		$this->add_control(
			'jltma_toc_content_color',
			array(
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => Global_Colors::COLOR_SECONDARY,
				),
				'selectors' => array(
					'{{WRAPPER}} .jltma-toc-content-wrapper a, {{WRAPPER}} .jltma-toc-list li, {{WRAPPER}} .jltma-toc-empty-note' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'jltma_toc_tab_content_hover',
			array(
				'label' => __('Hover', 'master-addons' ),
			)
		);

		$this->add_control(
			'jltma_toc_content_hover_color',
			array(
				'label'     => __('Hover Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => Global_Colors::COLOR_ACCENT,
				),
				'selectors' => array(
					'{{WRAPPER}} .jltma-toc-content-wrapper a:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'jltma_toc_tab_content_active',
			array(
				'label' => __('Active', 'master-addons' ),
			)
		);

		$this->add_control(
			'jltma_toc_content_active_color',
			array(
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jltma-toc-content-wrapper a.jltma-toc-active-heading' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Controls for Table of Content
	 */
	protected function register_controls()
	{
		$this->jltma_toc_section_content();
		$this->jltma_toc_section_dropdown();
		$this->jltma_toc_section_scroll();
		$this->jltma_toc_section_help_docs();

		// Style Tab
		$this->jltma_toc_section_container_style();
		$this->jltma_toc_section_heading_style();
		$this->jltma_toc_section_separator_style();
		$this->jltma_toc_section_content_style();

		$this->jltma_toc_section_collapsible_style();
		$this->jltma_toc_section_offcanvas_style();
	}


	public function render_separator($settings)
	{
		if ('yes' === $settings['ma_el_toc_heading_separator_style'] && '' !== $settings['ma_el_toc_title']) {
?>
			<div class="jltma-separator-parent">
				<div class="jltma-separator"></div>
			</div>
		<?php
		}
	}



	protected function render()
	{
		$this->ma_el_toc_table_of_content();
	}


	public function ma_el_toc_table_of_content()
	{
		$settings = $this->get_settings_for_display();

		$head_data   = $settings['ma_el_toc_heading_tags'];
		$hideshow    = $settings['ma_el_toc_collapsible'];
		$displayicon = '';

		$head_data = implode(',', $head_data);

		$this->add_inline_editing_attributes('ma_el_toc_title', 'basic');

		$this->add_render_attribute(
			'jltma_toc_wrapper',
			array(
				'class'         => 'jltma-toc-main-wrapper',
				'data-jltma-headings' => $head_data,
			)
		);
		$scroll_time_size          = isset($settings['scroll_time']['size']) ? $settings['scroll_time']['size'] : '';
		$scroll_offset_mobile_size = isset($settings['scroll_offset_mobile']['size']) ? $settings['scroll_offset_mobile']['size'] : '';
		$scroll_offset_tablet_size = isset($settings['scroll_offset_tablet']['size']) ? $settings['scroll_offset_tablet']['size'] : '';
		$scroll_offset_size        = isset($settings['scroll_offset']['size']) ? $settings['scroll_offset']['size'] : '';

		$this->add_render_attribute('list-parent-wrapper', 'data-jltma-scroll', $scroll_time_size);

		if ('' !== $scroll_offset_mobile_size) {
			$this->add_render_attribute('list-parent-wrapper', 'data-jltma-scroll-offset-mobile', $scroll_offset_mobile_size);
		}

		if ('' !== $scroll_offset_tablet_size) {
			$this->add_render_attribute('list-parent-wrapper', 'data-jltma-scroll-offset-tablet', $scroll_offset_tablet_size);
		}

		if ('' !== $scroll_offset_size) {
			$this->add_render_attribute('list-parent-wrapper', 'data-jltma-scroll-offset', $scroll_offset_size);
		}

		$jltma_toc_scroll_to_top_offset_size   = isset($settings['jltma_toc_scroll_to_top_offset']['size']) ? $settings['jltma_toc_scroll_to_top_offset']['size'] : '';
		$jltma_toc_scroll_to_top_offset_mobile = isset($settings['jltma_toc_scroll_to_top_offset_mobile']['size']) ? $settings['jltma_toc_scroll_to_top_offset_mobile']['size'] : '';
		$jltma_toc_scroll_to_top_offset_tablet = isset($settings['jltma_toc_scroll_to_top_offset_tablet']['size']) ? $settings['jltma_toc_scroll_to_top_offset_tablet']['size'] : '';

		if ('' !== $jltma_toc_scroll_to_top_offset_mobile) {
			$this->add_render_attribute('list-parent-wrapper', 'data-jltma-scroll-to-top-offset-mobile', $jltma_toc_scroll_to_top_offset_mobile);
		}

		if ('' !== $jltma_toc_scroll_to_top_offset_tablet) {
			$this->add_render_attribute('list-parent-wrapper', 'data-jltma-scroll-to-top-offset-tablet', $jltma_toc_scroll_to_top_offset_tablet);
		}

		if ('' !== $jltma_toc_scroll_to_top_offset_size) {
			$this->add_render_attribute('list-parent-wrapper', 'data-jltma-scroll-to-top-offset', $jltma_toc_scroll_to_top_offset_size);
		}

		$this->add_render_attribute('jltma_show_hide_wrapper', 'data-hideshow', $hideshow);

		if ('yes' === $settings['ma_el_toc_collapsible']) {
			$this->add_render_attribute('jltma_show_hide_wrapper', 'data-jltma-is-collapsible', 'yes');

			if ('yes' === $settings['ma_el_toc_auto_collapsible']) {
				$this->add_render_attribute('jltma_toc_wrapper', 'class', 'jltma-toc-auto-collapse');
			} else {
				$this->add_render_attribute('jltma_toc_wrapper', 'class', 'jltma-content-show');
			}
		}
		?>
		<div <?php echo wp_kses_post($this->get_render_attribute_string('jltma_toc_wrapper')); ?>>
			<div class="jltma-toc-wrapper">
				<div class="jltma-toc-header">
					<span class="jltma-toc-heading elementor-inline-editing" data-elementor-setting-key="heading_title" data-elementor-inline-editing-toolbar="basic"><?php echo wp_kses_post($this->get_settings_for_display('ma_el_toc_title')); ?></span>
					<?php if ('yes' === $settings['ma_el_toc_collapsible']) { ?>
						<div class="jltma-toc-switch" <?php echo wp_kses_post($this->get_render_attribute_string('jltma_show_hide_wrapper')); ?>>
							<span class="jltma-toc-icon fa"></span>
						</div>
					<?php } ?>
				</div>
				<?php $this->render_separator($settings); ?>
				<div class="jltma-toc-toggle-content">
					<div class="jltma-toc-content-wrapper">
						<?php if ('unordered_list' === $settings['ma_el_toc_bullet_icon']) { ?>
							<ul data-toc-headings="headings" class="jltma-toc-list jltma-toc-list-disc" <?php echo wp_kses_post($this->get_render_attribute_string('list-parent-wrapper')); ?>></ul>
						<?php } elseif ('ordered_list' === $settings['ma_el_toc_bullet_icon']) { ?>

							<ol data-toc-headings="headings" class="jltma-toc-list" <?php echo wp_kses_post($this->get_render_attribute_string('list-parent-wrapper')); ?>></ol>

						<?php } else { ?>

							<ul data-toc-headings="headings" class="jltma-toc-list jltma-toc-list-none" <?php echo wp_kses_post($this->get_render_attribute_string('list-parent-wrapper')); ?>></ul>
						<?php } ?>
					</div>
				</div>
				<div class="jltma-toc-empty-note">
					<span><?php echo esc_attr__('Add a header to begin generating the table of contents', 'master-addons' ); ?></span>
				</div>
			</div>
			<?php if ('yes' === $settings['jltma_toc_scroll_to_top']) { ?>
				<a id="jltma-scroll-top" class="jltma-scroll-top-icon">
					<span class="screen-reader-text">Scroll to Top</span>
				</a>
			<?php } ?>
		</div>
<?php
	}
}
