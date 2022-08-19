<?php

namespace MasterAddons\Inc\Controls;

use Elementor\Group_Control_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Tooltip Group Controls
 * Date: 03/09/21
 */

/**
 * MA Filters-HSB group control
 *
 */
class MA_Group_Control_Filters_HSB extends Group_Control_Base
{

    protected static $fields;
    private static $_instance = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public static function get_type()
    {
        return 'jltma-filters-hsb';
    }

    protected function init_fields()
    {
        $controls = [];

        $controls['filter_type'] = [
            'type' => Controls_Manager::HIDDEN,
            'default' => 'custom',
        ];
        $controls['hue'] = [
            'label' => _x('Hue', 'Filter Control', 'master-addons' ),
            'type' => Controls_Manager::SLIDER,
            'render_type' => 'ui',
            'required' => 'true',
            'default' => [
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 360,
                ],
            ],
            'separator' => 'none',
            'selectors' => [
                '{{SELECTOR}}' => 'filter: hue-rotate( {{hue.SIZE}}deg) saturate( {{saturate.SIZE}}% ) brightness( {{brightness.SIZE}}% );',
            ],
            'condition' => [
                'filter_type' => 'custom',
            ],
        ];
        $controls['saturate'] = [
            'label' => _x('Saturation', 'Filter Control', 'master-addons' ),
            'type' => Controls_Manager::SLIDER,
            'render_type' => 'ui',
            'required' => 'true',
            'default' => [
                'size' => 100,
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'separator' => 'none',
            'condition' => [
                'filter_type' => 'custom',
            ],
        ];
        $controls['brightness'] = [
            'label' => _x('Brightness', 'Filter Control', 'master-addons' ),
            'type' => Controls_Manager::SLIDER,
            'render_type' => 'ui',
            'required' => 'true',
            'default' => [
                'size' => 100,
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'separator' => 'none',
            'condition' => [
                'filter_type' => 'custom',
            ],
        ];

        return $controls;
    }

    protected function prepare_fields($fields)
    {
        array_walk($fields, function (&$field, $field_name) {
            if (in_array($field_name, ['filter_hsb', 'popover_toggle'])) {
                return;
            }
            $field['condition'] = [
                'filter_hsb' => 'custom',
            ];
        });

        return parent::prepare_fields($fields);
    }



    /**
     * @access protected
     */
    protected function get_default_options()
    {
        return [
            'popover' => [
                'starter_title' => _x('Filters HSB', 'Filters HSB Control', 'master-addons' ),
                'starter_name' => 'filter_hsb',
            ],
        ];
    }
}
