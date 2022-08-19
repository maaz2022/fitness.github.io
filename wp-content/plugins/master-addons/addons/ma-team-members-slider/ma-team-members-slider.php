<?php

namespace MasterAddons\Addons;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;

use MasterAddons\Inc\Controls\MA_Group_Control_Transition;
use MasterAddons\Inc\Traits\JLTMA_Swiper_Controls;
use MasterAddons\Inc\Helper\Master_Addons_Helper;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Team_Slider extends Widget_Base
{
	use JLTMA_Swiper_Controls;
	public function get_name()
	{
		return 'ma-team-members-slider';
	}

	public function get_title()
	{
		return esc_html__('Team Slider', 'master-addons' );
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-person';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_keywords()
	{
		return [
			'team',
			'members',
			'carousel',
			'slider',
			'team members',
			'team scroll',
			'team members slider',
			'person slider'
		];
	}

	public function get_script_depends()
	{
		return [
			'swiper',
			'gridder',
			'master-addons-scripts'
		];
	}

	public function get_style_depends()
	{
		return [
			'gridder',
			'font-awesome-5-all',
			'font-awesome-4-shim'
		];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/team-carousel/';
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'section_team_carousel',
			[
				'label' => esc_html__('Contents', 'master-addons' ),
			]
		);


		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {
			$this->add_control(
				'ma_el_team_carousel_preset',
				[
					'label' => esc_html__('Style Preset', 'master-addons' ),
					'type' => Controls_Manager::SELECT,
					'default' => '-default',
					'options' => [
						'-default'              => __('Team Carousel', 'master-addons' ),
						'-circle'               => __('Circle Gradient', 'master-addons' ),
						'-circle-animation'     => __('Circle Animation', 'master-addons' ),
						'-social-left'          => __('Social Left on Hover', 'master-addons' ),
						'-content-hover'        => __('Content on Hover', 'master-addons' ),
						'-content-drawer'       => __('Content Drawer', 'master-addons' ),
					],
					'frontend_available' 	=> true,
				]
			);
		} else {
			$this->add_control(
				'ma_el_team_carousel_preset',
				[
					'label' 					=> __('Style Preset', 'master-addons' ),
					'type' 						=> Controls_Manager::SELECT,
					'default' 					=> '-default',
					'options' => [
						'-default'                    => __('Team Carousel', 'master-addons' ),
						'-circle'                     => __('Circle Gradient', 'master-addons' ),
						'-content-hover'              => __('Content on Hover', 'master-addons' ),
						'-pro-team-slider-1'          => __('Social Left on Hover (Pro)', 'master-addons' ),
						'-pro-team-slider-2'          => __('Content Drawer (Pro)', 'master-addons' ),
						'-pro-team-slider-3'          => __('Circle Animation (Pro)', 'master-addons' )
					],
					'frontend_available' 		=> true,
					'description' 				=> sprintf(
						'5+ more Variations on <a href="%s" target="_blank">%s</a>',
						esc_url_raw(admin_url('admin.php?page=master-addons-settings-pricing')),
						__('Upgrade Now', 'master-addons' )
					)
				]
			);
		}



		if (ma_el_fs()->can_use_premium_code()) {
			$this->add_control(
				'ma_el_team_circle_image',
				[
					'label' => esc_html__('Circle Gradient Image', 'master-addons' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'circle_01',
					'options' => [
						'circle_01'                   => esc_html__('Circle 01', 'master-addons' ),
						'circle_02'                   => esc_html__('Circle 02', 'master-addons' ),
						'circle_03'                   => esc_html__('Circle 03', 'master-addons' ),
						'circle_04'                   => esc_html__('Circle 04', 'master-addons' ),
						'circle_05'                   => esc_html__('Circle 05', 'master-addons' ),
						'circle_06'                   => esc_html__('Circle 06', 'master-addons' ),
						'circle_07'                   => esc_html__('Circle 07', 'master-addons' ),
					],
					'condition' => [
						'ma_el_team_carousel_preset' => '-circle'
					]
				]
			);
		} else {
			$this->add_control(
				'ma_el_team_circle_image',
				[
					'label' => esc_html__('Circle Gradient Image', 'master-addons' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'circle_01',
					'options' => [
						'circle_01'                   	 => esc_html__('Circle 01', 'master-addons' ),
						'circle_02'                   	 => esc_html__('Circle 02', 'master-addons' ),
						'circle_03'                   	 => esc_html__('Circle 03', 'master-addons' ),
						'circle-pro-1'                   => esc_html__('Circle 04 (Pro)', 'master-addons' ),
						'circle-pro-2'                   => esc_html__('Circle 05 (Pro)', 'master-addons' ),
						'circle-pro-3'                   => esc_html__('Circle 06 (Pro)', 'master-addons' ),
						'circle-pro-4'                   => esc_html__('Circle 07 (Pro)', 'master-addons' ),
					],
					'condition' => [
						'ma_el_team_carousel_preset' => '-circle'
					],
					'description' => '<span class="pro-feature">Animated Variations are Pro Features. Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> unlock this Option.</span>'
				]
			);
		}


		// Premium Version Codes
		if (!ma_el_fs()->can_use_premium_code()) {
			$this->add_control(
				'ma_el_team_circle_image_animation',
				[
					'label'       => esc_html__('Animation Style', 'master-addons' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'animation_svg_01',
					'options'     => [
						'animation_svg_01' 		=> esc_html__('Animation 1', 'master-addons' ),
						'animation_svg_02' 		=> esc_html__('Animation 2', 'master-addons' ),
						'animation_svg_03' 		=> esc_html__('Animation 3', 'master-addons' ),
						'svg_animated_pro_1' 	=> esc_html__('Animation 4 (Pro)', 'master-addons' ),
						// 'svg_animated_pro_2' 	=> esc_html__('Animation 5 (Pro)', 'master-addons' ),
						// 'svg_animated_pro_3' 	=> esc_html__('Animation 6 (Pro)', 'master-addons' ),
						// 'svg_animated_pro_4' 	=> esc_html__('Animation 7 (Pro)', 'master-addons' ),
					],
					'condition'   => [
						'ma_el_team_carousel_preset' => '-circle-animation'
					],
					'description' => sprintf(
						'5+ More Animated Variations Available on Pro Version <a href="%s" target="_blank">%s</a>',
						esc_url_raw(admin_url('admin.php?page=master-addons-settings-pricing')),
						__('Upgrade Now', 'master-addons' )
					)
				]
			);
		} else {
			$this->add_control(
				'ma_el_team_circle_image_animation',
				[
					'label'       => esc_html__('Animation Style', 'master-addons' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'animation_svg_01',
					'options'     => [
						'animation_svg_01' => esc_html__('Animation 1', 'master-addons' ),
						'animation_svg_02' => esc_html__('Animation 2', 'master-addons' ),
						'animation_svg_03' => esc_html__('Animation 3', 'master-addons' ),
						'animation_svg_04' => esc_html__('Animation 4', 'master-addons' ),
						// 'animation_svg_05' => esc_html__('Animation 5', 'master-addons' ),
						// 'animation_svg_06' => esc_html__('Animation 6', 'master-addons' ),
						// 'animation_svg_07' => esc_html__('Animation 7', 'master-addons' ),
					],
					'condition'   => [
						'ma_el_team_carousel_preset' => '-circle-animation'
					]
				]
			);
		}



		$team_repeater = new Repeater();

		/*
			* Team Member Image
			*/
		$team_repeater->add_control(
			'ma_el_team_carousel_image',
			[
				'label' => __('Image', 'master-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'selectors' => [
					// '{{WRAPPER}} .jltma-team-member-circle-animation .jltma-team-member-thumb .animation_svg_02:after' => 'background-image: url("{{URL}}");'
				]

			]
		);
		$team_repeater->add_control(
			'ma_el_team_carousel_name',
			[
				'label' => esc_html__('Name', 'master-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('John Doe', 'master-addons' ),
			]
		);

		$team_repeater->add_control(
			'ma_el_team_carousel_designation',
			[
				'label' => esc_html__('Designation', 'master-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('My Designation', 'master-addons' ),
			]
		);

		$team_repeater->add_control(
			'ma_el_team_carousel_description',
			[
				'label' => esc_html__('Description', 'master-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Add team member details here', 'master-addons' ),
			]
		);

		$team_repeater->add_control(
			'ma_el_team_carousel_enable_social_profiles',
			[
				'label' => esc_html__('Display Social Profiles?', 'master-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$team_repeater->add_control(
			'ma_el_team_carousel_facebook_link',
			[
				'label' => __('Facebook URL', 'master-addons' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'ma_el_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __('https://master-addons.com', 'master-addons' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$team_repeater->add_control(
			'ma_el_team_carousel_twitter_link',
			[
				'label' => __('Twitter URL', 'master-addons' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'ma_el_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __('https://master-addons.com', 'master-addons' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$team_repeater->add_control(
			'ma_el_team_carousel_instagram_link',
			[
				'label' => __('Instagram URL', 'master-addons' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'ma_el_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __('https://master-addons.com', 'master-addons' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$team_repeater->add_control(
			'ma_el_team_carousel_linkedin_link',
			[
				'label' => __('Linkedin URL', 'master-addons' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'ma_el_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __('https://master-addons.com', 'master-addons' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$team_repeater->add_control(
			'ma_el_team_carousel_dribbble_link',
			[
				'label' => __('Dribbble URL', 'master-addons' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'ma_el_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __('https://master-addons.com', 'master-addons' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);
		$team_repeater->add_control(
			'ma_el_team_carousel_tiktok_link',
			[
				'label' => __('Tiktok URL', 'master-addons' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'ma_el_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __('https://master-addons.com', 'master-addons' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);
		$team_repeater->add_control(
			'ma_el_team_carousel_youtube_link',
			[
				'label' => __('Youtube URL', 'master-addons' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'ma_el_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __('https://master-addons.com', 'master-addons' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);
		$team_repeater->add_control(
			'ma_el_team_carousel_email_link',
			[
				'label' => __('Email', 'master-addons' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'ma_el_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __('hello@master-addons.com', 'master-addons' ),
				'label_block' => true,
				'default' => '',
			]
		);

		$this->add_control(
			'team_carousel_repeater',
			[
				'label' => esc_html__('Team Carousel', 'master-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $team_repeater->get_controls(),
				'title_field' => '{{{ ma_el_team_carousel_name }}}',
				'default' => [
					[
						'ma_el_team_carousel_name' => __('Member #1', 'master-addons' ),
						'ma_el_team_carousel_description' => __('Add team member details here', 'master-addons' ),
					],
					[
						'ma_el_team_carousel_name' => __('Member #2', 'master-addons' ),
						'ma_el_team_carousel_description' => __('Add team member details here', 'master-addons' ),
					],
					[
						'ma_el_team_carousel_name' => __('Member #3', 'master-addons' ),
						'ma_el_team_carousel_description' => __('Add team member details here', 'master-addons' ),
					],
					[
						'ma_el_team_carousel_name' => __('Member #4', 'master-addons' ),
						'ma_el_team_carousel_description' => __('Add team member details here', 'master-addons' ),
					],
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full'
			]
		);
		$this->add_control(
			'team_carousel_image_border_switch',
			[
				'label' => esc_html__('Image Border?', 'master-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'team_carousel_image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'master-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => [
					'top'    => 60,
					'right'  => 60,
					'bottom' => 60,
					'left'   => 60,
					'unit'   => 'px'
				],
				'condition' => [
					'team_carousel_image_border_switch' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'   => __('Title HTML Tag', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => Master_Addons_Helper::jltma_title_tags(),
				'default' => 'h3',
			]
		);


		$this->end_controls_section();

		/*
			* Team Members Styling Section
			*/
		$this->start_controls_section(
			'ma_el_section_team_carousel_styles_preset',
			[
				'label' => esc_html__('General Styles', 'master-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'ma_el_team_image_bg_size',
			[
				'label' => __('Background Image Size', 'master-addons' ),
				'description' => __('Height Width will be same ratio', 'master-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'    => ['px'],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
						'step' => 5,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 125,
				],
				'condition' => [
					'ma_el_team_carousel_preset' => ['-circle', '-circle-animation']
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-circle .jltma-team-member-thumb svg,
						{{WRAPPER}} .jltma-team-member-circle .jltma-team-member-thumb,
						{{WRAPPER}} .jltma-team-member-circle-animation .jltma-team-member-thumb svg,
						{{WRAPPER}} .jltma-team-member-circle-animation .jltma-team-member-thumb .animation_svg_02,
						{{WRAPPER}} .jltma-team-member-circle-animation .jltma-team-member-thumb .animation_svg_03,
						{{WRAPPER}} .jltma-team-member-circle-animation .jltma-team-member-thumb' =>
					'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};'

				]
			]
		);

		$this->add_responsive_control(
			'ma_el_team_image_bg_position_left',
			[
				'label' => __('Background Position(Left)', 'master-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'default' => [
					'unit' => 'px',
					'size' => -5,
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 150,
						'step' => 1,
					]
				],
				'condition' => [
					'ma_el_team_carousel_preset' => ['-circle', '-circle-animation']
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-circle .jltma-team-member-thumb svg,
						{{WRAPPER}} .jltma-team-member-circle-animation .jltma-team-member-thumb svg' => 'left: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_team_image_bg_position_top',
			[
				'label' => __('Background Position(Top)', 'master-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
						'step' => 1,
					]
				],
				'condition' => [
					'ma_el_team_carousel_preset' => ['-circle', '-circle-animation']
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-circle .jltma-team-member-thumb svg,
						{{WRAPPER}} .jltma-team-member-circle-animation .jltma-team-member-thumb svg' => 'top: {{SIZE}}{{UNIT}};'
				]
			]
		);


		$this->add_responsive_control(
			'ma_el_team_image_size',
			[
				'label' => __('Member Image Size', 'master-addons' ),
				'description' => __('Height Width will be same ratio', 'master-addons' ),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'before',
				'size_units'    => ['px'],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'condition' => [
					'ma_el_team_carousel_preset' => ['-circle', '-circle-animation']
				],
				'selectors' => [
					//						'{{WRAPPER}} .jltma-team-member-circle .jltma-team-member-thumb' =>
					//                            'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}} .jltma-team-member-circle .jltma-team-member-thumb img,
						{{WRAPPER}} .jltma-team-member-circle-animation .jltma-team-member-thumb .animation_svg_03_center,
						{{WRAPPER}} .jltma-team-member-circle-animation .jltma-team-member-thumb img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',

					//						'{{WRAPPER}} .jltma-team-member-circle .jltma-team-member-thumb svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',

				]
			]
		);


		$this->add_responsive_control(
			'ma_el_team_image_position_left',
			[
				'label' => __('Member Image Position(Left)', 'master-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'default' => [
					'unit' => '%',
					'size' => 45,
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 150,
						'step' => 1,
					]
				],
				'condition' => [
					'ma_el_team_carousel_preset' => ['-circle', '-circle-animation']
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-circle .jltma-team-member-thumb img,
						{{WRAPPER}} .jltma-team-member-circle-animation .jltma-team-member-thumb img' => 'left: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_team_image_position_top',
			[
				'label' => __('Member Image Position(Top)', 'master-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'em'],
				'default' => [
					'unit' => '%',
					'size' => 45,
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 150,
						'step' => 1,
					]
				],
				'condition' => [
					'ma_el_team_carousel_preset' => ['-circle', '-circle-animation']
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-circle .jltma-team-member-thumb img,
						{{WRAPPER}} .jltma-team-member-circle-animation .jltma-team-member-thumb img' => 'top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'ma_el_team_carousel_avatar_bg',
			[
				'label' => esc_html__('Avatar Background Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#826EFF',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-circle .jltma-team-member-thumb svg.team-avatar-bg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'ma_el_team_carousel_preset' => '-circle',
				],
			]
		);

		$this->add_control(
			'ma_el_team_carousel_bg',
			[
				'label' => esc_html__('Background Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f9f9f9',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-basic,
						{{WRAPPER}} .jltma-team-member-circle,
						{{WRAPPER}} .jltma-team-member-social-left,
						{{WRAPPER}} .jltma-team-carousel-wrapper,
						{{WRAPPER}} .swiper-container-fade .swiper-slide,
						{{WRAPPER}} .jltma-team-member-rounded' => 'background: {{VALUE}};',
					'{{WRAPPER}} .gridder .gridder-show' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} #animation_svg_04 circle' => 'fill: {{VALUE}}'
				],
			]
		);


		$this->add_control(
			'ma_el_team_carousel_content_align',
			[
				'label'         => __('Content Alignment', 'master-addons' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => Master_Addons_Helper::jltma_content_alignment(),
				'default'       => 'left',
				'selectors'     => [
					'{{WRAPPER}} .jltma-team-member-content' => 'text-align: {{VALUE}};',
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
							'name'     => 'ma_el_team_carousel_preset',
							'operator' => '!=',
							'value'    => '-content-drawer',
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
		$this->jltma_swiper_navigation_style_controls('team-carousel');


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



		/*
		Style Tab: Name
		*/
		$this->start_controls_section(
			'section_team_carousel_name',
			[
				'label' => __('Name', 'master-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ma_el_title_color',
			[
				'label' => __('Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .jltma-team-member-name',
			]
		);
		$this->add_control(
			'ma_el_title_margins',
			[
				'label' => esc_html__('Margin', 'master-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'placeholder' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-name ' => 'display:block;margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_team_member_designation',
			[
				'label' => __('Designation', 'master-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ma_el_designation_color',
			[
				'label' => __('Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-designation' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'designation_typography',
				'selector' => '{{WRAPPER}} .jltma-team-member-designation',
			]
		);
		$this->add_control(
			'ma_el_designation_margins',
			[
				'label' => esc_html__('Margin', 'master-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'placeholder' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-designation ' => 'display:block;margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_team_carousel_description',
			[
				'label' => __('Description', 'master-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ma_el_description_color',
			[
				'label' => __('Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-about,
						{{WRAPPER}} .gridder-expanded-content p.jltma-team-member-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ma_el_description_typography',
				'selector' => '{{WRAPPER}} .jltma-team-member-about',
			]
		);
		$this->add_control(
			'ma_el_description_margins',
			[
				'label' => esc_html__('Margin', 'master-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'placeholder' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-about ' => 'display:block;margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$this->jltma_swiper_item_style_controls('team-carousel');


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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/team-carousel/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/team-members-carousel/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
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




		$this->start_controls_section(
			'ma_el_team_carousel_social_section',
			[
				'label' => __('Social', 'master-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ma_el_team_carousel_preset' => ['-social-left', '-default'],
				],
			]
		);

		$this->start_controls_tabs('ma_el_team_carousel_social_icons_style_tabs');

		$this->start_controls_tab(
			'ma_el_team_carousel_social_icon_control',
			['label' => esc_html__('Normal', 'master-addons' )]
		);

		$this->add_control(
			'ma_el_team_carousel_social_icon_color',
			[
				'label' => esc_html__('Icon Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-social li a' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'ma_el_team_carousel_social_color_1',
			[
				'label' => esc_html__('Background Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#2231DD',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-social li a' => 'background: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ma_el_team_carousel_social_icon_hover_control',
			['label' => esc_html__('Hover', 'master-addons' )]
		);

		$this->add_control(
			'ma_el_team_carousel_social_icon_hover_color',
			[
				'label' => esc_html__('Icon Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-social li a:hover' => 'color: {{VALUE}} !important;'
				],
			]
		);


		$this->add_control(
			'ma_el_team_carousel_social_hover_bg_color_1',
			[
				'label' => esc_html__('Background Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#DA0971',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-social li a:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'ma_el_section_pro_style_section',
				[
					'label' => esc_html__('Upgrade to Pro for More Features', 'master-addons' ),
					'tab' => Controls_Manager::TAB_STYLE
				]
			);

			$this->add_control(
				'ma_el_control_get_pro_style_tab',
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
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with
Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$team_carousel_classes = $this->get_settings_for_display('ma_el_team_carousel_image_rounded');

		$team_preset = $settings['ma_el_team_carousel_preset'];

		$unique_id 	= implode('-', [$this->get_id(), get_the_ID()]);

		$this->add_render_attribute([
			'ma_el_team_carousel' => [
				'class' => [
					'jltma-team-carousel-wrapper',
					'jltma-team-carousel' . esc_attr($team_preset),
					'jltma-carousel',
					'jltma-swiper',
					'jltma-swiper__container',
					'swiper-container',
					'elementor-jltma-element-' . esc_attr($unique_id)
				],
				'data-jltma-template-widget-id' => esc_attr($unique_id)
			],
			'swiper-wrapper' => [
				'class' => [
					'jltma-team-carousel',
					'jltma-swiper__wrapper',
					'swiper-wrapper',
				],
			],

			'swiper-item' => [
				'class' => [
					'jltma-slider__item',
					'jltma-swiper__slide',
					'swiper-slide',
					'jltma-team-carousel' . esc_attr($team_preset) . '-inner'
				],
			],
		]);


		$this->add_render_attribute(
			'ma_el_team_slider_section',
			[
				'class' => 'jltma-team-carousel-wrapper',
				'data-team-preset' => $team_preset,
			]
		);

		$image_size = $settings['thumbnail_size'];
		if (($image_size == 'custom') || is_array($image_size)) {
			$image_size = array_values($settings['thumbnail_custom_dimension']);
		}

?>



		<?php if ($team_preset == '-content-drawer') { ?>

			<div <?php echo $this->get_render_attribute_string('ma_el_team_slider_section'); ?>>
				<!-- Gridder navigation -->
				<ul class="gridder">

					<?php

					foreach ($settings['team_carousel_repeater'] as $key => $member) {

						$team_carousel_image = $member['ma_el_team_carousel_image'];
					?>

						<li class="gridder-list" data-griddercontent="#jltma-team<?php echo esc_attr($key) + 1; ?>">
							<?php
							echo wp_get_attachment_image(
								$team_carousel_image['id'],
								$image_size,
								false,
								[
									'class' => 'team-slider-image',
									'alt' => esc_attr($member['ma_el_team_carousel_name']),
								]
							);
							?>
							<div class="jltma-team-drawer-hover-content">

								<<?php echo tag_escape($settings['title_html_tag']); ?> class="jltma-team-member-name">
									<?php echo esc_html($member['ma_el_team_carousel_name']); ?>
								</<?php echo tag_escape($settings['title_html_tag']); ?>>

								<span class="jltma-team-member-designation">
									<?php echo esc_html($member['ma_el_team_carousel_designation']); ?>
								</span>
							</div>
						</li>

					<?php } ?>
				</ul>

				<!-- Gridder content -->
				<?php foreach ($settings['team_carousel_repeater'] as $key => $member) { ?>

					<div id="jltma-team<?php echo esc_attr($key) + 1; ?>" class="gridder-content">
						<div class="jltma-content-left">
							<span class="jltma-team-member-designation">
								<?php echo esc_html($member['ma_el_team_carousel_designation']); ?>
							</span>
							<<?php echo esc_attr($settings['title_html_tag']); ?> class="jltma-team-member-name">
								<?php echo $this->parse_text_editor($member['ma_el_team_carousel_name']); ?>
							</<?php echo esc_attr($settings['title_html_tag']); ?>>
							<p class="jltma-team-member-desc">
								<?php echo $this->parse_text_editor($member['ma_el_team_carousel_description']); ?>
							</p>
						</div>

						<div class="jltma-content-right">
							<?php if ($member['ma_el_team_carousel_enable_social_profiles'] == 'yes') : ?>
								<ul class="list-inline jltma-team-member-social">

									<?php if (!empty($member['ma_el_team_carousel_facebook_link']['url'])) : ?>
										<?php $target = $member['ma_el_team_carousel_facebook_link']['is_external'] ? ' target="_blank"' : ''; ?>
										<li>
											<a href="<?php echo esc_url($member['ma_el_team_carousel_facebook_link']['url']); ?>" <?php echo esc_attr($target); ?>><i class="fa fa-facebook"></i></a>
										</li>
									<?php endif; ?>

									<?php if (!empty($member['ma_el_team_carousel_twitter_link']['url'])) : ?>
										<?php $target = $member['ma_el_team_carousel_twitter_link']['is_external'] ? ' target="_blank"' : ''; ?>
										<li>
											<a href="<?php echo esc_url($member['ma_el_team_carousel_twitter_link']['url']); ?>" <?php echo esc_attr($target); ?>><i class="fa fa-twitter"></i></a>
										</li>
									<?php endif; ?>

									<?php if (!empty($member['ma_el_team_carousel_instagram_link']['url'])) : ?>
										<?php $target = $member['ma_el_team_carousel_instagram_link']['is_external'] ?
											' target="_blank"' : ''; ?>
										<li>
											<a href="<?php echo esc_url($member['ma_el_team_carousel_instagram_link']['url']); ?>" <?php echo esc_attr($target); ?>><i class="fa fa-instagram"></i></a>
										</li>
									<?php endif; ?>

									<?php if (!empty($member['ma_el_team_carousel_linkedin_link']['url'])) : ?>
										<?php $target = $member['ma_el_team_carousel_linkedin_link']['is_external'] ? ' target="_blank"' : ''; ?>
										<li>
											<a href="<?php echo esc_url($member['ma_el_team_carousel_linkedin_link']['url']); ?>" <?php echo esc_attr($target); ?>><i class="fa fa-linkedin"></i></a>
										</li>
									<?php endif; ?>

									<?php if (!empty($member['ma_el_team_carousel_dribbble_link']['url'])) : ?>
										<?php $target = $member['ma_el_team_carousel_dribbble_link']['is_external'] ? ' target="_blank"' : ''; ?>
										<li>
											<a href="<?php echo esc_url($member['ma_el_team_carousel_dribbble_link']['url']); ?>" <?php echo esc_attr($target); ?>><i class="fa fa-dribbble"></i></a>
										</li>
									<?php endif; ?>

									<?php if (!empty($member['ma_el_team_carousel_tiktok_link']['url'])) : ?>
										<?php $target = $member['ma_el_team_carousel_tiktok_link']['is_external'] ? ' target="_blank"' : ''; ?>
										<li>
											<a href="<?php echo esc_url($member['ma_el_team_carousel_tiktok_link']['url']); ?>" <?php echo esc_attr($target); ?>><i class="fab fa-tiktok"></i></a>
										</li>
									<?php endif; ?>

									<?php if (!empty($member['ma_el_team_carousel_youtube_link']['url'])) : ?>
										<?php $target = $member['ma_el_team_carousel_youtube_link']['is_external'] ? ' target="_blank"' : ''; ?>
										<li>
											<a href="<?php echo esc_url($member['ma_el_team_carousel_youtube_link']['url']); ?>" <?php echo esc_attr($target); ?>><i class="fa fa-youtube"></i></a>
										</li>
									<?php endif; ?>

									<?php if (!empty($member['ma_el_team_carousel_email_link'])) : ?>
										<li>
											<a href="mailto:<?php echo esc_attr($member['ma_el_team_carousel_email_link']); ?>"><i class="fa fa-envelope"></i></a>
										</li>
									<?php endif; ?>

								</ul>
							<?php endif; ?>
						</div>
					</div>
				<?php } ?>

			</div>

		<?php } else {

			//Global Header Function
			$this->jltma_render_swiper_header_attribute('team-carousel');
			$this->add_render_attribute('carousel', 'class', ['jltma-team-carousel-slider']);
		?>

			<div <?php echo $this->get_render_attribute_string('carousel'); ?>>
				<div <?php echo $this->get_render_attribute_string('ma_el_team_carousel'); ?>>
					<div <?php echo $this->get_render_attribute_string('swiper-wrapper'); ?>>
						<?php foreach ($settings['team_carousel_repeater'] as $key => $member) {
							$team_carousel_image = $member['ma_el_team_carousel_image'];
							$image_id = $team_carousel_image['id'];
						?>

							<div <?php echo $this->get_render_attribute_string('swiper-item'); ?>>
								<div class="jltma-team-member<?php echo esc_attr($team_preset); ?> text-center">
									<div class="jltma-team-member-thumb">
										<?php
										// if( $team_preset == '-circle' && isset( $settings['ma_el_team_circle_image'] ) && !isset( $settings['ma_el_team_circle_image_animation'] )) {
										if ($team_preset == '-circle' && isset($settings['ma_el_team_circle_image'])) {
											$file_path =  JLTMA_PATH . '/assets/images/circlesvg/' . esc_attr($settings['ma_el_team_circle_image']) . '.svg';
											echo file_get_contents($file_path);
											echo wp_get_attachment_image(
												$image_id,
												$image_size,
												false,
												[
													'class' => 'team-slider-image',
													'alt' => esc_attr($member['ma_el_team_carousel_name']),
												]
											);
										} elseif ($team_preset == '-circle-animation' && isset($settings['ma_el_team_circle_image_animation'])) {

											if ($settings['ma_el_team_circle_image_animation'] == "animation_svg_02") {

												echo '<div class="animation_svg_02">'.wp_get_attachment_image(
													$image_id,
													$image_size,
													false,
													[
														'class' => 'team-slider-image',
														'alt' => esc_attr($member['ma_el_team_carousel_name']),
													]
												).'</div>';
											} elseif ($settings['ma_el_team_circle_image_animation'] == "animation_svg_03") {

												echo '<div class="animation_svg_03"></div><div class="animation_svg_03"></div><div class="animation_svg_03"></div><div class="animation_svg_03_center">'.wp_get_attachment_image(
													$image_id,
													$image_size,
													false,
													[
														'class' => 'team-slider-image',
														'alt' => esc_attr($member['ma_el_team_carousel_name']),
													]
												).'</div>';
											} else {

												$file_path =  JLTMA_PATH . '/assets/images/animation/' .
													$settings['ma_el_team_circle_image_animation'] . '.svg';
												echo file_get_contents($file_path);
												echo wp_get_attachment_image(
													$image_id,
													$image_size,
													false,
													[
														'class' => 'team-slider-image',
														'alt' => esc_attr($member['ma_el_team_carousel_name']),
													]
												);
											}
										} else {
											echo wp_get_attachment_image(
												$image_id,
												$image_size,
												false,
												[
													'class' => 'team-slider-image',
													'alt' => esc_attr($member['ma_el_team_carousel_name']),
												]
											);
										} ?>

									</div>
									<div class="jltma-team-member-content">
										<<?php echo esc_attr($settings['title_html_tag']); ?> class="jltma-team-member-name">
											<?php echo $this->parse_text_editor($member['ma_el_team_carousel_name']);
											?>
										</<?php echo esc_attr($settings['title_html_tag']); ?>>
										<span class="jltma-team-member-designation">
											<?php echo $this->parse_text_editor($member['ma_el_team_carousel_designation']); ?>
										</span>
										<p class="jltma-team-member-about">
											<?php echo $this->parse_text_editor($member['ma_el_team_carousel_description']); ?>
										</p>
										<?php if ($member['ma_el_team_carousel_enable_social_profiles'] == 'yes') : ?>
											<ul class="list-inline jltma-team-member-social">

												<?php if (!empty($member['ma_el_team_carousel_facebook_link']['url'])) : ?>
													<?php $target = $member['ma_el_team_carousel_facebook_link']['is_external'] ? ' target="_blank"' : ''; ?>
													<li>
														<a href="<?php echo esc_url($member['ma_el_team_carousel_facebook_link']['url']); ?>" <?php echo esc_attr($target); ?>><i class="fa fa-facebook"></i></a>
													</li>
												<?php endif; ?>

												<?php if (!empty($member['ma_el_team_carousel_twitter_link']['url'])) : ?>
													<?php $target = $member['ma_el_team_carousel_twitter_link']['is_external'] ? ' target="_blank"' : ''; ?>
													<li>
														<a href="<?php echo esc_url($member['ma_el_team_carousel_twitter_link']['url']); ?>" <?php echo esc_attr($target); ?>><i class="fa fa-twitter"></i></a>
													</li>
												<?php endif; ?>

												<?php if (!empty($member['ma_el_team_carousel_instagram_link']['url'])) : ?>
													<?php $target = $member['ma_el_team_carousel_instagram_link']['is_external'] ?
														' target="_blank"' : ''; ?>
													<li>
														<a href="<?php echo esc_url(
																		$member['ma_el_team_carousel_instagram_link']['url']
																	); ?>" <?php echo esc_attr($target); ?>><i class="fa fa-instagram"></i></a>
													</li>
												<?php endif; ?>

												<?php if (!empty($member['ma_el_team_carousel_linkedin_link']['url'])) : ?>
													<?php $target = $member['ma_el_team_carousel_linkedin_link']['is_external'] ? ' target="_blank"' : ''; ?>
													<li>
														<a href="<?php echo esc_url($member['ma_el_team_carousel_linkedin_link']['url']); ?>" <?php echo esc_attr($target); ?>><i class="fa fa-linkedin"></i></a>
													</li>
												<?php endif; ?>

												<?php if (!empty($member['ma_el_team_carousel_dribbble_link']['url'])) : ?>
													<?php $target = $member['ma_el_team_carousel_dribbble_link']['is_external'] ? ' target="_blank"' : ''; ?>
													<li>
														<a href="<?php echo esc_url($member['ma_el_team_carousel_dribbble_link']['url']); ?>" <?php echo esc_attr($target); ?>><i class="fa fa-dribbble"></i></a>
													</li>
												<?php endif; ?>

												<?php if (!empty($member['ma_el_team_carousel_tiktok_link']['url'])) : ?>
													<?php $target = $member['ma_el_team_carousel_tiktok_link']['is_external'] ? ' target="_blank"' : ''; ?>
													<li>
														<a href="<?php echo esc_url($member['ma_el_team_carousel_tiktok_link']['url']); ?>" <?php echo esc_attr($target); ?>><i class="fab fa-tiktok"></i></a>
													</li>
												<?php endif; ?>

												<?php if (!empty($member['ma_el_team_carousel_youtube_link']['url'])) : ?>
													<?php $target = $member['ma_el_team_carousel_youtube_link']['is_external'] ? ' target="_blank"' : ''; ?>
													<li>
														<a href="<?php echo esc_url($member['ma_el_team_carousel_youtube_link']['url']); ?>" <?php echo esc_attr($target); ?>><i class="fa fa-youtube"></i></a>
													</li>
												<?php endif; ?>

												<?php if (!empty($member['ma_el_team_carousel_email_link'])) : ?>
													<li>
														<a href="mailto:<?php echo esc_attr($member['ma_el_team_carousel_email_link']); ?>"><i class="fa fa-envelope"></i></a>
													</li>
												<?php endif; ?>

											</ul>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php } // repeater loop end
						?>
					</div> <!-- swiper-wrapper -->

				</div>

				<?php $this->render_swiper_navigation(); ?>

				<?php if ('yes' === $settings['show_scrollbar']) { ?>
					<div class="swiper-scrollbar"></div>
				<?php } ?>


			<?php } // carousel layout
			?>
			</div>


	<?php
	}
}
