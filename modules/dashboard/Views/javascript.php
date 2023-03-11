<script>
    var chartRekap;
    var chartBS;
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
        // console.log(name);

        HELPER.api = {
            index: BASE_URL + 'dashboard',
            loadChartBS: BASE_URL + 'dashboard/loadChartBS',
            // store: BASE_URL + 'master_menu/store',
            // update: BASE_URL + 'master_menu/update',
            // destroy: BASE_URL + 'master_menu/destroy',
            // loadJenisMenu: BASE_URL + 'master_menu/loadJenis',
        };

        loadChartRekap()
        loadChartBS()
    })
    filterChartRekap = () => {
        chartRekap.destroy()
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
                $('#displayHai').html('Hai, '+response.dName)
                var xValues = [];
                var yValues = [];
                for (let i = 0; i < response.data.length; i++) {
                    xValues.push(response.data[i].transaksi_date);
                    yValues.push(response.data[i].total);
                }
                // console.log(response);
                $('#chartSales').html('')
                chartRekap = new Chart("chartSales", {
                    type: "line",
                    data: {
                        labels: xValues,
                        datasets: [{
                            fill: false,
                            lineTension: 0,
                            label: "Pendapatan Harian",
                            backgroundColor: "rgba(0,0,255,1.0)",
                            borderColor: "rgba(0,0,255,0.1)",
                            data: yValues
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: "World Wine Production 2018"
                        },
                        //     scales: {
                        //         yAxes: [{
                        //             ticks: {
                        //                 min: 6,
                        //                 max: 16
                        //             }
                        //         }],
                        //     }
                    }

                });
                // myLineChart.destroy();
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

    loadChartBS = (data = null) => {

        $.ajax({
            url: HELPER.api.loadChartBS,
            method: 'POST',
            data: {
                date: data
            },
            success: function(response) {
                var response = $.parseJSON(response)
                var xValues = [];
                var yValues = [];
                for (let i = 0; i < response.length; i++) {
                    xValues.push(response[i].master_menu_nama);
                    yValues.push(response[i].total);
                }
                console.log(response);
                $('#chartBS').html('')
                chartBS = new Chart("chartBS", {
                    type: "bar",
                    data: {
                        labels: xValues,
                        datasets: [{
                            fill: false,
                            lineTension: 0,
                            label: "Total Penjualan Menu",
                            backgroundColor: "rgba(0,0,255,1.0)",
                            borderColor: "rgba(0,0,255,0.1)",
                            data: yValues
                        }]
                    },
                    options: {
                        scales: {
                            // yAxes: [{
                            //     ticks: {
                            //         min: 6,
                            //         max: 16
                            //     }
                            // }],
                            xAxes: [{
                                barPercentage: 0.2
                            }]
                        }
                    }

                });
                // myLineChart.destroy();
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