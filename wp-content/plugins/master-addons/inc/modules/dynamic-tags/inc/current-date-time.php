<?php

namespace MasterAddons\Modules\DynamicTags\Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class JLTMA_Current_Date_Time extends Tag
{

	public function get_name()
	{
		return 'jltma-current-date-time';
	}

	public function get_title()
	{
		return esc_html__('Current Date Time', 'master-addons' );
	}

	public function get_group()
	{
		return 'site';
	}

	public function get_categories()
	{
		return [TagsModule::TEXT_CATEGORY];
	}

	protected function register_controls()
	{
		$this->add_control(
			'date_format',
			[
				'label' => esc_html__('Date Format', 'master-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__('Default', 'master-addons' ),
					'' => esc_html__('None', 'master-addons' ),
					'F j, Y' => date('F j, Y'),
					'Y-m-d' => date('Y-m-d'),
					'm/d/Y' => date('m/d/Y'),
					'd/m/Y' => date('d/m/Y'),
					'custom' => esc_html__('Custom', 'master-addons' ),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'time_format',
			[
				'label' => esc_html__('Time Format', 'master-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__('Default', 'master-addons' ),
					'' => esc_html__('None', 'master-addons' ),
					'g:i a' => date('g:i a'),
					'g:i A' => date('g:i A'),
					'H:i' => date('H:i'),
				],
				'default' => 'default',
				'condition' => [
					'date_format!' => 'custom',
				],
			]
		);

		$this->add_control(
			'custom_format',
			[
				'label' => esc_html__('Custom Format', 'master-addons' ),
				'default' => get_option('date_format') . ' ' . get_option('time_format'),
				'description' => sprintf('<a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">%s</a>', esc_html__('Documentation on date and time formatting', 'master-addons' )),
				'condition' => [
					'date_format' => 'custom',
				],
			]
		);
	}

	public function render()
	{
		$settings = $this->get_settings();

		if ('custom' === $settings['date_format']) {
			$format = $settings['custom_format'];
		} else {
			$date_format = $settings['date_format'];
			$time_format = $settings['time_format'];
			$format = '';

			if ('default' === $date_format) {
				$date_format = get_option('date_format');
			}

			if ('default' === $time_format) {
				$time_format = get_option('time_format');
			}

			if ($date_format) {
				$format = $date_format;
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

		$value = date_i18n($format);

		echo wp_kses_post($value);
	}
}
