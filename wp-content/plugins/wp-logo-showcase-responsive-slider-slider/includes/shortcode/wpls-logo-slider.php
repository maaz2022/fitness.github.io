<?php
/**
 * 'logoshowcase' Shortcode
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to handle the `logoshowcase` shortcode
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */
function wpls_logo_slider( $atts, $content ) {

	global $post;

	// SiteOrigin Page Builder Gutenberg Block Tweak - Do not Display Preview
	if( isset( $_POST['action'] ) && ($_POST['action'] == 'so_panels_layout_block_preview' || $_POST['action'] == 'so_panels_builder_content_json') ) {
		return "[logoshowcase]";
	}

	// Divi Frontend Builder - Do not Display Preview
	if( function_exists( 'et_core_is_fb_enabled' ) && isset( $_POST['is_fb_preview'] ) && isset( $_POST['shortcode'] ) ) {
		return '<div class="wpls-builder-shrt-prev">
					<div class="wpls-builder-shrt-title"><span>'.esc_html__('Logo Showcase View', 'album-and-image-gallery-plus-lightbox').'</span></div>
					logoshowcase
				</div>';
	}

	// Fusion Builder Live Editor - Do not Display Preview
	if( class_exists( 'FusionBuilder' ) && (( isset( $_GET['builder'] ) && $_GET['builder'] == 'true' ) || ( isset( $_POST['action'] ) && $_POST['action'] == 'get_shortcode_render' )) ) {
		return '<div class="wpls-builder-shrt-prev">
					<div class="wpls-builder-shrt-title"><span>'.esc_html__('Logo Showcase View', 'album-and-image-gallery-plus-lightbox').'</span></div>
					logoshowcase
				</div>';
	}

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit' 			=> 15,
		'design'			=> 'design-1',
		'cat_id'			=> '',
		'cat_name' 			=> '',
		'slides_column'		=> 4,
		'slides_scroll'		=> 1,
		'dots'				=> 'true',
		'arrows'			=> 'true',
		'autoplay'			=> 'true',
		'autoplay_interval'	=> 2000,
		'speed'				=> 1000,
		'center_mode'		=> 'false',
		'rtl'				=> '',
		'loop'				=> 'true',
		'link_target'		=> 'self',
		'show_title'		=> 'false',
		'image_size'		=> 'original',
		'orderby'			=> 'date',
		'order'				=> 'ASC',
		'hide_border'		=> 'true',
		'max_height'        => 250,
		'lazyload'          => '',
		'className'			=> '',
		'align'				=> '',
		'extra_class'		=> '',
	), $atts));

		$shortcode_designs	= wpls_logo_designs();
		$design 			= array_key_exists( trim( $design ), $shortcode_designs ) ? $design 	: 'design-1';
		$limit				= !empty( $limit ) 					? $limit 					: 15;
		$cat 				= !empty( $cat_id )					? explode( ',',$cat_id ) 	: '';
		$cat_name			= !empty( $cat_name )				? $cat_name 				: '';
		$slides_scroll 		= !empty( $slides_scroll ) 			? $slides_scroll 			: 1;
		$dots 				= ( $dots == 'false' ) 				? 'false' 					: 'true';
		$arrows 			= ( $arrows == 'false' ) 			? 'false' 					: 'true';
		$autoplay 			= ( $autoplay == 'false' ) 			? 'false' 					: 'true';
		$autoplay_interval 	= ( $autoplay_interval !== '' ) 	? $autoplay_interval 		: 2000;
		$speed 				= !empty( $speed ) 					? $speed 					: 300;
		$loop 				= ( $loop == 'false' ) 				? 'false'					: 'true';
		$link_target 		= ( $link_target == 'blank' ) 		? '_blank' 					: '_self';
		$show_title 		= ( $show_title == 'true' ) 		? 'true'					: 'false';
		$image_size 		= !empty( $image_size ) 			? $image_size				: 'original';
		$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 					: 'DESC';
		$orderby 			= !empty($orderby)	 				? $orderby 					: 'date';
		$hide_border 		= ( $hide_border == 'true' ) 		? 'sliderimage_hide_border' : '';
		$max_height 		= !empty( $max_height ) 			? $max_height 				: 250;
		$lazyload 			= ( $lazyload == 'ondemand' || $lazyload == 'progressive' ) ? $lazyload : ''; // ondemand or progressive
		$align				= !empty( $align )					? 'align'.$align			: '';
		$extra_class		= $extra_class .' '. $align .' '. $className;
		$extra_class		= wpls_sanitize_html_classes( $extra_class );
		
		// For RTL
		if( empty($rtl) && is_rtl() ) {
			$rtl = 'true';
		} elseif ( $rtl == 'true' ) {
			$rtl = 'true';
		} else {
			$rtl = 'false';
		}

		// Taking some globals
		$unique	= wplss_get_unique();
		
		// Shortcode file
		$design_file_path 	= WPLS_DIR . '/templates/' . $design . '.php';
		$design_file_path 	= (file_exists($design_file_path)) ? $design_file_path : '';

		// WP Query Parameters
		$query_args = array(
						'post_type' 			=> WPLS_POST_TYPE,
						'post_status' 			=> array( 'publish' ),
						'posts_per_page'		=> $limit,
						'order'          		=> $order,
						'orderby'        		=> $orderby,
					);

		if($cat != "") {
            	$query_args['tax_query'] = array(
            	 		array( 
            	 			'taxonomy' => WPLS_CAT_TYPE, 
            	 			'field' => 'term_id', 
            	 			'terms' => $cat,
            	 			)
            	);
        } 
		
		// Enqueue required script
		wp_enqueue_script( 'wpos-slick-jquery' );
		wp_enqueue_script( 'wpls-public-js' );
		
		global $post;
		
		// WP Query Parameters
		$logo_query = new WP_Query($query_args);
		$post_count = $logo_query->post_count;

		// Slider configuration and taken care of centermode
		$slides_column 		= (!empty($slides_column) && $slides_column <= $post_count) ? $slides_column : $post_count;
		$center_mode		= ($center_mode == 'true' && $slides_column % 2 != 0 && $slides_column != $post_count) ? 'true' : 'false';
		$center_mode_cls	= ($center_mode == 'true') ? 'wpls-center' : '';
		$dots_cls			= ($dots == 'false') 	   ? 'wpls-dots-false' : '';
		
		// Slider configuration
		$slider_conf = compact('slides_column', 'slides_scroll', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'loop' , 'rtl', 'speed', 'center_mode', 'lazyload');
		
		ob_start();

		// If post is there
		if( $logo_query->have_posts() ) { ?>
		<?php
			if($cat_name != '') { ?>
				<h2><?php echo $cat_name; ?> </h2>	
			<?php	} ?>
		<style>			
			#wpls-logo-showcase-slider-<?php echo $unique; ?> .wpls-fix-box,
			#wpls-logo-showcase-slider-<?php echo $unique; ?> .wpls-fix-box img.wp-post-image{max-height:<?php echo $max_height; ?>px; }
		</style>
		<div class="wpls-logo-showcase-slider-wrp wpls-logo-clearfix <?php echo $extra_class; ?>" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>">
			<div class="wpls-logo-showcase logo_showcase wpls-logo-slider  wpls-<?php echo $design; ?> <?php echo $center_mode_cls; ?> <?php echo $hide_border; ?> <?php echo $dots_cls; ?>" id="wpls-logo-showcase-slider-<?php echo $unique; ?>" >
				<?php while ($logo_query->have_posts()) : $logo_query->the_post();
					
					$feat_image 	= wpls_get_logo_image( $post->ID, $image_size);
					$logourl 		= get_post_meta( $post->ID, 'wplss_slide_link', true );
					$image_title 	= get_the_title(get_post_thumbnail_id( $post->ID ));
					$feat_image_alt = get_post_meta(get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true);
					
					// Include shortcode html file
					if( $design_file_path ) {
						include( $design_file_path );
					}
					
					endwhile; ?>
			</div>
		</div>
			
		<?php
		wp_reset_postdata(); // Reset WP Query
		$content .= ob_get_clean();
		return $content;
	}
}

// `logoshowcase` slider shortcode
add_shortcode( 'logoshowcase', 'wpls_logo_slider' );