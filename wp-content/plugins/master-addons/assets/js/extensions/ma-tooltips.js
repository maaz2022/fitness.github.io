;(function($, elementor){
    'use strict';
    // make the window global for site js
    var $window = $(window);

    var debounce = function(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this,
                args = arguments;
            var callNow = immediate && !timeout;
            clearTimeout(timeout);

            // Set the new timeout
            timeout = setTimeout(function() {
                timeout = null;
                if (!immediate) { func.apply(context, args); }
            }, wait);
            if (callNow) func.apply(context, args);
        };
    };

    $window.on('elementor/frontend/init', function () {
        var ModuleHandler = elementorModules.frontend.handlers.Base,
            MA_Element_Tooltip;

        MA_Element_Tooltip = ModuleHandler.extend({

            bindEvents: function () {
                this.run();
            },

            getDefaultSettings: function () {
                return {
                    allowHTML: true,
                };
            },

            onElementChange: debounce(function (prop) {
                if (prop.indexOf('jltma_element_') !== -1) {
                    this.instance.destroy();
                    this.run();
                }
            }, 400),

            settings: function (key) {
                return this.getElementSettings('jltma_element_' + key);
            },

            run: function () {
                var options = this.getDefaultSettings();
                var widgetID = this.$element.data('id');
                var widgetContainer = document.querySelector('.elementor-element-' + widgetID + ' .elementor-widget-container');

                if (this.settings('tooltip_text')) {
                    options.content = this.settings('tooltip_text');
                }

                options.arrow = !!this.settings('tooltip_arrow');
                options.followCursor = !!this.settings('tooltip_follow_cursor');

                if (this.settings('tooltip_placement')) {
                    options.placement = this.settings('tooltip_placement');
                }

                if (this.settings('tooltip_trigger')) {
                    if (this.settings('tooltip_custom_trigger')) {
                        options.triggerTarget = document.querySelector(this.settings('tooltip_custom_trigger'));
                    } else {
                        options.trigger = this.settings('tooltip_trigger');
                    }
                }

                if (this.settings('tooltip_duration')) {
                    options.duration = this.settings('tooltip_duration.sizes.from');
                }

                if (this.settings('tooltip_animation')) {
                    if (this.settings('tooltip_animation') === 'fill') {
                        options.animateFill = true;
                    } else {
                        options.animation = this.settings('tooltip_animation');
                    }
                }
                if (this.settings('tooltip_x_offset.size') || this.settings('tooltip_y_offset.size')) {
                    options.offset = [this.settings('tooltip_x_offset.size') || 0, this.settings('tooltip_y_offset.size') || 0];
                }
                if (this.settings('tooltip_enable')) {
                    options.theme = 'jltma-widget-tippy-' + widgetID;
                    this.instance = tippy(widgetContainer, options);
                }
            }
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(MA_Element_Tooltip, {
                $element: $scope
            });
        });
    });
})(jQuery, window.elementorFrontend);
