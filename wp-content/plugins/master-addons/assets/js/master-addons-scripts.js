/*
* Frontend Script for Elementor
*/
; (function ($) {
    "use strict";

    var editMode = false;
    var isRellax = false;
    var currentDevice = '';

    var getElementSettings = function ($element, setting) {

        var elementSettings = {},
            modelCID = $element.data('model-cid');

        if (elementorFrontend.isEditMode() && modelCID) {
            var settings = elementorFrontend.config.elements.data[modelCID],
                type = settings.attributes.widgetType || settings.attributes.elType,
                settingsKeys = elementorFrontend.config.elements.keys[type];

            if (!settingsKeys) {
                settingsKeys = elementorFrontend.config.elements.keys[type] = [];

                jQuery.each(settings.controls, function (name, control) {
                    if (control.frontend_available) {
                        settingsKeys.push(name);
                    }
                });
            }

            jQuery.each(settings.getActiveControls(), function (controlKey) {
                if (-1 !== settingsKeys.indexOf(controlKey)) {
                    elementSettings[controlKey] = settings.attributes[controlKey];
                }
            });
        } else {
            elementSettings = $element.data('settings') || {};
        }

        return getItems(elementSettings, setting);

    };

    var getItems = function (items, itemKey) {
        if (itemKey) {
            var keyStack = itemKey.split('.'),
                currentKey = keyStack.splice(0, 1);

            if (!keyStack.length) {
                return items[currentKey];
            }

            if (!items[currentKey]) {
                return;
            }

            return this.getItems(items[currentKey], keyStack.join('.'));
        }

        return items;
    };

    var getUniqueLoopScopeId = function($scope){
        if ( $scope.data('jltma-template-widget-id') ) {
            return $scope.data('jltma-template-widget-id');
        }
        return $scope.data('id');
    };



    var Master_Addons = {

        animatedProgressbar: function (id, type, value, strokeColor, trailColor, strokeWidth, strokeTrailWidth) {
            var triggerClass = '.jltma-progress-bar-' + id;
            if ("line" == type) {
                new ldBar(triggerClass, {
                    "type": 'stroke',
                    "path": 'M0 10L100 10',
                    "aspect-ratio": 'none',
                    "stroke": strokeColor,
                    "stroke-trail": trailColor,
                    "stroke-width": strokeWidth,
                    "stroke-trail-width": strokeTrailWidth
                }).set(value);
            }
            if ("line-bubble" == type) {
                new ldBar(triggerClass, {
                    "type": 'stroke',
                    "path": 'M0 10L100 10',
                    "aspect-ratio": 'none',
                    "stroke": strokeColor,
                    "stroke-trail": trailColor,
                    "stroke-width": strokeWidth,
                    "stroke-trail-width": strokeTrailWidth
                }).set(value);
                $($('.jltma-progress-bar-' + id).find('.ldBar-label')).animate({
                    left: value + '%'
                }, 1000, 'swing');
            }
            if ("circle" == type) {
                new ldBar(triggerClass, {
                    "type": 'stroke',
                    "path": 'M50 10A40 40 0 0 1 50 90A40 40 0 0 1 50 10',
                    "stroke-dir": 'normal',
                    "stroke": strokeColor,
                    "stroke-trail": trailColor,
                    "stroke-width": strokeWidth,
                    "stroke-trail-width": strokeTrailWidth,
                }).set(value);
            }
            if ("fan" == type) {
                new ldBar(triggerClass, {
                    "type": 'stroke',
                    "path": 'M10 90A40 40 0 0 1 90 90',
                    "stroke": strokeColor,
                    "stroke-trail": trailColor,
                    "stroke-width": strokeWidth,
                    "stroke-trail-width": strokeTrailWidth,
                }).set(value);
            }
        },


        // Master Addons: Headlines

        MA_Animated_Headlines: function ($scope, $) {
            try {
                (function ($) {

                    Master_Addons.MA_Animated_Headlines.elementSettings    = getElementSettings( $scope );

                    /*----------- Animated Headlines --------------*/
                    //set animation timing
                    var $animatedHeaderContainer     = $scope.find('.jltma-animated-headline').eq(0),

                        animationDelay = Master_Addons.MA_Animated_Headlines.elementSettings.anim_delay ? Master_Addons.MA_Animated_Headlines.elementSettings.anim_delay : 2500,

                        //loading bar effect
                        barAnimationDelay = Master_Addons.MA_Animated_Headlines.elementSettings.bar_anim_delay ? Master_Addons.MA_Animated_Headlines.elementSettings.bar_anim_delay : 3800,
                        barWaiting = barAnimationDelay - 3000, //3000 is the duration of the transition on the loading bar - set in the scss/css file

                        //letters effect
                        lettersDelay = Master_Addons.MA_Animated_Headlines.elementSettings.letters_anim_delay ? Master_Addons.MA_Animated_Headlines.elementSettings.letters_anim_delay : 50,

                        //type effect
                        typeLettersDelay = Master_Addons.MA_Animated_Headlines.elementSettings.type_anim_delay ? Master_Addons.MA_Animated_Headlines.elementSettings.type_anim_delay : 150,
                        selectionDuration = Master_Addons.MA_Animated_Headlines.elementSettings.type_selection_delay ? Master_Addons.MA_Animated_Headlines.elementSettings.type_selection_delay : 500,
                        typeAnimationDelay = selectionDuration + 800,

                        //clip effect
                        revealDuration = Master_Addons.MA_Animated_Headlines.elementSettings.clip_reveal_delay ? Master_Addons.MA_Animated_Headlines.elementSettings.clip_reveal_delay : 600,
                        revealAnimationDelay = Master_Addons.MA_Animated_Headlines.elementSettings.clip_anim_duration ? Master_Addons.MA_Animated_Headlines.elementSettings.clip_anim_duration : 1500;


                    Master_Addons.MA_Animated_Headlines.singleLetters = function($words) {
                        $words.each(function(){
                            var word = $(this),
                                letters = word.text().trim().split(''),
                                selected = word.hasClass('is-visible');

                            for( var i=0; i<letters.length; i++){
                                if(word.parents('.rotate-2').length > 0){ letters[i] = '<em>' + letters[i] + '</em>'; }
                                letters[i] = (selected) ? '<i class="in">' + letters[i] + '</i>': '<i>' + letters[i] + '</i>';
                            }
                            var newLetters = letters.join('');
                            word.html(newLetters).css('opacity', 1);
                        });
                    }

                    // function animateHeadline($headlines) {
                    Master_Addons.MA_Animated_Headlines.animateHeadline = function($headlines) {

                        var duration = animationDelay;

                        $headlines.each(function(){
                            var headline = $(this);

                            if(headline.hasClass('loading-bar')) {
                                duration = barAnimationDelay;
                                setTimeout(function(){ headline.find('.ma-el-words-wrapper').addClass('is-loading') }, barWaiting);
                            } else if (headline.hasClass('clip')){
                                var spanWrapper = headline.find('.ma-el-words-wrapper'),
                                    newWidth = spanWrapper.width() + 10
                                spanWrapper.css('width', newWidth);
                            } else if (!headline.hasClass('type') ) {
                                //assign to .ma-el-words-wrapper the width of its longest word
                                var words = headline.find('.ma-el-words-wrapper b'),
                                    width = 0;

                                words.each(function(){
                                    var wordWidth = $(this).width();
                                    if (wordWidth > width) width = wordWidth;
                                });
                                headline.find('.ma-el-words-wrapper').css('width', width);
                            };

                            //trigger animation
                            setTimeout(function(){ Master_Addons.MA_Animated_Headlines.hideWord( headline.find('.is-visible').eq(0) ) }, duration);
                        });
                    }


                    Master_Addons.MA_Animated_Headlines.hideWord = function($word) {

                        var nextWord = Master_Addons.MA_Animated_Headlines.takeNext($word);

                        if($word.parents('.jltma-animated-headline').hasClass('type')) {
                            var parentSpan = $word.parent('.jltma-words-wrapper');
                            parentSpan.addClass('selected').removeClass('waiting');
                            setTimeout(function(){
                                parentSpan.removeClass('selected');
                                $word.removeClass('is-visible').addClass('is-hidden').children('i').removeClass('in').addClass('out');
                            }, selectionDuration);
                            setTimeout(function(){ Master_Addons.MA_Animated_Headlines.showWord(nextWord, typeLettersDelay) }, typeAnimationDelay);

                        } else if($word.parents('.jltma-animated-headline').hasClass('letters')) {
                            var bool = ($word.children('i').length >= nextWord.children('i').length) ? true : false;
                            Master_Addons.MA_Animated_Headlines.hideLetter($word.find('i').eq(0), $word, bool, lettersDelay);
                            Master_Addons.MA_Animated_Headlines.showLetter(nextWord.find('i').eq(0), nextWord, bool, lettersDelay);

                        }  else if($word.parents('.jltma-animated-headline').hasClass('clip')) {
                            $word.parents('.jltma-words-wrapper').animate({ width : '2px' }, revealDuration, function(){
                                Master_Addons.MA_Animated_Headlines.switchWord($word, nextWord);
                                Master_Addons.MA_Animated_Headlines.showWord(nextWord);
                            });

                        } else if ($word.parents('.jltma-animated-headline').hasClass('loading-bar')){
                            $word.parents('.jltma-words-wrapper').removeClass('is-loading');
                            Master_Addons.MA_Animated_Headlines.switchWord($word, nextWord);
                            setTimeout(function(){ Master_Addons.MA_Animated_Headlines.hideWord(nextWord) }, barAnimationDelay);
                            setTimeout(function(){ $word.parents('.jltma-words-wrapper').addClass('is-loading') }, barWaiting);

                        } else {
                            Master_Addons.MA_Animated_Headlines.switchWord($word, nextWord);
                            setTimeout(function(){ Master_Addons.MA_Animated_Headlines.hideWord(nextWord) }, animationDelay);
                        }
                    }

                    Master_Addons.MA_Animated_Headlines.showWord = function($word, $duration) {
                        if($word.parents('.jltma-animated-headline').hasClass('type')) {
                            Master_Addons.MA_Animated_Headlines.showLetter($word.find('i').eq(0), $word, false, $duration);
                            $word.addClass('is-visible').removeClass('is-hidden');

                        }  else if($word.parents('.jltma-animated-headline').hasClass('clip')) {
                            $word.parents('.jltma-words-wrapper').animate({ 'width' : $word.width() + 10 }, revealDuration, function(){
                                setTimeout(function(){ Master_Addons.MA_Animated_Headlines.hideWord($word) }, revealAnimationDelay);
                            });
                        }
                    }

                    Master_Addons.MA_Animated_Headlines.hideLetter = function($letter, $word, $bool, $duration) {
                        $letter.removeClass('in').addClass('out');

                        if(!$letter.is(':last-child')) {
                            setTimeout(function(){ Master_Addons.MA_Animated_Headlines.hideLetter($letter.next(), $word, $bool, $duration); }, $duration);
                        } else if($bool) {
                            setTimeout(function(){ Master_Addons.MA_Animated_Headlines.hideWord(Master_Addons.MA_Animated_Headlines.takeNext($word)) }, animationDelay);
                        }

                        if($letter.is(':last-child') && $('html').hasClass('no-csstransitions')) {
                            var nextWord = Master_Addons.MA_Animated_Headlines.takeNext($word);
                            Master_Addons.MA_Animated_Headlines.switchWord($word, nextWord);
                        }
                    }

                    Master_Addons.MA_Animated_Headlines.showLetter = function($letter, $word, $bool, $duration) {
                        $letter.addClass('in').removeClass('out');

                        if(!$letter.is(':last-child')) {
                            setTimeout(function(){ Master_Addons.MA_Animated_Headlines.showLetter($letter.next(), $word, $bool, $duration); }, $duration);
                        } else {
                            if($word.parents('.jltma-animated-headline').hasClass('type')) { setTimeout(function(){ $word.parents('.jltma-words-wrapper').addClass('waiting'); }, 200);}
                            if(!$bool) { setTimeout(function(){ Master_Addons.MA_Animated_Headlines.hideWord($word) }, animationDelay) }
                        }
                    }

                    Master_Addons.MA_Animated_Headlines.takeNext = function($word) {
                        return (!$word.is(':last-child')) ? $word.next() : $word.parent().children().eq(0);
                    }

                    Master_Addons.MA_Animated_Headlines.takePrev = function($word) {
                        return (!$word.is(':first-child')) ? $word.prev() : $word.parent().children().last();
                    }

                    Master_Addons.MA_Animated_Headlines.switchWord = function($oldWord, $newWord) {
                        $oldWord.removeClass('is-visible').addClass('is-hidden');
                        $newWord.removeClass('is-hidden').addClass('is-visible');
                    }

                    Master_Addons.MA_Animated_Headlines.initHeadline = function() {
                        //insert <i> element for each letter of a changing word
                        Master_Addons.MA_Animated_Headlines.singleLetters($('.jltma-animated-headline.letters').find('b'));
                        //initialise headline animation
                        Master_Addons.MA_Animated_Headlines.animateHeadline($('.jltma-animated-headline'));
                    }

                    Master_Addons.MA_Animated_Headlines.initHeadline();

                })(jQuery);
            } catch (e) {
                //We can also throw from try block and catch it here
                // No Error Show
            }

        },

        // Master Addons: Accordion
        MA_Accordion: function ($scope, $) {

            var elementSettings   = getElementSettings( $scope ),
                $accordionHeader  = $scope.find(".jltma-accordion-header"),
                $accordionType    = elementSettings.accordion_type,
                $accordionSpeed   = elementSettings.toggle_speed ? elementSettings.toggle_speed : 300;

            // Open default actived tab
            $accordionHeader.each(function () {
                if ($(this).hasClass("active-default")) {
                    $(this).addClass("show active");
                    $(this).next().slideDown($accordionSpeed);
                }
            });

            // Remove multiple click event for nested accordion
            $accordionHeader.unbind("click");

            $accordionHeader.click(function (e) {
                e.preventDefault();
                var $this = $(this);
                if ($accordionType === "accordion") {
                    if ($this.hasClass("show")) {
                        $this.removeClass("show active");
                        $this.next().slideUp($accordionSpeed);
                    } else {
                        $this.parent().parent().find(".jltma-accordion-header").removeClass("show active");
                        $this.parent().parent().find(".jltma-accordion-tab-content").slideUp($accordionSpeed);
                        $this.toggleClass("show active");
                        $this.next().slideDown($accordionSpeed);
                    }
                } else {
                    // Toggle type Accordion
                    if ($this.hasClass("show")) {
                        $this.next().slideUp($accordionSpeed);
                    } else {
                        $this.addClass("show active");
                        $this.next().slideDown($accordionSpeed);
                    }
                }
            });

        },



        // Master Addons: Tabs

        MA_Tabs: function ($scope, $) {

            try {
                (function ($) {

                    var $tabsWrapper    = $scope.find('[data-tabs]'),
                        $tabEffect      = $tabsWrapper.data('tab-effect');


                    $tabsWrapper.each( function() {
                        var tab = $(this);
                        var isTabActive = false;
                        var isContentActive = false;

                        tab.find('[data-tab]').each(function () {
                            if ($(this).hasClass('active')) {
                                isTabActive = true;
                            }
                        });
                        tab.find('.jltma--advance-tab-content').each(function () {
                            if ($(this).hasClass('active')) {
                                isContentActive = true;
                            }
                        });
                        if (!isContentActive) {
                            tab.find('.jltma--advance-tab-content').eq(0).addClass('active');
                        }

                        if( $tabEffect == "hover"){
                            tab.find('[data-tab]').hover(function() {
                                var $data_tab_id = $(this).data('tab-id');
                                $(this).siblings().removeClass('active');
                                $(this).addClass('active');
                                $(this).closest('[data-tabs]').find('.jltma--advance-tab-content').removeClass('active');
                                $('#' + $data_tab_id).addClass('active');
                            });
                        } else{
                            tab.find('[data-tab]').click(function() {
                                var $data_tab_id = $(this).data('tab-id');
                                $(this).siblings().removeClass('active');
                                $(this).addClass('active');
                                $(this).closest('[data-tabs]').find('.jltma--advance-tab-content').removeClass('active');
                                $('#' + $data_tab_id).addClass('active');
                            });
                        }
                    });

                })(jQuery);
            } catch (e) {
                //We can also throw from try block and catch it here
                // No Error Show
            }


        },


        //Master Addons: Progressbar
        MA_ProgressBar: function ($scope, $) {
            var id                  = $scope.data('id'),
                $progressBarWrapper = $scope.find('.jltma-progress-bar-' + id),
                type                = $progressBarWrapper.data('type'),
                value               = $progressBarWrapper.data('progress-bar-value'),
                strokeWidth         = $progressBarWrapper.data('progress-bar-stroke-width'),
                strokeTrailWidth    = $progressBarWrapper.data('progress-bar-stroke-trail-width'),
                color               = $progressBarWrapper.data('stroke-color'),
                trailColor          = $progressBarWrapper.data('stroke-trail-color');
            Master_Addons.animatedProgressbar(id, type, value, color, trailColor, strokeWidth, strokeTrailWidth);
        },

        //Master Addons: Image Hotspot
        MA_Image_Hotspot: function ($scope, $) {

            var elementSettings      = getElementSettings( $scope ),
                $ma_hotspot          = $scope.find( '.jltma-hotspots-container' );

            if ( ! $ma_hotspot.length ) {
                return;
            }

            var $tooltip = $ma_hotspot.find('> .jltma-tooltip-item'),
                widgetID = $scope.data('id');

            $tooltip.each( function( index ) {
                tippy( this, {
                    allowHTML: true,
                    theme    : 'jltma-tippy-' + widgetID
                });
            });
        },


        //Master Addons: Pricing Table
        MA_Pricing_Table: function ($scope, $) {

            var $jltma_pricing_table               = $scope.find( '.jltma-price-table-details ul' );

            if ( ! $jltma_pricing_table.length ) {
                return;
            }

            var $tooltip = $jltma_pricing_table.find('> .jltma-tooltip-item'),
                widgetID = $scope.data('id');

            $tooltip.each( function( index ) {
                tippy( this, {
                    allowHTML: true,
                    theme    : 'jltma-pricing-table-tippy-' + widgetID
                });
            });
        },


        

        // Dynamic Data Tables
        JLTMA_Data_Table: function ($scope, $) {
            console.log('jashljkfahsdljkf');
            console.log('jltma_data_table_vars',jltma_data_table_vars);
            console.log('a',a );

            var a = $scope.find(".jltma-data-table-container"),
                n = a.data("source"),
                r = a.data("sourcecsv");
            if (1 == a.data("buttons")) var l = "Bfrtip";
            else l = "frtip";
            if ("custom" == n) {
                var i = $scope.find("table thead tr th").length;
                $scope.find("table tbody tr").each(function() {
                    if (e(this).find("td").length < i) {
                        var t = i - e(this).find("td").length;
                        e(this).append(new Array(++t).join("<td></td>"))
                    }
                }), $scope.find(".jltma-data-table").DataTable({
                    dom: l,
                    paging: a.data("paging"),
                    pagingType: "numbers",
                    pageLength: a.data("pagelength"),
                    info: a.data("info"),
                    scrollX: !0,
                    searching: a.data("searching"),
                    ordering: a.data("ordering"),
                    buttons: [{
                        extend: "csvHtml5",
                        text: jltma_data_table_vars.csvHtml5
                    }, {
                        extend: "excelHtml5",
                        text: jltma_data_table_vars.excelHtml5
                    }, {
                        extend: "pdfHtml5",
                        text: jltma_data_table_vars.pdfHtml5
                    }, {
                        extend: "print",
                        text: jltma_data_table_vars.print
                    }],
                    language: {
                        lengthMenu: jltma_data_table_vars.lengthMenu,
                        zeroRecords: jltma_data_table_vars.zeroRecords,
                        info: jltma_data_table_vars.info,
                        infoEmpty: jltma_data_table_vars.infoEmpty,
                        infoFiltered: jltma_data_table_vars.infoFiltered,
                        search: "",
                        searchPlaceholder: jltma_data_table_vars.searchPlaceholder,
                        processing: jltma_data_table_vars.processing
                    }
                })
            } else if ("csv" == n) {
                ({
                    init: function(t) {
                        var a = (t = t || {}).csv_path || "",
                            n = $scope.element || $("#table-container"),
                            r = $scope.csv_options || {},
                            l = $scope.datatables_options || {},
                            i = $scope.custom_formatting || [],
                            s = {};
                        $.each(i, function(e, t) {
                            var a = t[0],
                                n = t[1];
                            s[a] = n
                        });
                        var d = $('<table class="jltma-data-table cell-border" style="width:100%;visibility:hidden;">');
                        n.empty().append(d), $.when($.get(a)).then(function(t) {
                            for (var a = e.csv.toArrays(t, r), n = $("<thead></thead>"), i = a[0], o = $("<tr></tr>"), c = 0; c < i.length; c++) o.append($("<th></th>").text(i[c]));
                            n.append(o), d.append(n);
                            for (var m = $("<tbody></tbody>"), p = 1; p < a.length; p++)
                                for (var _ = $("<tr></tr>"), g = 0; g < a[p].length; g++) {
                                    var b = $("<td></td>"),
                                        f = s[g];
                                    f ? b.html(f(a[p][g])) : b.text(a[p][g]), _.append(b), m.append(_)
                                }
                            d.append(m), d.DataTable(l)
                        })
                    }
                }).init({
                    csv_path: r,
                    element: a,
                    datatables_options: {
                        dom: l,
                        paging: a.data("paging"),
                        pagingType: "numbers",
                        pageLength: a.data("pagelength"),
                        info: a.data("info"),
                        scrollX: !0,
                        searching: a.data("searching"),
                        ordering: a.data("ordering"),
                        buttons: [{
                            extend: "csvHtml5",
                            text: jltma_data_table_vars.csvHtml5
                        }, {
                            extend: "excelHtml5",
                            text: jltma_data_table_vars.excelHtml5
                        }, {
                            extend: "pdfHtml5",
                            text: jltma_data_table_vars.pdfHtml5
                        }, {
                            extend: "print",
                            text: jltma_data_table_vars.print
                        }],
                        language: {
                            lengthMenu: jltma_data_table_vars.lengthMenu,
                            zeroRecords: jltma_data_table_vars.zeroRecords,
                            info: jltma_data_table_vars.info,
                            infoEmpty: jltma_data_table_vars.infoEmpty,
                            infoFiltered: jltma_data_table_vars.infoFiltered,
                            search: "",
                            searchPlaceholder: jltma_data_table_vars.searchPlaceholder,
                            processing: jltma_data_table_vars.processing
                        }
                    }
                })
            }
            $scope.find(".jltma-data-table").css("visibility", "visible");
        },

        // Dropdown Button
        JLTMA_Dropdown_Button: function ($scope, $) {
            console.log('sdfds');

            $scope.find(".jltma-dropdown").hover(
                function () {
                    $scope.find(".jltma-dd-menu").addClass("jltma-dd-menu-opened");
                },
                function () {
                    $scope.find(".jltma-dd-menu").removeClass("jltma-dd-menu-opened");
                }
            );
        },

        JLTMA_WC_Add_To_Cart: function ($scope, $) {
            $( document ).on( 'click', '.ajax_add_to_cart', function(e) {
                $( this ).append('<i class="fa fa-spinner animated rotateIn infinite"></i>');
            });

            $(".jltma-wc-add-to-cart-btn-custom-js").each(function( index ) {
                var custom_css = $(this).attr("data-jltma-wc-add-to-cart-btn-custom-css");
                $( custom_css ).appendTo( "head" );
            });
        },

        /* Offcanvas Menu */
        MA_Offcanvas_Menu: function ($scope, $) {
            Master_Addons.MA_Offcanvas_Menu.elementSettings = $scope.data('settings');

            var widgetSelector     = 'jltma-offcanvas-menu',
                getID              = $scope.data('id'),
                getElementSettings = $scope.data('settings'),
                is_esc_close       = getElementSettings.esc_close ? getElementSettings.esc_close : '',
                classes = {
                    widget                   : widgetSelector,
                    triggerButton            : 'jltma-offcanvas__trigger',
                    offcanvasContent         : 'jltma-offcanvas__content',
                    offcanvasContentBody     : "".concat(widgetSelector, "__body"),
                    offcanvasContainer       : "".concat(widgetSelector, "__container"),
                    offcanvasContainerOverlay: "".concat(widgetSelector, "__container__overlay"),
                    offcanvasWrapper         : "".concat(widgetSelector, "__wrapper"),
                    closeButton              : "".concat(widgetSelector, "__close"),
                    menuArrow                : "".concat(widgetSelector, "__arrow"),
                    menuInner                : "".concat(widgetSelector, "__menu-inner"),
                    itemHasChildrenLink      : 'menu-item-has-children > a',
                    contentClassPart         : 'jltma-offcanvas-content',
                    contentOpenClass         : 'jltma-offcanvas-content-open',
                    customContainer          : "".concat(widgetSelector, "__custom-container")
                },
                selectors = {
                    widget                   : ".".concat(classes.widget),
                    triggerButton            : ".".concat(classes.triggerButton),
                    offcanvasContent         : ".".concat(classes.offcanvasContent),
                    offcanvasContentBody     : ".".concat(classes.offcanvasContentBody),
                    offcanvasContainer       : ".".concat(classes.offcanvasContainer),
                    offcanvasContainerOverlay: ".".concat(classes.offcanvasContainerOverlay),
                    offcanvasWrapper         : ".".concat(classes.offcanvasWrapper),
                    closeButton              : ".".concat(classes.closeButton),
                    menuArrow                : ".".concat(classes.menuArrow),
                    menuParent               : ".".concat(classes.menuInner, " .").concat(classes.itemHasChildrenLink),
                    contentClassPart         : ".".concat(classes.contentClassPart),
                    contentOpenClass         : ".".concat(classes.contentOpenClass),
                    customContainer          : ".".concat(classes.customContainer)
                },
                elements = {
                    $document            : jQuery(document),
                    $html                : jQuery(document).find('html'),
                    $body                : jQuery(document).find('body'),
                    $outsideContainer    : jQuery(selectors.offcanvasContainer),
                    $containerOverlay    : jQuery(selectors.offcanvasContainerOverlay),
                    $triggerButton       : $scope.find(selectors.triggerButton),
                    $offcanvasContent    : $scope.find(selectors.offcanvasContent),
                    $offcanvasContentBody: $scope.find(selectors.offcanvasContentBody),
                    $offcanvasContainer  : $scope.find(selectors.offcanvasContainer),
                    $offcanvasWrapper    : $scope.find(selectors.offcanvasWrapper),
                    $closeButton         : $scope.find(selectors.closeButton),
                    $menuParent          : $scope.find(selectors.menuParent)
                };

            // resetCanvas
            Master_Addons.MA_Offcanvas_Menu.resetCanvas = function() {
                var contentId = getID;
                elements.$html.addClass("".concat(classes.offcanvasContent, "-widget"));

                if (!elements.$outsideContainer.length) {
                    elements.$body.append("<div class=\"".concat(classes.offcanvasContainerOverlay, "\" />"));
                    elements.$body.wrapInner("<div class=\"".concat(classes.offcanvasContainer, "\" />"));
                    elements.$offcanvasContent.insertBefore(selectors.offcanvasContainer);
                }

                var $wrapperContent = elements.$offcanvasWrapper.find(selectors.offcanvasContent);

                if ($wrapperContent.length) {

                    var $containerContent = elements.$outsideContainer.find("> .".concat(classes.contentClassPart, "-").concat(contentId));

                    if ($containerContent.length) {
                    $containerContent.remove();
                    }

                    var $bodyContent = elements.$body.find("> .".concat(classes.contentClassPart, "-").concat(contentId));

                    if ($bodyContent.length) {
                    $bodyContent.remove();
                    }

                    if (elements.$html.hasClass(classes.contentOpenClass)) {
                        $wrapperContent.addClass('active');
                    }

                    elements.$body.prepend($wrapperContent);
                }
            }



            //Master_Addons.MA_Offcanvas_Menu.offcanvasClose
            Master_Addons.MA_Offcanvas_Menu.offcanvasClose = function(){
                var openId = elements.$html.data('open-id');
                var regex = new RegExp("".concat(classes.contentClassPart, "-.*"));
                var classList = elements.$html.attr('class').split(/\s+/);

                jQuery("".concat(selectors.contentClassPart, "-").concat(openId)).removeClass('active');
                elements.$triggerButton.removeClass('trigger-active');
                classList.forEach(function (className) {
                    if (!className.match(regex)) {
                    return;
                    }
                    elements.$html.removeClass(className);
                });
                elements.$html.removeData('open-id');
            }

            // containerClick
            Master_Addons.MA_Offcanvas_Menu.containerClick = function (event) {

                var openId = elements.$html.data('open-id');

                if (getID !== openId || !getElementSettings.overlay_close) {
                    return;
                }

                if (!elements.$html.hasClass(classes.contentOpenClass)) {
                    return;
                }
                Master_Addons.MA_Offcanvas_Menu.offcanvasClose();
            }

            Master_Addons.MA_Offcanvas_Menu.closeESC = function(event){

                if (27 !== event.keyCode) {
                    return;
                }
                Master_Addons.MA_Offcanvas_Menu.offcanvasClose();
                $(elements.$triggerButton).removeClass('trigger-active');
            }


            Master_Addons.MA_Offcanvas_Menu.addLoaderIcon = function() {
                jQuery(document).find('.jltma-offcanvas__content').addClass('jltma-loading');
            }
            Master_Addons.MA_Offcanvas_Menu.removeLoaderIcon = function() {
                jQuery(document).find('.jltma-offcanvas__content').removeClass('jltma-loading');
            }

            // bindEvents
            Master_Addons.MA_Offcanvas_Menu.bindEvents = function () {

                elements.$body.on('click', selectors.offcanvasContainerOverlay, Master_Addons.MA_Offcanvas_Menu.containerClick.bind(this));

                if ('yes' === is_esc_close) {
                    elements.$document.on('keydown', Master_Addons.MA_Offcanvas_Menu.closeESC.bind(this));
                }

                elements.$triggerButton.on('click', Master_Addons.MA_Offcanvas_Menu.offcanvasContent.bind(this));
                elements.$closeButton.on('click', Master_Addons.MA_Offcanvas_Menu.offcanvasClose.bind(this));
                elements.$menuParent.on('click', Master_Addons.MA_Offcanvas_Menu.onParentClick.bind(this));

                $(elements.$menuParent).on('change',function(){
                    Master_Addons.MA_Offcanvas_Menu.onParentClick.bind($(this));
                });

                $("[data-settings=animation_type]").on('click',function(){
                    Master_Addons.MA_Offcanvas_Menu.changeControl.bind($(this));
                });
            }


            //perfectScrollInit
            Master_Addons.MA_Offcanvas_Menu.perfectScrollInit = function() {
                if (!Master_Addons.MA_Offcanvas_Menu.scrollPerfect) {
                    Master_Addons.MA_Offcanvas_Menu.scrollPerfect = new PerfectScrollbar(elements.$offcanvasContentBody.get(0), {
                        wheelSpeed: 0.5,
                        suppressScrollX: true
                    });
                    return;
                }

                Master_Addons.MA_Offcanvas_Menu.scrollPerfect.update();
            }

            //onEdit
            Master_Addons.MA_Offcanvas_Menu.onEdit = function() {
                // elementorFrontend.isEditMode()
                if (!Master_Addons.MA_Offcanvas_Menu.isEdit) {
                    return;
                }

                if (undefined === $element.data('opened')) {
                    $element.data('opened', 'false');
                }

                elementor.channels.editor.on('section:activated', Master_Addons.MA_Offcanvas_Menu.sectionActivated.bind(this));
            }


            //sectionActivated
            Master_Addons.MA_Offcanvas_Menu.sectionActivated = function(sectionName, editor) {
                var elementsData = elementorFrontend.config.elements.data[this.getModelCID()];
                var editedElement = editor.getOption('editedElementView');

                if (this.getModelCID() !== editor.model.cid || elementsData.get('widgetType') !== editedElement.model.get('widgetType')) {
                return;
                }

                if (-1 !== this.sectionsArray.indexOf(sectionName)) {
                if ('true' === $element.data('opened')) {
                    var editedModel = editor.getOption('model');
                    Master_Addons.MA_Offcanvas_Menu.offcanvasContent(null, editedModel.get('id'));
                }

                $element.data('opened', 'true');

                } else {
                    Master_Addons.MA_Offcanvas_Menu.offcanvasClose();
                }
            }

            //offcanvasContent
            Master_Addons.MA_Offcanvas_Menu.offcanvasContent = function(event) {
                var widgetId = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

                var boxPosition   = getElementSettings.canvas_position;
                var offcanvasType = getElementSettings.animation_type;
                var contentId     = getID;

                if (null !== widgetId) {
                    contentId = widgetId;
                }
                elements.$triggerButton.addClass('trigger-active');

                jQuery("".concat(selectors.contentClassPart, "-").concat(contentId)).addClass('active');
                elements.$html.addClass("".concat(classes.contentOpenClass)).addClass("".concat(classes.contentOpenClass, "-").concat(contentId)).addClass("".concat(classes.contentClassPart, "-").concat(boxPosition)).addClass("".concat(classes.contentClassPart, "-").concat(offcanvasType)).data('open-id', contentId);
            }


            //onParentClick
            Master_Addons.MA_Offcanvas_Menu.onParentClick = function(event) {
                var $clickedItem = jQuery(event.target);
                var noLinkArray = ['', '#'];
                var $menuParent = $clickedItem.hasClass(classes.menuArrow) ? $clickedItem.parent() : $clickedItem;

                if ($clickedItem.hasClass(classes.menuArrow) || -1 !== noLinkArray.indexOf($clickedItem.attr('href')) || !$menuParent.hasClass('active')) {
                event.preventDefault();
                }

                var $menuParentNext = $menuParent.next();
                $menuParent.removeClass('active');
                $menuParentNext.slideUp('normal');

                if ($menuParentNext.is('ul') && !$menuParentNext.is(':visible')) {
                    $menuParent.addClass('active');
                    $menuParentNext.slideDown('normal');
                }
            }


            //changeControl
            Master_Addons.MA_Offcanvas_Menu.changeControl = function() {
                Master_Addons.MA_Offcanvas_Menu.offcanvasClose();
            }

            // onInit
            Master_Addons.MA_Offcanvas_Menu.onInit = function() {

                Master_Addons.MA_Offcanvas_Menu.resetCanvas();

                // Master_Addons.MA_Offcanvas_Menu.perfectScrollInit();
                // Master_Addons.MA_Offcanvas_Menu.onEdit();
                Master_Addons.MA_Offcanvas_Menu.bindEvents();
            }
            // onInit

            return Master_Addons.MA_Offcanvas_Menu.onInit();
        },


        //Master Addons: Image Filter Gallery
        MA_Image_Filter_Gallery: function ($scope, $) {

            var elementSettings     = getElementSettings( $scope ),
                $jltma_image_filter_gallery_wrapper   = $scope.find('.jltma-image-filter-gallery-wrapper').eq(0),
                $ma_el_image_filter_gallery_container   = $scope.find('.jltma-image-filter-gallery'),
                $ma_el_image_filter_gallery_nav         = $scope.find('.jltma-image-filter-nav'),
                $ma_el_image_filter_gallery_wrapper     = $scope.find('.jltma-image-filter-gallery-wrapper'),
                $uniqueId 		    = getUniqueLoopScopeId( $scope ),
                $maxtilt         = elementSettings.ma_el_image_gallery_max_tilt,
                $perspective     = elementSettings.ma_el_image_gallery_perspective,
                $speed           = elementSettings.ma_el_image_gallery_speed,
                $axis            = elementSettings.ma_el_image_gallery_tilt_axis,
                $glare           = elementSettings.ma_el_image_gallery_glare,
                $overlay_speed   = elementSettings.line_location,
                $ma_el_image_gallery_tooltip   = elementSettings.ma_el_image_gallery_tooltip,
                $container       = $('.elementor-element-' + $uniqueId + ' .jltma-image-filter-gallery'),
                layoutMode       = $ma_el_image_filter_gallery_wrapper.hasClass('jltma-masonry-yes') ? 'masonry' : 'fitRows';

            if (!$jltma_image_filter_gallery_wrapper.length) {
                return;
            }

            if($ma_el_image_gallery_tooltip =="yes"){

                var $img_filter_gallery = $jltma_image_filter_gallery_wrapper.find('ul.jltma-tooltip');

                if ( ! $img_filter_gallery.length ) {
                    return;
                }

                var $tooltip = $img_filter_gallery.find('> .jltma-tooltip-item'),
                    widgetID = $scope.data('id');

                $tooltip.each( function( index ) {
                    tippy( this, {
                        allowHTML: true,
                        theme    : 'jltma-image-filter-tippy-' + widgetID
                    });
                });
            }

            //Masonry Start
            // let container_outerheight = $container.outerHeight();
            var optValues = {
                filter: '*',
                itemSelector: '.jltma-image-filter-item',
                percentPosition : true,
                animationOptions : {
                    duration    : 750,
                    easing      : 'linear',
                    queue       : false
                }
            };
            if(layoutMode === 'fitRows'){
                optValues['layoutMode'] = 'fitRows';
            }

            // if(layoutMode === 'masonry'){
            //     adata['macolumnWidthsonry'] = '.jltma-image-filter-item';
            //     adata['horizontalOrder'] = true;
            // };

            // var $grid = $container.isotope(adata);
            // $grid.imagesLoaded().progress(function() {
            //     $grid.isotope('layout');
            //     $scope.find('.jltma-image-filter-gallery').css({"min-height":"300px" ,"height" : container_outerheight});
            // });

            if ($.isFunction($.fn.imagesLoaded)) {
                $ma_el_image_filter_gallery_container.imagesLoaded(function () {
                    if ($.isFunction($.fn.isotope)) {
                        $ma_el_image_filter_gallery_container.isotope(optValues);
                    }
                });
            }
            //Masonry End


            // Tilt Effect Start
            if($axis === 'x'){
                $axis = 'y';
            }else if($axis === 'y'){
                $axis = 'x';
            }else{
                $axis = 'both';
            }

            if($glare === 'yes'){
                var $max_glare =   elementSettings.ma_el_image_gallery_max_glare;
            }

            if($glare === 'yes'){
                $glare = true;
            } else{
                $glare = false;
            }

            if($scope.find('.jltma-tilt-enable')){
                var tilt_args = {
                    maxTilt:        $maxtilt,
                    perspective:    $perspective,   // Transform perspective, the lower the more extreme the tilt gets.
                    //easing:         "cubic-bezier(.03,.98,.52,.99)",   // Easing on enter/exit.
                    easing :        "linear",
                    scale:          1,      // 2 = 200%, 1.5 = 150%, etc..
                    speed:          $speed,    // Speed of the enter/exit transition.
                    disableAxis:    $axis,
                    transition:     true,   // Set a transition on enter/exit.
                    reset:          true,   // If the tilt effect has to be reset on exit.
                    glare:          $glare,  // Enables glare effect
                    maxGlare:       $max_glare       // From 0 - 1.
                }

                $scope.find('.jltma-tilt').tilt(tilt_args);
            }
            // Tilt Effect End


            $ma_el_image_filter_gallery_nav.on('click', 'li', function () {
                $ma_el_image_filter_gallery_nav.find('.active').removeClass('active');
                $(this).addClass('active');

                if ($.isFunction($.fn.isotope)) {
                    var selector = $(this).attr('data-filter');
                    $ma_el_image_filter_gallery_container.isotope({
                        filter: selector,
                    });
                    return false;
                }
            });

            $( ".jltma-fancybox" ).fancybox({
                // protect: false,
                animationDuration: 366,
                transitionDuration: 366,
                transitionEffect: "fade", // Transition effect between slides
                animationEffect: "fade",
                preventCaptionOverlap : true,
                // loop: false,
                infobar: false,
                buttons: [
                    "zoom",
                    "share",
                    "slideShow",
                    "fullScreen",
                    "download",
                    "thumbs",
                    "close"
                ],
                afterLoad : function(instance, current) {
                    var pixelRatio = window.devicePixelRatio || 1;

                    if ( pixelRatio > 1.5 ) {
                        current.width  = current.width  / pixelRatio;
                        current.height = current.height / pixelRatio;
                    }
                }
            });

        },


		MA_Carousel : function( $swiper, settings ) {
			var $slides = $swiper.find( '.jltma-swiper__slide' ),

				elementorBreakpoints = elementorFrontend.config.breakpoints,

				swiperInstance 	= $swiper.data( 'swiper' ),
				swiperArgs 		= {
					autoHeight				: settings.element.autoHeight || false,
					direction 				: settings.element.direction || settings.default.direction,
					effect 					: settings.element.effect || settings.default.effect,
					slidesPerView 			: settings.default.slidesPerView,
					slidesPerColumn 		: settings.default.slidesPerColumn,
					slidesPerColumnFill 	: 'row',
					slidesPerGroup			: settings.default.slidesPerGroup,
					spaceBetween 			: settings.default.spaceBetween,
					pagination 				: {},
					navigation 				: {},
					autoplay 				: settings.element.autoplay || false,
					grabCursor 				: true,
					watchSlidesProgress 	: true,
					watchSlidesVisibility 	: true,
				};

				if ( settings.default.breakpoints ) {
					swiperArgs.breakpoints = {};
					swiperArgs.breakpoints[ elementorBreakpoints.md ] = settings.default.breakpoints.tablet;
					swiperArgs.breakpoints[ elementorBreakpoints.lg ] = settings.default.breakpoints.desktop;
				}

				if ( ! elementorFrontend.isEditMode() ) {
					// Observer messes with free mode
					if ( ! settings.element.freeMode ) {
						swiperArgs.observer 			= true;
						swiperArgs.observeParents		= true;
						swiperArgs.observeSlideChildren = true;
					}
				} else { // But we're safe in edit mode
					swiperArgs.observer 			= true;
					swiperArgs.observeParents		= true;
					swiperArgs.observeSlideChildren = true;
				}

			Master_Addons.MA_Carousel.init = function() {
				if ( swiperInstance ) {
					Master_Addons.MA_Carousel.destroy();
					return;
				}

				// Number of columns
				if ( swiperArgs.breakpoints ) {
					if ( settings.element.breakpoints.desktop.slidesPerView ) {
						swiperArgs.breakpoints[ elementorBreakpoints.lg ].slidesPerView = Math.min( $slides.length, +settings.element.breakpoints.desktop.slidesPerView || 3 );
					}

					if ( settings.element.breakpoints.tablet.slidesPerView ) {
						swiperArgs.breakpoints[ elementorBreakpoints.md ].slidesPerView = Math.min( $slides.length, +settings.element.breakpoints.tablet.slidesPerView || 2 );
					}
				}

				if ( settings.element.slidesPerView ) {
					swiperArgs.slidesPerView = Math.min( $slides.length, +settings.element.slidesPerView || 1 );
				}

				// Number of slides to scroll
				if ( swiperArgs.breakpoints ) {
					if ( settings.element.breakpoints.desktop.slidesPerGroup ) {
						swiperArgs.breakpoints[ elementorBreakpoints.lg ].slidesPerGroup = Math.min( $slides.length, +settings.element.breakpoints.desktop.slidesPerGroup || 3 );
					}

					if ( settings.element.breakpoints.tablet.slidesPerGroup ) {
						swiperArgs.breakpoints[ elementorBreakpoints.md ].slidesPerGroup = Math.min( $slides.length, +settings.element.breakpoints.tablet.slidesPerGroup || 2 );
					}
				}

				if ( settings.element.slidesPerGroup ) {
					swiperArgs.slidesPerGroup = Math.min( $slides.length, +settings.element.slidesPerGroup || 1 );
				}

				// Rows
				if ( swiperArgs.breakpoints ) {
					if ( settings.element.breakpoints.desktop.slidesPerColumn ) {
						swiperArgs.breakpoints[ elementorBreakpoints.lg ].slidesPerColumn = settings.element.breakpoints.desktop.slidesPerColumn;
					}

					if ( settings.element.breakpoints.tablet.slidesPerColumn ) {
						swiperArgs.breakpoints[ elementorBreakpoints.md ].slidesPerColumn = settings.element.breakpoints.tablet.slidesPerColumn;
					}
				}

				if ( settings.element.slidesPerColumn ) {
					swiperArgs.slidesPerColumn = settings.element.slidesPerColumn;
				}

				// Column spacing

				if ( swiperArgs.breakpoints ) {
					swiperArgs.breakpoints[ elementorBreakpoints.lg ].spaceBetween = settings.element.breakpoints.desktop.spaceBetween || 0;
					swiperArgs.breakpoints[ elementorBreakpoints.md ].spaceBetween = settings.element.breakpoints.tablet.spaceBetween || 0;
				}

				if ( settings.element.spaceBetween ) {
					swiperArgs.spaceBetween = settings.element.spaceBetween || 0;
				}

				if ( settings.element.slidesPerColumnFill ) {
					swiperArgs.slidesPerColumnFill = settings.element.slidesPerColumnFill;
				}

				// Arrows and pagination
				if ( settings.element.arrows ) {
					swiperArgs.navigation.disabledClass = 'jltma-swiper__button--disabled';

					var $prevButton = settings.scope.find( settings.element.arrowPrev ),
						$nextButton = settings.scope.find( settings.element.arrowNext );

					if ( $prevButton.length && $nextButton.length ) {

						var arrowPrev = settings.element.arrowPrev + '-' + settings.id,
							arrowNext = settings.element.arrowNext + '-' + settings.id;

						$prevButton.addClass( arrowPrev.replace('.','') );
						$nextButton.addClass( arrowNext.replace('.','') );

						swiperArgs.navigation.prevEl = arrowPrev;
						swiperArgs.navigation.nextEl = arrowNext;
					}
				}

				if ( settings.element.pagination ) {
					swiperArgs.pagination.el = '.jltma-swiper__pagination-' + settings.id;
					swiperArgs.pagination.type = settings.element.paginationType;

					if ( settings.element.paginationClickable ) {
						swiperArgs.pagination.clickable = true;
					}
				}

				// Loop
				if ( settings.element.loop ) {
					swiperArgs.loop = true;
					// swiperArgs.loopedSlides = $slides.length;
				}

				// Autplay
				if ( swiperArgs.autoplay && ( settings.element.autoplaySpeed || settings.element.disableOnInteraction ) ) {
					swiperArgs.autoplay = {};

					if ( settings.element.autoplaySpeed ) {
						swiperArgs.autoplay.delay = settings.element.autoplaySpeed;
					}

					if ( settings.element.autoplaySpeed ) {
						swiperArgs.autoplay.disableOnInteraction = settings.element.disableOnInteraction;
					}
				} else {

				}

				// Speed
				if ( settings.element.speed ) {
					swiperArgs.speed = settings.element.speed;
				}

				// Resistance
				if ( settings.element.resistance ) {
					swiperArgs.resistanceRatio = 1 - settings.element.resistance;
				}

				// Free Mode
				if ( settings.element.freeMode ) {
					swiperArgs.freeMode = true;
					swiperArgs.freeModeSticky = settings.element.freeModeSticky;
					swiperArgs.freeModeMomentum = settings.element.freeModeMomentum;
					swiperArgs.freeModeMomentumBounce = settings.element.freeModeMomentumBounce;

					if ( settings.element.freeModeMomentumRatio ) {
						swiperArgs.freeModeMomentumRatio = settings.element.freeModeMomentumRatio;
					}

					if ( settings.element.freeModeMomentumVelocityRatio ) {
						swiperArgs.freeModeMomentumVelocityRatio = settings.element.freeModeMomentumVelocityRatio;
					}

					if ( settings.element.freeModeMomentumBounceRatio ) {
						swiperArgs.freeModeMomentumBounceRatio = settings.element.freeModeMomentumBounceRatio;
					}
				}

				// Conditional asset loading of the Swiper library with backwards compatibility
				// since Elementor 3.1
				// @link https://developers.elementor.com/experiment-optimized-asset-loading/
                var swiper;
				if ( 'undefined' === typeof Swiper ) {
					const asyncSwiper = elementorFrontend.utils.swiper;

					new asyncSwiper( $swiper, swiperArgs ).then( function( newSwiperInstance ) {
						swiper = newSwiperInstance;
					} );
				} else {
					swiper = new Swiper( $swiper, swiperArgs );
				}

				if ( settings.element.stopOnHover ) {
					$swiper.on( 'mouseover', function() {
						swiper.autoplay.stop();
					});

					$swiper.on( 'mouseout', function() {
						swiper.autoplay.start();
					});
				}

				if ( settings.element.slideChangeTriggerResize ) {
					swiper.on('slideChange', function () {
						$( window ).trigger('resize');
					});
				}

				$swiper.data( 'swiper', swiper );

				return swiper;
			};

			return Master_Addons.MA_Carousel.init();
		},

        // Gallery Slider
        MA_Gallery_Slider: function($scope, $){

            var elementSettings     = getElementSettings( $scope ),
                $swiperSlider 	    = $scope.find('.jltma-gallery-slider__slider'),
                $swiperCarousel     = $scope.find('.jltma-gallery-slider__carousel'),
                uniqueId 		    = getUniqueLoopScopeId( $scope ),
                scopeId 		    = $scope.data('id'),
                $preview            = $scope.find('.jltma-gallery-slider__preview'),
                $thumbs             = $scope.find('.jltma-swiper__wrapper .jltma-gallery__item'),
                $thumbnailsSlider   = $scope.find(".jltma-gallery-slider__gallery .jltma-gallery"),
                $thumbtype          = elementSettings.jltma_gallery_slider_thumb_type,
                $thumbposition      = elementSettings.jltma_gallery_slider_preview_position,
                $thumbVertical      = ( $thumbposition == "top" || $thumbposition == "bottom" ) ? false : true,

                start               = elementorFrontend.config.is_rtl ? 'right' : 'left',
                end                 = elementorFrontend.config.is_rtl ? 'left' : 'right',
                hasCarousel         = $swiperCarousel.length,

                swiperSlider        = null,
                swiperCarousel      = null,

                sliderSettings       = {
					key 		    : 'slider',
                    scope 		    : $scope,
                    id 			    : uniqueId,
					element : {
						autoHeight 				: 'yes' === elementSettings.jltma_gallery_slider_adaptive_height ? true : false,
						autoplay 				: 'yes' === elementSettings.jltma_gallery_slider_autoplay ? true : false,
						autoplaySpeed 			: 'yes' === elementSettings.jltma_gallery_slider_autoplay && elementSettings.jltma_gallery_slider_autoplay_speed ? elementSettings.jltma_gallery_slider_autoplay_speed.size : false,
						disableOnInteraction 	: '' !== elementSettings.autoplay_disable_on_interaction,
						stopOnHover 			: 'yes' === elementSettings.jltma_gallery_slider_pause_on_hover,
						loop 					: 'yes' === elementSettings.jltma_gallery_slider_infinite,
						arrows 					: '' !== elementSettings.jltma_gallery_slider_show_arrows,
                        arrowPrev 				: '.jltma-arrow--prev',
                        arrowNext 				: '.jltma-arrow--next',
						effect 					: elementSettings.jltma_gallery_slider_effect,
						speed 					: elementSettings.speed ? elementSettings.speed.size : 500,
                        resistance 				: elementSettings.resistance ? elementSettings.resistance.size : 0.25,
                        keyboard: {
                                // enabled: "yes" === slider_data.jltma_slider_keyboard ? true : false
                                enabled: true
                        },
					},
					default : {
						effect 			: 'slide',
						direction 		: 'horizontal',
						slidesPerView 	: 1,
						slidesPerGroup 	: 1,
						slidesPerColumn : 1,
						spaceBetween 	: 0,
                    }
                };

                // If Carousel
                if ( hasCarousel ) {
				    var carouselSettings = {
						key 		: 'carousel',
						scope 		: $scope,
						id 			: uniqueId,
						element : {
							direction 			: elementSettings.carousel_orientation,
							arrows 				: '' !== elementSettings.jltma_gallery_slider_thumb_show_arrows,
							arrowPrev 			: '.jltma-arrow--prev',
							arrowNext 			: '.jltma-arrow--next',
                            autoHeight 			: false,
                            loop                : 'yes' === elementSettings.jltma_gallery_slider_thumb_infinite ? true : false,
                            autoplay 			: 'yes' === elementSettings.jltma_gallery_slider_thumb_autoplay ? true : false,
                            autoplaySpeed 		: 'yes' === elementSettings.jltma_gallery_slider_thumb_autoplay && elementSettings.jltma_gallery_slider_thumb_autoplay_speed ? elementSettings.jltma_gallery_slider_thumb_autoplay_speed.size : false,
                            stopOnHover 		: 'yes' === elementSettings.jltma_gallery_slider_thumb_pause_on_hover,
							speed 				: elementSettings.jltma_gallery_slider_thumb_speed ? elementSettings.jltma_gallery_slider_thumb_speed.size : 500,
							slidesPerView 		: elementSettings.jltma_gallery_slider_thumb_items_mobile,
							slidesPerColumn 	: 'vertical' === elementSettings.carousel_orientation ? 1 : elementSettings.carousel_slides_per_column_mobile,
							slidesPerGroup 		: elementSettings.carousel_slides_to_scroll_mobile,
							resistance 			: elementSettings.carousel_resistance ? elementSettings.carousel_resistance.size : 0.15,
							spaceBetween 		: elementSettings.carousel_spacing_mobile ? elementSettings.carousel_spacing_mobile.size : 0,
							breakpoints 		: {
								tablet : {
									slidesPerView 	: elementSettings.jltma_gallery_slider_thumb_items_tablet,
									slidesPerColumn : 'vertical' === elementSettings.carousel_orientation ? 1 : elementSettings.carousel_slides_per_column_tablet,
									slidesPerGroup 	: elementSettings.carousel_slides_to_scroll_tablet,
									spaceBetween 	: elementSettings.carousel_spacing_tablet ? elementSettings.carousel_spacing_tablet.size : 0,
								},
								desktop : {
									slidesPerView 	: elementSettings.jltma_gallery_slider_thumb_items,
									slidesPerColumn : 'vertical' === elementSettings.carousel_orientation ? 1 : elementSettings.carousel_slides_per_column,
									slidesPerGroup 	: elementSettings.carousel_slides_to_scroll,
									spaceBetween 	: elementSettings.carousel_spacing ? elementSettings.carousel_spacing.size : 0,
								},
							},
						},
						default : {
							effect 			: 'slide',
							slidesPerView 	: 1,
							slidesPerGroup 	: 1,
							slidesPerColumn : 1,
							spaceBetween 	: 6,
							breakpoints 	: {
								tablet : {
									slidesPerView 	: 2,
									slidesPerGroup 	: 1,
									slidesPerColumn : 2,
									spaceBetween 	: 12,
								},
								desktop : {
									slidesPerView 	: 3,
									slidesPerGroup 	: 1,
									slidesPerColumn : 3,
									spaceBetween 	: 24,
								},
							},
						},
					};
                }


            Master_Addons.MA_Gallery_Slider.init = function() {

                swiperSlider = Master_Addons.MA_Carousel( $swiperSlider, sliderSettings );

				if ( hasCarousel ) {
                    swiperCarousel = Master_Addons.MA_Carousel( $swiperCarousel, carouselSettings );
				}

				Master_Addons.MA_Gallery_Slider.onSlideChange();
				Master_Addons.MA_Gallery_Slider.events();

            };

            Master_Addons.MA_Gallery_Slider.events = function() {
                swiperSlider.on('slideChange', Master_Addons.MA_Gallery_Slider.onSlideChange );
                $thumbs.on( 'click', Master_Addons.MA_Gallery_Slider.onThumbClicked );
            };

			Master_Addons.MA_Gallery_Slider.onSlideChange = function() {
				var activeIndex = sliderSettings.element.loop ? swiperSlider.realIndex : swiperSlider.activeIndex;

				if ( hasCarousel ) {
					swiperCarousel.slideTo( activeIndex );
				}

				$thumbs.removeClass('is--active');
				$thumbs.eq( activeIndex ).addClass('is--active');
            };

			Master_Addons.MA_Gallery_Slider.onThumbClicked = function( event ) {
                var offset = sliderSettings.element.loop ? 1 : 0;

				event.preventDefault();
				swiperSlider.slideTo( $(this).index() + offset );
            };

			Master_Addons.onElementRemove( $scope, function() {
				$scope.find('.swiper-container').each( function() {
					if ( $(this).data('swiper') ) {
						$(this).data('swiper').destroy();
					}
				});
            });


            Master_Addons.MA_Gallery_Slider.init();
        },

        // On Remove Event
        onElementRemove: function( $element, callback ) {
            if ( elementorFrontend.isEditMode() ) {
                // Make sure it is destroyed when element is removed in editor mode
                elementor.channels.data.on( 'element:before:remove', function ( model ) {
                    if ( $element.data('id') === model.id ) {
                        callback();
                    }
                });
            }
        },

        //Master Addons: Timeline
        MA_Timeline: function ($scope, $) {

			var elementSettings  = getElementSettings( $scope ),
			    $timeline        = $scope.find('.jltma-timeline'),
			    $swiperSlider    = $scope.find('.jltma-timeline-slider'),
			    $timeline_type   = elementSettings.ma_el_timeline_type,
			    $timeline_layout = elementSettings.ma_el_timeline_design_type,
			    swiperSlider     = null,
			    timelineArgs     = {},
			    hasCarousel      = $swiperSlider.length,
			    $uniqueId        = getUniqueLoopScopeId( $scope );

            if($timeline_layout === 'horizontal'){

                var $carousel = $scope.find('.jltma-timeline-carousel-slider');

                if (!$carousel.length) {
                    return;
                }

                var $carouselContainer = $scope.find('.swiper-container'),
                    $settings          = $carousel.data('settings'),
                    Swiper = elementorFrontend.utils.swiper;

                initSwiper();

                async function initSwiper() {
                    var swiper = await new Swiper($carouselContainer, $settings);
                    if ($settings.pauseOnHover) {
                        $($carouselContainer).hover(function() {
                            (this).swiper.autoplay.stop();
                        }, function() {
                            (this).swiper.autoplay.start();
                        });
                    }
                };
            }


            if($timeline_layout === 'vertical' || $timeline_type === "post"){
                var $timeline = $scope.find('.jltma-timeline'),
                    timelineArgs = {};

                Master_Addons.MA_Timeline.init = function() {
                    if ( elementorFrontend.isEditMode() ) {
                        timelineArgs.scope = window.elementor.$previewContents;
                    }

                    if ( 'undefined' !== typeof elementSettings.line_location && elementSettings.line_location.size ) {
                        timelineArgs.lineLocation = elementSettings.line_location.size;
                    }
                    $timeline.maTimeline( timelineArgs );
                };
                Master_Addons.MA_Timeline.init();
            }

        },


        //Master Addons: News Ticker
        MA_NewsTicker: function ($scope, $) {

            try {
                (function ($) {
                    $(window).load(function (e) {

                        var newsTickerWrapper = $scope.find(".jltma-news-ticker"),
                            tickerType = newsTickerWrapper.data('tickertype'),
                            tickerid = newsTickerWrapper.data('tickerid'),
                            feedUrl = newsTickerWrapper.data('feedurl'),
                            feedAnimation = newsTickerWrapper.data('feedanimation'),
                            limitPosts = newsTickerWrapper.data('limitposts'),
                            tickerStyleEffect = newsTickerWrapper.data('scroll'),
                            autoplay = newsTickerWrapper.data('autoplay'),
                            timer = newsTickerWrapper.data('timer');

                        if (tickerType === "content") {

                            $("#" + tickerid + "").breakingNews({
                                effect: "" + tickerStyleEffect + "",
                                autoplay: autoplay,
                                timer: timer,
                                border: false,
                                feed: false,
                                feedlabels: false
                            });
                        }

                        if (tickerType === "feed") {

                            jQuery(function ($) {

                                var feed_container = $("#" + tickerid + ' .jltma-ticker-content-inner');

                                $(feed_container).rss(feedUrl,
                                    {
                                        // how many entries do you want?
                                        // default: 4
                                        // valid values: any integer
                                        limit: limitPosts,

                                        // want to offset results being displayed?
                                        // default: false
                                        // valid values: any integer
                                        offsetStart: false, // offset start point
                                        offsetEnd: false, // offset end point

                                        // will request the API via https
                                        // default: false
                                        // valid values: false, true
                                        ssl: true,


                                        // which server should be requested for feed parsing
                                        // the server implementation is here: https://github.com/sdepold/feedr
                                        // default: feedrapp.info
                                        // valid values: any string
                                        // host: 'my-own-feedr-instance.com',


                                        // option to seldomly render ads
                                        // ads help covering the costs for the feedrapp server hosting and future improvements
                                        // default: true
                                        // valid values: false, true
                                        support: false,


                                        // formats the date with moment.js (optional)
                                        // default: 'dddd MMM Do'
                                        // valid values: see http://momentjs.com/docs/#/displaying/
                                        dateFormat: 'MMMM Do, YYYY',


                                        // localizes the date with moment.js (optional)
                                        // default: 'en'
                                        dateLocale: 'de',


                                        // outer template for the html transformation
                                        // default: "<ul>{entries}</ul>"
                                        // valid values: any string


                                        layoutTemplate: '<ul class="jltma-ticker-content-items">{entries}</ul>',

                                        // inner template for each entry
                                        // default: '<li><a href="{url}">[{author}@{date}] {title}</a><br/>{shortBodyPlain}</li>'
                                        // valid values: any string
                                        // entryTemplate: '<p>{title}</p>',
                                        // entryTemplate: '<li><a href="{url}">[{author}@{date}] {title}</a>{teaserImage}{shortBodyPlain}</li>'
                                        entryTemplate: '<li> {teaserImage} <a href="{url}"> {title}</a></li>',

                                        // the effect, which is used to let the entries appear
                                        // default: 'show'
                                        // valid values: 'show', 'slide', 'slideFast', 'slideSynced', 'slideFastSynced'
                                        effect: feedAnimation,

                                    }, function () {

                                        $("#" + tickerid + "").breakingNews({
                                            effect: "" + tickerStyleEffect + "",
                                            autoplay: autoplay,
                                            timer: timer
                                        });
                                    })
                            });

                        }

                    }); // End of Window load

                })(jQuery);
            } catch (e) {
                //We can also throw from try block and catch it here
                // No Error Show
            }


        },


        /*
         * Master Addons: MA Blog Posts
         */

        MA_Blog: function ($scope, $) {
            var elementSettings     = getElementSettings( $scope ),
                uniqueId 		    = getUniqueLoopScopeId( $scope ),
                scopeId 		    = $scope.data('id'),
                $swiper 	        = $scope.find('.jltma-swiper__container'),
                $thumbs 	        = $scope.find('.jltma-grid__item'),
                blogElement         = $scope.find(".jltma-blog-wrapper"),
                colsNumber          = blogElement.data("col"),
                carousel            = blogElement.data("carousel"),
                grid                = blogElement.data("grid");

            $scope.find(".jltma-blog-cats-container li a").click(function (e) {
                e.preventDefault();

                $scope
                    .find(".jltma-blog-cats-container li .active")
                    .removeClass("active");

                $(this).addClass("active");

                var selector = $(this).attr("data-filter");

                blogElement.isotope({ filter: selector });

                return false;
            });

            var masonryBlog = blogElement.hasClass("jltma-blog-masonry");

            if (masonryBlog && !carousel) {
                blogElement.imagesLoaded(function () {
                    blogElement.isotope({
                        itemSelector: ".jltma-post-outer-container",
                        percentPosition: true,
                        animationOptions: {
                            duration: 750,
                            easing: "linear",
                            queue: false
                        }
                    });
                });
            }


            // Carousel
            var $carousel = $scope.find('.jltma-blog-carousel-slider');

            if (!$carousel.length) {
                return;
            }

            var $carouselContainer = $scope.find('.swiper-container'),
                $settings          = $carousel.data('settings'),
                Swiper = elementorFrontend.utils.swiper;

                initSwiper();

                async function initSwiper() {
                    var swiper = await new Swiper($carouselContainer, $settings);
                    if ($settings.pauseOnHover) {
                        $($carouselContainer).hover(function() {
                            (this).swiper.autoplay.stop();
                        }, function() {
                            (this).swiper.autoplay.start();
                        });
                    }
                };

        },


        /**** MA Image Carousel ****/
        MA_Image_Carousel: function ($scope, $) {

            var $carousel = $scope.find('.jltma-image-carousel-slider');

            if (!$carousel.length) {
                return;
            }

            var $carouselContainer = $scope.find('.swiper-container'),
                $settings          = $carousel.data('settings'),
                Swiper = elementorFrontend.utils.swiper;

                initSwiper();

                async function initSwiper() {
                    var swiper = await new Swiper($carouselContainer, $settings);
                    if ($settings.pauseOnHover) {
                        $($carouselContainer).hover(function() {
                            (this).swiper.autoplay.stop();
                        }, function() {
                            (this).swiper.autoplay.start();
                        });
                    }
                };
        },

        /**** MA Logo Slider ****/
        MA_Logo_Slider: function ($scope, $) {

            var $carousel = $scope.find('.jltma-logo-carousel-slider');

            if (!$carousel.length) {
                return;
            }

            var $carouselContainer = $scope.find('.swiper-container'),
                $settings          = $carousel.data('settings'),
                Swiper = elementorFrontend.utils.swiper;

                initSwiper();

                async function initSwiper() {
                    var swiper = await new Swiper($carouselContainer, $settings);
                    if ($settings.pauseOnHover) {
                        $($carouselContainer).hover(function() {
                            (this).swiper.autoplay.stop();
                        }, function() {
                            (this).swiper.autoplay.start();
                        });
                    }
                };


            /**
             * Icon click for hover
             */
            $carousel.find('.jltma-logo-slider-figure').on('click','.item-hover-icon',function(){
                var $this = $(this);
                $this.toggleClass('hide');
                $this.siblings('.jltma-hover-click').toggleClass('show');
            });

            /**
             * Tooltip jS
             */
            var $tooltipSelector = $carousel.find('.jltma-logo-slider-item');
            $tooltipSelector.each(function(e){
                var $currentTooltip = $(this).attr('id');
                if( $currentTooltip ){
                    var $dataId = $(this).data('id');
                    var $tooltipSettings = $(this).data('tooltip-settings');
                    var selector = '#'+$currentTooltip;
                    var $follow_cursor = $tooltipSettings.follow_cursor;
                    var placement_cursor;
                    if( $follow_cursor == 1 ){
                        placement_cursor = {
                            followCursor: true,
                        };
                    }else{
                        placement_cursor = {
                            placement: $tooltipSettings.placement,
                            followCursor: false,
                        };
                    }

                    console.log($tooltipSettings.arrow,$tooltipSettings.arrow_type);
                    var arrowType = false;
                    if( $tooltipSettings.arrow == 1 ) {
                        if($tooltipSettings.arrow_type == 'round'){
                            arrowType = tippy.roundArrow;
                        }else{
                            arrowType = true;
                        }
                    }

                    tippy(selector, {
                        content: $tooltipSettings.text,
                        ...placement_cursor,
                        animation: $tooltipSettings.animation,
                        arrow: arrowType,
                        duration: $tooltipSettings.duration,
                        delay: $tooltipSettings.delay,
                        trigger: $tooltipSettings.trigger, // mouseenter,click, manual
                        // flipOnUpdate: true,
                        // interactive: true,
                        offset: [$tooltipSettings.x_offset, $tooltipSettings.y_offset],
                        zIndex: 999999,
                        allowHTML: true,
                        theme: 'jltma-tippy-' +  $dataId,
                        onShow(instance) {
                            var tippyPopper = instance.popper;
                            $(tippyPopper).addClass($dataId);
                        }
                    });
                }
            });
        },



        /**** MA Team Slider ****/
        MA_TeamSlider: function ($scope, $) {

            var elementSettings     = getElementSettings( $scope ),
                uniqueId 		    = getUniqueLoopScopeId( $scope ),
                scopeId 		    = $scope.data('id'),
                $teamCarouselWrapper = $scope.find('.jltma-team-carousel-wrapper').eq(0),
                $team_preset = $teamCarouselWrapper.data("team-preset"),
                $ma_el_team_circle_image_animation = $teamCarouselWrapper.data("ma_el_team_circle_image_animation");

            if ($team_preset == "-content-drawer") {

                try {
                    (function ($) {

                        $('.gridder').gridderExpander({
                            scroll: false,
                            scrollOffset: 0,
                            scrollTo: "panel",                  // panel or listitem
                            animationSpeed: 400,
                            animationEasing: "easeInOutExpo",
                            showNav: true, // Show Navigation
                            nextText: "<span></span>", // Next button text
                            prevText: "<span></span>", // Previous button text
                            closeText: "", // Close button text
                            onStart: function () {
                                //Gridder Inititialized
                            },
                            onContent: function () {
                                //Gridder Content Loaded
                            },
                            onClosed: function () {
                                //Gridder Closed
                            }
                        });

                    })(jQuery);
                } catch (e) {
                    //We can also throw from try block and catch it here
                    // No Error Show
                }


            } else {

                var $carousel = $scope.find('.jltma-team-carousel-slider');

                if (!$carousel.length) {
                    return;
                }

                var $carouselContainer = $scope.find('.swiper-container'),
                    $settings          = $carousel.data('settings'),
                    Swiper = elementorFrontend.utils.swiper;

                    initSwiper();

                    async function initSwiper() {
                        var swiper = await new Swiper($carouselContainer, $settings);
                        if ($settings.pauseOnHover) {
                            $($carouselContainer).hover(function() {
                                (this).swiper.autoplay.stop();
                            }, function() {
                                (this).swiper.autoplay.start();
                            });
                        }
                    };
            }

            // else if ($team_preset == "-circle-animation"){
            //     if($ma_el_team_circle_image_animation == "animation_svg_04"){
            //
            //     }
            // }

        },

        /**** MA Advanced Image ****/
        MA_Advanced_Image: function ($scope, $) {

            Master_Addons.MA_Advanced_Image.elementSettings    = getElementSettings( $scope );

            $scope.find('.jltma-img-dynamic-dropshadow').each(function() {

                var imgFrame, clonedImg, img;

                if( this instanceof jQuery ){
                    if( this && this[0] ){
                        img = this[0];
                    } else {
                        return;
                    }
                } else {
                    img = this;
                }

                if ( ! img.classList.contains('jltma-img-has-shadow')){
                    imgFrame  = document.createElement('div');
                    clonedImg = img.cloneNode();

                    clonedImg.classList.add('jltma-img-dynamic-dropshadow-cloned');
                    clonedImg.classList.remove('jltma-img-dynamic-dropshadow');
                    img.classList.add('jltma-img-has-shadow');
                    imgFrame.classList.add('jltma-img-dynamic-dropshadow-frame');

                    img.parentNode.appendChild(imgFrame);
                    imgFrame.appendChild(img);
                    imgFrame.appendChild(clonedImg);
                }
            });

            //Tilt Effect
            $scope.find('.jltma-tilt-box').tilt({
                maxTilt : $(this).data('max-tilt'),
                easing: 'cubic-bezier(0.23, 1, 0.32, 1)',
                speed: $(this).data('time'),
                perspective: 2000
            });
        },

        /* MA Tooltip */
        MA_Tooltip: function ($scope, $) {

            var elementSettings           = getElementSettings( $scope ),
                scopeId                   = $scope.data('id'),
                $currentTooltip           = '#jltma-tooltip-' + scopeId,
                $ma_el_tooltip_text       = elementSettings.ma_el_tooltip_text?elementSettings.ma_el_tooltip_text:'top',
                $ma_el_tooltip_direction  = elementSettings.jltma_tooltip_follow_cursor?elementSettings.jltma_tooltip_follow_cursor:elementSettings.ma_el_tooltip_direction,
                $jltma_tooltip_animation  = elementSettings.jltma_tooltip_animation?elementSettings.jltma_tooltip_animation:'',
                $jltma_tooltip_arrow      = elementSettings.jltma_tooltip_arrow?elementSettings.jltma_tooltip_arrow: true,
                $jltma_tooltip_duration   = elementSettings.jltma_tooltip_duration?elementSettings.jltma_tooltip_duration: 300,
                $jltma_tooltip_delay      = elementSettings.jltma_tooltip_delay?elementSettings.jltma_tooltip_delay: 300,
                $ma_el_tooltip_text_width = elementSettings.ma_el_tooltip_text_width?elementSettings.ma_el_tooltip_text_width: '200px',
                $jltma_tooltip_arrow_type = elementSettings.jltma_tooltip_arrow_type?elementSettings.jltma_tooltip_arrow_type: 'sharp',
                $jltma_tooltip_distance   = elementSettings.jltma_tooltip_distance?elementSettings.jltma_tooltip_distance: 10,
                $jltma_tooltip_trigger    = elementSettings.jltma_tooltip_trigger?elementSettings.jltma_tooltip_trigger:'mouseenter',
                $animateFill              = elementSettings.jltma_tooltip_animation == "fill" ? true : false;

                var $ma_tooltip = $scope.find('.jltma-tooltip');
                if ( ! $ma_tooltip.length ) {
                    return;
                }

                tippy($currentTooltip, {
                    content  : $ma_el_tooltip_text,
                    placement: $ma_el_tooltip_direction,
                    animation: $jltma_tooltip_animation,
                    arrow    : $jltma_tooltip_arrow,
                    arrowType: $jltma_tooltip_arrow_type,
                    duration : $jltma_tooltip_duration,
                    distance : $jltma_tooltip_distance,
                    delay    : $jltma_tooltip_delay,
                    size     : $ma_el_tooltip_text_width,
                    trigger  : $jltma_tooltip_trigger,
                    animateFill: $animateFill,
                    flipOnUpdate: true,
                    maxWidth    : $ma_el_tooltip_text_width,
                    zIndex      : 999,
                    allowHTML: true,
                    theme    : 'jltma-image-filter-tippy-' + scopeId,
                    interactive: true,
                    appendTo: 'parent',
                    onShow(instance) {
                        var tippyPopper = instance.popper;
                        jQuery(tippyPopper).attr('data-tippy-popper-id', scopeId);
                    }
                });
        },

        /**** MA Twitter Slider ****/

        MA_Twitter_Slider: function ($scope, $) {

            var $carousel = $scope.find('.jltma-twitter-carousel-slider');

            if (!$carousel.length) {
                return;
            }

            var $carouselContainer = $scope.find('.swiper-container'),
                $settings          = $carousel.data('settings'),
                Swiper = elementorFrontend.utils.swiper;

                initSwiper();

                async function initSwiper() {
                    var swiper = await new Swiper($carouselContainer, $settings);
                    if ($settings.pauseOnHover) {
                        $($carouselContainer).hover(function() {
                            (this).swiper.autoplay.stop();
                        }, function() {
                            (this).swiper.autoplay.start();
                        });
                    }
                };


        },


        MA_ParticlesBG: function ($scope, $) {

            if ($scope.hasClass('jltma-particle-yes')) {
                let id = $scope.data('id');
                let element_type = $scope.data('element_type');
                let pdata = $scope.data('jltma-particle');
                let pdata_wrapper = $scope.find('.jltma-particle-wrapper').data('ma-el-pdata');

                if (typeof pdata != 'undefined' && pdata != '') {
                    if ($scope.find('.ma-el-section-bs').length > 0) {
                        $scope.find('.ma-el-section-bs').after('<div class="jltma-particle-wrapper"' +
                            ' id="jltma-particle-' + id + '"></div>');
                        particlesJS('jltma-particle-' + id, pdata);
                    } else {

                        if (element_type == 'column') {

                            $scope.find('.elementor-column-wrap').prepend('<div class="jltma-particle-wrapper"' +
                                ' id="jltma-particle-' + id + '"></div>');
                        } else {
                            $scope.prepend('<div class="jltma-particle-wrapper" id="jltma-particle-' + id + '"></div>');
                        }

                        particlesJS('jltma-particle-' + id, pdata);
                    }


                } else if (typeof pdata_wrapper != 'undefined' && pdata_wrapper != '') {

                    // $scope.prepend('<div class="jltma-particle-wrapper" id="jltma-particle-'+ id +'"></div>');

                    if (element_type == 'column') {
                        $scope.find('.elementor-column-wrap').prepend('<div class="jltma-particle-wrapper"' +
                            ' id="jltma-particle-' + id + '"></div>');
                    }
                    else {
                        $scope.prepend('<div class="jltma-particle-wrapper" id="jltma-particle-' + id + '"></div>');
                    }

                    particlesJS('jltma-particle-' + id, JSON.parse(pdata_wrapper));
                }

            }
            //
            //     })(jQuery);
            // } catch(e) {
            //     //We can also throw from try block and catch it here
            //     // No Error Show
            // }

        },

        MA_BgSlider: function ($scope, $) {
            var ma_el_slides = [], ma_el_slides_json = [], ma_el_transition, ma_el_animation, ma_el_custom_overlay, ma_el_overlay, ma_el_cover, ma_el_delay, ma_el_timer;
            var slider_wrapper = $scope.children('.ma-el-section-bs').children('.ma-el-section-bs-inner');

            if (slider_wrapper && slider_wrapper.data('ma-el-bg-slider')) {

                var slider_images = slider_wrapper.data('ma-el-bg-slider');
                ma_el_transition = slider_wrapper.data('ma-el-bg-slider-transition');
                ma_el_animation = slider_wrapper.data('ma-el-bg-slider-animation');
                ma_el_custom_overlay = slider_wrapper.data('ma-el-bg-custom-overlay');
                if (ma_el_custom_overlay == 'yes') {
                    ma_el_overlay = jltma_scripts.plugin_url + 'assets/lib/vegas/overlays/' + slider_wrapper.data('ma-el-bg-slider-overlay');
                } else {
                    if (slider_wrapper.data('ma-el-bg-slider-overlay')) {
                        ma_el_overlay = jltma_scripts.plugin_url + 'assets/lib/vegas/overlays/' + slider_wrapper.data('ma-el-bg-slider-overlay');
                    } else {
                        ma_el_overlay = jltma_scripts.plugin_url + 'assets/lib/vegas/overlays/' + slider_wrapper.data('ma-el-bg-slider-overlay');
                    }
                }

                ma_el_cover = slider_wrapper.data('ma-el-bg-slider-cover');
                ma_el_delay = slider_wrapper.data('ma-el-bs-slider-delay');
                ma_el_timer = slider_wrapper.data('ma-el-bs-slider-timer');

                if (typeof slider_images != 'undefined') {
                    ma_el_slides = slider_images.split(",");

                    jQuery.each(ma_el_slides, function (key, value) {
                        var slide = [];
                        slide.src = value;
                        ma_el_slides_json.push(slide);
                    });

                    slider_wrapper.vegas({
                        slides: ma_el_slides_json,
                        transition: ma_el_transition,
                        animation: ma_el_animation,
                        overlay: ma_el_overlay,
                        cover: ma_el_cover,
                        delay: ma_el_delay,
                        timer: ma_el_timer,
                        init: function () {
                            if (ma_el_custom_overlay == 'yes') {
                                var ob_vegas_overlay = slider_wrapper.children('.vegas-overlay');
                                ob_vegas_overlay.css('background-image', '');
                            }
                        }
                    });

                }
            }
        },

        MA_AnimatedGradient: function ($scope, $) {

            if ($scope.hasClass('ma-el-animated-gradient-yes')) {
                let id = $scope.data('id');
                let color = $scope.data('color');
                let angle = $scope.data('angle');
                let gradient_color = 'linear-gradient(' + angle + ',' + color + ')';
                let heading = $scope.find('.elementor-heading-title');
                $scope.css('background-image', gradient_color);

                if ($scope.hasClass('elementor-element-edit-mode')) {
                    color = $scope.find('.animated-gradient').data('color');
                    angle = $scope.find('.animated-gradient').data('angle');
                    let gradient_color_editor = 'linear-gradient(' + angle + ',' + color + ')';
                    $scope.prepend('<div class="animated-gradient" style="background-image : ' + gradient_color_editor + ' "></div>');
                    //$scope.find('.animated-gradient').css('background-image', gradient_color_editor);
                    //$scope.find('.animated-gradient').css('background-color', 'red');
                }
                //$scope.css('position', 'relative');
                //$scope.css('background-color', 'black');

            }

        },


        MA_Image_Comparison: function ($scope, $) {
            var $jltma_image_comp_wrap       = $scope.find('.jltma-image-comparison').eq(0),
                $jltma_image_data            = $jltma_image_comp_wrap.data('image-comparison-settings');

                $jltma_image_comp_wrap.twentytwenty({
                    default_offset_pct          : $jltma_image_data.visible_ratio,
                    orientation                 : $jltma_image_data.orientation,
                    before_label                : $jltma_image_data.before_label,
                    after_label                 : $jltma_image_data.after_label,
                    move_slider_on_hover        : $jltma_image_data.slider_on_hover,
                    move_with_handle_only       : $jltma_image_data.slider_with_handle,
                    click_to_move               : $jltma_image_data.slider_with_click,
                    no_overlay                  : $jltma_image_data.no_overlay
                });
        },

        MA_PiechartsHandlerOnScroll: function ($scope, $) {

            $scope.waypoint(function (direction) {

                Master_Addons.MA_PiechartsHandler($(this.element), $);

            }, {
                offset: (window.innerHeight || document.documentElement.clientHeight) - 100,
                triggerOnce: true
            });
        },

        MA_PiechartsHandler: function ($scope, $) {

            $scope.find('.ma-el-piechart .ma-el-percentage').each(function () {

                var track_color = $(this).data('track-color');
                var bar_color = $(this).data('bar-color');

                $(this).easyPieChart({
                    animate: 2000,
                    lineWidth: 10,
                    barColor: bar_color,
                    trackColor: track_color,
                    scaleColor: false,
                    lineCap: 'square',
                    size: 220

                });

            });

        },

        StatsBarHandler: function ($scope, $) {
            $scope.find('.jltma-stats-bar-content').each(function () {
                var dataperc = $(this).data('perc');
                $(this).animate({ "width": dataperc + "%" }, dataperc * 20);
            });
        },

        StatsBarHandlerOnScroll: function ($scope, $) {
            $scope.MasterAddonshWaypoint(function (direction) {
                Master_Addons.StatsBarHandler($(this.element), $);
                this.destroy(); // Done with handle on scroll
            }, {
                offset: (window.innerHeight || document.documentElement.clientHeight) - 150
            });
        },

        // Toggle Content
        MA_Toggle_Content: function( $scope, $ ) {
            Master_Addons.getElementSettings    = getElementSettings($scope);
			var $wrapper 			= $scope.find( '.jltma-toggle-content' ),
				toggleElementArgs 	= {
					active : Master_Addons.getElementSettings.jltma_toggle_content_active_index,
                };

            if ( '' !== Master_Addons.getElementSettings.jltma_toggle_content_indicator_color ) {
                toggleElementArgs.indicatorColor = Master_Addons.getElementSettings.jltma_toggle_content_indicator_color;
            }

            if ( Master_Addons.getElementSettings.jltma_toggle_content_indicator_speed.size ) {
                toggleElementArgs.speed = Master_Addons.getElementSettings.jltma_toggle_content_indicator_speed.size;
            }

            if ( elementorFrontend.isEditMode() ) {
                toggleElementArgs.watchControls = true;
            }

            $wrapper.MA_ToggleElement( toggleElementArgs );
        },


        // Comment Form reCaptcha
        MA_Comment_Form_reCaptcha: function( $scope, $ ) {
            Master_Addons.getElementSettings    = getElementSettings($scope);
            var $commentsWrapper = $scope.find(".jltma-comments-wrap"),
                $comments_recaptcha_data = $commentsWrapper.data("recaptcha"),
                $recaptcha_protected = $commentsWrapper.data("jltma-comment-settings"),
                jltma_comment_form;

            if($recaptcha_protected.reCaptchaprotected == "yes"){
                var onloadCallback = function() {
                    jltma_comment_form = grecaptcha.render("jltma_comment_form", {
                        "sitekey" : $comments_recaptcha_data.sitekey,
                        "theme" : $comments_recaptcha_data.theme
                    });
                    grecaptcha.reset(jltma_comment_form);
                };
            }

        },


        // Master Addons: Counter Up
        MA_Counter_Up: function( $scope, $ ) {
            var $counterup = $scope.find(".jltma-counter-up-number");

            if ( $.isFunction($.fn.counterUp) ) {
                $counterup.counterUp({
                    duration: 2000,
                    delay: 15,

                });
            }
        },


        // Master Addons: Countdown Timer
        MA_CountdownTimer: function ($scope, $) {

            var $countdownWidget = $scope.find(".jltma-widget-countdown");
            $.fn.MasterCountDownTimer = function () {
                var $wrapper = $(this).find(".jltma-countdown-wrapper"),
                    data = {
                        year: $wrapper.data("countdown-year"),
                        month: $wrapper.data("countdown-month"),
                        day: $wrapper.data("countdown-day"),
                        hour: $wrapper.data("countdown-hour"),
                        min: $wrapper.data("countdown-min"),
                        sec: $wrapper.data("countdown-sec")
                    },

                    targetDate = new Date(data.year, data.month, data.day, data.hour, data.min, data.sec);
                var $year = $wrapper.find('.jltma-countdown-year'),
                    $month = $wrapper.find('.jltma-countdown-month'),
                    $day = $wrapper.find('.jltma-countdown-day'),
                    $hour = $wrapper.find('.jltma-countdown-hour'),
                    $min = $wrapper.find('.jltma-countdown-min'),
                    $sec = $wrapper.find('.jltma-countdown-sec');

                setInterval(function () {
                    var diffTime = (Date.parse(targetDate) - Date.parse(new Date())) / 1000;

                    if (diffTime < 0) return;

                    $year.text(Math.floor(diffTime / (31536000))); // 1 year = 3153600 second
                    $month.text(Math.floor((diffTime / 2592000) % 12)); // 1 month = 2592000 second
                    $day.text(Math.floor((diffTime / 86400) % 365)); // 1 day = 86400 second
                    $hour.text(Math.floor((diffTime / 3600) % 24)); // 1 hour = 3600 second
                    $min.text(Math.floor((diffTime / 60) % 60)); // 1 min  = 60 second
                    $sec.text(Math.floor((diffTime) % 60));
                }, 1e3)
            }, $countdownWidget.each(function () {
                $(this).MasterCountDownTimer()
            })


        },

        /**
         * Fancybox popup
         */
        MA_Fancybox_Popup: function ($scope, $) {
            (function ($) {
                if ($.isFunction($.fn.fancybox)) {
                    $("[data-fancybox]").fancybox({});
                }
            })(jQuery);
        },

        /*
        * REVEAL
        */
        MA_Reveal: function ($scope, $) {

            Master_Addons.MA_Reveal.elementSettings = getElementSettings($scope);

            var rev1,
                isReveal = false;

            Master_Addons.MA_Reveal.revealAction = function () {
                rev1 = new RevealFx(revealistance, {
                    revealSettings: {
                        bgcolor: Master_Addons.MA_Reveal.elementSettings.reveal_bgcolor,
                        direction: Master_Addons.MA_Reveal.elementSettings.reveal_direction,
                        duration: Number(Master_Addons.MA_Reveal.elementSettings.reveal_speed.size) * 100,
                        delay: Number(Master_Addons.MA_Reveal.elementSettings.reveal_delay.size) * 100,
                        onCover: function (contentEl, revealerEl) {
                            contentEl.style.opacity = 1;
                        }
                    }
                });
            }

            Master_Addons.MA_Reveal.runReveal = function () {
                rev1.reveal();
            }

            if (Master_Addons.MA_Reveal.elementSettings.enabled_reveal) {

                var revealId = '#reveal-' + $scope.data('id'),
                    revealistance = document.querySelector(revealId);

                Master_Addons.MA_Reveal.revealAction();

                Master_Addons.MA_Reveal.waypointOptions = {
                    offset: '100%',
                    triggerOnce: true
                };
                elementorFrontend.waypoint($(revealistance), Master_Addons.MA_Reveal.runReveal, Master_Addons.MA_Reveal.waypointOptions);
            }
        },

        /*
        * MA Rellax
        */
        MA_Rellax: function ($scope, $) {

            var elementSettings = getElementSettings($scope);
            var rellax = null;

            $(window).on('resize', function () {

                if (rellax) {
                    rellax.destroy();
                    if (rellax)
                        initRellax();
                }
            });

            var initRellax = function () {
                if (elementSettings.enabled_rellax) {

                    currentDevice = elementorFrontend.getCurrentDeviceMode();

                    var setting_speed = 'speed_rellax';
                    var value_speed = 0;

                    if (currentDevice != 'desktop') {
                        setting_speed = 'speed_rellax_' + currentDevice;
                    }

                    if (eval('elementSettings.' + setting_speed + '.size'))
                        value_speed = eval('elementSettings.' + setting_speed + '.size');


                    var rellaxId = '#rellax-' + $scope.data('id');

                    if ($(rellaxId).length)
                        rellax = new Rellax(rellaxId, {
                            speed: value_speed
                        }
                        );
                    isRellax = true;
                };
            };

            initRellax();

        },

        MA_Rellax_Final: function (panel, model, view) {
            Master_Addons.getElementSettings = getElementSettings($scope);
            var $scope = view.$el;
            var scene = $scope.find('#scene');
        },


        // Entrance Animations
        MA_Entrance_Animation: function ($scope, $) {

            $scope = $scope || $(this);

            var $target      = $scope.hasClass('jltma-appear-watch-animation') ? $scope: $scope.find('.jltma-appear-watch-animation'),
                hasAnimation = $('body').hasClass('jltma-page-animation');

            if( ! $target.length ){
                return;
            }

            if ( hasAnimation ) {
                document.body.addEventListener( 'JltmaPageAnimationDone', function(event) {
                    $target.appearl({
                        offset: '200px',
                        insetOffset:'0px'
                    }).one( 'appear', function(event, data) {
                        this.classList.add('jltma-animated');
                        this.classList.add('jltma-animated-once');
                    });
                });
            } else {
                $target.appearl({
                    offset: '200px',
                    insetOffset:'0px'
                }).one( 'appear', function(event, data) {
                    this.classList.add('jltma-animated');
                    this.classList.add('jltma-animated-once');
                });
            }

        },


        // Wrapper Link
        MA_Wrapper_Link: function ($scope, $) {

            $('[data-jltma-wrapper-link]').each(function() {
                var link = $(this).data('jltma-wrapper-link');
                $(this).on('click.jltmaElementOnClick', function() {
                    if (link.is_external) {
                        window.open(link.url);
                    } else {
                        location.href = link.url;
                    }
                })
            });
        },

        /**
         * Restrict Content
         */
         MA_Restrict_Content_Ajax: function ($scope, $) {

            Master_Addons.getElementSettings = getElementSettings($scope);

            var $restrictwrapper    = $scope.find('.jltma-restrict-content-wrap').eq(0),
                $scopeId            = $scope.data('id'),
                $restrict_layout    = $restrictwrapper.data('restrict-layout-type'),
                $restrict_type      = $restrictwrapper.data('restrict-type'),
                $error_message      = $restrictwrapper.data('error-message'),
                $rc_ajaxify         = $restrictwrapper.data('rc-ajaxify'),

                $storageID          = 'ma_el_rc_' + $scopeId,
                $formID             = $scope.find('.jltma-restrict-form').eq(0).data('form-id'),

                // Content
                $content_div         = '#restrict-content-' + $scopeId,

                // Popup Settings
                $popup              = $scope.find( '.jltma-restrict-content-popup-content' ),
                $content_pass       = $restrictwrapper.data('content-pass') ? $restrictwrapper.data('content-pass') : '',
                $popup_type         = $popup.data('popup-type') ? $popup.data('popup-type') : '',

                // Restrict Age
                $age_wrapper        = $scope.find('.jltma-restrict-age-wrapper').eq(0),

                $restrict_age       = {
                    min_age             : $age_wrapper.data('min-age'),
                    age_type            : $age_wrapper.data('age-type'),
                    age_title           : $age_wrapper.data('age-title'),
                    age_content         : $age_wrapper.data('age-content'),
                    age_submit          : $( '#' + $formID ).find('button[name="submit"]').val(),
                    checkbox_msg        : $age_wrapper.data('checkbox-msg') ? $age_wrapper.data('checkbox-msg') : "",
                    empty_bday          : $age_wrapper.data('empty-bday') ? $age_wrapper.data('empty-bday') : "",
                    non_exist_bday      : $age_wrapper.data('non-exist-bday') ? $age_wrapper.data('non-exist-bday') : ""
                };


                //Check it the user has been accpeted the agreement
                if (localStorage.getItem($storageID)) {

                    $( '.jltma-rc-button' ).addClass('d-none');
                    $('#' + $formID).addClass('d-none');
                    $('#jltma-restrict-age-' + $scopeId).removeClass('card');
                    $('#jltma-restrict-age-' + $scopeId).removeClass('text-center');
                    $('#restrict-content-' + $scopeId).addClass('d-block');

                } else{

                    // Dom Selector for Onpage/Popup
                    if ($restrict_layout == "popup") {
                        var dom_selector = '#jltma-rc-modal-'  + $scopeId;
                    } else {
                        var dom_selector = '#jltma-restrict-content-' + $scopeId;
                    }

                    $( dom_selector ).on( 'click', '.jltma_ra_select', function() {
                        var wrap = $( this ).closest( '.jltma_ra_select_wrap' );
                        if( !wrap.find( '.jltma_ra_options' ).hasClass( 'jltma_ra_active' ) ) {
                            $( '.jltma_ra_options' ).removeClass( 'jltma_ra_active' );
                            wrap.find( '.jltma_ra_options' ).addClass( 'jltma_ra_active' );
                            wrap.find( '.jltma_ra_options' ).find( 'li:contains("' + wrap.find( '.jltma_ra_select_val' ).html() + '")' ).addClass( 'jltma_ra_active' );
                        }
                        else {
                            wrap.find( '.jltma_ra_options' ).removeClass( 'jltma_ra_active' );
                        }
                    });

                    $( dom_selector ).on( 'click', '.jltma_ra_options ul li', function() {
                        var wrap = $( this ).closest( '.jltma_ra_select_wrap' );
                        wrap.find( '.jltma_ra_select_val' ).html( $( this ).html() );
                        wrap.find( 'select' ).val( $( this ).attr( 'data-val' ) );
                        wrap.find( '.jltma_ra_options' ).removeClass( 'jltma_ra_active' );
                    });

                    $( dom_selector ).on( 'mouseover', '.jltma_ra_options ul li', function() {
                        if ( $( '.jltma_ra_options ul li' ).hasClass( 'jltma_ra_active' ) ) {
                            $( '.jltma_ra_options ul li' ).removeClass( 'jltma_ra_active' );
                        }
                    });

                    $( document ).click( function(e) {
                        if( $( e.target ).attr( 'class' ) != 'jltma_ra_select' && !$( '.jltma_ra_select' ).find( $( e.target ) ).length ) {
                            if( $( '.jltma_ra_options.jltma_ra_active' ).length ) {
                                $( '.jltma_ra_options' ).removeClass( 'jltma_ra_active' );
                            }
                        }
                    });


                    //Onload Fancybox
                    if( $popup_type == "windowload" || $popup_type=="windowloadfullscreen"){
                           $( "#ma-el-rc-modal-hidden" ).fancybox().trigger('click');
                    }else{
                        $("[data-fancybox]").fancybox({});
                    }

                    $( dom_selector ).on( 'submit', '#' + $formID , function(event) {
                        event.preventDefault();

                        var form = $( this );
                        form.find( '.jltma_rc_result' ).remove();

                        $.ajax({
                            type: "POST",
                            url: jltma_scripts.ajaxurl,
                            data: {
                                action: 'jltma_restrict_content',
                                fields: form.serialize(),
                                restrict_type: $restrict_type,
                                error_message: $error_message,
                                content_pass: $content_pass,
                                restrict_age: $restrict_age
                            },
                            cache: false,
                            success: function (result) {

                                try {
                                    result = jQuery.parseJSON( result );

                                    if ( result['result'] == 'success' ) {

                                        $('#restrict-content-'+ $scopeId).removeClass('d-none').addClass('d-block');

                                        //Custom Classes add/remove
                                        $('#' + $formID).addClass('d-none');
                                        $('#jltma-restrict-age-' + $scopeId).removeClass('card');
                                        $('#jltma-restrict-age-' + $scopeId).removeClass('text-center');


                                        //Set a cookie to remember the state
                                        localStorage.setItem($storageID, true);
                                        $.fancybox.close();

                                        $('.jltma-rc-button').addClass('d-none');

                                    } else if ( result['result'] == 'validate' ) {
                                        $( '#' + $formID + ' ' + '.jltma_rc_submit' ).after( '<div class="jltma_rc_result"><span class="eicon-info-circle-o"></span> ' + result['output'] + '</div>' );
                                    } else {
                                        throw 0;
                                    }
                                }
                                catch(err) {
                                    $(  '#' + $formID + ' ' + '.jltma_rc_submit' ).after( '<div class="jltma_rc_result"><span class="eicon-loading"></span> Failed, please try again.</div>' );
                                }

                            }
                        }); // ajax part end

                    }); // End of Submit Event


                } // localstorage


        },

        MA_Restrict_Content: function ($scope, $) {

            try {
                (function ($) {
                    Master_Addons.getElementSettings = getElementSettings($scope);

                    var $restrictwrapper = $scope.find('.jltma-restrict-content-wrap').eq(0),
                        $scopeId = $scope.data('id'),
                        $restrict_layout = $restrictwrapper.data('restrict-layout-type'),
                        $restrict_type = $restrictwrapper.data('restrict-type'),

                        $storageID = 'ma_el_rc',

                        // Popup Settings
                        $popup = $scope.find('.jltma-restrict-content-popup-content'),
                        $content_pass = $restrictwrapper.data('content-pass'),

                        // Restrict Age
                        $age_wrapper = $scope.find('.jltma-restrict-age-wrapper').eq(0),
                        $min_age = $age_wrapper.data('min-age'),
                        $age_type = $age_wrapper.data('age-type'),
                        $age_title = $age_wrapper.data('age-title'),
                        $age_content = $age_wrapper.data('age-content'),
                        $checkbox_msg = $age_wrapper.data('checkbox-msg');

                    Master_Addons.MA_Restrict_Content_Ajax($scope, $);

                })(jQuery);
            } catch (e) {
                //We can also throw from try block and catch it here
                // No Error Show
            }
        },

        MA_Nav_Menu: function ($scope, $) {
            Master_Addons.getElementSettings = getElementSettings($scope);

            var $menuContainer      = $scope.find(".jltma-nav-menu-element"),
                $menuID             = $menuContainer.data("menu-id"),
                $menu_type          = $menuContainer.data("menu-layout"),
                $menu_trigger       = $menuContainer.data("menu-trigger"),
                $menu_offcanvas     = $menuContainer.data("menu-offcanvas"),
                $menu_toggletype    = $menuContainer.data("menu-toggletype"),
                $submenu_animation  = $menuContainer.data("menu-animation"),
                $menu_container_id  = $menuContainer.data("menu-container-id"),
                $sticky_type = $menuContainer.data("sticky-type"),
                navbar_height = $('#' + $menu_container_id).outerHeight(),
                menu_container_selector = $('#' + $menu_container_id);

            // refresh window on resize
            // $(window).on('resize',function(){location.reload();});


            /* One Page Menu */
            if ($menu_type == "onepage") {

                $(document).on('click', '.jltma-navbar-nav li a', function (e) {
                    if ($(this).attr('href')) {
                        var self = $(this),
                            el = self.get(0),
                            href = el.href,
                            hasHash = href.indexOf('#'),
                            enable = self.parents('.jltma-navbar-nav-default').hasClass('jltma-one-page-enabled');

                        if (hasHash !== -1 && (href.length > 1) && enable && (el.pathname == window.location.pathname)) {
                            e.preventDefault();
                            self.parents('.jltma-menu-container').find('.jltma-close').trigger('click');
                        }
                    }
                });

                // Mobile Menu close outside clicking
                $(document).on('click', function (e) {
                    var click = $(e.target),
                        opened = $(".navbar-collapse").hasClass("show");
                     if(opened === true){
                        $(".jltma-one-page-enabled").removeClass('show');
                     }
                });

            } else {


                // Submenu Hover Animation Effect
                var submenu_animate_class = 'animated ' + $submenu_animation,
                    submenu_selector = $('.jltma-dropdown.jltma-sub-menu');
                $("#" + $menuID + " .jltma-menu-has-children").hover( function () {
                    if (submenu_selector.hasClass('fade-up')) {
                        submenu_selector.removeClass('fade-up');
                    }
                    if (submenu_selector.hasClass('fade-down')) {
                        submenu_selector.removeClass('fade-down');
                    }
                    $('.jltma-dropdown.jltma-sub-menu').addClass( $submenu_animation );
                });



                /* On Scroll Fixed Navbar */
                ///////////////// fixed menu on scroll for Desktop
                if ($sticky_type == "fixed-onscroll") {
                    if ($(window).width() > 768 ) {
                        $(function() {
                            $(window).scroll(function() {
                                var scroll = $(window).scrollTop();
                                if (scroll >= 10) {
                                    menu_container_selector.removeClass(''+$menu_container_id +'').addClass("jltma-on-scroll-fixed");
                                } else {
                                    menu_container_selector.removeClass("jltma-on-scroll-fixed").addClass(''+$menu_container_id +'');
                                }
                            });
                        });
                    }
                }


                if ($sticky_type == "sticky-top") {
                    if ($(window).width() > 768 ) {
                        $(function() {
                            $(window).scroll(function() {
                                var scroll = $(window).scrollTop();
                                if (scroll >= 10) {
                                    menu_container_selector.removeClass(''+$menu_container_id +'').addClass("sticky-top");
                                } else {
                                    menu_container_selector.removeClass("sticky-top").addClass(''+$menu_container_id +'');
                                }
                            });
                        });
                    }
                }


                if ($sticky_type == "smart-scroll") {

                    // add padding top to show content behind navbar
                    $('body').css('padding-top', navbar_height + 'px');
                        menu_container_selector.addClass('jltma-smart-scroll');

                    //////////////////////// detect scroll top or down
                    if ($('.jltma-smart-scroll').length > 0) { // check if element exists
                        var last_scroll_top = 0;

                        $(window).on('scroll', function() {
                            var scroll_top = $(this).scrollTop();
                            if(scroll_top < last_scroll_top) {
                                $('.jltma-smart-scroll').removeClass('scrolled-down').addClass('scrolled-up');
                            }
                            else {
                                $('.jltma-smart-scroll').removeClass('scrolled-up').addClass('scrolled-down');
                            }
                            last_scroll_top = scroll_top;
                        });
                    }
                }


                if ($sticky_type == "nav-fixed-top") {
                    if ($(window).width() > 768 ) {
                        $(function() {
                            // add padding top to show content behind navbar
                            // $('body').css('padding-top', $('#' + $menu_container_id ).outerHeight() + 'px');
                            $('body').css('padding-top', navbar_height + 'px');
                            menu_container_selector.addClass('jltma-fixed-top');

                        });
                    }
                }



                // Menu Settings Megamenu Trigger Effect
                if ($('.jltma-has-megamenu').hasClass('jltma-megamenu-click')) {
                    $('li.jltma-megamenu-click').on('click', function (e) {
                        e.preventDefault;
                        e.stopPropagation();
                        $(this).toggleClass("show");
                        $('.dropdown-menu.jltma-megamenu').toggleClass("show");
                    });
                }
                // else {
                //     $('.jltma-has-megamenu').on('hover', function (e) {
                //         e.preventDefault;
                //         e.stopPropagation();
                //         $(this).toggleClass("show");
                //         $('.dropdown-menu.jltma-megamenu').toggleClass("show");
                //     });
                // }


                if ($menu_toggletype == "toggle") {

                    // Menu Toggle
                    $("#" + $menuID + " .navbar-nav.toggle .jltma-menu-dropdown-toggle").click(function (e) {
                        $(this).parents(".dropdown").toggleClass("open");
                        e.stopPropagation();
                    });
                }


                if ($menu_offcanvas == "toggle-bar") {
                    $(".jltma-nav-panel .navbar-toggler").on("click", function (e) {
                        $('.jltma-burger').toggleClass("jltma-close");
                    });
                }

                // Off Canvas Menu
                if ($menu_offcanvas == "offcanvas" || $menu_offcanvas == "overlay") {

                    // /// offcanvas onmobile
                    $(".jltma-nav-panel .navbar-toggler").on("click", function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        var offcanvas_id = $(this).attr('data-trigger');
                        $(offcanvas_id).toggleClass("show");
                        $('body').toggleClass("offcanvas-active");
                        $(".jltma-nav-panel ").toggleClass("offcanvas-nav");
                        if ($menu_offcanvas == "overlay") {
                            $(".jltma-nav-panel ").toggleClass("offcanvas-overlay");
                        }
                    });

                    /// Close menu when pressing ESC
                    $(document).on('keydown', function (event) {
                        if (event.keyCode === 27) {
                            $(".mobile-offcanvas").removeClass("show");

                            $(".desktop-offcanvas").removeClass("show");

                            $("body").removeClass("overlay-active");
                        }
                    });

                    $(".btn-close, .jltma-nav-panel .offcanvas-nav, .jltma-nav-panel.desktop .jltma-close, .jltma-close").click(function (e) {
                        $(".jltma-nav-panel ").removeClass("offcanvas-nav");
                        $(".mobile-offcanvas").removeClass("show");

                        $(".desktop-offcanvas").removeClass("show");

                        $("body").removeClass("offcanvas-active");
                        if ($menu_offcanvas == "overlay") {
                            $(".jltma-nav-panel ").removeClass("offcanvas-overlay");
                        }
                    });


                }



            }






        },


        initEvents: function ($scope, $) {

            var mainSearchWrapper = $scope.find('.jltma-search-wrapper').eq(0),
                $search_type      = mainSearchWrapper.data('search-type'),
                mainContainer = $scope.find('.jltma-search-main-wrap'),
                openCtrl = document.getElementById('jltma-btn-search'),
                closeCtrl = document.getElementById('jltma-btn-search-close'),
                searchContainer = $scope.find('.jltma-search'),
                inputSearch = searchContainer.find('.jltma-search__input');

            $( openCtrl ).on('click', function(){
                mainContainer.addClass('main-wrap--move');
                searchContainer.addClass('search--open');
                setTimeout(function () {
                    inputSearch.focus();
                }, 600);
            });

            $( closeCtrl ).on('click', function(){
                mainContainer.removeClass('main-wrap--move');
                searchContainer.removeClass('search--open');
                inputSearch.blur();
                inputSearch.value = '';
            });

            document.addEventListener('keyup', function (ev) {
                if (ev.keyCode == 27) {
                    Master_Addons.closeSearch();
                }
            });
        },


        MA_Header_Search: function ($scope, $) {
            $('body').addClass('js');
            Master_Addons.initEvents($scope, $);
        }


    };




    $(window).on('elementor/frontend/init', function () {

        if (elementorFrontend.isEditMode()) {
            editMode = true;
        }

        //Global Scripts
        elementorFrontend.hooks.addAction('frontend/element_ready/global', Master_Addons.MA_AnimatedGradient);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', Master_Addons.MA_BgSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', Master_Addons.MA_ParticlesBG);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', Master_Addons.MA_Reveal);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', Master_Addons.MA_Rellax);
        // elementorFrontend.hooks.addAction('frontend/element_ready/global', Master_Addons.MA_Entrance_Animation);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', Master_Addons.MA_Wrapper_Link);


        //Element Scripts
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-headlines.default', Master_Addons.MA_Animated_Headlines);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-advanced-accordion.default', Master_Addons.MA_Accordion);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-tabs.default', Master_Addons.MA_Tabs);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-progressbar.default', Master_Addons.MA_ProgressBar);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-team-members-slider.default', Master_Addons.MA_TeamSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-image-carousel.default', Master_Addons.MA_Image_Carousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-blog-post.default', Master_Addons.MA_Blog);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-news-ticker.default', Master_Addons.MA_NewsTicker);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-el-countdown-timer.default', Master_Addons.MA_CountdownTimer);
        elementorFrontend.hooks.addAction('frontend/element_ready/jltma-counter-up.default', Master_Addons.MA_Counter_Up);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-piecharts.default', Master_Addons.MA_PiechartsHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-timeline.default', Master_Addons.MA_Timeline);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-image-filter-gallery.default', Master_Addons.MA_Image_Filter_Gallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/jltma-gallery-slider.default', Master_Addons.MA_Gallery_Slider);

        elementorFrontend.hooks.addAction('frontend/element_ready/ma-el-image-comparison.default', Master_Addons.MA_Image_Comparison);
        elementorFrontend.hooks.addAction('frontend/element_ready/jltma-restrict-content.default', Master_Addons.MA_Restrict_Content);
        // elementorFrontend.hooks.addAction('frontend/element_ready/ma-navmenu.default', Master_Addons.MA_Nav_Menu);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-search.default', Master_Addons.MA_Header_Search);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-piecharts.default', Master_Addons.MA_PiechartsHandlerOnScroll);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-progressbars.default', Master_Addons.StatsBarHandlerOnScroll);
        elementorFrontend.hooks.addAction('frontend/element_ready/jltma-instagram-feed.default', Master_Addons.MA_Instagram_Feed);
        elementorFrontend.hooks.addAction('frontend/element_ready/jltma-toggle-content.default', Master_Addons.MA_Toggle_Content);
        elementorFrontend.hooks.addAction('frontend/element_ready/jltma-comments.default', Master_Addons.MA_Comment_Form_reCaptcha);
        elementorFrontend.hooks.addAction('frontend/element_ready/jltma-logo-slider.default', Master_Addons.MA_Logo_Slider);
        elementorFrontend.hooks.addAction('frontend/element_ready/jltma-twitter-slider.default', Master_Addons.MA_Twitter_Slider);
        elementorFrontend.hooks.addAction('frontend/element_ready/jltma-advanced-image.default', Master_Addons.MA_Advanced_Image);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-tooltip.default', Master_Addons.MA_Tooltip);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-image-hotspot.default', Master_Addons.MA_Image_Hotspot);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-pricing-table.default', Master_Addons.MA_Pricing_Table);
        // elementorFrontend.hooks.addAction('frontend/element_ready/jltma-offcanvas-menu.default', Master_Addons.MA_Offcanvas_Menu);

        

        if (elementorFrontend.isEditMode()) {
            elementorFrontend.hooks.addAction('frontend/element_ready/ma-headlines.default', Master_Addons.MA_Animated_Headlines);
            elementorFrontend.hooks.addAction('frontend/element_ready/ma-piecharts.default', Master_Addons.MA_PiechartsHandler);
            elementorFrontend.hooks.addAction('frontend/element_ready/ma-progressbars.default', Master_Addons.StatsBarHandler);
            elementorFrontend.hooks.addAction('frontend/element_ready/ma-news-ticker.default', Master_Addons.MA_NewsTicker);
            // elementorFrontend.hooks.addAction('frontend/element_ready/ma-image-filter-gallery.default', Master_Addons.MA_Image_Filter_Gallery);
            elementorFrontend.hooks.addAction('frontend/element_ready/jltma-gallery-slider.default', Master_Addons.MA_Gallery_Slider);
            elementorFrontend.hooks.addAction('frontend/element_ready/jltma-counter-up.default', Master_Addons.MA_Counter_Up);
            elementorFrontend.hooks.addAction('frontend/element_ready/ma-tooltip.default', Master_Addons.MA_Tooltip);
        }




    });

})(jQuery);
