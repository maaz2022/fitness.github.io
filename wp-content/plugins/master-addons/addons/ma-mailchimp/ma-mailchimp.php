<?php

namespace MasterAddons\Addons;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 1/1/20
 */


if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Mailchimp extends Widget_Base
{

	public function get_name()
	{
		return 'ma-el-mailchimp';
	}

	public function get_title()
	{
		return __('Mailchimp', 'master-addons' );
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-mailchimp';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/mailchimp/';
	}

	public function jltma_get_forms()
	{

		$options = array(0 => __('Select Form', 'master-addons' ));

		if (!function_exists('mc4wp_get_forms')) {
			return $options;
		}
		$forms = mc4wp_get_forms();
		foreach ($forms as $form) {
			$options[$form->ID] = $form->name;
		}

		return $options;
	}


	protected function register_controls()
	{

		/*
			 * Content Tab
			 */
		$this->start_controls_section(
			'jltma_mailchimp_form_section',
			[
				'label'      => __('Form', 'master-addons' )
			]
		);

		//			You can edit your sign-up form in the Mailchimp for WordPress form settings.

		$this->add_control(
			'jltma_mailchimp_form_type',
			[
				'label'       => __('Form Type', 'master-addons' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'default',
				'options'     => array(
					'default' => __('Defaults', 'master-addons' ),
					'custom'  => __('Custom', 'master-addons' )
				)
			]
		);

		$this->add_control(
			'jltma_mailchimp_form_id',
			array(
				'label'       => __('MailChimp Sign-Up Form', 'master-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT,
				'default'     => 0,
				'options'     => $this->jltma_get_forms(),
				'condition'   => array(
					'jltma_mailchimp_form_type' => array('default')
				)
			)
		);

		$this->add_control(
			'jltma_mailchimp_html',
			array(
				'label'       => __('Custom Form', 'master-addons' ),
				'type'        => Controls_Manager::CODE,
				'language'    => 'html',
				'description' => __('Enter your custom form markup', 'master-addons' ),
				'condition'   => array(
					'jltma_mailchimp_form_type' => array('custom')
				)
			)
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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/mailchimp/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/mailchimp-element/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=hST5tycqCsw" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);
		$this->end_controls_section();



		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'jltma_section_pro_style_section',
				[
					'label' => esc_html__('Upgrade to Pro', 'master-addons' )
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


	public function jltma_render_custom_form($content)
	{
		$settings = $this->get_settings_for_display();

		if (!empty($settings['jltma_mailchimp_html'])) {
			$content = $settings['jltma_mailchimp_html'];
		}
		return $content;
	}


	protected function render()
	{
		$settings = $this->get_settings_for_display();

		// Check whether required resources are available
		if (!function_exists('mc4wp_show_form')) {
			Master_Addons_Helper::jltma_elementor_plugin_missing_notice(array('plugin_name' => esc_html__(
				'MailChimp',
				'master-addons' 
			)));
			return;
		}

		if ($settings['jltma_mailchimp_form_type'] === 'custom') {
			add_filter('mc4wp_form_content', array($this, 'jltma_render_custom_form'), 10, 1);
			$settings['jltma_mailchimp_form_id'] = 0;
		} elseif (get_post_type($settings['jltma_mailchimp_form_id']) !== 'mc4wp-form') {
			$settings['jltma_mailchimp_form_id'] = 0;
		}

		return mc4wp_show_form($settings['jltma_mailchimp_form_id']);
	}
}
