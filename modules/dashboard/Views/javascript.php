<script>
    $(() => {
        // HELPER.fields = [
        //     'master_menu_id',
        // ];
        $('#filterRekap').daterangepicker({
            // "startDate": "",
            // "endDate": "",
            "opens": "center"
        }, function(start, end, label) {
            // console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
        });

        HELPER.api = {
            index: BASE_URL + 'dashboard',
            // edit: BASE_URL + 'master_menu/edit',
            // store: BASE_URL + 'master_menu/store',
            // update: BASE_URL + 'master_menu/update',
            // destroy: BASE_URL + 'master_menu/destroy',
            // loadJenisMenu: BASE_URL + 'master_menu/loadJenis',
        };

        loadChartRekap()
        // loadComboJenis()
    })
    filterChartRekap = () => {
        loadChartRekap($('#filterRekap').val())
    }
    loadChartRekap = (data = null) => {

        $.ajax({
            url: HELPER.api.index,
            method: 'POST',
            data: {
                date: data
            },
            success: function(response) {
                var response = $.parseJSON(response)
                console.log(response);

                am5.ready(function() {
                    // Create root element
                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                    var root = am5.Root.new("chartdiv");

                    // Set themes
                    // https://www.amcharts.com/docs/v5/concepts/themes/
                    root.setThemes([
                        am5themes_Animated.new(root)
                    ]);

                    // Create chart
                    // https://www.amcharts.com/docs/v5/charts/xy-chart/
                    var chart = root.container.children.push(am5xy.XYChart.new(root, {
                        panX: false,
                        panY: false,
                        wheelX: "panX",
                        wheelY: "zoomX"
                    }));

                    // Add cursor
                    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                        behavior: "zoomX"
                    }));
                    cursor.lineY.set("visible", false);

                    // Create axes
                    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                    var xAxis = chart.xAxes.push(
                        am5xy.CategoryAxis.new(root, {
                            categoryField: "transaksi_date",
                            renderer: am5xy.AxisRendererX.new(root, {})
                        })
                    );

                    xAxis.data.setAll(response);

                    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                        renderer: am5xy.AxisRendererY.new(root, {})
                    }));


                    // Add series
                    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                        name: "Total",
                        xAxis: xAxis,
                        yAxis: yAxis,
                        valueYField: "total",
                        valueXField: "transaksi_datetime",
                        tooltip: am5.Tooltip.new(root, {
                            labelText: "{valueY}"
                        })
                    }));

                    series.columns.template.setAll({
                        strokeOpacity: 0
                    })

                    // Add scrollbar
                    // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
                    chart.set("scrollbarX", am5.Scrollbar.new(root, {
                        orientation: "horizontal"
                    }));

                    // var data = generateDatas(50);
                    series.data.setAll(response);

                    // Make stuff animate on load
                    // https://www.amcharts.com/docs/v5/concepts/animations/
                    series.appear(1000);
                    chart.appear(1000, 100);
                }); // end am5.ready()
            },
            complete: function(response) {
                // setTimeout(function() {
                //     onAdd()
                // }, 200);
                HELPER.unblock(500);
            },
            error: (xhr, status, error) => {
                HELPER.unblock()
                HELPER.showMessage({
                    message: 'Kesalahan tidak diketahui. Hubungi Administrator Anda !!',
                })
            },
        });
    }
</script>