<?php

namespace MasterHeaderFooter;

defined('ABSPATH') || exit;

class JLTMA_Header_Footer_Assets
{

    private static $_instance = null;

    public function __construct()
    {

        add_action('admin_print_scripts', [$this, 'jltma_admin_js']);

        // enqueue scripts
        add_action('admin_enqueue_scripts', [$this, 'jltma_header_footer_enqueue_scripts']);
    }

    // Declare Variable for Rest API
    public function jltma_admin_js()
    {
        echo "<script type='text/javascript'>\n";
        echo $this->jltma_common_js();
        echo "\n</script>";
    }


    public function jltma_common_js()
    {
        ob_start(); ?>
        var masteraddons = { resturl: '<?php echo get_rest_url() . 'masteraddons/v2/'; ?>', }
<?php
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function jltma_header_footer_enqueue_scripts()
    {

        $screen = get_current_screen();

        if ($screen->id == 'edit-master_template') {

            // CSS
            wp_enqueue_style('jtlma-popup', JLTMA_PLUGIN_URL . 'assets/css/header-footer.css');
            wp_enqueue_style('select2', JLTMA_PLUGIN_URL . 'assets/css/select2.min.css');

            // JS
            wp_enqueue_script('select2', JLTMA_PLUGIN_URL . 'assets/js/select2.js', array('jquery'), true, JLTMA_VER);
            wp_enqueue_script('jltma-hfc-admin-script', JLTMA_PLUGIN_URL . 'assets/js/admin-script.js', array('jquery'), true, JLTMA_VER);

            // Localize Scripts
            $jltma_localize_hfc_data = array(
                'plugin_url'    => JLTMA_PLUGIN_URL,
                'ajaxurl'       => admin_url('admin-ajax.php'),
                'resturl'       => get_rest_url() . 'masteraddons/v2/',
                'ajax_nonce'    => wp_create_nonce('jltma_frontend_ajax_nonce'),
                'upgrade_pro'   => /* translators: %s: Upgrade Pro Link. */ sprintf(__('<a href="%1$s" target="_blank">Upgrade to Pro</a> unlock this feature. <a href="%1$s" target="_blank">Upgrade Now</a>', 'master-addons' ), ma_el_fs()->get_upgrade_url())
            );
            wp_localize_script('jltma-hfc-admin-script', 'masteraddons', $jltma_localize_hfc_data);
        }
    }


    public static function get_instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}

JLTMA_Header_Footer_Assets::get_instance();
