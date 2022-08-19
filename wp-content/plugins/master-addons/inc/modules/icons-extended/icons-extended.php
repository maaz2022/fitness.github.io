<?php

namespace MasterAddons\Modules;

use \Elementor\Controls_Manager;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 6/5/2021
 */

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly.

class JLTMA_Extension_Icons_Extended
{

    /*
	* Instance of this class
	*/
    private static $instance = null;

    public function __construct()
    {
        // Add new Icons to Icons Manager
        add_filter('elementor/icons_manager/additional_tabs', [$this, 'jltma_add_icons_manager_tab'], 100, 3);
    }

    // Add Section Controls
    public function jltma_add_icons_manager_tab($tabs)
    {
        // Adds Icons Library options

        $tabs['elementor-icons'] = [
            'name'          => 'elementor-icons',
            'label'         => __('Elementor Icons', 'master-addons' ),
            'prefix'        => 'eicon-',
            'displayPrefix' => 'elementor-icons',
            'labelIcon'     => 'jltma-icon jltma-icon-ma elementor-icons eicon eicon-elementor-circle jltma-font-manager',
            'ver'           => JLTMA_VER,
            'fetchJson'     => JLTMA_ASSETS . 'fonts/elementor-icon/elementor-icons.js?v=' . JLTMA_VER,
            'native'        => true,
        ];

        $tabs['simple-line-icons'] = [
            'name'          => 'simple-line-icons',
            'label'         => __('Simple Line Icons', 'master-addons' ),
            'url'           => JLTMA_ASSETS . 'fonts/simple-line-icons/simple-line-icons.css',
            'enqueue'       => [JLTMA_ASSETS . 'fonts/simple-line-icons/simple-line-icons.css'],
            'prefix'        => 'icon-',
            'displayPrefix' => 'simple-line-icons',
            'labelIcon'     => 'jltma-icon jltma-icon-ma simple-line-icons icon-heart jltma-font-manager',
            'ver'           => JLTMA_VER,
            'fetchJson'     => JLTMA_ASSETS . 'fonts/simple-line-icons/simple-line-icons.js?v=' . JLTMA_VER,
            'native'        => false,
        ];

        $tabs['iconic-fonts'] = [
            'name'          => 'iconic-fonts',
            'label'         => __('Iconic Font Icons', 'master-addons' ),
            'url'           => JLTMA_ASSETS . 'fonts/iconic-fonts/iconic-font.min.css',
            'enqueue'       => [JLTMA_ASSETS . 'fonts/iconic-fonts/iconic-font.min.css'],
            'prefix'        => 'im-',
            'displayPrefix' => 'im',
            'labelIcon'     => 'jltma-icon jltma-icon-ma iconic-fonts im im-flag jltma-font-manager',
            'ver'           => JLTMA_VER,
            'fetchJson'     => JLTMA_ASSETS . 'fonts/iconic-fonts/iconic-fonts.js?v=' . JLTMA_VER,
            'native'        => false,
        ];

        $tabs['linear-icons'] = [
            'name'          => 'linear-icons',
            'label'         => __('Linear Icons', 'master-addons' ),
            'url'           => JLTMA_ASSETS . 'fonts/linear-icons/linear-icons.css',
            'enqueue'       => [JLTMA_ASSETS . 'fonts/linear-icons/linear-icons.css'],
            'prefix'        => 'lnr-',
            'displayPrefix' => 'lnr',
            'labelIcon'     => 'jltma-icon jltma-icon-ma linear-icons lnr lnr-flag jltma-font-manager',
            'ver'           => JLTMA_VER,
            'fetchJson'     => JLTMA_ASSETS . 'fonts/linear-icons/linear-icons.js?v=' . JLTMA_VER,
            'native'        => false,
        ];

        $tabs['material-icons'] = [
            'name'          => 'material-icons',
            'label'         => __('Material Icons', 'master-addons' ),
            'url'           => JLTMA_ASSETS . 'fonts/material-icons/material-icons.css',
            'enqueue'       => [JLTMA_ASSETS . 'fonts/material-icons/material-icons.css'],
            'prefix'        => 'jltma-material-icon-',
            'displayPrefix' => 'jltma-material-icon',
            'labelIcon'     => 'jltma-icon jltma-icon-ma material-icons jltma-material-icon-flag jltma-font-manager',
            'ver'           => JLTMA_VER,
            'fetchJson'     => JLTMA_ASSETS . 'fonts/material-icons/material-icons.js?v=' . JLTMA_VER,
            'native'        => false,
        ];

        return $tabs;
    }


    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}

JLTMA_Extension_Icons_Extended::get_instance();
