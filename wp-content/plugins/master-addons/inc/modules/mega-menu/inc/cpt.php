<?php

namespace MasterAddons\Modules\MegaMenu;

defined('ABSPATH') || exit;

class JLTMA_Megamenu_Cpt
{

    private static $_instance = null;

    public function __construct()
    {
        add_action('init', [$this, 'post_types']);
    }

    public function post_types()
    {

        $labels = array(
            'name'                  => _x('Master Addons Items', 'Post Type General Name', 'master-addons' ),
            'singular_name'         => _x('Master Addons Item', 'Post Type Singular Name', 'master-addons' ),
            'menu_name'             => esc_html__('Master Addons item', 'master-addons' ),
            'name_admin_bar'        => esc_html__('Master Addons item', 'master-addons' ),
            'archives'              => esc_html__('Item Archives', 'master-addons' ),
            'attributes'            => esc_html__('Item Attributes', 'master-addons' ),
            'parent_item_colon'     => esc_html__('Parent Item:', 'master-addons' ),
            'all_items'             => esc_html__('All Items', 'master-addons' ),
            'add_new_item'          => esc_html__('Add New Item', 'master-addons' ),
            'add_new'               => esc_html__('Add New', 'master-addons' ),
            'new_item'              => esc_html__('New Item', 'master-addons' ),
            'edit_item'             => esc_html__('Edit Item', 'master-addons' ),
            'update_item'           => esc_html__('Update Item', 'master-addons' ),
            'view_item'             => esc_html__('View Item', 'master-addons' ),
            'view_items'            => esc_html__('View Items', 'master-addons' ),
            'search_items'          => esc_html__('Search Item', 'master-addons' ),
            'not_found'             => esc_html__('Not found', 'master-addons' ),
            'not_found_in_trash'    => esc_html__('Not found in Trash', 'master-addons' ),
            'featured_image'        => esc_html__('Featured Image', 'master-addons' ),
            'set_featured_image'    => esc_html__('Set featured image', 'master-addons' ),
            'remove_featured_image' => esc_html__('Remove featured image', 'master-addons' ),
            'use_featured_image'    => esc_html__('Use as featured image', 'master-addons' ),
            'insert_into_item'      => esc_html__('Insert into item', 'master-addons' ),
            'uploaded_to_this_item' => esc_html__('Uploaded to this item', 'master-addons' ),
            'items_list'            => esc_html__('Items list', 'master-addons' ),
            'items_list_navigation' => esc_html__('Items list navigation', 'master-addons' ),
            'filter_items_list'     => esc_html__('Filter items list', 'master-addons' ),
        );
        $rewrite = array(
            'slug'                  => 'mastermega-content',
            'with_front'            => true,
            'pages'                 => false,
            'feeds'                 => false,
        );
        $args = array(
            'label'                 => esc_html__('Master Addons Item', 'master-addons' ),
            'description'           => esc_html__('mastermega_content', 'master-addons' ),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'elementor', 'permalink'),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => false,
            'show_in_menu'          => false,
            'menu_position'         => 5,
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'publicly_queryable' => true,
            'rewrite'               => $rewrite,
            'query_var' => true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
            'rest_base'             => 'mastermega-content',
        );
        register_post_type('mastermega_content', $args);
    }

    public static function get_instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}


/*
* Returns Instanse of the Master Mega Menu
*/
if (!function_exists('jltma_megamenu_cpt')) {
    function jltma_megamenu_cpt()
    {
        return JLTMA_Megamenu_Cpt::get_instance();
    }
}

jltma_megamenu_cpt();
