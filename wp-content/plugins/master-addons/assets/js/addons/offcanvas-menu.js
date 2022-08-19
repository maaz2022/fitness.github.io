( function( $, elementor ) {

	'use strict';

        /* Offcanvas Menu */
        var MA_Offcanvas_Menu= function ($scope, $) {
            var widgetSelector     = 'jltma-offcanvas-menu',
                getID              = $scope.data('id'),
                getElementSettings = $scope.data('settings'),
                getData = $scope.find('.jltma-offcanvas-menu__wrapper').data('settings'),
                classes = {
                    widget                   : widgetSelector,
                    // triggerButton            : 'jltma-offcanvas__trigger',
                    triggerButton            : "".concat(widgetSelector, "__trigger"),
                    // offcanvasContent         : 'jltma-offcanvas__content',
                    offcanvasContent         : "".concat(widgetSelector, "__content"),
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
            MA_Offcanvas_Menu.resetCanvas = function() {
                var contentId = getID;
                elements.$html.addClass("".concat(classes.offcanvasContent, "-widget"));

                if (!elements.$outsideContainer.length) {
                    elements.$body.append("<div class=\"".concat(classes.offcanvasContainerOverlay, "\" />"));
                    elements.$body.wrapInner("<div class=\"".concat(classes.offcanvasContainer, "\" />"));
                    elements.$offcanvasContent.insertBefore(selectors.offcanvasContainer);
                }

                var $wrapperContent = elements.$offcanvasWrapper.find(selectors.offcanvasContent);
                console.log('$wrapperContent',$wrapperContent);
                console.log('$contentId',contentId);

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



            //MA_Offcanvas_Menu.offcanvasClose
            MA_Offcanvas_Menu.offcanvasClose = function(){
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
            MA_Offcanvas_Menu.containerClick = function (event) {

                var openId = elements.$html.data('open-id');

                if (getID !== openId || !getElementSettings.overlay_close) {
                    return;
                }

                if (!elements.$html.hasClass(classes.contentOpenClass)) {
                    return;
                }
                MA_Offcanvas_Menu.offcanvasClose();
            }

            MA_Offcanvas_Menu.closeESC = function(event){
                if( 'yes' === getElementSettings.esc_close ) {
                    if (27 !== event.keyCode) {
                        return;
                    }
                    MA_Offcanvas_Menu.offcanvasClose();
                    $(elements.$triggerButton).removeClass('trigger-active');
                }
            }


            MA_Offcanvas_Menu.addLoaderIcon = function() {
                jQuery(document).find('.jltma-offcanvas__content').addClass('jltma-loading');
            }
            MA_Offcanvas_Menu.removeLoaderIcon = function() {
                jQuery(document).find('.jltma-offcanvas__content').removeClass('jltma-loading');
            }

            // bindEvents
            MA_Offcanvas_Menu.bindEvents = function () {

                elements.$body.on('click', selectors.offcanvasContainerOverlay, MA_Offcanvas_Menu.containerClick.bind(this));

                // if( 'yes' === getElementSettings.esc_close ) {
                //     // var is_esc_close = getElementSettings.esc_close ? getElementSettings.esc_close : '';
                //     // console.log('is_esc_close',typeof is_esc_close);

                //     // if ('yes' === is_esc_close) {
                //         elements.$document.on('keydown', MA_Offcanvas_Menu.closeESC.bind(this));
                //     // }
                // }
                elements.$document.on('keydown', MA_Offcanvas_Menu.closeESC.bind(this));

                elements.$triggerButton.on('click', MA_Offcanvas_Menu.offcanvasContent.bind(this));
                elements.$closeButton.on('click', MA_Offcanvas_Menu.offcanvasClose.bind(this));
                elements.$menuParent.on('click', MA_Offcanvas_Menu.onParentClick.bind(this));

                $(elements.$menuParent).on('change',function(){
                    MA_Offcanvas_Menu.onParentClick.bind($(this));
                });
                // elements.$menuParent.on('click', this.onParentClick.bind(this));

                $("[data-settings=animation_type]").on('click',function(){
                    MA_Offcanvas_Menu.changeControl.bind($(this));
                });
                // MA_Offcanvas_Menu.bindElementChange(['animation_type'], this.changeControl.bind(this));
            }


            //perfectScrollInit
            MA_Offcanvas_Menu.perfectScrollInit = function() {
                if (!MA_Offcanvas_Menu.scrollPerfect) {
                    MA_Offcanvas_Menu.scrollPerfect = new PerfectScrollbar(elements.$offcanvasContentBody.get(0), {
                        wheelSpeed: 0.5,
                        suppressScrollX: true
                    });
                    return;
                }

                MA_Offcanvas_Menu.scrollPerfect.update();
            }

            //onEdit
            MA_Offcanvas_Menu.onEdit = function() {
                // elementorFrontend.isEditMode()
                if (!elementorFrontend.isEditMode) {
                    return;
                }

                if (undefined === $element.data('opened')) {
                    $element.data('opened', 'false');
                }

                elementor.channels.editor.on('section:activated', MA_Offcanvas_Menu.sectionActivated.bind(this));
            }


            //sectionActivated
            MA_Offcanvas_Menu.sectionActivated = function(sectionName, editor) {
                var elementsData = elementorFrontend.config.elements.data[this.getModelCID()];
                var editedElement = editor.getOption('editedElementView');

                if (this.getModelCID() !== editor.model.cid || elementsData.get('widgetType') !== editedElement.model.get('widgetType')) {
                return;
                }

                if (-1 !== this.sectionsArray.indexOf(sectionName)) {
                if ('true' === $element.data('opened')) {
                    var editedModel = editor.getOption('model');
                    MA_Offcanvas_Menu.offcanvasContent(null, editedModel.get('id'));
                }

                $element.data('opened', 'true');

                } else {
                    MA_Offcanvas_Menu.offcanvasClose();
                }
            }

            //offcanvasContent
            MA_Offcanvas_Menu.offcanvasContent = function(event) {
                var widgetId = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

                var boxPosition   = getData.canvas_position;
                // var boxPosition   = 'center';
                var offcanvasType = getData.animation_type;
                // var offcanvasType = 'slide';
                var contentId     = getID;

                if (null !== widgetId) {
                    contentId = widgetId;
                }
                elements.$triggerButton.addClass('trigger-active');

                jQuery("".concat(selectors.contentClassPart, "-").concat(contentId)).addClass('active');
                elements.$html.addClass("".concat(classes.contentOpenClass)).addClass("".concat(classes.contentOpenClass, "-").concat(contentId)).addClass("".concat(classes.contentClassPart, "-").concat(boxPosition)).addClass("".concat(classes.contentClassPart, "-").concat(offcanvasType)).data('open-id', contentId);
            }


            //onParentClick
            MA_Offcanvas_Menu.onParentClick = function(event) {
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
            MA_Offcanvas_Menu.changeControl = function() {
                MA_Offcanvas_Menu.offcanvasClose();
            }

            // onInit
            MA_Offcanvas_Menu.onInit = function() {

                MA_Offcanvas_Menu.resetCanvas();

                // MA_Offcanvas_Menu.perfectScrollInit();
                // MA_Offcanvas_Menu.onEdit();
                MA_Offcanvas_Menu.bindEvents();
            }
            // onInit

            return MA_Offcanvas_Menu.onInit();
    };

    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/jltma-offcanvas-menu.default', MA_Offcanvas_Menu);
    });

}( jQuery, window.elementorFrontend ) );
