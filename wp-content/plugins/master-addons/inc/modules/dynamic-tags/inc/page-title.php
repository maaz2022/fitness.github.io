<?php

namespace MasterAddons\Modules\DynamicTags\Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use MasterAddons\Inc\Helper\Master_Addons_Helper;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class JLTMA_Page_Title extends Tag
{

	public function get_name()
	{
		return 'jltma-page-title';
	}

	public function get_title()
	{
		return esc_html__('Page Title', 'master-addons' );
	}

	public function get_group()
	{
		return 'site';
	}

	public function get_categories()
	{
		return [TagsModule::TEXT_CATEGORY];
	}

	public function render()
	{
		if (is_home() && 'yes' !== $this->get_settings('show_home_title')) {
			return;
		}

		$include_context = 'yes' === $this->get_settings('include_context');

		$title = Master_Addons_Helper::jltma_get_page_title($include_context);

		echo wp_kses_post($title);
	}

	protected function register_controls()
	{
		$this->add_control(
			'include_context',
			[
				'label' => esc_html__('Include Context', 'master-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_home_title',
			[
				'label' => esc_html__('Show Home Title', 'master-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
	}
}
