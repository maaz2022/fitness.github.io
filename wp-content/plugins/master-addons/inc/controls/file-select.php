<?php

namespace MasterAddons\Inc\Controls;

use Elementor\Base_Data_Control;

if (!defined('ABSPATH')) {
    exit;
};

class JLTMA_Control_File_Select extends Base_Data_Control
{

    public function get_type()
    {
        return 'jltma-file-select';
    }


    /**
     * Enqueue control scripts and styles.
     *
     * Used to register and enqueue custom scripts and styles
     * for this control.
     *
     * @access public
     */
    public function enqueue()
    {
        wp_enqueue_media();
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');

        // Scripts
        wp_enqueue_script('jltma-file-select-control', JLTMA_ADMIN_ASSETS . 'js/file-select-control.js', array('jquery'), JLTMA_VER, true);
        wp_enqueue_script('jltma-file-select-control');
    }

    /**
     * Get default settings.
     *
     * @access protected
     *
     * @return array Control default settings.
     */
    protected function get_default_settings()
    {
        return [
            'label_block' => true,
        ];
    }

    /**
     * Render control output in the editor.
     *
     * @access public
     */
    public function content_template()
    {
        $control_uid = $this->get_control_uid();
?>
        <div class="elementor-control-field">
            <label for="<?php echo esc_attr($control_uid); ?>" class="elementor-control-title">{{{ data.label }}}</label>
            <div class="elementor-control-input-wrapper">
                <a href="#" class="jltma-select-file elementor-button elementor-button-success" style="padding: 10px 15px;border:none !important;display: block;text-align: center;" id="select-file-<?php echo esc_attr($control_uid); ?>"><?php echo esc_html__("Choose / Upload File", 'theme-masters-elementor'); ?></a> <br />

                <input type="text" class="jltma-selected-file-url" id="<?php echo esc_attr($control_uid); ?>" data-setting="{{ data.name }}" placeholder="{{ data.placeholder }}">
            </div>
        </div>
        <# if ( data.description ) { #>
            <div class="elementor-control-field-description">{{{ data.description }}}</div>
            <# } #>
        <?php
    }
}
