! function(e) {
    "use strict";
    e(window).on("elementor/frontend/init", function() {
        elementorFrontend.hooks.addAction("frontend/element_ready/jltma-data-table.default", function(t) {
            var a = t.find(".jltma-data-table-container"),
                n = a.data("source"),
                r = a.data("sourcecsv");
            if (1 == a.data("buttons")) var l = "Bfrtip";
            else l = "frtip";
            if ("custom" == n) {
                var i = t.find("table thead tr th").length;
                t.find("table tbody tr").each(function() {
                    if (e(this).find("td").length < i) {
                        var t = i - e(this).find("td").length;
                        e(this).append(new Array(++t).join("<td></td>"))
                    }
                }), t.find(".jltma-data-table").DataTable({
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
                            n = t.element || e("#table-container"),
                            r = t.csv_options || {},
                            l = t.datatables_options || {},
                            i = t.custom_formatting || [],
                            s = {};
                        e.each(i, function(e, t) {
                            var a = t[0],
                                n = t[1];
                            s[a] = n
                        });
                        var d = e('<table class="jltma-data-table cell-border" style="width:100%;visibility:hidden;">');
                        n.empty().append(d), e.when(e.get(a)).then(function(t) {
                            for (var a = e.csv.toArrays(t, r), n = e("<thead></thead>"), i = a[0], o = e("<tr></tr>"), c = 0; c < i.length; c++) o.append(e("<th></th>").text(i[c]));
                            n.append(o), d.append(n);
                            for (var m = e("<tbody></tbody>"), p = 1; p < a.length; p++)
                                for (var _ = e("<tr></tr>"), g = 0; g < a[p].length; g++) {
                                    var b = e("<td></td>"),
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
            t.find(".jltma-data-table").css("visibility", "visible")
        })
    })
}(jQuery);
