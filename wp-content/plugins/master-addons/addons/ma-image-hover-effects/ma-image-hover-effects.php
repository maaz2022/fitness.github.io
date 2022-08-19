<?php

namespace MasterAddons\Addons;

use \Elementor\Widget_Base;
use \Elementor\Controls_Stack;
use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Core\Schemes\Color;
use \Elementor\Group_Control_Text_Shadow;
use MasterAddons\Inc\Helper\Master_Addons_Helper;

/**
 * Author Name: Liton Arefin
 * Author URL : https://master-addons.com
 * Date       : 8/28/19
 */

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Image_Hover_Effects extends Widget_Base
{

	public static $ma_el_image_hover_effects;


	public function get_name()
	{
		return 'ma-image-hover-effects';
	}

	public function get_title()
	{
		return esc_html__('Image Hover Effects', 'master-addons' );
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-image-rollover';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_keywords()
	{
		return ['hover', 'image', 'effects', 'image hover', 'banner', 'banner image'];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/image-hover-effects/';
	}

	public function get_style_depends()
	{
		return [
			'ma-image-hover-effects',
			'font-awesome-5-all',
			'font-awesome-4-shim',
			'fancybox'
		];
	}

	public function get_script_depends()
	{
		return [
			'imagesloaded',
			'fancybox',
			'font-awesome-4-shim'
		];
	}

	public static function ma_el_image_hover_effects()
	{

		return self::$ma_el_image_hover_effects =
			[
				'lily'    => __('Lily', 	                            'master-addons' ),
				'sadie'   => __('Sadie', 	                        'master-addons' ),
				'roxy'    => __('Roxy', 	                            'master-addons' ),
				'bubba'   => __('Bubba', 	                        'master-addons' ),
				'romeo'   => __('Romeo', 	                        'master-addons' ),
				'layla'   => __('Layla', 	                        'master-addons' ),
				'honey'   => __('Honey', 	                        'master-addons' ),
				'oscar'   => __('Oscar', 	                        'master-addons' ),
				'marley'  => __('Marley', 	                        'master-addons' ),
				'ruby'    => __('Ruby', 	                            'master-addons' ),
				'milo'    => __('Milo', 	                            'master-addons' ),
				'dexter'  => __('Dexter', 	                        'master-addons' ),
				'sarah'   => __('Sarah', 	                        'master-addons' ),
				'zoe'     => __('Zoe', 	                            'master-addons' ),
				'chico'   => __('Chico', 	                        'master-addons' ),
				'julia'   => __('Julia', 	                        'master-addons' ),
				'goliath' => __('Goliath', 	                        'master-addons' ),
				'hera'    => __('Hera', 	                            'master-addons' ),
				'winston' => __('Winston', 	                        'master-addons' ),
				'selena'  => __('Selena', 	                        'master-addons' ),
				'terry'   => __('Terry', 	                        'master-addons' ),
				'phoebe'  => __('Phoebe', 	                        'master-addons' ),
				'apollo'  => __('Apollo', 	                        'master-addons' ),
				'kira'    => __('Kira', 	                            'master-addons' ),
				'steve'   => __('Steve', 	                        'master-addons' ),
				'moses'   => __('Moses', 	                        'master-addons' ),
				'jazz'    => __('Jazz', 	                            'master-addons' ),
				'ming'    => __('Ming', 	                            'master-addons' ),
				'lexi'    => __('Lexi', 	                            'master-addons' ),
				'duke'    => __('Duke', 	                            'master-addons' ),
			];
	}

	protected function register_controls()
	{


		/*
			* Master Addons: Effects Controls & Image Hover Effects Section Start
			*/

		$this->start_controls_section(
			'ma-image-hover-effect-section',
			[
				'label' => __('Effects & Image', 'master-addons' ),
			]
		);


		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {

			$this->add_control(
				'ma_el_main_image_effect',
				[
					'label'   => esc_html__('Hover Effect', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'sadie',
					'options' => self::ma_el_image_hover_effects()
				]
			);

			//Free Version Codes

		} else {

			$this->add_control(
				'ma_el_main_image_effect',
				[
					'label'   => esc_html__('Hover Effect', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'sadie',
					'options' => [
						'lily'  => __('Lily', 'master-addons' ),
						'sadie' => __('Sadie', 'master-addons' ),
						'roxy'  => __('Roxy', 'master-addons' ),
						'bubba' => __('Bubba', 'master-addons' ),
						'romeo' => __('Romeo', 'master-addons' ),
						'layla' => __('Layla', 'master-addons' ),
						'honey' => __('Honey', 'master-addons' ),
						'oscar' => __('Oscar', 'master-addons' ),

						'ma-el-img-hover1'  => __('Marley (Pro)', 'master-addons' ),
						'ma-el-img-hover2'  => __('Ruby (Pro)', 'master-addons' ),
						'ma-el-img-hover3'  => __('Milo (Pro)', 'master-addons' ),
						'ma-el-img-hover4'  => __('Dexter (Pro)', 'master-addons' ),
						'ma-el-img-hover5'  => __('Sarah (Pro)', 'master-addons' ),
						'ma-el-img-hover6'  => __('Zoe (Pro)', 'master-addons' ),
						'ma-el-img-hover7'  => __('Chico (Pro)', 'master-addons' ),
						'ma-el-img-hover8'  => __('Julia (Pro)', 'master-addons' ),
						'ma-el-img-hover9'  => __('Goliath (Pro)', 'master-addons' ),
						'ma-el-img-hover10' => __('Hera (Pro)', 'master-addons' ),
						'ma-el-img-hover11' => __('Winston (Pro)', 'master-addons' ),
						'ma-el-img-hover12' => __('Selena (Pro)', 'master-addons' ),
						'ma-el-img-hover13' => __('Terry (Pro)', 'master-addons' ),
						'ma-el-img-hover14' => __('Phoebe (Pro)', 'master-addons' ),
						'ma-el-img-hover15' => __('Apollo (Pro)', 'master-addons' ),
						'ma-el-img-hover16' => __('Kira (Pro)', 'master-addons' ),
						'ma-el-img-hover17' => __('Steve (Pro)', 'master-addons' ),
						'ma-el-img-hover18' => __('Moses (Pro)', 'master-addons' ),
						'ma-el-img-hover19' => __('Jazz (Pro)', 'master-addons' ),
						'ma-el-img-hover20' => __('Ming (Pro)', 'master-addons' ),
						'ma-el-img-hover21' => __('Lexi (Pro)', 'master-addons' ),
						'ma-el-img-hover22' => __('Duke (Pro)', 'master-addons' ),
					],
					'description' => sprintf(
						'20+ more effects on <a href="%s" target="_blank">%s</a>',
						esc_url_raw(admin_url('admin.php?page=master-addons-settings-pricing')),
						__('Upgrade Now', 'master-addons' )
					)
				]
			);
		}


		$this->add_control(
			'ma_el_main_image',
			[
				'label'       => __('Upload Image', 'master-addons' ),
				'description' => __('Select an Image', 'master-addons' ),
				'type'        => Controls_Manager::MEDIA,
				'default'     => [
					'url' => Utils::get_placeholder_image_src()
				],
			]
		);

		$this->add_control(
			'ma_el_main_image_size',
			[
				'label'   => esc_html__('Image Size', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'main'   => esc_html__('Default', 'master-addons' ),
					'custom' => esc_html__('Custom', 'master-addons' ),
				],
				'default' => 'main'
			]
		);


		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image_thumbnail_size',
				'default'   => 'full',
				'condition' => [
					'ma_el_main_image[url]!' => '',
				],
				'exclude'   => ['custom'],
				'condition' => [
					'ma_el_main_image_size' => 'main',
				],
			]
		);


		$this->add_control(
			'ma_el_main_image_width',
			[
				'label'   => __('Width', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 200
				],
				'range' => [
					'px' => [
						'min'  => 100,
						'max'  => 1000,
						'step' => 1
					]
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-image-hover-effect figure, {{WRAPPER}} .jltma-image-hover-effect figure img' => 'width: {{SIZE}}px;'
				],
				'condition' => [
					'ma_el_main_image_size' => 'custom',
				],
			]
		);

		$this->add_control(
			'ma_el_main_image_height',
			[
				'label'   => __('Height', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 200
				],
				'range' => [
					'px' => [
						'min'  => 100,
						'max'  => 1000,
						'step' => 1
					]
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-image-hover-effect figure, {{WRAPPER}} .jltma-image-hover-effect figure img' => 'height: {{SIZE}}px;'
				],
				'condition' => [
					'ma_el_main_image_size' => 'custom',
				],
			]
		);



		$this->add_control(
			'ma_el_image_hover_link_type',
			[
				'label'   => esc_html__('Links or Popup?', 'master-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'none' => [
						'title' => esc_html__('None', 'master-addons' ),
						'icon'  => 'eicon-close-circle',
					],
					'popup' => [
						'title' => esc_html__('Popup', 'master-addons' ),
						'icon'  => 'eicon-search',
					],
					'links' => [
						'title' => esc_html__('External Links', 'master-addons' ),
						'icon'  => 'eicon-editor-external-link',
					],
				],
				'default' => 'none'
			]
		);


		$this->add_control(
			'ma_el_main_image_more_link_url',
			[
				'label'       => esc_html__('Link URL', 'master-addons' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => '',
				],
				'condition'		=> [
					'ma_el_image_hover_link_type' => 'links'
				],
				'show_external' => true,
			]
		);




		if (ma_el_fs()->can_use_premium_code()) {
			$this->add_control(
				'ma_el_image_popup_type',
				[
					'label'       => esc_html__('Content Type', 'master-addons' ),
					'type'        => Controls_Manager::SELECT,
					'label_block' => false,
					'options'     => [
						'image'    => esc_html__('Image', 'master-addons' ),
						'content'  => esc_html__('Content', 'master-addons' ),
						'section'  => esc_html__('Saved Section', 'master-addons' ),
						'widget'   => esc_html__('Saved Widget', 'master-addons' ),
						'template' => esc_html__('Saved Page Template', 'master-addons' ),
					],
					'default'   => 'content',
					'condition' => [
						'ma_el_image_hover_link_type' => 'popup'
					]
				]
			);
		} else {

			$this->add_control(
				'ma_el_image_popup_type',
				[
					'label'       => esc_html__('Content Type', 'master-addons' ),
					'type'        => Controls_Manager::SELECT,
					'label_block' => false,
					'options'     => [
						'image_pro'    => esc_html__('Image (Pro)', 'master-addons' ),
						'content_pro'  => esc_html__('Content (Pro)', 'master-addons' ),
						'section_pro'  => esc_html__('Saved Section (Pro)', 'master-addons' ),
						'widget_pro'   => esc_html__('Saved Widget (Pro)', 'master-addons' ),
						'template_pro' => esc_html__('Saved Page Template (Pro)', 'master-addons' ),
					],
					'default'     => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> unlock this feature.</span>',
					'condition'   => [
						'ma_el_image_hover_link_type' => 'popup'
					]
				]
			);
		}


		$this->add_control(
			'popup_image',
			[
				'label'   => esc_html__('Image', 'master-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default'               => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'             => [
					'ma_el_image_popup_type'      => 'image',
					'ma_el_image_hover_link_type' => 'popup'
				],
				'conditions'            => [
					'terms' => [
						[
							'name'     => 'ma_el_image_popup_type',
							'operator' => '==',
							'value'    => 'image',
						],
					],
				],
			]
		);

		$this->add_control(
			'popup_content',
			[
				'label'     => esc_html__('Content', 'master-addons' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'master-addons' ),
				'condition' => [
					'ma_el_image_popup_type'      => 'content',
					'ma_el_image_hover_link_type' => 'popup'
				],
			]
		);

		$this->add_control(
			'popup_saved_widget',
			[
				'label'     => __('Choose Widget', 'master-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => Master_Addons_Helper::get_page_template_options('widget'),
				'default'   => '-1',
				'condition' => [
					'ma_el_image_popup_type'      => 'widget',
					'ma_el_image_hover_link_type' => 'popup'
				],
				'conditions'        => [
					'terms' => [
						[
							'name'     => 'ma_el_image_popup_type',
							'operator' => '==',
							'value'    => 'widget',
						],
					],
				],
			]
		);

		$this->add_control(
			'popup_saved_section',
			[
				'label'     => __('Choose Section', 'master-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => Master_Addons_Helper::get_page_template_options('section'),
				'default'   => '-1',
				'condition' => [
					'ma_el_image_popup_type'      => 'section',
					'ma_el_image_hover_link_type' => 'popup'
				],
				'conditions'        => [
					'terms' => [
						[
							'name'     => 'ma_el_image_popup_type',
							'operator' => '==',
							'value'    => 'section',
						],
					],
				],
			]
		);

		$this->add_control(
			'popup_templates',
			[
				'label'     => __('Choose Template', 'master-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => Master_Addons_Helper::get_page_template_options('page'),
				'default'   => '-1',
				'condition' => [
					'ma_el_image_popup_type'      => 'template',
					'ma_el_image_hover_link_type' => 'popup'
				],
				'conditions'        => [
					'terms' => [
						[
							'name'     => 'ma_el_image_popup_type',
							'operator' => '==',
							'value'    => 'template',
						],
					],
				],
			]
		);



		$this->add_responsive_control(
			'ma_el_main_image_vertical_align',
			[
				'label'     => __('Vertical Align', 'master-addons' ),
				'type'      => Controls_Manager::SELECT,
				'condition' => [
					'ma_el_main_image_height' => 'custom'
				],
				'options'		=> [
					'flex-start' => __('Top', 'master-addons' ),
					'center'     => __('Middle', 'master-addons' ),
					'flex-end'   => __('Bottom', 'master-addons' ),
					'inherit'    => __('Full', 'master-addons' )
				],
				'default'   => 'flex-start',
				'selectors' => [
					'{{WRAPPER}} .jltma-image-hover-effect figure' => 'align-items: {{VALUE}}; -webkit-align-items: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();






		/*
			 * Master Addons: Style Controls
			 */
		$this->start_controls_section(
			'ma_el_main_image_content_heading_section',
			[
				'label' => esc_html__('Heading', 'master-addons' )
			]
		);

		$this->add_control(
			'ma_el_main_image_title',
			[
				'label'       => __('Title', 'master-addons' ),
				'placeholder' => __('Title for this Image', 'master-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => ['active' => true],
				'default'     => __('Master <span>Addons</span>', 'master-addons' ),
				'label_block' => false
			]
		);


		$this->add_control(
			'title_html_tag',
			[
				'label'   => __('HTML Tag', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => Master_Addons_Helper::jltma_title_tags(),
				'default' => 'h2',
			]
		);

		$this->end_controls_section();





		/*
			 * Master Addons: Sub Heading
			 */
		$this->start_controls_section(
			'ma_el_main_image_content_subheading_section',
			[
				'label'     => __('Sub Heading', 'master-addons' ),
				'condition' => [
					"ma_el_main_image_effect"   => [
						"honey",
					]
				]
			]
		);

		$this->add_control(
			'ma_el_main_image_sub_title',
			[
				'label'       => __('Sub Title', 'master-addons' ),
				'placeholder' => __('Sub Title for this Image', 'master-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __('Elementor', 'master-addons' ),
				'label_block' => false
			]
		);


		$this->end_controls_section();





		/*
             * Master Addons: Image Descriptions
             */
		$this->start_controls_section(
			'ma_el_main_image_desc_section',
			[
				'label'     => __('Description', 'master-addons' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					"ma_el_main_image_effect"   => [
						"lily",
						"zoe",
						"sadie",
						"layla",
						"oscar",
						"marley",
						"dexter",
						"sarah",
						"chico",
						"kira",
						"apollo",
						"steve",
						"moses",
						"jazz",
						"ming",
						"lexi",
						"duke",
						"milo",
						"bubba",
						"goliath",
						"selena",
						"roxy",
						"bubba",
						"romeo",
						"ruby"
					]
				]
			]
		);

		$this->add_control(
			'ma_el_main_image_desc',
			[
				'label'       => __('Description', 'master-addons' ),
				'description' => __('Give the description to this banner', 'master-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => ['active' => true],
				'default'     => __('Master Addons gives your website a vibrant and lively style, you would love.', 'master-addons' ),
				'label_block' => true,
				'condition'   => [
					'ma_el_main_image_effect!' => ['julia']
				]

			]
		);


		$this->end_controls_section();


		/*
             * Master Addons: Set 2 Image Descriptions
             */
		$this->start_controls_section(
			'ma_el_main_image_desc_set2_heading',
			[
				'label'       => __('Description', 'master-addons' ),
				'type'        => Controls_Manager::HEADING,
				'description' => __('Write Description Each line', 'master-addons' ),
				'condition'   => [
					'ma_el_main_image_effect' => ['julia']
				]
			]
		);

		$repeater = new Repeater();


		$repeater->add_control(
			'ma_el_main_image_desc_set2',
			[
				'label'   => __('Read More Text', 'master-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => ['active' => true],
				'default' => 'Julia dances in the deep dark',
			]
		);


		$this->add_control(
			'ma_el_main_image_desc_set2_tabs',
			[
				'type'    => Controls_Manager::REPEATER,
				'default' => [
					['ma_el_main_image_desc_set2' => 'Julia dances in the deep dark'],
					['ma_el_main_image_desc_set2' => 'She loves the smell of the ocean'],
					['ma_el_main_image_desc_set2' => 'And dives into the morning light']
				],
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{ma_el_main_image_desc_set2}}'
			]
		);


		$this->end_controls_section();







		/*
			 * Master Addons: Image Hover Social Links
			 */
		$this->start_controls_section(
			'ma_el_main_image_social_link_section',
			[
				'label'     => esc_html__('Social Links', 'master-addons' ),
				'condition' => [
					'ma_el_main_image_effect' => ['zoe', 'hera', 'winston', 'terry', 'phoebe', 'kira']
				]
			]
		);


		/* Icons Dependencies for Styles */

		$this->add_control(
			'ma_el_main_image_icon_heading',
			[
				'label'       => __('Social Icons', 'master-addons' ),
				'type'        => Controls_Manager::HEADING,
				'description' => __('Select Social Icons', 'master-addons' )
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'ma_el_main_image_icon',
			[
				'label'            => esc_html__('Icon', 'master-addons' ),
				'description'      => esc_html__('Please choose an icon from the list.', 'master-addons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fab fa-elementor',
					'library' => 'brand',
				],
				'render_type' => 'template'
			]
		);


		$repeater->add_control(
			'ma_el_main_image_icon_link',
			[
				'label'       => __('Icon Link', 'master-addons' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __('https://master-addons.com', 'master-addons' ),
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => true,
				]
			]
		);

		$this->add_control(
			'ma_el_main_image_icon_tabs',
			[
				'type'    => Controls_Manager::REPEATER,
				'default' => [
					['ma_el_main_image_icon' => 'fab fa-wordpress'],
					['ma_el_main_image_icon' => 'fab fa-facebook'],
					['ma_el_main_image_icon' => 'fab fa-twitter'],
					['ma_el_main_image_icon' => 'fab fa-instagram'],
				],
				'fields'      => $repeater->get_controls(),
				'title_field' => 'Social Icon'
			]
		);


		$this->end_controls_section();



		/*
			 * Image Hover Style Section
			 */
		$this->start_controls_section(
			'ma_el_main_image_hover_style_section',
			[
				'label' => __('Image', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ma_el_main_image_bg_color',
			[
				'label'     => __('Background Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-image-hover-effect figure' => 'background: {{VALUE}};'
				]
			]
		);


		$this->add_control(
			'ma_el_main_image_opacity',
			[
				'label'   => __('Image Opacity', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => .8
				],
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => .1
					]
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-image-hover-effect figure img' => 'opacity: {{SIZE}};'
				]
			]
		);

		$this->add_control(
			'ma_el_main_image_hover_opacity',
			[
				'label'   => __('Hover Opacity', 'master-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1
				],
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => .1
					]
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-image-hover-effect figure:hover img' => 'opacity: {{SIZE}};'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'image_filters',
				'label'    => __('Image Filter', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-image-hover-effect figure img',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'hover_image_filters',
				'label'    => __('Hover Image Filter', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-image-hover-effect figure:hover img'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'ma_el_main_image_border',
				'selector' => '{{WRAPPER}} .jltma-image-hover-effect figure'
			]
		);

		if (ma_el_fs()->can_use_premium_code()) {
			$this->add_responsive_control(
				'ma_el_main_image_border_radius',
				[
					'label'      => __('Border Radius', 'master-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors'  => [
						'{{WRAPPER}} .jltma-image-hover-effect figure' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
		} else {
			$this->add_responsive_control(
				'ma_el_main_image_border_radius',
				[
					'label'   => __('Border Radius', 'master-addons' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', 'master-addons' ),
							'icon'  => 'fa fa-unlock-alt',
						],
					],
					'default'     => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> unlock this Option.</span>'
				]
			);
		}

		if (ma_el_fs()->can_use_premium_code()) {
			$this->add_responsive_control(
				'ma_el_main_image_pading',
				[
					'label'      => __('Padding', 'master-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} .jltma-image-hover-effect figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
		} else {
			$this->add_responsive_control(
				'ma_el_main_image_pading',
				[
					'label'   => __('Padding', 'master-addons' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', 'master-addons' ),
							'icon'  => 'fa fa-unlock-alt',
						],
					],
					'default'     => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> unlock this Option.</span>'
				]
			);
		}


		if (ma_el_fs()->can_use_premium_code()) {
			$this->add_responsive_control(
				'ma_el_main_image_margin',
				[
					'label'      => __('Margin', 'master-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} .jltma-image-hover-effect figure' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
		} else {
			$this->add_responsive_control(
				'ma_el_main_image_margin',
				[
					'label'   => __('Margin', 'master-addons' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', 'master-addons' ),
							'icon'  => 'fa fa-unlock-alt',
						],
					],
					'default'     => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> unlock this Option.</span>'
				]
			);
		}


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'label'    => __('Box Shadow', 'master-addons' ),
				'name'     => 'ma_el_main_image_shadow',
				'selector' => '{{WRAPPER}} .jltma-image-hover-effect figure'
			]
		);
		$this->end_controls_section();



		/*
             * Title Color
             */
		$this->start_controls_section(
			'ma_el_main_image_title_style',
			[
				'label' => __('Title', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ma_el_main_image_title_color',
			[
				'label'  => __('Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1
				],
				'default'   => "#fff",
				'selectors' => [
					'{{WRAPPER}} .jltma-image-hover-effect .jltma-image-hover-title' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'jltma_main_image_border_color',
			[
				'label'     => __('Border Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-image-hover-effect figcaption::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-image-hover-effect figcaption::after'  => 'border-color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_main_image_title_typography',
				'selector' => '{{WRAPPER}} .jltma-image-hover-effect .jltma-image-hover-title',
				'scheme'   => Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'label'    => __('Box Shadow', 'master-addons' ),
				'name'     => 'ma_el_main_image_title_shadow',
				'selector' => '{{WRAPPER}} .jltma-image-hover-title'
			]
		);



		if (ma_el_fs()->can_use_premium_code()) {
			$this->add_responsive_control(
				'ma_el_main_image_title_pading',
				[
					'label'      => __('Padding', 'master-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} .jltma-image-hover-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
		} else {
			$this->add_responsive_control(
				'ma_el_main_image_title_pading',
				[
					'label'   => __('Padding', 'master-addons' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', 'master-addons' ),
							'icon'  => 'fa fa-unlock-alt',
						],
					],
					'default'     => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> unlock this Option.</span>'
				]
			);
		}

		if (ma_el_fs()->can_use_premium_code()) {
			$this->add_responsive_control(
				'ma_el_main_image_title_margin',
				[
					'label'      => __('Margin', 'master-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} .jltma-image-hover-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
		} else {
			$this->add_responsive_control(
				'ma_el_main_image_title_margin',
				[
					'label'   => __('Margin', 'master-addons' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', 'master-addons' ),
							'icon'  => 'fa fa-unlock-alt',
						],
					],
					'default'     => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> unlock this Option.</span>'
				]
			);
		}

		$this->end_controls_section();


		/*
			 * Description Style
			 */


		$this->start_controls_section(
			'ma_el_main_image_desc_style_section',
			[
				'label' => __('Description', 'master-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ma_el_main_image_desc_color',
			[
				'label'  => __('Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_3
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .jltma-image-hover-effect p' => 'color: {{VALUE}};'
				],
			]
		);



		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_main_image_desc_typography',
				'selector' => '{{WRAPPER}} .jltma-image-hover-effect p',
				'scheme'   => Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'label'    => __('Text Shadow', 'master-addons' ),
				'name'     => 'ma_el_main_image_desc_text_shadow',
				'selector' => '{{WRAPPER}} .jltma-image-hover-effect p',
			]
		);

		if (ma_el_fs()->can_use_premium_code()) {
			$this->add_responsive_control(
				'ma_el_main_image_desc_pading',
				[
					'label'      => __('Padding', 'master-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} .jltma-image-hover-effect p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
		} else {
			$this->add_responsive_control(
				'ma_el_main_image_desc_pading',
				[
					'label'   => __('Padding', 'master-addons' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', 'master-addons' ),
							'icon'  => 'fa fa-unlock-alt',
						],
					],
					'default'     => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> unlock this Option.</span>'
				]
			);
		}


		if (ma_el_fs()->can_use_premium_code()) {
			$this->add_responsive_control(
				'ma_el_main_image_desc_margin',
				[
					'label'      => __('Margin', 'master-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} .jltma-image-hover-effect p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);
		} else {
			$this->add_responsive_control(
				'ma_el_main_image_desc_margin',
				[
					'label'   => __('Margin', 'master-addons' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', 'master-addons' ),
							'icon'  => 'fa fa-unlock-alt',
						],
					],
					'default'     => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> unlock this Option.</span>'
				]
			);
		}

		$this->end_controls_section();



		/*
			 * Social Icons Style
			 */

		$this->start_controls_section(
			'ma_el_main_image_icon_hover_style_section',
			[
				'label'     => __('Social Icons', 'master-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ma_el_main_image_effect' => ['zoe', 'hera']
				]
			]
		);

		$this->start_controls_tabs('ma_el_main_image_icon_style_tabs');

		$this->start_controls_tab(
			'ma_el_main_image_icon_style_tab_normal',
			[
				'label' => esc_html__('Normal', 'master-addons' )
			]
		);

		$this->add_control(
			'ma_el_main_image_icon_color',
			[
				'label'  => __('Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_2
				],
				//					'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .jltma-image-hover-effect .jltma-icon-links a' => 'color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ma_el_main_image_icon_style_tab_hover',
			[
				'label' => esc_html__('Hover', 'master-addons' )
			]
		);

		$this->add_control(
			'ma_el_main_image_icon_hover_color',
			[
				'label'  => __('Color', 'master-addons' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_3
				],
				//					'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .jltma-image-hover-effect .jltma-icon-links a:hover' => 'color: {{VALUE}};'
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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/image-hover-effects/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/image-hover-effects-element/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=vWGWzuRKIss" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);
		$this->end_controls_section();



		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'ma_el_section_pro_style_section',
				[
					'label' => esc_html__('Upgrade to Pro', 'master-addons' )
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


	private function render_image($image_id, $settings)
	{
		$image_thumbnail_size = $settings['image_thumbnail_size_size'];
		if ('custom_size' === $image_thumbnail_size) {
			$image_src = Group_Control_Image_Size::get_attachment_image_src($image_id, $image_thumbnail_size, $settings);
		} else {
			$image_src = wp_get_attachment_image_src($image_id, $image_thumbnail_size);
			$image_src = $image_src[0];
		}

		return sprintf('<img src="%s"  class="circled" alt="%s" />', esc_url($image_src), esc_html(get_post_meta($image_id, '_wp_attachment_image_alt', true)));
	}



	protected function render()
	{

		$settings = $this->get_settings_for_display();

		// First 15 Effects
		foreach (array_slice(self::ma_el_image_hover_effects(), 0, 15) as $key => $ma_el_image_hover_value) {
			$ma_el_image_hover_sets = "one";
		}

		// Last 15 Effects
		foreach (array_slice(self::ma_el_image_hover_effects(), 15, 30) as $key => $ma_el_image_hover_value) {
			$ma_el_image_hover_sets = "two";
		}


		$this->add_render_attribute('ma_el_image_hover_effect_wrapper', [
			'class'	=> [
				'jltma-image-hover-effect',
				'jltma-image-hover-effect-' . esc_attr($ma_el_image_hover_sets),
				'jltma-image-hover-effect-' . esc_attr($settings['ma_el_main_image_effect'])
			],
			'id' => 'jltma-image-hover-effect-' . $this->get_id()
		]);


		$this->add_render_attribute('ma_el_image_hover_effect_heading', ['class'	=> 'jltma-image-hover-title']);


		$ma_el_main_image = $this->get_settings_for_display('ma_el_main_image');

		$ma_el_main_image_effect = $settings['ma_el_main_image_effect'];
		$ma_el_main_image_alt    = Control_Media::get_image_alt($settings['ma_el_main_image']);


		// Image Link
		if ($settings['ma_el_image_hover_link_type'] == "links") {
			$this->add_render_attribute('ma_el_image_hover_link', [
				'class' => ['ma-image-hover-read-more'],
				'href'  => esc_url($settings['ma_el_main_image_more_link_url']['url']),
			]);

			if ($settings['ma_el_main_image_more_link_url']['is_external']) {
				$this->add_render_attribute('ma_el_image_hover_link', 'target', '_blank');
			}

			if ($settings['ma_el_main_image_more_link_url']['nofollow']) {
				$this->add_render_attribute('ma_el_image_hover_link', 'rel', 'nofollow');
			}
		}

		// if ($settings['ma_el_main_image']['id'] == "") {
		// 	// echo esc_html__('No Image Selected, Please Upload/Select an Image', 'master-addons' );
		// 	echo Master_Addons_Helper::jltma_custom_message('No Image Selected', 'Please Upload/Select an Image');
		// }

		$hover_effects_main_image     = $settings['ma_el_main_image'];
		$hover_effects_main_image_url = Group_Control_Image_Size::get_attachment_image_src($hover_effects_main_image['id'], 'image_thumbnail_size', $settings);
		if (empty($hover_effects_main_image_url)) {
			$hover_effects_main_image_url = $hover_effects_main_image['url'];
		} else {
			$hover_effects_main_image_url = $hover_effects_main_image_url;
		}
?>

		<div <?php echo $this->get_render_attribute_string('ma_el_image_hover_effect_wrapper'); ?>>

			<figure class="jltma-effect-<?php echo esc_attr($settings['ma_el_main_image_effect']); ?>">

				<?php if (isset($settings['ma_el_main_image']['id']) && $settings['ma_el_main_image']['id'] != "") {
					echo $this->render_image($settings['ma_el_main_image']['id'], $settings);
				} else {
					echo '<img src="' . esc_url($hover_effects_main_image_url) . '" >';
				} ?>

				<figcaption>
					<div class="jltma-image-hover-content">
						<<?php echo tag_escape($settings['title_html_tag']); ?> <?php echo $this->get_render_attribute_string('ma_el_image_hover_effect_heading'); ?>>

							<?php echo $this->parse_text_editor($settings['ma_el_main_image_title']); ?>

							<?php $ma_el_main_image_sub_title = array("honey");
							if (in_array($ma_el_main_image_effect, $ma_el_main_image_sub_title)) { ?>
								<i><?php echo esc_html($settings['ma_el_main_image_sub_title']); ?></i>
							<?php } ?>

						</<?php echo tag_escape($settings['title_html_tag']); ?>>


						<?php
						// Social Icons Sets
						$ma_el_main_image_socials_array = array("hera", "zoe", "winston", "terry", "phoebe", "kira");
						if (in_array($ma_el_main_image_effect, $ma_el_main_image_socials_array)) { ?>
							<p class="jltma-icon-links">
								<?php foreach ($settings['ma_el_main_image_icon_tabs'] as $index => $tab) { ?>
									<a href="<?php echo esc_url_raw($tab['ma_el_main_image_icon_link']['url']); ?>">
										<span><?php Master_Addons_Helper::jltma_fa_icon_picker('fab fa-elementor', 'icon', $tab['ma_el_main_image_icon'], 'ma_el_main_image_icon'); ?></span>
									</a>
								<?php } ?>
							</p>
						<?php } ?>

						<?php
						// Design Specific Descriptions for Set 1
						//if( $settings['ma_el_main_image_effect'] == "julia" ){
						?>
						<?php if (isset($settings['ma_el_main_image_desc_set2_tabs'])) {
							foreach ($settings['ma_el_main_image_desc_set2_tabs'] as $index => $tab) {
								$ma_el_main_image_effect_one_array = array("julia");
								if (in_array($ma_el_main_image_effect, $ma_el_main_image_effect_one_array)) {
						?>
									<p class="jltma-image-hover-desc">
										<?php echo esc_html($tab['ma_el_main_image_desc_set2']); ?>
									</p>
							<?php }
							}
						}
						//		}


						// Design Specific Descriptions for Set 1
						$ma_el_main_image_effect_array = array(
							"goliath", "selena", "apollo", "steve", "moses", "jazz", "ming", "lexi", "duke",
							"lily", "sadie", "oscar", "layla", "marley", "dexter", "sarah", "chico", "hera", "kira", "milo", "roxy", "bubba", "romeo", "ruby"
						);
						if (in_array($ma_el_main_image_effect, $ma_el_main_image_effect_array)) { ?>
							<p class="jltma-image-hover-desc">
								<?php echo htmlspecialchars_decode($settings['ma_el_main_image_desc']); ?>
							</p>
						<?php } ?>

					</div>

					<?php
					$ma_el_main_image_effect_array = array("zoe");
					if (in_array($ma_el_main_image_effect, $ma_el_main_image_effect_array)) { ?>
						<p class="jltma-image-hover-desc">
							<?php echo htmlspecialchars_decode($settings['ma_el_main_image_desc']); ?>
						</p>
					<?php } ?>

					<?php if ($settings['ma_el_image_hover_link_type'] == "links" && $settings['ma_el_main_image_more_link_url']['url'] != "") { ?>

						<a <?php echo $this->get_render_attribute_string('ma_el_image_hover_link'); ?>></a>

					<?php } elseif (ma_el_fs()->can_use_premium_code() && $settings['ma_el_image_hover_link_type'] == "popup") { ?>

						<a data-fancybox data-src="#jltma-image-hover-<?php echo $this->get_id(); ?>" href="javascript:;" data-animation-duration="700" data-animation="fade" data-modal="false" class="jltma-fancybox elementor-clickable ma-image-hover-read-more" aria-label="Fancybox Popup">
						</a>

						<div style="display: none;" id="jltma-image-hover-<?php echo $this->get_id(); ?>">

							<div class="card p-4">
								<div class="card-body">
									<?php
									if ($settings['ma_el_image_popup_type'] == 'content') {

										echo do_shortcode($settings['popup_content']);
									} else if ($settings['ma_el_image_popup_type'] == 'image' && !empty($settings['popup_image']['url'])) {

										echo $this->render_image($settings['popup_image']['id'], $settings);
									} else if ($settings['ma_el_image_popup_type'] == 'section' && !empty($settings['popup_saved_section'])) {

										echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($settings['popup_saved_section']);
									} else if ($settings['ma_el_image_popup_type'] == 'template' && !empty($settings['popup_templates'])) {

										echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($settings['popup_templates']);
									} else if ($settings['ma_el_image_popup_type'] == 'widget' && !empty($settings['popup_saved_widget'])) {

										echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($settings['popup_saved_widget']);
									} ?>
								</div>
							</div>

						</div> <!-- jltma-image-hover -->


					<?php } ?>


				</figcaption>

			</figure>



		</div>
<?php
	}

	protected function content_template()
	{
	}
}
