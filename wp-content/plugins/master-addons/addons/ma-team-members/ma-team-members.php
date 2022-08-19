<?php

namespace MasterAddons\Addons;

use \Elementor\Widget_Base;
use \Elementor\Controls_Stack;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Utils;
use MasterAddons\Inc\Helper\Master_Addons_Helper;
use \Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Team_Member extends Widget_Base
{

	public function get_name()
	{
		return 'ma-team-members';
	}

	public function get_title()
	{
		return esc_html__('Team Member', 'master-addons' );
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-lock-user';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_style_depends()
	{
		return [
			'gridder',
			'font-awesome-5-all',
			'font-awesome-4-shim'
		];
	}

	public function get_script_depends()
	{
		return [
			'gridder',
			'swiper',
			'master-addons-scripts'
		];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/team-member/';
	}


	protected function register_controls()
	{

		/**
		 * Team Member Content Section
		 */
		$this->start_controls_section(
			'ma_el_team_content',
			[
				'label' => esc_html__('Content', 'master-addons' ),
			]
		);


		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {

			$this->add_control(
				'ma_el_team_members_preset',
				[
					'label' => esc_html__('Design Variations', 'master-addons' ),
					'type' => Controls_Manager::SELECT,
					'default' => '-basic',
					'options' => [
						'-basic'            => esc_html__('Basic One', 'master-addons' ),
						'-basic-2'          => esc_html__('Basic Two', 'master-addons' ),
						'-basic-3'          => esc_html__('Basic Three', 'master-addons' ),
						'-basic-4'          => esc_html__('Basic Four', 'master-addons' ),
						'-basic-5'          => esc_html__('Basic Five', 'master-addons' ),
						'-circle'           => esc_html__('Circle Gradient', 'master-addons' ),
						'-circle-2'         => esc_html__('Circle No Gradient', 'master-addons' ),
						'-social-left'      => esc_html__('Social Left on Hover', 'master-addons' ),
						'-social-right'     => esc_html__('Social Right on Hover', 'master-addons' ),
						'-rounded'          => esc_html__('Rounded', 'master-addons' ),
						'-content-hover'    => esc_html__('Content on Hover', 'master-addons' )
					],
				]
			);
		} else {
			$this->add_control(
				'ma_el_team_members_preset',
				[
					'label' => esc_html__('Design Variations', 'master-addons' ),
					'type' => Controls_Manager::SELECT,
					'default' => '-basic',
					'options' => [
						'-basic'            => esc_html__('Basic One', 'master-addons' ),
						'-basic-2'          => esc_html__('Basic Two', 'master-addons' ),
						'-basic-3'          => esc_html__('Basic Three', 'master-addons' ),
						'-basic-4'          => esc_html__('Basic Four', 'master-addons' ),
						'-basic-5'          => esc_html__('Basic Five', 'master-addons' ),
						'-rounded'          => esc_html__('Rounded', 'master-addons' ),
						'-pro-team-1'       => esc_html__('Circle Gradient (Pro)', 'master-addons' ),
						'-pro-team-2'       => esc_html__('Circle No Gradient (Pro)', 'master-addons' ),
						'-pro-team-3'       => esc_html__('Social Left on Hover (Pro)', 'master-addons' ),
						'-pro-team-4'       => esc_html__('Social Right on Hover (Pro)', 'master-addons' ),
						'-pro-team-5'       => esc_html__('Content on Hover (Pro)', 'master-addons' )
					],
					'description' => sprintf(
						'5+ more Variations on <a href="%s" target="_blank">%s</a>',
						esc_url_raw(admin_url('admin.php?page=master-addons-settings-pricing')),
						__('Upgrade Now', 'master-addons' )
					)

				]
			);
		}

		$this->add_control(
			'ma_el_team_member_image',
			[
				'label' => __('Image', 'master-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'ma_el_team_member_image_size',
				'default' => 'full',
				'condition' => [
					'ma_el_team_member_image[url]!' => '',
				],
			]
		);

		$this->add_control(
			'ma_el_team_member_name',
			[
				'label' => esc_html__('Name', 'master-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('John Doe', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_team_member_designation',
			[
				'label' => esc_html__('Designation', 'master-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('My Designation', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_team_member_description',
			[
				'label' => esc_html__('Description', 'master-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Add team member details here', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_team_members_content_align',
			[
				'label'         => __('Content Alignment', 'master-addons' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => Master_Addons_Helper::jltma_content_alignment(),
				'default'       => 'left',
				'selectors'     => [
					'{{WRAPPER}} .jltma-team-member-content:not(.jltma-team-member-social li a)' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		/*
			* Team member Social profiles section
			*/

		$this->start_controls_section(
			'ma_el_section_team_member_social_profiles',
			[
				'label' => esc_html__('Social Profiles', 'master-addons' )
			]
		);
		$this->add_control(
			'ma_el_team_member_enable_social_profiles',
			[
				'label' => esc_html__('Display Social Profiles?', 'master-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$social_repeater = new Repeater();
		$social_repeater->add_control(
			'social',
			[
				'label'         	=> esc_html__('Icon', 'master-addons' ),
				'type'          	=> Controls_Manager::ICONS,
				'fa4compatibility' 	=> 'icon',
				'default'       	=> [
					'value'     => 'fab fa-wordpress',
					'library'   => 'brand',
				]
			]
		);

		$social_repeater->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'master-addons' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => 'true',
				],
				'placeholder' => esc_html__('Place URL here', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_team_member_social_profile_links',
			[
				'type' => Controls_Manager::REPEATER,
				'condition' => [
					'ma_el_team_member_enable_social_profiles!' => '',
				],
				'default' => [
					[
						'social' => 'fa fa-facebook',
						'link' 	 => '',
					],
					[
						'social' => 'fa fa-twitter',
						'link' 	 => '',
					],
					[
						'social' => 'fa fa-google-plus',
						'link' 	 => '',
					],
					[
						'social' => 'fa fa-linkedin',
						'link' 	 => '',
					],
				],
				'fields' => $social_repeater->get_controls(),
				// 'title_field' => '<i class="{{ social }}"></i> {{{ social.replace( \'fab fa-\', \'\' ).replace( \'-\', \' \' ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}',
				'title_field' => 'Social Icon',
			]
		);

		$this->add_control(
			'ma_el_team_members_social_align',
			[
				'label'         => __('Content Alignment', 'master-addons' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => Master_Addons_Helper::jltma_content_alignment(),
				'default'       => 'left',
				'selectors'     => [
					'{{WRAPPER}} .jltma-team-member-social' => 'text-align: {{VALUE}};',
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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/team-member/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/adding-team-members-in-elementor-page-builder/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
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
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with
Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}



		/*
			* Team Members Styling Section
			*/
		$this->start_controls_section(
			'ma_el_section_team_members_styles_preset',
			[
				'label' => esc_html__('General Styles', 'master-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ma_el_team_members_avatar_bg',
			[
				'label' => esc_html__('Avatar Background Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#826EFF',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-circle .jltma-team-member-thumb svg.team-avatar-bg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'ma_el_team_members_preset' => '-circle',
				],
			]
		);

		$this->add_control(
			'ma_el_team_members_bg',
			[
				'label' => esc_html__('Background Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-basic,
						{{WRAPPER}} .jltma-team-member-circle,
						{{WRAPPER}} .jltma-team-member-social-left,
						{{WRAPPER}} .jltma-team-member-basic-4:hover .jltma-team-member-content:before,
						{{WRAPPER}} .jltma-team-member-rounded' => 'background: {{VALUE}};',
					'{{WRAPPER}} .bb' => 'border-bottom: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'jltma_team_members_item_border_radius',
			[
				'label'      => __('Item Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-team-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jltma_team_members_item_box_shadow',
				'default'     => '0',
				'selector' => '{{WRAPPER}} .jltma-team-item',
			]
		);

		$this->end_controls_section();

		// Thumb Options

		$this->start_controls_section(
			'section_team_carousel_thumb',
			[
				'label' => __('Thumb', 'master-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'jltma_team_members_thumb_border',
				'label'       => esc_html__('Border', 'master-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-team-member-thumb img',
			]
		);

		$this->add_responsive_control(
			'jltma_team_members_thumb_radius',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-team-member-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'jltma_team_members_style_padding',
			[
				'label' 		=> __('Padding', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 999,
						'step'	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-team-member-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'jltma_team_members_style_margin',
			[
				'label' 		=> __('Margin', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 999,
						'step'	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-team-member-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

		// Member content details

		$this->start_controls_section(
			'section_team_carousel_Content',
			[
				'label' => __('Content', 'master-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'jltma_team_members_content_bg',
				'selector' => '{{WRAPPER}} .jltma-team-member-content',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'jltma_team_members_content_border',
				'label'       => esc_html__('Border', 'master-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .jltma-team-member-content',
			]
		);

		$this->add_responsive_control(
			'jltma_team_members_thumb_border_radius',
			[
				'label'      => __('Border Radius', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-team-member-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'jltma_team_members_style_thumb_padding',
			[
				'label' 		=> __('Padding', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 999,
						'step'	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-team-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'jltma_team_members_style_thumb_margin',
			[
				'label' 		=> __('Margin', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 999,
						'step'	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-team-member-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();


		// Name, Designation , About Font Color and Typography

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

		$this->add_responsive_control(
			'jltma_team_member_name_padding',
			[
				'label' 		=> __('Padding', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 999,
						'step'	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-team-member-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'jltma_team_member_name_margin',
			[
				'label' 		=> __('Margin', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 999,
						'step'	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-team-member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_responsive_control(
			'jltma_team_member_designation_padding',
			[
				'label' 		=> __('Padding', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 999,
						'step'	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-team-member-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'jltma_team_member_designation_margin',
			[
				'label' 		=> __('Margin', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 999,
						'step'	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-team-member-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .jltma-team-member-about' => 'color: {{VALUE}};',
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

		$this->add_responsive_control(
			'jltma_team_member_description_padding',
			[
				'label' 		=> __('Padding', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 999,
						'step'	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-team-member-about' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'jltma_team_member_description_margin',
			[
				'label' 		=> __('Margin', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 999,
						'step'	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-team-member-about' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();


		//Social Colors
		$this->start_controls_section(
			'ma_el_team_member_social_section',
			[
				'label' => __('Social', 'master-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				// 'condition' => [
				// 	'ma_el_team_members_preset' => ['-social-left', '-rounded']
				// ],
			]
		);

		$this->add_responsive_control(
			'jltma_team_member_socials_padding',
			[
				'label' 		=> __('Padding', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 999,
						'step'	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-team-member-social li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'jltma_team_member_socials_margin',
			[
				'label' 		=> __('Margin', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 999,
						'step'	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-team-member-social li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs('ma_el_team_members_social_icons_style_tabs');

		$this->start_controls_tab('ma_el_team_members_social_icon_tab', [
			'label' => esc_html__(
				'Normal',
				'master-addons' 
			)
		]);

		$this->add_control(
			'ma_el_team_member_social_icon_size',
			[
				'label' => __('Icon Size', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-social li a' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-team-member-social li a svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ma_el_team_member_social_icon_color',
			[
				'label' => esc_html__('Icon Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#999',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-social li a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-team-member-social li a svg' => 'fill: {{VALUE}};',
				],
				// 'condition' => [
				// 	'ma_el_team_members_preset' => '-social-left',
				// ],
			]
		);

		$this->add_control(
			'ma_el_team_member_social_color_1',
			[
				'label' => esc_html__('Background Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4b00e7',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-social li a' => 'background: {{VALUE}};',
				],
				// 'condition' => [
				// 	'ma_el_team_members_preset' => '-social-left',
				// ],
			]
		);

		$this->add_control(
			'ma_el_team_member_social_color_2',
			[
				'label' => esc_html__('Background Color 2', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#272c44',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-rounded .jltma-team-member-social li a' => 'background: {{VALUE}};',
				],
				'condition' => [
					'ma_el_team_members_preset' => '-rounded',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('ma_el_team_members_social_icon_hover', [
			'label' => esc_html__(
				'Hover',
				'master-addons' 
			)
		]);

		$this->add_control(
			'ma_el_team_member_social_icon_hover_size',
			[
				'label' => __('Icon Size', 'master-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-social li a' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .jltma-team-member-social li a svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ma_el_team_member_social_icon_hover_color',
			[
				'label' => esc_html__('Icon Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-social li a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-team-member-social li a:hover svg' => 'fill: {{VALUE}};',
				],
				// 'condition' => [
				// 	'ma_el_team_members_preset' => '-social-left',
				// ],
			]
		);

		$this->add_control(
			'ma_el_team_member_social_hover_color_1',
			[
				'label' => esc_html__('Hover BG Color', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ff6d55',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-social-left .jltma-team-member-social li a:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .jltma-team-member-social-left .jltma-team-member-social li a:hover svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'ma_el_team_members_preset' => '-social-left'
				],
			]
		);

		$this->add_control(
			'ma_el_team_member_social_hover_color_2',
			[
				'label' => esc_html__('Hover BG Color 2', 'master-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ff6d55',
				'selectors' => [
					'{{WRAPPER}} .jltma-team-member-rounded .jltma-team-member-social li a:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .jltma-team-member-rounded .jltma-team-member-social li a:hover svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'ma_el_team_members_preset' => '-rounded'
				],
			]
		);

		$this->add_responsive_control(
			'jltma_team_member_social_icons_padding',
			[
				'label' 		=> __('Padding', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 999,
						'step'	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-team-member-social li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'jltma_team_member_social_icons_margin',
			[
				'label' 		=> __('Margin', 'master-addons' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 999,
						'step'	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .jltma-team-member-social li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
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
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$ma_el_team_member_image = $settings['ma_el_team_member_image'];
		$ma_el_team_member_image_url = Group_Control_Image_Size::get_attachment_image_src($ma_el_team_member_image['id'], 'ma_el_team_member_image_size', $settings);
		if (empty($ma_el_team_member_image_url)) {
			$ma_el_team_member_image_url = $ma_el_team_member_image['url'];
		} else {
			$ma_el_team_member_image_url = $ma_el_team_member_image_url;
		}


		if ($settings['ma_el_team_members_preset'] == '-style6') { ?>

			<div id="jltma-team-member-slider" class="jltma-team-member-slider owl-carousel owl-theme">
				<div class="ma-el-member-container">
					<div class="ma-el-inner-container">

						<?php
						if (isset($settings['ma_el_team_member_image']['id']) && $settings['ma_el_team_member_image']['id'] != "") {
							echo $this->render_image($settings['ma_el_team_member_image']['id'], $settings);
						} else {
							echo '<img src="' . esc_url($ma_el_team_member_image_url) . '" >';
						} ?>

						<div class="ma-el-member-details">
							<h4 class="name">
								<?php echo $this->parse_text_editor($settings['ma_el_team_member_name']); ?>
							</h4>
							<p class="designation">
								<?php echo esc_html($settings['ma_el_team_member_designation']); ?>
							</p>
							<p>
								<?php echo esc_html($settings['ma_el_team_member_description']); ?>
							</p>

							<div class="member-social-link">

								<?php if ($settings['ma_el_team_member_enable_social_profiles'] == 'yes') : ?>
									<?php foreach ($settings['ma_el_team_member_social_profile_links'] as $item) : ?>
										<?php $target = $item['link']['is_external'] ? ' target="_blank"' : ''; ?>
										<a href="<?php echo esc_url($item['link']['url']); ?>" <?php echo esc_attr($target); ?>>
											<?php Master_Addons_Helper::jltma_fa_icon_picker('fab fa-wordpress', 'icon', $item['social'], 'social'); ?>
										</a>
									<?php endforeach; ?>
								<?php endif; ?>

							</div>
						</div><!-- /.member-details -->
					</div><!-- /.inner-container -->
				</div><!-- /.member-container -->
			</div><!-- /.jltma-team-member-slider -->


		<?php } else { ?>




			<div id="jltma-team-member-<?php echo esc_attr($this->get_id()); ?>" class="jltma-team-item
                text-center <?php if ($settings['ma_el_team_members_preset'] == '-rounded') echo "rounded"; ?>">
				<div class="jltma-team-member<?php echo esc_attr($settings['ma_el_team_members_preset']); ?> <?php if ($settings['ma_el_team_members_preset'] == '-basic-4') echo "bb"; ?> <?php if ($settings['ma_el_team_members_preset'] == '-circle-2') echo "bg-transparent"; ?>">
					<div class="jltma-team-member-thumb">
						<?php if ($settings['ma_el_team_members_preset'] == '-circle') : ?>
							<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
								<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z" />
							</svg>
							<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
								<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z" />
							</svg>
							<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
								<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z" />
							</svg>
						<?php endif; ?>

						<?php
						if (isset($settings['ma_el_team_member_image']['id']) && $settings['ma_el_team_member_image']['id'] != "") {
							echo $this->render_image($settings['ma_el_team_member_image']['id'], $settings);
						} else {
							echo '<img src="' . esc_url($ma_el_team_member_image_url) . '" >';
						} ?>

					</div>
					<div class="jltma-team-member-content">
						<h2 class="jltma-team-member-name">
							<?php echo $this->parse_text_editor($settings['ma_el_team_member_name']); ?>
						</h2>

						<span class="jltma-team-member-designation">
							<?php echo $this->parse_text_editor($settings['ma_el_team_member_designation']); ?>
						</span>

						<p class="jltma-team-member-about">
							<?php echo $this->parse_text_editor($settings['ma_el_team_member_description']); ?>
						</p>

						<?php if ($settings['ma_el_team_member_enable_social_profiles'] == 'yes') : ?>
							<ul class="list-inline jltma-team-member-social">
								<?php foreach ($settings['ma_el_team_member_social_profile_links'] as $item) : ?>

									<?php $target = $item['link']['is_external'] ? ' target="_blank"' : ''; ?>
									<li>
										<a href="<?php echo esc_url($item['link']['url']); ?>" <?php echo esc_attr($target); ?>>
											<?php Master_Addons_Helper::jltma_fa_icon_picker('fab fa-wordpress', 'icon', $item['social'], '', 'social'); ?>
										</a>
									</li>

								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			</div>

		<?php }
	}


	private function render_image($image_id, $settings)
	{
		$ma_el_team_member_image_size = $settings['ma_el_team_member_image_size_size'];

		if ('custom' === $ma_el_team_member_image_size) {
			$image_src = Group_Control_Image_Size::get_attachment_image_src($image_id, $ma_el_team_member_image_size, $settings);
		} else {
			$image_src = wp_get_attachment_image_src($image_id, $ma_el_team_member_image_size);
			$image_src = $image_src[0];
		}

		return sprintf('<img src="%s"  class="circled" alt="%s" />', esc_url($image_src), esc_html(get_post_meta($image_id, '_wp_attachment_image_alt', true)));
	}



	protected function content_template()
	{ ?>

		<# if ( '-style6'==settings.ma_el_team_members_preset ) { #>

			<div id="jltma-team-member-slider" class="jltma-team-member-slider owl-carousel owl-theme">

				<div class="item">
					<div class="member-container">
						<div class="inner-container">
							<img src="{{ settings.ma_el_team_member_image.url }}" alt="{{ settings.ma_el_team_member_name }}">
							<div class="member-details">
								<h4 class="name">
									{{ settings.ma_el_team_member_name }}
								</h4>
								<p class="designation">
									{{ settings.ma_el_team_member_designation }}
								</p>
								<p>
									{{ settings.ma_el_team_member_description }}
								</p>
								<div class="member-social-link">

									<# if ( 'yes'==settings.ma_el_team_member_enable_social_profiles ) { #>

										<# _.each( settings.ma_el_team_member_social_profile_links, function( item, index ) { #>

											<# var target=item.link.is_external ? ' target="_blank"' : '' #>

												<a href="{{ item.link.url }}" {{{ target }}}><i class="{{ item.social.value }}"></i></a>

												<# }); #>

													<# } #>


								</div>
							</div><!-- /.member-details -->
						</div><!-- /.inner-container -->
					</div><!-- /.member-container -->
				</div><!-- /.item -->

			</div><!-- /.jltma-team-member-slider -->

			<# } else{ #>


				<div id="jltma-team-member" class="jltma-team-item">
					<div class="jltma-team-member{{ settings.ma_el_team_members_preset }}">
						<div class="jltma-team-member-thumb">
							<# if ( '-circle'==settings.ma_el_team_members_preset ) { #>
								<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
									<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z" />
								</svg>
								<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
									<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z" />
								</svg>
								<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
									<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z" />
								</svg>
								<# } #>
									<img src="{{ settings.ma_el_team_member_image.url }}" class="circled" alt="{{ settings
                                .ma_el_team_member_name }}">

						</div>
						<div class="jltma-team-member-content">
							<h2 class="jltma-team-member-name">{{{ settings.ma_el_team_member_name }}}</h2>
							<span class="jltma-team-member-designation">{{{ settings.ma_el_team_member_designation
                                    }}}</span>
							<p class="jltma-team-member-about">{{{ settings.ma_el_team_member_description }}}</p>
							<# if ( 'yes'==settings.ma_el_team_member_enable_social_profiles ) { #>
								<ul class="list-inline jltma-team-member-social">
									<# _.each( settings.ma_el_team_member_social_profile_links, function( item, index ) { #>

										<# var target=item.link.is_external ? ' target="_blank"' : '' #>
											<li>
												<a href="{{ item.link.url }}" {{{ target }}}><i class="{{ item.social.value }}"></i></a>
											</li>

											<# }); #>
								</ul>
								<# } #>
						</div>
					</div>
				</div>

				<# } #>



			<?php
		}
	}
