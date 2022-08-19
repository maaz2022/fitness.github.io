/*
* Initialize Modules
*/
;(function($, window, document, undefined){

    $( window ).on( 'elementor:init', function() {


		// Add "master-addons" specific css class to elementor body
        $('.elementor-editor-active').addClass('master-addons');


        // Make our custom css visible in the panel's front-end
        if( typeof elementorPro == 'undefined' ) {
            elementor.hooks.addFilter( 'editor/style/styleText', function( css, context ){
                if ( ! context ) {
                    return;
                }

                var model = context.model,
                    customCSS = model.get('settings').get('custom_css');
                var selector = '.elementor-element.elementor-element-' + model.get('id');

                if ('document' === model.get('elType')) {
                    selector = elementor.config.document.settings.cssWrapperSelector;
                }

                if (customCSS) {
                    css += customCSS.replace(/selector/g, selector);
                }

                return css;
            });
        }

        // End of Custom CSS

        var JltmaControlBaseDataView = elementor.modules.controls.BaseData;


        /*!
         * ================== Visual Select Controller ===================
         **/
        var JltmaControlVisualSelectItemView = JltmaControlBaseDataView.extend( {
            onReady: function() {
                this.ui.select.jltmaVisualSelect();
            },
            onBeforeDestroy: function() {
                this.ui.select.jltmaVisualSelect( 'destroy' );
            }
        } );
        elementor.addControlView( 'jltma-visual-select', JltmaControlVisualSelectItemView );



        // Enables the live preview for Animation Tranistions in Elementor Editor
        function jltmaOnGlobalOpenEditorForTranistions ( panel, model, view ) {
            view.listenTo( model.get( 'settings' ), 'change', function( changedModel ){

                // Force to re-render the element if the Entrance Animation enabled for first time
                if( '' !== model.getSetting('ma_el_animation_name') && !view.$el.hasClass('jltma-animated') ){
                    view.render();
                    view.$el.addClass('jltma-animated');
                    view.$el.addClass('jltma-animated-once');
                }

                // Check the changed setting value
                for( settingName in changedModel.changed ) {
                    if ( changedModel.changed.hasOwnProperty( settingName ) ) {

                        // Replay the animation if an animation option changed (except the animation name)
                        if( settingName !== "ma_el_animation_name" && -1 !== settingName.indexOf("ma_el_animation_") ){

                            // Reply the animation
                            view.$el.removeClass( model.getSetting('ma_el_animation_name') );

                            setTimeout( function() {
                                view.$el.addClass( model.getSetting('ma_el_animation_name') );
                            }, ( model.getSetting('ma_el_animation_delay') || 300 ) ); // Animation Delay
                        }
                    }
                }

            }, view );
        }
        elementor.hooks.addAction( 'panel/open_editor/section', jltmaOnGlobalOpenEditorForTranistions );
        elementor.hooks.addAction( 'panel/open_editor/column' , jltmaOnGlobalOpenEditorForTranistions );
        elementor.hooks.addAction( 'panel/open_editor/widget' , jltmaOnGlobalOpenEditorForTranistions );


        // Choose Text Control
        var JLTMA_Choose_Text = elementor.modules.controls.Choose.extend({
            applySavedValue: function applySavedValue() {
                var currentValue = this.getControlValue();

                if (currentValue || _.isString(currentValue)) {
                    this.ui.inputs.filter("[value=\"".concat(currentValue, "\"]")).prop('checked', true);
                } else {
                    this.ui.inputs.filter(':checked').prop('checked', false);
                }
            }
        });
        elementor.hooks.addAction( 'panel/open_editor/widget' , JLTMA_Choose_Text );
        // elementor.hooks.addFilter('elements/widget/behaviors', JLTMA_Choose_Text);
        elementor.addControlView( 'jltma-choose-text', JLTMA_Choose_Text );


        // Query Control

        var JLTMA_ControlQuery = elementor.modules.controls.Select2.extend( {

            cache: null,
            isTitlesReceived: false,

            getSelect2Placeholder: function getSelect2Placeholder() {
                return {
                    id: '',
                    text: 'All',
                };
            },

            getSelect2DefaultOptions: function getSelect2DefaultOptions() {
                var self = this;

                return jQuery.extend( elementor.modules.controls.Select2.prototype.getSelect2DefaultOptions.apply( this, arguments ), {
                    ajax: {
                        transport: function transport( params, success, failure ) {
                            var data = {
                                q           : params.data.q,
                                query_type  : self.model.get('query_type'),
                                object_type : self.model.get('object_type'),
                            };

                            return elementorCommon.ajax.addRequest('jltma_query_control_filter_autocomplete', {
                                data    : data,
                                success : success,
                                error   : failure,
                            });
                        },
                        data: function data( params ) {
                            return {
                                q    : params.term,
                                page : params.page,
                            };
                        },
                        cache: true
                    },
                    escapeMarkup: function escapeMarkup(markup) {
                        return markup;
                    },
                    minimumInputLength: 1
                });
            },

            getValueTitles: function getValueTitles() {
                var self        = this,
                    ids         = this.getControlValue(),
                    queryType   = this.model.get('query_type');
                    objectType  = this.model.get('object_type');

                if ( ! ids || ! queryType ) return;

                if ( ! _.isArray( ids ) ) {
                    ids = [ ids ];
                }

                elementorCommon.ajax.loadObjects({
                    action  : 'jltma_query_control_value_titles',
                    ids     : ids,
                    data    : {
                        query_type  : queryType,
                        object_type : objectType,
                        unique_id   : '' + self.cid + queryType,
                    },
                    success: function success(data) {
                        self.isTitlesReceived = true;
                        self.model.set('options', data);
                        self.render();
                    },
                    before: function before() {
                        self.addSpinner();
                    },
                });
            },

            addSpinner: function addSpinner() {
                this.ui.select.prop('disabled', true);
                this.$el.find('.elementor-control-title').after('<span class="elementor-control-spinner ee-control-spinner">&nbsp;<i class="fa fa-spinner fa-spin"></i>&nbsp;</span>');
            },

            onReady: function onReady() {
                setTimeout( elementor.modules.controls.Select2.prototype.onReady.bind(this) );

                if ( ! this.isTitlesReceived ) {
                    this.getValueTitles();
                }
            }

        } );

        elementor.addControlView( 'jltma_query', JLTMA_ControlQuery );
	} );

    !function(t){t(document).ready(function(){"jltma_custom_bp_data"in window&&t("#custom_breakpoints_page").length&&new Vue({el:"#custom_breakpoints_page",data:{show_pro_message:!1,disable_add_breakpoint:!1,default_devices:["desktop","tablet","mobile"],breakpoints:[]},computed:{total_custom_breakpoints(){return this.breakpoints.filter(function(t){return!this.in_array(t.key,this.default_devices)}.bind(this)).length},sorted_breakpoints(){var t;return t=(t=(t=this.breakpoints.map(function(t,e){return"max"in t&&(t.max=Number(t.max)),t})).sort(function(t,e){return"desktop"==e.key?-1:t.max<e.max?-1:1})).map(function(e,i){var a=t[i-1];return e.min=a?a.max+1:0,e.max>0&&e.max<=e.min&&(e.max=e.min+1),e})}},mounted(){this.isPro=!!jltma_custom_bp_data.is_pro,this.breakpoints=window.jltma_custom_bp_data.breakpoints.map(function(t,e){return t.isRecent=!1,t}),this.form_submits()},methods:{in_array:(t,e)=>e.indexOf(t)>-1,breakpoint_limit_checker(){return!this.isPro&&(this.total_custom_breakpoints>1?(this.show_pro_message=!0,this.disable_add_breakpoint=!0,!0):(this.show_pro_message=!1,this.disable_add_breakpoint=!1,!1))},input_focused(t){this.breakpoints.forEach(function(t){this.$set(t,"isRecent",!1)}.bind(this)),this.$set(t,"isRecent",!0)},add_breakpoint(){var t=this;if(!this.breakpoint_limit_checker()){this.breakpoints.forEach(function(e){t.$set(e,"isRecent",!1)});var e={key:Math.random().toString(36).substr(2,9),name:"Test",min:0,max:0,isDraft:!0,isRecent:!0};this.$set(this.breakpoints,this.breakpoints.length,e)}},remove_breakpoint(t){var e=this.breakpoints.findIndex(function(e){return e.key==t});this.breakpoints.splice(e,1),this.breakpoint_limit_checker()},breakpoint_update(t,e){e.max=Number(t.target.value)},get_form_data(){return this.breakpoints.filter(function(t){return!this.in_array(t.key,this.default_devices)}.bind(this)).map(function(t){return{label:t.name,default_value:t.max,direction:"max"}}.bind(this))},form_submits(){this.form_submit_import_breakpoints(),this.form_submit_reset_form(),this.form_submit_save_breakpoints()},form_submit_import_breakpoints(){jQuery("#elementor_settings_import_form").on("submit",function(t){t.preventDefault();var e=new FormData(jQuery(this)[0]);return jQuery.ajax({url:masteraddons.ajaxurl,type:"POST",data:e,dataType:"json",async:!0,cache:!1,contentType:!1,enctype:"multipart/form-data",processData:!1,success:function(t){"ok"==t&&(jQuery("#elementor_import_success").slideDown(),setTimeout(function(){window.location.reload()},1e3))}}),!1})},form_submit_reset_form(){jQuery("#elementor_settings_reset_form").on("submit",function(e){e.preventDefault();new FormData(jQuery(this)[0]);var i=t("#reset_form").val();return jQuery.ajax({url:masteraddons.ajaxurl,type:"POST",data:{security:i,action:"jltma_mcb_reset_settings"},dataType:"json",async:!0,cache:!1,success:function(t){"ok"==t&&(jQuery("#reset_success").slideDown(),setTimeout(function(){window.location.reload()},1e3))}}),!1})},form_submit_save_breakpoints(){var e=this;jQuery("#jlmta-cbp-form").on("submit",function(i){i.preventDefault();var a=t(this);a.addClass("loading"),t.ajax({url:masteraddons.ajaxurl,method:"POST",data:{form_fields:e.get_form_data(),security:t("#breakpoints_form").val(),action:"jltma_mcb_save_settings"},success:function(t){a.prepend('<div class="updated"><p>Saved Breakpoints</p></div>'),setTimeout(function(){a.removeClass("loading"),a.find(".updated").remove()},700)},error:function(t){console.log("failed",t)}})})}}})})}(jQuery);

})(jQuery, window, document);
