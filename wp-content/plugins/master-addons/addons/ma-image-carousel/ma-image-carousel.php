<?php

namespace MasterAddons\Addons;

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Icons_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Background;
use \Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use \Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Master Addons Classes
use MasterAddons\Inc\Traits\JLTMA_Swiper_Controls;
use MasterAddons\Inc\Helper\Master_Addons_Helper;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 10/26/19
 */


// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}


if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Image_Carousel extends Widget_Base
{
	use JLTMA_Swiper_Controls;

	public function get_name()
	{
		return 'ma-image-carousel';
	}

	public function get_title()
	{
		return __('Image Carousel', 'master-addons' );
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-media-carousel';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_script_depends()
	{
		return ['swiper', 'fancybox', 'master-addons-scripts'];
	}

	public function get_style_depends()
	{
		return ['fancybox', 'master-addons-main-style'];
	}

	public function get_keywords()
	{
		return ['image', 'image carousel', 'slider', 'image slider', 'carousel text', 'Image Carousel with Text'];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/team-member/';
	}

	protected function jltma_image_carousel_images_controls()
	{

		$this->start_controls_section(
			'ma_el_image_carousel',
			[
				'label' => __('Images', 'master-addons' ),
			]
		);
		$this->add_control(
			'jltma_image_carousel_images',
			[
				'label' => esc_html__( 'Carousel Images', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [
					[
						'id' => 0,
						'url' => Utils::get_placeholder_image_src()
					],
					[
						'id' => 0,
						'url' => Utils::get_placeholder_image_src()
					],
					[
						'id' => 0,
						'url' => Utils::get_placeholder_image_src()
					],
					[
						'id' => 0,
						'url' => Utils::get_placeholder_image_src()
					],
					[
						'id' => 0,
						'url' => Utils::get_placeholder_image_src()
					]
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'          => 'jltma_image_carousel_image',
				'default'       => 'medium',
				'separator'     => 'before'
			]
		);

		$this->add_control(
			'enable_lightbox',
			[
				'type' 				=> Controls_Manager::SWITCHER,
				'label_off' 		=> esc_html__('No', 'master-addons' ),
				'label_on' 			=> esc_html__('Yes', 'master-addons' ),
				'return_value' 		=> 'yes',
				'default' 			=> 'yes',
				'label' 			=> esc_html__('Enable Lightbox Gallery?', 'master-addons' ),
				'frontend_available' 	=> true
			]
		);

		$this->add_control(
			'lightbox_library',
			[
				'type' 				=> Controls_Manager::SELECT,
				'label' 			=> esc_html__('Lightbox Library', 'master-addons' ),
				'description' 		=> esc_html__('Choose the preferred library for the lightbox', 'master-addons' ),
				'options' 			=> array(
					'fancybox' 		=> esc_html__('Fancybox', 'master-addons' ),
					'elementor' 	=> esc_html__('Elementor', 'master-addons' ),
				),
				'default' 			=> 'fancybox',
				'condition' 		=> [
					'enable_lightbox' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}


	protected function register_controls()
	{

		$this->jltma_image_carousel_images_controls();

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
		$this->jltma_swiper_item_style_controls('image-carousel');

		//Lightbox Style
		$this->start_controls_section(
			'section_style_lightbox',
			[
				'label'      => __('Lightbox', 'master-addons' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_lightbox' => 'yes',
				],
			]
		);
		$this->add_control(
			'image_carousel_caption_preview_icon_style',
			[
				'label'     => __('Preview Icon', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',

			]

		);
		$this->add_control(
			'preview_icon',
			[
				'label'            => esc_html__('Custom Preview Icon', 'master-addons' ),
				'description'      => __('Please choose an icon from the list.', 'master-addons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'render_type' => 'template',
				'condition'   => [
					'enable_lightbox' => 'yes',
				],
			]
		);
		$this->add_control(
			'image_carousel_caption_preview_icon_color',
			[
				'label'     => __('Icon Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-image-carousel-slider .jltma-image-carousel-figure a i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-image-carousel-slider .jltma-image-carousel-figure a svg' => 'fill : {{VALUE}};',
				],
				'global'    =>  [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$this->add_control(
			'image_carousel_caption_preview_icon_color_hover',
			[
				'label'     => __('Icon Color Hover', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-image-carousel-slider .jltma-image-carousel-figure a i:hover'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-image-carousel-slider .jltma-image-carousel-figure a svg:hover' => 'fill: {{VALUE}}',
				],

			]
		);

		$this->add_control(
			'image_carousel_caption_preview_icon_size',
			[
				'label' => __('Icon Size', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'default' => [
					'size' => '20',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-image-carousel-slider .jltma-image-carousel-figure a i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-image-carousel-slider .jltma-image-carousel-figure a svg' => 'height : {{SIZE}}{{UNIT}}; width : {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_carousel_caption_preview_icon_space_to_left',
			[
				'label' => __('Icon Gap to Left', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 300,
					],
				],
				'default' => [
					'size' => '20',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-image-carousel-slider .jltma-image-carousel-figure a i, {{WRAPPER}} .jltma-image-carousel-slider .jltma-image-carousel-figure a svg' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'image_carousel_caption_preview_icon_space_to_top',
			[
				'label' => __('Icon Gap to Top', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 300,
					],
				],
				'default' => [
					'size' => '20',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-image-carousel-slider .jltma-image-carousel-figure a i, {{WRAPPER}} .jltma-image-carousel-slider .jltma-image-carousel-figure a svg'  => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_carousel_lightbox_background',
			[
				'label'     => __('Overlay', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]

		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'image_carousel_overlay_color',
				'label'     => __('Color', 'master-addons' ),
				'types'     => ['none', 'classic', 'gradient'],
				'selector'  => '.dialog-lightbox-widget.dialog-type-lightbox.elementor-lightbox, .fancybox-container.fancybox-is-open .fancybox-bg',
			]
		);

		$this->add_control(
			'image_carousel_caption_title_style',
			[
				'label'     => __('Caption Title', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]

		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'   => 'image_carousel_caption_title_typography',
				'label'  => __('Typography', 'master-addons' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
				'selector'  => '.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__title, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-title',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'image_carousel_caption_title_bgcolor',
				'label'     => __('Color', 'master-addons' ),
				'types'     => ['none', 'classic', 'gradient'],
				'selector'  => '.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__title, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-title',
			]
		);

		$this->add_control(
			'image_carousel_caption_title_color',
			[
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__title, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-title' => 'color:{{VALUE}};'
				],
				'global'    =>  [
					'default' => Global_Colors::COLOR_PRIMARY,
				]
			]
		);

		$this->add_control(
			'image_carousel_caption_title_color_hover',
			[
				'label'     => __('Hover Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__title, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-title:hover' => 'color:{{VALUE}};'
				]
			]
		);

		$this->add_control(
			'image_carousel_caption_title_padding',
			[
				'label'     => __('Padding', 'master-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__title, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-title' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				]

			]
		);

		$this->add_control(
			'image_carousel_caption_title_margin',
			[
				'label'     => __('Margin', 'master-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__title, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-title' => 'margin: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				]

			]
		);

		$this->add_control(
			'image_carousel_caption_title_rotate',
			[
				'label'   => __('Rotate', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__title, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-title' => 'transform: rotate({{SIZE}}{{UNIT}});',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_carousel_caption_title_border',
				'label'    => __('Border', 'master-addons' ),
				'selector' => '.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__title, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-title',
			]
		);

		$this->add_control(
			'image_carousel_caption_title_border_radious',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__title, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_carousel_caption_subtitle_style',
			[
				'label'     => __('Caption Subtitle', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]

		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'   => 'image_carousel_caption_subtitle_typography',
				'label'  => __('Typography', 'master-addons' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
				'selector'  => '.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__description, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-subtitle',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'image_carousel_caption_subtitle_bgcolor',
				'label'     => __('Color', 'master-addons' ),
				'types'     => ['none', 'classic', 'gradient'],
				'selector'  => '.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__description, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-subtitle',
			]
		);

		$this->add_control(
			'image_carousel_caption_subtitle_color',
			[
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__description, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-subtitle' => 'color:{{VALUE}};'
				],
				'global'    =>  [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$this->add_control(
			'image_carousel_caption_subtitle_color_hover',
			[
				'label'     => __('Hover Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__description, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-subtitle:hover' => 'color:{{VALUE}};'
				],
			]
		);

		$this->add_control(
			'image_carousel_caption_subtitle_padding',
			[
				'label'     => __('Padding', 'master-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__description, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-subtitle' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],

			]
		);

		$this->add_control(
			'image_carousel_caption_subtitle_margin',
			[
				'label'     => __('Margin', 'master-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__description, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-subtitle' => 'margin: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],

			]
		);

		$this->add_control(
			'image_carousel_caption_subtitle_rotate',
			[
				'label'   => __('Rotate', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__description, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-subtitle' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_carousel_caption_subtitle_border',
				'label'    => __('Border', 'master-addons' ),
				'selector' => '.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__description, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-subtitle',
			]
		);

		$this->add_control(
			'image_carousel_caption_subtitle_border_radious',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'.elementor-lightbox .dialog-message .elementor-slideshow__footer .elementor-slideshow__description, .fancybox-container.fancybox-is-open .fancybox-caption__body .jltma-fancybox-caption .jltma-image-carousel-subtitle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		//Navigation Style
		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'      => __('Navigation', 'master-addons' ),
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
		$this->jltma_swiper_navigation_style_controls('image-carousel');

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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/image-carousel/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/image-carousel/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=wXPEl93_UBw" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);
		$this->end_controls_section();




		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'jltma_section_upgrade_pro',
				[
					'label' => __('Upgrade to Pro for More Features', 'master-addons' )
				]
			);

			$this->add_control(
				'maad_el_control_get_pro',
				[
					'label' => __('Unlock more possibilities', 'master-addons' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => __('', 'master-addons' ),
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


	// Render Header
	private function jltma_render_image_carousel_header()
	{
		$settings       = $this->get_settings_for_display();

		//Global Header Function
		$this->jltma_render_swiper_header_attribute('image-carousel');

		$unique_id 	= implode('-', [$this->get_id(), get_the_ID()]);

		$this->add_render_attribute([
			'jltma-img-carousel-wrapper' => [
				'class' => [
					'jltma-image-carousel-wrapper',
					'jltma-carousel',
					'jltma-swiper',
					'jltma-swiper__container',
					'swiper-container',
					'elementor-jltma-element-' . esc_attr($unique_id)
				],
				'data-image-carousel-template-widget-id' => $unique_id
			],
			'swiper-wrapper' => [
				'class' => [
					'jltma-image-carousel',
					'jltma-swiper__wrapper',
					'swiper-wrapper',
				],
			],

			'swiper-item' => [
				'class' => [
					'jltma-slider__item',
					'jltma-swiper__slide',
					'swiper-slide',
				],
			],
		]);

		$this->add_render_attribute('carousel', 'class', ['jltma-image-carousel-slider']);
?>
		<div <?php echo $this->get_render_attribute_string('carousel'); ?>>
			<div <?php echo $this->get_render_attribute_string('jltma-img-carousel-wrapper'); ?>>
				<div <?php echo $this->get_render_attribute_string('swiper-wrapper'); ?>>

					<?php
				}



				// Render Header
				private function jltma_render_image_carousel_loop_item()
				{
					$settings = $this->get_settings_for_display();

				

					// $slider_items = $settings['jltma_image_carousel_items'];
					$slider_items = $settings['jltma_image_carousel_images'];

					if (empty($slider_items)) {
						return;
					}


					if (count($slider_items) > 1) {

						foreach ($slider_items as $index => $item) {

							$demo_image = Utils::get_placeholder_image_src();
							$image_id   = $item['id'];
							$image      = $item['url'];
							if (empty($image)) {
								$image = $demo_image;
							}

							$repeater_key 				= 'jltma_image_carousel_images' . esc_attr($index);
							$repeater_key_lightbox 		= 'jltma_image_carousel_images' . esc_attr($index);
							$repeater_key 				= 'carousel_item' . esc_attr($index);
							$this->add_render_attribute([
								$repeater_key => [
									'class' => [
										'jltma-slider__item',
										'jltma-swiper__slide',
										'swiper-slide',
									],
								]
							]);

							$tag            = 'div';
							$image_title    = get_post_field('post_title', $image_id);
							$image_caption  = get_post_field('post_excerpt', $image_id);
							$image_alt      = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
							$this->add_render_attribute($repeater_key_lightbox, 'class', 'jltma-image-carousel-slider-item');

							// Website Links
							if ( $settings['enable_lightbox'] == "yes" ) {
								$popup_tag    = 'a';
								$title_text   = !empty($image_title) ? '<h4 class="jltma-image-carousel-title">'.$image_title.'</h4>' : '';
								$caption_text = !empty($image_caption) ? '<p class="jltma-image-carousel-subtitle">'.$image_caption.'</p>' : '';
								$caption_data = (!empty($image_title) || !empty($image_caption)) ? '<div class="jltma-fancybox-caption">' . $title_text . $caption_text . '</div>' : '';
								$this->add_render_attribute($repeater_key_lightbox, 'class', 'jltma-image-slider-link'); 
								$this->add_render_attribute($repeater_key_lightbox, 'href', $image);
							}

							// Lightbox Conditions
							if ($settings['enable_lightbox'] == "yes") {

								$anchor_type   = 'jltma-click-icon';

								if ($settings['lightbox_library'] == 'fancybox') {

									$this->add_render_attribute([
										$repeater_key_lightbox => [
											'class' => [
												'jltma-lightbox-item ' . esc_attr($anchor_type),
												'elementor-clickable',
												'jltma-fancybox'
											],
											'data-fancybox'                     => "gallery",
											'data-elementor-lightbox-slideshow' => esc_attr($this->get_id()),
											'data-elementor-open-lightbox' 		=> "no",
											'data-caption' 						=> $caption_data
										]
									]);
								} elseif ($settings['lightbox_library'] == 'elementor') {

									$this->add_render_attribute([
										$repeater_key_lightbox => [
											'class' => [
												'jltma-lightbox-item-' . esc_attr($anchor_type),
												'elementor-clickable',
											],
											'data-thumb'                          => $image,
											'data-elementor-open-lightbox'        => "yes",
											'data-elementor-lightbox-title'       => $image_title ?: '',
											'data-elementor-lightbox-description' => $image_caption ?: '',
										]
									]);
								}
							}
							$image_size = $settings['jltma_image_carousel_image_size'];
							if( $image_size == 'custom' ){
								$image_size = array_values($settings['jltma_image_carousel_image_custom_dimension']);
							}
					?>
							<<?php echo esc_attr($tag); ?> <?php echo $this->get_render_attribute_string($repeater_key); ?>>

								<figure class="jltma-image-carousel-figure">

									<?php
									if ($settings['enable_lightbox'] == "yes") { ?>
										<<?php echo esc_attr($popup_tag); ?> <?php echo $this->get_render_attribute_string($repeater_key_lightbox); ?>>
											<?php if ( (!empty($settings['icon']) || !empty($settings['preview_icon']['value']))) {
												if (!isset($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
													$settings['icon'] = 'fa-link';
												}

												$has_icon = !empty($settings['icon']);
												if ($has_icon and 'icon' == $settings['preview_icon']) {
													$this->add_render_attribute('jltma-icon', 'class', $settings['preview_icon']);
													$this->add_render_attribute('jltma-icon', 'aria-hidden', 'true');
												}

												if (!$has_icon && !empty($settings['preview_icon']['value'])) {
													$has_icon = true;
												}

												$migrated = isset($settings['__fa4_migrated']['preview_icon']);
												$is_new   = empty($settings['icon']) && Icons_Manager::is_migration_allowed();

												if ($is_new || $migrated) {
													Icons_Manager::render_icon($settings['preview_icon'], ['aria-hidden' => 'true']);
												} else {
													echo '<i ' . $this->get_render_attribute_string('jltma-icon') . '></i>';
												}
											}else{
												echo '<?xml version="1.0" encoding="iso-8859-1"?><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M210,229.236V90H90v150h90.935L272,369.004v-52.215L210,229.236z M180,210h-60v-90h60V210z"/></g></g><g><g><path d="M0,0v512h512V0H0z M482,482H30V30h452V482z"/></g></g><g><g><path d="M330.031,272L240,142.997v52.214l62,89.135V422h120V272H330.031z M392,392h-60v-90h60V392z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';
											} ?>
										</<?php echo esc_attr($popup_tag); ?>>

									<?php }

									if (isset($image_id) && $image_id) {
										echo wp_get_attachment_image(
											$image_id,
											$image_size,
											false,
											[
												'class' => 'jltma-carousel-img elementor-animation-',
												'alt' => esc_attr($image_alt),
											]
										);
									} else {
										echo "<img src=" . $image . ">";
									}

									?>
								</figure>

							</<?php echo esc_attr($tag); ?>>

					<?php

						}  // end of foreach

					}
				}



				// Render Header
				private function jltma_render_image_carousel_footer()
				{
					$settings       = $this->get_settings_for_display();
					?>

				</div> <!-- swiper-wrapper -->

			</div>
			<!--/.ma-image-carousel-->


			<?php $this->render_swiper_navigation(); ?>

			<?php if ('yes' === $settings['show_scrollbar']) { ?>
				<div class="swiper-scrollbar"></div>
			<?php } ?>


		</div>
		<!--/.carousel-attribute-->
<?php

				}


				// Render Function
				protected function render()
				{
					$this->jltma_render_image_carousel_header();
					$this->jltma_render_image_carousel_loop_item();
					$this->jltma_render_image_carousel_footer();
				}
			}
