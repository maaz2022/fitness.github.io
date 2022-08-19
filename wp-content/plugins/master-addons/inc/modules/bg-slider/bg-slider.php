<?php

namespace MasterAddons\Modules;

use \Elementor\Element_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;

class JLTMA_Extension_Background_Slider
{
	private static $_instance = null;

	private function __construct()
	{
		add_action('elementor/element/after_section_end', [$this, '_add_controls'], 10, 3);

		add_action('elementor/frontend/element/before_render', [$this, '_before_render'], 10, 1);
		add_action('elementor/frontend/column/before_render', [$this, '_before_render'], 10, 1);
		add_action('elementor/frontend/section/before_render', [$this, '_before_render'], 10, 1);

		add_action('elementor/element/print_template', [$this, '_print_template'], 10, 2);
		// add_action('elementor/widget/print_template', [$this, '_print_template'], 10, 2);
		// add_action('elementor/section/print_template', [$this, '_print_template'], 10, 2);

		add_action('elementor/editor/before_enqueue_scripts', [$this, 'ma_el_add_js_css']);
	}


	public function ma_el_add_js_css()
	{

		// CSS
		wp_enqueue_style('vegas', JLTMA_URL . '/assets/vendor/vegas/vegas.min.css');
		// wp_enqueue_style('swiper');

		// JS
		wp_enqueue_script('vegas', JLTMA_URL . '/assets/vendor/vegas/vegas.min.js', ['jquery'], JLTMA_VER, true);
		wp_enqueue_script('swiper');
	}

	public function _add_controls($element, $section_id, $args)
	{
		if (('section' === $element->get_name() && 'section_background' === $section_id) || ('column' === $element->get_name() && 'section_style' === $section_id)) {

			$element->start_controls_section(
				'_ma_el_section_bg_slider',
				[
					'label' => JLTMA_BADGE . __(' Background Slider', 'master-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE
				]
			);

			$element->add_control(
				'ma_el_bg_slider_images',
				[
					'label'     => __('Add Images', 'master-addons' ),
					'type'      => Controls_Manager::GALLERY,
					'default'   => [],
				]
			);

			$element->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' => 'ma_el_thumbnail',
				]
			);

			/*$slides_to_show = range( 1, 10 );
			$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

			$element->add_control(
				'slides_to_show',
				[
					'label' => __( 'Slides to Show', 'master-addons' ),
					'type' => Controls_Manager::SELECT,
					'default' => '3',
					'options' => $slides_to_show,
				]
			);*/
			/*$element->add_control(
                'slide',
                [
                    'label' => __( 'Initial Slide', 'master-addons' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
					'placeholder' => __( 'Initial Slide', 'master-addons' ),
					'default' => __( '0', 'master-addons' ),
                ]
            );*/

			$element->add_control(
				'ma_el_slider_transition',
				[
					'label'   => __('Transition', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'fade'        => __('Fade', 'master-addons' ),
						'fade2'       => __('Fade2', 'master-addons' ),
						'slideLeft'   => __('slide Left', 'master-addons' ),
						'slideLeft2'  => __('Slide Left 2', 'master-addons' ),
						'slideRight'  => __('Slide Right', 'master-addons' ),
						'slideRight2' => __('Slide Right 2', 'master-addons' ),
						'slideUp'     => __('Slide Up', 'master-addons' ),
						'slideUp2'    => __('Slide Up 2', 'master-addons' ),
						'slideDown'   => __('Slide Down', 'master-addons' ),
						'slideDown2'  => __('Slide Down 2', 'master-addons' ),
						'zoomIn'      => __('Zoom In', 'master-addons' ),
						'zoomIn2'     => __('Zoom In 2', 'master-addons' ),
						'zoomOut'     => __('Zoom Out', 'master-addons' ),
						'zoomOut2'    => __('Zoom Out 2', 'master-addons' ),
						'swirlLeft'   => __('Swirl Left', 'master-addons' ),
						'swirlLeft2'  => __('Swirl Left 2', 'master-addons' ),
						'swirlRight'  => __('Swirl Right', 'master-addons' ),
						'swirlRight2' => __('Swirl Right 2', 'master-addons' ),
						'burn'        => __('Burn', 'master-addons' ),
						'burn2'       => __('Burn 2', 'master-addons' ),
						'blur'        => __('Blur', 'master-addons' ),
						'blur2'       => __('Blur 2', 'master-addons' ),
						'flash'       => __('Flash', 'master-addons' ),
						'flash2'      => __('Flash 2', 'master-addons' ),
						'random'      => __('Random', 'master-addons' )
					],
					'default' => 'fade',
				]
			);


			$element->add_control(
				'ma_el_slider_animation',
				[
					'label'   => __('Animation', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'kenburns'          => __('Kenburns', 'master-addons' ),
						'kenburnsUp'        => __('Kenburns Up', 'master-addons' ),
						'kenburnsDown'      => __('Kenburns Down', 'master-addons' ),
						'kenburnsRight'     => __('Kenburns Right', 'master-addons' ),
						'kenburnsLeft'      => __('Kenburns Left', 'master-addons' ),
						'kenburnsUpLeft'    => __('Kenburns Up Left', 'master-addons' ),
						'kenburnsUpRight'   => __('Kenburns Up Right', 'master-addons' ),
						'kenburnsDownLeft'  => __('Kenburns Down Left', 'master-addons' ),
						'kenburnsDownRight' => __('Kenburns Down Right', 'master-addons' ),
						'random'            => __('Random', 'master-addons' ),
						''                  => __('None', 'master-addons' )
					],
					'default' => 'kenburns',
				]
			);

			$element->add_control(
				'ma_el_custom_overlay_switcher',
				[
					'label'        => __('Custom Overlay', 'master-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => '',
					'label_on'     => __('Show', 'master-addons' ),
					'label_off'    => __('Hide', 'master-addons' ),
					'return_value' => 'yes',
				]
			);

			/*$element->add_control(
				'custom_overlay',
				[
					'label' => __( 'Overlay Image', 'master-addons' ),
					'type' => Controls_Manager::MEDIA,
					'condition' => [
						'ma_el_custom_overlay_switcher' => 'yes',
					]
				]
			);*/

			$element->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'      => 'ma_el_slider_custom_overlay',
					'label'     => __('Overlay Image', 'master-addons' ),
					'types'     => ['none', 'classic', 'gradient'],
					'selector'  => '{{WRAPPER}} .vegas-overlay',
					'condition' => [
						'ma_el_custom_overlay_switcher' => 'yes',
					]
				]
			);

			$element->add_control(
				'ma_el_slider_overlay',
				[
					'label'     => __('Overlay', 'master-addons' ),
					'type'      => Controls_Manager::SELECT,
					'options'   => [
						''   => __('None', 'master-addons' ),
						'01' => __('Style 1', 'master-addons' ),
						'02' => __('Style 2', 'master-addons' ),
						'03' => __('Style 3', 'master-addons' ),
						'04' => __('Style 4', 'master-addons' ),
						'05' => __('Style 5', 'master-addons' ),
						'06' => __('Style 6', 'master-addons' ),
						'07' => __('Style 7', 'master-addons' ),
						'08' => __('Style 8', 'master-addons' ),
						'09' => __('Style 9', 'master-addons' )
					],
					'default'   => '01',
					'condition' => [
						'ma_el_custom_overlay_switcher' => '',
					]
				]
			);
			$element->add_control(
				'ma_el_slider_cover',
				[
					'label'   => __('Cover', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'true'  => __('True', 'master-addons' ),
						'false' => __('False', 'master-addons' )
					],
					'default' => 'true',
				]
			);
			$element->add_control(
				'ma_el_slider_delay',
				[
					'label'       => __('Delay', 'master-addons' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'placeholder' => __('Delay', 'master-addons' ),
					'default'     => __('5000', 'master-addons' ),
				]
			);
			$element->add_control(
				'ma_el_slider_timer_bar',
				[
					'label'   => __('Timer', 'master-addons' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'true'  => __('True', 'master-addons' ),
						'false' => __('False', 'master-addons' )
					],
					'default' => 'true',
				]
			);

			$element->end_controls_section();
		}
	}


	function _before_render(\Elementor\Element_Base $element)
	{

		if ($element->get_name() != 'section' && $element->get_name() != 'column') {
			return;
		}
		$settings = $element->get_settings();

		$element->add_render_attribute('_wrapper', 'class', 'has_ma_el_bg_slider');
		$element->add_render_attribute('ma-el-bs-background-slideshow-wrapper', 'class', 'ma-el-bs-background-slideshow-wrapper');

		$element->add_render_attribute('ma-el-bs-backgroundslideshow', 'class', 'ma-el-at-backgroundslideshow');

		$slides = [];

		if (empty($settings['ma_el_bg_slider_images'])) {
			return;
		}

		$this->ma_el_add_js_css();

		foreach ($settings['ma_el_bg_slider_images'] as $attachment) {
			$image_url = Group_Control_Image_Size::get_attachment_image_src(
				$attachment['id'],
				'ma_el_thumbnail',
				$settings
			);
			$slides[]  = ['src' => $image_url];
		}

		if (empty($slides)) {
			return;
		}

?>

		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery(".elementor-element-<?php echo sanitize_text_field($element->get_id()); ?>").prepend('<div ' +
					'class="ma-el-section-bs"><div' +
					' class="ma-el-section-bs-inner"></div></div>');
				var bgimage = '<?php echo esc_url($settings["ma_el_slider_custom_overlay_image"]['url']); ?>';
				if ('<?php echo esc_attr($settings["ma_el_custom_overlay_switcher"]); ?>' == 'yes') {

					//if(bgimage == ''){
					//    var bgoverlay = '<?php //echo $settings["ma_el_slider_custom_overlay_image"]['url'];
											?>';
					//}else{
					var bgoverlay = '<?php echo JLTMA_URL . "/assets/vendor/vegas/overlays/00.png"; ?>';
					// }
				} else {
					if ('<?php echo !empty($settings["ma_el_slider_overlay"]); ?>') {
						var bgoverlay = '<?php echo JLTMA_URL . "/assets/vendor/vegas/overlays/" . esc_attr($settings["ma_el_slider_overlay"]) . ".png"; ?>';
					} else {
						var bgoverlay = '<?php echo JLTMA_URL . "/assets/vendor/vegas/overlays/00.png"; ?>';
					}
				}


				jQuery(".elementor-element-<?php echo sanitize_text_field($element->get_id()); ?>").children('.ma-el-section-bs').children('' +
					'.ma-el-section-bs-inner').vegas({
					slides: <?php echo json_encode($slides) ?>,
					transition: '<?php echo esc_attr($settings['ma_el_slider_transition']); ?>',
					animation: '<?php echo esc_attr($settings['ma_el_slider_animation']); ?>',
					overlay: bgoverlay,
					cover: <?php echo esc_attr($settings['ma_el_slider_cover']); ?>,
					delay: <?php echo esc_attr($settings['ma_el_slider_delay']); ?>,
					timer: <?php echo esc_attr($settings['ma_el_slider_timer_bar']); ?>
				});
				if ('<?php echo esc_attr($settings["ma_el_custom_overlay_switcher"]); ?>' == 'yes') {
					jQuery(".elementor-element-<?php echo sanitize_text_field($element->get_id()); ?>").children('.ma-el-section-bs')
						.children('.ma-el-section-bs-inner').children('.vegas-overlay').css('background-image', '');
				}
			});
		</script>
	<?php
	}

	function _print_template($template, $widget)
	{
		if ($widget->get_name() != 'section' && $widget->get_name() != 'column') {
			return $template;
		}

		$old_template = $template;
		ob_start();
	?>

		<# var rand_id=Math.random().toString(36).substring(7) slides_path_string='' , ma_el_transition=settings.ma_el_slider_transition, ma_el_animation=settings.ma_el_slider_animation, ma_el_custom_overlay=settings.ma_el_custom_overlay_switcher, ma_el_overlay='' , ma_el_cover=settings.ma_el_slider_cover, ma_el_delay=settings.ma_el_slider_delay, ma_el_timer=settings.ma_el_slider_timer_bar; if(!_.isUndefined(settings.ma_el_bg_slider_images) && settings.ma_el_bg_slider_images.length){ var slider_data=[]; slides=settings.ma_el_bg_slider_images; for(var i in slides){ slider_data[i]=slides[i].url; } slides_path_string=slider_data.join(); } if(settings.ma_el_custom_overlay_switcher=='yes' ){ ma_el_overlay='00.png' ; }else{ if(settings.ma_el_slider_overlay){ ma_el_overlay=settings.ma_el_slider_overlay + '.png' ; }else{ ma_el_overlay='00.png' ; } } #>

			<div class="ma-el-section-bs">
				<div class="ma-el-section-bs-inner" data-ma-el-bg-slider="{{ slides_path_string }}" data-ma-el-bg-slider-transition="{{ ma_el_transition }}" data-ma-el-bg-slider-animation="{{ ma_el_animation }}" data-ma-el-bg-custom-overlay="{{ ma_el_custom_overlay }}" data-ma-el-bg-slider-overlay="{{ ma_el_overlay }}" data-ma-el-bg-slider-cover="{{ ma_el_cover }}" data-ma-el-bs-slider-delay="{{ ma_el_delay }}" data-ma-el-bs-slider-timer="{{ ma_el_timer }}"></div>
			</div>

	<?php
		$slider_content = ob_get_contents();
		ob_end_clean();
		$template = $slider_content . $old_template;

		return $template;
	}


	public static function get_instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

JLTMA_Extension_Background_Slider::get_instance();
