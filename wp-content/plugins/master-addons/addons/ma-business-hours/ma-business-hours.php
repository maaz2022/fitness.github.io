<?php

namespace MasterAddons\Addons;

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Business Hours Widget
 */
class JLTMA_Business_Hours extends Widget_Base
{

	public function get_name()
	{
		return 'ma-business-hours';
	}
	public function get_title()
	{
		return esc_html__('Business Hours', 'master-addons' );
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-clock-o';
	}

	public function get_keywords()
	{
		return ['office', 'business', 'hours', 'time', 'duty', 'schedule', 'clock', 'alarm'];
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
		return 'https://master-addons.com/demos/business-hours/';
	}


	protected function register_controls()
	{

		/*
    	 * Content Tab: Business Hours
    	 */
		$this->start_controls_section(
			'ma_el_business_hours_schedule_section',
			[
				'label'             => __('MA Business Hours', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_business_hours_style',
			[
				'label'                => __('Design Preset', 'master-addons' ),
				'type'                 => Controls_Manager::SELECT,
				'options'              => [
					'style-default'                 => __('Default', 'master-addons' ),
					'solid-bg-color'                => __('Solid Background', 'master-addons' ),
					'content-bg-image'              => __('Short Details', 'master-addons' ),
					'content-corner-btn'            => __('Booking Reservation One', 'master-addons' ),
					'table-reservation'             => __('Booking Reservation Two', 'master-addons' )
				],
				'default'              => 'style-default',
				'frontend_available'   => true,
			]
		);

		$this->add_control(
			'ma_el_business_timings',
			[
				'label'                => __('Business Timings', 'master-addons' ),
				'type'                 => Controls_Manager::SELECT,
				'options'              => [
					'default'               => __('Default', 'master-addons' ),
					'custom'                => __('Custom Table', 'master-addons' )
				],
				'default'              => 'default',
				'frontend_available'   => true,
			]
		);



		$this->add_control(
			'ma_el_bh_show_title',
			[
				'label'             => __('Show Title?', 'master-addons' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => 'no',
				'label_off'         => __('Yes', 'master-addons' ),
				'label_on'          => __('No', 'master-addons' ),
				'return_value'      => 'yes',
			]
		);

		$this->add_control(
			'ma_el_bh_table_title',
			[
				'label'             => __('Table Title', 'master-addons' ),
				'type'              => Controls_Manager::TEXT,
				'placeholder'       => __('Opening hours', 'master-addons' ),
				'default'           => __('Opening hours', 'master-addons' ),
				'label_block'       => true,
				'condition'        => [
					'ma_el_bh_show_title'           => 'yes'
				],
			]
		);

		$this->add_control(
			'ma_el_bh_show_subtitle',
			[
				'label'             => __('Show Sub Title?', 'master-addons' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => 'no',
				'label_off'         => __('Yes', 'master-addons' ),
				'label_on'          => __('No', 'master-addons' ),
				'return_value'      => 'yes',
				'condition'         => [
					'ma_el_business_hours_style'    =>  ['content-bg-image', 'content-corner-btn', 'table-reservation']
				]
			]
		);


		$this->add_control(
			'ma_el_bh_table_subtitle',
			[
				'label'             => __('Sub Title', 'master-addons' ),
				'type'              => Controls_Manager::TEXT,
				'placeholder'       => __('Book your Table', 'master-addons' ),
				'default'           => __('Book your Table', 'master-addons' ),
				'label_block'       => true,
				'condition'        => [
					'ma_el_bh_show_subtitle'           => 'yes'
				],
			]
		);

		$this->add_control(
			'ma_el_business_bg_image',
			[
				'label' => __('Image', 'master-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'        => [
					'ma_el_business_hours_style'   =>  ['content-bg-image', 'content-corner-btn', 'table-reservation']
				],

			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'ma_el_business_bg_img',
				'default' => 'full',
				'exclude'    => array('custom'),
				'condition' => [
					'ma_el_business_bg_image[url]!' => '',
					'ma_el_business_hours_style'   =>  ['content-bg-image', 'content-corner-btn', 'table-reservation']
				],
			]
		);


		$this->add_control(
			'ma_el_bh_show_day_icon',
			[
				'label'             => __('Show Day Icon?', 'master-addons' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => 'no',
				'label_off'         => __('Yes', 'master-addons' ),
				'label_on'          => __('No', 'master-addons' ),
				'return_value' => 'yes'
			]
		);


		$this->add_control(
			'ma_el_bh_day_icon',
			[
				'label'         	=> esc_html__('Day Icon', 'master-addons' ),
				'description' 		=> esc_html__('Please choose an icon from the list.', 'master-addons' ),
				'type'          	=> Controls_Manager::ICONS,
				'fa4compatibility' 	=> 'icon',
				'default'       	=> [
					'value'     => 'far fa-clock',
					'library'   => 'regular',
				],
				'render_type'      => 'template',
				'condition' => [
					'ma_el_bh_show_day_icon'   =>  'yes'
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'ma_el_bh_day',
			[
				'label'             => __('Day', 'master-addons' ),
				'type'              => Controls_Manager::SELECT,
				'default'           => 'Sunday',
				'options'           => [
					'Sunday'    => __('Sunday', 'master-addons' ),
					'Monday'    => __('Monday', 'master-addons' ),
					'Tuesday'   => __('Tuesday', 'master-addons' ),
					'Wednesday' => __('Wednesday', 'master-addons' ),
					'Thursday'  => __('Thursday', 'master-addons' ),
					'Friday'    => __('Friday', 'master-addons' ),
					'Saturday'  => __('Saturday', 'master-addons' ),
				],
			]
		);

		$repeater->add_control(
			'ma_el_bh_closed',
			[
				'label'             => __('Closed?', 'master-addons' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => 'no',
				'label_off'         => __('Yes', 'master-addons' ),
				'label_on'          => __('No', 'master-addons' ),
				'return_value'      => 'no',
			]
		);

		$repeater->add_control(
			'ma_el_opening_hours',
			[
				'label'             => __('Opening Hours', 'master-addons' ),
				'type'              => Controls_Manager::SELECT,
				'default'           => '08:30',
				'options'           => [
					'00:00' => '12:00 AM',
					'00:30' => '12:30 AM',
					'01:00' => '1:00 AM',
					'01:30' => '1:30 AM',
					'02:00' => '2:00 AM',
					'02:30' => '2:30 AM',
					'03:00' => '3:00 AM',
					'03:30' => '3:30 AM',
					'04:00' => '4:00 AM',
					'04:30' => '4:30 AM',
					'05:00' => '5:00 AM',
					'05:30' => '5:30 AM',
					'06:00' => '6:00 AM',
					'06:30' => '6:30 AM',
					'07:00' => '7:00 AM',
					'07:30' => '7:30 AM',
					'08:00' => '8:00 AM',
					'08:30' => '8:30 AM',
					'09:00' => '9:00 AM',
					'09:30' => '9:30 AM',
					'10:00' => '10:00 AM',
					'10:30' => '10:30 AM',
					'11:00' => '11:00 AM',
					'11:30' => '11:30 AM',
					'12:00' => '12:00 PM',
					'12:30' => '12:30 PM',
					'13:00' => '1:00 PM',
					'13:30' => '1:30 PM',
					'14:00' => '2:00 PM',
					'14:30' => '2:30 PM',
					'15:00' => '3:00 PM',
					'15:30' => '3:30 PM',
					'16:00' => '4:00 PM',
					'16:30' => '4:30 PM',
					'17:00' => '5:00 PM',
					'17:30' => '5:30 PM',
					'18:00' => '6:00 PM',
					'18:30' => '6:30 PM',
					'19:00' => '7:00 PM',
					'19:30' => '7:30 PM',
					'20:00' => '8:00 PM',
					'20:30' => '8:30 PM',
					'21:00' => '9:00 PM',
					'21:30' => '9:30 PM',
					'22:00' => '10:00 PM',
					'22:30' => '10:30 PM',
					'23:00' => '11:00 PM',
					'23:30' => '11:30 PM',
					'24:00' => '12:00 PM',
					'24:30' => '12:30 PM',
				],
				'condition'         => [
					'ma_el_bh_closed' => 'no',
				],
			]
		);

		$repeater->add_control(
			'ma_el_closing_hours',
			[
				'label'             => __('Closing Hours', 'master-addons' ),
				'type'              => Controls_Manager::SELECT,
				'default'           => '08:30',
				'options'           => [
					'00:00' => '12:00 AM',
					'00:30' => '12:30 AM',
					'01:00' => '1:00 AM',
					'01:30' => '1:30 AM',
					'02:00' => '2:00 AM',
					'02:30' => '2:30 AM',
					'03:00' => '3:00 AM',
					'03:30' => '3:30 AM',
					'04:00' => '4:00 AM',
					'04:30' => '4:30 AM',
					'05:00' => '5:00 AM',
					'05:30' => '5:30 AM',
					'06:00' => '6:00 AM',
					'06:30' => '6:30 AM',
					'07:00' => '7:00 AM',
					'07:30' => '7:30 AM',
					'08:00' => '8:00 AM',
					'08:30' => '8:30 AM',
					'09:00' => '9:00 AM',
					'09:30' => '9:30 AM',
					'10:00' => '10:00 AM',
					'10:30' => '10:30 AM',
					'11:00' => '11:00 AM',
					'11:30' => '11:30 AM',
					'12:00' => '12:00 PM',
					'12:30' => '12:30 PM',
					'13:00' => '1:00 PM',
					'13:30' => '1:30 PM',
					'14:00' => '2:00 PM',
					'14:30' => '2:30 PM',
					'15:00' => '3:00 PM',
					'15:30' => '3:30 PM',
					'16:00' => '4:00 PM',
					'16:30' => '4:30 PM',
					'17:00' => '5:00 PM',
					'17:30' => '5:30 PM',
					'18:00' => '6:00 PM',
					'18:30' => '6:30 PM',
					'19:00' => '7:00 PM',
					'19:30' => '7:30 PM',
					'20:00' => '8:00 PM',
					'20:30' => '8:30 PM',
					'21:00' => '9:00 PM',
					'21:30' => '9:30 PM',
					'22:00' => '10:00 PM',
					'22:30' => '10:30 PM',
					'23:00' => '11:00 PM',
					'23:30' => '11:30 PM',
					'24:00' => '12:00 PM',
					'24:30' => '12:30 PM',
				],
				'condition'         => [
					'ma_el_bh_closed' => 'no',
				],
			]
		);

		$repeater->add_control(
			'ma_el_bh_closed_text',
			[
				'label'             => esc_html__('Closed Text', 'master-addons' ),
				'type'              => Controls_Manager::TEXT,
				'placeholder'       => __('Closed', 'master-addons' ),
				'default'           => __('Closed', 'master-addons' ),
				'label_block'       => true,
				'condition'        => [
					'ma_el_bh_closed'   =>  'no'
				],
			]
		);

		$repeater->add_control(
			'ma_el_highlight_this',
			[
				'label'             => __('Highlight', 'master-addons' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => 'no',
				'label_off'         => __('Yes', 'master-addons' ),
				'label_on'          => __('No', 'master-addons' ),
				'return_value'      => 'yes'
			]
		);


		$repeater->add_control(
			'ma_el_highlighted_text_color',
			[
				'label'             => __('Text Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour li{{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				],
				'condition'         => [
					'ma_el_highlight_this' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'ma_el_highlighted_bg_color',
			[
				'label'             => __('Background Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour li{{CURRENT_ITEM}}' => 'background: {{VALUE}};'
				],
				'condition'         => [
					'ma_el_highlight_this' => 'yes',
				],
			]
		);

		$this->add_control(
			'ma_el_business_hours',
			[
				'type'                  => Controls_Manager::REPEATER,
				'default'               => [
					[
						'ma_el_bh_day'      => esc_html__('Sunday', 'master-addons' ),
						'ma_el_bh_closed'   => 'yes',
						'ma_el_highlight_this' => 'yes',
						'ma_el_highlighted_text_color' => '#4b00e7',
					],
					[
						'ma_el_bh_day'  => esc_html__('Monday', 'master-addons' ),
					],
					[
						'ma_el_bh_day'  => esc_html__('Tuesday', 'master-addons' ),
					],
					[
						'ma_el_bh_day'  => esc_html__('Wednesday', 'master-addons' ),
					],
					[
						'ma_el_bh_day'  => esc_html__('Thursday', 'master-addons' ),
					],
					[
						'ma_el_bh_day'  => esc_html__('Friday', 'master-addons' ),
					],
					[
						'ma_el_bh_day'      => esc_html__('Saturday', 'master-addons' ),
					],
				],
				'fields' 				=> $repeater->get_controls(),
				'title_field'           => '{{{ ma_el_bh_day }}}',
				'condition'         => [
					'ma_el_business_timings' => 'default',
				],
			]
		);



		/*
	     * Custom Business Hour Starts
	     */

		$repeater = new Repeater();


		$repeater->add_control(
			'ma_el_bh_custom_day',
			[
				'label'             => __('Day', 'master-addons' ),
				'type'              => Controls_Manager::TEXT,
				'default'           => 'Sunday'
			]
		);

		$repeater->add_control(
			'ma_el_bh_custom_closed',
			[
				'label'             => __('Closed?', 'master-addons' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => 'no',
				'label_off'         => __('Yes', 'master-addons' ),
				'label_on'          => __('No', 'master-addons' ),
				'return_value'      => 'no',
			]
		);

		$repeater->add_control(
			'ma_el_bh_custom_time',
			[
				'label'             => __('Custom Time', 'master-addons' ),
				'type'              => Controls_Manager::TEXT,
				'default'           => '10:00 AM - 06:00 PM',
				'condition'         => [
					'ma_el_bh_custom_closed' => 'no',
				],
			]
		);


		$repeater->add_control(
			'ma_el_bh_custom_closed_text',
			[
				'label'             => esc_html__('Closed Text', 'master-addons' ),
				'type'              => Controls_Manager::TEXT,
				'placeholder'       => __('Closed', 'master-addons' ),
				'default'           => __('Closed', 'master-addons' ),
				'label_block'       => true,
				'condition'        => [
					'ma_el_bh_custom_closed'   =>  'no'
				],
			]
		);

		$repeater->add_control(
			'ma_el_custom_highlight_this',
			[
				'label'             => __('Highlight', 'master-addons' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => 'no',
				'label_off'         => __('Yes', 'master-addons' ),
				'label_on'          => __('No', 'master-addons' ),
				'return_value'      => 'yes'
			]
		);


		$repeater->add_control(
			'ma_el_custom_highlighted_text_color',
			[
				'label'             => __('Text Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					//				    '{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item{{CURRENT_ITEM}}' => 'background-color:
					// {{VALUE}}',
				],
				'condition'         => [
					'ma_el_custom_highlight_this' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'ma_el_custom_highlighted_bg_color',
			[
				'label'             => __('Background Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					//				    '{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item{{CURRENT_ITEM}}' => 'background-color:
					// {{VALUE}}',
				],
				'condition'         => [
					'ma_el_custom_highlight_this' => 'yes',
				],
			]
		);

		$this->add_control(
			'ma_el_business_custom_hours',
			[
				'type'                  => Controls_Manager::REPEATER,
				'default'               => [
					[
						'ma_el_bh_custom_day'      => __('Sunday', 'master-addons' ),
						'ma_el_bh_custom_closed'   => 'yes',
						'ma_el_custom_highlight_this' => 'yes',
						//					    'ma_el_highlighted_text_color' => '#4b00e7',
					],
					[
						'ma_el_bh_custom_day'  => __('Monday', 'master-addons' ),
					],
					[
						'ma_el_bh_custom_day'  => __('Tuesday', 'master-addons' ),
					],
					[
						'ma_el_bh_custom_day'  => __('Wednesday', 'master-addons' ),
					],
					[
						'ma_el_bh_custom_day'  => __('Thursday', 'master-addons' ),
					],
					[
						'ma_el_bh_custom_day'  => __('Friday', 'master-addons' ),
					],
					[
						'ma_el_bh_custom_day'  => __('Saturday', 'master-addons' ),
					],
				],
				'fields' 				=> $repeater->get_controls(),
				//			    'title_field'           => '{{tab_title}}',
				'title_field'           => '{{{ ma_el_bh_custom_day }}}',
				'condition'         => [
					'ma_el_business_timings' => 'custom',
				],
			]
		);

		$this->add_control(
			'ma_el_bh_hours_format',
			[
				'label'             => __('24 Hours Format?', 'master-addons' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => 'no',
				'label_on'          => __('Yes', 'master-addons' ),
				'label_off'         => __('No', 'master-addons' ),
				'return_value'      => 'yes',
				'condition'         => [
					'ma_el_business_timings' => 'default',
				],
			]
		);

		$this->add_control(
			'ma_el_days_format',
			[
				'label'                => __('Days Format', 'master-addons' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'full',
				'options'              => [
					'full'      => __('Full', 'master-addons' ),
					'short'     => __('Short', 'master-addons' ),
				],
				'condition'         => [
					'ma_el_business_timings' => 'default',
				],
			]
		);



		$this->add_control(
			'ma_el_bh_show_button',
			[
				'label'             => __('Show Button?', 'master-addons' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => 'no',
				'label_off'         => __('Yes', 'master-addons' ),
				'label_on'          => __('No', 'master-addons' ),
				'return_value'      => 'yes',
				//			    'condition'         => [
				//				    'ma_el_business_hours_style!' => ['content-corner-btn', 'table-reservation']
				//			    ],
			]
		);



		$this->end_controls_section();



		/*
	     * Button Reservation Details
	     */
		$this->start_controls_section(
			'ma_el_bf_button_section',
			[
				'label'             => __('Button Details', 'master-addons' ),
				'condition'        => [
					'ma_el_bh_show_button'          =>  'yes'
				],
			]
		);


		$this->add_control(
			'ma_el_bh_table_btn_text',
			[
				'label'             => esc_html__('Button Text', 'master-addons' ),
				'type'              => Controls_Manager::TEXT,
				'placeholder'       => __('Book Now', 'master-addons' ),
				'default'           => __('Book Now', 'master-addons' ),
				'label_block'       => true
			]
		);

		$this->add_control(
			'ma_el_bh_table_btn_link',
			[
				'label'       => esc_html__('Link URL', 'master-addons' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => '',
				],
				'show_external' => true,
			]
		);

		$this->add_responsive_control(
			'button_alignment',
			[
				'label'                 => __('Alignment', 'master-addons' ),
				'type'                  => Controls_Manager::CHOOSE,
				'options'               => Master_Addons_Helper::jltma_content_alignment(),
				'default'               => 'center',
				'selectors'             => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-content-bottom' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		/**
		 * Style Tab: Row Style
		 */

		$this->start_controls_section(
			'ma_el_section_rows_style',
			[
				'label'             => __('Rows Style', 'master-addons' ),
				'tab'               => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_rows_style');

		$this->start_controls_tab(
			'ma_el_tab_row_normal',
			[
				'label'                 => __('Normal', 'master-addons' ),
			]
		);


		$this->add_control(
			'ma_el_row_bg_color_normal',
			[
				'label'             => __('Background Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .jltma-business-hour li' => 'background: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ma_el_tab_row_hover',
			[
				'label'                 => __('Hover', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_row_bg_color_hover',
			[
				'label'             => __('Background Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .jltma-business-hour li:hover' => 'background: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->add_control(
			'stripes',
			[
				'label'             => __('Striped Rows', 'master-addons' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => 'no',
				'label_on'          => __('Yes', 'master-addons' ),
				'label_off'         => __('No', 'master-addons' ),
				'return_value'      => 'yes',
				'separator'         => 'before',
			]
		);

		$this->start_controls_tabs('tabs_alternate_style');

		$this->start_controls_tab(
			'tab_even',
			[
				'label'                 => __('Even Row', 'master-addons' ),
				'condition'             => [
					'stripes' => 'yes',
				],
			]
		);

		$this->add_control(
			'row_even_bg_color',
			[
				'label'             => __('Background Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '#f5f5f5',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item:nth-child(even)' => 'background-color: {{VALUE}}',
				],
				'condition'         => [
					'stripes' => 'yes',
				],
			]
		);

		$this->add_control(
			'row_even_text_color',
			[
				'label'             => __('Text Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item:nth-child(even)' => 'color: {{VALUE}}',
				],
				'condition'         => [
					'stripes' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_odd',
			[
				'label'                 => __('Odd Row', 'master-addons' ),
				'condition'             => [
					'stripes' => 'yes',
				],
			]
		);

		$this->add_control(
			'row_odd_bg_color',
			[
				'label'             => __('Background Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '#ffffff',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item:nth-child(odd)' => 'background-color: {{VALUE}}',
				],
				'condition'         => [
					'stripes' => 'yes',
				],
			]
		);

		$this->add_control(
			'row_odd_text_color',
			[
				'label'             => __('Text Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item:nth-child(odd)' => 'color: {{VALUE}}',
				],
				'condition'         => [
					'stripes' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();



		$this->add_responsive_control(
			'rows_padding',
			[
				'label'             => __('Padding', 'master-addons' ),
				'type'              => Controls_Manager::DIMENSIONS,
				'size_units'        => ['px', '%'],
				'default'           => [
					'top'       => '8',
					'right'     => '10',
					'bottom'    => '8',
					'left'      => '10',
					'unit'      => 'px',
					'isLinked'  => false,
				],
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'         => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .jltma-business-hour'
			]
		);


		$this->add_responsive_control(
			'rows_margin',
			[
				'label'             => __('Margin Bottom', 'master-addons' ),
				'type'              => Controls_Manager::SLIDER,
				'range'             => [
					'px' => [
						'min'   => 0,
						'max'   => 80,
						'step'  => 1,
					],
				],
				'size_units'        => ['px'],
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'closed_row_heading',
			[
				'label'             => __('Closed Row', 'master-addons' ),
				'type'              => Controls_Manager::HEADING,
				'separator'         => 'before',
			]
		);

		$this->add_control(
			'closed_row_bg_color',
			[
				'label'             => __('Background Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item.jltma-bh-closed' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'closed_row_day_color',
			[
				'label'             => __('Day Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item.jltma-bh-closed .jltma-business-day-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'closed_row_tex_color',
			[
				'label'             => __('Text Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item.jltma-bh-closed .closed' =>
					'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'closed_row_icon_color',
			[
				'label'             => __('Icon Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item.jltma-bh-closed i' =>
					'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_heading',
			[
				'label'             => __('Rows Divider', 'master-addons' ),
				'type'              => Controls_Manager::HEADING,
				'separator'         => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __('Divider', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-business-hour li:before',
			]
		);


		$this->end_controls_section();

		/**
		 * Style Tab: Business Hours
		 */
		$this->start_controls_section(
			'ma_el_business_hours_section_style',
			[
				'label'             => __('Business Hours', 'master-addons' ),
				'tab'               => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_hours_style');

		$this->start_controls_tab(
			'tab_hours_normal',
			[
				'label'                 => __('Normal', 'master-addons' ),
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label'             => __('Day', 'master-addons' ),
				'type'              => Controls_Manager::HEADING,
				'separator'         => 'before',
			]
		);


		$this->add_control(
			'day_color',
			[
				'label'             => __('Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-day-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __('Typography', 'master-addons' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .jltma-business-hour .jltma-business-day-name',
			]
		);

		$this->add_control(
			'hours_heading',
			[
				'label'             => __('Hours', 'master-addons' ),
				'type'              => Controls_Manager::HEADING,
				'separator'         => 'before',
			]
		);

		$this->add_control(
			'hours_color',
			[
				'label'             => __('Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-duration' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'              => 'hours_typography',
				'label'             => __('Typography', 'master-addons' ),
				'scheme'    		=> Typography::TYPOGRAPHY_4,
				'selector'          => '{{WRAPPER}} .jltma-business-hour .jltma-business-duration',
			]
		);

		$this->add_control(
			'icons_color',
			[
				'label'             => __('Icon Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_hours_hover',
			[
				'label'                 => __('Hover', 'master-addons' ),
			]
		);

		$this->add_control(
			'day_color_hover',
			[
				'label'             => __('Day Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item:hover .jltma-business-day-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hours_color_hover',
			[
				'label'             => __('Hours Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-item:hover .jltma-business-duration' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();



		/*
	     * Button Style
	     */
		$this->start_controls_section(
			'ma_el_business_hours_button_style',
			[
				'label'             => __('Button Style', 'master-addons' ),
				'tab'               => Controls_Manager::TAB_STYLE,
				'condition'        => [
					'ma_el_bh_show_button'          =>  'yes'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __('Background', 'master-addons' ),
				'types' => ['classic', 'gradient'],
				'default'	=> 'gradient',
				'selector' => '{{WRAPPER}} .jltma-business-hour .jltma-business-hour-btn'
			]
		);

		$this->add_control(
			'ma_el_business_hours_button_color',
			[
				'label'             => __('Button Color', 'master-addons' ),
				'type'              => Controls_Manager::COLOR,
				'default'           => '',
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .jltma-business-hour.table-reservation .jltma-business-hour-btn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'ma_el_business_hours_button_padding',
			[
				'label'             => __('Padding', 'master-addons' ),
				'type'              => Controls_Manager::DIMENSIONS,
				'size_units'        => ['px'],
				'default'           => [
					'top'       => '10',
					'right'     => '20',
					'bottom'    => '10',
					'left'      => '20',
					'unit'      => 'px',
					'isLinked'  => false,
				],
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'         => 'before',
			]
		);

		$this->add_responsive_control(
			'ma_el_business_hours_button_margin',
			[
				'label'             => __('Margin', 'master-addons' ),
				'type'              => Controls_Manager::DIMENSIONS,
				'size_units'        => ['px'],
				'selectors'         => [
					'{{WRAPPER}} .jltma-business-hour .jltma-business-hour-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ma_el_business_hours_btn_border',
				'label' => __('Divider', 'master-addons' ),
				'selector' => '{{WRAPPER}} .jltma-business-hour .jltma-business-hour-btn',
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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/business-hours/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/business-hours-elementor/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=x0_HY9uYgog" target="_blank" rel="noopener">', '</a>'),
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


	public function ma_el_business_hours()
	{
		$settings = $this->get_settings();
		$i = 1; ?>

		<?php if ($settings['ma_el_bh_show_title'] == 'yes') { ?>
			<?php if ($settings['ma_el_business_hours_style'] == 'table-reservation') { ?>
				<h2 class="jltma-business-reservation-title">
				<?php } else { ?>
					<h2 class="jltma-business-hour-title">
					<?php } ?>

					<?php echo $this->parse_text_editor($settings['ma_el_bh_table_title']); ?>
					</h2>
				<?php } ?>


				<?php if ($settings['ma_el_bh_show_subtitle'] == 'yes') { ?>
					<?php if ($settings['ma_el_business_hours_style'] == 'table-reservation') { ?>
						<h2 class="jltma-business-hour-title">
							<?php echo $this->parse_text_editor($settings['ma_el_bh_table_subtitle']); ?>
						</h2>
					<?php } ?>
				<?php } ?>



				<?php foreach ($settings['ma_el_business_hours'] as $index => $item) : ?>
					<?php
					$this->add_render_attribute(
						'jltma-row' . $i,
						'class',
						'jltma-business-hour-item clearfix elementor-repeater-item-' . esc_attr($item['_id'])
					);
					if ($item['ma_el_bh_closed'] != 'no') {
						$this->add_render_attribute('jltma-row' . $i, 'class', 'jltma-bh-closed');
					}
					?>
					<li <?php echo $this->get_render_attribute_string('jltma-row' . $i); ?>>
						<span class="jltma-business-day-name float-left">
							<?php if ($settings['ma_el_bh_show_day_icon'] == "yes") {
								Master_Addons_Helper::jltma_fa_icon_picker('far fa-clock', 'icon', $settings['ma_el_bh_day_icon'], 'ma_el_bh_day_icon');
							} ?>

							<?php
							if ($settings['ma_el_days_format'] == 'full') {
								echo ucwords(esc_attr($item['ma_el_bh_day']));
							} else {
								echo ucwords(esc_attr(substr($item['ma_el_bh_day'], 0, 3)));
							}
							?>
						</span>


						<span class="jltma-business-duration float-right">
							<?php if ($item['ma_el_bh_closed'] == 'no') { ?>
								<time class="jltma-opening-hours">
									<?php
									if ($settings['ma_el_bh_hours_format'] == 'yes') {
										echo $this->parse_text_editor($item['ma_el_opening_hours']);
									} else {
										echo esc_attr(date("g:i A", strtotime($item['ma_el_opening_hours'])));
									}
									?>
								</time>
								<time class="jltma-closing-hours">
									<?php
									if ($settings['ma_el_bh_hours_format'] == 'yes') {
										echo $this->parse_text_editor($item['ma_el_closing_hours']);
									} else {
										echo esc_attr(date("g:i A", strtotime($item['ma_el_closing_hours'])));
									}
									?>
								</time>
							<?php
							} else {
								if ($item['ma_el_bh_closed_text']) {
									echo '<span class="closed">' . $this->parse_text_editor($item['ma_el_bh_closed_text']) . '</span>';
								} else {
									echo '<span class="closed">' . esc_html('Closed', 'master-addons' ) . '</span>';
								}
							} ?>
						</span>
					</li>
				<?php $i++;
				endforeach; ?>
				<?php
			}

			public function ma_el_minimal_business_hours()
			{

				$settings = $this->get_settings();

				foreach ($settings['ma_el_business_hours'] as $index => $item) :

					$this->add_render_attribute('jltma-row', 'class', 'jltma-business-hour-item clearfix elementor-repeater-item-' . esc_attr($item['_id']));
				?>


					<li <?php echo $this->get_render_attribute_string('jltma-row' . $i); ?>>
						<span class="jltma-business-day-name float-left">
							<?php if ($settings['ma_el_bh_show_day_icon'] == "yes") {
								Master_Addons_Helper::jltma_fa_icon_picker('far fa-clock', 'icon', $settings['ma_el_bh_day_icon'], 'ma_el_bh_day_icon');
							} ?>

							<?php
							if ($settings['ma_el_days_format'] == 'full') {
								echo ucwords(esc_attr($item['ma_el_bh_day']));
							} else {
								echo ucwords(esc_attr(substr($item['ma_el_bh_day'], 0, 3)));
							}
							?>
						</span>


						<span class="jltma-business-duration float-right">
							<?php if ($item['ma_el_bh_closed'] == 'no') { ?>
								<time class="jltma-opening-hours">
									<?php
									if ($settings['ma_el_bh_hours_format'] == 'yes') {
										echo $this->parse_text_editor($item['ma_el_opening_hours']);
									} else {
										echo esc_attr(date("g:i A", strtotime($item['ma_el_opening_hours'])));
									}
									?>
								</time>
								<time class="jltma-closing-hours">
									<?php
									if ($settings['ma_el_bh_hours_format'] == 'yes') {
										echo $this->parse_text_editor($item['ma_el_closing_hours']);
									} else {
										echo esc_attr(date("g:i A", strtotime($item['ma_el_closing_hours'])));
									}
									?>
								</time>
							<?php
							} else {
								if ($item['ma_el_bh_closed_text']) {
									echo '<span class="closed">' . $this->parse_text_editor($item['ma_el_bh_closed_text']) . '</span>';
								} else {
									echo '<span class="closed">' . esc_html('Closed', 'master-addons' ) . '</span>';
								}
							} ?>
						</span>
					</li>
					<?php $i++;
				endforeach;
			}


			private function render_image($image_id, $settings)
			{
				$ma_el_image_gallery_image = $settings['ma_el_business_bg_img_size'];

				if ('custom' === $ma_el_image_gallery_image) {
					$image_src = Group_Control_Image_Size::get_attachment_image_src($image_id, 'ma_el_business_bg_image', $settings);
				} else {
					$image_src = wp_get_attachment_image_src($image_id, $ma_el_image_gallery_image);
					$image_src = $image_src[0];
				}

				return sprintf('<img src="%s" alt="%s" />', esc_url($image_src), esc_html(get_post_meta($image_id, '_wp_attachment_image_alt', true)));
			}


			public function ma_el_custom_business_hours()
			{
				$settings = $this->get_settings();
				$i = 1;

				if ($settings['ma_el_bh_show_title'] == "yes") {
					if ($settings['ma_el_business_hours_style'] == 'table-reservation') { ?>
						<h2 class="jltma-business-reservation-title">
						<?php } else { ?>
							<h2 class="jltma-business-hour-title">
							<?php }
						echo esc_attr($settings['ma_el_bh_table_title']); ?>
							</h2>
						<?php } ?>


						<?php if ($settings['ma_el_bh_show_subtitle'] == 'yes') { ?>
							<?php if ($settings['ma_el_business_hours_style'] == 'table-reservation') { ?>
								<h2 class="jltma-business-hour-title">
									<?php echo esc_attr($settings['ma_el_bh_table_subtitle']); ?>
								</h2>
							<?php } ?>
						<?php } ?>


						<?php foreach ($settings['ma_el_business_custom_hours'] as $index => $item) : ?>
							<?php
							$this->add_render_attribute('jltma-row' . $i, 'class', 'jltma-business-hour-item clearfix elementor-repeater-item-' . esc_attr($item['_id']));
							if ($item['ma_el_bh_custom_closed'] != 'no') {
								$this->add_render_attribute('jltma-row' . $i, 'class', 'jltma-bh-closed');
							}
							?>
							<li <?php echo $this->get_render_attribute_string('jltma-row' . $i); ?>>

								<?php if ($item['ma_el_bh_custom_day'] != '') { ?>
									<span class="jltma-business-day-name float-left">
										<?php
										if ($settings['ma_el_bh_show_day_icon'] == "yes") {
											Master_Addons_Helper::jltma_fa_icon_picker('far fa-clock', 'icon', $settings['ma_el_bh_day_icon'], 'ma_el_bh_day_icon');
										} ?>
										<?php
										echo esc_attr($item['ma_el_bh_custom_day']);
										?>
									</span>
								<?php } ?>

								<span class="jltma-business-duration float-right">
									<?php
									if ($item['ma_el_bh_custom_closed'] == 'no' && $item['ma_el_bh_custom_time'] != '') {
										echo esc_attr($item['ma_el_bh_custom_time']);
									} else {
										if ($item['ma_el_bh_custom_closed_text']) {
											echo '<span class="closed">' . esc_attr($item['ma_el_bh_custom_closed_text']) .
												'</span>';
										} else {
											echo '<span class="closed">' . esc_html('Closed', 'master-addons' ) . '</span>';
										}
									}
									?>
								</span>
							</li>
						<?php $i++;
						endforeach; ?>
					<?php
				}


				protected function render()
				{
					$settings = $this->get_settings();
					$this->add_render_attribute(
						'ma_el_business_hours',
						'class',
						[
							'jltma-business-hour',
							$settings['ma_el_business_hours_style']
						]
					);

					$ma_el_business_bg_image = $this->get_settings_for_display('ma_el_business_bg_image');

					if (!empty($ma_el_business_bg_image)) {
						$ma_el_business_bg_image_url_src = Group_Control_Image_Size::get_attachment_image_src(
							$ma_el_business_bg_image['id'],
							'ma_el_business_bg_img',
							$settings
						);
					}

					// Booking Button
					$this->add_render_attribute('ma_el_bh_btn_link', [
						'class'	=> ['jltma-business-hour-btn', 'float-right'],
						'href'	=> esc_url($settings['ma_el_bh_table_btn_link']['url']),
					]);

					$this->add_render_attribute('ma_el_bh_normal_btn', [
						'class'	=> ['jltma-business-hour-btn'],
						'href'	=> esc_url($settings['ma_el_bh_table_btn_link']['url']),
					]);

					if ($settings['ma_el_bh_table_btn_link']['is_external']) {
						$this->add_render_attribute('ma_el_bh_btn_link', 'target', '_blank');
					}

					if ($settings['ma_el_bh_table_btn_link']['nofollow']) {
						$this->add_render_attribute('ma_el_bh_btn_link', 'rel', 'nofollow');
					}

					?>
						<div <?php echo $this->get_render_attribute_string('ma_el_business_hours'); ?>>

							<?php if (($settings['ma_el_business_hours_style'] == 'content-corner-btn') || ($settings['ma_el_business_hours_style'] == 'table-reservation')) { ?>
								<div class="jltma-row">
									<div class="<?php echo ($settings['ma_el_business_hours_style'] == 'table-reservation') ? "jltma-col-8" : "jltma-col-6"; ?>">
										<?php echo $this->render_image($settings['ma_el_business_bg_image']['id'], $settings); ?>

									</div>
								<?php } ?>

								<?php if (($settings['ma_el_business_hours_style'] == 'content-corner-btn') || ($settings['ma_el_business_hours_style'] == 'table-reservation')) { ?>
									<div class="<?php echo ($settings['ma_el_business_hours_style'] == 'table-reservation') ? "jltma-col-4" : "jltma-col-6"; ?>">
									<?php } ?>

									<div class="jltma-business-hour-content" <?php if ($settings['ma_el_business_hours_style'] == 'content-bg-image') {
																					echo 'style="background: url(' . ($ma_el_business_bg_image_url_src) ? esc_attr($ma_el_business_bg_image_url_src) : '' . ') no-repeat center; background-size: cover;';
																				} ?>>
										<div class="jltma-business-hour-content-details">
											<ul class="jltma-business-hour-list">
												<?php
												if ($settings['ma_el_business_timings'] == 'default') {
													$this->ma_el_business_hours();
												} elseif ($settings['ma_el_business_timings'] == 'custom') {
													$this->ma_el_custom_business_hours();
												} elseif ($settings['ma_el_business_hours_style'] == 'content-bg-image') {
													$this->ma_el_minimal_business_hours();
												}
												?>
											</ul>
										</div>

										<?php if ($settings['ma_el_bh_show_button'] == 'yes' && $settings['ma_el_business_hours_style'] == 'content-corner-btn') { ?>
											<div class="jltma-business-hour-content-bottom">

												<?php if ($settings['ma_el_bh_show_subtitle'] == 'yes') { ?>
													<span class="float-left">
														<?php echo esc_attr($settings['ma_el_bh_table_subtitle']); ?>
													</span>
												<?php } ?>

												<a <?php echo $this->get_render_attribute_string('ma_el_bh_btn_link'); ?>>
													<?php echo  $settings['ma_el_bh_table_btn_text']; ?>
													<i class="fa fa-arrow-right"></i>
												</a>
											</div>
										<?php } ?>


										<?php if (
											$settings['ma_el_bh_show_button'] == 'yes' && $settings['ma_el_business_hours_style'] ==
											'table-reservation'
										) { ?>
											<div class="jltma-business-hour-content-bottom">
												<a <?php echo $this->get_render_attribute_string('ma_el_bh_btn_link'); ?>>
													<?php echo  $settings['ma_el_bh_table_btn_text']; ?>
												</a>
											</div>
										<?php } ?>


										<?php if (($settings['ma_el_bh_show_button'] == 'yes') &&
											($settings['ma_el_business_hours_style'] !== 'content-corner-btn') &&
											($settings['ma_el_business_hours_style'] !== 'table-reservation')
										) { ?>
											<div class="jltma-business-hour-content-bottom">
												<a <?php echo $this->get_render_attribute_string('ma_el_bh_normal_btn'); ?>>
													<?php echo  $settings['ma_el_bh_table_btn_text']; ?>
													<i class="fa fa-arrow-right"></i>
												</a>
											</div><!-- /.jltma-business-hour-content-bottom -->
										<?php } ?>


									</div>

									<?php if (($settings['ma_el_business_hours_style'] == 'content-corner-btn') || ($settings['ma_el_business_hours_style'] == 'table-reservation')) { ?>
									</div>
								</div>
							<?php } ?>

						</div>
				<?php
				}
			}
