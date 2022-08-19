( function( $ ) {

	'use strict';

    class MA_Nav_MenuHandler extends elementorModules.frontend.handlers.Base {

        //  __construct(settings) {
        //     //  ((MA_Nav_MenuHandler.prototype), "__construct", this).call(this, settings);
		//     // super.__construct( settings );
        //     MA_Nav_MenuHandler.prototype.__construct = function() {
        //         this.call(this, settings);
        //     }


        //     this.sectionsArray = ['section_dropdown_menu', 'section_dropdown_popup_offcanvas', 'section_style_dropdown_list', 'section_style_dropdown_item', 'section_style_popup_offcanvas'];

        //     // alert("Object Created.");
        //     // color = 'green';
        //     console.log('construcst');
        // }

        getDefaultSettings() {
            var widgetSelector = 'jltma-nav-menu';
            var classes = {
                widget            : widgetSelector,
                menuArrow         : "".concat(widgetSelector, "__arrow"),
                dropdownType      : 'jltma-menu-dropdown-type',
                itemHasChildren   : 'menu-item-has-children',
                navMenuLayout     : 'jltma-layout',
                navMenuDropdown   : 'jltma-dropdown',
                navMenuStretch    : 'jltma-nav-menu-stretch',
                navMenuOpenLink   : 'jltma-nav-menu-open-link',
                verticalType      : 'jltma-vertical-type',
                sideNavPosition   : 'jltma-side-position',
                verticalMenuType  : 'jltma-vertical-menu-type',
                animationContainer: 'jltma-animation-container'
            };
            var selectors = {
                widget             : ".".concat(classes.widget),
                dropdownSubmenu    : ".".concat(classes.widget, "__dropdown-submenu"),
                itemHasChildren    : ".".concat(classes.itemHasChildren),
                itemHasChildrenLink: ".".concat(classes.itemHasChildren, " > a"),
                menuItem           : '.menu-item',
                mainItemTextWrap   : ".".concat(classes.widget, "__main-item-text-wrap")
            };
            return {
                classes: classes,
                selectors: selectors
            };
        }

        getDefaultElements() {
            var selectors = this.getSettings().selectors;

            var elements = {
                $window                      : jQuery(window),
                $html                        : jQuery(document).find('html'),
                $mainMenu                    : this.findElement("".concat(selectors.widget, "__main")),
                $menuContainer               : this.findElement("".concat(selectors.widget, "__container")),
                $menuContainerInner          : this.findElement("".concat(selectors.widget, "__container-inner")),
                $menuParent                  : this.findElement("".concat(selectors.widget, "__dropdown ").concat(selectors.widget, "__container-inner ").concat(selectors.itemHasChildrenLink)),
                $dropdown                    : this.findElement("".concat(selectors.widget, "__dropdown")),
                $dropdownContainer           : this.findElement("".concat(selectors.widget, "__dropdown-container")),
                $dropdownButton              : this.findElement("".concat(selectors.widget, "__toggle")),
                $dropdownCloseButton         : this.findElement("".concat(selectors.widget, "__dropdown-close")),
                $dropdownSubmenu             : this.findElement(selectors.dropdownSubmenu),
                $offcanvasDropdownCloseButton: this.findElement("".concat(selectors.widget, "__dropdown-offcanvas ").concat(selectors.widget, "__dropdown-close")),
                $itemMain                    : this.findElement("".concat(selectors.widget, "__main ").concat(selectors.menuItem)),
                $itemLinkMain                : this.findElement("".concat(selectors.widget, "__main ").concat(selectors.menuItem, " > a"))
            };
            return elements;
        }

        onInit(...settings) {
            // (0, _get2.default)((0, _getPrototypeOf2.default)(MenuWidget.prototype), "onInit", this).call(this);
            // this.onInit.call(this);
            // super.onInit();
            super.onInit( ...settings );

            if (!this.elements.$dropdown.length) {
                return;
            }

            this.sideNavReset();
            this.setArrowDropdown();
            this.checkDropdown();
            this.onEdit();
        }


        sideNavReset() {
            var classes = this.getSettings().classes;

            var $html = this.elements.$html;
            $html.removeClass("".concat(classes.sideNavPosition, "-left")).removeClass("".concat(classes.sideNavPosition, "-right"));

            if (!this.elements.$menuContainer.hasClass("".concat(classes.verticalType, "-side"))) {
                return;
            }

            var settings = this.getElementSettings();
            $html.addClass("".concat(classes.sideNavPosition, "-").concat(settings.side_menu_position));

            if ('tablet' === settings.dropdown_breakpoints) {
                $html.removeClass("".concat(classes.verticalMenuType, "-mobile ").concat(classes.verticalMenuType, "-none")).addClass("".concat(classes.verticalMenuType, "-tablet"));
            } else if ('mobile' === settings.dropdown_breakpoints) {
                $html.removeClass("".concat(classes.verticalMenuType, "-tablet ").concat(classes.verticalMenuType, "-none")).addClass("".concat(classes.verticalMenuType, "-mobile"));
            } else {
                $html.removeClass("".concat(classes.verticalMenuType, "-tablet ").concat(classes.verticalMenuType, "-mobile")).addClass("".concat(classes.verticalMenuType, "-none"));
            }

            if ('side' === settings.vertical_menu_type) {
                $html.addClass("".concat(classes.verticalMenuType, "-").concat(settings.vertical_menu_type));
            }
        }

        setArrowDropdown() {
            var classes = this.getSettings().classes,
                selectors = this.getSettings().selectors;

            if (this.$element.hasClass(classes.navMenuStretch)) {
                this.dropdownStretch();
            }

            if (!this.elements.$menuContainerInner.find(selectors.menuItem).hasClass(classes.itemHasChildren)) {
                return;
            }

            var $mainMenu = this.elements.$mainMenu;
            var $dropdown = this.elements.$dropdown;
            var mainDataIcon = 'icon-main';
            var subDataIcon = 'icon-sub';
            var layout = this.getElementSettings('layout');
            var mainItemTextWrap = '';

            if ('horizontal' === layout || 'vertical' === layout && 'normal' === this.getElementSettings('vertical_menu_type')) {
                mainItemTextWrap = ' ' + selectors.mainItemTextWrap;
            }

            if ('' !== $mainMenu.data(mainDataIcon)) {
                $mainMenu.find(' > ul > li' + selectors.itemHasChildrenLink + mainItemTextWrap).append("<span class=\"".concat(classes.menuArrow, " ").concat($mainMenu.data(mainDataIcon), "\"></span>"));
            }

            var settings = this.getElementSettings();

            if ('' !== $mainMenu.data(subDataIcon) && 'side' !== settings.vertical_menu_type) {
                $mainMenu.find(' > ul ul > li' + selectors.itemHasChildrenLink + mainItemTextWrap).append("<span class=\"".concat(classes.menuArrow, " ").concat($mainMenu.data(subDataIcon), "\"></span>"));
            }

            if ('' !== $dropdown.data(subDataIcon) && 'side' !== settings.vertical_menu_type) {
                $dropdown.find(selectors.itemHasChildrenLink).append("<span class=\"".concat(classes.menuArrow, " ").concat($dropdown.data(subDataIcon), "\"></span>"));
            }
        }


        dropdownStretch() {
            var offsetLeft = this.$element.offset().left;
            this.elements.$dropdown.css({
                width: this.elements.$window.width(),
                left: -offsetLeft,
                top: this.elements.$dropdownButton.outerHeight(true)
            });
        }


        checkDropdown() {
            var _this2 = this;

            var _this$getSettings5 = this.getSettings(),
                classes = _this$getSettings5.classes,
                selectors = _this$getSettings5.selectors;

            var $menuContainer = this.elements.$menuContainer;

            if (!$menuContainer.hasClass("".concat(classes.navMenuLayout, "-horizontal"))) {
                return;
            }

            var $menuItemDropdown = $menuContainer.find(selectors.dropdownSubmenu);

            if (!$menuItemDropdown.length) {
                return;
            }

            Array.from($menuItemDropdown).forEach(function (dropdown) {
                var $itemDropdown = jQuery(dropdown);
                var dropdownRightPosition = $itemDropdown.offset().left + $itemDropdown.outerWidth(true);

                if (dropdownRightPosition < _this2.elements.$window.width()) {
                    $itemDropdown.removeAttr('dropdown-align-left').attr('dropdown-align-right', '');
                } else {
                    $itemDropdown.removeAttr('dropdown-align-right').attr('dropdown-align-left', '');
                }
            });
        }


        onEdit() {
            if (!this.isEdit) {
                return;
            }

            elementor.channels.editor.on('section:activated', this.sectionActivated.bind(this));
        }


        sectionActivated(sectionName, editor) {

            var sectionsArray = ['section_dropdown_menu', 'section_dropdown_popup_offcanvas', 'section_style_dropdown_list', 'section_style_dropdown_item', 'section_style_popup_offcanvas'];

            var elementsData = elementorFrontend.config.elements.data[this.getModelCID()];

            var editedElement = editor.getOption('editedElementView');

            if (elementsData.get('widgetType') !== editedElement.model.get('widgetType')) {
                return;
            }

            var _this$getSettings6 = this.getSettings(),
                classes = _this$getSettings6.classes,
                selectors = _this$getSettings6.selectors;

            var editedModel = editor.getOption('model');
            var $menuContainer = this.elements.$menuContainer;
            var $dropdownContainer = this.elements.$dropdownContainer;
            var $dropdown = this.elements.$dropdown;
            var $dropdownButton = this.elements.$dropdownButton;
            var $firstSubmenuLevel = "> ul > li".concat(selectors.itemHasChildren, ":first > ul");

            if (-1 !== sectionsArray.indexOf(sectionName) && this.$element.hasClass("elementor-element-".concat(editedModel.get('id')))) {
                if ($dropdown.hasClass("".concat(classes.navMenuLayout, "-dropdown"))) {
                    if ($dropdown.hasClass("".concat(classes.dropdownType, "-default"))) {
                        $dropdown.addClass('active');
                        $dropdown.slideDown('normal');
                    } else if ($dropdown.hasClass("".concat(classes.dropdownType, "-popup"))) {
                        $dropdown.addClass('active');
                    } else if ($dropdown.hasClass("".concat(classes.dropdownType, "-offcanvas"))) {
                        $dropdownContainer.addClass('active');
                    }

                    $dropdownButton.addClass('active');
                }

                if ($menuContainer.hasClass("".concat(classes.verticalType, "-toggle")) || $menuContainer.hasClass("".concat(classes.verticalType, "-accordion"))) {
                    $menuContainer.find($firstSubmenuLevel).slideDown('normal');
                }

                if ($menuContainer.hasClass("".concat(classes.navMenuLayout, "-horizontal")) || $menuContainer.hasClass("".concat(classes.navMenuLayout, "-vertical")) && $menuContainer.hasClass("".concat(classes.verticalType, "-normal"))) {
                    $menuContainer.find($firstSubmenuLevel).addClass('change-dropdown');
                }
            } else {
                if ($dropdown.hasClass("".concat(classes.navMenuLayout, "-dropdown"))) {
                    if ($dropdown.hasClass("".concat(classes.dropdownType, "-default"))) {
                    $dropdown.removeClass('active');
                    $dropdown.slideUp('normal');
                    } else if ($dropdown.hasClass("".concat(classes.dropdownType, "-popup"))) {
                    $dropdown.removeClass('active');
                    } else if ($dropdown.hasClass("".concat(classes.dropdownType, "-offcanvas"))) {
                    $dropdownContainer.removeClass('active');
                    }

                    $dropdownButton.removeClass('active');
                }

                if ($menuContainer.hasClass("".concat(classes.verticalType, "-toggle")) || $menuContainer.hasClass("".concat(classes.verticalType, "-accordion"))) {
                    $menuContainer.find($firstSubmenuLevel).slideUp('normal');
                }

                if ($menuContainer.hasClass("".concat(classes.navMenuLayout, "-horizontal")) || $menuContainer.hasClass("".concat(classes.navMenuLayout, "-vertical")) && $menuContainer.hasClass("".concat(classes.verticalType, "-normal"))) {
                    $menuContainer.find($firstSubmenuLevel).removeClass('change-dropdown');
                }
            }
        }


        onButtonClick() {
            var _this$getSettings7 = this.getSettings(),
                classes = _this$getSettings7.classes;

            var settings = this.getElementSettings();
            var $dropdown = this.elements.$dropdown;
            var $dropdownButton = this.elements.$dropdownButton;

            if ($dropdown.hasClass("".concat(classes.dropdownType, "-popup"))) {
                if (!$dropdownButton.hasClass('active')) {
                    $dropdown.addClass('active');

                    if (settings.disable_scroll) {
                    this.elements.$html.css('overflow', 'hidden');
                    }
                }
            } else if ($dropdown.hasClass("".concat(classes.dropdownType, "-offcanvas"))) {
                $dropdown.toggleClass('active');
                this.elements.$dropdownContainer.addClass('active');

                if (settings.disable_scroll) {
                    this.elements.$html.css('overflow', 'hidden');
                }
            }

            if (!$dropdownButton.hasClass('active')) {
                $dropdown.addClass('active');
                $dropdown.slideDown('normal');
            } else {
                $dropdown.removeClass('active');
                $dropdown.slideUp('normal');
            }
            this.closeAllSubmenu();
            $dropdownButton.toggleClass('active');
        }


        onCloseDropdownButton() {
            this.elements.$dropdown.removeClass('active');
            this.elements.$dropdown.slideUp('normal');
            this.elements.$dropdownButton.removeClass('active');
            this.elements.$dropdownContainer.removeClass('active');

            if (this.getElementSettings('disable_scroll')) {
            var self = this;
            setTimeout(function () {
                self.elements.$html.css('overflow', 'inherit');
            }, 300);
            }
        }

        onWindowResize() {
            var _this$getSettings8 = this.getSettings(),
                classes = _this$getSettings8.classes;

            if (this.$element.hasClass(classes.navMenuStretch)) {
                this.dropdownStretch();
            }

            var $dropdownButton = this.elements.$dropdownButton;

            if ('dropdown' !== this.getElementSettings('layout') && 'desktop' === elementorFrontend.getCurrentDeviceMode() && $dropdownButton.hasClass('active')) {
                $dropdownButton.removeClass('active');
                this.elements.$dropdown.removeClass('active');
                this.elements.$dropdown.slideUp('normal');
            }

            this.checkDropdown();
        }

        verticalMenuToggle(event) {
            this.checkPreventDefault(event);
            var $parentItem = this.getParentItem(event);
            $parentItem.parent().toggleClass('active');
            $parentItem.next().slideToggle('normal');
        }

        checkPreventDefault(event) {
            var onlyHref = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

            var _this$getSettings9 = this.getSettings(),
                classes = _this$getSettings9.classes;

            var $clickedItem = jQuery(event.target);
            var noLinkArray = ['', '#'];

            if (-1 !== noLinkArray.indexOf($clickedItem.attr('href')) || $clickedItem.hasClass(classes.menuArrow)) {
                event.preventDefault();
            }

            if (!onlyHref && !this.elements.$menuContainer.hasClass(classes.navMenuOpenLink)) {
                event.preventDefault();
            }
        }

        getParentItem(event) {
            var _this$getSettings10 = this.getSettings(),
                classes = _this$getSettings10.classes;

            var $clickedItem = jQuery(event.target);
            var $parentItem = $clickedItem;

            if ($clickedItem.hasClass(classes.menuArrow)) {
                $parentItem = $clickedItem.parent();
            }

            return $parentItem;
        }

        verticalMenuAccordion(event) {
            this.checkPreventDefault(event);

            var _this$getSettings11 = this.getSettings(),
                selectors = _this$getSettings11.selectors;

            var $parentItem = this.getParentItem(event);
            var $grandParentItem = $parentItem.parent();
            var $nextItem = $parentItem.next('ul');

            if (!$grandParentItem.hasClass('active')) {
                if ($grandParentItem.siblings('li.active').length) {
                    $grandParentItem.siblings('li.active').removeClass('active').find(selectors.dropdownSubmenu).slideUp(function () {
                    $grandParentItem.addClass('active');
                    $nextItem.slideDown();
                    });
                    $grandParentItem.siblings('li').find('li.active').removeClass('active').find(selectors.dropdownSubmenu).hide();
                } else {
                    $grandParentItem.addClass('active');
                    $nextItem.slideDown();
                }
            } else {
                $grandParentItem.removeClass('active');
                $nextItem.slideUp();
            }
        }

        verticalMenuNormalHover(event) {
            var classes = this.getSettings().classes,
                selectors = this.getSettings().selectors;

            var $menuItemDropdown = jQuery(event.target).parent().find("> ".concat(selectors.dropdownSubmenu));

            if (!$menuItemDropdown.length) {
                return;
            }

            if (this.$element.hasClass("".concat(classes.navMenuDropdown, "-position-left"))) {
                $menuItemDropdown.removeAttr('dropdown-align-right').attr('dropdown-align-left', '');
            } else {
                $menuItemDropdown.removeAttr('dropdown-align-left').attr('dropdown-align-right', '');
            }

            var dropdownOffsetLeft = $menuItemDropdown.offset().left;
            var dropdownRightPosition = dropdownOffsetLeft + $menuItemDropdown.outerWidth(true);

            if (0 > dropdownOffsetLeft) {
                $menuItemDropdown.removeAttr('ƒ').attr('dropdown-align-right', '');
            } else if (dropdownRightPosition > this.elements.$window.width()) {
                $menuItemDropdown.removeAttr('dropdown-align-right').attr('dropdown-align-left', '');
            }
        }

        closeSlideButton() {
            this.elements.$dropdown.removeClass('active');
            this.elements.$dropdownButton.removeClass('active');
        }

        closeAllSubmenu(){
            $('.jltma-nav-menu__container-inner li').each(function(){
                $(this).find('ul.dropdown-menu').slideUp('normal');
            })
        }

        onParentClick(event) {
            this.checkPreventDefault(event, true);
            var $parentItem = this.getParentItem(event);

            if (!$parentItem.hasClass('active')) {
                event.preventDefault();
            }
 
            if( $parentItem.parent().hasClass('jltma-has-megamenu') && $parentItem.parent().hasClass('jltma-mobile-builder-content') ){
                if ($parentItem.parent().children('.jltma-megamenu').is('ul') && !$parentItem.parent().children('.jltma-megamenu').is(':visible')) {
                    $parentItem.parent().children('.jltma-megamenu').slideToggle('normal');
                }
            }else{

                $parentItem.next().slideUp('normal');
                var $nextItem = $parentItem.next();

                if ($nextItem.is('ul') && !$nextItem.is(':visible')) {
                    $parentItem.next().slideDown('normal');
                }
            }
        }

        onContainerClick(event) {
            var classes = this.getSettings().classes;

            var settings = this.getElementSettings();
            var $dropdown = this.elements.$dropdown;
            var $dropdownContainer = this.elements.$dropdownContainer;
            this.getParentItem(event).parent().toggleClass('active');
            var isPopup = $dropdown.hasClass("".concat(classes.dropdownType, "-popup"));
            var isSlide = $dropdown.hasClass("".concat(classes.dropdownType, "-offcanvas"));

            if (!settings.overlay_close && (isPopup || isSlide)) {
                return;
            }

            if (isPopup && jQuery(event.target).get(0) === $dropdown.get(0) || isSlide && jQuery(event.target).get(0) === $dropdownContainer.get(0)) {
                $dropdown.removeClass('active');
                this.elements.$dropdownButton.removeClass('active');
                $dropdownContainer.removeClass('active');

                if (settings.disable_scroll) {
                    var self = this;
                    setTimeout(function () {
                        self.elements.$html.css('overflow', 'inherit');
                    }, 300);
                }
            }
        }

        closeESC() {
            var self = this;

            if ('' === this.getElementSettings('esc_close')) {
                return;
            }

            jQuery(document).on('keydown', function (event) {
                if (27 === event.keyCode) {
                    self.onCloseDropdownButton();
                }
            });
        }

        bindEvents() {
            var _this = this;

            var classes = this.getSettings().classes;

            if (!this.elements.$dropdown.length) {
                return;
            }

            this.elements.$window.on('resize', this.onWindowResize.bind(this));
            var classList = this.elements.$menuContainer.attr('class').split(/\s+/);

            classList.forEach(function (className) {
                switch (className) {
                case "".concat(classes.verticalType, "-toggle"):
                    _this.elements.$itemLinkMain.on('click', _this.verticalMenuToggle.bind(_this));
                    break;

                case "".concat(classes.verticalType, "-accordion"):
                    _this.elements.$itemLinkMain.on('click', _this.verticalMenuAccordion.bind(_this));

                    break;

                case "".concat(classes.verticalType, "-normal"):
                    _this.elements.$itemMain.on('mouseover', _this.verticalMenuNormalHover.bind(_this));

                    break;
                }
            });
            this.elements.$offcanvasDropdownCloseButton.on('click', function () {
                _this.closeSlideButton.bind(_this);

                _this.onCloseDropdownButton.bind(_this);
            });
            this.elements.$dropdownButton.on('click', this.onButtonClick.bind(this));
            this.elements.$menuParent.on('click', this.onParentClick.bind(this));
            this.elements.$dropdownCloseButton.on('click', this.onCloseDropdownButton.bind(this));
            this.elements.$dropdown.on('click', this.onContainerClick.bind(this));


            if ('yes' === this.getElementSettings('esc_close')) {
                this.closeESC();
            }
        }


    }

    // When the frontend of Elementor is created, add our handler
    jQuery( window ).on( 'elementor/frontend/init', () => {
        const MA_Nav_Menu = ( $element ) => {
            elementorFrontend.elementsHandler.addHandler( MA_Nav_MenuHandler, {
                $element,
            } );
        };
        // Add our handler to the ma-navmenu Widget (this is the slug we get from get_name() in PHP)
        elementorFrontend.hooks.addAction( 'frontend/element_ready/ma-navmenu.default', MA_Nav_Menu );
    } );


}( jQuery ) );
