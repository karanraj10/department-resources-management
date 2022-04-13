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
    <title>Manage Section</title>

    <!-- Bootsrap CSS And JQuery Libs -->
    <link rel="stylesheet" href="css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/sidebarStyles.css">
    <link rel="stylesheet" href="./css/sectionStyles.css">
</head>

<body>
    <div class="wrapper">

        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">

                <h4 class="sidebarTitle">Department Resources</h4>

                <ul class="sidebar-nav">
                    <li class="sidebar-item"><a class="sidebar-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link active" href="section.php">Manage Section</a>
                    </li>
                    <li class="sidebar-item "><a class="sidebar-link" href="categories.php">Manage Categories</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link " href="resources.php">Manage Resources</a></li>
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

            <!-- Bootstap Modal For Add Section  -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Section</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="row addSectionRow">
                                <div class="col-lg form-group">
                                    <p class="addSectionRowTitle">Section Name: </p>
                                    <input type="text" name="sectionName" id="sectionNameModal"
                                        placeholder="Enter Section Name" class="form-control">
                                </div>
                            </div>

                            <div class="row addSectionRow">
                                <div class="col-lg form-group">
                                    <p class="addSectionRowTitle">Section Capacity: </p>
                                    <input type="number" name="sectionCapacity" id="sectionCapacityModal" min="1"
                                        value="50" placeholder="Enter Section Capacity" class="form-control">
                                </div>
                            </div>
                            <div class="row addSectionRow">
                                <div class="col-lg form-group">
                                    <p class="addSectionRowTitle">Section Discription: </p>
                                    <textarea rows="3" cols="100" name="sectionDisc" id="sectionDescModal"
                                        placeholder="Enter Section Discription" class="form-control"></textarea>
                                </div>
                            </div>

                            <!-- Error Msg (Invalid Inputs) -->
                            <div class="row" style="font-size: 1.2rem; color: red; display: none; margin-left: 1rem;"
                                id="errorMsg">
                                Inputs should not be empty!
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn modalAddSectionBtn" onclick="addSection()">Add
                                Section</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstap Modal For Delete Section  -->
            <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Delete Section</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row addSectionRow">
                                <div class="col-lg form-group">
                                    <p class="addSectionRowTitle" id="deleteMsg"></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn modalAddSectionBtn" onclick="deleteSection()"
                                id="deleteSectionBtn">Delete Section</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstap Modal For Update Section  -->
            <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Update Section</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="row addSectionRow">
                            <div class="col-lg form-group">
                                <p class="addSectionRowTitle">Section Name: </p>
                                <input type="text" name="sectionName" id="sectionNameModal2"
                                    placeholder="Enter Section Name" class="form-control">
                            </div>
                        </div>

                        <div class="row addSectionRow">
                            <div class="col-lg form-group">
                                <p class="addSectionRowTitle">Section Capacity: </p>
                                <input type="number" name="sectionCapacity" id="sectionCapacityModal2" min="1"
                                    placeholder="Enter Section Capacity" class="form-control">
                            </div>
                        </div>
                        <div class="row addSectionRow">
                            <div class="col-lg form-group">
                                <p class="addSectionRowTitle">Section Discription: </p>
                                <textarea rows="3" cols="100" name="sectionDisc" id="sectionDescModal2"
                                    placeholder="Enter Section Discription" class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- Error Msg (Invalid Inputs) -->
                        <div class="row" style="font-size: 1.2rem; color: red; display: none; margin-left: 1rem;"
                            id="errorMsg">
                            Inputs should not be empty!
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn modalAddSectionBtn" onclick="updateSection()">Update
                                Section</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Starts -->
            <main class="content p-4">
                <div class="container-fluid p-0">
                    <div class="row mb-2 mb-xl-3">

                        <!-- Add Categories Title -->
                        <div class="col-auto">
                            <h3 class="mainTitle">Manage Section</h3>
                        </div>

                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            <span id="successAlertMsg"></span>
                        </div>

                        <div id="addSection" class="container">
                            <button class="btn btn-outline-primary addSectionBtn" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop"><i class="fa fa-plus mr-3"></i>Add New
                                Section</button>
                        </div>

                        <div class="col-auto">
                            <h3 class="secondTitle">All Sections</h3>
                        </div>

                        <!-- All Section List  -->
                        <div id="sectionList" class="row sectionList">
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

    <script>
        window.onload = function () {
            fetchTableData();
        }

        function addSection() {
            var sectionName = document.getElementById("sectionNameModal").value;
            var sectionDesc = document.getElementById("sectionDescModal").value;
            var sectionCapacity = document.getElementById("sectionCapacityModal").value;

            document.getElementById("sectionNameModal").value = "";
            document.getElementById("sectionDescModal").value = "";

            if (sectionName == "" || sectionCapacity == "" || sectionDesc == "") {
                document.getElementById("errorMsg").style.display = "block";
            } else {

                var data = "sectionName=" + sectionName + "&sectionCapacity=" + sectionCapacity + "&sectionDesc=" + sectionDesc;
                var XRH = new XMLHttpRequest();

                XRH.onload = function () {
                    console.log(this.responseText);
                    obj = JSON.parse(this.responseText);

                    if (obj.status) {
                        showSuccessAlert(obj.msg);
                        $('#staticBackdrop').modal('hide');
                        fetchTableData();
                    }
                    else {
                        showErrorMsg(obj.msg);
                    }
                }
                XRH.open('POST', './php/addSection.php');
                XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XRH.send(data);
            }
        }

        document.getElementById("sectionNameModal").onfocus = function () {
            document.getElementById("errorMsg").style.display = "none";
        }
        document.getElementById("sectionCapacityModal").onfocus = function () {
            document.getElementById("errorMsg").style.display = "none";
        }
        document.getElementById("sectionDescModal").onfocus = function () {
            document.getElementById("errorMsg").style.display = "none";
        }

        function showSuccessAlert(msg) {
            $("#successAlert").fadeTo(2000, 500).slideUp(500, function () {
                $("#successAlert").slideUp(500);
            });
            document.getElementById("successAlertMsg").innerHTML = msg;
        }

        $(document).ready(function () {
            $("#successAlert").hide();
        });

        function showErrorMsg(msg) {
            document.getElementById("errorMsg").innerHTML = msg;
            document.getElementById("errorMsg").style.display = "block";
        }

        // Global Varibles
        var obj = null;
        var tableData = null;

        function fetchTableData() {
            var XRH = new XMLHttpRequest();
            XRH.open('GET', './php/getSection.php');

            XRH.onload = function () {
                obj = JSON.parse(this.responseText);
                fetchAllData();
            }
            XRH.send();
        }
        function fetchAllData() {
            tableData = "";
            if (obj != null) {
                for (let section of obj) {
                    tableData += '<div class="col-auto sectionItem"><div class="card"><div class="card-body"><div class="row"><div class="col-auto sectionNameCol"><h5 class="card-title sectionName">' + section.sectionName + '</h5></div><div class="col-auto sectionCapacityCol"><h5 class="card-title sectionCapacity">' + section.sectionAllocated + ' / ' + section.sectionCapacity + '</h5></div></div><p class="card-text sectionDesc">' + section.sectionDesc + '</p><a href="" id = "' + section.sectionID + '" class="card-link me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onclick="getSectionDetails(this.id)">Update Section</a><a href="" id = "' + section.sectionID + '" class="card-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" onclick="getSectionDetails(this.id)">Delete Section</a></div></div></div> ';
                }
                document.getElementById("sectionList").innerHTML = tableData;
            }
        }

        var secID;
        var sectionAllocated;

        function getSectionDetails(val) {
            secID = val;
            console.log(secID);
            let section = obj.find(o => o.sectionID === val);
            sectionAllocated = section.sectionAllocated;

            var msg;
            if (sectionAllocated != 0) {
                msg = "You can not delete section because section has resources in it!"
                document.getElementById("deleteMsg").innerHTML = msg;
                document.getElementById("deleteSectionBtn").style.display = "none";
            } else {
                msg = "Section will be deleted permenantely!";
                document.getElementById("deleteMsg").innerHTML = msg;
                document.getElementById("deleteSectionBtn").style.display = "block";
            }

            document.getElementById("sectionNameModal2").value = section.sectionName;
            document.getElementById("sectionCapacityModal2").value = section.sectionCapacity;
            document.getElementById("sectionDescModal2").value = section.sectionDesc;
        }

        function deleteSection() {
            var data = "sectionID=" + secID + "";
            var XRH = new XMLHttpRequest();

            XRH.onload = function () {
                console.log(this.responseText);
                obj = JSON.parse(this.responseText);

                if (obj.status) {
                    showSuccessAlert(obj.msg);
                    $('#staticBackdrop1').modal('hide');
                    fetchTableData();
                }
            }
            XRH.open('POST', './php/deleteSection.php');
            XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            XRH.send(data);
        }

        function updateSection() {
            var updatedName = document.getElementById("sectionNameModal2").value;
            var updatedCapacity = document.getElementById("sectionCapacityModal2").value;
            var updatedDesc = document.getElementById("sectionDescModal2").value;

            if (updatedName == "" || updatedCapacity == "" || updatedDesc == "") {
            }
            else {
                var data = "sectionID=" + secID + "&sectionName=" + updatedName + "&sectionCapacity=" + updatedCapacity + "&sectionDesc=" + updatedDesc + "";
                console.log(data);
                var XRH = new XMLHttpRequest();

                XRH.onload = function () {
                    console.log(this.responseText);
                    obj = JSON.parse(this.responseText);

                    if (obj.status) {
                        showSuccessAlert(obj.msg);
                        $('#staticBackdrop2').modal('hide');
                        fetchTableData();
                    }
                }
                XRH.open('POST', './php/updateSection.php');
                XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XRH.send(data);
            }
        }

    </script>
</body>

</html>