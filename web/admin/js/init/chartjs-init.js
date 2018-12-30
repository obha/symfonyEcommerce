
$(document).ready(function () {
    //Sales chart
    var ctx = document.getElementById("sales-chart");


    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/admin/dashboard/chart",
        data: "data",
        dataType: "json",
    }).done(function (res) {

        var _lb = [];
        var _dst = [];

        for (var key in res) {
            _lb.push(res[key].libelle)
            _dst.push(res[key].qte)
        }

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: _lb,
                datasets: [{
                    data: _dst,
                    label: "Sold",
                    borderColor: "#3e95cd",
                    fill: false
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            display: false
                        }
                    }]
                },
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'TOP 5 PRODUITS'
                }
            }
        });
    });
});