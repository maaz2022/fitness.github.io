<?php

namespace MasterAddons\Addons;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Core\Schemes\Color;


/**
 * Author Name: Liton Arefin
 * Author URL : https: //jeweltheme.com
 * Date       : 6/27/19
 */

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.
class JLTMA_Counter_Up extends Widget_Base
{
	public function get_name()
	{
		return 'jltma-counter-up';
	}
	public function get_title()
	{
		return esc_html__('Counter Up', 'master-addons' );
	}
	public function get_icon()
	{
		return 'jltma-icon eicon-counter';
	}
	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_script_depends()
	{
		return [
			'master-addons-waypoints',
			'ma-counter-up'
		];
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
		return 'https://master-addons.com/demos/counter-up/';
	}


	protected function register_controls()
	{

		$this->start_controls_section(
			'ma_el_counterup_section_start',
			[
				'label' => __('Counter Up Content', 'master-addons' )
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'icon_type',
			[
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => true,
				'label'       => esc_html__('Type', 'master-addons' ),
				'default'     => 'icon',
				'options'     => [
					'none'    => [
						'title' => esc_html__('None', 'master-addons' ),
						'icon'  => 'eicon-ban',
					],
					'icon'      => [
						'title' => esc_html__('Icon', 'master-addons' ),
						'icon'  => 'eicon-icon-box',
					],
					'custom'    => [
						'title' => esc_html__('Image', 'master-addons' ),
						'icon'  => 'eicon-image',
					],
				]
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label'   => esc_html__('Icon', 'master-addons' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-star',
					'library' => 'solid',
				],
				'condition'     => [
					'icon_type' => 'icon',
				],
			]
		);

		$repeater->add_control(
			'custom',
			[
				'label'       => esc_html__('Image', 'master-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::MEDIA,
				'condition'   => [
					'icon_type' => 'custom',
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'label'       => esc_html__('Title', 'master-addons' ),
				'default'     => 'Type your title',
			]
		);

		$repeater->add_control(
			'number',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__('Number', 'master-addons' ),
				'default' => 123456,
			]
		);

		$repeater->add_control(
			'number_prefix',
			[
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'label'       => esc_html__('Number Prefix', 'master-addons' ),
				'placeholder' => '1',
			]
		);

		$repeater->add_control(
			'number_suffix',
			[
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'label'       => esc_html__('Number Suffix', 'master-addons' ),
				'placeholder' => '1',
			]
		);

		$repeater->add_control(
			'background',
			[
				'type'  => Controls_Manager::COLOR,
				'label' => esc_html__('Background', 'master-addons' )
			]
		);


		$this->add_control(
			'jltma_counterup_contents',
			[
				'label'   => esc_html__('Items', 'master-addons' ),
				'type'    => Controls_Manager::REPEATER,
				'default' => [
					[
						'number'     => 6000,
						'icon'       => ['value' => 'far fa-thumbs-up', 'library'  => 'regular'],
						'title'      => esc_html__('Happy Clients', 'master-addons' ),
						'background' => ''
					],
					[
						'number'     => 9560,
						'icon'       => ['value' => 'far fa-check-circle', 'library'  => 'regular'],
						'title'      => esc_html__('Projects Completed', 'master-addons' ),
						'background' => ''
					],
					[
						'number'     => 165893,
						'icon'       => ['value' => 'fas fa-coffee', 'library'  => 'solid'],
						'title'      => esc_html__('Cups of Coffee', 'master-addons' ),
						'background' => ''
					],
					[
						'number'     => 12356789,
						'icon'       => ['value' => 'fas fa-trophy', 'library'  => 'solid'],
						'title'      => esc_html__('Awards Won', 'master-addons' ),
						'background' => ''
					],
				],
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{title}}',
			]
		);

		$this->add_control(
			'column',
			[
				'label'   => esc_html__('Columns', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 4,
				'options' => [
					'6' => esc_html__('6 Columns', 'master-addons' ),
					'4' => esc_html__('4 Columns', 'master-addons' ),
					'3' => esc_html__('3 Columns', 'master-addons' ),
					'2' => esc_html__('2 Columns', 'master-addons' ),
					'1' => esc_html__('1 Column', 'master-addons' ),
				],
			]
		);


		$this->end_controls_section();



		$this->start_controls_section(
			'jltma_counterup_icons_section',
			[
				'label' => esc_html__('Icon Settings', 'master-addons' )
			]
		);


		// counnterup icon align
		$this->add_control(
			'jltma_counterup_icon_align',
			[
				'label'   => esc_html__('Icon/Image Position', 'master-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'      => [
						'title' => esc_html__('Left', 'master-addons' ),
						'icon'  => 'fa fa-angle-left',
					],
					'center'    => [
						'title' => esc_html__('Top', 'master-addons' ),
						'icon'  => 'fa fa-angle-up',
					],
					'right'     => [
						'title' => esc_html__('Right', 'master-addons' ),
						'icon'  => 'fa fa-angle-right',
					],
				],
				'default' => 'center',
			]
		);

		// Icon Size
		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__('Icon Size', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px'    => [
						'min' => 6,
						'max' => 300,
					],
				],
				'default'   => [
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-counterup .jltma-counterup-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-counterup .jltma-counterup-icon img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'image_size',
			[
				'label' => esc_html__('Icon Circle or Image Size', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px'    => [
						'min' => 6,
						'max' => 300,
					],
				],
				'default'   => [
					'size' => 70,
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-counterup .jltma-counterup-icon i'   => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-counterup i'                         => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-counterup .jltma-counterup-icon img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();



		/**
		 * -------------------------------------------
		 * counterup style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'jltma_counterup_box_style_section',
			[
				'label' => esc_html__('Counter up Box Style', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		// counterup background color
		$this->add_control(
			'jltma_counterup_bg_color',
			[
				'label'     => esc_html__('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-counterup' => 'background-color: {{VALUE}};'
				],
			]
		);

		// counterup box padding
		$this->add_responsive_control(
			'jltma_counterup_padding',
			[
				'label'      => esc_html__('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-counterup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// counterup margin
		$this->add_responsive_control(
			'jltma_counterup_margin',
			[
				'label'      => esc_html__('Margin', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-counterup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// counterup border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'jltma_counterup_border',
				'label'    => esc_html__('Border Type', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-counterup',
			]
		);

		$this->add_responsive_control(
			'jltma_counterup_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-counterup' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// counterup box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jltma_counterup_box_shadow',
				'selector' => '{{WRAPPER}} .jltma-counterup-column .jltma-counterup'
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * color & typography
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'jltma_counterup_typography_section',
			[
				'label' => esc_html__('Content Style', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		// counterup icon style
		$this->add_control(
			'jltma_counterup_icon_style',
			[
				'label' => esc_html__('Icon Style', 'master-addons' ),
				'type'  => Controls_Manager::HEADING
			]
		);

		// counterup icon color
		$this->add_control(
			'jltma_counterup_icon_color',
			[
				'label'     => esc_html__('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .jltma-counterup i' => 'color: {{VALUE}};',
				],
			]
		);

		// counterup icon color
		$this->add_control(
			'jltma_counterup_icon_bg_color',
			[
				'label'     => esc_html__('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4b00e7',
				'selectors' => [
					'{{WRAPPER}} .jltma-counterup-icon i' => 'background-color: {{VALUE}};',
				],
			]
		);

		// counterup number style
		$this->add_control(
			'jltma_counterup_number_style',
			[
				'label'     => esc_html__('Number Style', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		//  counterup number color
		$this->add_control(
			'jltma_counterup_number_color',
			[
				'type'   => Controls_Manager::COLOR,
				'label'  => esc_html__('Color', 'master-addons' ),
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#333',
				'selectors' => [
					'{{WRAPPER}} .jltma-counterup h3.jltma-counter-up-number' => 'color: {{VALUE}};'
				],
			]
		);

		//  counterup number typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'jltma_counterup_number_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-counterup h3.jltma-counter-up-number',
				'exclude'  => [
					'text_transform', // font_family, font_size, font_weight, text_transform, font_style, text_decoration, line_height, letter_spacing
				]
			]
		);

		// counterup number margin
		$this->add_control(
			'jltma_counterup_number_margin',
			[
				'label'      => esc_html__('Margin', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-counterup h3.jltma-counter-up-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// counterup title style
		$this->add_control(
			'jltma_counterup_title_style',
			[
				'label'     => esc_html__('Title Style', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		//  counterup title color
		$this->add_control(
			'jltma_counterup_title_color',
			[
				'type'   => Controls_Manager::COLOR,
				'label'  => esc_html__('Title color', 'master-addons' ),
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#525151',
				'selectors' => [
					'{{WRAPPER}} .jltma-counterup-title' => 'color: {{VALUE}};'
				],
			]
		);

		//  counterup title typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'jltma_counterup_title_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-counterup-title'
			]
		);

		// counterup title margin
		$this->add_control(
			'jltma_counterup_title_margin',
			[
				'label'      => esc_html__('Margin', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-counterup-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/counter-up/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/counter-up-for-elementor/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=9amvO6p9kpM" target="_blank" rel="noopener">', '</a>'),
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
	}


	protected function render()
	{

		$settings = $this->get_settings_for_display();
		$id_int   = substr($this->get_id_int(), 0, 3);

		if (is_array($settings['jltma_counterup_contents'])) :
			$column = 12 / $settings['column'];
			$column = 'jltma-col-' . esc_attr($column);
			echo '<div class="jltma-counterup-items jltma-row">';

			foreach ($settings['jltma_counterup_contents'] as $index => $list) :

				$title_count        = $index + 1;
				$title_settings_key = $this->get_repeater_setting_key('title', 'jltma_counterup_contents', $index);

				$this->add_render_attribute($title_settings_key, [
					'id'    => $id_int . $title_count,
					'style' => ['background-color:', $list['background']]
				]);

				echo '<div class="' . esc_attr($column) . ' jltma-counterup-column">';
				echo '<div class="jltma-counterup jltma-counterup-icon-' . esc_attr($settings['jltma_counterup_icon_align']) . '"  ' . $this->get_render_attribute_string($title_settings_key) . '>';
				echo '<span class="jltma-counterup-icon counterup-icon-text-' . esc_attr($settings['jltma_counterup_icon_align']) . '">';

				if (!empty($list['icon']) && ($list['icon_type'] == 'icon')) {
					if ($list['icon']['library'] == 'svg') {
						$svg_src = wp_get_attachment_url($list["icon"]["value"]["id"], 'full');
						echo '<img src="' . esc_url_raw($svg_src) .  '"/>';
					} else {
						echo '<i class="' . esc_attr($list['icon']['value']) . '"></i>';
					}
				}elseif(!empty($list['custom']) && ($list['icon_type'] == 'custom')){
					pretty_log('sss',$list['custom']);
					$svg_src = wp_get_attachment_url($list["custom"]["id"], 'full');
					echo '<img src="' . esc_url_raw($svg_src) .  '"/>';
				}


				echo '</span>';
				if (!empty($list['number']) || ($list['title'])) :
					echo '<div class="jltma-counterup-content">';
					$list['number'] ? printf('<div class="jltma-counter-up-number-section"><h3>%1$s</h3><h3 class="jltma-counter-up-number">%2$s</h3><h3>%3$s</h3></div>', $this->parse_text_editor($list['number_prefix']), esc_attr($list['number']), $this->parse_text_editor($list['number_suffix'])) : '';
					$list['title'] ? printf('<span class="jltma-counterup-title">%s</span>', $this->parse_text_editor($list['title'])) : '';
					echo '</div>';
				endif;
				echo '</div>';
				echo '</div>';
			endforeach;
			echo '</div>';
		endif;
	}
}
