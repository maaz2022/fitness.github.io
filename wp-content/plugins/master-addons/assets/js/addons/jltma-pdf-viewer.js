! function(e, t) {
    "function" == typeof define && define.amd ? define([], t) : "object" == typeof module && module.exports ? module.exports = t() : e.PDFObject = t()
}(this, function() {
    "use strict";
    if ("undefined" == typeof window || "undefined" == typeof navigator) return !1;
    var e, t, o, n, i, r, d, a, f, s, p = window.navigator.userAgent,
        c = void 0 !== navigator.mimeTypes && void 0 !== navigator.mimeTypes["application/pdf"],
        l = void 0 !== window.Promise,
        u = -1 !== p.indexOf("irefox") && 18 < parseInt(p.split("rv:")[1].split(".")[0], 10),
        m = /iphone|ipad|ipod/i.test(p.toLowerCase());
    return o = function(e) {
        var t;
        try {
            t = new ActiveXObject(e)
        } catch (e) {
            t = null
        }
        return t
    }, t = function() {
        return !(!o("AcroPDF.PDF") && !o("PDF.PdfCtrl"))
    }, e = !m && (u || c || !!(window.ActiveXObject || "ActiveXObject" in window) && t()), n = function(e) {
        var t, o = "";
        if (e) {
            for (t in e) e.hasOwnProperty(t) && (o += encodeURIComponent(t) + "=" + encodeURIComponent(e[t]) + "&");
            o = o && (o = "#" + o).slice(0, o.length - 1)
        }
        return o
    }, i = function(e) {
        "undefined" != typeof console && console.log && console.log("[PDFObject] " + e)
    }, r = function(e) {
        return i(e), !1
    }, a = function(e) {
        var t = document.body;
        return "string" == typeof e ? t = document.querySelector(e) : "undefined" != typeof jQuery && e instanceof jQuery && e.length ? t = e.get(0) : void 0 !== e.nodeType && 1 === e.nodeType && (t = e), t
    }, f = function(e, t, o, n, i) {
        var r = n + "?file=" + encodeURIComponent(t) + o,
            d = "<div style='" + (m ? "-webkit-overflow-scrolling: touch; overflow-y: scroll; " : "overflow: hidden; ") + "position: absolute; top: 0; right: 0; bottom: 0; left: 0;'><iframe  " + i + " src='" + r + "' style='border: none; width: 100%; height: 100%;' frameborder='0'></iframe></div>";
        return e.className += " pdfobject-container", e.style.position = "relative", e.style.overflow = "auto", e.innerHTML = d, e.getElementsByTagName("iframe")[0]
    }, s = function(e, t, o, n, i, r, d) {
        var a;
        return a = t && t !== document.body ? "width: " + i + "; height: " + r + ";" : "position: absolute; top: 0; right: 0; bottom: 0; left: 0; width: 100%; height: 100%;", e.className += " pdfobject-container", e.innerHTML = "<embed " + d + " class='pdfobject' src='" + o + n + "' type='application/pdf' style='overflow: auto; " + a + "'/>", e.getElementsByTagName("embed")[0]
    }, d = function(t, o, i) {
        if ("string" != typeof t) return r("URL is not valid");
        o = void 0 !== o && o;
        var d, p = (i = void 0 !== i ? i : {}).id && "string" == typeof i.id ? "id='" + i.id + "'" : "",
            c = !!i.page && i.page,
            u = i.pdfOpenParams ? i.pdfOpenParams : {},
            v = void 0 === i.fallbackLink || i.fallbackLink,
            w = i.width ? i.width : "100%",
            y = i.height ? i.height : "100%",
            b = "boolean" != typeof i.assumptionMode || i.assumptionMode,
            g = "boolean" == typeof i.forcePDFJS && i.forcePDFJS,
            h = !!i.PDFJS_URL && i.PDFJS_URL,
            P = a(o),
            D = "";
        return P ? (c && (u.page = c), d = n(u), g && h ? f(P, t, d, h, p) : e || b && l && !m ? s(P, o, t, d, w, y, p) : h ? f(P, t, d, h, p) : (v && (D = "string" == typeof v ? v : "<p>This browser does not support inline PDFs. Please download the PDF to view it: <a href='[url]'>Download PDF</a></p>", P.innerHTML = D.replace(/\[url\]/g, t)), r("This browser does not support embedded PDFs"))) : r("Target element cannot be determined")
    }, {
        embed: function(e, t, o) {
            return d(e, t, o)
        },
        pdfobjectversion: "2.1.1",
        supportsPDFs: e
    }
}),
function(e) {
    "use strict";
    e(window).on("elementor/frontend/init", function() {
        elementorFrontend.hooks.addAction("frontend/element_ready/jltma-pdf-viewer.default", function(e) {
            var t = e.find(".jltma-pdf-viewer"),
                o = '<div class="jltma-pdf-viewer-msg" style="width:100%;"><a href="' + t.data("pdfurl") + '">' + t.data("fallbackmsg") + "</a></div>";
            PDFObject.supportsPDFs ? PDFObject.embed(t.data("pdfurl"), t) : e.find(".jltma-pdf-viewer").append(o)
        })
    })
}(jQuery);
