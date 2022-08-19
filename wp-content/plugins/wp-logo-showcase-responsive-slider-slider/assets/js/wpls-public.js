( function( $ ) {

	"use strict";

    wpls_logo_slider_init();

    /* Elementor Compatibility */
    $(document).on('click', '.elementor-tab-title', function() {

        var ele_control = $(this).attr('aria-controls');
        var slider_wrap = $('#'+ele_control).find('.wpls-logo-showcase');

        /* Tweak for slick slider */
        $( slider_wrap ).each(function( index ) {
            var slider_id = $(this).attr('id');
            $('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

            setTimeout(function() {
                if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
                    $('#'+slider_id).slick( 'setPosition' );
                    $('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
                }
            }, 350);
        });
    });

    /* Beaver Builder Compatibility for Accordion and Tabs */
    $(document).on('click', '.fl-accordion-button, .fl-tabs-label', function() {

        var ele_control = $(this).attr('aria-controls');
        var slider_wrap = $('#'+ele_control).find('.wpls-logo-showcase');

        /* Tweak for slick slider */
        $( slider_wrap ).each(function( index ) {
            var slider_id = $(this).attr('id');
            $('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

            setTimeout(function() {
                if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
                    $('#'+slider_id).slick( 'setPosition' );
                    $('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
                }
            }, 300);
        });
    });

    /* SiteOrigin Compatibility For Accordion Panel */
    $(document).on('click', '.sow-accordion-panel', function() {

        var ele_control = $(this).attr('data-anchor');
        var slider_wrap = $('#accordion-content-'+ele_control).find('.wpls-logo-showcase');

        /* Tweak for slick slider */
        $( slider_wrap ).each(function( index ) {
            var slider_id = $(this).attr('id');

            if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
                $('#'+slider_id).slick( 'setPosition' );
            }
        });
    });

    /* SiteOrigin Compatibility for Tab Panel */
    $(document).on('click focus', '.sow-tabs-tab', function() {
        var sel_index   = $(this).index();
        var cls_ele     = $(this).closest('.sow-tabs');
        var tab_cnt     = cls_ele.find('.sow-tabs-panel').eq( sel_index );
        var slider_wrap = tab_cnt.find('.wpls-logo-showcase');

        /* Tweak for slick slider */
        $( slider_wrap ).each(function( index ) {
            var slider_id = $(this).attr('id');
            $('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

            setTimeout(function() {
                if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
                    $('#'+slider_id).slick( 'setPosition' );
                    $('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
                }
            }, 300);
        });
    });

    /* Divi Builder Compatibility for Accordion & Toggle */
    $(document).on('click', '.et_pb_toggle', function() {

        var acc_cont    = $(this).find('.et_pb_toggle_content');
        var slider_wrap = acc_cont.find('.wpls-logo-showcase');

        /* Tweak for slick slider */
        $( slider_wrap ).each(function( index ) {

            var slider_id = $(this).attr('id');

            if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
                $('#'+slider_id).slick( 'setPosition' );
            }
        });
    });

    /* Divi Builder Compatibility for Tabs */
    $('.et_pb_tabs_controls li a').click( function() {
        var cls_ele     = $(this).closest('.et_pb_tabs');
        var tab_cls     = $(this).closest('li').attr('class');
        var tab_cont    = cls_ele.find('.et_pb_all_tabs .'+tab_cls);
        var slider_wrap = tab_cont.find('.wpls-logo-showcase');

        setTimeout(function() {

            /* Tweak for slick slider */
            $( slider_wrap ).each(function( index ) {

                var slider_id = $(this).attr('id');

                $('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

                if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
                    $('#'+slider_id).slick( 'setPosition' );
                    $('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
                }
            });
        }, 550);
    });

    /* Fusion Builder Compatibility for Tabs */
    $(document).on('click', '.fusion-tabs li .tab-link', function() {
        var cls_ele         = $(this).closest('.fusion-tabs');
        var tab_id          = $(this).attr('href');
        var tab_cont        = cls_ele.find(tab_id);
        var slider_wrap     = tab_cont.find('.wpls-logo-showcase');

        /* Tweak for slick slider default */
        $( slider_wrap ).each(function( index ) {

            var slider_id   = $(this).attr('id');
            $('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

            setTimeout(function() {
                /* Tweak for slick slider */
                if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
                    $('#'+slider_id).slick( 'setPosition' );
                    $('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
                    $('#'+slider_id).slick( 'setPosition' );
                }
            }, 200);
        });
    });

    /* Fusion Builder Compatibility for Toggles */
    $(document).on('click', '.fusion-accordian .panel-heading a', function() {
        var cls_ele         = $(this).closest('.fusion-accordian');
        var tab_id          = $(this).attr('href');
        var tab_cont        = cls_ele.find(tab_id);
        var slider_wrap     = tab_cont.find('.wpls-logo-showcase');

        /* Tweak for slick slider default */
        $( slider_wrap ).each(function( index ) {

            var slider_id   = $(this).attr('id');
            $('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

            /* Tweak for slick slider */
            setTimeout(function() {
                if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
                    $('#'+slider_id).slick( 'setPosition' );
                    $('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
                    $('#'+slider_id).slick( 'setPosition' );
                }
            }, 200);
        });
    });

})( jQuery );

// Logo Slider JS
function wpls_logo_slider_init(){

    // Logo Slider
    jQuery( '.wpls-logo-slider' ).each(function( index ) {

        if( jQuery(this).hasClass('slick-initialized') ) {
            return;
        }

        // Flex Condition
        if(Wpls.is_avada == 1) {
            jQuery(this).closest('.fusion-flex-container').addClass('wpls-fusion-flex');
        }

        var slider_id   = jQuery(this).attr('id');
        var logo_conf   = JSON.parse( jQuery(this).closest('.wpls-logo-showcase-slider-wrp').attr('data-conf') );

        if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
            jQuery('#'+slider_id).slick({
                lazyLoad        : logo_conf.lazyload,
                centerMode      : ( logo_conf.center_mode == "true" )  ? true : false,
                dots            : ( logo_conf.dots == "true" )         ? true : false,
                arrows          : ( logo_conf.arrows == "true" )       ? true : false,
                infinite        : ( logo_conf.loop == "true" )         ? true : false,
                autoplay        : ( logo_conf.autoplay == "true" )     ? true : false,
                speed           : parseInt( logo_conf.speed ),
                slidesToShow    : parseInt( logo_conf.slides_column ),
                slidesToScroll  : parseInt( logo_conf.slides_scroll ),
                autoplaySpeed   : parseInt( logo_conf.autoplay_interval ),
                pauseOnFocus    : false,
                centerPadding   : '0px',
                rtl             : ( logo_conf.rtl == "true" ) ? true : false,
                mobileFirst     : ( Wpls.is_mobile == 1 ) ? true : false,
                responsive: [{
                  breakpoint: 1023,
                  settings: {
                    slidesToShow  : ( parseInt( logo_conf.slides_column ) > 3 ) ? 3 : parseInt( logo_conf.slides_column ),
                    slidesToScroll  : 1
                  }
                },{
                  breakpoint: 640,
                  settings: {
                    slidesToShow  : ( parseInt( logo_conf.slides_column ) > 2 ) ? 2 : parseInt( logo_conf.slides_column ),
                    slidesToScroll  : 1
                  }
                },{
                  breakpoint: 479,
                  settings: {
                    slidesToShow  : 1,
                    slidesToScroll  : 1
                  }
                },{
                  breakpoint: 319,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }]
          });
        }
    });
}