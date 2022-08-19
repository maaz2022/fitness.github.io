/*
 * Table of Contents jQuery Plugin - jquery.toc
 *
 * Copyright 2013-2016 Nikhil Dabas
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except
 * in compliance with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software distributed under the License
 * is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express
 * or implied.  See the License for the specific language governing permissions and limitations
 * under the License.
 */

( function( $ ) {

    // Builds a list with the table of contents in the current selector.
    // options:
    //   content: where to look for headings
    //   headings: string with a comma-separated list of selectors to be used as headings, ordered
    //   by their relative hierarchy level


    OffSet = {

        _setoffset: function( lists ){

                if (window.matchMedia("(max-width: 767px)").matches) {

                    if( undefined == lists.data( 'jltma-scroll-offset-mobile' ) ){
                        scroll_offset = lists.data( 'jltma-scroll-offset' );
                        return scroll_offset;
                    }
                    else{
                        scroll_offset = lists.data( 'jltma-scroll-offset-mobile' );
                        return scroll_offset;
                    }

                } else if ( window.matchMedia("(max-width: 976px)").matches  ) {

                        if( undefined == lists.data( 'jltma-scroll-offset-tablet' ) ){
                            scroll_offset = lists.data( 'jltma-scroll-offset' );
                            return scroll_offset;
                        }
                        else{
                            scroll_offset = lists.data( 'jltma-scroll-offset-tablet' );
                            return scroll_offset;
                        }
                    } else {
                        scroll_offset = lists.data( 'jltma-scroll-offset' );
                        return scroll_offset;
            }
        },

        __jltma_toc_scroll_to_top_offset: function( lists, jltma_toc_scroll_to_top_offset ) {
            if (window.matchMedia("(max-width: 767px)").matches) {

                if( undefined == lists.data( 'jltma-scroll-to-top-offset-mobile' ) ){
                    return jltma_toc_scroll_to_top_offset;
                }
                else{
                    jltma_toc_scroll_to_top_offset = lists.data( 'jltma-scroll-to-top-offset-mobile' );
                    return jltma_toc_scroll_to_top_offset;
                }

            } else if ( window.matchMedia("(max-width: 976px)").matches  ) {

                    if( undefined == lists.data( 'jltma-scroll-to-top-offset-tablet' ) ){
                        return jltma_toc_scroll_to_top_offset;
                    }
                    else{
                        jltma_toc_scroll_to_top_offset = lists.data( 'jltma-scroll-to-top-offset-tablet' );
                        return jltma_toc_scroll_to_top_offset;
                    }
                } else {
                    return jltma_toc_scroll_to_top_offset;
            }
        }
    }

    var toc = function (options) {
        return this.each(function () {
            var root = $(this),
                data = root.data(),
                thisOptions,
                stack = [root], // The upside-down stack keeps track of list elements
                listTag = this.tagName,
                currentLevel = 0,
                headingSelectors;

            // Defaults: plugin parameters override data attributes, which override our defaults
            thisOptions = $.extend(
                {content: "body", headings: "h1,h2,h3,h4,h5,h6"},
                {content: data.toc || undefined, headings: data.tocHeadings || undefined},
                options
            );
            headingSelectors = thisOptions.headings.split(",");

            if( ! $( thisOptions.content ).find( thisOptions.headings ).length ) {
                $widget_scope = $( 'body' ).find( '.elementor-element-' + options.scope );
                $widget_scope.find( '.jltma-toc-main-wrapper' ).addClass( 'jltma-toc-empty-content' );
            }

            $( thisOptions.content ).find( thisOptions.headings ).addClass( "jltma-toc-text" );

            var exclude_parent = $( 'body' ).find( '.jltma-toc-hide-heading' );
            var exclude_ids = [];
            exclude_parent.each( function( i ) {
                var $this = $( this );
                if( $this.hasClass( 'jltma-toc-text' ) ) {
                    $this.addClass( 'jltma-toc-hidden-item' );
                }
                $this.find( '.jltma-toc-text' ).addClass( 'jltma-toc-hidden-item' );
            });

            // Set up some automatic IDs if we do not already have them
            $(thisOptions.content).find(thisOptions.headings).attr("id", function (index, attr) {
                // In HTML5, the id attribute must be at least one character long and must not
                // contain any space characters.
                //
                // We just use the HTML5 spec now because all browsers work fine with it.
                // https://mathiasbynens.be/notes/html5id-class
                if ( undefined !== attr ) {
                    attr = attr.replace( /[&\/\\#,+()$!~%.'":*?<>{}]/g, "" );
                }

                var generateUniqueId = function (text) {
                    // Generate a valid ID. Spaces are replaced with underscores. We also check if
                    // the ID already exists in the document. If so, we append "_1", "_2", etc.
                    // until we find an unused ID.

                    if (text.length === 0) {
                        text = "?";
                    }

                    var baseId = text.replace(/\s+/g, "_"), suffix = "", count = 1;
                    baseId = baseId.replace(/[&\/\\#,+()$!~%.'":*?<>{}]/g, "");

                    while (document.getElementById(baseId + suffix) !== null) {
                        suffix = "_" + count++;
                    }

                    return baseId + suffix;
                };

                return attr || generateUniqueId($(this).text());
            }).each(function () {
                // What level is the current heading?
                var elem = $(this), level = $.map(headingSelectors, function (selector, index) {
                    return elem.is(selector) ? index : undefined;
                })[0];

                if( elem.hasClass( 'jltma-toc-hidden-item' ) ) {
                    return;
                }

                if (level > currentLevel) {
                    // If the heading is at a deeper level than where we are, start a new nested
                    // list, but only if we already have some list items in the parent. If we do
                    // not, that means that we're skipping levels, so we can just add new list items
                    // at the current level.
                    // In the upside-down stack, unshift = push, and stack[0] = the top.
                    var parentItem = stack[0].children("li:last")[0];
                    if (parentItem) {
                        stack.unshift($("<" + listTag + "/>").appendTo(parentItem));
                    }
                } else {
                    // Truncate the stack to the current level by chopping off the 'top' of the
                    // stack. We also need to preserve at least one element in the stack - that is
                    // the containing element.
                    stack.splice(0, Math.min(currentLevel - level, Math.max(stack.length - 1, 0)));
                }

                // Add the list item
                $("<li/>").appendTo(stack[0]).append(
                    $("<a/>").text(elem.text()).attr("href", "#" + elem.attr("id"))
                );

                currentLevel = level;
            });
        });
    }, old = $.fn.toc;

    $.fn.toc = toc;

    $.fn.toc.noConflict = function () {
        $.fn.toc = old;
        return this;
    };

    // Data API
    $( function () {
        toc.call($("[data-toc]"));
    });

    var scroll = true
    var scroll_element = null
    var isElEditMode = false;


    var Master_Addons = {

        /**
         * Hide scroll to top button on scroll
         *
         */
        MATableOfContentsScroll: function () {
            scroll_element = $( ".jltma-scroll-top-icon" );
            if ( null != scroll_element ) {
                if ( $( window ).scrollTop() > 250 ) {
                    scroll_element.addClass( "jltma-toc__show-scroll" );
                } else {
                    scroll_element.removeClass( "jltma-toc__show-scroll" );
                }
            }
        },
        MATableOfContents: function( $scope, $ ) {

            var body_wrap =  $( 'body' );
            var $body = body_wrap.find( '.entry-content' );
            var node_id = $scope.data( 'id' );
            var toggle_button = $scope.find( '.jltma-toc-switch' );
            var toggle_content = $scope.find( '.jltma-toc-toggle-content' );
            var is_collapsible = toggle_button.data( 'jltma-is-collapsible' );
            var wrapper = $scope.find( '.jltma-toc-main-wrapper' );
            var selected_headings = wrapper.data( 'jltma-headings' );
            var lists = $scope.find( '.jltma-toc-list' );
            var scroll_delay = lists.data( 'jltma-scroll' );
            var separator = $scope.find( '.jltma-separator-parent' );
            var scroll_offset = OffSet._setoffset( lists );
            var lists_jltma_scroll_to_top_offset = lists.data( 'jltma-scroll-to-top-offset' );
            var jltma_toc_scroll_to_top_offset = OffSet.__jltma_toc_scroll_to_top_offset( lists, lists_jltma_scroll_to_top_offset );
            if( $body.length === 0 ) {
                $body = body_wrap.find( '.page-content' );
            }

            if( $body.length === 0 ) {
                $body = body_wrap.find( 'div[data-elementor-type]' );
            }

            window.onresize = function( ) {
                scroll_offset = OffSet._setoffset( lists );
                lists_jltma_scroll_to_top_offset = lists.data( 'jltma-scroll-to-top-offset' );
                jltma_toc_scroll_to_top_offset = OffSet.__jltma_toc_scroll_to_top_offset( lists, lists_jltma_scroll_to_top_offset );
            }

            // Toggle content on Show/Hide button.
            toggle_button.on( 'click', function( e ) {

                $this = $( this );

                if( 'yes' === is_collapsible ) {
                    separator.toggle( 100 );
                    if ( wrapper.hasClass( 'jltma-content-show' ) ) {
                        toggle_content.slideUp( 350 );
                        wrapper.removeClass( 'jltma-content-show' );
                    } else {
                        toggle_content.slideDown( 350 );
                        wrapper.addClass( 'jltma-content-show' );
                    }

                    if( wrapper.hasClass( 'jltma-toc-auto-collapse' ) ) {
                        wrapper.removeClass( 'jltma-toc-auto-collapse' );
                    } else {
                        wrapper.toggleClass( 'jltma-toc-hidden' );
                    }

                }

            });

            // Execute TOC function.
            $scope.find( '.jltma-toc-list' ).toc( { content: $body, headings: selected_headings, scope: node_id } );

            wrapper.find( '.jltma-toc-list a' ).on( 'click', function () {

                if( '' == scroll_offset || 'undefined' == typeof scroll_offset ) {
                    $( 'html, body' ).animate( {
                        scrollTop: $( $.attr( this, 'href' ) ).offset().top-30
                    }, scroll_delay );
                } else {
                    $( 'html, body' ).animate( {
                        scrollTop: $( $.attr( this, 'href' ) ).offset().top-(scroll_offset)
                    }, scroll_delay );
                }

                // Add class to active heading.
                $scope.find( '.jltma-toc-list a' ).not( this ).removeClass( 'jltma-toc-active-heading' );
                $( this ).addClass( 'jltma-toc-active-heading' );

                return false;
            });

            $scope.find( '.jltma-toc-wrapper li' ).each( function( i ) {
                $( this ).attr( "id", "toc-li-" + i );
            });

            $scope.find( '.jltma-scroll-top-icon' ).on( 'click', function( e ) {
                if( '' == jltma_toc_scroll_to_top_offset || 'undefined' == typeof jltma_toc_scroll_to_top_offset ) {
                    $( "html, body" ).animate( {
                        scrollTop: wrapper.offset().top
                    }, scroll_delay );
                } else {
                    $( 'html, body' ).animate( {
                        scrollTop: jltma_toc_scroll_to_top_offset
                    }, scroll_delay );
                }

            });

            $( document ).on( "scroll", Master_Addons.MATableOfContentsScroll  );
        }
    }

    $( window ).on( 'elementor/frontend/init', function () {

        if ( elementorFrontend.isEditMode() ) {
            isElEditMode = true;
        }

        elementorFrontend.hooks.addAction( 'frontend/element_ready/ma-table-of-contents.default', Master_Addons.MATableOfContents );

    });

} )( jQuery );
