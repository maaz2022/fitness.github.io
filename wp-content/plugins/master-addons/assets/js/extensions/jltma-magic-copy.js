!(function (e, t, n, o) {
    "use strict";
    var a = {
        init: function (e) {
            a.globalVars(), a.loadxdLocalStorage(), a.loadContextMenuGroupsHooks();
        },
        globalVars: function (t) {
            (e.mc_ajax_url = bdt_ep_magic_copy.ajax_url), (e.mc_ajax_nonce = bdt_ep_magic_copy.nonce), (e.mc_key = bdt_ep_magic_copy.magic_key);
        },
        loadxdLocalStorage: function () {
            xdLocalStorage.init({ iframeUrl: "https://elementpack.pro/eptools/magic/index.html", initCallback: function () {} });
        },
        loadContextMenuGroupsHooks: function () {
            elementor.hooks.addFilter("elements/section/contextMenuGroups", function (e, t) {
                return a.prepareMenuItem(e, t);
            }),
                elementor.hooks.addFilter("elements/widget/contextMenuGroups", function (e, t) {
                    return a.prepareMenuItem(e, t);
                }),
                elementor.hooks.addFilter("elements/column/contextMenuGroups", function (e, t) {
                    return a.prepareMenuItem(e, t);
                });
        },
        prepareMenuItem: function (e, t) {
            var n = _.findIndex(e, function (e) {
                return "clipboard" === e.name;
            });
            return (
                e.splice(n + 1, 0, {
                    name: "bdt-ep-live-paste",
                    actions: [
                        {
                            name: "ep-live-paste",
                            title: "Live Paste",
                            icon: "bdt-wi-element-pack",
                            callback: function () {
                                a.livePaste(t);
                            },
                        },
                    ],
                }),
                e
            );
        },
        livePaste: function (e) {
            return xdLocalStorage.getItem(mc_key, function (t) {
                const o = JSON.parse(t.value).widget,
                    a = JSON.stringify(o),
                    i = /\.(jpeg|jpg|png|gif|svg|)/gi.test(a),
                    r = e.model.get("elType");
                var c = { elType: "section", settings: o.settings },
                    l = { at: 0 };
                if ("column" === r) var s = e.getContainer().parent;
                else s = e.getContainer();
                var m = s.parent;
                (c.elements = o.elements), (l.at = s.view.getOption("_index") + 1), (c.isInner = !1);
                var p = $e.run("document/elements/create", { container: m, model: c, options: l });
                i &&
                    n
                        .ajax({
                            url: mc_ajax_url,
                            method: "POST",
                            data: { action: "ep_elementor_import_magic_copy_assets_files", data: a, security: mc_ajax_nonce },
                            beforeSend: function () {
                                p.view.$el.append('<div id="bdt-magic-copy-importing-images-loader">Importing Images..</div>');
                            },
                        })
                        .done(function (e) {
                            if (e.success) {
                                var t = e.data[0];
                                (c.settings = t.settings),
                                    (c.elType = t.elType),
                                    "widget" === t.elType ? (c.widgetType = t.widgetType) : (c.elements = t.elements),
                                    setTimeout(function () {
                                        $e.run("document/elements/delete", { container: p });
                                        $e.run("document/elements/create", { model: c, container: m, options: l });
                                    }, 800),
                                    n("#bdt-magic-copy-importing-images-loader").remove();
                            }
                        });
            });
        },
    };
    a.init();
})(window, document, jQuery, xdLocalStorage);
