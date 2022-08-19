<?php

namespace MasterAddons\Addons;

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Core\Schemes\Color;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Css_Filter;

// Master Addons Classes
use MasterAddons\Inc\Controls\MA_Group_Control_Transition;
use MasterAddons\Inc\Traits\JLTMA_Swiper_Controls;
use MasterAddons\Inc\Helper\Master_Addons_Helper;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * MA Blog Post Grid Widget
 */
class JLTMA_Blog extends Widget_Base
{
	use JLTMA_Swiper_Controls;

	public function get_name()
	{
		return 'ma-blog-post';
	}

	public function get_title()
	{
		return esc_html__('Blog Posts', 'master-addons' );
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-posts-grid';
	}

	public function get_keywords()
	{
		return ['post', 'layout', 'gallery', 'blog', 'images', 'videos', 'portfolio', 'visual', 'masonry'];
	}

	public function get_script_depends()
	{
		return [
			'isotope',
			'swiper',
			'masonry',
			'imagesloaded',
			'master-addons-scripts'
		];
	}


	public function get_help_url()
	{
		return 'https://master-addons.com/demos/blog-element/';
	}


	protected function register_controls()
	{

		/*
		* Display Options
		*/

		$this->start_controls_section(
			'ma_el_post_grid_section_filters',
			[
				'label' => __('Display Options', 'master-addons' ),
			]
		);


		$this->add_control(
			'ma_el_blog_skin',
			[
				'label'         => __('Blog Layout', 'master-addons' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'classic'       => __('Classic', 'master-addons' ),
					'cards'         => __('Cards', 'master-addons' )
				],
				'default'       => 'classic',
				'label_block'   => true
			]
		);




		$this->add_control(
			'ma_el_post_grid_layout',
			[
				'label'         => __('Blog Type', 'master-addons' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'grid'          => __('Grid Layout', 'master-addons' ),
					'list'          => __('List Layout', 'master-addons' ),
					'masonry'       => __('Masonry Layout', 'master-addons' ),
				],
				'frontend_available' 	=> true,
				'default'       => 'grid',
				'label_block'   => true
			]
		);

		$this->add_control(
			'ma_el_blog_cards_skin',
			[
				'label'         => __('Cards Layout', 'master-addons' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'default'                => __('Default', 'master-addons' ),
					'absolute_content'       => __('Content Overlap', 'master-addons' ),
					'absolute_content_two'   => __('Top Left Meta', 'master-addons' ),
					'cards_right'            => __('Right Align Cards', 'master-addons' ),
					'cards_center'           => __('Center Align Cards', 'master-addons' ),
					'gradient_bg'            => __('Center Align Gradient BG', 'master-addons' ),
					'full_banner'            => __('Banner Card', 'master-addons' )
				],
				'default'       => 'default',
				'label_block'   => true,
				'condition'     => [
					'ma_el_blog_skin'           =>  'cards',
					'ma_el_post_grid_layout'    =>  'grid'
				]
			]
		);

		$this->add_control(
			'ma_el_post_list_layout',
			[
				'label'         => __('List Layout Type', 'master-addons' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'classic'               => __('List Classic', 'master-addons' ),
					'meta_bg'               => __('List Meta Background', 'master-addons' ),
					'button_right'          => __('List Button Right', 'master-addons' ),
					'content_overlap'       => __('List Content Overlap', 'master-addons' ),
					'thumbnail_hover'       => __('List Thumbnail Hover', 'master-addons' ),
					'thumbnail_hover_nav'   => __('List Blur Content', 'master-addons' ),
					'thumbnail_bg'          => __('List Thumbnail Background', 'master-addons' ),

				],
				'default'       => 'classic',
				'label_block'   => true,
				'condition' => [
					'ma_el_post_grid_layout' => 'list',
				],
			]
		);

		$this->add_control(
			'ma_el_blog_order',
			[
				'label'         => __('Post Order', 'master-addons' ),
				'type'          => Controls_Manager::SELECT,
				'label_block'   => true,
				'options'       => [
					'asc'           => __('Ascending', 'master-addons' ),
					'desc'          => __('Descending', 'master-addons' )
				],
				'default'       => 'desc'
			]
		);

		$this->add_control(
			'ma_el_blog_order_by',
			[
				'label'         => __('Order By', 'master-addons' ),
				'type'          => Controls_Manager::SELECT,
				'label_block'   => true,
				'options'       => [
					'none'  => __('None', 'master-addons' ),
					'ID'    => __('ID', 'master-addons' ),
					'author' => __('Author', 'master-addons' ),
					'title' => __('Title', 'master-addons' ),
					'name'  => __('Name', 'master-addons' ),
					'date'  => __('Date', 'master-addons' ),
					'modified' => __('Last Modified', 'master-addons' ),
					'rand'  => __('Random', 'master-addons' ),
					'comment_count' => __('Number of Comments', 'master-addons' ),
				],
				'default'       => 'date'
			]
		);


		$this->add_responsive_control(
			'ma_el_blog_cols',
			[
				'label'         => __('Number of Columns', 'master-addons' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'100%'          => __('1 Column', 'master-addons' ),
					'50%'           => __('2 Columns', 'master-addons' ),
					'33.33%'        => __('3 Columns', 'master-addons' ),
					'25%'           => __('4 Columns', 'master-addons' )
				],
				'default'       => '25%',
				'render_type'   => 'template',
				'label_block'   => true,
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-post-outer-container'  => 'width: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'ma_el_blog_post_meta_separator',
			[
				'label'         => __('Post Meta Separator', 'master-addons' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => '//',
				'selectors'     => [
					"{{WRAPPER}} .jltma-post-entry-meta span:before"  => "content:'{{VALUE}}';"
				],
			]
		);


		$this->add_control(
			'title_html_tag',
			[
				'label'   => __('Title HTML Tag', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => Master_Addons_Helper::jltma_title_tags(),
				'default' => 'h2',
			]
		);

		$this->add_control(
			'ma_el_post_grid_type',
			[
				'label'         => __('Post Type', 'master-addons' ),
				'type'          => Controls_Manager::SELECT2,
				'options'       => Master_Addons_Helper::ma_el_get_post_types(),
				'default'       => 'post',

			]
		);

		$this->add_control(
			'ma_el_post_grid_taxonomy_type',
			[
				'label' => __('Select Taxonomy', 'master-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => '',
				'condition' => [
					'post_type!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_post_grid_posts_columns_spacing',
			[
				'label'         => __('Rows Spacing', 'master-addons' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', "em"],
				'range'         => [
					'px'    => [
						'min'   => 1,
						'max'   => 200,
					],
				],
				'condition'     => [
					'ma_el_post_grid_layout' =>  ['grid', 'list']
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-post-outer-container' => 'margin-bottom: {{SIZE}}{{UNIT}}'
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_post_grid_posts_spacing',
			[
				'label'         => __('Columns Spacing', 'master-addons' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', "em"],
				'range'         => [
					'px'    => [
						'min'   => 1,
						'max'   => 200,
					],
				],
				'render_type'   => 'template',
				'condition'     => [
					'ma_el_post_grid_layout' =>  ['grid', 'list']
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-post-outer-container' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}'
				]
			]
		);


		$this->add_responsive_control(
			'ma_el_post_grid_flip_text_align',
			[
				'label'         => __('Content Alignment', 'master-addons' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'      => [
						'title' => __('Left', 'master-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center'    => [
						'title' => __('Center', 'master-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right'     => [
						'title' => __('Right', 'master-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default'       => 'left',
				'selectors'     => [
					'{{WRAPPER}} .jltma-post-content ' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'ma_el_blog_total_posts_number',
			[
				'label'         => __('Total Number of Posts', 'master-addons' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => wp_count_posts()->publish
			]
		);

		$this->add_control(
			'ma_el_blog_posts_per_page',
			[
				'label'         => __('Posts Per Page', 'master-addons' ),
				'type'          => Controls_Manager::NUMBER,
				'min'			=> 1,
				'default'       => '4'
			]
		);


		$this->add_control(
			'ma_el_blog_pagination',
			[
				'label'         => __('Pagination', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Pagination is the process of dividing the posts into discrete pages', 'master-addons' ),
			]
		);


		$this->add_control(
			'ma_el_blog_next_text',
			[
				'label'			=> __('Next Page Text', 'master-addons' ),
				'type'			=> Controls_Manager::TEXT,
				'default'       => __('Next Post', 'master-addons' ),
				'condition'     => [
					'ma_el_blog_pagination'      => 'yes',
				]
			]
		);


		$this->add_control(
			'ma_el_blog_prev_text',
			[
				'label'			=> __('Previous Page Text', 'master-addons' ),
				'type'			=> Controls_Manager::TEXT,
				'default'       => __('Previous Post', 'master-addons' ),
				'condition'     => [
					'ma_el_blog_pagination'      => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_blog_pagination_alignment',
			[
				'label'         => __('Pagination Alignment', 'master-addons' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'      => [
						'title' => __('Left', 'master-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center'    => [
						'title' => __('Center', 'master-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right'     => [
						'title' => __('Right', 'master-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default'       => 'center',
				'condition'     => [
					'ma_el_blog_pagination'      => 'yes',
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-pagination' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_blog_carousel',
			[
				'label'         => __('Enable Carousel?', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER
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
		$this->jltma_swiper_settings_controls();

		$this->end_controls_section();


		/*
		    * Thumbnail Settings
		    */
		$this->start_controls_section(
			'ma_el_section_post_grid_thumbnail',
			[
				'label' => __('Thumbnail Settings', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_post_grid_thumbnail',
			[
				'label'         => __('Show Thumbnail?', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Show or Hide Thumbnail', 'master-addons' ),
				'default'       => 'yes',
			]
		);

		// Select Thumbnail Image Size
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full'
			]
		);

		$this->add_responsive_control(
			'ma_el_post_grid_thumbnail_fit',
			[
				'label'         => __('Thumbnail Fit', 'master-addons' ),
				'description'   => __('You need to set Height for work Thumbnail Fit ', 'master-addons' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'landscape'     => __('Landscape', 'master-addons' ),
					'square'        => __('Square', 'master-addons' ),
					'cover'         => __('Cover', 'master-addons' ),
					'fill'          => __('Fill', 'master-addons' ),
					'contain'       => __('Contain', 'master-addons' ),
				],
				'default'       => 'cover',
				'selectors'     => [
					'{{WRAPPER}} .jltma-post-thumbnail img' => 'object-fit: {{VALUE}}'
				],
				'condition'     => [
					'ma_el_post_grid_thumbnail' =>  'yes'
				]
			]
		);

		$this->add_control(
			'ma_el_blog_thumb_height',
			[
				'label'         => __('Custom Height?', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Show or Hide Thumbnail', 'master-addons' ),
				'default'       => 'no',
			]
		);

		$this->add_responsive_control(
			'ma_el_post_grid_thumb_min_height',
			[
				'label'         => __('Thumbnail Min Height', 'master-addons' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', "em"],
				'range'         => [
					'px'    => [
						'min'   => 1,
						'max'   => 300,
					],
				],
				'condition'     => [
					'ma_el_post_grid_thumbnail' =>  'yes',
					'ma_el_blog_thumb_height' =>  'yes'
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-post-thumbnail img' => 'min-height: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_post_grid_thumb_max_height',
			[
				'label'         => __('Thumbnail Max Height', 'master-addons' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', "em"],
				'range'         => [
					'px'    => [
						'min'   => 1,
						'max'   => 1000,
					],
				],
				'condition'     => [
					'ma_el_post_grid_thumbnail' =>  'yes',
					'ma_el_blog_thumb_height' =>  'yes'
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-post-thumbnail img' => 'max-height: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'ma_el_blog_thumbnail_position',
			[
				'label'         => __('Thumbnail Position', 'master-addons' ),
				'type'          => Controls_Manager::SELECT,
				'description'   => __('Thumbnail Image Position', 'master-addons' ),
				'options'       => [
					'default'   		=> __('Default', 'master-addons' ),
					'left'      		=> __('Left', 'master-addons' ),
					'thumb_top'     	=> __('Top Thumb, Bottom Title', 'master-addons' ),
					'thumb_bottom'     	=> __('Bottom Thumb, Title Top', 'master-addons' ),
				],
				'default'       => 'default',
				'label_block'   => true,
				'condition'     => [
					'ma_el_post_grid_layout' =>  'grid',
					'ma_el_post_grid_thumbnail' =>  'yes'
				]
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __('Hover Animation', 'master-addons' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
				'selectors'     => [
					'{{WRAPPER}} .jltma-post-thumbnail'
				]
			]
		);


		$this->add_control(
			'ma_el_blog_hover_color_effect',
			[
				'label'         => __('Color Effect', 'master-addons' ),
				'type'          => Controls_Manager::SELECT,
				'description'   => __('Choose an overlay color effect', 'master-addons' ),
				'options'       => [
					'none'                   => __('No Effect', 'master-addons' ),
					'zoom_in_one'            => __('Zoom In #1', 'master-addons' ),
					'zoom_in_two'            => __('Zoom In #2', 'master-addons' ),
					'zoom_out_one'           => __('Zoom Out #1', 'master-addons' ),
					'zoom_out_two'           => __('Zoom Out #2', 'master-addons' ),
					'rotate_zoomout'         => __('Rotate + Zoom Out', 'master-addons' ),
					'slide'                  => __('Slide', 'master-addons' ),
					'grayscale'              => __('Gray Scale', 'master-addons' ),
					'blur'                   => __('Blur', 'master-addons' ),
					'sepia'                  => __('Sepia', 'master-addons' ),
					'blur_sepia'             => __('Blur + Sepia', 'master-addons' ),
					'blur_grayscale'         => __('Blur + Gray Scale', 'master-addons' ),
					'opacity_one'            => __('Opacity #1', 'master-addons' ),
					'opacity_two'            => __('Opacity #2', 'master-addons' ),
					'flushing'               => __('Flushing', 'master-addons' ),
					'shine'                  => __('Shine', 'master-addons' ),
					'circle'                 => __('Circle', 'master-addons' ),

				],
				'default'       => 'none',
				'label_block'   => true
			]
		);

		$this->add_control(
			'ma_el_blog_image_shapes',
			[
				'label'         => __('Thumbnail Shapes', 'master-addons' ),
				'type'          => Controls_Manager::SELECT,
				'description'   => __('Choose an Shapes for Thumbnails', 'master-addons' ),
				'options'       => [
					'none'              => __('None', 'master-addons' ),
					'framed'            => __('Framed', 'master-addons' ),
					'diagonal'          => __('Diagonal', 'master-addons' ),
					'bordered'          => __('Bordered', 'master-addons' ),
					'gradient-border'   => __('Gradient Bordered', 'master-addons' ),
					'squares'           => __('Squares', 'master-addons' )
				],
				'default'       => 'none',
				'label_block'   => true
			]
		);


		$this->end_controls_section();



		$this->start_controls_section(
			'ma_el_post_grid_posts_options',
			[
				'label'         => __('Posts Settings', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_blog_post_meta_icon',
			[
				'label'         => __('Post Meta Icon', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'return_value'  => 'yes'
			]
		);

		$this->add_control(
			'ma_el_blog_post_format_icon',
			[
				'label'         => __('Post Format Icon', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'No',
				'return_value'  => 'yes'
			]
		);

		$this->add_control(
			'ma_el_post_grid_ignore_sticky',
			[
				'label' => esc_html__('Ignore Sticky?', 'master-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'ma_el_blog_show_content',
			[
				'label'         => __('Show Content?', 'master-addons' ),
				'description'   => __('Show/Hide Contents', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'ma_el_post_grid_excerpt',
			[
				'label'         => __('Show Excerpt ?', 'master-addons' ),
				'description'   => __('Default Except Content Length is 55', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'condition'     => [
					'ma_el_blog_show_content'  => 'yes',
				]
			]
		);


		$this->add_control(
			'ma_el_post_grid_excerpt_content',
			[
				'label'         => __('Excerpt from Content?', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Post content will be pulled from post content box', 'master-addons' ),
				'default'       => 'true',
				'return_value'  => 'true',
				'condition'     => [
					'ma_el_post_grid_excerpt'  => 'yes',
				]
			]
		);


		$this->add_control(
			'ma_el_blog_excerpt_length',
			[
				'label'         => __('Excerpt Length', 'master-addons' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => 55,
				'condition'     => [
					'ma_el_post_grid_excerpt'  => 'yes',
				]
			]
		);


		$this->add_control(
			'ma_el_post_grid_excerpt_type',
			[
				'label'         => __('Excerpt Type', 'master-addons' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'three_dots'        => __('Three Dots', 'master-addons' ),
					'read_more_link'    => __('Read More Link', 'master-addons' ),
				],
				'default'       => 'read_more_link',
				'label_block'   => true,
				'condition'     => [
					'ma_el_post_grid_excerpt'  			=> 'yes'
				]
			]
		);

		$this->add_control(
			'ma_el_post_grid_excerpt_text',
			[
				'label'			=> __('Read More Text', 'master-addons' ),
				'type'			=> Controls_Manager::TEXT,
				'default'       => __('Read More', 'master-addons' ),
				'condition'     => [
					'ma_el_post_grid_excerpt'      		=> 'yes',
					'ma_el_post_grid_show_read_more'    => 'yes',
					'ma_el_post_grid_excerpt_type' 		=> 'read_more_link'
				]
			]
		);

		$this->add_control(
			'ma_el_post_grid_post_title',
			[
				'label'         => __('Display Post Title?', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'ma_el_blog_author_avatar',
			[
				'label'         => __('Display Author Avatar?', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'no',
				'return_value'  => 'yes'
			]
		);


		$this->add_control(
			'ma_el_post_grid_post_author_meta',
			[
				'label'         => __('Display Post Author?', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'ma_el_post_grid_post_date_meta',
			[
				'label'         => __('Display Post Date?', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'ma_el_post_grid_categories_meta',
			[
				'label'         => __('Display Categories?', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'no',
			]
		);

		$this->add_control(
			'ma_el_post_grid_tags_meta',
			[
				'label'         => __('Display Tags?', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'no',
			]
		);

		$this->add_control(
			'ma_el_post_grid_comments_meta',
			[
				'label'         => __('Display Comments Number?', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'ma_el_post_grid_show_read_more',
			[
				'label'         => __('Show Read More?', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);



		$this->end_controls_section();


		/*
			 * Advanced Blog Settings
			 */
		$this->start_controls_section(
			'ma_el_blog_advanced_settings',
			[
				'label'         => __('Advanced Settings', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_blog_post_offset',
			[
				'label'         => __('Offset Post Count', 'master-addons' ),
				'description'   => __('The index of post to start with', 'master-addons' ),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '0',
				'min' 			=> '0',
			]
		);

		$this->add_control(
			'ma_el_blog_cat_tabs',
			[
				'label'         => __('Category Filter Tabs', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'condition'     => [
					'ma_el_blog_carousel!'  => 'yes'
				]
			]
		);

		$this->add_control(
			'ma_el_blog_cat_tabs_all_text',
			[
				'label'             => __('All Text', 'master-addons' ),
				'type'              => Controls_Manager::TEXT,
				'placeholder'       => __('All', 'master-addons' ),
				'default'           => __('All', 'master-addons' ),

			]
		);

		$this->add_control(
			'ma_el_blog_categories',
			[
				'label'         => __('Filter By Category', 'master-addons' ),
				'type'          => Controls_Manager::SELECT2,
				'description'   => __('Get posts for specific category(s)', 'master-addons' ),
				'label_block'   => true,
				'multiple'      => true,
				'options'       => Master_Addons_Helper::ma_el_blog_post_type_categories(),
			]
		);

		$this->add_responsive_control(
			'ma_el_blog_filter_align',
			[
				'label'         => __('Alignment', 'master-addons' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'flex-start'    => [
						'title' => __('Left', 'master-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'        => [
						'title' => __('Center', 'master-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'      => [
						'title' => __('Right', 'master-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'       => 'center',
				'condition'     => [
					'ma_el_blog_cat_tabs'     => 'yes',
					'ma_el_blog_carousel!'    => 'yes'
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-filter' => 'justify-content: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'ma_el_blog_tags',
			[
				'label'         => __('Filter By Tag', 'master-addons' ),
				'type'          => Controls_Manager::SELECT2,
				'description'   => __('Get posts for specific tag(s)', 'master-addons' ),
				'label_block'   => true,
				'multiple'      => true,
				'options'       => Master_Addons_Helper::ma_el_blog_post_type_tags(),
			]
		);


		$this->add_control(
			'ma_el_blog_users',
			[
				'label'         => __('Filter By Author', 'master-addons' ),
				'type'          => Controls_Manager::SELECT2,
				'description'   => __('Get posts for specific author(s)', 'master-addons' ),
				'label_block'   => true,
				'multiple'      => true,
				'options'       => Master_Addons_Helper::ma_el_blog_post_type_users(),
			]
		);

		$this->add_control(
			'ma_el_blog_posts_exclude',
			[
				'label'         => __('Posts to Exclude', 'master-addons' ),
				'type'          => Controls_Manager::SELECT2,
				'description'   => __('Add post(s) to exclude', 'master-addons' ),
				'label_block'   => true,
				'multiple'      => true,
				'options'       => Master_Addons_Helper::ma_el_blog_posts_list(),
			]
		);

		$this->add_control(
			'ma_el_blog_new_tab',
			[
				'label'         => __('Links in New Tab', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Enable links to be opened in a new tab', 'master-addons' ),
				'default'       => 'no',
			]
		);

		$this->end_controls_section();




		/*
			 * Style Settings
			 */

		$this->start_controls_section(
			'ma_el_blog_thumbnail_style_section',
			[
				'label'         => __('Thumbnail Image', 'master-addons' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'ma_el_post_grid_thumbnail'  => 'yes',
				],

			]
		);

		$this->add_control(
			'ma_el_blog_thumb_border_radius',
			[
				'label'         => __('Border Radius', 'master-addons' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-post-thumbnail img' => 'border-radius: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'ma_el_blog_overlay_color',
			[
				'label'         => __('Overlay Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .jltma-post-thumbnail,
                        {{WRAPPER}} .jltma-post-thumbnail img:hover' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'ma_el_blog_border_effect_color',
			[
				'label'         => __('Border Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_2,
				],
				'condition'     => [
					'ma_el_blog_image_shapes'  => 'bordered',
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-img-shape-bordered' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .jltma-post-thumbnail img',
			]
		);

		$this->end_controls_section();


		/*
			 * Title Styles
			 */

		$this->start_controls_section(
			'ma_el_blog_title_style_section',
			[
				'label'         => __('Title', 'master-addons' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ma_el_blog_title_color',
			[
				'label'         => __('Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_2,
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-entry-title a'  => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'ma_el_blog_title_typo',
				'selector'      => '{{WRAPPER}} .jltma-entry-title',
			]
		);

		$this->add_control(
			'ma_el_blog_title_hover_color',
			[
				'label'         => __('Hover Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-entry-title:hover a'  => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_blog_title_padding',
			[
				'label'         => __('Title Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-entry-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);


		$this->add_responsive_control(
			'ma_el_blog_title_margin',
			[
				'label'         => __('Title Margin', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);


		$this->end_controls_section();


		/*
			 * Meta Styles
			 */
		$this->start_controls_section(
			'ma_el_blog_meta_style_section',
			[
				'label'         => __('Meta', 'master-addons' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ma_el_blog_meta_color',
			[
				'label'         => __('Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_2,
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-post-entry-meta span, {{WRAPPER}} .jltma-post-entry-meta a, {{WRAPPER}} .jltma-blog-post-tags-container, {{WRAPPER}} .jltma-blog-post-tags-container a, {{WRAPPER}} .jltma-blog-post-tags a'  => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'ma_el_blog_meta_typo',
				'selector'      => '{{WRAPPER}} .jltma-post-entry-meta, {{WRAPPER}} .jltma-blog-post-tags-container',
			]
		);

		$this->add_control(
			'ma_el_blog_meta_hover_color',
			[
				'label'         => __('Hover Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-post-entry-meta a:hover, {{WRAPPER}} .jltma-blog-post-tags-container a:hover'  => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_section();


		/*
			 * Content Styles
			 */
		$this->start_controls_section(
			'ma_el_blog_content_style_section',
			[
				'label'         => __('Content', 'master-addons' ),
				'tab'           => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ma_el_blog_post_content_color',
			[
				'label'         => __('Text Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_3,
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-post-content, {{WRAPPER}} .jltma-post-content p'  => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'ma_el_blog_post_content_bg_color',
			[
				'label'         => __('Content Background Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .jltma-post-content'  => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'ma_el_blog_post_content_typo',
				'selector'      => '{{WRAPPER}} .jltma-post-content .jltma-blog-post-content-wrap, {{WRAPPER}} .jltma-post-content p'
			]
		);

		$this->add_control(
			'ma_el_blog_post_content_box_color',
			[
				'label'         => __('Box Background Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-post'  => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'ma_el_blog_box_shadow',
				'selector'      => '{{WRAPPER}} .jltma-blog-post',
			]
		);

		$this->add_responsive_control(
			'ma_el_blog_box_padding',
			[
				'label'         => __('Content Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-post-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_blog_content_margin',
			[
				'label'         => __('Content Margin', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-post-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);


		$this->add_responsive_control(
			'ma_el_blog_content_box_padding',
			[
				'label'         => __('Article Box Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-wrapper .jltma-post-outer-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);



		$this->end_controls_section();




		/*
			 * Read More Settings
			 */
		$this->start_controls_section(
			'ma_el_excerpt_read_more_style_section',
			[
				'label'         => __('Read More', 'master-addons' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'ma_el_post_grid_excerpt'      			=> 'yes',
					'ma_el_post_grid_show_read_more'      	=> 'yes',
					'ma_el_post_grid_excerpt_type' 			=> 'read_more_link'
				]
			]
		);

		$this->add_control(
			'ma_el_excerpt_read_more_color',
			[
				'label'         => __('Text Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_3,
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-post-content-wrap .jltma-post-btn'  => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'ma_el_excerpt_read_more_hover_color',
			[
				'label'         => __('Hover Text Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_3,
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-post-content-wrap .jltma-post-btn:hover'  => 'color: {{VALUE}};',
				]
			]
		);


		// $this->add_control(
		// 	'ma_el_blog_read_more_icon',
		// 	[
		// 		'label'         	=> esc_html__( 'Icon', 'master-addons' ),
		// 		'description' 		=> esc_html__('Please choose an icon from the list.', 'master-addons' ),
		// 		'type'          	=> Controls_Manager::ICONS,
		// 		'fa4compatibility' 	=> 'icon',
		// 		'default'       	=> [
		// 			'value'     => 'fas fa-chevron-right',
		// 			'library'   => 'solid',
		// 		],
		// 		'render_type'      => 'template',
		// 		'condition' => [
		// 			'ma_el_post_grid_excerpt_type' => 'read_more_link'
		// 		],
		// 	]
		// );


		// $this->add_responsive_control(
		// 	'ma_el_blog_read_more_icon_alignment',
		// 	[
		// 		'label' => esc_html__( 'Icon Alignment', 'master-addons' ),
		// 		'type' => Controls_Manager::CHOOSE,
		// 		'label_block' => false,
		// 		'options' => [
		// 			'left' => [
		// 				'title' => esc_html__( 'Left', 'master-addons' ),
		// 				'icon' => 'fa fa-chevron-left',
		// 			],
		// 			'right' => [
		// 				'title' => esc_html__( 'Right', 'master-addons' ),
		// 				'icon' => 'fa fa-chevron-right',
		// 			],
		// 			'none' => [
		// 				'title' => esc_html__( 'None', 'master-addons' ),
		// 				'icon' => 'fa fa-ban',
		// 			],
		// 		],
		// 		'default' => 'none',
		// 		'condition'     => [
		// 			'ma_el_post_grid_excerpt_type' => 'read_more_link'
		// 		]
		// 	]
		// );

		$this->add_responsive_control(
			'ma_el_excerpt_read_more_icon_padding',
			[
				'label'         => __('Icon Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-post-content-wrap .jltma-post-btn i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'ma_el_excerpt_read_more_bg_color',
			[
				'label'         => __('Background Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-post-content-wrap .jltma-post-btn'  => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'ma_el_excerpt_read_more_typo',
				'selector'      => '{{WRAPPER}} .jltma-blog-post-content-wrap .jltma-post-btn'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'ma_el_excerpt_read_more_box_shadow',
				'selector'      => '{{WRAPPER}} .jltma-blog-post-content-wrap .jltma-post-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'ma_el_excerpt_read_more_border',
				'separator'     => 'before',
				'selector'      => '{{WRAPPER}} .jltma-blog-post-content-wrap .jltma-post-btn',
			]
		);

		$this->add_responsive_control(
			'ma_el_excerpt_read_more_padding',
			[
				'label'         => __('Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-post-content-wrap .jltma-post-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_excerpt_read_more_margin',
			[
				'label'         => __('Content Margin', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-post-content-wrap .jltma-post-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();



		/*
			 * Post Format Icon Styles
			 */
		$this->start_controls_section(
			'ma_el_blog_post_format_icon_style_section',
			[
				'label'         => __('Post Format Icon', 'master-addons' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'ma_el_blog_post_format_icon'  => 'yes',
				]
			]
		);

		$this->add_control(
			'ma_el_blog_format_icon_size',
			[
				'label'         => __('Size', 'master-addons' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'em'    => [
						'min'       => 1,
						'max'       => 10,
					],
				],
				'size_units'    => ['px', "em"],
				'label_block'   => true,
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-format-link i' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'ma_el_blog_post_format_icon_color',
			[
				'label'         => __('Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_2,
				],
				'default' => '#4b00e7',
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-format-link i'  => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'ma_el_blog_p_f_trans_icon',
			[
				'label'         => __('Transparent Icon?', 'master-addons' ),
				'type'          => Controls_Manager::SWITCHER,
				'description'   => __('Show or Hide Thumbnail', 'master-addons' ),
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'margin',
			[
				'label' => __('Position', 'master-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'condition'     => [
					'ma_el_blog_p_f_trans_icon'  => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-blog-format-link i' => 'position: absolute;z-index:0;top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left:{{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_blog_pf_rotate',
			[
				'label'         => __('Rotation', 'master-addons' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'default' => [
					'unit' => 'deg',
					'size' => 360,
				],
				'range' => [
					'deg' => [
						'step' => 5,
					],
				],
				'condition'     => [
					'ma_el_blog_p_f_trans_icon' =>  'yes'
				],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-format-link i' => 'transform: rotateZ({{SIZE}}{{UNIT}});'
				]


			]
		);

		$this->end_controls_section();


		/*
			 * Pagination Styles
			 */
		$this->start_controls_section(
			'ma_el_blog_pagination_style_section',
			[
				'label'         => __('Pagination', 'master-addons' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'ma_el_blog_pagination_typography',
				'selector'      => '{{WRAPPER}} .jltma-blog-pagination .page-numbers li span,{{WRAPPER}} .jltma-blog-pagination .page-numbers li a'
			]
		);

		/* Pagination Colors Tab */
		$this->start_controls_tabs('ma_el_blog_pagination_colors');

		$this->start_controls_tab(
			'ma_el_blog_pagination_nomral',
			[
				'label'         => __('Normal', 'master-addons' ),

			]
		);

		$this->add_control(
			'ma_el_blog_pagination_text_color',
			[
				'label'         => __('Text Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-pagination .page-numbers li *' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'ma_el_blog_pagination_bg_color',
			[
				'label'         => __('Background Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-pagination .page-numbers li span,{{WRAPPER}} .jltma-blog-pagination .page-numbers li a' => 'background: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'ma_el_blog_pagination_hover',
			[
				'label'         => __('Hover', 'master-addons' ),

			]
		);

		$this->add_control(
			'ma_el_blog_pagination_text_hover_color',
			[
				'label'         => __('Hover Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-pagination .page-numbers li span:hover,{{WRAPPER}} .jltma-blog-pagination .page-numbers li a:hover'  => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'ma_el_blog_pagination_hover_bg_color',
			[
				'label'         => __('Background Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-pagination .page-numbers li span:hover,{{WRAPPER}} .jltma-blog-pagination .page-numbers li a:hover' => 'background: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'ma_el_blog_pagination_active',
			[
				'label'         => __('Active', 'master-addons' ),

			]
		);

		$this->add_control(
			'ma_el_blog_pagination_text_active_color',
			[
				'label'         => __('Active Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-pagination .page-numbers li span.current'  => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'ma_el_blog_pagination_active_bg_color',
			[
				'label'         => __('Background Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-pagination .page-numbers li span.current' => 'background: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();



		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'ma_el_pagination_border',
				'separator'     => 'before',
				'selector'      => '{{WRAPPER}} .jltma-blog-pagination .page-numbers li span,{{WRAPPER}} .jltma-blog-pagination .page-numbers li a',
			]
		);

		$this->add_control(
			'ma_el_blog_pagination_border_radius',
			[
				'label'         => __('Border Radius', 'master-addons' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-pagination .page-numbers li span, {{WRAPPER}} .jltma-blog-pagination .page-numbers li span.current, {{WRAPPER}} .jltma-blog-pagination .page-numbers li a' => 'border-radius: {{SIZE}}{{UNIT}};'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'ma_el_blog_pagination_shadow',
				'selector'      => '{{WRAPPER}} .jltma-blog-pagination .page-numbers li span, {{WRAPPER}} .jltma-blog-pagination .page-numbers li span.current, {{WRAPPER}} .jltma-blog-pagination .page-numbers li a'
			]
		);

		$this->add_responsive_control(
			'ma_el_blog_pagination_padding',
			[
				'label'         => __('Inner Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-pagination .page-numbers li span,
                        {{WRAPPER}} .jltma-blog-pagination .page-numbers li span.current,
                        {{WRAPPER}} .jltma-blog-pagination .page-numbers li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_blog_pagination_item_spacing',
			[
				'label'         => __('Item Spacing', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-pagination .page-numbers li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_blog_pagination_margin',
			[
				'label'         => __('Margin', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();



		/*
             * Category Filter Tabs
             */
		$this->start_controls_section(
			'ma_el_blog_cat_filter_tabs_style_section',
			[
				'label'         => __('Category Filter Tabs', 'master-addons' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'ma_el_blog_cat_tabs'         => 'yes',
					'ma_el_blog_carousel!'        => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'ma_el_blog_cat_filter_typo',
				'selector'      => '{{WRAPPER}} .jltma-blog-filter ul li a'
			]
		);

		/* Category Filter Tabs */
		$this->start_controls_tabs('ma_el_blog_cat_colors_style');

		// Normal Tab
		$this->start_controls_tab(
			'ma_el_blog_cat_nomral',
			[
				'label'         => __('Normal', 'master-addons' ),

			]
		);
		$this->add_control(
			'ma_el_blog_cat_filter_text_color',
			[
				'label'         => __('Text Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-filter ul li a'  => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'ma_el_blog_cat_filter_bg_color',
			[
				'label'         => __('Background Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-filter ul li a' => 'background: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'ma_el_blog_cat_filter_border_color',
			[
				'label'         => __('Border Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '#4b00e7',
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-filter ul li a'  => 'border-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();



		// Hover Tab
		$this->start_controls_tab(
			'ma_el_blog_cat_hover',
			[
				'label'         => __('Hover', 'master-addons' ),

			]
		);
		$this->add_control(
			'ma_el_blog_cat_filter_text_hover_color',
			[
				'label'         => __('Text Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-filter ul li a:hover'  => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'ma_el_blog_cat_filter_hover_bg_color',
			[
				'label'         => __('Background Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-filter ul li a:hover' => 'background: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'ma_el_blog_cat_filter_border_hover_color',
			[
				'label'         => __('Border Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '#4b00e7',
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-filter ul li a:hover'  => 'border-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		// Active Tab
		$this->start_controls_tab(
			'ma_el_blog_cat_active_style',
			[
				'label'         => __('Active', 'master-addons' ),

			]
		);
		$this->add_control(
			'ma_el_blog_cat_filter_text_active_color',
			[
				'label'         => __('Text Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '#fff',
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-filter ul li a.active'  => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'ma_el_blog_cat_filter_active_bg_color',
			[
				'label'         => __('Background Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '#4b00e7',
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-filter ul li a.active' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'ma_el_blog_cat_filter_border_active_color',
			[
				'label'         => __('Border Color', 'master-addons' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '#4b00e7',
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-filter ul li a.active'  => 'border-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'ma_el_blog_cat_filter_shadow',
				'selector'      => '{{WRAPPER}} .jltma-blog-filter ul li a'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'ma_el_blog_cat_border',
				'separator'     => 'before',
				'selector'      => '{{WRAPPER}} .jltma-blog-filter ul li a',
			]
		);

		$this->add_control(
			'ma_el_blog_cat_filter_border_radius',
			[
				'label'         => __('Border Radius', 'master-addons' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-filter ul li a' => 'border-radius: {{SIZE}}{{UNIT}};'
				]
			]
		);



		$this->add_responsive_control(
			'ma_el_blog_cat_filter_padding',
			[
				'label'         => __('Inner Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-filter ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_blog_cat_filter_item_spacing',
			[
				'label'         => __('Item Spacing', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-filter ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_blog_cat_filter_margin',
			[
				'label'         => __('Margin', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blog-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();



		// Global Swiper Item Style
		$this->jltma_swiper_item_style_controls('blog-carousel');


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
		$this->jltma_swiper_navigation_style_controls('blog-carousel');


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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/blog-element/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/blog-element-customization/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=03AcgVEsTaA" target="_blank" rel="noopener">', '</a>'),
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
		 * Renders Post Format Icon
		 * @since 1.1.5
		 */
	protected function ma_el_blog_post_format_icon()
	{

		$post_format = get_post_format();

		switch ($post_format) {
			case 'aside':
				$post_format = 'file-text-o';
				break;
			case 'audio':
				$post_format = 'music';
				break;
			case 'gallery':
				$post_format = 'file-image-o';
				break;
			case 'image':
				$post_format = 'picture-o';
				break;
			case 'link':
				$post_format = 'link';
				break;
			case 'quote':
				$post_format = 'quote-left';
				break;
			case 'video':
				$post_format = 'video-camera';
				break;
			default:
				$post_format = 'thumb-tack';
		}
?>
		<i class="jltma-blog-post-format-icon fa fa-<?php echo esc_attr($post_format); ?>"></i>
		<?php
	}




	/*
		 * Renders Post Title
		 * @since 1.1.5
		 */
	protected function jltma_get_post_title($link_target)
	{

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('title', 'class', 'jltma-entry-title');

		if ($settings['ma_el_post_grid_post_title'] == 'yes') { ?>

			<<?php echo tag_escape($settings['title_html_tag']) . ' ' . $this->get_render_attribute_string('title'); ?>>
				<a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($link_target); ?>"><?php the_title(); ?></a>
			</<?php echo tag_escape($settings['title_html_tag']); ?>>

		<?php }
	}


	/*
		 * Renders Post Title
		 * @since 1.1.5
		 */
	protected function jltma_get_post_content()
	{

		$settings = $this->get_settings();

		$excerpt_type = $settings['ma_el_post_grid_excerpt_type'];
		$excerpt_text = $settings['ma_el_post_grid_excerpt_text'];
		$excerpt_src  = $settings['ma_el_post_grid_excerpt_content'];
		$read_more_link  = $settings['ma_el_post_grid_show_read_more'];
		// $excerpt_icon  = ($settings['ma_el_blog_read_more_icon'])?$settings['ma_el_blog_read_more_icon']:"";
		// $excerpt_icon_align  = $settings['ma_el_blog_read_more_icon_alignment'];

		?>
		<div class="jltma-blog-post-content-wrap" style="<?php if (
																$settings['ma_el_blog_post_format_icon'] !== 'yes'
															) : echo 'margin-left:0px;';
															endif; ?>">
			<?php if ($settings['ma_el_post_grid_excerpt'] === 'yes') {
				echo Master_Addons_Helper::ma_el_get_excerpt_by_id(get_the_ID(), $settings['ma_el_blog_excerpt_length'], $excerpt_type, $excerpt_text, $excerpt_src, $excerpt_icon = "", $excerpt_icon_align = "", $read_more_link);
			} else {
				if ($settings['ma_el_blog_show_content'] == 'yes') {
					the_content();
				}
			} ?>
		</div>
		<?php
	}



	/*
		 * Renders Post Title
		 * @since 1.1.5
		 */
	protected function ma_el_get_post_meta($link_target)
	{

		$settings = $this->get_settings();

		$date_format = get_option('date_format');

		if (
			$settings['ma_el_post_grid_post_author_meta'] === 'yes' ||
			$settings['ma_el_post_grid_post_date_meta'] === 'yes' ||
			$settings['ma_el_post_grid_categories_meta'] === 'yes' ||
			$settings['ma_el_post_grid_comments_meta'] === 'yes'
		) {
		?>

			<div class="jltma-post-entry-meta" style="<?php if ($settings['ma_el_blog_post_format_icon'] !== 'yes') : echo 'margin-left:0px';
														endif; ?>">

				<?php if ($settings['ma_el_post_grid_post_author_meta'] === 'yes') : ?>
					<span class="jltma-post-author">
						<?php if ($settings['ma_el_blog_post_meta_icon'] === 'yes') { ?>
							<i class="fa fa-user fa-fw"></i>
						<?php } ?>
						<?php the_author_posts_link(); ?>
					</span>
				<?php endif; ?>

				<?php if ($settings['ma_el_post_grid_post_date_meta'] === 'yes') : ?>
					<span class="jltma-post-date">
						<?php if ($settings['ma_el_blog_post_meta_icon'] === 'yes') { ?>
							<i class="fa fa-calendar fa-fw"></i>
						<?php } ?>

						<?php

						if ($settings['ma_el_post_grid_layout'] == "list" && $settings['ma_el_post_list_layout'] == "thumbnail_bg") { ?>
							<time datetime="<?php echo get_the_modified_date('c'); ?>">
								<?php echo get_the_time('M d'); ?>
								<span>
									<?php echo get_the_time('Y'); ?>
								</span>
							</time>
						<?php } else { ?>
							<a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($link_target); ?>"><?php the_time($date_format); ?></a>
						<?php } ?>
					</span>
				<?php endif; ?>

				<?php if ($settings['ma_el_post_grid_categories_meta'] === 'yes') : ?>
					<span class="jltma-post-categories">
						<?php if ($settings['ma_el_blog_post_meta_icon'] === 'yes') { ?>
							<i class="fa fa-tags fa-fw"></i>
						<?php } ?>
						<?php the_category(', '); ?>
					</span>
				<?php endif; ?>

				<?php if ($settings['ma_el_post_grid_comments_meta'] === 'yes') : ?>
					<span class="jltma-post-comments">
						<?php if ($settings['ma_el_blog_post_meta_icon'] === 'yes') { ?>
							<i class="fa fa-comments-o fa-fw"></i>
						<?php } ?>
						<a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($link_target); ?>">
							<?php comments_number('0 Comment', '1 Comment', '% Comments'); ?>
						</a>
					</span>
				<?php endif; ?>

			</div>

		<?php
		}
	}


	/*
         * Renders Blog Layout
         * @since 1.1.5
         */
	public function ma_el_get_post_meta_media_format($link_target)
	{

		$settings = $this->get_settings();
		$date_format = get_option('date_format');

		if ($settings['ma_el_blog_author_avatar'] == "yes") { ?>

			<div class="jltma-post-entry-meta media">
				<div class="jltma-author-avatar">
					<?php echo get_avatar(get_the_author_meta('ID'), 64, '', get_the_author_meta('display_name'), array('class' => 'rounded-circle')); ?>
				</div>

				<div class="media-body">
					<?php if ($settings['ma_el_post_grid_post_author_meta'] === 'yes') : ?>
						<span class="jltma-post-author">
							<?php if ($settings['ma_el_blog_post_meta_icon'] === 'yes') { ?>
								<i class="fa fa-user fa-fw"></i>
							<?php } ?>
							<?php the_author_posts_link(); ?>
						</span>
					<?php endif; ?>

					<?php if ($settings['ma_el_post_grid_post_date_meta'] === 'yes') : ?>
						<span class="jltma-post-date">
							<?php if ($settings['ma_el_blog_post_meta_icon'] === 'yes') { ?>
								<i class="fa fa-calendar fa-fw"></i>
							<?php } ?>
							<a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($link_target); ?>"><?php the_time($date_format); ?></a></span>
					<?php endif; ?>

					<?php if ($settings['ma_el_post_grid_categories_meta'] === 'yes') : ?>
						<span class="jltma-post-categories">
							<?php if ($settings['ma_el_blog_post_meta_icon'] === 'yes') { ?>
								<i class="fa fa-tags fa-fw"></i>
							<?php } ?>
							<?php the_category(', '); ?>
						</span>
					<?php endif; ?>

					<?php if ($settings['ma_el_post_grid_comments_meta'] === 'yes') : ?>
						<span class="jltma-post-comments">
							<?php if ($settings['ma_el_blog_post_meta_icon'] === 'yes') { ?>
								<i class="fa fa-comments-o fa-fw"></i>
							<?php } ?>
							<a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($link_target);
																		?>"><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?> </a></span>
					<?php endif; ?>
				</div>
			</div>


		<?php
		}
	}


	/*
		 * Renders Blog Layout
		 * @since 1.1.5
		 */
	protected function ma_el_blog_layout()
	{

		$settings = $this->get_settings();


		switch ($settings['ma_el_blog_cols']) {
			case '100%':
				$col_number = 'jltma-col-12';
				break;
			case '50%':
				$col_number = 'jltma-col-6';
				break;
			case '33.33%':
				$col_number = 'jltma-col-4';
				break;
			case '25%':
				$col_number = 'jltma-col-3';
				break;
		}


		$post_effect = $settings['ma_el_blog_hover_color_effect'];

		if ($settings['ma_el_blog_new_tab'] == 'yes') {
			$target = '_blank';
		} else {
			$target = '_self';
		}

		$skin = $settings['ma_el_blog_skin'];

		$post_id = get_the_ID();

		$key = 'post_' . $post_id;

		$tax_key = sprintf('%s_tax', $key);

		$wrap_key = sprintf('%s_wrap', $key);

		$content_key = sprintf('%s_content', $key);

		$this->add_render_attribute($tax_key, 'class', [
			'jltma-post-outer-container',
			('yes' === $settings['ma_el_blog_carousel']) ? "" : $col_number
		]);


		$this->add_render_attribute($wrap_key, 'class', [
			'jltma-blog-post',
			($settings['ma_el_post_grid_layout'] == 'grid') ? 'jltma-default-post' : "",
			($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'classic') ? 'jltma-blog-list-default' : "",
			($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'meta_bg') ? 'jltma-blog-list-meta-bg' : "",
			($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'button_right') ? 'jltma-blog-list-button-right' : "",
			($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'content_overlap') ? 'jltma-blog-list-content-slide' : "",
			($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'thumbnail_hover') ? 'jltma-blog-list-thumbnail-hover' : "",
			($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'thumbnail_hover_nav') ? 'jltma-blog-list-thumbnail-nav-hover' : "",
			($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'thumbnail_bg') ? 'jltma-blog-list-thumbnail-bg' : "",
			($settings['ma_el_blog_author_avatar'] === 'yes') ? "jltma-post-meta-with-avatar" : "",
			($settings['ma_el_blog_thumbnail_position'] == 'left' && $settings['ma_el_post_grid_layout'] == 'grid') ? "jltma-post-half-row" : "",
			($settings['ma_el_blog_cards_skin'] == 'absolute_content' && $settings['ma_el_post_grid_layout'] == 'grid') ? "jltma-post-absolute-bottom-content" : "",
			($settings['ma_el_blog_cards_skin'] == 'absolute_content_two' && $settings['ma_el_post_grid_layout'] == 'grid') ? "jltma-post-absolute-bottom-content-02" : "",
			($settings['ma_el_blog_cards_skin'] == 'cards_right' && $settings['ma_el_post_grid_layout'] == 'grid') ? "jltma-post-content-right" : "",
			($settings['ma_el_blog_cards_skin'] == 'cards_center' && $settings['ma_el_post_grid_layout'] == 'grid') ? "jltma-post-meta-icon-with-details" : "",
			($settings['ma_el_blog_cards_skin'] == 'gradient_bg' && $settings['ma_el_post_grid_layout'] == 'grid') ? "jltma-post-content-gradient-bg" : "",
			($settings['ma_el_blog_cards_skin'] == 'full_banner' && $settings['ma_el_post_grid_layout'] == 'grid') ? "jltma-post-corner-content" : "",
			$skin,
		]);

		$thumb = (!has_post_thumbnail()) ? 'empty-thumb' : '';

		if ('yes' === $settings['ma_el_blog_cat_tabs'] && 'yes' !== $settings['ma_el_blog_carousel']) {

			$categories = get_the_category($post_id);

			foreach ($categories as $index => $category) {

				$category = str_replace(' ', '-', $category->cat_name);

				$this->add_render_attribute($tax_key, 'class', strtolower($category));
			}
		}

		$this->add_render_attribute($content_key, 'class', [
			//				'jltma-blog-content-wrapper',
			'jltma-post-content',
			$thumb,
		]);


		if ($settings['hover_animation']) {
			$this->add_render_attribute('hover_animations', 'class', ['elementor-animation-' . esc_attr($settings['hover_animation'])]);
		}

		?>

		<?php if ($settings['ma_el_blog_thumbnail_position'] == 'left' && $settings['ma_el_post_grid_layout'] == 'grid') { ?>
			<div class="jltma-col-6">
			<?php } else { ?>
				<div <?php echo $this->get_render_attribute_string($tax_key); ?>>
				<?php } ?>


				<div <?php echo $this->get_render_attribute_string($wrap_key); ?>>

					<?php if (
						($settings['ma_el_blog_thumbnail_position'] == 'left' && $settings['ma_el_post_grid_layout'] == 'grid') ||
						($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'button_right') ||
						($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'content_overlap')
					) { ?>
						<div class="jltma-row">
							<div class="jltma-col-6">
							<?php } ?>

							<?php if (
								($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'classic') ||
								($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'meta_bg')
							) { ?>
								<div class="jltma-row">
								<?php } ?>

								<?php if ($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'classic') { ?>
									<div class="jltma-col-4">
									<?php } ?>

									<?php if ($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'meta_bg') { ?>
										<div class="jltma-col-5">
										<?php } ?>

										<?php if ($settings['ma_el_blog_thumbnail_position'] !== "thumb_bottom") {
											$this->jltma_render_thumbnails();
										}  ?>

										<div class="jltma-blog-effect-container <?php echo 'jltma-blog-' . esc_attr($post_effect) . '-effect'; ?>">
											<a class="jltma-post-link" href="<?php the_permalink(); ?>" target="<?php echo esc_attr($target); ?>"></a>
											<?php if ($settings['ma_el_blog_hover_color_effect'] === 'bordered') : ?>
												<div class="jltma-blog-bordered-border-container"></div>
											<?php elseif ($settings['ma_el_blog_hover_color_effect'] === 'squares') : ?>
												<div class="jltma-blog-squares-square-container"></div>
											<?php endif; ?>
										</div>



										<?php if (
											($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'classic') ||
											($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'meta_bg')
										) { ?>
										</div>
										<!--col-4-->
									<?php } ?>

									<?php if (
										($settings['ma_el_blog_thumbnail_position'] == 'left' && $settings['ma_el_post_grid_layout'] == 'grid') ||
										($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'button_right') ||
										($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'content_overlap')
									) { ?>
									</div>
									<div class="jltma-col-6">
									<?php } ?>

									<?php if ('cards' === $skin && $settings['ma_el_blog_author_avatar'] == "yes") : ?>
										<div class="jltma-author-avatar">
											<?php echo get_avatar(get_the_author_meta('ID'), 64, '', get_the_author_meta('display_name'), array('class' => 'rounded-circle')); ?>
										</div>
									<?php endif; ?>



									<?php if ($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'classic') { ?>
										<div class="jltma-col-8">
										<?php } ?>

										<?php if ($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'meta_bg') { ?>
											<div class="jltma-col-7">
											<?php } ?>

											<?php if ($settings['ma_el_post_grid_layout'] == 'grid' && $settings['ma_el_blog_cards_skin'] == 'full_banner') { ?>
												<div class="jltma-container">
												<?php } ?>

												<div <?php echo $this->get_render_attribute_string($content_key); ?>>

													<div class="jltma-blog-inner-container">

														<?php if ($settings['ma_el_blog_post_format_icon'] === 'yes') : ?>
															<div class="jltma-blog-format-container">
																<a class="jltma-blog-format-link" href="<?php the_permalink(); ?>" title="<?php if (
																																				get_post_format() === ' '
																																			) : echo 'standard';
																																			else : echo get_post_format();
																																			endif; ?>" target="<?php echo esc_attr($target); ?>">

																	<?php $this->ma_el_blog_post_format_icon(); ?>
																</a>
															</div>
														<?php endif; ?>

														<div class="jltma-blog-entry-container">
															<?php

															if (
																($settings['ma_el_post_grid_layout'] == "list" && $settings['ma_el_post_list_layout'] == "thumbnail_hover") ||
																($settings['ma_el_post_grid_layout'] == "list" && $settings['ma_el_post_list_layout'] == "thumbnail_bg")
															) {
																$this->ma_el_get_post_meta($target);
															}

															$this->jltma_get_post_title($target);

															if ('classic' === $skin) {
																if ($settings['ma_el_blog_author_avatar'] === 'yes') {
																	$this->ma_el_get_post_meta_media_format($target);
																} elseif (
																	($settings['ma_el_post_grid_layout'] != "list" && $settings['ma_el_post_list_layout'] != "thumbnail_hover") ||
																	($settings['ma_el_post_grid_layout'] != "list" && $settings['ma_el_post_list_layout'] != "thumbnail_bg")
																) {
																	//                                            if( $settings['ma_el_post_list_layout'] !='thumbnail_hover'){
																	$this->ma_el_get_post_meta($target);
																	//                                            }
																}
															}

															?>
														</div>
													</div>


													<?php if ($settings['ma_el_blog_thumbnail_position'] === "thumb_bottom") {
														$this->jltma_render_thumbnails();
													}  ?>

													<?php

													$this->jltma_get_post_content();

													if ('cards' === $skin) {
														if (
															($settings['ma_el_post_grid_layout'] != "list" && $settings['ma_el_post_list_layout'] != "thumbnail_hover") ||
															($settings['ma_el_post_grid_layout'] != "list" && $settings['ma_el_post_list_layout'] != "thumbnail_hover_nav") ||
															($settings['ma_el_post_grid_layout'] != "list" && $settings['ma_el_post_list_layout'] != "thumbnail_bg")
														) {
															$this->ma_el_get_post_meta($target);
														}
													}
													?>

													<?php if ($settings['ma_el_post_grid_tags_meta'] === 'yes' && has_tag()) : ?>
														<div class="jltma-blog-post-tags-container" style="<?php if ($settings['ma_el_blog_post_format_icon'] !== 'yes') : echo 'margin-left:0px;';
																											endif; ?>">
															<span class="jltma-blog-post-tags">

																<?php if ($settings['ma_el_blog_post_meta_icon'] === 'yes') { ?>
																	<i class="fa fa-tags fa-fw"></i>
																<?php } ?>

																<?php the_tags(' ', ', '); ?>
															</span>
														</div>
													<?php endif; ?>
												</div>


												<?php if ($settings['ma_el_post_grid_layout'] == 'grid' && $settings['ma_el_blog_cards_skin'] == 'full_banner') { ?>
												</div>
											<?php } ?>

											<?php if (
												($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'classic') ||
												($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'meta_bg')
											) { ?>
											</div> <!-- .col-8 -->
										</div>
										<!--.row-->
									<?php } ?>


									<?php if (
										($settings['ma_el_blog_thumbnail_position'] == 'left' && $settings['ma_el_post_grid_layout'] == 'grid') ||
										($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'button_right') ||
										($settings['ma_el_post_grid_layout'] == 'list' && $settings['ma_el_post_list_layout'] == 'content_overlap')
									) { ?>

									</div> <!-- .col-6 -->
								</div> <!-- .row -->
							<?php } ?>


							</div>
						</div>

					<?php }



				protected function jltma_render_thumbnails()
				{
					$settings = $this->get_settings_for_display();
					$image_effect = $settings['ma_el_blog_hover_color_effect'];
					if ($settings['ma_el_blog_new_tab'] == 'yes') {
						$target = '_blank';
					} else {
						$target = '_self';
					}

					?>

						<?php if ($settings['ma_el_post_grid_thumbnail'] == 'yes') { ?>
							<div <?php echo $this->get_render_attribute_string('hover_animations'); ?>>
								<div class="jltma-post-thumbnail jltma-img-<?php echo esc_attr($image_effect); ?> jltma-img-shape-<?php echo esc_attr($settings['ma_el_blog_image_shapes']); ?>">
									<a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($target); ?>">
										<?php the_post_thumbnail($settings['thumbnail_size']); ?>
									</a>
									<?php if ($settings['ma_el_blog_cards_skin'] === "absolute_content_two") { ?>
										<div class="jltma-post-entry-meta">
											<span class="jltma-post-date">
												<time datetime="<?php echo get_the_modified_date('c'); ?>">
													<?php echo get_the_time('d'); ?>
													<span>
														<?php echo get_the_time('M'); ?>
													</span>
												</time>
											</span>
										</div>
									<?php } ?>
								</div>
							</div>
						<?php } ?>

					<?php }




				protected function render()
				{

					// Query var for paged
					if (get_query_var('paged')) {
						$paged = get_query_var('paged');
					} elseif (get_query_var('page')) {
						$paged = get_query_var('page');
					} else {
						$paged = 1;
					}

					$settings = $this->get_settings_for_display();

					$offset = $settings['ma_el_blog_post_offset'];

					$post_per_page = $settings['ma_el_blog_posts_per_page'];

					$new_offset = $offset + (($paged - 1) * $post_per_page);

					$post_args = Master_Addons_Helper::ma_el_blog_get_post_settings($settings);

					$posts = Master_Addons_Helper::ma_el_blog_get_post_data($post_args, $paged, $new_offset);

					$posts_number = intval(100 / substr($settings['ma_el_blog_cols'], 0, strpos($settings['ma_el_blog_cols'], '%')));

					$carousel = 'yes' == $settings['ma_el_blog_carousel'] ? true : false;

					$unique_id 	= implode('-', [$this->get_id(), get_the_ID()]);

					if (!$carousel) {

						$this->add_render_attribute(
							'ma_el_blog',
							'class',
							[
								'jltma-blog-wrapper',
								'jltma-blog-' . esc_attr($settings['ma_el_post_grid_layout']),
								'jltma-row'
							]
						);
					} else {

						$this->add_render_attribute([
							'ma_el_blog' => [
								'class' => [
									'jltma-blog-carousel-wrapper',
									'jltma-carousel',
									'jltma-swiper',
									'jltma-swiper__container',
									'swiper-container',
									'elementor-jltma-element-' . $unique_id
								],
								'data-jltma-template-widget-id' => $unique_id
							],

							'swiper-wrapper' => [
								'class' => [
									'jltma-blog-carousel',
									'jltma-swiper__wrapper',
									'swiper-wrapper',
								],
							],

							'swiper-item' => [
								'class' => [
									'jltma-slider__item',
									'jltma-swiper__slide',
									'swiper-slide'
								],
							],
						]);


						//Global Header Function
						$this->jltma_render_swiper_header_attribute('blog-carousel');

						$this->add_render_attribute('carousel', 'class', ['jltma-blog-carousel-slider']);

						$this->add_render_attribute('ma_el_blog', 'class', ['elementor-swiper-slider']);
					}
					?>

						<?php if ($carousel) { ?>
							<div <?php echo $this->get_render_attribute_string('carousel'); ?>>
							<?php } ?>
							<div class="jltma-blog">

								<?php if ('yes' === $settings['ma_el_blog_cat_tabs'] && 'yes' !== $settings['ma_el_blog_carousel']) { ?>
									<div class="jltma-blog-filter">
										<ul class="jltma-blog-cats-container">
											<li>
												<a href="javascript:;" class="category active" data-filter="*">
													<span>
														<?php echo esc_html($settings['ma_el_blog_cat_tabs_all_text']); ?>
													</span>
												</a>
											</li>
											<?php foreach ($settings['ma_el_blog_categories'] as $index => $id) {
												$cat_list_key = 'blog_category_' . $index;

												$name = get_cat_name($id);

												$name_filter = str_replace(' ', '-', $name);
												$name_lower = strtolower($name_filter);

												$this->add_render_attribute(
													$cat_list_key,
													'class',
													[
														'category'
													]
												);
											?>
												<li>
													<a href="javascript:;" <?php echo $this->get_render_attribute_string($cat_list_key); ?> data-filter=".<?php echo esc_attr($name_lower); ?>"><span><?php echo esc_html($name); ?></span>
													</a>
												</li>
											<?php } ?>
										</ul>
									</div>
								<?php } ?>


								<div <?php echo $this->get_render_attribute_string('ma_el_blog'); ?>>

									<?php if ($carousel) { ?>
										<div <?php echo $this->get_render_attribute_string('swiper-wrapper'); ?>>
											<?php }

										if (count($posts)) {
											global $post;
											foreach ($posts as $post) {
												setup_postdata($post);
												if ($carousel) {
													echo '<div ' . $this->get_render_attribute_string('swiper-item') . '>';
												}
												$this->ma_el_blog_layout();
												if ($carousel) {
													echo '</div>';
												}
											}
											if ($carousel) { ?>
										</div>


										<?php $this->render_swiper_navigation(); ?>

										<?php if ('yes' === $settings['show_scrollbar']) { ?>
											<div class="swiper-scrollbar"></div>
										<?php } ?>
								</div>

							<?php } ?>

							</div>

							<?php if ($carousel) { ?>
							</div>
						<?php } ?>

				</div>


				<?php if ($settings['ma_el_blog_pagination'] === 'yes') { ?>

					<div class="jltma-blog-pagination">
						<?php
												$count_posts = wp_count_posts();
												$published_posts = $count_posts->publish;

												$total_posts = !empty($settings['ma_el_blog_total_posts_number']) ? $settings['ma_el_blog_total_posts_number'] : $published_posts;

												$page_tot = ceil(($total_posts - $offset) / $settings['ma_el_blog_posts_per_page']);
												if ($page_tot > 1) {
													$big        = 999999999;
													echo paginate_links(
														array(
															'base'      => str_replace($big, '%#%', get_pagenum_link(999999999, false)),
															'format'    => '?paged=%#%',
															'current'   => max(1, $paged),
															'total'     => $page_tot,
															'prev_next' => true,
															'prev_text' => sprintf("&lsaquo; %s", $settings['ma_el_blog_prev_text']),
															'next_text' => sprintf("%s &rsaquo;", $settings['ma_el_blog_next_text']),
															'end_size'  => 1,
															'mid_size'  => 2,
															'type'      => 'list'
														)
													);
												}
						?>
					</div>
	<?php }
											wp_reset_postdata();
										}
									}
								}
