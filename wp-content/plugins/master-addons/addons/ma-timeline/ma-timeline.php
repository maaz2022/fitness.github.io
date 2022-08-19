<?php

namespace MasterAddons\Addons;

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Icons_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Core\Schemes\Color;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use \Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Master Addons Class
use MasterAddons\Inc\Helper\Master_Addons_Helper;
use MasterAddons\Inc\Traits\JLTMA_Swiper_Controls;
use MasterAddons\Inc\Controls\MA_Group_Control_Transition;

/**
 * Author Name: Liton Arefin
 * Author URL : https://master-addons.com
 * Date       : 10/18/19
 */



// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Master Addons: Timeline
 */
class JLTMA_Timeline extends Widget_Base
{
	use JLTMA_Swiper_Controls;

	public function get_name()
	{
		return 'ma-timeline';
	}

	public function get_title()
	{
		return __('Timeline', 'master-addons' );
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-time-line';
	}

	public function get_script_depends()
	{
		return [
			'swiper',
			'jltma-timeline',
			'gsap-js',
			'master-addons-scripts'
		];
	}

	public function get_style_depends()
	{
		return [
			'font-awesome-5-all',
			'font-awesome-4-shim',
			'master-addons-main-style'
		];
	}

	public function get_keywords()
	{
		return ['timeline', 'post timeline', 'vertical timeline', 'horizontal timeline', 'image timeline'];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/timeline/';
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'ma_el_timeline_section_start',
			[
				'label' => __('Timeline', 'master-addons' ),
			]
		);


		if (ma_el_fs()->can_use_premium_code()) {
			$this->add_control(
				'ma_el_timeline_type',
				[
					'label'   => __('Timeline Type', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'post',
					'options' => [
						'post'   => __('Post Timeline', 'master-addons' ),
						'custom' => __('Custom Timeline', 'master-addons' ),
					],
					'frontend_available' => true,
				]
			);
		} else {
			$this->add_control(
				'ma_el_timeline_type',
				[
					'label'   => __('Timeline Type', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'custom',
					'options' => [
						'timeline-post' => __('Post Timeline (Pro)', 'master-addons' ),
						'custom'        => __('Custom Timeline', 'master-addons' ),
					],
				]
			);
		}


		$this->add_control(
			'ma_el_timeline_design_type',
			[
				'label'   => __('Timeline Style', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'vertical'   => __('Vertical Timeline', 'master-addons' ),
					'horizontal' => __('Horizontal Timeline', 'master-addons' )
				],
				'default'   => 'vertical',
				'condition' => [
					'ma_el_timeline_type' => ['custom']
				],
				'frontend_available' => true,
			]
		);


		if (ma_el_fs()->can_use_premium_code()) {

			$this->add_control(
				'ma_el_post_grid_ignore_sticky',
				[
					'label'        => esc_html__('Ignore Sticky?', 'master-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'default'      => 'yes',
					'condition'    => [
						'ma_el_timeline_type' => 'post',
					]
				]
			);

			$this->add_control(
				'ma_el_timeline_post_card_links',
				[
					'label'        => __('Enable Links', 'master-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __('Yes', 'master-addons' ),
					'label_off'    => __('No', 'master-addons' ),
					'return_value' => 'yes',
					'description'  => __('Enable links at card level. If you have links inside the content of a card, make sure you have this disabled. Links within links are not allowed.', 'master-addons' ),
					'condition'    => [
						'ma_el_timeline_type' => 'post',
					]
				]
			);

			$this->add_control(
				'ma_el_timeline_post_title_heading',
				[
					'label'     => __('Title', 'master-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'ma_el_timeline_type' => 'post',
					]
				]
			);

			$this->add_control(
				'ma_el_timeline_post_title',
				[
					'label'        => __('Show Title', 'master-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'label_on'     => __('Yes', 'master-addons' ),
					'label_off'    => __('No', 'master-addons' ),
					'return_value' => 'yes',
					'condition'    => [
						'ma_el_timeline_type' => 'post',
					]
				]
			);

			$this->add_control(
				'ma_el_timeline_post_title_link',
				[
					'label'        => __('Title Link', 'master-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __('Yes', 'master-addons' ),
					'label_off'    => __('No', 'master-addons' ),
					'return_value' => 'yes',
					'condition'    => [
						'ma_el_timeline_type'        => 'post',
						'ma_el_timeline_post_title!' => ''
					]
				]
			);
			$this->add_control(
				'title_html_tag',
				[
					'label'     => __('Heading Tag', 'master-addons' ),
					'type'      => Controls_Manager::SELECT,
					'options'   => Master_Addons_Helper::jltma_title_tags(),
					'default'   => 'h2',
					'condition' => [
						'ma_el_timeline_type'        => 'post',
						'ma_el_timeline_post_title!' => '',
					],
				]
			);

			$this->add_control(
				'ma_el_timeline_post_thumb_heading',
				[
					'label'     => __('Thumbnail', 'master-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'ma_el_timeline_type' => 'post',
					]
				]
			);


			$this->add_control(
				'ma_el_timeline_post_thumbnail',
				[
					'label'        => __('Show Image', 'master-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'label_on'     => __('Yes', 'master-addons' ),
					'label_off'    => __('No', 'master-addons' ),
					'return_value' => 'yes',
					'condition'    => [
						'ma_el_timeline_type' => 'post'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'         => 'ma_el_timeline_post_thumbnail_size',
					'label'        => __('Image Size', 'master-addons' ),
					'default'      => 'medium',
					'prefix_class' => 'elementor-portfolio--thumbnail-size-',
					'condition'    => [
						'ma_el_timeline_type'           => 'post',
						'ma_el_timeline_post_thumbnail' => 'yes'
					]
				]
			);

			$this->add_control(
				'ma_el_timeline_post_offset',
				[
					'label'     => __('Offset Post Count', 'master-addons' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => '0',
					'min'       => '0',
					'condition' => [
						'ma_el_timeline_type' => 'post',
					]
				]
			);


			$this->add_control(
				'ma_el_timeline_date_heading',
				[
					'label'     => __('Date', 'master-addons' ),
					'type'      => Controls_Manager::HEADING,
					'condition' => [
						'ma_el_timeline_type' => 'post',
					]
				]
			);
			
			$this->add_control(
				'ma_el_timeline_date_format',
				[
					'label'   => __('Date Format', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'default' => __('Default', 'master-addons' ),
						'F j, Y'  => date('F j, Y'),
						'M j, y'  => date('M j, y'),
						'Y-m-d'   => date('Y-m-d'),
						'm/d/Y'   => date('m/d/Y'),
						'd/m/Y'   => date('d/m/Y'),
						'custom'  => __('Custom', 'master-addons' ),
					],
					'default'   => 'M j, y',
					'condition' => [
						'ma_el_timeline_type' => 'post',
					],
				]
			);

			$this->add_control(
				'ma_el_timeline_time_format',
				[
					'label'   => __('Time Format', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'default' => __('Default', 'master-addons' ),
						''        => __('None', 'master-addons' ),
						'g:i a'   => date('g:i a'),
						'g:i A'   => date('g:i A'),
						'H:i'     => date('H:i'),
					],
					'default'   => 'default',
					'condition' => [
						'ma_el_timeline_type' => 'post',
					],
				]
			);

			$this->add_control(
				'ma_el_timeline_date_custom_format',
				[
					'label'       => __('Custom Format', 'master-addons' ),
					'default'     => get_option('date_format') . ' ' . get_option('time_format'),
					'description' => sprintf('<a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">%s</a>', __('Documentation on date and time formatting', 'master-addons' )),
					'condition'   => [
						'ma_el_timeline_type'        => 'post',
						'ma_el_timeline_date_format' => 'custom'
					],
				]
			);


			$this->add_control(
				'ma_el_blog_posts_per_page',
				[
					'label'     => __('Posts Per Page', 'master-addons' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => '3',
					'condition' => [
						'ma_el_timeline_type' => 'post',
					]
				]
			);

			$this->add_control(
				'ma_el_blog_order',
				[
					'label'       => __('Post Order', 'master-addons' ),
					'type'        => Controls_Manager::SELECT,
					'label_block' => true,
					'options'     => [
						'asc'  => __('Ascending', 'master-addons' ),
						'desc' => __('Descending', 'master-addons' )
					],
					'default'   => 'desc',
					'condition' => [
						'ma_el_timeline_type' => 'post',
					]
				]
			);

			$this->add_control(
				'ma_el_blog_order_by',
				[
					'label'       => __('Order By', 'master-addons' ),
					'type'        => Controls_Manager::SELECT,
					'label_block' => true,
					'options'     => [
						'none'          => __('None', 'master-addons' ),
						'ID'            => __('ID', 'master-addons' ),
						'author'        => __('Author', 'master-addons' ),
						'title'         => __('Title', 'master-addons' ),
						'name'          => __('Name', 'master-addons' ),
						'date'          => __('Date', 'master-addons' ),
						'modified'      => __('Last Modified', 'master-addons' ),
						'rand'          => __('Random', 'master-addons' ),
						'comment_count' => __('Number of Comments', 'master-addons' ),
					],
					'default'   => 'date',
					'condition' => [
						'ma_el_timeline_type' => 'post',
					]
				]
			);


			$this->add_control(
				'ma_el_blog_categories',
				[
					'label'       => __('Category', 'master-addons' ),
					'type'        => Controls_Manager::SELECT2,
					'description' => __('Get posts for specific category(s)', 'master-addons' ),
					'label_block' => true,
					'multiple'    => true,
					'options'     => Master_Addons_Helper::ma_el_blog_post_type_categories(),
					'condition'   => [
						'ma_el_timeline_type' => 'post',
					]
					//					'condition'     => [
					//						'ma_el_blog_cat_tabs'  => 'yes'
					//					]
				]
			);

			$this->add_control(
				'ma_el_blog_tags',
				[
					'label'       => __('Filter By Tag', 'master-addons' ),
					'type'        => Controls_Manager::SELECT2,
					'description' => __('Get posts for specific tag(s)', 'master-addons' ),
					'label_block' => true,
					'multiple'    => true,
					'options'     => Master_Addons_Helper::ma_el_blog_post_type_tags(),
					'condition'   => [
						'ma_el_timeline_type' => 'post',
					]
				]
			);

			$this->add_control(
				'ma_el_blog_users',
				[
					'label'       => __('Author', 'master-addons' ),
					'type'        => Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple'    => true,
					'options'     => Master_Addons_Helper::ma_el_blog_post_type_users(),
					'condition'   => [
						'ma_el_timeline_type' => 'post',
					]
				]
			);


			$this->add_control(
				'ma_el_blog_posts_exclude',
				[
					'label'       => __('Posts to Exclude', 'master-addons' ),
					'type'        => Controls_Manager::SELECT2,
					'description' => __('Add post(s) to exclude', 'master-addons' ),
					'label_block' => true,
					'multiple'    => true,
					'options'     => Master_Addons_Helper::ma_el_blog_posts_list(),
					'condition'   => [
						'ma_el_timeline_type' => 'post',
					]
				]
			);

			$this->add_control(
				'ma_el_timeline_excerpt_length',
				[
					'label'     => __('Excerpt Length', 'master-addons' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 25,
					'condition' => [
						'ma_el_timeline_type' => 'post',
					]
					//					'condition'     => [
					//						'ma_el_timeline_excerpt'  => 'yes',
					//					]
				]
			);

			$this->add_control(
				'ma_el_timeline_excerpt_type',
				[
					'label'   => __('Excerpt Type', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'three_dots'     => __('Three Dots', 'master-addons' ),
						'read_more_link' => __('Read More Link', 'master-addons' ),
					],
					'default'     => 'read_more_link',
					'label_block' => true,
					'condition'   => [
						'ma_el_timeline_type' => 'post',
					]
					//					'condition'     => [
					//						'ma_el_timeline_excerpt'  => 'yes',
					//					]
				]
			);

			$this->add_control(
				'ma_el_timeline_excerpt_text',
				[
					'label'     => __('Read More Text', 'master-addons' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => __('Read More', 'master-addons' ),
					'condition' => [
						//						'ma_el_timeline_excerpt'      => 'yes',
						'ma_el_timeline_excerpt_type' => 'read_more_link',
						'ma_el_timeline_type'         => 'post',
					]
				]
			);
		}

		$repeater = new Repeater();

		$repeater->start_controls_tabs('ma_el_custom_timeline_items_repeater');

		$repeater->start_controls_tab(
			'ma_el_custom_timeline_tab_content',
			[
				'label' => __('Content', 'master-addons' )
			]
		);
		$repeater->add_control(
			'ma_el_custom_timeline_date_type',
			[
				'label'   => __('Show', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''       => __('Date', 'master-addons' ),
					'custom' => __('Custom Label', 'master-addons' ),
				],
				'default' => '',
			]
		);
		
		$repeater->add_control(
			'ma_el_custom_timeline_date',
			[
				'label'          => __('Date', 'master-addons' ),
				'type'           => Controls_Manager::DATE_TIME,
				'dynamic'        => ['active' => true],
				'default'        => __('23 March 2020', 'master-addons' ),
				'placeholder'    => __('23 March 2020', 'master-addons' ),
				'label_block'    => true,
				'picker_options' => array(
					'enableTime' => false,
				),
				'condition'		=> [
					'ma_el_custom_timeline_date_type!' => 'custom',
				],
			]
		);

		$repeater->add_control(
			'ma_el_custom_timeline_label',
			[
				'label'       => __('Label', 'master-addons' ),
				'description' => __('Write your custom text here.', 'master-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block'    => true,
				'condition'		=> [
					'ma_el_custom_timeline_date_type' => 'custom',
				],
			]
		);

		$repeater->add_control(
			'ma_el_custom_timeline_link',
			[
				'label'       => __('Link', 'master-addons' ),
				'description' => __('Enable linking the whole card. If you have links inside the content of this card, make sure you have this disabled. Links within links are not allowed.', 'master-addons' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => ['active' => true],
				'placeholder' => esc_url(home_url('/')),
				'default'     => [
					'url' => '',
				],
			]
		);

		$default_title     = '<h2>' . __('Nam commodo suscipit', 'master-addons' ) . '</h2>';
		$default_paragraph = '<p>' . _x('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo', 'master-addons' ) . '</p>';


		$repeater->add_control(
			'ma_el_custom_timeline_content',
			[
				'label'   => '',
				'type'    => Controls_Manager::WYSIWYG,
				'dynamic' => ['active' => true],
				'default' => $default_title . $default_paragraph,
			]
		);


		$repeater->end_controls_tab();


		$repeater->start_controls_tab('ma_el_custom_timeline_tab_media', ['label' => __('Media', 'master-addons' )]);

		$repeater->add_control(
			'ma_el_custom_timeline_image',
			[
				'label'   => esc_html__('Choose Image', 'master-addons' ),
				'dynamic' => ['active' => true],
				'type'    => Controls_Manager::MEDIA,
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'ma_el_custom_timeline_image_size',   // Actually its `image_size`
				'label'   => esc_html__('Image Size', 'master-addons' ),
				'default' => 'large',
				'exclude' => array('custom'),
			]
		);

		$repeater->end_controls_tab();


		if (ma_el_fs()->can_use_premium_code()) {

			$repeater->start_controls_tab('ma_el_custom_timeline_tab_style', ['label' => __('Style', 'master-addons' )]);

			$repeater->add_control(
				'ma_el_custom_timeline_custom_style',
				[
					'label'        => __('Custom', 'master-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __('Yes', 'master-addons' ),
					'label_off'    => __('No', 'master-addons' ),
					'return_value' => 'yes',
					'description'  => __('Set custom styles that will only affect this specific item.', 'master-addons' ),
				]
			);

			$repeater->add_control(
				'ma_el_custom_timeline_point_content_type',
				[
					'label'   => __('Type', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						''        => __('Global', 'master-addons' ),
						'icons'   => __('Icon', 'master-addons' ),
						'image'   => __('Image', 'master-addons' ),
						'numbers' => __('Number', 'master-addons' ),
						'letters' => __('Letter', 'master-addons' ),
					],
					'conditions' => [
						'terms' => [
							[
								'name'     => 'ma_el_custom_timeline_custom_style',
								'operator' => '==',
								'value'    => 'yes',
							]
						],
					],
				]
			);

			$repeater->add_control(
				'ma_el_custom_timeline_pointer_image',
				[
					'label'     => __('Pointer Image', 'master-addons' ),
					'dynamic'   => ['active' => true],
					'type'      => Controls_Manager::MEDIA,
					'condition' => [
						'ma_el_custom_timeline_point_content_type' => "image"
					],
				]
			);

			$repeater->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'      => 'ma_el_custom_timeline_pointer_image_size',   // Actually its `image_size`
					'label'     => __('Image Size', 'master-addons' ),
					'default'   => 'large',
					'condition' => [
						'ma_el_custom_timeline_point_content_type' => "image"
					],
				]
			);


			$repeater->add_control(
				'ma_el_custom_timeline_selected_icon',
				[
					'label'            => __('Point Icon', 'master-addons' ),
					'type'             => Controls_Manager::ICONS,
					'fa4compatibility' => 'global_icon',
					'label_block'      => true,
					'default'          => [
						'value'   => 'fab fa-wordpress',
						'library' => 'brand',
					],
					'conditions'       => [
						'terms' => [
							[
								'name'     => 'ma_el_custom_timeline_custom_style',
								'operator' => '==',
								'value'    => 'yes',
							],
							[
								'name'     => 'ma_el_custom_timeline_point_content_type',
								'operator' => '==',
								'value'    => 'icons',
							],
						],
					],
				]
			);

			$repeater->add_control(
				'ma_el_custom_timeline_point_content',
				[
					'label'      => __('Point Content', 'master-addons' ),
					'type'       => Controls_Manager::TEXT,
					'conditions' => [
						'terms' => [
							[
								'name'     => 'ma_el_custom_timeline_custom_style',
								'operator' => '==',
								'value'    => 'yes',
							],
							[
								'name'     => 'ma_el_custom_timeline_point_content_type',
								'operator' => '!==',
								'value'    => 'icons',
							],
							[
								'name'     => 'ma_el_custom_timeline_point_content_type',
								'operator' => '!==',
								'value'    => '',
							],
						],
					],
				]
			);

			$repeater->add_control(
				'ma_el_custom_timeline_item_default',
				[
					'label'      => __('Default', 'master-addons' ),
					'type'       => Controls_Manager::HEADING,
					'conditions' => [
						'terms' => [
							[
								'name'     => 'ma_el_custom_timeline_custom_style',
								'operator' => '==',
								'value'    => 'yes',
							],
						],
					],
				]
			);


			$repeater->add_control(
				'ma_el_custom_timeline_icon_color',
				[
					'label'     => __('Point Color', 'master-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .jltma-timeline-post-type-icon' => 'color: {{VALUE}};',
						'{{WRAPPER}} {{CURRENT_ITEM}} .jltma-timeline-post-type-icon svg' => 'fill: {{VALUE}};',
					],
					'conditions' => [
						'terms' => [
							[
								'name'     => 'ma_el_custom_timeline_custom_style',
								'operator' => '==',
								'value'    => 'yes',
							],
						],
					],
				]
			);

			$repeater->add_control(
				'ma_el_custom_timeline_point_background',
				[
					'label'     => __('Point Background', 'master-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#4b00e7',
					'selectors' => [
						'{{WRAPPER}} .jltma-timeline {{CURRENT_ITEM}} .jltma-timeline-post-type-icon,
						{{WRAPPER}} .jltma-timeline {{CURRENT_ITEM}} .jltma-timeline-post-mini-thumb' => 'background-color: {{VALUE}};',
					],
					'conditions' => [
						'terms' => [
							[
								'name'     => 'ma_el_custom_timeline_custom_style',
								'operator' => '==',
								'value'    => 'yes',
							],
						],
					],
				]
			);

			$repeater->add_control(
				'ma_el_custom_timeline_card_background',
				[
					'label'     => __('Card Background', 'master-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .timeline-item__content-wrapper' => 'background-color: {{VALUE}};'
					],
					'conditions' => [
						'terms' => [
							[
								'name'     => 'ma_el_custom_timeline_custom_style',
								'operator' => '==',
								'value'    => 'yes',
							],
						],
					],
				]
			);

			$repeater->add_control(
				'ma_el_custom_timeline_date_color',
				[
					'label'     => __('Date Color', 'master-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .jltma-timeline-post-date,
						{{WRAPPER}} {{CURRENT_ITEM}} .timeline-item__meta' => 'color: {{VALUE}};',
					],
					'conditions' => [
						'terms' => [
							[
								'name'     => 'ma_el_custom_timeline_custom_style',
								'operator' => '==',
								'value'    => 'yes',
							],
						],
					],
				]
			);

			$repeater->add_control(
				'ma_el_custom_timeline_point_size',
				[
					'label'   => __('Scale', 'master-addons' ),
					'type'    => Controls_Manager::SLIDER,
					'default' => [
						'size' => '',
					],
					'range'      => [
						'px' => [
							'min'  => 0.5,
							'max'  => 2,
							'step' => 0.01
						],
					],
					'selectors'  => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .jltma-timeline-post-type-icon' => 'transform: scale({{SIZE}})',
					],
					'conditions' => [
						'terms' => [
							[
								'name'     => 'ma_el_custom_timeline_custom_style',
								'operator' => '==',
								'value'    => 'yes',
							],
						],
					],
				]
			);


			$repeater->add_control(
				'ma_el_custom_timeline_item_hover',
				[
					'label'      => __('Hover', 'master-addons' ),
					'type'       => Controls_Manager::HEADING,
					'conditions' => [
						'terms' => [
							[
								'name'     => 'ma_el_custom_timeline_custom_style',
								'operator' => '==',
								'value'    => 'yes',
							],
						],
					],
				]
			);

			$repeater->add_control(
				'ma_el_custom_timeline_icon_color_hover',
				[
					'label'     => __('Hovered Point Color', 'master-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .jltma-timeline-post-type-icon:hover,
																												{{WRAPPER}} {{CURRENT_ITEM}} .jltma-timeline-post-type-icon:hover i' => 'color: {{VALUE}};'
					],
					'conditions' => [
						'terms' => [
							[
								'name'     => 'ma_el_custom_timeline_custom_style',
								'operator' => '==',
								'value'    => 'yes',
							],
						],
					],
				]
			);

			$repeater->add_control(
				'ma_el_custom_timeline_point_background_hover',
				[
					'label'     => __('Hovered Point Background', 'master-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .jltma-timeline-post-type-icon:hover,
																												{{WRAPPER}} {{CURRENT_ITEM}} .jltma-timeline-post-type-icon i:hover' => 'background-color: {{VALUE}};'
					],
					'conditions' => [
						'terms' => [
							[
								'name'     => 'ma_el_custom_timeline_custom_style',
								'operator' => '==',
								'value'    => 'yes',
							],
						],
					],
				]
			);


			$repeater->add_control(
				'ma_el_custom_timeline_card_background_hover',
				[
					'label'     => __('Hovered Card Background', 'master-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .timeline-item__content-wrapper:hover' => 'background-color: {{VALUE}};'
					],
					'conditions' => [
						'terms' => [
							[
								'name'     => 'ma_el_custom_timeline_custom_style',
								'operator' => '==',
								'value'    => 'yes',
							],
						],
					],
				]
			);

			$repeater->add_control(
				'ma_el_custom_timeline_date_color_hover',
				[
					'label'     => __('Hovered Date Color', 'master-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .jltma-timeline-post-date:hover,
						{{WRAPPER}} {{CURRENT_ITEM}} .timeline-item__meta:hover' => 'color: {{VALUE}};',
					],
					'conditions' => [
						'terms' => [
							[
								'name'     => 'ma_el_custom_timeline_custom_style',
								'operator' => '==',
								'value'    => 'yes',
							],
						],
					],
				]
			);
		}

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();


		$this->add_control(
			'ma_el_custom_timeline_items',
			[
				'label'   => __('Items', 'master-addons' ),
				'type'    => Controls_Manager::REPEATER,
				'default' => [
					[
						'ma_el_custom_timeline_date' => __('February 2, 2014', 'master-addons' )
					],
					[
						'ma_el_custom_timeline_date' => __('May 10, 2015', 'master-addons' )
					],
					[
						'ma_el_custom_timeline_date' => __('June 21, 2016', 'master-addons' )
					],
				],
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ ma_el_custom_timeline_date }}}',
				'condition'   => [
					'ma_el_timeline_type' => 'custom'
				]
			]
		);


		$this->end_controls_section();



		/*
		* MA Timeline: Image Style
		*/
		$this->start_controls_section(
			'section_content_navigation',
			[
				'label' => __('Navigation', 'master-addons' ),
				'condition' => [
					'ma_el_timeline_design_type' => 'horizontal'
				]
			]
		);

		// Global Navigation Controls
		$this->jltma_swiper_navigation_controls();

		$this->end_controls_section();


		//  Global Swiper Control Settings
		$this->start_controls_section(
			'section_carousel_settings',
			[
				'label' => __('Carousel Settings', 'master-addons' ),
				'condition' => [
					'ma_el_timeline_design_type' => 'horizontal'
				]
			]
		);

		$this->jltma_swiper_settings_controls();

		$this->end_controls_section();


		// Global Swiper Item Style
		$this->jltma_swiper_item_style_controls('timeline-carousel');



		/*
             * MA Timeline: Layout
             */

		$this->start_controls_section(
			'ma_el_timeline_section_layout',
			[
				'label' => __('Layout', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_responsive_control(
			'ma_el_timeline_align',
			[
				'label'          => __('Horizontal Align', 'master-addons' ),
				'type'           => Controls_Manager::SELECT,
				'label_block'    => true,
				'default'        => 'center',
				'tablet_default' => 'left',
				'mobile_default' => 'left',
				'options'        => [
					'left'    => __('Left', 'master-addons' ),
					'center'  => __('Center', 'master-addons' ),
					'overlay' => __('Overlay', 'master-addons' ),
					'right'   => __('Right', 'master-addons' ),
				],
				'prefix_class' => 'jltma-timeline-align%s--',
			]
		);

		$this->add_control(
			'ma_el_timeline_reverse',
			[
				'label'        => __('Reverse Cards Positions', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Yes', 'master-addons' ),
				'label_off'    => __('No', 'master-addons' ),
				'return_value' => 'yes',
				'condition'    => [
					'ma_el_timeline_align' => ['center'],
				],
			]
		);


		$this->add_control(
			'ma_el_timeline_cards_align',
			[
				'label'          => __('Vertical Align', 'master-addons' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'top',
				'tablet_default' => 'top',
				'mobile_default' => 'top',
				'options'        => [
					'top' 		=> [
						'title' => __('Left', 'master-addons' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' 	=> [
						'title' => __('Center', 'master-addons' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' 	=> [
						'title' => __('Right', 'master-addons' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'condition' 	=> [
					'ma_el_timeline_align!' => 'overlay'
				],
				'prefix_class' => 'jltma-timeline-cards-align--',
			]
		);


		$this->add_responsive_control(
			'ma_el_timeline_horizontal_spacing',
			[
				'label'   => __('Horizontal Spacing', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
				],
				'range' 		=> [
					'px' 		=> [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline .timeline-item .timeline-item__point,
					{{WRAPPER}} .jltma-timeline .jltma-timeline-horz-pointer .jltma-icon' => 'margin-left: {{SIZE}}px; margin-right: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_timeline_vertical_spacing',
			[
				'label'   => __('Vertical Spacing', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
				],
				'range' 		=> [
					'px' 		=> [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline .jltma-timeline__item,
					{{WRAPPER}}.jltma-timeline-align--overlay .timeline-item__point,
					{{WRAPPER}} .jltma-timeline .jltma-blog-timeline-post,
					{{WRAPPER}} .jltma-timeline .jltma-timeline-horz-pointer .jltma-icon' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();



		/*
		* MA Timeline: Image Style
		*/

		$this->start_controls_section(
			'ma_el_timeline_section_images',
			[
				'label' => __('Images', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ma_el_timeline_images_align',
			[
				'label'   => __('Alignment', 'master-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'left' 		=> [
						'title' => __('Left', 'master-addons' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' 	=> [
						'title' => __('Center', 'master-addons' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right' 	=> [
						'title' => __('Right', 'master-addons' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline .timeline-item .timeline-item__img' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'ma_el_timeline_images_spacing',
			[
				'label'   => __('Spacing', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
				],
				'range' 		=> [
					'px' 		=> [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline-entry-thimbnail' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);


		$this->add_control(
			'ma_el_timeline_images_border_radius',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-timeline-entry-thimbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();



		/*
			 * MA Timeline: Posts
			 */

		$this->start_controls_section(
			'ma_el_timeline_section_posts_style',
			[
				'label'     => __('Posts', 'master-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ma_el_timeline_type' => 'post',
				]
			]
		);

		$this->add_control(
			'ma_el_timeline_title_heading',
			[
				'label'     => __('Title', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'ma_el_timeline_type'        => 'post',
					'ma_el_timeline_post_title!' => '',
				]
			]
		);


		$this->add_control(
			'ma_el_timeline_title_color',
			[
				'label'     => __('Title Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline .jltma-timeline-entry-title' => 'color: {{VALUE}};',
				],
				'condition'			=> [
					'ma_el_timeline_type'        => 'post',
					'ma_el_timeline_post_title!' => '',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_timeline_titles_typography',
				'selector' => '{{WRAPPER}} .jltma-timeline .jltma-timeline-entry-title',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
				'condition'			=> [
					'ma_el_timeline_type'        => 'post',
					'ma_el_timeline_post_title!' => '',
				],
			]
		);


		$this->add_control(
			'ma_el_timeline_titles_spacing',
			[
				'label'   => __('Spacing', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
				],
				'range' 		=> [
					'px' 		=> [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline .jltma-timeline-entry-title' => 'margin-bottom: {{SIZE}}px;',
				],
				'condition'			=> [
					'ma_el_timeline_type'        => 'post',
					'ma_el_timeline_post_title!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_timeline_excerpt_heading',
			[
				'label'     => __('Excerpt', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'ma_el_timeline_type'        => 'post',
					'ma_el_timeline_post_title!' => '',
				]
			]
		);

		$this->add_control(
			'ma_el_timeline_excerpt_color',
			[
				'label'     => __('Excerpt Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline .timeline-item__excerpt' => 'color: {{VALUE}};',
				],
				'condition'			=> [
					'ma_el_timeline_type'        => 'post',
					'ma_el_timeline_post_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_timeline_excerpt_typography',
				'selector' => '{{WRAPPER}} .jltma-timeline .timeline-item__excerpt',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'condition'			=> [
					'ma_el_timeline_type'        => 'post',
					'ma_el_timeline_post_title!' => '',
				]
			]
		);


		$this->add_responsive_control(
			'ma_el_timeline_excerpt_padding',
			[
				'label'      => __('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-timeline .timeline-item__excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'			=> [
					'ma_el_timeline_type'        => 'post',
					'ma_el_timeline_post_title!' => '',
				],
			]
		);
		$this->end_controls_section();

		/*
             * MA Timeline: Date
             */

		$this->start_controls_section(
			'ma_el_timeline_section_date',
			[
				'label' => __('Date', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_timeline_date_typography',
				'selector' => '{{WRAPPER}} .jltma-timeline .jltma-timeline-post-date',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_control(
			'ma_el_timeline_date_color',
			[
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-item__meta-wrapper' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ma_el_timeline_date_bg_color',
			[
				'label'     => __('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-item__meta-wrapper'                                                  => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-blog-timeline-post:nth-child(2n+2) .jltma-timeline-post-date:before' => 'border-right: 20px solid {{VALUE}};',
					'{{WRAPPER}} .jltma-blog-timeline-post:nth-child(2n+1) .jltma-timeline-post-date:before' => 'border-left: 20px solid {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_timeline_date_padding',
			[
				'label'      => __('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-timeline .timeline-item__meta-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_timeline_date_vertical_spacing',
			[
				'label'   => __('Vertical Spacing', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
				],
				'range' 		=> [
					'px' 		=> [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline .timeline-item__meta-wrapper' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();


		/*
		* Timeline: Cards
		*/

		$this->start_controls_section(
			'section_cards',
			[
				'label' => __('Cards', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'cards_padding',
			[
				'label'      => __('Card Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-timeline .timeline-item__content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cards_margin',
			[
				'label'      => __('Card Margin', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-timeline .timeline-item__content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cards_content_padding',
			[
				'label'      => __('Content Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-timeline .timeline-item__content,
					{{WRAPPER}} .jltma-timeline .jltma-timeline-entry-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'cards_border_radius',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-timeline .timeline-item__content-wrapper,
					{{WRAPPER}} .jltma-timeline .jltma-timeline-entry-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'animate_in',
			[
				'label'        => __('Animate Cards', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'animate',
				'label_on'     => __('Yes', 'master-addons' ),
				'label_off'    => __('No', 'master-addons' ),
				'return_value' => 'animate',
				'prefix_class' => 'jltma-timeline%s-'
			]
		);

		$this->add_group_control(
			MA_Group_Control_Transition::get_type(),
			[
				'name'     => 'cards',
				'selector' => '{{WRAPPER}} .timeline-item__content-wrapper,
							 		{{WRAPPER}} .timeline-item__content__wysiwyg *,
							 		{{WRAPPER}} .jltma-timeline-entry-title,
							 		{{WRAPPER}} .timeline-item__meta,
							 		{{WRAPPER}} .timeline-item__excerpt,
									{{WRAPPER}} .timeline-item__card__arrow::after',
				'separator' => '',
			]
		);

		$this->start_controls_tabs('tabs_cards');

		$this->start_controls_tab('tab_cards_default', ['label' => __('Default', 'master-addons' )]);

		$this->add_responsive_control(
			'cards_color',
			[
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-item__content-wrapper,
							 {{WRAPPER}} .timeline-item__content-wrapper *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'cards_background_color',
			[
				'label'     => __('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-item__content-wrapper,
					{{WRAPPER}} .jltma-timeline-entry-content'                         => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .timeline-item__card .timeline-item__card__arrow::after' => 'border-left-color: {{VALUE}}; border-right-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'cards_box_shadow',
				'selector' => '{{WRAPPER}} .timeline-item__content-wrapper',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('tab_cards_hover', ['label' => __('Hover', 'master-addons' )]);

		$this->add_responsive_control(
			'cards_color_hover',
			[
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-item:hover .timeline-item__content-wrapper,
							 {{WRAPPER}} .timeline-item:hover .timeline-item__content-wrapper *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'cards_background_color_hover',
			[
				'label'     => __('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-item:not(.is--focused):hover .timeline-item__content-wrapper'                         => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .timeline-item:not(.is--focused):hover .timeline-item__card .timeline-item__card__arrow::after' => 'border-left-color: {{VALUE}}; border-right-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'cards_box_shadow_hover',
				'selector' => '{{WRAPPER}} .timeline-item:hover .timeline-item__content-wrapper',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('tab_cards_focused', ['label' => __('Focused', 'master-addons' )]);

		$this->add_responsive_control(
			'cards_color_focused',
			[
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-item.is--focused .timeline-item__content-wrapper,
							 {{WRAPPER}} .timeline-item.is--focused .timeline-item__content-wrapper *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'cards_background_color_focused',
			[
				'label'     => __('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-item.is--focused .timeline-item__content-wrapper'    => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .timeline-item.is--focused .timeline-item__card__arrow::after' => 'border-left-color: {{VALUE}}; border-right-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'cards_box_shadow_focused',
				'selector' => '{{WRAPPER}} .timeline-item.is--focused .timeline-item__content-wrapper',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'cards_text_shadow',
				'selector' => '{{WRAPPER}} .jltma-timeline .timeline-item__content-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cards_typography',
				'selector' => '{{WRAPPER}} .jltma-timeline .timeline-item__content-wrapper',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'condition'		=> [
					'post_skin' => 'default',
				],
			]
		);

		$this->end_controls_section();


		/*
		* Timeline Style: Arrow
		 */
		$this->start_controls_section(
			'section_arrow',
			[
				'label' => __('Arrow', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'arrow_background',
			[
				'label'  => __('Arrow Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'default' => '#f7f7f7',
				'selectors' => [
					'{{WRAPPER}} .timeline-item__card__arrow:after' => 'border-left-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/*
		* Timeline Style: Dates
		 */
		$this->start_controls_section(
			'section_dates',
			[
				'label' => __('Dates', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'dates_padding',
			[
				'label'      => __('Padding', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-timeline .timeline-item__meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dates_margin',
			[
				'label'      => __('Margin', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-timeline .timeline-item__meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'dates_text_shadow',
				'selector' => '{{WRAPPER}} .jltma-timeline .timeline-item__meta',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'dates_typography',
				'selector' => '{{WRAPPER}} .jltma-timeline .timeline-item__meta',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
			]
		);

		$this->start_controls_tabs('tabs_dates_style');

		$this->start_controls_tab('tab_dates_default', ['label' => __('Default', 'master-addons' )]);

		$this->add_responsive_control(
			'dates_color',
			[
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline .timeline-item__meta' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('tab_dates_hover', ['label' => __('Hover', 'master-addons' )]);

		$this->add_responsive_control(
			'dates_color_hover',
			[
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline .jltma-timeline__item:hover .timeline-item__meta' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('tab_dates_focused', ['label' => __('Focused', 'master-addons' )]);

		$this->add_responsive_control(
			'dates_color_focused',
			[
				'label'     => __('Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline .jltma-timeline__item.is--focused .timeline-item__meta' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		/*
		* Timeline Style: Line
		 */

		$this->start_controls_section(
			'section_line',
			[
				'label' => __('Line', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'line_background',
			[
				'label'  => __('Background Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline__line,
					{{WRAPPER}} .jltma-timeline-horz-pointer:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'progress_background',
			[
				'label'  => __('Progress Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline__line__inner' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'line_thickness',
			[
				'label'   => __('Thickness', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 4,
				],
				'range' 		=> [
					'px' 		=> [
						'min' => 1,
						'max' => 8,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline__line' => 'width: {{SIZE}}px;',
					'{{WRAPPER}} .jltma-timeline-horz-pointer:before' => 'height: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'line_location',
			[
				'label'   => __('Location', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' 		=> [
					'px' 		=> [
						'min' => 0,
						'max' => 100,
					],
				],
				'frontend_available' => true,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'line_border',
				'label'    => __('Image Border', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-timeline__line',
			]
		);

		$this->add_control(
			'line_border_radius',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-timeline__line' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		/*
             * MA Timeline: Points
             */

		$this->start_controls_section(
			'ma_el_timeline_section_points',
			[
				'label' => __('Points', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ma_el_timeline_points_content',
			[
				'label'     => __('Type', 'master-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'icons',
				'separator' => 'after',
				'options'   => [
					'default' => __('Default', 'master-addons' ),
					'icons'   => __('Icons', 'master-addons' ),
					'image'   => __('Image', 'master-addons' ),
					'numbers' => __('Numbers', 'master-addons' ),
					'letters' => __('Letters', 'master-addons' ),
				]
			]
		);

		$this->add_control(
			'ma_el_timeline_points_image',
			[
				'label'     => __('Pointer Image', 'master-addons' ),
				'dynamic'   => ['active' => true],
				'type'      => Controls_Manager::MEDIA,
				'condition' => [
					'ma_el_timeline_points_content' => "image"
				],
			]
		);


		$this->add_control(
			'ma_el_timeline_selected_global_icon',
			[
				'label'            => __('Icon', 'master-addons' ),
				'type'             => Controls_Manager::ICONS,
				'label_block'      => true,
				'fa4compatibility' => 'global_icon',
				'default'          => [
					'value'   => 'fa fa-calendar-alt',
					'library' => 'fa-solid',
				],
				'condition'			=> [
					'ma_el_timeline_points_content' => 'icons',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ma_el_timeline_points_typography',
				'selector'  => '{{WRAPPER}} .jltma-timeline .jltma-timeline-post-type-icon',
				'scheme'    => Typography::TYPOGRAPHY_3,
				'exclude'   => ['font_size'],
				'condition' => [
					'ma_el_timeline_points_content!' => 'icons',
				],
			]
		);

		//			$this->add_group_control(
		//				Group_Control_Transition::get_type(),
		//				[
		//					'name' 		=> 'ma_el_timeline_points',
		//					'selector' 	=> '{{WRAPPER}} .jltma-timeline-post-type-icon',
		//					'separator'	=> '',
		//				]
		//			);

		$this->start_controls_tabs('ma_el_timeline_tabs_points');

		$this->start_controls_tab('ma_el_timeline_points_default', ['label' => __('Default', 'master-addons' )]);

		$this->add_responsive_control(
			'ma_el_timeline_points_size',
			[
				'label'   => __('Size', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' 		=> [
					'px' 		=> [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline-post-type-icon'                              => 'width: {{SIZE}}px; height: {{SIZE}}px',
					'{{WRAPPER}} .jltma-timeline-post-mini-thumb'                             => 'width: {{SIZE}}px; height: {{SIZE}}px',
					'{{WRAPPER}} .jltma-timeline-align--left .jltma-timeline__line'           => 'margin-left: calc( {{SIZE}}px / 2 );',
					'{{WRAPPER}} .jltma-timeline-align--right .jltma-timeline__line'          => 'margin-right: calc( {{SIZE}}px / 2 );',
					'(tablet){{WRAPPER}} .jltma-timeline-align--center .jltma-timeline__line' => 'margin-left: calc( {{points_size_tablet.SIZE}}px / 2 );',
					'(mobile){{WRAPPER}} .jltma-timeline-align--center .jltma-timeline__line' => 'margin-left: calc( {{points_size_mobile.SIZE}}px / 2 );',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_timeline_icons_size',
			[
				'label'   => __('Icon Size', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' 		=> [
					'px' 		=> [
						'step' => 0.1,
						'min'  => 1,
						'max'  => 4,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline-post-type-icon' => 'font-size: {{SIZE}}em',
					'{{WRAPPER}} .jltma-timeline-post-type-icon svg' => 'font-size: {{SIZE}}em',
				],
				'condition'		=> [
					'ma_el_timeline_points_content' => 'icons'
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_timeline_content_size',
			[
				'label'   => __('Content Size', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' 		=> [
					'px' 		=> [
						'min' => 1,
						'max' => 4,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline-post-type-icon .timeline-item__point__text' => 'font-size:{{SIZE}}em;',
				],
				'condition'		=> [
					'ma_el_timeline_points_content!' => 'icons',
				]
			]
		);

		$this->add_control(
			'ma_el_timeline_points_background',
			[
				'label'  => __('Background Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline-post-type-icon'   => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-timeline-post-mini-thumb' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_timeline_icons_color',
			[
				'label'     => __('Points Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline-post-type-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-timeline-post-type-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'ma_el_timeline_points_text_shadow',
				'selector' => '{{WRAPPER}} .jltma-timeline-post-type-icon',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('ma_el_timeline_points_hover', ['label' => __('Hover', 'master-addons' )]);

		$this->add_control(
			'ma_el_timeline_points_size_hover',
			[
				'label'   => __('Scale', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' 		=> [
					'px' 		=> [
						'min'  => 0.5,
						'max'  => 2,
						'step' => 0.01
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-blog-timeline-post:hover .jltma-timeline-post-type-icon,
					{{WRAPPER}} .jltma-blog-timeline-post:hover .jltma-timeline-post-mini-thumb' => 'transform: scale({{SIZE}})',
				],
			]
		);

		$this->add_control(
			'ma_el_timeline_points_background_hover',
			[
				'label'     => __('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-blog-timeline-post:hover .jltma-timeline-post-type-icon,
					{{WRAPPER}} .jltma-blog-timeline-post:hover .jltma-timeline-post-mini-thumb' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_timeline_icons_color_hover',
			[
				'label'     => __('Points Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-timeline-post-type-icon:hover,
						{{WRAPPER}} .jltma-blog-timeline-post:hover .jltma-timeline-post-type-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-blog-timeline-post:hover .jltma-timeline-post-type-icon svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'ma_el_timeline_points_text_shadow_hover',
				'selector' => '{{WRAPPER}} .jltma-blog-timeline-post:hover .jltma-timeline-post-type-icon'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('ma_el_timeline_points_focused', ['label' => __('Focused', 'master-addons' )]);

		$this->add_control(
			'ma_el_timeline_points_size_focused',
			[
				'label'   => __('Scale', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' 		=> [
					'px' 		=> [
						'min'  => 0.5,
						'max'  => 2,
						'step' => 0.01
					],
				],
				'selectors' => [
					'{{WRAPPER}} .timeline-item.is--focused .jltma-timeline__item__icon,
					{{WRAPPER}} .timeline-item.is--focused .jltma-timeline-post-mini-thumb' => 'transform: scale({{SIZE}})',
				],
			]
		);

		$this->add_control(
			'ma_el_timeline_points_background_focused',
			[
				'label'   => __('Background Color', 'master-addons' ),
				'type'    => Controls_Manager::COLOR,
				'default' => 'red',
				'global'  => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .timeline-item.is--focused .jltma-timeline__item__icon,
					{{WRAPPER}} .timeline-item.is--focused .jltma-timeline-post-mini-thumb' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_timeline_icons_color_focused',
			[
				'label'     => __('Points Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .timeline-item.is--focused .jltma-timeline__item__icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .timeline-item.is--focused .jltma-timeline__item__icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'ma_el_timeline_points_text_shadow_focused',
				'selector' => '{{WRAPPER}} .timeline-item.is--focused .jltma-timeline__item__icon',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();



		// Global Navigation Style Controls
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
							'name'     => 'ma_el_timeline_design_type',
							'operator' => '==',
							'value'    => 'horizontal',
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
		$this->jltma_swiper_navigation_style_controls('timeline-carousel');


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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/timeline/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/timeline-element/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=0mcDMKrH1A0" target="_blank" rel="noopener">', '</a>'),
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
	}

	protected function ma_el_timeline_global_render_attributes()
	{
		$settings = $this->get_settings_for_display();

		$unique_id = implode('-', [$this->get_id(), get_the_ID()]);

		$solid_bg_class = ($settings['ma_el_timeline_design_type'] === "horizontal") ? "solid-bg-color" : "";

		$this->add_render_attribute([
			'ma_el_timeline_wrapper' => [
				'class' =>			[
					'jltma-timeline',
					'jltma-timeline--' . esc_attr($settings['ma_el_timeline_design_type']),
					'jltma-timeline-' . esc_attr($settings['ma_el_timeline_type']),
					'elementor-jltma-elmaement-' . esc_attr($unique_id),
					$solid_bg_class
				]
			],
			'ma_el_timeline_posts' => [
				'class' => [
					'jltma-blog-timeline-post',
					'jltma-timeline__item',
					'timeline-item',
				],
			],
			'item' => [
				'class' => [
					'jltma-timeline__item',
					'timeline-item',
				],
			],
			'icon-wrapper' => [
				'class' => [
					'jltma-icon',
					'jltma-timeline-post-type-icon',
					'jltma-icon-support--svg',
					'jltma-timeline__item__icon',
				],
			],
			'line' => [
				'class' => 'jltma-timeline__line',
			],
			'line-inner' => [
				'class' => 'jltma-timeline__line__inner',
			],
			'card-wrapper' => [
				'class' => 'timeline-item__card-wrapper',
			],
			'point' => [
				'class' => 'timeline-item__point',
			],
			'meta' => [
				'class' => 'timeline-item__meta',
			],
			'image' => [
				'class' => [
					'timeline-item__img',
					'jltma-post__thumbnail',
					'jltma-timeline-entry-thimbnail'
				],
			],
			'content' => [
				'class' => 'timeline-item__content',
			],
			'arrow' => [
				'class' => 'timeline-item__card__arrow',
			],
			'meta-wrapper' => [
				'class' => 'timeline-item__meta-wrapper',
			],
		]);
	}

	protected function jltma_render_line()
	{ ?>
		<div <?php echo $this->get_render_attribute_string('line'); ?>>
			<div <?php echo $this->get_render_attribute_string('line-inner'); ?>></div>
		</div>
	<?php
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$this->ma_el_timeline_global_render_attributes();

		if (get_query_var('paged')) {
			$paged = get_query_var('paged');
		} elseif (get_query_var('page')) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}


		$ma_el_timeline_type  = $settings['ma_el_timeline_type'];
		$timeline_layout_type = $settings['ma_el_timeline_design_type'];

		if (ma_el_fs()->can_use_premium_code()) {

			$settings[] = $settings['ma_el_blog_posts_per_page'];

			$offset = $settings['ma_el_timeline_post_offset'];

			$post_per_page = $settings['ma_el_blog_posts_per_page'];

			$new_offset = $offset + (($paged - 1) * $post_per_page);

			$post_args = Master_Addons_Helper::ma_el_blog_get_post_settings($settings);

			$posts = Master_Addons_Helper::ma_el_blog_get_post_data($post_args, $paged, $new_offset);
		}
	?>
		<div <?php echo $this->get_render_attribute_string('ma_el_timeline_wrapper'); ?>>

			<?php
			if ($settings['ma_el_timeline_design_type'] !== 'horizontal') {

				$this->jltma_render_line();

				if ('yes' === $settings['ma_el_timeline_reverse']) { ?>
					<span>

					</span>
				<?php
				}
			}

			if ($ma_el_timeline_type == "post") {

				$this->jltma_post_timeline();
			} elseif ($ma_el_timeline_type == "custom") {

				// Vertical Layout Design & Custom Layout
				if ($timeline_layout_type == "vertical") {

					$this->jltma_vertical_timeline();
				} elseif ($timeline_layout_type == "horizontal") {

					// If Custom and Vertical Horizontal Design
					$this->jltma_horizontal_timeline();
				} ?>

		</div>
	<?php }
		}

		protected function jltma_post_timeline()
		{
			if (get_query_var('paged')) {
				$paged = get_query_var('paged');
			} elseif (get_query_var('page')) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;
			}

			$settings = $this->get_settings_for_display();

			if (ma_el_fs()->can_use_premium_code()) {

				$settings[] = $settings['ma_el_blog_posts_per_page'];

				$offset = $settings['ma_el_timeline_post_offset'];

				$post_per_page = $settings['ma_el_blog_posts_per_page'];

				$new_offset = $offset + (($paged - 1) * $post_per_page);

				$post_args = Master_Addons_Helper::ma_el_blog_get_post_settings($settings);

				$posts = Master_Addons_Helper::ma_el_blog_get_post_data($post_args, $paged, $new_offset);
			}

			if (count($posts)) {
				global $post;
				foreach ($posts as $post) {
					setup_postdata($post);
					$this->jltma_post_query_timeline();
					wp_reset_postdata();
				}
			}
		}
		public function jltma_vertical_timeline()
		{
			$settings = $this->get_settings_for_display();

			$j = 0;
			foreach ($settings['ma_el_custom_timeline_items'] as $index => $item) {
				$j++;
				$active_class = ($j == 1) ? "active" : "";

				$card_tag      = 'div';
				$item_key      = $this->get_repeater_setting_key('item', 'ma_el_custom_timeline_items', $index);
				$card_key      = $this->get_repeater_setting_key('card', 'ma_el_custom_timeline_items', $index);
				$point_content = '';
				$wysiwyg_key   = $this->get_repeater_setting_key('content', 'ma_el_custom_timeline_items', $index);
				$meta_key      = $this->get_repeater_setting_key('date', 'ma_el_custom_timeline_items', $index);


				$this->add_render_attribute([
					$item_key => [
						'class' => [
							'elementor-repeater-item-' . esc_attr($item['_id']),
							'jltma-blog-timeline-post',
							'jltma-timeline__item',
							'timeline-item',
							$active_class
						],
					],
					$card_key => [
						'class' => 'timeline-item__card',
					],
					$wysiwyg_key => [
						'class' => 'jltma-timeline-entry-content',
					],
					$meta_key => [
						'class' => [
							'timeline-item__meta',
							'meta',
						],
					],
				]);


				if (!empty($item['ma_el_custom_timeline_link']['url'])) {
					$card_tag = 'a';

					$this->add_render_attribute($card_key, 'href', $item['ma_el_custom_timeline_link']['url']);

					if ($item['ma_el_custom_timeline_link']['is_external']) {
						$this->add_render_attribute($card_key, 'target', '_blank');
					}

					if ($item['ma_el_custom_timeline_link']['nofollow']) {
						$this->add_render_attribute($card_key, 'rel', 'nofollow');
					}
				}

				if (ma_el_fs()->can_use_premium_code()) {

					if (('yes' === $item['ma_el_custom_timeline_custom_style'] && '' !== $item['ma_el_custom_timeline_point_content_type'])) {
						$point_content_type = $item['ma_el_custom_timeline_point_content_type'];
					} else {
						$point_content_type = $item['ma_el_custom_timeline_point_content'];
					}


					switch ($point_content_type) {
						case 'numbers':

						case 'letters':
							$point_content = $this->ma_timeline_points_text($point_content_type, $index, $item);
							break;

						case 'image':
							$point_content = $this->ma_timeline_points_image($item);
							break;

						case 'icons':
							$point_content = $this->ma_timeline_points_icon($item);
							break;

						default:
							$point_content = $this->ma_timeline_points_global_points();
					}
				} else {
					$point_content = $this->ma_timeline_points_global_points();
				}
	?>
		<div <?php echo $this->get_render_attribute_string($item_key); ?>>
			<div <?php echo $this->get_render_attribute_string('point'); ?>>
				<?php echo $this->parse_text_editor($point_content); ?>
			</div>
			<div <?php echo $this->get_render_attribute_string('card-wrapper'); ?>>
				<div class="jltma-timeline-post-inner">
					<<?php echo esc_attr($card_tag); ?> <?php echo $this->get_render_attribute_string($card_key); ?>>
						<div class="timeline-item__content-wrapper">

							<?php if ($item['ma_el_custom_timeline_image']['url']) { ?>
								<div <?php echo $this->get_render_attribute_string('image'); ?>>
									<?php echo Group_Control_Image_Size::get_attachment_image_html($item, 'ma_el_custom_timeline_image'); ?>
								</div>
							<?php } ?>

							<?php $this->render_custom_card_meta($index, $item); ?>

							<div <?php echo $this->get_render_attribute_string($wysiwyg_key); ?>>
								<?php echo $this->parse_text_editor($item['ma_el_custom_timeline_content']); ?>
							</div>
							<?php $this->render_card_arrow(); ?>
						</div><!-- /.post -->
					</<?php echo esc_attr($card_tag); ?>>
				</div><!-- /.jltma-timeline-post-inner -->
			</div> <!-- card-wrapper -->
			<div <?php echo $this->get_render_attribute_string('meta-wrapper'); ?>>
				<?php $this->render_custom_card_meta($index, $item); ?>
			</div>
		</div>

	<?php } ?>

<?php }


		protected function render_image($item = false)
		{
			call_user_func([$this, 'render_' . $this->get_settings('ma_el_timeline_type') . '_thumbnail'], $item);
		}


		protected function render_custom_thumbnail($item)
		{
			if ('' === $item['ma_el_custom_timeline_image']['url'])
				return;

?>
	<div <?php echo $this->get_render_attribute_string('image'); ?>>
		<?php
			echo Group_Control_Image_Size::get_attachment_image_html($item);
		?></div>
<?php
		}

		protected function render_card_arrow()
		{ ?>
	<div <?php echo $this->get_render_attribute_string('arrow'); ?>></div>
<?php }

		protected function render_custom_card_meta($index, $item)
		{
			// $settings = $this->get_settings_for_display();

			$meta_key = $this->get_repeater_setting_key('date', 'ma_el_custom_timeline_items', $index);

			// $this->add_inline_editing_attributes($meta_key, 'basic');

			$this->add_render_attribute([
				$meta_key => [
					'class' => [
						'timeline-item__meta',
						'meta',
					],
				],
			]);

?>
	<div <?php echo $this->get_render_attribute_string($meta_key); ?>>
		<?php
			// $item_date = $this->parse_text_editor($item['ma_el_custom_timeline_date']);
			// echo date($settings['ma_el_timeline_date_format'], strtotime($item_date));
			if($item['ma_el_custom_timeline_date_type'] == 'custom' ) {
				echo $this->parse_text_editor($item['ma_el_custom_timeline_label']);
			}else{
				echo $this->parse_text_editor($item['ma_el_custom_timeline_date']);
			}
		?>
	</div><!-- meta -->
<?php }

		protected function jltma_horizontal_timeline()
		{
			$settings  = $this->get_settings_for_display();
			$unique_id = implode('-', [$this->get_id(), get_the_ID()]);

			if ($settings['ma_el_timeline_design_type'] === 'horizontal') {
				$this->add_render_attribute([
					'swiper_container' => [
						'class' => [
							'jltma-timeline-carousel-wrapper',
							'jltma-carousel',
							'jltma-swiper',
							'jltma-swiper__container',
							'jltma-timeline-slider',
							'swiper-container'
						],
						'data-jltma-template-widget-id' => $unique_id
					],

					'swiper_wrapper' => [
						'class' => [
							'jltma-timeline-carousel',
							'jltma-swiper__wrapper',
							'swiper-wrapper',
							'jltma-timeline-slider',
							'jltma-timeline-horizontal'
						],
					]

				]);


				//Global Header Function
				$this->jltma_render_swiper_header_attribute('timeline-carousel');

				$this->add_render_attribute('carousel', 'class', ['jltma-timeline-carousel-slider']);
			}
?>


	<?php if ($settings['ma_el_timeline_design_type'] === 'horizontal') { ?>
		<div <?php echo $this->get_render_attribute_string('carousel'); ?>>
		<?php } ?>
		<div <?php echo $this->get_render_attribute_string('swiper_container'); ?>>
			<div <?php echo $this->get_render_attribute_string('swiper_wrapper'); ?>>

				<?php foreach ($settings['ma_el_custom_timeline_items'] as $index => $item) {

					$card_tag      = 'div';
					$slider_item   = $this->get_repeater_setting_key('slider-item', 'ma_el_custom_timeline_items', $index);
					$item_key      = $this->get_repeater_setting_key('item', 'ma_el_custom_timeline_items', $index);
					$card_key      = $this->get_repeater_setting_key('card', 'ma_el_custom_timeline_items', $index);
					$point_content = '';
					$wysiwyg_key   = $this->get_repeater_setting_key('content', 'ma_el_custom_timeline_items', $index);
					$meta_key      = $this->get_repeater_setting_key('date', 'ma_el_custom_timeline_items', $index);

					$content_id = $this->get_id() . '_' . esc_attr($item['_id']);

					$this->add_render_attribute([
						$item_key => [
							'class' => [
								'elementor-repeater-item-' . esc_attr($content_id),
								'jltma-blog-timeline-post'
							],
						],
						$slider_item => [
							'class' => [
								'jltma-slider__item',
								'jltma-swiper__slide',
								'swiper-slide',
							],
						],
						$card_key => [
							'class' => 'timeline-item__card',
						],
						$wysiwyg_key => [
							'class' => 'jltma-timeline-entry-content',
						],
						$meta_key => [
							'class' => [
								'timeline-item__meta',
								'meta',
							],
						],
					]);

					if (!empty($item['ma_el_custom_timeline_link']['url'])) {
						$card_tag = 'a';

						$this->add_render_attribute($card_key, 'href', $item['ma_el_custom_timeline_link']['url']);

						if ($item['ma_el_custom_timeline_link']['is_external']) {
							$this->add_render_attribute($card_key, 'target', '_blank');
						}

						if ($item['ma_el_custom_timeline_link']['nofollow']) {
							$this->add_render_attribute($card_key, 'rel', 'nofollow');
						}
					}


					if (('yes' === isset($item['ma_el_custom_timeline_custom_style']) && isset($item['ma_el_timeline_points_content']) !== '')) {
						$point_content_type = $item['ma_el_timeline_points_content'];
					} else {
						$point_content_type = $settings['ma_el_timeline_points_content'];
					}



					switch ($point_content_type) {
						case 'numbers':

						case 'letters':
							$point_content = $this->ma_timeline_points_text($point_content_type, $index, $item);
							break;

						case 'image':
							$point_content = $this->ma_timeline_points_image($item);
							break;

						case 'icons':
							$point_content = $this->ma_timeline_points_icon($item);
							break;

						default:
							$point_content = '<span class="hexagon"></span>';
					}

					//                                        if($settings['ma_el_timeline_selected_global_icon']['value']){
					//	                                            $point_content = $this->ma_timeline_points_global_points();
					//                                        } else{
					//            				                    $point_content = '<span class="hexagon"></span>';
					//                                        }

				?>

					<div <?php echo $this->get_render_attribute_string($slider_item); ?>>
						<<?php echo esc_attr($card_tag); ?> <?php echo $this->get_render_attribute_string($item_key); ?>>

							<div class="jltma-timeline-post-top">

								<div class="jltma-timeline-post-date">
									<time datetime="<?php echo get_the_modified_date('c'); ?>">
										<?php echo $this->parse_text_editor($item['ma_el_custom_timeline_date']); ?>
									</time>
								</div><!-- /.jltma-timeline-post-date -->

							</div><!-- /.jltma-timeline-post-top -->

							<div class="jltma-timeline-horz-pointer">
								<?php echo $this->parse_text_editor($point_content); ?>
							</div>

							<div class="jltma-timeline-post-inner">

								<article class="post post-type">

									<?php if ($item['ma_el_custom_timeline_image']['url']) { ?>
										<div <?php echo $this->get_render_attribute_string('image'); ?>>
											<?php echo Group_Control_Image_Size::get_attachment_image_html($item, 'ma_el_custom_timeline_image'); ?>
										</div>
									<?php } ?>

									<div class="jltma-timeline-entry-content">

										<div <?php echo $this->get_render_attribute_string($wysiwyg_key); ?>>
											<?php echo $this->parse_text_editor($item['ma_el_custom_timeline_content']); ?>
										</div>

									</div><!-- /.jltma-timeline-entry-content -->
								</article><!-- /.post -->
							</div><!-- /.jltma-timeline-post-inner -->
						</<?php echo esc_attr($card_tag); ?>><!-- /.jltma-timeline-tag -->
					</div>
				<?php } ?>

			</div><!-- /.jltma-timeline-slider-inner -->
		</div>
		<!-- swiper_container -->

		<?php if ($settings['ma_el_timeline_design_type'] === 'horizontal') { ?>

			<?php $this->render_swiper_navigation(); ?>

			<?php if ('yes' === $settings['show_scrollbar']) { ?>
				<div class="swiper-scrollbar"></div>
			<?php } ?>

		</div>
	<?php } ?>

<?php }

		protected function ma_timeline_points_text($type, $index = false, $item = false)
		{

			$settings  = $this->get_settings();
			$letters   = range('A', 'Z');
			$point_key = ($item) ? $this->get_repeater_setting_key('icon', 'items', $index) : 'point-text';
			$text      = 0;

			$text = ($type === 'numbers') ? $index + 1 : $letters[$index];

			if ($item) {
				if ($item['ma_el_custom_timeline_custom_style'] === 'yes' && '' !== $item['ma_el_custom_timeline_point_content']) {
					$text = $item['ma_el_custom_timeline_point_content'];
				}
			}

			$this->add_render_attribute($point_key, 'class', [
				'jltma-timeline-post-type-icon',
				'timeline-item__point__text'
			]);

			$output = '<div ' . $this->get_render_attribute_string($point_key) . '>' . esc_html($text) . '</div>';

			return $output;
		}

		protected function ma_timeline_points_image($item = false)
		{
			$settings = $this->get_settings();

			$output = '';
			$output .= '<div class="jltma-timeline-post-mini-thumb">';

			if (isset($item['ma_el_custom_timeline_pointer_image']) && $item['ma_el_custom_timeline_pointer_image'] != "") {
				$output .= Group_Control_Image_Size::get_attachment_image_html($item, 'ma_el_custom_timeline_pointer_image');
			} elseif ($settings['ma_el_timeline_points_image'] != "") {
				$output .= Group_Control_Image_Size::get_attachment_image_html($settings, 'ma_el_timeline_points_image');
			}


			$output .= '</div>';

			return $output;
		}


		protected function ma_timeline_points_global_points()
		{
			$settings = $this->get_settings();

			$global_point_content_type = $settings['ma_el_timeline_points_content'];

			switch ($global_point_content_type) {

				case 'numbers':

				case 'letters':
					$point_content = $this->ma_timeline_points_text($global_point_content_type, true, false);
					break;

				case 'image':
					$point_content = $this->ma_timeline_points_image($item = false);
					break;

				case 'icons':
					$point_content = $this->ma_timeline_points_icon($item = false);
					break;

				default:
					$point_content = $this->ma_timeline_points_icon($item = false);
			}

			return $point_content;
		}


		protected function ma_timeline_points_icon($item = false)
		{
			$settings = $this->get_settings();


			$global_icon_migrated = isset($item['__fa4_migrated']['ma_el_timeline_selected_global_icon']);
			$global_icon_is_new   = empty($item['global_icon']) && Icons_Manager::is_migration_allowed();
			$has_global_icon      = !empty($settings['global_icon']) || !empty($settings['ma_el_timeline_selected_global_icon']['value']);

			if ($item) {
				$has_item_icon      = !empty($item['selected_point_icon']) || !empty($item['ma_el_custom_timeline_selected_icon']['value']);
				$item_icon_migrated = isset($item['__fa4_migrated']['ma_el_custom_timeline_selected_icon']);
				$item_icon_is_new   = empty($item['selected_point_icon']) && Icons_Manager::is_migration_allowed();
			}

			$output = '<div ' . $this->get_render_attribute_string('icon-wrapper') . '>';

			$icon_markup = '<i class="%s "></i>';

			if ($item && '' !== isset($item['selected_point_icon']) && $has_item_icon) {
				if ($item_icon_is_new || $item_icon_migrated) {
					$output .= $this->get_library_point_icon($item['ma_el_custom_timeline_selected_icon']);
				} else {
					$output .= sprintf($icon_markup, $item['selected_point_icon']);
				}
			} else if ($has_global_icon) {
				if ($global_icon_is_new || $global_icon_migrated) {
					$output .= $this->get_library_point_icon($settings['ma_el_timeline_selected_global_icon']);
				} else {
					$output .= sprintf($icon_markup, $settings['global_icon']);
				}
			}

			$output .= '</div>';

			return $output;
		}


		protected function get_library_point_icon($setting)
		{
			ob_start();
			Icons_Manager::render_icon($setting);
			return ob_get_clean();
		}



		protected function jltma_post_query_timeline()
		{
			$settings       = $this->get_settings();
			$title_html_tag = $settings['title_html_tag'];
			$card_tag       = 'div';
			$point_content  = '';

			if (ma_el_fs()->can_use_premium_code()) {

				if ('' !== $settings['ma_el_timeline_points_content']) {
					$point_content_type = $settings['ma_el_timeline_points_content'];
				} else {
					$point_content_type = $settings['ma_el_custom_timeline_point_content'];
				}


				switch ($point_content_type) {
					case 'numbers':

					case 'letters':
						$point_content = $this->ma_timeline_points_text($point_content_type, $index, false);
						break;

					case 'image':
						$point_content = $this->ma_timeline_points_image(false);
						break;

					case 'icons':
						$point_content = $this->ma_timeline_points_icon(false);
						break;

					default:
						$point_content = $this->ma_timeline_points_global_points();
				}
			}
?>

	<div <?php echo $this->get_render_attribute_string('ma_el_timeline_posts'); ?>>
		<div <?php echo $this->get_render_attribute_string('point'); ?>><?php echo wp_kses_post($point_content); ?></div>
		<div <?php echo $this->get_render_attribute_string('card-wrapper'); ?>>
			<div class="jltma-timeline-post-inner">
				<?php
				if ('yes' === $settings['ma_el_timeline_post_card_links']) {
					$card_tag = 'a ';
				}
				?>
				<<?php echo esc_attr($card_tag);

					if ('yes' === $settings['ma_el_timeline_post_card_links']) {
						echo 'class="timeline-item__card ' . implode(' ', get_post_class()) . '" ';
						echo "href=" . get_permalink(get_the_ID());
					}
					?>>
					<div class="timeline-item__content-wrapper">

						<?php if (has_post_thumbnail() || (isset($settings['ma_el_timeline_post_thumbnail']) && $settings['ma_el_timeline_post_thumbnail'])) { ?>
							<div <?php echo $this->get_render_attribute_string('image'); ?>>
								<?php echo $this->render_posts_thumbnail(); ?>
							</div>
						<?php } ?>

						<div class="timeline-item__meta meta">
							<?php $this->render_date(true, get_the_ID()); ?>
						</div><!-- meta -->

						<div class="jltma-timeline-entry-content">
							<?php if ($settings['ma_el_timeline_post_title'] == "yes") { ?>
								<<?php echo tag_escape($title_html_tag); ?> class="jltma-timeline-entry-title">
									<?php if ($settings['ma_el_timeline_post_title_link'] == "yes") { ?><a href="<?php the_permalink(); ?>"><?php } ?>
										<?php the_title(); ?>
										<?php if ($settings['ma_el_timeline_post_title_link'] == "yes") { ?></a><?php } ?>
								</<?php echo tag_escape($title_html_tag); ?>>
							<?php } ?>
							<?php $this->ma_el_timeline_content(); ?>
						</div>

						<?php $this->render_card_arrow(); ?>

					</div><!-- /.post -->
				</<?php echo esc_attr($card_tag); ?>>
			</div><!-- /.jltma-timeline-post-inner -->
		</div> <!-- card-wrapper -->
		<div <?php echo $this->get_render_attribute_string('meta-wrapper'); ?>>
			<?php $this->render_date(true, get_the_ID()); ?>
		</div>
	</div>
<?php
		}

		protected function render_posts_thumbnail()
		{
			global $post;

			$settings = $this->get_settings_for_display();

			if (!has_post_thumbnail() || '' === $settings['ma_el_timeline_post_thumbnail'])
				return;

			$settings['ma_el_timeline_post_thumbnail_size'] = [
				'id' => get_post_thumbnail_id(),
			];

?>
	<div <?php echo $this->get_render_attribute_string('image'); ?>>

		<?php if ('' === $settings['ma_el_timeline_post_card_links']) { ?>
			<a href="<?php echo the_permalink(); ?>">

			<?php }

			echo Group_Control_Image_Size::get_attachment_image_html($settings, 'ma_el_timeline_post_thumbnail_size');

			if ('' === $settings['ma_el_timeline_post_card_links']) { ?>

			</a>

		<?php } ?>

	</div>
<?php
		}

		protected function ma_el_timeline_content()
		{

			$settings = $this->get_settings();

			$excerpt_type = $settings['ma_el_timeline_excerpt_type'];
			$excerpt_text = $settings['ma_el_timeline_excerpt_text'];
			//			$excerpt_src  = $settings['ma_el_post_grid_excerpt_content'];
			$excerpt_length = $settings['ma_el_timeline_excerpt_length'] ? $settings['ma_el_timeline_excerpt_length'] : 25;
			echo Master_Addons_Helper::ma_el_get_excerpt_by_id(get_the_ID(), $excerpt_length, $excerpt_type, $this->parse_text_editor($excerpt_text), true, '', '', '');
		}


		public function get_date_formatted($custom, $custom_format, $date_format, $time_format, $post_id = null)
		{
			if ($custom) {
				$format = $custom_format;
			} else {
				$date_format = $date_format;
				$time_format = $time_format;
				$format      = '';

				if ('default' === $date_format) {
					$date_format = get_option('date_format');
				}

				if ('default' === $time_format) {
					$time_format = get_option('time_format');
				}

				if ($date_format) {
					$format   = $date_format;
					$has_date = true;
				} else {
					$has_date = false;
				}

				if ($time_format) {
					if ($has_date) {
						$format .= ' ';
					}
					$format .= $time_format;
				}
			}

			$value = get_the_date($format, $post_id);

			return wp_kses_post($value);
		}

		protected function get_settings_for_loop_display($post_id = false)
		{
			$loop_post_id = [];
			if ($post_id) {
				if (array_key_exists($post_id, $loop_post_id)) {
					return $loop_post_id[$post_id];
				}
			}
			return $loop_post_id;
		}

		protected function render_date($echo = true, $post_id = null)
		{

			$settings      = $this->get_settings_for_display();
			$loop_settings = $this->get_settings_for_loop_display($post_id);

			$custom = ('custom' === $settings['ma_el_timeline_date_format']) ? true : false;
			$date   = $this->get_date_formatted($custom, esc_attr($settings['ma_el_timeline_date_custom_format']), esc_attr($settings['ma_el_timeline_date_format']), esc_attr($settings['ma_el_timeline_time_format']), $post_id);

			if (!$echo) {
				return wp_kses_post($date);
			}

			echo wp_kses_post($date);
		}
	}
