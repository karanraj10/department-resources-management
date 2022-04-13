<?php 
    //Check Login Status, prevent unwanted access
    session_start();
    if(!isset($_SESSION['logged_in'])){
        header("Location: index.html");
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootsrap CSS And JQuery Libs -->
    <link rel="stylesheet" href="css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/sidebarStyles.css">
    <link rel="stylesheet" href="./css/dashboardStyles.css">

</head>

<body>
    <div class="wrapper">

        <!-- Sidebar Navigation -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">

                <h4 class="sidebarTitle">Department Resources</h4>

                <ul class="sidebar-nav">
                    <li class="sidebar-item"><a class="sidebar-link active" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="section.php">Manage Section</a>
                    </li>
                    <li class="sidebar-item "><a class="sidebar-link" href="categories.php">Manage Categories</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="resources.php">Manage Resources</a></li>
                </ul>
            </div>
        </nav>
        <!-- End Of Sidebar Navigation -->

        <div class="main">

            <!-- Sidebar Navigation Hamburger Icon -->
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                    </ul>
                </div>
            </nav>
            <!-- End Of Sidebar Navigation Hamburger Icon -->

            <!-- Main Starts -->
            <main class="content p-4">
                <div class="container-fluid p-0">
                    <div class="row mb-2 mb-xl-3">

                        <!-- Add Categories Title -->
                        <div class="col-auto">
                            <h3 class="mainTitle">Dashboard</h3>
                        </div>

                        <div class="container">
                            <button class="btn btn-outline-primary addResourcenBtn"
                                onclick="location.href='report.php'"><i class="fa fa-file mr-3"></i>Genrate
                                Report</button>

                            <button class="btn btn-outline-primary addResourcenBtn" onclick="location.href='./php/logoutUser.php'"><i
                                    class="fa fa-sign-out mr-3"></i>Logout</button>
                        </div>

                        <div id="genralInfoList" class="row genralInfoList">
                            <div class="col-auto genralInfoCOl">
                                <div class="card">
                                    <div class="card-body">

                                        <h5 class="card-title infoStats" id="totalSection">3</h5>
                                        <h5 class="card-title infoTitle"><i class="fa fa-home mr-2"
                                                aria-hidden="true"></i>
                                            Section</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto genralInfoCOl">
                                <div class="card">
                                    <div class="card-body">

                                        <h5 class="card-title infoStats" id="totalCategory">15</h5>
                                        <h5 class="card-title infoTitle"><i class="fa fa-list-alt mr-2"
                                                aria-hidden="true"></i> Categories</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto genralInfoCOl">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title infoStats" id="totalResource">350</h5>
                                        <h5 class="card-title infoTitle"><i class="fa fa-desktop mr-2"
                                                aria-hidden="true"></i> Resources</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="genralInfoChart" class="row genralInfoChart">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h5 class="piechartTitle">Resources Per Category</h5>
                                        </div>
                                        <div class="card-text" id="piechart"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h5 class="piechartTitle">Resources Per Section</h5>
                                        </div>
                                        <div class="card-text" id="piechart1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="genralInfoChart" class="row genralInfoChart">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h5 class="piechartTitle">Remaining Slots Per Section</h5>
                                        </div>
                                        <div class="card-text" id="barchart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>

    <!-- Bootsrap And JQuery Libs -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
    <script src="js/app.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <script>
        google.charts.load('current', { 'packages': ['corechart'] });

        window.onload = function () {
            getChartData();
        }

        var catArray = new Array();
        var secArray = new Array();
        var remainArray = new Array();

        function getChartData() {
            var XRH = new XMLHttpRequest();
            XRH.open('GET', './php/getDashboard.php');

            XRH.onload = function () {
                obj = JSON.parse(this.responseText);
                var categoryObj = obj.categoryData;
                var sectionObj = obj.sectionData;
                var remainSlotObj = obj.sectionRemain;

                document.getElementById("totalResource").innerHTML = obj.totalResources;
                document.getElementById("totalSection").innerHTML = obj.totalSection;
                document.getElementById("totalCategory").innerHTML = obj.totalCategories;


                for (let cat of categoryObj) {
                    catArray.push([cat.category, Number(cat.resCategoryValues)]);
                }

                for (let sec of sectionObj) {
                    secArray.push([sec.section, Number(sec.resSectionValues)]);
                }

                for (let remSec of remainSlotObj) {
                    remainArray.push([remSec.sectionName, Number(remSec.sectionCapacity - remSec.sectionAllocated)]);
                }

                drawCategoryChart();
                drawSectionChart();
                drawRemainSlotChart();
            }
            XRH.send();
        }

        google.charts.setOnLoadCallback(drawCategoryChart);
        function drawCategoryChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Browser');
            data.addColumn('number', 'Percentage');
            data.addRows(catArray);

            // Optional; add a title and set the width and height of the chart
            var options = {
                width: '100%',
                height: 400,
                colors: ['#222831', '#30475E', '#F05454', '#D89216', '#F4ABC4'],
                tooltip: { textStyle: { fontName: 'TimesNewRoman', fontSize: 20, bold: false } },
                pieSliceTextStyle: {
                    color: 'white', fontName: 'TimesNewRoman', fontSize: 20
                },
                legend: { textStyle: { fontName: 'Courier', fontSize: 20, bold: true } },
                chartArea: { left: 20, top: 50, width: '90%', height: '80%' }

            };

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }

        google.charts.setOnLoadCallback(drawSectionChart);
        function drawSectionChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Browser');
            data.addColumn('number', 'Percentage');
            data.addRows(secArray);

            // Optional; add a title and set the width and height of the chart
            var options = {
                width: '100%',
                height: 400,
                colors: ['#222831', '#30475E', '#F05454', '#D89216', '#F4ABC4'],
                tooltip: { textStyle: { fontName: 'TimesNewRoman', fontSize: 20, bold: false } },
                pieSliceTextStyle: {
                    color: 'white', fontName: 'TimesNewRoman', fontSize: 20
                },
                legend: { textStyle: { fontName: 'Courier', fontSize: 20, bold: true } },
                chartArea: { left: 20, top: 50, width: '90%', height: '80%' }
            };

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
            chart.draw(data, options);
        }

        google.charts.setOnLoadCallback(drawRemainSlotChart);
        function drawRemainSlotChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Section');
            data.addColumn('number', 'Remain Slots');
            data.addRows(remainArray);

            var options = {
                width: '100%',
                height: 400,
                fontSize: '2rem',
                colors: ['#30475E', '#F05454', '#D89216', '#F4ABC4'],
                chartArea: { left: 50, top: 50, width: '80%', height: '80%' }
            };

            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('barchart'));
            chart.draw(data, options);
        }
    </script>
</body>
</html>