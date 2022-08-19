<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to register post type 
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.2.8
 */
function wplss_logo_showcase_post_types() {

	$sp_logoshowcase_labels =  apply_filters( 'sp_logo_showcase_slider_labels', array(
		'name'                	=> __('Logo Showcase', 'wp-logo-showcase-responsive-slider-slider'),
		'singular_name'       	=> __('Logo Showcase', 'wp-logo-showcase-responsive-slider-slider'),
		'add_new'             	=> __('Add New', 'wp-logo-showcase-responsive-slider-slider'),
		'add_new_item'        	=> __('Add New Logo Showcase', 'wp-logo-showcase-responsive-slider-slider'),
		'edit_item'           	=> __('Edit Logo Showcase', 'wp-logo-showcase-responsive-slider-slider'),
		'new_item'            	=> __('New Logo Showcase', 'wp-logo-showcase-responsive-slider-slider'),
		'all_items'           	=> __('All Logo Showcase', 'wp-logo-showcase-responsive-slider-slider'),
		'view_item'           	=> __('View Logo Showcase', 'wp-logo-showcase-responsive-slider-slider'),
		'search_items'        	=> __('Search Logo Showcase', 'wp-logo-showcase-responsive-slider-slider'),
		'not_found'           	=> __('No Logo Showcase found', 'wp-logo-showcase-responsive-slider-slider'),
		'not_found_in_trash'	=> __('No Logo Showcase found in Trash', 'wp-logo-showcase-responsive-slider-slider'),
		'featured_image' 		=> __('Set logo image', 'wp-logo-showcase-responsive-slider-slider'),
		'set_featured_image'	=> __( 'Set logo image' , 'wp-logo-showcase-responsive-slider-slider' ),
		'remove_featured_image' => __( 'Remove logo image', 'wp-logo-showcase-responsive-slider-slider' ),
		'parent_item_colon'  	=> '',
		'menu_name'           	=> __('Logo Showcase', 'wp-logo-showcase-responsive-slider-slider'),
		'exclude_from_search'	=> true
	));

	$sp_logoshowcase_args = array(
		'labels' 				=> $sp_logoshowcase_labels,
		'public' 				=> false,
		'menu_icon'   			=> 'dashicons-images-alt2',
		'show_ui' 				=> true,
		'show_in_menu' 			=> true,
		'query_var' 			=> false,
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'supports' 				=> array('title','thumbnail')
	);
	register_post_type( 'logoshowcase', apply_filters( 'sp_logoshowcase_post_type_args', $sp_logoshowcase_args ) );
}
add_action('init', 'wplss_logo_showcase_post_types');

/**
 * Function to register post taxonomies 
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.2.8
*/
add_action( 'init', 'wplss_logo_showcase_taxonomies');
function wplss_logo_showcase_taxonomies() {
    $labels = array(
        'name'              => _x( 'Category', 'wp-logo-showcase-responsive-slider-slider' ),
        'singular_name'     => _x( 'Category', 'wp-logo-showcase-responsive-slider-slider' ),
        'search_items'      => __( 'Search Category', 'wp-logo-showcase-responsive-slider-slider' ),
        'all_items'         => __( 'All Category', 'wp-logo-showcase-responsive-slider-slider' ),
        'parent_item'       => __( 'Parent Category', 'wp-logo-showcase-responsive-slider-slider' ),
        'parent_item_colon' => __( 'Parent Category:', 'wp-logo-showcase-responsive-slider-slider' ),
        'edit_item'         => __( 'Edit Category', 'wp-logo-showcase-responsive-slider-slider' ),
        'update_item'       => __( 'Update Category', 'wp-logo-showcase-responsive-slider-slider' ),
        'add_new_item'      => __( 'Add New Category', 'wp-logo-showcase-responsive-slider-slider' ),
        'new_item_name'     => __( 'New Category Name', 'wp-logo-showcase-responsive-slider-slider' ),
        'menu_name'         => __( 'Logo Category', 'wp-logo-showcase-responsive-slider-slider' ),

    );
    $args = array(
    	'public'			=> false,
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => false,
    );
    register_taxonomy( 'wplss_logo_showcase_cat', array( 'logoshowcase' ), $args );
}