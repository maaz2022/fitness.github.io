! function(e) {
    "use strict";
    var t, a, o, n, i = window.MasterAddonsData || {};
    a = {
        ModalLayoutView: null,
        ModalHeaderView: null,
        ModalHeaderInsertButton: null,
        ModalLoadingView: null,
        ModalBodyView: null,
        ModalErrorView: null,
        LibraryCollection: null,
        KeywordsModel: null,
        ModalCollectionView: null,
        ModalTabsCollection: null,
        ModalTabsCollectionView: null,
        FiltersCollectionView: null,
        FiltersItemView: null,
        ModalTabsItemView: null,
        ModalTemplateItemView: null,
        ModalInsertTemplateBehavior: null,
        ModalTemplateModel: null,
        CategoriesCollection: null,
        ModalPreviewView: null,
        ModalHeaderBack: null,
        ModalHeaderLogo: null,
        MasterProButton: null,
        KeywordsView: null,
        TabModel: null,
        CategoryModel: null,
        init: function() {
            var a = this;
            a.ModalTemplateModel = Backbone.Model.extend({
                defaults: {
                    template_id: 0,
                    name: "",
                    title: "",
                    thumbnail: "",
                    preview: "",
                    source: "",
                    categories: [],
                    keywords: [],
                    liveUrl: "",
                    package: ""
                }
            }), a.ModalHeaderView = Marionette.LayoutView.extend({
                id: "ma-el-template-modal-header",
                template: "#views-ma-el-template-modal-header",
                ui: {
                    closeModal: "#ma-el-template-modal-header-close-modal"
                },
                events: {
                    "click @ui.closeModal": "onCloseModalClick"
                },
                regions: {
                    headerLogo: "#ma-el-template-modal-header-logo-area",
                    headerTabs: "#ma-el-template-modal-header-tabs",
                    headerActions: "#ma-el-template-modal-header-actions"
                },
                onCloseModalClick: function() {
                    t.closeModal()
                }
            }), a.TabModel = Backbone.Model.extend({
                defaults: {
                    slug: "",
                    title: ""
                }
            }), a.LibraryCollection = Backbone.Collection.extend({
                model: a.ModalTemplateModel
            }), a.ModalTabsCollection = Backbone.Collection.extend({
                model: a.TabModel
            }), a.CategoryModel = Backbone.Model.extend({
                defaults: {
                    slug: "",
                    title: ""
                }
            }), a.KeywordsModel = Backbone.Model.extend({
                defaults: {
                    keywords: {}
                }
            }), a.CategoriesCollection = Backbone.Collection.extend({
                model: a.CategoryModel
            }), a.KeywordsView = Marionette.ItemView.extend({
                id: "elementor-template-library-filter",
                template: "#views-ma-el-template-modal-keywords",
                ui: {
                    keywords: ".ma-el-library-keywords"
                },
                events: {
                    "change @ui.keywords": "onSelectKeyword"
                },
                onSelectKeyword: function(e) {
                    var a = e.currentTarget.selectedOptions[0].value;
                    t.setFilter("keyword", a)
                },
                onRender: function() {
                    this.$(".ma-el-library-keywords").select2({
                        placeholder: "Choose a Widget",
                        allowClear: !0,
                        width: 260
                    })
                }
            }), a.ModalPreviewView = Marionette.ItemView.extend({
                template: "#views-ma-el-template-modal-preview",
                id: "ma-el-item-preview-wrap",
                ui: {
                    iframe: "iframe",
                    notice: ".ma-el-item-notice"
                },
                onRender: function() {
                    if (null !== this.getOption("notice") && this.getOption("notice").length) {
                        var e = ""; - 1 !== this.getOption("notice").indexOf("facebook") ? e += "<p>Please login with your Facebook account in order to get your Facebook Reviews.</p>" : -1 !== this.getOption("notice").indexOf("google") ? e += "<p>You need to add your Google API key from Dashboard -> Master Addons for Elementor -> Google Maps</p>" : -1 !== this.getOption("notice").indexOf("form") && (e += "<p>You need to have <a href='https://wordpress.org/plugins/contact-form-7/' target='_blank'>Contact Form 7 plugin</a> installed and active.</p>"), this.ui.notice.html("<div><p><strong>Important!</strong></p>" + e + "</div>")
                    }
                    this.ui.iframe.attr("src", this.getOption("url"))
                }
            }), a.ModalHeaderBack = Marionette.ItemView.extend({
                template: "#views-ma-el-template-modal-header-back",
                id: "ma-el-template-modal-header-back",
                ui: {
                    button: "button"
                },
                events: {
                    "click @ui.button": "onBackClick"
                },
                onBackClick: function() {
                    t.setPreview("back")
                }
            }), a.ModalHeaderLogo = Marionette.ItemView.extend({
                template: "#views-ma-el-template-modal-header-logo",
                id: "ma-el-template-modal-header-logo"
            }), a.ModalBodyView = Marionette.LayoutView.extend({
                template: "#views-ma-el-template-modal-content",
                id: "ma-el-template-library-content",
                className: function() {
                    return "library-tab-" + t.getTab()
                },
                regions: {
                    contentTemplates: ".ma-el-templates-list",
                    contentFilters: ".ma-el-filters-list",
                    contentKeywords: ".ma-el-keywords-list"
                }
            }), a.LibraryLoadingView = Marionette.ItemView.extend({
                id: "ma-el-modal-template-library-loading",
                template: "#views-ma-el-template-modal-loading"
            }), a.LibraryErrorView = Marionette.ItemView.extend({
                id: "ma-el-modal-template-error",
                template: "#views-ma-el-template-modal-error"
            }), a.ModalInsertTemplateBehavior = Marionette.Behavior.extend({
                ui: {
                    insertButton: ".ma-el-template-insert"
                },
                events: {
                    "click @ui.insertButton": "onInsertButtonClick"
                },
                onInsertButtonClick: function() {
                    var a = this.view.model,
                        o = a.attributes.dependencies,
                        n = a.attributes.pro,
                        l = Object.keys(o).length,
                        r = {};
                    if (t.layout.showLoadingView(), 0 < l)
                        for (var s in o) e.ajax({
                            url: ajaxurl,
                            type: "post",
                            dataType: "json",
                            data: {
                                action  : "jltma_inner_template",
                                security: MasterAddonsData.insert_template_nonce,
                                template: o[s],
                                tab     : t.getTab()
                            }
                        });
                    "valid" !== i.license.status && n ? t.layout.showLicenseError() : elementor.templates.requestTemplateContent(a.get("source"), a.get("template_id"), {
                        data: {
                            tab: t.getTab(),
                            page_settings: !1
                        },
                        success: function(e) {
                            e.license ? (console.log("%c Template Inserted Successfully!!", "color: #7a7a7a; background-color: #eee;"), t.closeModal(), elementor.channels.data.trigger("$e.run( 'document/import' )", a), null !== t.atIndex && (r.at = t.atIndex), elementor.config.version < "3.0.0" ? elementor.sections.currentView.addChildModel(e.content, r) : elementor.previewView.addChildModel(e.content, r), elementor.channels.data.trigger("template:after:insert", a), t.atIndex = null) : t.layout.showLicenseError()
                        },
                        error: function(e) {
                            console.log(e)
                        }
                    })
                }
            }), a.ModalHeaderInsertButton = Marionette.ItemView.extend({
                template: "#views-ma-el-template-modal-insert-button",
                id: "ma-el-template-modal-insert-button",
                behaviors: {
                    insertTemplate: {
                        behaviorClass: a.ModalInsertTemplateBehavior
                    }
                }
            }), a.MasterProButton = Marionette.ItemView.extend({
                template: "#views-ma-el-template-pro-button",
                id: "ma-el-modal-template-pro-button"
            }), a.ModalTemplateItemView = Marionette.ItemView.extend({
                template: "#views-ma-el-template-modal-item",
                className: function() {
                    var e = " ma-el-modal-template-has-url",
                        t = "";
                    return "" === this.model.get("preview") && (e = " ma-el-modal-template-no-url"), this.model.get("pro") && "valid" != i.license.status && (t = " ma-el-modal-template-pro"), "elementor-template-library-template elementor-template-library-template-remote" + e + t
                },
                ui: function() {
                    return {
                        previewButton: ".elementor-template-library-template-preview"
                    }
                },
                events: function() {
                    return {
                        "click @ui.previewButton": "onPreviewButtonClick"
                    }
                },
                onPreviewButtonClick: function() {
                    "" !== this.model.get("url") && t.setPreview(this.model)
                },
                behaviors: {
                    insertTemplate: {
                        behaviorClass: a.ModalInsertTemplateBehavior
                    }
                }
            }), a.FiltersItemView = Marionette.ItemView.extend({
                template: "#views-ma-el-template-modal-filters-item",
                className: function() {
                    return "ma-el-modal-template-filter-item"
                },
                ui: function() {
                    return {
                        filterLabels: ".ma-el-modal-template-filter-label"
                    }
                },
                events: function() {
                    return {
                        "click @ui.filterLabels": "onFilterClick"
                    }
                },
                onFilterClick: function(e) {
                    var a = jQuery(e.target);
                    jQuery(".ma-el-library-keywords").val(""), t.setFilter("category", a.val()), t.setFilter("keyword", "")
                }
            }), a.ModalTabsItemView = Marionette.ItemView.extend({
                template: "#views-ma-el-template-modal-tabs-item",
                className: function() {
                    return "elementor-template-library-menu-item"
                },
                ui: function() {
                    return {
                        tabsLabels: "label",
                        tabsInput: "input"
                    }
                },
                events: function() {
                    return {
                        "click @ui.tabsLabels": "onTabClick"
                    }
                },
                onRender: function() {
                    this.model.get("slug") === t.getTab() && this.ui.tabsInput.attr("checked", "checked")
                },
                onTabClick: function(e) {
                    var a = jQuery(e.target);
                    t.setTab(a.val()), t.setFilter("keyword", "")
                }
            }), a.FiltersCollectionView = Marionette.CompositeView.extend({
                id: "ma-el-modal-template-library-filters",
                template: "#views-ma-el-template-modal-filters",
                childViewContainer: "#ma-el-modal-filters-container",
                getChildView: function(e) {
                    return a.FiltersItemView
                }
            }), a.ModalTabsCollectionView = Marionette.CompositeView.extend({
                template: "#views-ma-el-template-modal-tabs",
                childViewContainer: "#views-ma-el-template-modal-tabs-items",
                initialize: function() {
                    this.listenTo(t.channels.layout, "tamplate:cloned", this._renderChildren)
                },
                getChildView: function(e) {
                    return a.ModalTabsItemView
                }
            }), a.ModalCollectionView = Marionette.CompositeView.extend({
                template: "#views-ma-el-template-modal-templates",
                id: "ma-el-modal-template-library-templates",
                childViewContainer: "#ma-el-modal-templates-container",
                initialize: function() {
                    this.listenTo(t.channels.templates, "filter:change", this._renderChildren)
                },
                filter: function(e) {
                    var a = t.getFilter("category"),
                        o = t.getFilter("keyword");
                    return !a && !o || (o && !a ? _.contains(e.get("keywords"), o) : a && !o ? _.contains(e.get("categories"), a) : _.contains(e.get("categories"), a) && _.contains(e.get("keywords"), o))
                },
                getChildView: function(e) {
                    return a.ModalTemplateItemView
                },
                onRenderCollection: function() {
                    var e = this.$childViewContainer,
                        o = this.$childViewContainer.children(),
                        n = t.getTab();
                    "master_page" !== n && "local" !== n && e.imagesLoaded(function() {}).done(function() {
                        setTimeout(function() {
                            a.masonry.init({
                                container: e,
                                items: o
                            })
                        }, 200)
                    })
                }
            }), a.ModalLoadingView = Marionette.ItemView.extend({
                id: "ma-el-modal-loading",
                template: "#views-ma-el-template-modal-loading"
            }), a.ModalErrorView = Marionette.ItemView.extend({
                id: "ma-el-modal-loading",
                template: "#views-ma-el-template-modal-error"
            }), a.ModalLayoutView = Marionette.LayoutView.extend({
                el: "#ma-el-modal-template",
                regions: i.modalRegions,
                initialize: function() {
                    this.getRegion("modalHeader").show(new a.ModalHeaderView), this.listenTo(t.channels.tabs, "filter:change", this.switchTabs), this.listenTo(t.channels.layout, "preview:change", this.switchPreview)
                },
                switchTabs: function() {
                    this.showLoadingView(), t.setFilter("keyword", ""), t.requestTemplates(t.getTab())
                },
                switchPreview: function() {
                    var e = this.getHeaderView(),
                        o = t.getPreview(),
                        n = t.getFilter("category"),
                        i = t.getFilter("keyword");
                    return "back" === o ? (e.headerLogo.show(new a.ModalHeaderLogo), e.headerTabs.show(new a.ModalTabsCollectionView({
                        collection: t.collections.tabs
                    })), e.headerActions.empty(), t.setTab(t.getTab()), "" != n && (t.setFilter("category", n), jQuery("#ma-el-modal-filters-container").find("input[value='" + n + "']").prop("checked", !0)), void("" != i && t.setFilter("keyword", i))) : "initial" === o ? (e.headerActions.empty(), void e.headerLogo.show(new a.ModalHeaderLogo)) : (this.getRegion("modalContent").show(new a.ModalPreviewView({
                        preview: o.get("preview"),
                        url: o.get("url"),
                        notice: o.get("notice")
                    })), e.headerLogo.empty(), e.headerTabs.show(new a.ModalHeaderBack), void e.headerActions.show(new a.ModalHeaderInsertButton({
                        model: o
                    })))
                },
                getHeaderView: function() {
                    return this.getRegion("modalHeader").currentView
                },
                getContentView: function() {
                    return this.getRegion("modalContent").currentView
                },
                showLoadingView: function() {
                    this.modalContent.show(new a.ModalLoadingView)
                },
                showLicenseError: function() {
                    this.modalContent.show(new a.ModalErrorView)
                },
                showTemplatesView: function(e, o, n) {
                    this.getRegion("modalContent").show(new a.ModalBodyView);
                    var i = this.getContentView(),
                        l = this.getHeaderView(),
                        r = new a.KeywordsModel({
                            keywords: n
                        });
                    t.collections.tabs = new a.ModalTabsCollection(t.getTabs()), l.headerTabs.show(new a.ModalTabsCollectionView({
                        collection: t.collections.tabs
                    })), i.contentTemplates.show(new a.ModalCollectionView({
                        collection: e
                    })), i.contentFilters.show(new a.FiltersCollectionView({
                        collection: o
                    })), i.contentKeywords.show(new a.KeywordsView({
                        model: r
                    }))
                }
            })
        },
        masonry: {
            self: {},
            elements: {},
            init: function(t) {
                var a = this;
                a.settings = e.extend(a.getDefaultSettings(), t), a.elements = a.getDefaultElements(), a.run()
            },
            getSettings: function(e) {
                return e ? this.settings[e] : this.settings
            },
            getDefaultSettings: function() {
                return {
                    container: null,
                    items: null,
                    columnsCount: 3,
                    verticalSpaceBetween: 30
                }
            },
            getDefaultElements: function() {
                return {
                    $container: jQuery(this.getSettings("container")),
                    $items: jQuery(this.getSettings("items"))
                }
            },
            run: function() {
                var e = [],
                    t = this.elements.$container.position().top,
                    a = this.getSettings(),
                    o = a.columnsCount;
                t += parseInt(this.elements.$container.css("margin-top"), 10), this.elements.$container.height(""), this.elements.$items.each(function(n) {
                    var i = Math.floor(n / o),
                        l = n % o,
                        r = jQuery(this),
                        s = r.position(),
                        d = r[0].getBoundingClientRect().height + a.verticalSpaceBetween;
                    if (i) {
                        var m = s.top - t - e[l];
                        m -= parseInt(r.css("margin-top"), 10), m *= -1, r.css("margin-top", m + "px"), e[l] += d
                    } else e.push(d)
                }), this.elements.$container.height(Math.max.apply(Math, e))
            }
        }
    }, t = {
        modal: !(n = {
            getDataToSave: function(e) {
                return e.id = window.elementor.config.post_id, e
            },
            init: function() {
                window.elementor.settings.master_template && (window.elementor.settings.master_template.getDataToSave = this.getDataToSave), window.elementor.settings.master_page && (window.elementor.settings.master_page.getDataToSave = this.getDataToSave, window.elementor.settings.master_page.changeCallbacks = {
                    custom_header: function() {
                        this.save(function() {
                            elementor.reloadPreview(), elementor.once("preview:loaded", function() {
                                elementor.getPanelView().setPage("master_page_settings")
                            })
                        })
                    },
                    custom_footer: function() {
                        this.save(function() {
                            elementor.reloadPreview(), elementor.once("preview:loaded", function() {
                                elementor.getPanelView().setPage("master_page_settings")
                            })
                        })
                    }
                })
            }
        }),
        layout: !(o = {
            MasterSearchView: null,
            init: function() {
                this.MasterSearchView = window.elementor.modules.controls.BaseData.extend({
                    onReady: function() {
                        var t = this.model.attributes.action,
                            a = this.model.attributes.query_params;
                        this.ui.select.find("option").each(function(t, a) {
                            e(this).attr("selected", !0)
                        }), this.ui.select.select2({
                            ajax: {
                                url: function() {
                                    var o = "";
                                    return 0 < a.length && e.each(a, function(e, t) {
                                        window.elementor.settings.page.model.attributes[t] && (o += "&" + t + "=" + window.elementor.settings.page.model.attributes[t])
                                    }), ajaxurl + "?action=" + t + o
                                },
                                dataType: "json"
                            },
                            placeholder: "Please enter 3 or more characters",
                            minimumInputLength: 3
                        })
                    },
                    onBeforeDestroy: function() {
                        this.ui.select.data("select2") && this.ui.select.select2("destroy"), this.$el.remove()
                    }
                }), window.elementor.addControlView("master_search", this.MasterSearchView)
            }
        }),
        collections: {},
        tabs: {},
        defaultTab: "",
        channels: {},
        atIndex: null,
        init: function() {
            window.elementor.on("preview:loaded", window._.bind(t.onPreviewLoaded, t)), a.init(), o.init(), n.init()
        },
        onPreviewLoaded: function() {
            let e = setInterval(() => {
                window.elementor.$previewContents.find(".elementor-add-new-section").length && (this.initMasterTempsButton(), clearInterval(e))
            }, 100);
            window.elementor.$previewContents.on("click.addMasterTemplate", ".ma-el-add-section-btn", _.bind(this.showTemplatesModal, this)), this.channels = {
                templates: Backbone.Radio.channel("MASTER_EDITOR:templates"),
                tabs: Backbone.Radio.channel("MASTER_EDITOR:tabs"),
                layout: Backbone.Radio.channel("MASTER_EDITOR:layout")
            }, this.tabs = i.tabs, this.defaultTab = i.defaultTab
        },
        initMasterTempsButton: function() {
            var a = window.elementor.$previewContents.find(".elementor-add-new-section"),
                o = '<div class="elementor-add-section-area-button ma-el-add-section-btn"><div class="jltma-editor-icon"></div></div>';
            a.length && i.MasterAddonsEditorBtn && e(o).prependTo(a), window.elementor.$previewContents.on("click.addMasterTemplate", ".elementor-editor-section-settings .elementor-editor-element-add", function() {
                var a = e(this).closest(".elementor-top-section"),
                    n = a.data("model-cid");
                elementor.config.version < "3.0.0" ? window.elementor.sections.currentView.collection.length && e.each(window.elementor.sections.currentView.collection.models, function(e, a) {
                    n === a.cid && (t.atIndex = e)
                }) : elementor.previewView.collection.length && e.each(elementor.previewView.collection.models, function(e, a) {
                    n === a.cid && (t.atIndex = e)
                }), i.MasterAddonsEditorBtn && a.prev(".elementor-add-section").find(".elementor-add-new-section").prepend(o)
            })
        },
        getFilter: function(e) {
            return this.channels.templates.request("filter:" + e)
        },
        setFilter: function(e, t) {
            this.channels.templates.reply("filter:" + e, t), this.channels.templates.trigger("filter:change")
        },
        getTab: function() {
            return this.channels.tabs.request("filter:tabs")
        },
        setTab: function(e, t) {
            this.channels.tabs.reply("filter:tabs", e), t || this.channels.tabs.trigger("filter:change")
        },
        getTabs: function() {
            var e = [];
            return _.each(this.tabs, function(t, a) {
                e.push({
                    slug: a,
                    title: t.title
                })
            }), e
        },
        getPreview: function(e) {
            return this.channels.layout.request("preview")
        },
        setPreview: function(e, t) {
            this.channels.layout.reply("preview", e), t || this.channels.layout.trigger("preview:change")
        },
        getKeywords: function() {
            return _.each(this.keywords, function(e, t) {
                tabs.push({
                    slug: t,
                    title: e
                })
            }), []
        },
        showTemplatesModal: function() {
            this.getModal().show(), this.layout || (this.layout = new a.ModalLayoutView, this.layout.showLoadingView()), this.setTab(this.defaultTab, !0), this.requestTemplates(this.defaultTab), this.setPreview("initial")
        },
        requestTemplates: function(t) {
            var o = this,
                n = o.tabs[t];
            o.setFilter("category", !1), n.data.templates && n.data.categories ? o.layout.showTemplatesView(n.data.templates, n.data.categories, n.data.keywords) : e.ajax({
                url: ajaxurl,
                type: "get",
                dataType: "json",
                data: {
                    action: "jltma_get_templates",
                    security: MasterAddonsData.get_templates_nonce,
                    tab: t
                },
                success: function(e) {
                    var n = new a.LibraryCollection(e.data.templates),
                        i = new a.CategoriesCollection(e.data.categories);
                    o.tabs[t].data = {
                        templates: n,
                        categories: i,
                        keywords: e.data.keywords
                    }, o.layout.showTemplatesView(n, i, e.data.keywords)
                }
            })
        },
        closeModal: function() {
            this.getModal().hide()
        },
        getModal: function() {
            return this.modal || (this.modal = elementor.dialogsManager.createWidget("lightbox", {
                id: "ma-el-modal-template",
                className: "elementor-templates-modal",
                closeButton: !1
            })), this.modal
        }
    }, e(window).on("elementor:init", t.init)
}(jQuery);
