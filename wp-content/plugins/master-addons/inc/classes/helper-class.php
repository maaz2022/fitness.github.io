<?php

namespace MasterAddons\Inc\Helper;

use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Core\Responsive\Responsive;

class Master_Addons_Helper
{

	public static function jltma_elementor()
	{
		return \Elementor\Plugin::$instance;
	}

	/**
	 * Check if Woocommerce is installed and active
	 *
	 * @since 1.5.7
	 */
	public static function is_woocommerce_active()
	{
		return in_array(
			'woocommerce/woocommerce.php',
			apply_filters('active_plugins', get_option('active_plugins'))
		);
	}


	/**
	 * Get data if isset.
	 * Retrieves data with selected key if isset.
	 * @param array|object $data Data to check.
	 * @param string $key Data key to look for.
	 * @param string $else Default value if key is not found.
	 *
	 * @return mixed Data with selected key, default value otherwise.
	 */
	public static function get_if_isset($data, $key, $else = '')
	{
		if ('object' === gettype($data)) {
			return isset($data->{$key}) ? $data->{$key} : $else;
		}

		return isset($data[$key]) ? $data[$key] : $else;
	}

	/**
	 * Get data if not empty.
	 * Retrieves data with selected key if not empty.
	 * @param array $data Array of data.
	 * @param string $key Data key to look for.
	 * @param string $else Default value if key is empty.
	 *
	 * @return mixed Data with selected key, default value otherwise.
	 */
	public static function get_if_not_empty($data, $key, $else = '')
	{
		return (!empty($data[$key])) ? $data[$key] : $else;
	}


	/**
	 * Check if value in array or equal.
	 *
	 * If `$haystack` is array - checks if `$needle` is in
	 * `$haystack` array, or if they are equal otherwise.
	 * @param string $needle Test value.
	 * @param mixed $haystack Array or value to check.
	 * @return bool True if `$needle` is in array or equal to
	 * `$haystack`, false otherwise.
	 */
	public static function in_array_or_equal($needle, $haystack)
	{
		if (is_array($haystack)) {
			return in_array($needle, $haystack, true);
		}

		return $needle === $haystack;
	}

	public static function generate_html_tag($name, $attributes = array(), $content = false)
	{
		if (is_array($attributes)) {
			$attributes_array = array();

			foreach ($attributes as $key => $value) {
				$attributes_array[] = sprintf("{$key}=\"%s\"", esc_attr($value));
			}

			$attributes = sprintf(' %s', implode(' ', $attributes_array));
		} else {
			$attributes = " {$attributes}";
		}

		$tag = "<{$name}{$attributes}>";

		if ($content) {
			$tag .= "{$content}</{$name}>";
		}

		return $tag;
	}

	/**
	 * Get class name.
	 * Converts string to valid class name.
	 * @param string $name The name string.
	 * @return array The class name.
	 */
	public static function generate_class_name($name)
	{
		return str_replace('-', '_', ucwords($name, '-'));
	}


	/**
	 * Unset key by value.
	 * Unset array items by value.
	 * @param string $needle The searchable value.
	 * @param array $haystack The array to search.
	 *
	 * @return array The filtered array.
	 */
	public static function unset_items_by_value($needle, $haystack)
	{
		foreach (array_keys($haystack, $needle, true) as $key) {
			unset($haystack[$key]);
		}

		return $haystack;
	}

	/**
	 * Check if request is ajax.
	 *
	 * Whether the current request is a WordPress ajax request.
	 *
	 * @since 1.0.0
	 *
	 * @return bool True if it's a WordPress ajax request, false otherwise.
	 */
	public static function is_ajax()
	{
		if (function_exists('wp_doing_ajax')) {
			return wp_doing_ajax();
		}

		return defined('DOING_AJAX') && DOING_AJAX;
	}

	/**
	 * Get breakpoints.
	 *
	 * Retrieve the responsive breakpoints with BC for Elementor version < 3.2.0.
	 *
	 * @return array Responsive breakpoints.
	 */
	public static function get_breakpoints()
	{
		if (version_compare(ELEMENTOR_VERSION, '3.2.0', '>=')) {
			$breakpoints = self::jltma_elementor()->breakpoints->get_breakpoints();
		} else {
			$old_breakpoints = Responsive::get_breakpoints();
			$breakpoints = $old_breakpoints;

			$breakpoints['mobile'] = $old_breakpoints['md'];
			$breakpoints['tablet'] = $old_breakpoints['lg'];
		}

		return $breakpoints;
	}

	/**
	 * Check if request is preview.
	 *
	 * Whether the current request is elementor preview mode or
	 * WordPress preview.
	 * @param int $post_id Post ID.
	 *
	 * @return bool True if it's a preview request, false otherwise.
	 */
	public static function is_preview($post_id = 0)
	{
		return self::is_preview_mode($post_id) || is_preview();
	}

	/**
	 * Check if request is preview mode.
	 *
	 * Whether the current request is elementor preview mode.
	 *
	 * @return bool True if it's an elementor preview mode, false otherwise.
	 */
	public static function is_preview_mode($post_id = 0)
	{
		return self::jltma_elementor()->preview->is_preview_mode($post_id);
	}

	public static function jltma_is_edit_mode($post_id = 0)
	{
		if (self::jltma_elementor()->preview->is_preview_mode() || self::jltma_elementor()->editor->is_edit_mode($post_id)) {
			return true;
		}
		return false;
	}


	/**
	 * Retrive the list of Contact Form 7 Forms [ if plugin activated ]
	 */

	public static function maad_el_retrive_cf7()
	{
		if (function_exists('wpcf7')) {
			$wpcf7_form_list = get_posts(array(
				'post_type' => 'wpcf7_contact_form',
				'showposts' => 999,
			));
			$options = array();
			$options[0] = esc_html__('Select a Form', 'master-addons' );
			if (!empty($wpcf7_form_list) && !is_wp_error($wpcf7_form_list)) {
				foreach ($wpcf7_form_list as $post) {
					$options[$post->ID] = $post->post_title;
				}
			} else {
				$options[0] = esc_html__('Create a Form First', 'master-addons' );
			}
			return $options;
		}
	}

	public static function get_page_template_options($type = '')
	{

		$page_templates = self::ma_get_page_templates($type);

		$options[-1]   = __('Select', 'master-addons' );

		if (count($page_templates)) {
			foreach ($page_templates as $id => $name) {
				$options[$id] = $name;
			}
		} else {
			$options['no_template'] = __('No saved templates found!', 'master-addons' );
		}

		return $options;
	}


	public static function ma_get_page_templates($type = '')
	{
		$args = [
			'post_type'         => 'elementor_library',
			'posts_per_page'    => -1,
		];

		if ($type) {
			$args['tax_query'] = [
				[
					'taxonomy' => 'elementor_library_type',
					'field'    => 'slug',
					'terms' => $type,
				]
			];
		}

		$page_templates = get_posts($args);

		$options = array();

		if (!empty($page_templates) && !is_wp_error($page_templates)) {
			foreach ($page_templates as $post) {
				$options[$post->ID] = $post->post_title;
			}
		}
		return $options;
	}


	// Get all forms of Ninja Forms plugin
	public static function ma_el_get_ninja_forms()
	{
		if (class_exists('Ninja_Forms')) {
			$options = array();

			$contact_forms = Ninja_Forms()->form()->get_forms();

			if (!empty($contact_forms) && !is_wp_error($contact_forms)) {

				$i = 0;

				foreach ($contact_forms as $form) {
					if ($i == 0) {
						$options[0] = esc_html__('Select a Contact form', 'master-addons' );
					}
					$options[$form->get_id()] = $form->get_setting('title');
					$i++;
				}
			}
		} else {
			$options = array();
		}

		return $options;
	}


	// Get all forms of WPForms plugin
	public static function ma_el_get_wpforms_forms()
	{
		if (class_exists('WPForms')) {
			$options = array();

			$args = array(
				'post_type'         => 'wpforms',
				'posts_per_page'    => -1
			);

			$contact_forms = get_posts($args);

			if (!empty($contact_forms) && !is_wp_error($contact_forms)) {

				$i = 0;

				foreach ($contact_forms as $post) {
					if ($i == 0) {
						$options[0] = esc_html__('Select a Contact form', 'master-addons' );
					}
					$options[$post->ID] = $post->post_title;
					$i++;
				}
			}
		} else {
			$options = array();
		}

		return $options;
	}


	// get weForms
	public static function ma_el_get_weforms()
	{
		$wpuf_form_list = get_posts(array(
			'post_type' => 'wpuf_contact_form',
			'showposts' => 999,
		));

		$options = array();

		if (!empty($wpuf_form_list) && !is_wp_error($wpuf_form_list)) {
			$options[0] = esc_html__('Select weForm', 'master-addons' );
			foreach ($wpuf_form_list as $post) {
				$options[$post->ID] = $post->post_title;
			}
		} else {
			$options[0] = esc_html__('Create a Form First', 'master-addons' );
		}

		return $options;
	}

	// Get forms of Caldera plugin
	public static function ma_el_get_caldera_forms()
	{
		if (class_exists('Caldera_Forms')) {
			$options = array();

			$contact_forms = \Caldera_Forms_Forms::get_forms(true, true);

			if (!empty($contact_forms) && !is_wp_error($contact_forms)) {

				$i = 0;

				foreach ($contact_forms as $form) {
					if ($i == 0) {
						$options[0] = esc_html__('Select a Contact form', 'master-addons' );
					}
					$options[$form['ID']] = $form['name'];
					$i++;
				}
			}
		} else {
			$options = array();
		}

		return $options;
	}


	// Get forms of Gravity Forms plugin
	public static function ma_el_get_gravity_forms()
	{
		if (class_exists('GFCommon')) {
			$options = array();

			$contact_forms = \RGFormsModel::get_forms(null, 'title');

			if (!empty($contact_forms) && !is_wp_error($contact_forms)) {

				$i = 0;

				foreach ($contact_forms as $form) {
					if ($i == 0) {
						$options[0] = esc_html__('Select a Contact form', 'master-addons' );
					}
					$options[$form->id] = $form->title;
					$i++;
				}
			}
		} else {
			$options = array();
		}

		return $options;
	}


	/**
	 * Check if Elementor Pro active.
	 *
	 * Checks whether the Elementor Pro plugin is currently active.
	 *
	 * @return bool True if Elementor Pro is active, false otherwise.
	 */
	public static function is_elementor_pro()
	{
		return class_exists('ElementorPro\Plugin');
	}

	// Content Alignments
	public static function jltma_content_alignment()
	{
		$content_alignment = [
			'left'      => [
				'title' => __('Left', 'master-addons' ),
				'icon' => 'eicon-text-align-left',
			],
			'center'    => [
				'title' => __('Center', 'master-addons' ),
				'icon' => 'eicon-text-align-center',
			],
			'right'     => [
				'title' => __('Right', 'master-addons' ),
				'icon' => 'eicon-text-align-right',
			],
		];
		return $content_alignment;
	}

	// Justify Content Alignments
	public static function jltma_content_alignments()
	{
		$content_alignment = [
			'left'      => [
				'title' => __('Left', 'master-addons' ),
				'icon' => 'eicon-text-align-left',
			],
			'center'    => [
				'title' => __('Center', 'master-addons' ),
				'icon' => 'eicon-text-align-center',
			],
			'right'     => [
				'title' => __('Right', 'master-addons' ),
				'icon' => 'eicon-text-align-right',
			],
			'justify' => [
				'title' => __('Justify', 'master-addons' ),
				'icon'  => 'eicon-text-align-justify',
			],
		];
		return $content_alignment;
	}

	// Justify Flex Content Alignments
	public static function jltma_content_flex_alignments()
	{
		$content_alignment = [
			'flex-start'      => [
				'title' => __('Left', 'master-addons' ),
				'icon' => 'eicon-text-align-left',
			],
			'center'    => [
				'title' => __('Center', 'master-addons' ),
				'icon' => 'eicon-text-align-center',
			],
			'flex-end'     => [
				'title' => __('Right', 'master-addons' ),
				'icon' => 'eicon-text-align-right',
			],
			'space-between' => [
				'title' => __('Justify', 'master-addons' ),
				'icon'  => 'eicon-text-align-justify',
			],
		];
		return $content_alignment;
	}

	// Heading Tags
	public static function jltma_heading_tags()
	{
		$heading_tags = [
			'h1'  => [
				'title' => __('H1', 'master-addons' ),
				'icon'  => 'eicon-editor-h1'
			],
			'h2'  => [
				'title' => __('H2', 'master-addons' ),
				'icon'  => 'eicon-editor-h2'
			],
			'h3'  => [
				'title' => __('H3', 'master-addons' ),
				'icon'  => 'eicon-editor-h3'
			],
			'h4'  => [
				'title' => __('H4', 'master-addons' ),
				'icon'  => 'eicon-editor-h4'
			],
			'h5'  => [
				'title' => __('H5', 'master-addons' ),
				'icon'  => 'eicon-editor-h5'
			],
			'h6'  => [
				'title' => __('H6', 'master-addons' ),
				'icon'  => 'eicon-editor-h6'
			]
		];

		return $heading_tags;
	}

	// Title Tags
	public static function jltma_title_tags()
	{
		$title_tags = [
			'h1'     => esc_html__('H1', 'master-addons' ),
			'h2'     => esc_html__('H2', 'master-addons' ),
			'h3'     => esc_html__('H3', 'master-addons' ),
			'h4'     => esc_html__('H4', 'master-addons' ),
			'h5'     => esc_html__('H5', 'master-addons' ),
			'h6'     => esc_html__('H6', 'master-addons' ),
			'div'    => esc_html__('div', 'master-addons' ),
			'span'   => esc_html__('span', 'master-addons' ),
			'p'      => esc_html__('p', 'master-addons' ),
			'button' => esc_html__('button', 'master-addons' ),
			'a'      => esc_html__('a', 'master-addons' ),
		];

		return $title_tags;
	}


	// Master Addons Position
	public static function ma_el_content_positions()
	{
		$position_options = [
			''              => esc_html__('Default', 'master-addons' ),
			'top-left'      => esc_html__('Top Left', 'master-addons' ),
			'top-center'    => esc_html__('Top Center', 'master-addons' ),
			'top-right'     => esc_html__('Top Right', 'master-addons' ),
			'center'        => esc_html__('Center', 'master-addons' ),
			'center-left'   => esc_html__('Center Left', 'master-addons' ),
			'center-right'  => esc_html__('Center Right', 'master-addons' ),
			'bottom-left'   => esc_html__('Bottom Left', 'master-addons' ),
			'bottom-center' => esc_html__('Bottom Center', 'master-addons' ),
			'bottom-right'  => esc_html__('Bottom Right', 'master-addons' ),
		];

		return $position_options;
	}



	// Master Addons Transition
	public static function ma_el_transition_options()
	{
		$transition_options = [
			''                    => __('None', 'master-addons' ),
			'fade'                => __('Fade', 'master-addons' ),
			'scale-up'            => __('Scale Up', 'master-addons' ),
			'scale-down'          => __('Scale Down', 'master-addons' ),
			'slide-top'           => __('Slide Top', 'master-addons' ),
			'slide-bottom'        => __('Slide Bottom', 'master-addons' ),
			'slide-left'          => __('Slide Left', 'master-addons' ),
			'slide-right'         => __('Slide Right', 'master-addons' ),
			'slide-top-small'     => __('Slide Top Small', 'master-addons' ),
			'slide-bottom-small'  => __('Slide Bottom Small', 'master-addons' ),
			'slide-left-small'    => __('Slide Left Small', 'master-addons' ),
			'slide-right-small'   => __('Slide Right Small', 'master-addons' ),
			'slide-top-medium'    => __('Slide Top Medium', 'master-addons' ),
			'slide-bottom-medium' => __('Slide Bottom Medium', 'master-addons' ),
			'slide-left-medium'   => __('Slide Left Medium', 'master-addons' ),
			'slide-right-medium'  => __('Slide Right Medium', 'master-addons' ),
		];

		return $transition_options;
	}


	// Master Addons Animations
	public static function jltma_animation_options()
	{
		$transition_options = [
			''                             =>  esc_html__('None', 'master-addons' ),
			'jltma-fade-in'                =>  esc_html__('Fade In', 'master-addons' ),
			'jltma-fade-in-down'           =>  esc_html__('Fade In Down', 'master-addons' ),
			'jltma-fade-in-down-1'         =>  esc_html__('Fade In Down 1', 'master-addons' ),
			'jltma-fade-in-down-2'         =>  esc_html__('Fade In Down 2', 'master-addons' ),
			'jltma-fade-in-up'             =>  esc_html__('Fade In Up', 'master-addons' ),
			'jltma-fade-in-up-1'           =>  esc_html__('Fade In Up 1', 'master-addons' ),
			'jltma-fade-in-up-2'           =>  esc_html__('Fade In Up 2', 'master-addons' ),
			'jltma-fade-in-left'           =>  esc_html__('Fade In Left', 'master-addons' ),
			'jltma-fade-in-left-1'         =>  esc_html__('Fade In Left 1', 'master-addons' ),
			'jltma-fade-in-left-2'         =>  esc_html__('Fade In Left 2', 'master-addons' ),
			'jltma-fade-in-right'          =>  esc_html__('Fade In Right', 'master-addons' ),
			'jltma-fade-in-right-1'        =>  esc_html__('Fade In Right 1', 'master-addons' ),
			'jltma-fade-in-right-2'        =>  esc_html__('Fade In Right 2', 'master-addons' ),

			// Slide Animation
			'jltma-slide-from-right'       =>  esc_html__('Slide From Right', 'master-addons' ),
			'jltma-slide-from-left'        =>  esc_html__('Slide From Left', 'master-addons' ),
			'jltma-slide-from-top'         =>  esc_html__('Slide From Top', 'master-addons' ),
			'jltma-slide-from-bot'         =>  esc_html__('Slide From Bottom', 'master-addons' ),

			// Mask Animation
			'jltma-mask-from-top'          =>  esc_html__('Mask From Top', 'master-addons' ),
			'jltma-mask-from-bot'          =>  esc_html__('Mask From Bottom', 'master-addons' ),
			'jltma-mask-from-left'         =>  esc_html__('Mask From Left', 'master-addons' ),
			'jltma-mask-from-right'        =>  esc_html__('Mask From Right', 'master-addons' ),

			'jltma-rotate-in'              =>  esc_html__('Rotate In', 'master-addons' ),
			'jltma-rotate-in-down-left'    =>  esc_html__('Rotate In Down Left', 'master-addons' ),
			'jltma-rotate-in-down-left-1'  =>  esc_html__('Rotate In Down Left 1', 'master-addons' ),
			'jltma-rotate-in-down-left-2'  =>  esc_html__('Rotate In Down Left 2', 'master-addons' ),
			'jltma-rotate-in-down-right'   =>  esc_html__('Rotate In Down Right', 'master-addons' ),
			'jltma-rotate-in-down-right-1' =>  esc_html__('Rotate In Down Right 1', 'master-addons' ),
			'jltma-rotate-in-down-right-2' =>  esc_html__('Rotate In Down Right 2', 'master-addons' ),
			'jltma-rotate-in-up-left'      =>  esc_html__('Rotate In Up Left', 'master-addons' ),
			'jltma-rotate-in-up-left-1'    =>  esc_html__('Rotate In Up Left 1', 'master-addons' ),
			'jltma-rotate-in-up-left-2'    =>  esc_html__('Rotate In Up Left 2', 'master-addons' ),
			'jltma-rotate-in-up-right'     =>  esc_html__('Rotate In Up Right', 'master-addons' ),
			'jltma-rotate-in-up-right-1'   =>  esc_html__('Rotate In Up Right 1', 'master-addons' ),
			'jltma-rotate-in-up-right-2'   =>  esc_html__('Rotate In Up Right 2', 'master-addons' ),

			'jltma-zoom-in'                =>  esc_html__('Zoom In', 'master-addons' ),
			'jltma-zoom-in-1'              =>  esc_html__('Zoom In 1', 'master-addons' ),
			'jltma-zoom-in-2'              =>  esc_html__('Zoom In 2', 'master-addons' ),
			'jltma-zoom-in-3'              =>  esc_html__('Zoom In 3', 'master-addons' ),

			'jltma-scale-up'               =>  esc_html__('Scale Up', 'master-addons' ),
			'jltma-scale-up-1'             =>  esc_html__('Scale Up 1', 'master-addons' ),
			'jltma-scale-up-2'             =>  esc_html__('Scale Up 2', 'master-addons' ),

			'jltma-scale-down'             =>  esc_html__('Scale Down', 'master-addons' ),
			'jltma-scale-down-1'           =>  esc_html__('Scale Down 1', 'master-addons' ),
			'jltma-scale-down-2'           =>  esc_html__('Scale Down 2', 'master-addons' ),

			'jltma-flip-in-down'           =>  esc_html__('Flip In Down', 'master-addons' ),
			'jltma-flip-in-down-1'         =>  esc_html__('Flip In Down 1', 'master-addons' ),
			'jltma-flip-in-down-2'         =>  esc_html__('Flip In Down 2', 'master-addons' ),
			'jltma-flip-in-up'             =>  esc_html__('Flip In Up', 'master-addons' ),
			'jltma-flip-in-up-1'           =>  esc_html__('Flip In Up 1', 'master-addons' ),
			'jltma-flip-in-up-2'           =>  esc_html__('Flip In Up 2', 'master-addons' ),
			'jltma-flip-in-left'           =>  esc_html__('Flip In Left', 'master-addons' ),
			'jltma-flip-in-left-1'         =>  esc_html__('Flip In Left 1', 'master-addons' ),
			'jltma-flip-in-left-2'         =>  esc_html__('Flip In Left 2', 'master-addons' ),
			'jltma-flip-in-left-3'         =>  esc_html__('Flip In Left 3', 'master-addons' ),
			'jltma-flip-in-right'          =>  esc_html__('Flip In Right', 'master-addons' ),
			'jltma-flip-in-right-1'        =>  esc_html__('Flip In Right 1', 'master-addons' ),
			'jltma-flip-in-right-2'        =>  esc_html__('Flip In Right 2', 'master-addons' ),
			'jltma-flip-in-right-3'        =>  esc_html__('Flip In Right 3', 'master-addons' ),

			'jltma-pulse'                  =>  esc_html__('Pulse In 1', 'master-addons' ),
			'jltma-pulse1'                 =>  esc_html__('Pulse In 2', 'master-addons' ),
			'jltma-pulse2'                 =>  esc_html__('Pulse In 3', 'master-addons' ),
			'jltma-pulse3'                 =>  esc_html__('Pulse In 4', 'master-addons' ),
			'jltma-pulse4'                 =>  esc_html__('Pulse In 5', 'master-addons' ),

			'jltma-pulse-out-1'            =>  esc_html__('Pulse Out 1', 'master-addons' ),
			'jltma-pulse-out-2'            =>  esc_html__('Pulse Out 2', 'master-addons' ),
			'jltma-pulse-out-3'            =>  esc_html__('Pulse Out 3', 'master-addons' ),
			'jltma-pulse-out-4'            =>  esc_html__('Pulse Out 4', 'master-addons' ),

			// Specials
			'jltma-shake'                  =>  esc_html__('Shake', 'master-addons' ),
			'jltma-bounce-in'              =>  esc_html__('Bounce In', 'master-addons' ),
			'jltma-jack-in-box'            =>  esc_html__('Jack In the Box', 'master-addons' )
		];

		return $transition_options;
	}


	public static function get_installed_theme()
	{

		$theme = wp_get_theme();

		if ($theme->parent()) {

			$theme_name = $theme->parent()->get('Name');
		} else {

			$theme_name = $theme->get('Name');
		}

		$theme_name = sanitize_key($theme_name);

		return $theme_name;
	}


	public static function ma_el_get_post_types()
	{
		$post_type_args = array(
			'public'            => true,
			'show_in_nav_menus' => true
		);

		$post_types = get_post_types($post_type_args, 'objects');
		$post_lists = array();
		foreach ($post_types as $post_type) {
			$post_lists[$post_type->name] = $post_type->labels->singular_name;
		}
		return $post_lists;
	}


	public static function ma_el_blog_post_type_categories()
	{
		$terms = get_terms(
			array(
				'taxonomy' => 'category',
				'hide_empty' => true,
			)
		);

		$options = array();

		if (!empty($terms) && !is_wp_error($terms)) {
			foreach ($terms as $term) {
				$options[$term->term_id] = $term->name;
			}
		}

		return $options;
	}


	public static function ma_el_blog_post_type_tags()
	{
		$tags = get_tags();

		$options = array();

		if (!empty($tags) && !is_wp_error($tags)) {
			foreach ($tags as $tag) {
				$options[$tag->term_id] = $tag->name;
			}
		}

		return $options;
	}

	public static function ma_el_blog_post_type_users()
	{
		$users = get_users();

		$options = array();

		if (!empty($users) && !is_wp_error($users)) {
			foreach ($users as $user) {
				if ($user->display_name !== 'wp_update_service') {
					$options[$user->ID] = $user->display_name;
				}
			}
		}

		return $options;
	}

	public static function ma_el_blog_posts_list()
	{
		$list = get_posts(array(
			'post_type'         => 'post',
			'posts_per_page'    => -1,
		));

		$options = array();

		if (!empty($list) && !is_wp_error($list)) {
			foreach ($list as $post) {
				$options[$post->ID] = $post->post_title;
			}
		}

		return $options;
	}



	public static function ma_el_blog_get_post_settings($settings)
	{

		$authors = $settings['ma_el_blog_users'];

		if (!empty($authors)) {
			$post_args['author'] = implode(',', $authors);
		}

		$post_args['category'] = $settings['ma_el_blog_categories'];

		$post_args['tag__in'] = $settings['ma_el_blog_tags'];

		$post_args['post__not_in']  = $settings['ma_el_blog_posts_exclude'];

		$post_args['order'] = $settings['ma_el_blog_order'];

		$post_args['orderby'] = $settings['ma_el_blog_order_by'];

		$post_args['posts_per_page'] = $settings['ma_el_blog_posts_per_page'];
		// $post_args['posts_per_page'] = $settings['ma_el_blog_total_posts_number'];

		$post_args['ignore_sticky_posts'] = $settings['ma_el_post_grid_ignore_sticky'];

		return $post_args;
	}

	public static function ma_el_blog_get_post_data($args, $paged, $new_offset)
	{
		$defaults = array(
			'author'                => '',
			'category'              => '',
			'orderby'               => '',
			'posts_per_page'        => 1,
			'paged'                 => $paged,
			'offset'                => $new_offset,
			'ignore_sticky_posts'   => 1,
		);

		$atts = wp_parse_args($args, $defaults);

		$posts = get_posts($atts);

		return $posts;
	}



	public static function ma_el_get_excerpt_by_id($post_id, $excerpt_length, $excerpt_type, $exceprt_text, $excerpt_src, $excerpt_icon, $excerpt_icon_align, $read_more_link)
	{

		$the_post = get_post($post_id);

		$the_excerpt = null;

		if ($the_post) {
			$the_excerpt = ($excerpt_src) ? $the_post->post_content : $the_post->post_excerpt;
		}

		$the_excerpt = strip_tags(strip_shortcodes($the_excerpt));

		$words = explode(' ', $the_excerpt, $excerpt_length + 1);

		if ($excerpt_icon) {
			// $excerpt_icon = $excerpt_icon;
			$excerpt_icon = self::jltma_fa_icon_picker('fas fa-chevron-right', 'icon', $excerpt_icon, 'blog_excerpt_icon');
		}

		if (count($words) > $excerpt_length) :
			array_pop($words);

			if ('three_dots' == $excerpt_type) {
				array_push($words, '…');
			} else {

				if ($read_more_link) {
					if ($excerpt_icon_align == "left") {
						array_push($words, '<br> <a href="' . get_permalink(
							$post_id
						) . '" class="ma-el-post-btn"> <i class="' . esc_attr($excerpt_icon) . '"></i>' . esc_html($exceprt_text) . '</a>');
					} elseif ($excerpt_icon_align == "right") {
						array_push($words, '<br> <a href="' . get_permalink($post_id) . '" class="ma-el-post-btn">' . esc_html($exceprt_text) . ' <i class="' . esc_attr($excerpt_icon) . '"></i></a>');
					} else {
						array_push($words, '<br> <a href="' . get_permalink($post_id) . '" class="ma-el-post-btn">' . esc_html($exceprt_text) . '</a>');
					}
				}
			}

			$the_excerpt = '<p>' . implode(' ', $words) . '</p>';
		endif;

		return $the_excerpt;
	}


	public static function jltma_custom_message($title, $content)
	{
		ob_start(); ?>

		<div class="elementor-alert elementor-alert-danger" role="alert">
			<span class="elementor-alert-title">
				<?php echo /* translators: %s: Title */ sprintf(esc_html__('%s !', 'master-addons' ), $title); ?>
			</span>
			<span class="elementor-alert-description">
				<?php echo /* translators: %s: Content */ sprintf(esc_html__('%s &nbsp;', 'master-addons' ), $content); ?>
			</span>
		</div>

	<?php
		$notice =  ob_get_clean();
		echo wp_kses_post($notice);
	}

	public static function jltma_render_alert($message, $type = 'warning', $admin_only = true)
	{
		echo self::get_elementor_alert($message, $type, $admin_only);
	}

	public static function get_elementor_alert($message, $type = 'warning', $admin_only = true)
	{
		if ($admin_only && !is_admin()) {
			return;
		}

		return sprintf('<div class="elementor-alert elementor-alert-%2$s">%1$s</div>', $message, esc_attr($type));
	}

	public static function jltma_elementor_plugin_missing_notice($args)
	{

		// default params
		$defaults = array(
			'plugin_name' => '',
			'echo'        => true
		);
		$args = wp_parse_args($args, $defaults);

		ob_start();
	?>
		<div class="elementor-alert elementor-alert-danger" role="alert">
			<span class="elementor-alert-title">
				<?php echo /* translators: %s: Plugin Name */ sprintf(esc_html__('"%s" Plugin is Not Activated!', 'master-addons' ), esc_html($args['plugin_name'])); ?>
			</span>
			<span class="elementor-alert-description">
				<?php esc_html_e(
					'In order to use this element, you need to install and activate this plugin.',
					'master-addons' 
				); ?>
			</span>
		</div>

		<?php

		$notice =  ob_get_clean();

		if (wp_validate_boolean($args['echo'])) {
			echo wp_kses_post($notice);
		} else {
			return $notice;
		}
	}



	public static function jltma_user_roles()
	{

		global $wp_roles;

		$all_roles  = $wp_roles->roles;
		$user_roles = [];

		if (!empty($all_roles)) {
			foreach ($all_roles as $key => $value) {
				$user_roles[$key] = $all_roles[$key]['name'];
			}
		}

		return $user_roles;
	}


	public static function jltma_warning_messaage($message, $type = 'warning', $close = true)
	{ ?>

		<div class="ma-el-alert elementor-alert elementor-alert-<?php echo esc_attr($type); ?>" role="alert">

			<span class="elementor-alert-title">
				<?php echo __('Sorry !!!', 'master-addons' ); ?>
			</span>

			<span class="elementor-alert-description">
				<?php echo wp_kses_post($message); ?>
			</span>

			<?php if ($close) : ?>
				<button type="button" class="elementor-alert-dismiss" data-dismiss="alert" aria-label="Close">X</button>
			<?php endif; ?>

		</div>

		<?php
	}

	// Check if True/False
	public static function jltma_is_true($var)
	{
		if (is_bool($var)) {
			return $var;
		}

		if (is_string($var)) {
			$var = strtolower($var);
			if (in_array($var, array('yes', 'on', 'true', 'checked'))) {
				return true;
			}
		}

		if (is_numeric($var)) {
			return (bool) $var;
		}

		return false;
	}


	// Get all forms of Formidable Forms plugin
	public static function jltma_elements_lite_get_formidable_forms()
	{
		if (class_exists('FrmForm')) {
			$options = array();

			$forms = FrmForm::get_published_forms(array(), 999, 'exclude');
			if (count($forms)) {
				$i = 0;
				foreach ($forms as $form) {
					if (0 === $i) {
						$options[0] = esc_html__('Select a Contact form', 'master-addons' );
					}
					$options[$form->id] = $form->name;
					$i++;
				}
			}
		} else {
			$options = array();
		}

		return $options;
	}


	// Get all forms of Fluent Forms plugin
	public static function jltma_elements_lite_get_fluent_forms()
	{
		$options = array();

		if (function_exists('wpFluentForm')) {

			global $wpdb;

			$result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}fluentform_forms");
			if ($result) {
				$options[0] = esc_html__('Select a Contact Form', 'master-addons' );
				foreach ($result as $form) {
					$options[$form->id] = $form->title;
				}
			} else {
				$options[0] = esc_html__('No forms found!', 'master-addons' );
			}
		}

		return $options;
	}


	// Tooltip Icon &
	public static function jltma_admin_tooltip_info($info_name, $info_url, $info_icon)
	{

		if (!empty($info_url)) { ?>
			<div class="jltma-tooltip-item tooltip-top">
				<i class="<?php echo esc_attr($info_icon); ?>"></i>
				<div class="jltma-tooltip-text">
					<a href="<?php echo esc_url($info_url); ?>" class="jltma-tooltip-content" target="_blank">
						<?php echo /* translators: %s: Content */ sprintf(esc_html__('%s &nbsp;', 'master-addons' ), $info_name); ?>
					</a>
				</div>
			</div>
<?php }
	}

	/**
	 * Get Taxonomies Options
	 *
	 * Fetches available taxonomies
	 *
	 * @since 1.4.8
	 */
	public static function get_taxonomies_options()
	{

		$options = [];

		$taxonomies = get_taxonomies(array(
			'show_in_nav_menus' => true
		), 'objects');

		if (empty($taxonomies)) {
			$options[''] = __('No taxonomies found', 'master-addons' );
			return $options;
		}

		foreach ($taxonomies as $taxonomy) {
			$options[$taxonomy->name] = $taxonomy->label;
		}

		return $options;
	}


	public static function jltma_post_types_category_slug()
	{

		$post_types = [
			'category' => esc_html__('Post', 'master-addons' )
		];

		if (class_exists('WooCommerce')) {
			$post_types['product_cat'] = esc_html__('Product', 'master-addons' );
		}

		//other post types taxonomies here

		return apply_filters('jltma_post_types_category_slug', $post_types);
	}


	public static function jltma_set_global_authordata()
	{
		global $authordata;
		if (!isset($authordata->ID)) {
			$post = get_post();
			$authordata = get_userdata($post->post_author); // WPCS: override ok.
		}
	}


	public static function jltma_get_taxonomies($args = [], $output = 'names', $operator = 'and')
	{
		global $wp_taxonomies;

		$field = ('names' === $output) ? 'name' : false;

		// Handle 'object_type' separately.
		if (isset($args['object_type'])) {
			$object_type = (array) $args['object_type'];
			unset($args['object_type']);
		}

		$taxonomies = wp_filter_object_list($wp_taxonomies, $args, $operator);

		if (isset($object_type)) {
			foreach ($taxonomies as $tax => $tax_data) {
				if (!array_intersect($object_type, $tax_data->object_type)) {
					unset($taxonomies[$tax]);
				}
			}
		}

		if ($field) {
			$taxonomies = wp_list_pluck($taxonomies, $field);
		}

		return $taxonomies;
	}



	public static function is_plugin_installed($plugin_slug, $plugin_file)
	{
		$installed_plugins = get_plugins();
		return isset($installed_plugins[$plugin_file]);
	}


	// Get Page Title
	public static function jltma_get_page_title($include_context = true)
	{
		$title = '';

		if (is_singular()) {
			/* translators: %s: Search term. */
			$title = get_the_title();

			if ($include_context) {
				$post_type_obj = get_post_type_object(get_post_type());
				$title = sprintf('%s: %s', $post_type_obj->labels->singular_name, $title);
			}
		} elseif (is_search()) {
			/* translators: %s: Search term. */
			$title = sprintf(__('Search Results for: %s', 'master-addons' ), get_search_query());

			if (get_query_var('paged')) {
				/* translators: %s is the page number. */
				$title .= sprintf(__('&nbsp;&ndash; Page %s', 'master-addons' ), get_query_var('paged'));
			}
		} elseif (is_category()) {
			$title = single_cat_title('', false);

			if ($include_context) {
				/* translators: Category archive title. 1: Category name */
				$title = sprintf(__('Category: %s', 'master-addons' ), $title);
			}
		} elseif (is_tag()) {
			$title = single_tag_title('', false);
			if ($include_context) {
				/* translators: Tag archive title. 1: Tag name */
				$title = sprintf(__('Tag: %s', 'master-addons' ), $title);
			}
		} elseif (is_author()) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';

			if ($include_context) {
				/* translators: Author archive title. 1: Author name */
				$title = sprintf(__('Author: %s', 'master-addons' ), $title);
			}
		} elseif (is_year()) {
			$title = get_the_date(_x('Y', 'yearly archives date format', 'master-addons' ));

			if ($include_context) {
				/* translators: Yearly archive title. 1: Year */
				$title = sprintf(__('Year: %s', 'master-addons' ), $title);
			}
		} elseif (is_month()) {
			$title = get_the_date(_x('F Y', 'monthly archives date format', 'master-addons' ));

			if ($include_context) {
				/* translators: Monthly archive title. 1: Month name and year */
				$title = sprintf(__('Month: %s', 'master-addons' ), $title);
			}
		} elseif (is_day()) {
			$title = get_the_date(_x('F j, Y', 'daily archives date format', 'master-addons' ));

			if ($include_context) {
				/* translators: Daily archive title. 1: Date */
				$title = sprintf(__('Day: %s', 'master-addons' ), $title);
			}
		} elseif (is_tax('post_format')) {
			if (is_tax('post_format', 'post-format-aside')) {
				$title = _x('Asides', 'post format archive title', 'master-addons' );
			} elseif (is_tax('post_format', 'post-format-gallery')) {
				$title = _x('Galleries', 'post format archive title', 'master-addons' );
			} elseif (is_tax('post_format', 'post-format-image')) {
				$title = _x('Images', 'post format archive title', 'master-addons' );
			} elseif (is_tax('post_format', 'post-format-video')) {
				$title = _x('Videos', 'post format archive title', 'master-addons' );
			} elseif (is_tax('post_format', 'post-format-quote')) {
				$title = _x('Quotes', 'post format archive title', 'master-addons' );
			} elseif (is_tax('post_format', 'post-format-link')) {
				$title = _x('Links', 'post format archive title', 'master-addons' );
			} elseif (is_tax('post_format', 'post-format-status')) {
				$title = _x('Statuses', 'post format archive title', 'master-addons' );
			} elseif (is_tax('post_format', 'post-format-audio')) {
				$title = _x('Audio', 'post format archive title', 'master-addons' );
			} elseif (is_tax('post_format', 'post-format-chat')) {
				$title = _x('Chats', 'post format archive title', 'master-addons' );
			}
		} elseif (is_post_type_archive()) {
			$title = post_type_archive_title('', false);

			if ($include_context) {
				/* translators: Post type archive title. 1: Post type name */
				$title = sprintf(__('Archives: %s', 'master-addons' ), $title);
			}
		} elseif (is_tax()) {
			$title = single_term_title('', false);

			if ($include_context) {
				$tax = get_taxonomy(get_queried_object()->taxonomy);
				/* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
				$title = sprintf(__('%1$s: %2$s', 'master-addons' ), $tax->labels->singular_name, $title);
			}
		} elseif (is_404()) {
			$title = __('Page Not Found', 'master-addons' );
		} // End if().

		$title = apply_filters('jltma/core_elements/get_the_archive_title', $title);

		return $title;
	}



	// Archive URL
	public static function jltma_get_the_archive_url()
	{
		$url = '';
		if (is_category() || is_tag() || is_tax()) {
			$url = get_term_link(get_queried_object());
		} elseif (is_author()) {
			$url = get_author_posts_url(get_queried_object_id());
		} elseif (is_year()) {
			$url = get_year_link(get_query_var('year'));
		} elseif (is_month()) {
			$url = get_month_link(get_query_var('year'), get_query_var('monthnum'));
		} elseif (is_day()) {
			$url = get_day_link(get_query_var('year'), get_query_var('monthnum'), get_query_var('day'));
		} elseif (is_post_type_archive()) {
			$url = get_post_type_archive_link(get_post_type());
		}

		return $url;
	}


	// Font Awesome Icon Picker Library
	public static function jltma_fa_icon_picker($font_name = 'fab fa-elementor', $fa4_name = "", $control_name = "", $attr_name = "", $extra_class = "", $settings = '')
	{

		if (!isset($settings[$fa4_name]) && !Icons_Manager::is_migration_allowed()) {
			$settings[$fa4_name] = 'fab fa-elementor';
		}

		$has_icon  = !empty($settings[$fa4_name]);
		if ($has_icon and 'icon' == $control_name) {
			$this->add_render_attribute($attr_name, 'class', [$control_name . $extra_class]);
			$this->add_render_attribute($attr_name, 'aria-hidden', 'true');
		}

		if (!$has_icon && !empty($control_name['value'])) {
			$has_icon = true;
		}

		$migrated  = isset($settings['__fa4_migrated'][$control_name]);
		$is_new    = empty($settings[$fa4_name]) && Icons_Manager::is_migration_allowed();


		if ($is_new || $migrated) {
			Icons_Manager::render_icon($control_name, [
				'class' 		=> $extra_class,
				'aria-hidden' 	=> 'true'
			]);
		} else {
			echo '<i ' . $this->get_render_attribute_string($attr_name) . '></i>';
		}
	}


	public static function jltma_carousel_navigation_position()
	{
		$position_options = [
			'top-left'      => esc_html__('Top Left', 'master-addons' ),
			'top-center'    => esc_html__('Top Center', 'master-addons' ),
			'top-right'     => esc_html__('Top Right', 'master-addons' ),
			'center'        => esc_html__('Center', 'master-addons' ),
			'bottom-left'   => esc_html__('Bottom Left', 'master-addons' ),
			'bottom-center' => esc_html__('Bottom Center', 'master-addons' ),
			'bottom-right'  => esc_html__('Bottom Right', 'master-addons' ),
		];

		return $position_options;
	}


	public static function jltma_carousel_pagination_position()
	{
		$position_options = [
			'top-left'      => esc_html__('Top Left', 'master-addons' ),
			'top-center'    => esc_html__('Top Center', 'master-addons' ),
			'top-right'     => esc_html__('Top Right', 'master-addons' ),
			'bottom-left'   => esc_html__('Bottom Left', 'master-addons' ),
			'bottom-center' => esc_html__('Bottom Center', 'master-addons' ),
			'bottom-right'  => esc_html__('Bottom Right', 'master-addons' ),
		];

		return $position_options;
	}

	public static function jltma_get_preloadable_previews()
	{
		$position_options = [
			'no'                   => esc_html__('Blank', 'master-addons' ),
			'yes'                  => esc_html__('Blurred placeholder image', 'master-addons' ),
			'progress-box'         => esc_html__('In-progress box animation', 'master-addons' ),
			'simple-spinner'       => esc_html__('Loading spinner (blue)', 'master-addons' ),
			'simple-spinner-light' => esc_html__('Loading spinner (light)', 'master-addons' ),
			'simple-spinner-dark'  => esc_html__('Loading spinner (dark)', 'master-addons' )
		];
		return $position_options;
	}

	public static function jltma_get_array_value($array, $key, $default = '')
	{
		return isset($array[$key]) ? $array[$key] : $default;
	}



	public static function render_image($image_id, $settings, $class = "")
	{
		$image_size = $settings;

		if ('custom' === $image_size) {
			$image_src = \Elementor\Group_Control_Image_Size::get_attachment_image_src($image_id, $image_size, $settings);
		} else {
			$image_src = wp_get_attachment_image_src($image_id, $image_size);
			$image_src = $image_src[0];
		}

		return sprintf('<img src="%s"  class="%s" alt="%s" />', esc_url($image_src), esc_attr($class), esc_html(get_post_meta($image_id, '_wp_attachment_image_alt', true)));
	}


	/**
	 * Get Elementor Pro Locked Html
	 *
	 * Returns the markup to display when a feature requires Elementor Pro
	 *
	 * @since  2.1.0
	 * @return \Elementor\Plugin|$instace
	 */
	public static function jltma_pro_locked_html()
	{
		return '<div class="elementor-nerd-box">
			<i class="elementor-nerd-box-icon eicon-hypster"></i>
			<div class="elementor-nerd-box-title">' .
			__('Oups, hang on!', 'master-addons' ) .
			'</div>
			<div class="elementor-nerd-box-message">' .
			__('This feature is only available if you have Master Addons Pro.', 'master-addons' ) .
			'</div>
			<a class="elementor-nerd-box-link elementor-button elementor-button-default elementor-go-pro" href="https://master-addons.com/pricing" target="_blank">' .
			__('Go Pro', 'master-addons' ) .
			'</a>
		</div>';
	}


	public static function jltma_tooltip_options()
	{
		return [
			'' => esc_html__('Top (Default)', 'master-addons' ),

			'top-start' => esc_html__('Top Start', 'master-addons' ),
			'top-end'   => esc_html__('Top End', 'master-addons' ),

			'right'       => esc_html__('Right', 'master-addons' ),
			'right-start' => esc_html__('Right Start', 'master-addons' ),
			'right-end'   => esc_html__('Right End', 'master-addons' ),

			'bottom'       => esc_html__('Bottom', 'master-addons' ),
			'bottom-start' => esc_html__('Bottom Start', 'master-addons' ),
			'bottom-end'   => esc_html__('Bottom End', 'master-addons' ),

			'left'       => esc_html__('Left', 'master-addons' ),
			'left-start' => esc_html__('Left Start', 'master-addons' ),
			'left-end'   => esc_html__('Left End', 'master-addons' ),

			'auto'       => esc_html__('Auto', 'master-addons' ),
			'auto-start' => esc_html__('Auto Start', 'master-addons' ),
			'auto-end'   => esc_html__('Auto End', 'master-addons' ),
		];
	}

	public static function jltma_tooltip_animations()
	{
		return [
			'none'         => esc_html__('None', 'master-addons' ),
			''             => esc_html__('Fade', 'master-addons' ),
			'shift-away'   => esc_html__('Shift-Away', 'master-addons' ),
			'shift-toward' => esc_html__('Shift-Toward', 'master-addons' ),
			'scale'        => esc_html__('Scale', 'master-addons' ),
			'perspective'  => esc_html__('Perspective', 'master-addons' ),
			'fill'         => esc_html__('Fill Effect', 'master-addons' ),
		];
	}

	public static function jltma_placeholder_images()
	{
		$demo_images =
			[
				'id'    =>  0,
				'url'   =>  Utils::get_placeholder_image_src(),
			];
		return $demo_images;
	}

	public static function find_widget_elements_by_id($elements, $id)
	{
		static $widget = null;

		foreach ($elements as $element) {
			if ($id === $element['id']) {
				$widget = $element;

				break;
			} elseif (isset($element['elements'])) {
				self::find_widget_elements_by_id($element['elements'], $id);
			}
		}

		return $widget;
	}


	public static function get_client_ip_as_key()
	{
		return str_replace('.', '_', self::get_client_ip());
	}

	public static function get_client_ip()
	{
		$ip = self::IP_LOCAL;

		$server_ip_keys = array(
			'REMOTE_ADDR',
			'HTTP_CLIENT_IP',
			'HTTP_X_FORWARDED_FOR',
			'HTTP_X_FORWARDED',
			'HTTP_X_CLUSTER_CLIENT_IP',
			'HTTP_FORWARDED_FOR',
			'HTTP_FORWARDED',
		);

		foreach ($server_ip_keys as $key) {
			if (isset($_SERVER[$key]) && filter_var($_SERVER[$key], FILTER_VALIDATE_IP)) {
				$ip = $_SERVER[$key];

				break;
			}
		}

		return apply_filters('jltma_elementor/utils/client_ip', $ip);
	}


	public static function short_number($number)
	{
		$abbrevs = array(
			12 => 'T',
			9 => 'B',
			6 => 'M',
			3 => 'K',
			0 => '',
		);

		foreach ($abbrevs as $exponent => $abbrev) {
			if (abs($number) >= pow(10, $exponent)) {
				$display = $number / pow(10, $exponent);
				$decimals = ($exponent >= 3 && round($display) < 100) ? 1 : 0;
				$number = number_format($display, $decimals) . $abbrev;
				break;
			}
		}

		return $number;
	}

	public static function array_merge_recursive($array1, $array2)
	{
		$merged = $array1;

		foreach ($array2 as $key => &$value) {
			if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
				$merged[$key] = self::array_merge_recursive($merged[$key], $value);
			} elseif (is_numeric($key)) {
				if (!in_array($value, $merged, true)) {
					$merged[] = $value;
				}
			} else {
				$merged[$key] = $value;
			}
		}

		return $merged;
	}

	/**
	 * Get current elementor document id
	 *
	 *
	 * @return int|false
	 */
	public static function get_document_id()
	{
		$document = self::jltma_elementor()->documents->get_current();

		if ($document) {
			return $document->get_main_id();
		}

		return $document;
	}

	public static function get_ob_html($callback)
	{
		if (!is_callable($callback)) {
			return '';
		}

		ob_start();

		call_user_func($callback);

		return ob_get_clean();
	}

	public static function render_icon($icon_setting, $attributes = array())
	{
		if (empty($icon_setting['value'])) {
			return;
		}

		echo '<span class="jltma-wrap-icon">';

		Icons_Manager::render_icon($icon_setting, $attributes);

		echo '</span>';
	}

	/**
	 * Render Icon
	 *
	 * Used to render Icon for \Elementor\Controls_Manager::ICONS
	 * @param array $icon Icon Type, Icon value
	 * @param array $attributes Icon HTML Attributes
	 */
	public static function get_render_icon($icon_setting, $attributes = array())
	{
		return self::get_ob_html(function () use ($icon_setting, $attributes) {
			self::render_icon($icon_setting, $attributes);
		});
	}


	/**
	 * Prepare css var.
	 *
	 * @param string $control_id Control id.
	 * @param string $value Control selectors value.
	 *
	 * @return string Control id that prepared for css vars.
	 */
	public static function prepare_css_var($control_id, $value = '')
	{
		$var_key = '--' . str_replace('_', '-', $control_id);

		if (empty($value)) {
			return $var_key;
		}

		return $var_key . ': ' . $value . ';';
	}

	public static function get_available_image_sizes()
	{
		$glob_sizes = wp_get_additional_image_sizes();
		$image_sizes = get_intermediate_image_sizes();
		$sizes = array();

		if (is_array($image_sizes) && $image_sizes) {
			foreach ($image_sizes as $size) {
				if (in_array($size, array('thumbnail', 'medium', 'medium_large', 'large'), true)) {
					$sizes[$size] = array(
						'width' => get_option("{$size}_size_w"),
						'height' => get_option("{$size}_size_h"),
						'crop' => (bool) get_option("{$size}_crop"),
					);
				} elseif (isset($glob_sizes[$size])) {
					$sizes[$size] = array(
						'width' => $glob_sizes[$size]['width'],
						'height' => $glob_sizes[$size]['height'],
						'crop' => $glob_sizes[$size]['crop'],
					);
				}

				if (0 === (int) $sizes[$size]['width'] || 0 === (int) $sizes[$size]['height']) {
					unset($sizes[$size]);
				}
			}
		}

		return $sizes;
	}

	public static function jltma_animate_class($addon_animate, $effect, $delay)
	{
		if ($addon_animate == 'on') :
			$animate_class = ' animate-in" data-anim-type="' . $effect . '" data-anim-delay="' . $delay . '"';
		else :
			$animate_class = '"';
		endif;
		return $animate_class;
	}



	public static function jltma_post_type_query($source, $posts_source, $posts_type, $categories, $categories_post_type, $order, $orderby, $pagination, $pagination_type, $num_posts, $num_posts_page)
	{

		if ($orderby == 'views') {
			$orderby = 'meta_value_num';
			$view_order = 'views';
		} else {
			$view_order = '';
		}

		if ($source == 'post_type') {
			$posts_source = 'all_posts';
		}

		if ($posts_source == 'all_posts') {

			$query = 'post_type=Post&post_status=publish&ignore_sticky_posts=1&orderby=' . $orderby . '&order=' . $order . '';

			// CUSTOM POST TYPE
			if ($source == 'post_type') {
				$query .= '&post_type=' . $posts_type . '';
			}

			if ($view_order == 'views') {
				$query .= '&meta_key=wpb_post_views_count';
			}

			// CATEGORIES POST TYPE
			if ($categories_post_type != '' && !empty($categories_post_type) && $source == 'post_type') {
				$taxonomy_names = get_object_taxonomies($posts_type);
				$query .= '&' . $taxonomy_names[0] . '=' . $categories_post_type . '';
			}

			// CATEGORIES POSTS
			if ($categories != '' && $categories != 'all' && !empty($categories) && $source == 'wp_posts') {
				$query .= '&category_name=' . $categories . '';
			}

			if ($pagination == 'yes' || $pagination == 'load-more') {
				$query .= '&posts_per_page=' . $num_posts_page . '';
			} else {
				if ($num_posts == '') {
					$num_posts = '-1';
				}
				$query .= '&posts_per_page=' . $num_posts . '';
			}

			// PAGINATION
			if ($pagination == 'yes' || $pagination == 'load-more') {
				if (get_query_var('paged')) {
					$paged = get_query_var('paged');
				} elseif (get_query_var('page')) {
					$paged = get_query_var('page');
				} else {
					$paged = 1;
				}
				$query .= '&paged=' . $paged . '';
			}
			// #PAGINATION

		} else { // IF STICKY


			if ($pagination == 'yes' || $pagination == 'load-more') {
				$num_posts = $num_posts_page;
			} else {
				if ($num_posts == '') {
					$num_posts = '-1';
				}
				$num_posts = $num_posts;
			}

			// PAGINATION

			if (get_query_var('paged')) {
				$paged = get_query_var('paged');
			} elseif (get_query_var('page')) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;
			}

			// #PAGINATION

			/* STICKY POST DA FARE ARRAY PER SCRITTURA IN ARRAY */

			$sticky = get_option('sticky_posts');
			$sticky = array_slice($sticky, 0, 5);
			if ($view_order == 'views') {
				$query = array(
					'post_type'           => 'post',
					'post_status'         => 'publish',
					'orderby'             => $orderby,
					'order'               => $order,
					'category_name'       => $categories,
					'posts_per_page'      => $num_posts,
					'meta_key'            => 'wpb_post_views_count',
					'paged'               => $paged,
					'post__in'            => $sticky,
					'ignore_sticky_posts' => 1
				);
			} else {
				$query = array(
					'post_type'           => 'post',
					'post_status'         => 'publish',
					'orderby'             => $orderby,
					'order'               => $order,
					'category_name'       => $categories,
					'posts_per_page'      => $num_posts,
					'paged'               => $paged,
					'post__in'            => $sticky,
					'ignore_sticky_posts' => 1
				);
			}
		} // #all_posts

		return $query;
	}


	/** Get Category **/

	public static function jltma_get_category($source, $posts_type, $css_link, $limit = 1)
	{
		$separator = ' ';
		$output = '';
		$count = 1;
		if ($source == 'wp_posts') {
			$categories = get_the_category();
			if ($categories) {
				foreach ($categories as $category) {
					$output .= '<a href="' . get_category_link($category->term_id) . '" title="' . esc_attr( /* translators: %s: Categories */ sprintf(__("View all posts in %s", "master-addons" ), $category->name)) . '" ' . $css_link . '>' . esc_html($category->cat_name) . '</a>' . esc_html($separator);
					if ($count == $limit) {
						break;
					}
					$count++;
				}
			}
		} elseif ($source == 'post_type') {
			global $post;
			$taxonomy_names = get_object_taxonomies($posts_type);
			$term_list = wp_get_post_terms($post->ID, $taxonomy_names);
			if ($term_list) {
				foreach ($term_list as $tax_term) {
					$output .= '<a href="' . esc_attr(get_term_link($tax_term, $posts_type)) . '" title="' . esc_attr(sprintf(__("View all posts in %s", "master-addons" ), $tax_term->name)) . '" ' . $css_link . '>' . esc_html($tax_term->name) . '</a>' . esc_html($separator);
				}
			}
		}
		$return = trim($output, $separator);
		return $return;
	}


	/** Get Author **/
	public static function jltma_get_author($css_link)
	{
		$return = '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '" ' . $css_link . '>' . get_the_author_meta('display_name') . '</a>';
		return $return;
	}

	/** Get Blog Exceprt */
	public static function jltma_get_blogs_excerpt($excerpt = 'default', $readmore = 'on', $css_link = '')
	{
		global $post;
		if ($excerpt == 'default') :
			$return = get_the_excerpt();
		else :
			$return = substr(get_the_excerpt(), 0, $excerpt);
			if ($readmore == 'on') :
				$return .= '<a class="article-read-more" href="' . get_permalink($post->ID) . '" ' . $css_link . '>' . esc_html__('Read More', 'elementorwidgetsmegapack') . '</a>';
			else :
				$return .= '...';
			endif;
		endif;
		return $return;
	}


	/** Post Social Share **/
	public static function jltma_post_social_share($css_link)
	{

		$return = '<div class="container-social">
			<a target="_blank" href="http://www.facebook.com/sharer.php?u=' . get_the_permalink() . '&amp;t=' . get_the_title() . '" title="' . esc_html__('Click to share this post on Facebook', 'elementorwidgetsmegapack') . '" ' . $css_link . '><i class="fa fa-facebook"></i></a>
			<a target="_blank" href="http://twitter.com/home?status=' . get_the_permalink() . '" title="' . esc_html__('Click to share this post on Twitter', 'elementorwidgetsmegapack') . '"><i class="fa fa-twitter" ' . $css_link . '></i></a>
			<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '" title="' . esc_html__('Click to share this post on Linkedin', 'elementorwidgetsmegapack') . '"><i class="fa fa-linkedin" ' . $css_link . '></i></a></div>';

		return $return;
	}

	/** Check Post Format **/
	public static function jltma_check_post_format()
	{
		global $post;
		$format = get_post_format_string(get_post_format());
		if ($format == 'Video') :
			$return = '<span class="fpg-format-type fa fa-play-circle-o"></span>';
		elseif ($format == 'Audio') :
			$return = '<span class="fpg-format-type fa fa-headphones"></span>';
		else :
			$return = '';
		endif;
		return $return;
	}

	/** Get Thumbnails **/
	public static function jltma_get_thumb($thumbs_size = 'thumbnail')
	{
		global $post;
		$link = get_the_permalink();
		if (has_post_thumbnail()) {
			$id_post = get_the_id();
			$single_image = wp_get_attachment_image_src(get_post_thumbnail_id($id_post), $thumbs_size);
			$return = '<a href="' . esc_url($link) . '"><img class="fpg-thumbs" src="' . $single_image[0] . '" alt="' . get_the_title() . '"></a>';
		} else {
			$return = '';
		}
		return $return;
	}


	/** Get Blog Thumbnails **/
	public static function jltma_get_blogs_thumb($columns, $post_id)
	{
		global $post;
		if ($columns == '1') :
			$return = self::jltma_get_thumb('large');
		elseif ($columns == '2') :
			$return = self::jltma_get_thumb('medium');
		else :
			$return = self::jltma_get_thumb('small');
		endif;
		return $return;
	}

	// Get Template Part
	public static function jltma_get_template_part($jltma_template, $jltma_data = array())
	{
		extract($jltma_data);
		include JLTMA_PATH . '/inc/post-templates/' . $jltma_template . '.php';
	}

	// Get Featured Image URL
	public static function jltma_get_featured_image_url()
	{
		$featured_image_full_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
		if (isset($featured_image_full_url[0]) && strlen($featured_image_full_url[0]) > 0) {
			return $featured_image_full_url[0];
		} else {
			return false;
		}
	}

	// Get Featured Image URL
	public static function jltma_excerpt_truncate($jltma_string, $jltma_length = 80, $jltma_etc = '... ', $jltma_break_words = false, $jltma_middle = false)
	{
		if ($jltma_length == 0)
			return '';

		if (mb_strlen($jltma_string, 'utf8') > $jltma_length) {
			$jltma_length -= mb_strlen($jltma_etc, 'utf8');
			if (!$jltma_break_words && !$jltma_middle) {
				$jltma_string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($jltma_string, 0, $jltma_length + 1, 'utf8'));
			}
			if (!$jltma_middle) {
				return mb_substr($jltma_string, 0, $jltma_length, 'utf8') . $jltma_etc;
			} else {
				return mb_substr($jltma_string, 0, $jltma_length / 2, 'utf8') . $jltma_etc . mb_substr($jltma_string, -$jltma_length / 2, utf8);
			}
		} else {
			return $jltma_string;
		}
	}
}
