<?php

namespace MasterAddons\Modules\DynamicTags\Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class JLTMA_Author_Info extends Tag
{

	public function get_name()
	{
		return 'jltma-author-info';
	}

	public function get_title()
	{
		return esc_html__('Author Info', 'master-addons' );
	}

	public function get_group()
	{
		return 'author';
	}

	public function get_categories()
	{
		return [TagsModule::TEXT_CATEGORY];
	}

	public function render()
	{
		$key = $this->get_settings('key');

		if (empty($key)) {
			return;
		}

		$value = get_the_author_meta($key);

		echo wp_kses_post($value);
	}

	public function get_panel_template_setting_key()
	{
		return 'key';
	}

	protected function register_controls()
	{
		$this->add_control(
			'key',
			[
				'label' => esc_html__('Field', 'master-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'description',
				'options' => [
					'description' => esc_html__('Bio', 'master-addons' ),
					'email' => esc_html__('Email', 'master-addons' ),
					'url' => esc_html__('Website', 'master-addons' ),
				],
			]
		);
	}
}
