<?php

namespace MasterAddons\Modules\DynamicTags\Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class JLTMA_Comments_Number extends Tag
{

	public function get_name()
	{
		return 'jltma-comments-number';
	}

	public function get_title()
	{
		return esc_html__('Comments Number', 'master-addons' );
	}

	public function get_group()
	{
		return 'comments';
	}

	public function get_categories()
	{
		return [TagsModule::TEXT_CATEGORY];
	}

	protected function register_controls()
	{
		$this->add_control(
			'format_no_comments',
			[
				'label' => esc_html__('No Comments Format', 'master-addons' ),
				'default' => esc_html__('No Responses', 'master-addons' ),
			]
		);

		$this->add_control(
			'format_one_comments',
			[
				'label' => esc_html__('One Comment Format', 'master-addons' ),
				'default' => esc_html__('One Response', 'master-addons' ),
			]
		);

		$this->add_control(
			'format_many_comments',
			[
				'label' => esc_html__('Many Comment Format', 'master-addons' ),
				'default' => esc_html__('{number} Responses', 'master-addons' ),
			]
		);

		$this->add_control(
			'link_to',
			[
				'label' => esc_html__('Link', 'master-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('None', 'master-addons' ),
					'comments_link' => esc_html__('Comments Link', 'master-addons' ),
				],
			]
		);
	}

	public function render()
	{
		$settings = $this->get_settings();

		$comments_number = get_comments_number();

		if (!$comments_number) {
			$count = $settings['format_no_comments'];
		} elseif (1 === $comments_number) {
			$count = $settings['format_one_comments'];
		} else {
			$count = strtr($settings['format_many_comments'], [
				'{number}' => number_format_i18n($comments_number),
			]);
		}

		if ('comments_link' === $this->get_settings('link_to')) {
			$count = sprintf('<a href="%s">%s</a>', get_comments_link(), $count);
		}

		echo wp_kses_post($count);
	}
}
