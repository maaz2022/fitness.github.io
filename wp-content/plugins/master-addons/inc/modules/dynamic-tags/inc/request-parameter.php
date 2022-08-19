<?php

namespace MasterAddons\Modules\DynamicTags\Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class JLTMA_Request_Parameter extends Tag
{
	public function get_name()
	{
		return 'jltma-request-parameter';
	}

	public function get_title()
	{
		return esc_html__('Request Parameter', 'master-addons' );
	}

	public function get_group()
	{
		return 'site';
	}

	public function get_categories()
	{
		return [
			TagsModule::TEXT_CATEGORY,
			TagsModule::POST_META_CATEGORY,
		];
	}

	public function render()
	{
		$settings = $this->get_settings();
		$request_type = isset($settings['request_type']) ? strtoupper(sanitize_text_field($settings['request_type'])) : false;
		$param_name = isset($settings['param_name']) ? sanitize_text_field($settings['param_name']) : false;
		$value = '';

		if (!$param_name || !$request_type) {
			return '';
		}

		switch ($request_type) {
			case 'POST':
				if (!isset($_POST[$param_name])) {
					return '';
				}
				$value = sanitize_text_field($_POST[$param_name]);
				break;
			case 'GET':
				if (!isset($_GET[$param_name])) {
					return '';
				}
				$value = sanitize_text_field($_GET[$param_name]);
				break;
			case 'QUERY_VAR':
				$value = sanitize_text_field( get_query_var($param_name) );
				break;
		}
		echo wp_kses_post($value);
	}

	protected function register_controls()
	{
		$this->add_control(
			'request_type',
			[
				'label'   => esc_html__('Type', 'master-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'get',
				'options' => [
					'get' => 'Get',
					'post' => 'Post',
					'query_var' => 'Query Var',
				],
			]
		);
		$this->add_control(
			'param_name',
			[
				'label'   => esc_html__('Parameter Name', 'master-addons' ),
				'type' => Controls_Manager::TEXT,
			]
		);
	}
}
