<?php

namespace MasterAddons\Addons;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

use \Elementor\Widget_Base;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use \Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Master Addons Classes
use MasterAddons\Inc\Controls\MA_Group_Control_Transition;
use MasterAddons\Inc\Traits\JLTMA_Swiper_Controls;
use MasterAddons\Inc\Helper\Master_Addons_Helper;


class JLTMA_Logo_Slider extends Widget_Base
{
	use JLTMA_Swiper_Controls;

	public function get_name()
	{
		return 'jltma-logo-slider';
	}

	public function get_title()
	{
		return esc_html__('Logo Slider', 'master-addons' );
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-slider-push';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_style_depends()
	{
		return [
			'jltma-tippy',
			'font-awesome-5-all',
			'font-awesome-4-shim'
		];
	}

	public function get_script_depends()
	{
		return [
			'swiper',
			'jltma-popper',
			'jltma-tippy',
			'master-addons-scripts'
		];
	}


	public function get_help_url()
	{
		return 'https://master-addons.com/demos/logo-slider/';
	}

	protected function register_controls()
	{

		/*
        * Logo Images
        */
		$this->start_controls_section(
			'jltma_logo_slider_section_logos',
			[
				'label' => esc_html__('Logo Items', 'master-addons' )
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'jltma_logo_slider_image_normal',
			[
				'label' => esc_html__('Client Logo', 'master-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'jltma_logo_slider_website_link',
			[
				'label' => esc_html__('Link', 'master-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'master-addons' ),
				'show_external' => true
			]
		);

		$repeater->add_control(
			'jltma_logo_slider_hover_type',
			[
				'label' => __('Hover?', 'master-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'text'  => __( 'Text', 'master-addons' ),
					'image' => __( 'Image', 'master-addons' ),
					'none'  => __( 'None', 'master-addons' ),
				],
			]
		);

		$repeater->add_control(
			'jltma_logo_slider_brand_name',
			[
				'label' => __('Brand Name', 'master-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __('Brand Name', 'master-addons' ),
				'condition' => [
					'jltma_logo_slider_hover_type' => 'text'
				]
			]
		);

		$repeater->add_control(
			'jltma_logo_slider_brand_description',
			[
				'label' => __('Description', 'master-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __('Brand Short Description Type Here.', 'master-addons' ),
				'condition' => [
					'jltma_logo_slider_hover_type' => 'text'
				]
			]
		);

		$repeater->add_control(
			'jltma_logo_slider_image_hover',
			[
				'label' => esc_html__('Hover Logo Image', 'master-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'jltma_logo_slider_hover_type' => 'image'
				]
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'hover_img_thumb',
				'default'   => 'large',
				'separator' => 'before',
				'condition' => [
					'jltma_logo_slider_enable_hover_logo' => 'yes'
				]
			]
		);

		// Tooltip settings/styles
		$this->jltma_tooltip_tab($repeater);

		$this->add_control(
			'jltma_logo_slider_items',
			[
				'label' => esc_html__('', 'master-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'jltma_logo_slider_brand_name' => esc_html__('Brand Name 1', 'master-addons' ),
					],
					[
						'jltma_logo_slider_brand_name' => esc_html__('Brand Name 2', 'master-addons' ),
					],
					[
						'jltma_logo_slider_brand_name' => esc_html__('Brand Name 3', 'master-addons' ),
					],
					[
						'jltma_logo_slider_brand_name' => esc_html__('Brand Name 4', 'master-addons' ),
					],
					[
						'jltma_logo_slider_brand_name' => esc_html__('Brand Name 5', 'master-addons' ),
					],
				],
				'title_field' => '{{{ jltma_logo_slider_brand_name }}}',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'normal_img_thumb',
				'default'   => 'large'
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'   => esc_html__('Title HTML Tag', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => Master_Addons_Helper::jltma_title_tags(),
				'default' => 'h5',
			]
		);

		$this->add_control(
			'item_select_event',
			[
				'label'   => esc_html__('Select Event', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'description' => esc_html__('This event will work only if hover is enabled for Client Logo.', 'master-addons' ),
				'options' => [
					'item_hover' => __('Default Hover', 'master-addons' ),
					'icon_click' => __('Icon Click', 'master-addons' )
				],
				'default' => 'item_hover'
			]
		);
		$this->add_control(
			'item_hover_icon',
			[
				'label'         	=> esc_html__('Icon Hover', 'master-addons' ),
				'description' 		=> esc_html__('Please choose an icon from the list.', 'master-addons' ),
				'type'          	=> Controls_Manager::ICONS,
				'fa4compatibility' 	=> 'icon',
				'default'       	=> [
					'value'       => 'simple-line-icons icon-eye',
					'library'     => 'simple-line-icons'
				],
				'condition' => [
					'item_select_event' => 'icon_click'
				]
			]
		);
		$this->add_control(
			'item_select_icon_pos',
			[
				'label'   => esc_html__('Icon Position', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'top_right'     => __('Top Right', 'master-addons' ),
					'top_left'      => __('Top Left', 'master-addons' ),
					'bottom_right'  => __('Bottom Right', 'master-addons' ),
					'bottom_left'   => __('Bottom Left', 'master-addons' )
				],
				'default' => 'top_right',
				'condition' => [
					'item_select_event' => 'icon_click'
				]
			]
		);

		$this->end_controls_section();



		// Global Navigation Controls
		$this->start_controls_section(
			'section_content_navigation',
			[
				'label' => __('Navigation', 'master-addons' ),
			]
		);

		$this->jltma_swiper_navigation_controls();

		$this->end_controls_section();



		//  Global Swiper Control Settings
		$this->start_controls_section(
			'section_carousel_settings',
			[
				'label' => __('Carousel Settings', 'master-addons' ),
			]
		);
		
		$slides_per_column = range(1, 6);
		$slides_per_column = array_combine($slides_per_column, $slides_per_column);

		$this->add_responsive_control(
			'columns',
			[
				'type'        => Controls_Manager::SELECT,
				'label'       => __('Slides per Column', 'master-addons' ),
				'description' => __('For Vertical direction this defines the number of slides per row.', 'master-addons' ),
				'options'     => ['' => __('Default', 'master-addons' )] + $slides_per_column,
				'default'     => 4,
			]
		);
		$this->jltma_swiper_settings_controls();

		$this->end_controls_section();


		// Global Swiper Item Style
		$this->jltma_swiper_item_style_controls('logo-carousel');


		//Items Hover Style
		$this->start_controls_section(
			'section_style_carousel_hover',
			[
				'label'      => __('Carousel Items Hover', 'master-addons' ),
				'tab'        => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'jltma_logo_slider_hover_item_background',
            [
                'label'     => esc_html__('Background', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure .jltma-hover-click' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'jltma_logo_slider_hover_item_border',
                'label'       => esc_html__('Border Color', 'master-addons' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure .jltma-hover-click',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'jltma_logo_slider_hover_item_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure .jltma-hover-click' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'jltma_logo_slider_hover_item_shadow',
                'selector' => '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure .jltma-hover-click',
            ]
        );
		$this->add_responsive_control(
            'jltma_logo_slider_hover_item_padding',
            [
                'label'      => esc_html__('Padding', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure .jltma-hover-click' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'jltma_logo_slider_hover_item_margin',
            [
                'label'      => esc_html__('Margin', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure .jltma-hover-click' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
            'jltma_logo_slider_hover_title_color',
            [
                'label'     => __('Name Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'separator'   => 'before',
                'selectors' => [
                    '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure figcaption .jltma-logo-slider-brand-name' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'      => __('Name Typography', 'master-addons' ),
                'name'       => 'jltma_logo_slider_hover_title_typography',
                'selector'   => '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure figcaption .jltma-logo-slider-brand-name',
            ]
        );		
		$this->add_responsive_control(
            'jltma_logo_slider_hover_icon_name_spacing',
            [
                'label'      => esc_html__('Spacing', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
				'allowed_dimensions' => 'vertical',
				'placeholder' => [
					'top' => '',
					'right' => 'auto',
					'bottom' => '',
					'left' => 'auto',
				],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure figcaption .jltma-logo-slider-brand-name' => 'margin: {{TOP}}{{UNIT}} auto {{BOTTOM}}{{UNIT}} auto;',
                ],
            ]
        );
		$this->add_control(
            'jltma_logo_slider_hover_subtitle_color',
            [
                'label'     => __('Text Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'separator'   => 'before',
                'selectors' => [
                    '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure figcaption .jltma-logo-slider-brand-description' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'      => __('Text Typography', 'master-addons' ),
                'name'       => 'jltma_logo_slider_hover_subtitle_typography',
                'selector'   => '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure figcaption .jltma-logo-slider-brand-description',
            ]
        );	
		$this->add_responsive_control(
            'jltma_logo_slider_hover_icon_text_spacing',
            [
                'label'      => esc_html__('Spacing', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
				'allowed_dimensions' => 'vertical',
				'placeholder' => [
					'top' => '',
					'right' => 'auto',
					'bottom' => '',
					'left' => 'auto',
				],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure figcaption .jltma-logo-slider-brand-description' => 'margin: {{TOP}}{{UNIT}} auto {{BOTTOM}}{{UNIT}} auto;',
                ],
            ]
        );
		$this->end_controls_section();

		/**
		 * Icon style
		 */
		$this->start_controls_section(
			'section_style_carousel_hover_icon',
			[
				'label'      => __('Icon', 'master-addons' ),
				'tab'        => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'jltma_logo_slider_hover_icon_color',
            [
                'label'     => __('Color', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure i.item-hover-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'jltma_logo_slider_hover_icon_background',
            [
                'label'     => esc_html__('Background', 'master-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure i.item-hover-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'jltma_logo_slider_hover_icon_border',
                'label'       => esc_html__('Border Color', 'master-addons' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure i.item-hover-icon',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'jltma_logo_slider_hover_icon_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure i.item-hover-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );
		$this->add_responsive_control(
            'jltma_logo_slider_hover_icon_border_padding',
            [
                'label'      => esc_html__('Padding', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure i.item-hover-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'jltma_logo_slider_hover_icon_border_margin',
            [
                'label'      => esc_html__('Margin', 'master-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure i.item-hover-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
            'jltma_logo_slider_hover_icon_font_size',
            [
                'label'              => esc_html__('Font Size', 'master-addons' ),
                'type'               => Controls_Manager::SLIDER,
                'default'            => [
                    'size' => 22,
                ],
                'range'              => [
                    'px' => [
                        'min' => 16,
                        'max' => 100,
                    ],
                ],
				'selectors' => [
					'{{WRAPPER}} .jltma-logo-slider-item .jltma-logo-slider-figure i.item-hover-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
            ]
        );
		$this->end_controls_section();

		//Navigation Style
		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'      => __(
					'Navigation',
					'master-addons' 
				),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'navigation',
							'operator' => '!=',
							'value'    => 'none',
						],
						[
							'name'  => 'show_scrollbar',
							'value' => 'yes',
						],
					],
				],
			]
		);

		// Global Navigation Style Controls
		$this->jltma_swiper_navigation_style_controls('logo-carousel');


		$this->add_group_control(
			MA_Group_Control_Transition::get_type(),
			[
				'name' 			=> 'arrows',
				'selector' 		=> '{{WRAPPER}} .jltma-swiper__button',
				'condition'		=> [
					'carousel_arrows'         => 'yes'
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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/logo-carousel/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/logo-carousel/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=ubP_h86bP-c" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);
		$this->end_controls_section();




		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'jltma_section_pro',
				[
					'label' => esc_html__('Upgrade to Pro for More Features', 'master-addons' )
				]
			);

			$this->add_control(
				'jltma_control_get_pro',
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


	/*
    * Logo Slider: Render Header
    */
	public function jltma_render_logo_slider_header()
	{
		$settings = $this->get_settings_for_display();

		$unique_id 	= implode('-', [$this->get_id(), get_the_ID()]);

		$this->add_render_attribute([
			'jltma_logo_carousel_wrapper' => [
				'class' => [
					'jltma-logo-carousel-wrapper',
					'jltma-carousel',
					'jltma-swiper',
					'jltma-swiper__container',
					'swiper-container',
					'elementor-jltma-element-' . $unique_id,
				],
				'data-jltma-template-widget-id' => $unique_id,
			],
			'logo_swiper_wrapper' => [
				'class' => [
					'jltma-logo-carousel',
					'jltma-swiper__wrapper',
					'swiper-wrapper',
				],
			]
		]);


		//Global Header Function
		$this->jltma_render_swiper_header_attribute('logo-carousel');

		$this->add_render_attribute('carousel', 'class', ['jltma-logo-carousel-slider']);

		?>

		<div <?php echo $this->get_render_attribute_string('carousel'); ?>>
			<div <?php echo $this->get_render_attribute_string('jltma_logo_carousel_wrapper'); ?>>
				<div <?php echo $this->get_render_attribute_string('logo_swiper_wrapper'); ?>>
					<?php
	}
 
	/*
	* Render Logo Loop
	*/

	public function jltma_render_logo_slider_loop_item()
	{
		$settings = $this->get_settings_for_display();
		
		$slider_items = $settings['jltma_logo_slider_items'];

		if (empty($slider_items)) {
			return;
		}

		if (count($slider_items) > 1) {
			$demo_images = [];

			if (empty($slider_items[0]['jltma_logo_slider_image_normal']) && empty($slider_items[1]['jltma_logo_slider_image_normal']) && empty($slider_items[0]['jltma_logo_slider_image_normal'])) {
				$demo_images[] = Master_Addons_Helper::jltma_placeholder_images();
			}

			foreach ($slider_items as $index => $item) {

				$images = $item['jltma_logo_slider_image_normal'];
				$image_id = $item['jltma_logo_slider_image_normal']['id'];
				if (empty($images)) {
					$images = $demo_images;
				}
				
				$image_size = $settings['normal_img_thumb_size'];
				if( $image_size == 'custom' ){
					$image_size = array_values($settings['normal_img_thumb_custom_dimension']);
				}


				$repeater_key = 'carousel_item' . esc_attr($index);
				// $tag = 'div';
				$image_alt      = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
				$tag = 'div';
				$id = 'elementor-repeater-item-'. $item['_id'];

				// Website Links
				if (!empty($item['jltma_logo_slider_website_link']['url'])) {
					$tag = 'a';
					$this->add_render_attribute($repeater_key, 'class', 'jltma-logo-slider-link');
					$this->add_render_attribute($repeater_key, 'target', '_blank');
					$this->add_render_attribute($repeater_key, 'rel', 'noopener');
					$this->add_render_attribute($repeater_key, 'href', esc_url($item['jltma_logo_slider_website_link']['url']));
					$this->add_render_attribute($repeater_key, 'title', $item['jltma_logo_slider_brand_name']);
				}

				if(  $item['jltma_logo_slider_tooltip_enable'] == 'yes' ){
					$tooltip_settings = [
						'text'           => $item['jltma_logo_slider_tooltip_text'],
						'placement'      => $item['jltma_logo_slider_tooltip_placement'],
						'follow_cursor'  => ($item['jltma_logo_slider_tooltip_follow_cursor'] == 'yes' ) ? 1 : 0,
						'animation'      => $item['jltma_logo_slider_tooltip_animation'],
						'trigger'        => $item['jltma_logo_slider_tooltip_trigger'],
						'duration'       => $item['jltma_logo_slider_tooltip_duration'],
						'delay'          => $item['jltma_logo_slider_tooltip_delay'],
						'x_offset'       => $item['jltma_logo_slider_tooltip_x_offset']['size'] ?: 0,
						'y_offset'       => $item['jltma_logo_slider_tooltip_y_offset']['size'] ?: 0,
						'arrow'          => $item["jltma_logo_slider_tooltip_arrow"] ? 1 : 0,
						'arrow_type'     => $item["jltma_logo_slider_tooltip_arrow_type"]
					];
					$this->add_render_attribute($repeater_key, 'id', 'jltma-logo-slider-item' . $id);
					$this->add_render_attribute($repeater_key, 'data-id', $id);
					$this->add_render_attribute($repeater_key, 'data-tooltip-settings', json_encode( $tooltip_settings ) );
				}

				// Slider Items
				$this->add_render_attribute([
					$repeater_key => [
						'class' => [
							'jltma-logo-slider-item',
							'jltma-slider__item',
							'jltma-swiper__slide',
							'swiper-slide'
						]
					]
				]);

				?> 
				<<?php echo esc_attr($tag); ?> <?php $this->print_render_attribute_string($repeater_key); ?>>
					<figure class="jltma-logo-slider-figure" >

						<?php
						if (!empty($images)) {
							if (isset($image_id) && $image_id) {
								echo wp_get_attachment_image(
									$image_id,
									$image_size,
									false,
									[
										'class' => 'jltma-logo-slider-img elementor-animation-',
										'alt' => esc_attr($image_alt),
									]
								);
							} else {
								echo "<img src=" . $images['url'] . ">";
							}
						}
						
						$item_default_hover = ($settings['item_select_event'] == 'icon_click') ? 'jltma-hover-click' : '';
						$this->add_render_attribute([
							'item_click' => [
								'class' => [
									$item_default_hover
								]
							]
						]);
						$icon_class = 'item-hover-icon '. ($settings['item_select_icon_pos'] ? $settings['item_select_icon_pos'] : 'top_right');
						if( $settings['item_select_event'] == 'icon_click' )
							Master_Addons_Helper::jltma_fa_icon_picker('simple-line-icons icon-plus', 'icon', $settings['item_hover_icon'], '', $icon_class); 
						
						// Hover Logo Image
						if( isset( $item['jltma_logo_slider_hover_type'] ) && ($item['jltma_logo_slider_hover_type'] == 'image') && $item['jltma_logo_slider_image_hover']['url'] ){
							$slide_hover_image_id = $item['jltma_logo_slider_image_hover']['id'];
							$image_hover_alt = get_post_meta( $slide_hover_image_id, '_wp_attachment_image_alt', true );

							if (isset($slide_hover_image_id) && $slide_hover_image_id) {
								echo wp_get_attachment_image(
									$slide_hover_image_id,
									$image_size,
									false,
									[
										'class' => 'jltma-logo-slider-hover-img elementor-animation- '.$item_default_hover,
										'alt' => esc_attr($image_hover_alt),
									]
								);
							}
						}

						if( isset( $item['jltma_logo_slider_hover_type'] ) && ($item['jltma_logo_slider_hover_type'] == 'text')){ ?>
							<figcaption <?php $this->print_render_attribute_string('item_click'); ?> >
								<?php
									if (trim($item['jltma_logo_slider_brand_name']) != '') {
										$brand_title_tag = 'h5';
										$brand_title_tag = ($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h5';
										$repeater_key_brand_name = $repeater_key . 'brand_name';
										$this->add_render_attribute($repeater_key_brand_name, 'class', 'jltma-logo-slider-brand-name');
										?>
											<<?php echo esc_attr($brand_title_tag); ?> <?php $this->print_render_attribute_string($repeater_key_brand_name); ?>>
												<?php echo esc_html($item['jltma_logo_slider_brand_name']); ?>
											</<?php echo esc_attr($brand_title_tag); ?>>
										<?php
									}
									if (trim($item['jltma_logo_slider_brand_description']) != '') {
										$brand_desc_tag = 'p';
										$repeater_key_brand_desc = $repeater_key . 'brand_desc';
										$this->add_render_attribute($repeater_key_brand_desc, 'class', 'jltma-logo-slider-brand-description');
										?>
											<<?php echo esc_attr($brand_desc_tag); ?> <?php $this->print_render_attribute_string($repeater_key_brand_desc); ?>>
												<?php echo esc_html($item['jltma_logo_slider_brand_description']); ?>
											</<?php echo esc_attr($brand_desc_tag); ?>>
										<?php
									}
								?>
							</figcaption>
						<?php } ?>
					</figure>


				</<?php echo esc_attr($tag); ?>>

		<?php
			}  // end of foreach
		} // end of slider items

	}



	/*
	* Render Footer
	*/
	public function jltma_render_logo_slider_footer()
	{
		$settings = $this->get_settings_for_display(); ?>


					</div> <!-- swiper-wrapper -->
				</div>
				<!--/.ma-logo-carousel-->

				<?php $this->render_swiper_navigation(); ?>

				<?php if ('yes' === $settings['show_scrollbar']) { ?>
					<div class="swiper-scrollbar"></div>
				<?php } ?>

			</div>
			<!--/.jltma-logo-slider-->

	<?php }


	public function render()
	{
		$this->jltma_render_logo_slider_header();
		$this->jltma_render_logo_slider_loop_item();
		$this->jltma_render_logo_slider_footer();
	}
}
