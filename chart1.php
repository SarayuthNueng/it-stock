<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Highcharts Example</title>

    <style type="text/css">
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 360px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>

</head>

<body>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <figure class="highcharts-figure">
        <div id="container"> </div>

    </figure>

    <?php
    //เชื่อมต่อฐานข้อมูล
    include "db/connect-db.php";
    //ให้แสดงผลภาษาไทยได้ โดยกำหนด charset เป็น utf-8
    mysqli_set_charset($conn, "utf8");

    $sql = "SELECT o_office,o_total FROM order_head";
    $result = mysqli_query($conn, $sql);

    $proName = array();
    $proNum = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $proName[] = $row['o_office'];
        $proNum[] = $row['o_total'];
    }
    ?>


    <script type="text/javascript">
        Highcharts.chart('container', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'กราฟแยกตามหน่วยงาน'
            },

            yAxis: {
                title: {
                    text: 'ราคารวม'
                }
            },

            xAxis: {
                categories: [<?php echo "'" . implode("','", $proName) . "'"; ?>]
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },



            series: [{
                name: 'ราคารวม',
                data: [<?php echo implode(",", $proNum); ?>]
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    </script>
</body>

</html>