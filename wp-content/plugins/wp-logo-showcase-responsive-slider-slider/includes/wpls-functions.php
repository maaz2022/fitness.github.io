<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Function to get plugin image sizes array
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.2.8
 */
function wplss_get_unique() {
	static $unique = 0;
	$unique++;

    // For Elementor, Beaver Builder & Visual Composer
    if( ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_POST['action'] ) && $_POST['action'] == 'elementor_ajax' )
    || ( class_exists('FLBuilderModel') && ! empty( $_POST['fl_builder_data']['action'] ) ) 
    || ( function_exists('vc_is_inline') && vc_is_inline() ) ) {
        $unique = current_time('timestamp') . '-' . rand();
    }

	return $unique;
}

/**
 * Sanitize URL
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 2.5
 */
function wpls_clean_url( $url ) {
	return esc_url_raw( trim($url) );
}

/**
 * Sanitize Multiple HTML class
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 2.5.1
 */
function wpls_sanitize_html_classes($classes, $sep = " ") {
    $return = "";

    if( !is_array($classes) ) {
        $classes = explode($sep, $classes);
    }

    if( !empty($classes) ) {
        foreach($classes as $class){
            $return .= sanitize_html_class($class) . " ";
        }
        $return = trim( $return );
    }

    return $return;
}

/**
 * Function to get post featured image
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.1.7
 */
function wpls_get_logo_image( $post_id = '', $size = 'full' ) {	
	// If external image is blank then take featured image	
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );	
	if( !empty($image) ) {
		$image = isset($image[0]) ? $image[0] : '';
		}	
	return $image;
}

/**
 * Function to get plugin image sizes array
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */
function wpls_logo_designs() {
	$design_arr = array(
		'design-1'	=> __('Design 1', 'wp-logo-showcase-responsive-slider-slider')		
		);	
	return apply_filters('wpls_logo_designs', $design_arr );
}

/**
 * Function to add array after specific key
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.2.5
 */
function wpls_logo_add_array(&$array, $value, $index, $from_last = false) {
    
    if( is_array($array) && is_array($value) ) {

        if( $from_last ) {
            $total_count    = count($array);
            $index          = (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
        }
        
        $split_arr  = array_splice($array, max(0, $index));
        $array      = array_merge( $array, $value, $split_arr);
    }
    
    return $array;
}