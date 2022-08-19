<?php

namespace MasterAddons\Inc\Templates\Classes;

use MasterAddons\Inc\Templates;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 9/8/19
 */


if (!defined('ABSPATH')) exit;

if (!class_exists('Master_Addons_Templates_Manager')) {


	class Master_Addons_Templates_Manager
	{

		private static $instance = null;

		private $sources = array();


		public function __construct()
		{

			//Register AJAX hooks
			add_action('wp_ajax_jltma_get_templates', array($this, 'get_templates'));
			add_action('wp_ajax_nopriv_jltma_get_templates', array($this, 'get_templates'));

			add_action('wp_ajax_jltma_inner_template', array($this, 'jltma_insert_inner_template'));
			add_action('wp_ajax_nopriv_jltma_inner_template', array($this, 'jltma_insert_inner_template'));


			if (defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, '2.2.8', '>')) {
				add_action('elementor/ajax/register_actions', array($this, 'jltma_register_ajax_actions'), 20);
			} else {
				add_action('wp_ajax_elementor_get_template_data', array($this, 'get_template_data'), -1);
			}

			$this->register_sources();

			add_filter('master-addons-core/assets/editor/localize', array($this, 'localize_tabs'));
		}


		public function localize_tabs($data)
		{

			$tabs    = $this->get_template_tabs();
			$ids     = array_keys($tabs);
			$default = $ids[0];

			$data['tabs']       = $this->get_template_tabs();
			$data['defaultTab'] = $default;

			return $data;
		}


		public function register_sources()
		{

			require JLTMA_PATH . '/inc/templates/sources/base.php';

			$namespace = str_replace('Classes', 'Sources', __NAMESPACE__);

			$sources = array(
				'master-api'   =>  $namespace . '\Master_Addons_Templates_Source_Api',
			);

			foreach ($sources as $key => $class) {

				require JLTMA_PATH . '/inc/templates/sources/' . $key . '.php';

				$this->add_source($key, $class);
			}
		}


		public function get_template_tabs()
		{

			$tabs = Templates\master_addons_templates()->types->get_types_for_popup();

			return $tabs;
		}


		public function add_source($key, $class)
		{
			$this->sources[$key] = new $class();
		}


		public function get_source($slug = null)
		{
			return isset($this->sources[$slug]) ? $this->sources[$slug] : false;
		}



		public function get_templates()
		{
			check_ajax_referer('jltma_get_templates_nonce_action', 'security');

			if (!current_user_can('edit_posts')) {
				wp_send_json_error();
			}

			$tab     = sanitize_key($_GET['tab']);
			$tabs    = $this->get_template_tabs();
			$sources = $tabs[$tab]['sources'];

			$result = array(
				//					'ready_pages'  => array(),
				//					'ready_widgets'  => array(),
				'ready_headers'  => array(),
				'ready_footers'  => array(),
				'templates'  => array(),
				'categories' => array(),
				'keywords'   => array(),
			);

			foreach ($sources as $source_slug) {

				$source = isset($this->sources[$source_slug]) ? $this->sources[$source_slug] : false;

				if ($source) {
					// $result['ready_pages']  = array_merge( $result['ready_pages'], $source->get_items( $tab ) );
					$result['ready_headers']  = array_merge($result['ready_headers'], $source->get_items($tab));
					$result['ready_footers']  = array_merge($result['ready_footers'], $source->get_items($tab));
					$result['templates']  = array_merge($result['templates'], $source->get_items($tab));
					$result['categories'] = array_merge($result['categories'], $source->get_categories($tab));
					$result['keywords']   = array_merge($result['keywords'], $source->get_keywords($tab));
				}
			}


			$all_cats = array(
				array(
					'slug' => '',
					'title' => __('All Sections', 'master-addons' ),
				),
			);

			if (!empty($result['categories'])) {
				$result['categories'] = array_merge($all_cats, $result['categories']);
			}

			wp_send_json_success($result);
		}

		public function get_template_source($source_name)
		{
			return isset($this->sources[$source_name]) ? $this->sources[$source_name] : false;
		}

		public function get_template_defaults()
		{
			return [
				'template_id' => false,
				'source' => false,
			];
		}

		public function sanitize_template(array $template)
		{

			$template = array_merge($this->get_template_defaults(), $template);

			$template['template_id'] = isset($template['template_id']) ? sanitize_text_field($template['template_id']) : false;
			$template['source'] = isset($template['source']) ? sanitize_text_field($template['source']) : false;

			return $template;
		}

		/*
		* Insert Template
		*/
		public function jltma_insert_inner_template()
		{
			check_ajax_referer('jltma_insert_templates_nonce_action', 'security');

			if (!current_user_can('edit_posts')) {
				wp_send_json_error();
			}

			$template = isset($_REQUEST['template']) ? $this->sanitize_template((array) $_REQUEST['template']) : false;

			if (!$template) {
				wp_send_json_error();
			}

			$source = $this->get_template_source($template['source']);

			if (!$source || !$template['template_id']) {
				wp_send_json_error();
			}

			$template_data = $source->get_item($template['template_id']);

			if (!empty($template_data['content'])) {
				wp_insert_post(array(
					'post_type'   => 'elementor_library',
					'post_title'  => sanitize_text_field($template['title']),
					'post_status' => 'publish',
					'meta_input'  => array(
						'_elementor_data'          => $template_data['content'], // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'_elementor_edit_mode'     => 'builder',
						'_elementor_template_type' => 'section',
					),
				));
			}

			wp_send_json_success();
		}


		public function jltma_register_ajax_actions($ajax_manager)
		{

			if (empty($_REQUEST['actions'])) {
				return;
			}

			$actions     = (array) json_decode(stripslashes(sanitize_text_field($_REQUEST['actions'])), true);
			$data        = false;

			foreach ($actions as $id => $action_data) {
				if (!isset($action_data['get_template_data'])) {
					$data = $action_data;
				}
			}

			if (!$data) {
				return;
			}

			if (!isset($data['data'])) {
				return;
			}

			if (!isset($data['data']['source'])) {
				return;
			}

			$source = $data['data']['source'];

			if (!isset($this->sources[$source])) {
				return;
			}

			$ajax_manager->register_ajax_action('get_template_data', function ($data) {
				return $this->get_template_data_array($data);
			});
		}

		public function get_template_data_array($data)
		{

			if (!current_user_can('edit_posts')) {
				return false;
			}

			if (empty($data['template_id'])) {
				return false;
			}

			$source_name = isset($data['source']) ? esc_attr($data['source']) : '';


			if (!$source_name) {
				return false;
			}

			$source = isset($this->sources[$source_name]) ? $this->sources[$source_name] : false;

			if (!$source) {
				return false;
			}

			if (empty($data['tab'])) {
				return false;
			}

			$template = $source->get_item($data['template_id'], $data['tab']);

			return $template;
		}


		public function get_template_data()
		{

			$template = $this->get_template_data_array($_REQUEST);

			if (!$template) {
				wp_send_json_error();
			}

			wp_send_json_success($template);
		}


		public static function get_instance()
		{

			// If the single instance hasn't been set, set it now.
			if (null == self::$instance) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}
