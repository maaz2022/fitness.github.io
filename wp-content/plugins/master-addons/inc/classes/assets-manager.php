<?php

namespace MasterAddons\Inc\Classes;

use  MasterAddons\Master_Elementor_Addons ;
class Master_Addons_Assets
{
    private static  $instance = null ;
    public  $gsap_version = '1.20.2' ;
    public function __construct()
    {
        add_action( 'elementor/init', [ $this, 'jltma_on_elementor_init' ], 0 );
        // Enqueue Styles and Scripts
        // add_action('wp_enqueue_scripts', [$this, 'jltma_enqueue_scripts'], 100);
        // add_action('wp_enqueue_scripts', [$this, 'jltma_enqueue_scripts']); // Changed on 10-9-21
    }
    
    public function jltma_on_elementor_init()
    {
        // Elementor hooks
        $this->add_actions();
    }
    
    public function add_actions()
    {
        // Elementor Scripts Dependencies
        add_action( 'elementor/frontend/after_register_styles', [ $this, 'jltma_register_frontend_styles' ] );
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'jltma_register_frontend_scripts' ] );
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'jltma_enqueue_scripts' ] );
        // add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'jltma_editor_scripts_enqueue_js' ]);
        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'jltma_editor_scripts_js' ], 100 );
        add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'jltma_enqueue_preview_scripts' ], 100 );
        add_action( 'elementor/preview/enqueue_styles', [ $this, 'jltma_enqueue_preview_scripts' ], 100 );
        add_action( 'elementor/preview/enqueue_scripts', [ $this, 'jltma_enqueue_preview_scripts' ], 100 );
    }
    
    /** Enqueue Elementor Editor Styles */
    public function jltma_editor_scripts_js()
    {
        wp_enqueue_script(
            'master-addons-editor',
            JLTMA_ADMIN_ASSETS . 'js/editor.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        // Editor Localize Data
    }
    
    // Enqueue Preview Scripts
    public function jltma_enqueue_preview_scripts()
    {
        // wp_enqueue_style('ma-creative-buttons');
        wp_enqueue_script( 'jltma-timeline' );
    }
    
    // Register Frontend Styles
    public function jltma_register_frontend_styles()
    {
        $jltma_vendor_dir = JLTMA_URL . '/assets/vendor/';
        wp_register_style( 'gridder', JLTMA_URL . '/assets/vendor/gridder/css/jquery.gridder.min.css' );
        wp_register_style( 'fancybox', JLTMA_URL . '/assets/vendor/fancybox/jquery.fancybox.min.css' );
        wp_register_style( 'twentytwenty', JLTMA_URL . '/assets/vendor/image-comparison/css/twentytwenty.css' );
        // Data Tables
        wp_register_script( 'jltma-data-table', $jltma_vendor_dir . 'datatable/table.min.css' );
    }
    
    // Enqueue Preview Scripts
    public function jltma_register_frontend_scripts()
    {
        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );
        $jltma_vendor_dir = JLTMA_URL . '/assets/vendor/';
        wp_register_script(
            'swiper',
            'https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.3.6/js/swiper.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'ma-animated-headlines',
            JLTMA_URL . '/assets/js/animated-main.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'master-addons-progressbar',
            JLTMA_URL . '/assets/js/loading-bar.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'jquery-stats',
            JLTMA_URL . '/assets/js/jquery.stats.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'master-addons-waypoints',
            JLTMA_URL . '/assets/vendor/jquery.waypoints.min.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'jltma-owl-carousel',
            JLTMA_URL . '/assets/vendor/owlcarousel/owl.carousel.min.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'gridder',
            JLTMA_URL . '/assets/vendor/gridder/js/jquery.gridder.min.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'isotope',
            JLTMA_URL . '/assets/js/isotope.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'ma-news-ticker',
            JLTMA_URL . '/assets/vendor/newsticker/js/newsticker.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'jquery-rss',
            JLTMA_URL . '/assets/vendor/newsticker/js/jquery.rss.min.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'ma-counter-up',
            JLTMA_URL . '/assets/js/counterup.min.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'ma-countdown',
            JLTMA_URL . '/assets/vendor/countdown/jquery.countdown.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'jltma-table-of-content',
            JLTMA_URL . '/assets/vendor/jltma-table-of-content/jltma-table-of-content.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'fancybox',
            JLTMA_URL . '/assets/vendor/fancybox/jquery.fancybox.min.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        if ( ma_el_fs()->can_use_premium_code() ) {
            // GSAP TweenMax
            wp_register_script(
                'gsap-js',
                '//cdnjs.cloudflare.com/ajax/libs/gsap/' . $this->gsap_version . '/TweenMax.min.js',
                array(),
                null,
                true
            );
        }
        wp_register_script(
            'jltma-timeline',
            JLTMA_URL . '/assets/js/timeline.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'jltma-tilt',
            JLTMA_URL . '/assets/vendor/tilt/tilt.jquery.min.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        
        if ( ma_el_fs()->can_use_premium_code() ) {
            // Navmenu & Offcanvas Menu
            wp_register_script(
                'jltma-offcanvas-menu',
                JLTMA_URL . '/assets/js/addons/offcanvas-menu.js',
                [ 'jquery' ],
                JLTMA_VER,
                true
            );
            wp_register_script(
                'jltma-nav-menu',
                JLTMA_URL . '/assets/js/addons/jltma-nav-menu.js',
                [ 'jquery', 'elementor-frontend-modules' ],
                JLTMA_VER,
                true
            );
        }
        
        // Tippy JS
        wp_register_style( 'jltma-tippy', $jltma_vendor_dir . 'tippyjs/css/tippy.css' );
        wp_register_script(
            'jltma-popper',
            $jltma_vendor_dir . 'popper.min.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'jltma-tippy',
            $jltma_vendor_dir . 'tippyjs/js/tippy.min.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'jltma-section-tooltip',
            JLTMA_URL . '/assets/js/extensions/ma-tooltips.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        // Image Comparison
        wp_register_script(
            'jquery-event-move',
            JLTMA_URL . '/assets/vendor/image-comparison/js/jquery.event.move.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'twentytwenty',
            JLTMA_URL . '/assets/vendor/image-comparison/js/jquery.twentytwenty.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        // Toggle Content
        wp_register_script(
            'jltma-toggle-content',
            JLTMA_URL . '/assets/vendor/toggle-content/toggle-content.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        // Data Tables
        wp_register_script(
            'jltma-data-table',
            $jltma_vendor_dir . 'datatable/table.min.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
    }
    
    /**
     * Enqueue Plugin Styles and Scripts
     *
     */
    public function jltma_enqueue_scripts()
    {
        // Register Styles
        //Reveal
        wp_register_script(
            'ma-el-reveal-lib',
            JLTMA_URL . '/assets/vendor/reveal/revealFx.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_register_script(
            'ma-el-anime-lib',
            JLTMA_URL . '/assets/vendor/anime/anime.min.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        //Rellax
        wp_register_script(
            'ma-el-rellaxjs-lib',
            JLTMA_URL . '/assets/vendor/rellax/rellax.min.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        // Enqueue Styles
        wp_enqueue_style( 'master-addons-main-style', JLTMA_URL . '/assets/css/master-addons-styles.css' );
        // Enqueue Scripts
        wp_enqueue_script(
            'master-addons-plugins',
            JLTMA_URL . '/assets/js/plugins.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        wp_enqueue_script(
            'master-addons-scripts',
            JLTMA_URL . '/assets/js/master-addons-scripts.js',
            [ 'jquery' ],
            JLTMA_VER,
            true
        );
        // Add essential inline scripts to header
        $jltma_header_inline_scripts = 'function jltmaNS(n){for(var e=n.split("."),a=window,i="",r=e.length,t=0;r>t;t++)"window"!=e[t]&&(i=e[t],a[i]=a[i]||{},a=a[i]);return a;}';
        if ( $jltma_header_inline_scripts = apply_filters( 'jltma_header_inline_scripts', $jltma_header_inline_scripts ) ) {
            wp_add_inline_script( 'jquery-core', "/* < ![CDATA[ */\n" . $jltma_header_inline_scripts . "\n/* ]]> */", 'before' );
        }
        $localize_data = array(
            'plugin_url' => JLTMA_URL,
            'ajaxurl'    => admin_url( 'admin-ajax.php' ),
            'nonce'      => 'master-addons-elementor',
        );
        wp_localize_script( 'master-addons-scripts', 'jltma_scripts', $localize_data );
        // Data Table localization
        $jltma_data_table_param = array(
            "lengthMenu"        => esc_html__( 'Display _MENU_ records per page', 'master-addons' ),
            "zeroRecords"       => esc_html__( 'Nothing found - sorry', 'master-addons' ),
            "info"              => esc_html__( 'Showing page _PAGE_ of _PAGES_', 'master-addons' ),
            "infoEmpty"         => esc_html__( 'No records available', 'master-addons' ),
            "infoFiltered"      => esc_html__( '(filtered from _MAX_ total records)', 'master-addons' ),
            "searchPlaceholder" => esc_html__( 'Search...', 'master-addons' ),
            "processing"        => esc_html__( 'Processing...', 'master-addons' ),
            "csvHtml5"          => esc_html__( 'CSV', 'master-addons' ),
            "excelHtml5"        => esc_html__( 'Excel', 'master-addons' ),
            "pdfHtml5"          => esc_html__( 'PDF', 'master-addons' ),
            "print"             => esc_html__( 'Print', 'master-addons' ),
        );
        wp_localize_script( 'master-addons-scripts', 'jltma_data_table_vars', $jltma_data_table_param );
    }
    
    public static function get_instance()
    {
        if ( !self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}
Master_Addons_Assets::get_instance();