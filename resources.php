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
    <title>Manage Resources</title>

    <!-- Bootsrap CSS And JQuery Libs -->
    <link rel="stylesheet" href="css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/sidebarStyles.css">
    <link rel="stylesheet" href="./css/resourceStyles.css">
</head>

<body>
    <div class="wrapper">

        <!-- Sidebar Navigation -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">

                <h4 class="sidebarTitle">Department Resources</h4>

                <ul class="sidebar-nav">
                    <li class="sidebar-item"><a class="sidebar-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="section.php">Manage Section</a>
                    </li>
                    <li class="sidebar-item "><a class="sidebar-link" href="categories.php">Manage Categories</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link active" href="resources.php">Manage Resources</a>
                    </li>
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


            <!-- Bootstap Modal For Add Resource  -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Resource</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="row addResourceRow">
                                <div class="col-lg form-group">
                                    <p class="addResourceRowTitle">Resource Category: </p>
                                    <select name="resourceCategory" id="resourceCategoryModal" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="row addResourceRow">
                                <div class="col-lg form-group">
                                    <p class="addResourceRowTitle">Number Of Resources: </p>
                                    <select name="resourceNumber" id="resourceNumberModal" class="form-control"
                                        onchange="onSelectChange()">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>

                            <script>
                                var resNum;
                                function onSelectChange() {
                                    resNum = document.getElementById("resourceNumberModal").value;

                                    var resNameData = "";
                                    var resMacData = "";
                                    var resDescData = "";
                                    var resCompanyData = "";
                                    for (var i = 0; i < resNum; i++) {
                                        resNameData += '<div class="col-auto me-1 mb-1"><input onfocus="hideErrorMsg()" type="text" name="resourceName[]" id="resourceNameModal' + i + '" placeholder="Enter Resource Name" class="form-control"></div>';
                                        resMacData += '<div class="col-auto me-1 mb-1"><input onfocus="hideErrorMsg()" type="text" name="resourceMACAdd[]" id="resourceMACAddModal' + i + '" placeholder="Enter Resource MAC Address" class="form-control" onkeyup="myFunction(this)" maxlength="17"></div>';
                                        resDescData += '<div class="col-auto me-1 mb-1"><textarea onfocus="hideErrorMsg()" rows="3" name="resourceDesc[]" id="resourceDescModal' + i + '" placeholder="Enter Resource Description" class="form-control"></textarea></div>';
                                        resCompanyData += '<div class="col-auto me-1 mb-1"><input onfocus="hideErrorMsg()" type="text" name="resourceCompany[]" id="resourceCompanyModal' + i + '" placeholder="Enter Resource Company" class="form-control"></div>';
                                    }
                                    document.getElementById("addResourceNameRow").innerHTML = resNameData;
                                    document.getElementById("addResourceMACAddRow").innerHTML = resMacData;
                                    document.getElementById("addResourceDescRow").innerHTML = resDescData;
                                    document.getElementById("addResourceCompanyRow").innerHTML = resCompanyData;
                                }
                            </script>

                            <div class="row addResourceRow">
                                <p class="addResourceRowTitle">Resource Name: </p>
                            </div>
                            <div class="row " id="addResourceNameRow">
                            </div>
                            <div class="row addResourceRow">
                                <p class="addResourceRowTitle">Resource MAC Address: </p>
                            </div>
                            <div class="row " id="addResourceMACAddRow">
                            </div>
                            <div class="row addResourceRow">
                                <p class="addResourceRowTitle">Resource Description: </p>
                            </div>
                            <div class="row " id="addResourceDescRow">
                            </div>
                            <div class="row addResourceRow">
                                <p class="addResourceRowTitle">Resource Company Name: </p>
                            </div>
                            <div class="row " id="addResourceCompanyRow">
                            </div>

                            <div class="row addResourceRow">
                                <div class="col-lg form-group">
                                    <p class="addResourceRowTitle">Select Section In Which To Place Resources: </p>
                                    <select name="resourceSection" id="resourceSectionModal" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-auto">
                                    <div id="errorMsg"
                                        style="font-size: 1.2rem; color: red; display: none; margin-left: 1rem;"></div>
                                </div>
                                <div class="col-auto" style="text-align: end;">
                                    <button type="button" class="btn modalAddResourceBtn" onclick="addResource()">Add
                                        resource</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstap Modal For Delete Resource  -->
            <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Delete Resource</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row addResourceRow">
                                <div class="col-lg form-group">
                                    <p class="addResourceRowTitle">The resource you want to delete will be deleted
                                        permanently.</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn modalAddResourceBtn" onclick="deleteResource()">Delete
                                resource</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstap Modal For Update Resource  -->
            <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content p-3">
                        <div class="modal-header p-0">
                            <h5 class="modal-title" id="staticBackdropLabel">Update Resource</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="row addResourceRow">
                            <div class="col-lg form-group">
                                <p class="addResourceRowTitle">Resource Name: </p>
                                <input type="text" name="resourceName" id="resourceNameModal2"
                                    placeholder="Enter Resource Name" class="form-control">
                            </div>
                        </div>

                        <div class="row addResourceRow">
                            <div class="col-lg form-group">
                                <p class="addResourceRowTitle">Resource MAC Address: </p>
                                <input type="text" name="resourceName" id="resourceMACModal2"
                                    placeholder="Enter Resource MAC Address" class="form-control"
                                    onkeyup="myFunction(this)" maxlength="17">
                            </div>
                        </div>

                        <div class="row addResourceRow">
                            <div class="col-lg form-group">
                                <p class="addResourceRowTitle">Resource Company: </p>
                                <input type="text" name="resourceName" id="resourceCompanyModal2"
                                    placeholder="Enter Resource Company" class="form-control">
                            </div>
                        </div>

                        <div class="row addResourceRow">
                            <div class="col-lg form-group">
                                <p class="addResourceRowTitle">Resource Description: </p>
                                <textarea rows="3" type="text" name="resourceName" id="resourceDescModal2"
                                    placeholder="Enter Resource Description" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn modalAddResourceBtn" onclick="updateResource()">Update
                                resource</button>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Bootstap Modal For Transfer Resource  -->
            <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Transfer Resources</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="row addResourceRow">
                                <div class="col-lg form-group">
                                    <p class="addResourceRowTitle">Select Section From Which To Transfer Resources
                                        (Source): </p>
                                    <select name="resourceSection" id="resourceSectionModal3" class="form-control"
                                        onchange="getResourceListForSection(this)" onfocus="hideErrorMsgForTransfer()">
                                    </select>
                                </div>
                            </div>

                            <div class="row addResourceRow">
                                <div class="col-lg form-group">
                                    <p class="addResourceRowTitle">Select Resources To Transfer: </p>
                                    <select name="resourceSection" id="resourceListModal3" class="form-control" multiple
                                        size="8" onchange="getSelectedResourceListToDisplay()"
                                        onfocus="hideErrorMsgForTransfer()">
                                    </select>
                                </div>
                            </div>

                            <div class="row addResourceRow">
                                <div class="col-lg form-group">
                                    <p class="addResourceRowTitle">Selected Resources MAC Address: <span
                                            id="resCount"></span> </p>
                                    <p class="addResourceRowTitle" id="selectedResource"></p>
                                </div>
                            </div>

                            <div class="row addResourceRow">
                                <div class="col-lg form-group">
                                    <p class="addResourceRowTitle">Select Section TO Which To Transfer Resources
                                        (Destination): </p>
                                    <select name="resourceSection" id="resourceSectionModal4" class="form-control"
                                        onfocus="hideErrorMsgForTransfer()">
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-auto">
                                    <div id="errorMsgTransferRes"
                                        style="font-size: 1.2rem; color: red; display: none; margin-left: 1rem;"></div>
                                </div>
                                <div class="col-auto" style="text-align: end;">
                                    <button type="button" class="btn modalAddResourceBtn"
                                        onclick="transferResource()">Transfer
                                        resource</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Bootstap Modal For Replace Resource  -->
            <div class="modal fade" id="staticBackdrop4" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Replace Resources</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="row addResourceRow">
                                <div class="col-lg form-group">
                                    <p class="addResourceRowTitle">Select Section From Which To Replace Resources
                                        (Source): </p>
                                    <select name="resourceSection" id="resourceSectionModal5" class="form-control"
                                        onchange="getResourceListForSection(this)" onfocus="hideErrorMsgForReplace()">
                                    </select>
                                </div>
                            </div>

                            <div class="row addResourceRow">
                                <div class="col-lg form-group">
                                    <p class="addResourceRowTitle">Select Resources To Replace: </p>
                                    <select name="resourceSection" id="resourceListModal4" class="form-control" multiple
                                        size="5" onfocus="hideErrorMsgForReplace()"
                                        onchange="getSelectedSourceReplaceResourceListToDisplay()">
                                    </select>
                                </div>
                            </div>

                            <div class="row addResourceRow">
                                <div class="col-lg form-group">
                                    <p class="addResourceRowTitle">Selected Resources MAC Address: <span
                                            id="sourceReplaceResCount"></span> </p>
                                    <p class="addResourceRowTitle" id="selectedSourceReplaceResource"></p>
                                </div>
                            </div>

                            <div class="row addResourceRow">
                                <div class="col-lg form-group">
                                    <p class="addResourceRowTitle">Select Section TO Which To Replace Resources
                                        (Destination): </p>
                                    <select name="resourceSection" id="resourceSectionModal6" class="form-control"
                                        onchange="getResourceListForSection(this)" onfocus="hideErrorMsgForReplace()">
                                    </select>
                                </div>
                            </div>

                            <div class="row addResourceRow">
                                <div class="col-lg form-group">
                                    <p class="addResourceRowTitle">Select Resources To Replace: </p>
                                    <select name="resourceSection" id="resourceListModal5" class="form-control" multiple
                                        size="5" onfocus="hideErrorMsgForReplace()"
                                        onchange="getSelectedDestReplaceResourceListToDisplay();">
                                    </select>
                                </div>
                            </div>

                            <div class="row addResourceRow">
                                <div class="col-lg form-group">
                                    <p class="addResourceRowTitle">Selected Resources MAC Address: <span
                                            id="destReplaceResCount"></span> </p>
                                    <p class="addResourceRowTitle" id="selectedDestReplaceResource"></p>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-auto">
                                    <div id="errorMsgReplaceRes"
                                        style="font-size: 1.2rem; color: red; display: none; margin-left: 1rem;"></div>
                                </div>
                                <div class="col-auto" style="text-align: end;">
                                    <button type="button" class="btn modalAddResourceBtn"
                                        onclick="replacerResource()">Replace
                                        resource</button>
                                </div>
                            </div>
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
                            <h3 class="mainTitle">Manage Resources</h3>
                        </div>

                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            <span id="successAlertMsg"></span>
                        </div>

                        <div id="addResource" class="container">
                            <button class="btn btn-outline-primary addResourcenBtn" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop" onclick="onSelectChange()"><i
                                    class="fa fa-plus mr-3"></i>Add New
                                Resource</button>

                            <button class="btn btn-outline-primary addResourcenBtn" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop3"><i class="fa fa-exchange mr-3"></i>Transfer
                                Resources</button>

                            <button class="btn btn-outline-primary addResourcenBtn" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop4"><i class="fa fa-exchange mr-3"></i>Replace
                                Resources</button>
                        </div>

                        <div class="col-auto">
                            <h3 class="secondTitle">All Resources</h3>
                        </div>

                        <!-- Serach Bar and Button  -->
                        <div class="input-group mb-3">

                            <input type="search" class="form-control rounded mr-3" placeholder="Search a MAC ADDRESS..."
                                aria-label="Search" id="searchMAC" onkeyup="myFunction(this)" maxlength="17">

                            <button type="button" class="btn btn-outline myBtn" id="searchButton"
                                onclick="fetchSpecificResourceByMAC(document.getElementById('searchMAC').value)">search</button>
                        </div>

                        <!-- List of All Section (Radio Button) -->
                        <div class="row justify-content-start mb-2" id="categoriesRow">
                        </div>

                        <!-- List Of Resources  -->
                        <div id="resourceList" class="row resourceList">
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

        // OnLoad Function.... Fetch all details

        window.onload = function () {
            fetchCategories();
            fetchSection();
            fetchResource();
        }

        // MyFunction for MAC ADDRESSS Input VALIDATION
        // AUTO COLON (:) AFTER TWO CHAR

        function myFunction(val) {
            // remove non digits, break it into chunks of 2 and join with a colon
            val.value =
                (val.value.toUpperCase()
                    .replace(/[^\d|A-Z]/g, '')
                    .match(/.{1,2}/g) || [])
                    .join(":")
        }


        var inputID = "";  // To Get empty input ID.
        var empty;  //TO Indicate any empty inputs

        // ADD RESOURCE FUNCTION
        function addResource() {
            empty = false;

            var resourceNameArray = new Array();
            var resNameElement = document.getElementsByName("resourceName[]");

            var resourceDescArray = new Array();
            var resDescElement = document.getElementsByName("resourceDesc[]");

            var resourceCompanyArray = new Array();
            var resCompanyElement = document.getElementsByName("resourceCompany[]");

            var resourceMACAddArray = new Array();
            var resMACAddElement = document.getElementsByName("resourceMACAdd[]");

            // Checking over all inputs

            for (var i = 0; i < resNameElement.length; i++) {
                if (resNameElement[i].value == "") {
                    empty = true;
                    inputID = "resourceNameModal" + i;
                    break;
                }
                else if (resMACAddElement[i].value == "") {
                    empty = true;
                    inputID = "resourceMACAddModal" + i;
                    break;
                }
                else if (resMACAddElement[i].value.length != 17) {
                    empty = true;
                    inputID = "resourceMACAddModal" + i;
                    break;
                }
                else if (resDescElement[i].value == "") {
                    empty = true;
                    inputID = "resourceDescModal" + i;
                    break;
                }
                else if (resCompanyElement[i].value == "") {
                    empty = true;
                    inputID = "resourceCompanyModal" + i;
                    break;
                }
                else {
                    resourceNameArray.push(resNameElement[i].value);
                    resourceDescArray.push(resDescElement[i].value);
                    resourceCompanyArray.push(resCompanyElement[i].value);
                    resourceMACAddArray.push(resMACAddElement[i].value);
                }
            }

            var resourceCategory = document.getElementById("resourceCategoryModal").value;
            var resourceSection = document.getElementById("resourceSectionModal").value;
            var resourceNum = document.getElementById("resourceNumberModal").value;

            var sectionSelectBox = document.getElementById("resourceSectionModal");
            var remainSlot = sectionSelectBox[sectionSelectBox.selectedIndex].id;

            if (empty) {
                showErrorMsg("inputs should not be empty!");
                showRedLine();
            }
            else if (Number(resourceNum) > Number(remainSlot)) {
                showErrorMsg("Section has only " + remainSlot + " slots empty!");
            }
            else {
                console.log(resourceCompanyArray);
                console.log(resourceDescArray);
                console.log(resourceMACAddArray);
                console.log(resourceNameArray);

                var data = "resourceNum=" + resourceNum + "&resourceMACAddress=" + resourceMACAddArray + "&resourceCompany=" + resourceCompanyArray + "&resourceName=" + resourceNameArray + "&resourceDesc=" + resourceDescArray + "&resourceCategory=" + resourceCategory + "&resourceSection=" + resourceSection + "";
                console.log(data);
                var XRH = new XMLHttpRequest();

                XRH.onload = function () {
                    console.log(this.responseText);
                    obj = JSON.parse(this.responseText);

                    if (obj.status) {
                        showSuccessAlert(obj.msg);
                        $('#staticBackdrop').modal('hide');
                        fetchSection();
                        fetchResource();
                    }
                    else {
                        showErrorMsg(obj.msg);
                    }
                }
                XRH.open('POST', './php/addResource.php');
                XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XRH.send(data);
            }
        }

        // SHOW SUCCESS ALERT FUNCTION
        function showSuccessAlert(msg) {
            $("#successAlert").fadeTo(2000, 500).slideUp(500, function () {
                $("#successAlert").slideUp(500);
            });
            document.getElementById("successAlertMsg").innerHTML = msg;
        }

        // HIDE SUCCESS ALERT FUNCTION ON WINDLOW LOAD
        $(document).ready(function () {
            $("#successAlert").hide();
        });

        // SHOW ERROR ALERT FUNCTION
        function showErrorMsg(msg) {
            document.getElementById("errorMsg").innerHTML = msg;
            document.getElementById("errorMsg").style.display = "block";
        }

        // SHOW ERROR RED LINE ON INPUT FIELD FUNCTION
        function showRedLine() {
            document.getElementById(inputID).style.borderWidth = "2px";
            document.getElementById(inputID).style.borderColor = "RED";
        }

        // HIDE ERROR ALERT FUNCTION
        function hideErrorMsg() {
            if (empty) {
                document.getElementById("errorMsg").style.display = "none";
                if (inputID != null) {
                    document.getElementById(inputID).style.borderColor = "";
                }
            }
        }

        // FETCH LIST OF CATEGORIES FUNCTION
        var categoryData;
        var catObj;
        function fetchCategories() {
            var XRH = new XMLHttpRequest();
            XRH.open('GET', './php/getCategories.php');

            XRH.onload = function () {
                catObj = JSON.parse(this.responseText);
                categoryData = "";
                if (catObj != null) {
                    for (let category of catObj) {
                        categoryData += '<option value="' + category.categoryID + '">' + category.categoryName + '</option>';
                    }

                    document.getElementById("resourceCategoryModal").innerHTML = categoryData;
                }
            }
            XRH.send();
        }

        // FETCH LIST OF SECTION FUNCTION
        var sectionData;
        var sectionDataForTransfer;
        var secObj;
        var catTableData;
        function fetchSection() {
            var XRH = new XMLHttpRequest();
            XRH.open('GET', './php/getSection.php');

            XRH.onload = function () {
                secObj = JSON.parse(this.responseText);
                sectionData = "";
                catTableData = '<div class="col-auto"><input type="radio" onclick="fetchSpecificSection(this.id);" id="ALL" class="btn-check" name="btnradio" value="ALL" autocomplete="off" checked><label class="btn btn-outline myBtn active ms-1 me-1 mb-1" id="ALLLabel" for="ALL">ALL</label></div>';

                sectionDataForTransfer = '<option value="">---- Select Any Section ----</option>';
                if (secObj != null) {
                    for (let section of secObj) {
                        var remain = section.sectionCapacity - section.sectionAllocated;
                        if (section.sectionCapacity == section.sectionAllocated) {

                            sectionData += '<option value="' + section.sectionName + '" disabled>' + section.sectionName + '- Section Full</option>';
                            sectionDataForTransfer += '<option value="' + section.sectionName + '" disabled>' + section.sectionName + '- Section Full</option>';

                        }
                        else {
                            sectionData += '<option id="' + remain + '" value="' + section.sectionID + '">' + section.sectionName + '  (' + remain + ' Slots)</option >';
                            sectionDataForTransfer += '<option id="' + remain + '" value="' + section.sectionID + '">' + section.sectionName + '  (' + remain + ' Slots)</option >';
                        }
                        catTableData += '<div class="col-auto"><input type="radio" onclick="fetchSpecificSection(this.id);" id="' + section.sectionID + '" class="btn-check" name="btnradio" value="' + section.sectionID + '" autocomplete="off"><label class="btn btn-outline myBtn ms-1 me-1 mb-1" id="' + section.sectionID + 'Label" for="' + section.sectionID + '">' + section.sectionName + '</label></div>';

                    }
                    document.getElementById("resourceSectionModal").innerHTML = sectionData;
                    document.getElementById("resourceSectionModal3").innerHTML = sectionDataForTransfer;
                    document.getElementById("resourceSectionModal4").innerHTML = sectionDataForTransfer;
                    document.getElementById("resourceSectionModal5").innerHTML = sectionDataForTransfer;
                    document.getElementById("resourceSectionModal6").innerHTML = sectionDataForTransfer;
                    document.getElementById("categoriesRow").innerHTML = catTableData;

                }
            }
            XRH.send();
        }

        // FETCH LIST OF RESOURCES FUNCTION
        var resourceData;
        var resObj;
        function fetchResource() {
            var XRH = new XMLHttpRequest();
            XRH.open('GET', './php/getResource.php');

            XRH.onload = function () {
                resObj = JSON.parse(this.responseText);
                console.log(resObj);
                resourceData = "";
                if (resObj != null) {
                    for (let resource of resObj) {
                        resourceData += '<div class="col-auto resourceItem"><div class="card"><div class="card-body"><div class="row justify-content-between"><div class="col-auto me-2"><h5 class="card-title resourceName">' + resource.resourceName + '</h5></div><div class="col-auto"><h5 class=" card-text resourceCategory">' + resource.resourceCategory + '</h5><h5 class="card-text resourceCompany">' + resource.resourceCompany + '</h5></div></div><h5 class="card-title mt-2"><span class="resourceMAC">' + resource.resourceMAC + '</span></h5><h5 class="card-text resourceSection">' + resource.resourceSection + '</h5><p class="card-text resourceDesc">' + resource.resourceDesc + '</p><a href="" id = "' + resource.resourceID + '" class="card-link me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onclick="getResourceDetails(this.id)">Update Resource</a><a href="" id = "' + resource.resourceID + '" class="card-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" onclick="getResourceID(this.id)">Delete Resource</a><div class="card-footer mt-3 p-0"><p class="text-muted">Last updated: ' + resource.lastUpdated + '</p></div></div></div></div>';
                    }
                    document.getElementById("resourceList").innerHTML = resourceData;
                }
            }
            XRH.send();
        }

        // GET CLICKED RESOURCE ID FOR DELETE FUNCTION
        var resID;
        function getResourceID(val) {
            resID = val;
        }

        // GET CLICKED RESOURCE DETAILS FOR UPDATE FUNCTION
        function getResourceDetails(val) {
            resID = val;
            let resource = resObj.find(o => o.resourceID === val);
            console.log(resource);

            document.getElementById("resourceNameModal2").value = resource.resourceName;
            document.getElementById("resourceMACModal2").value = resource.resourceMAC;
            document.getElementById("resourceCompanyModal2").value = resource.resourceCompany;
            document.getElementById("resourceDescModal2").value = resource.resourceDesc;
        }

        // UPDATE RESOURCE FUNCTION
        function updateResource() {
            var updatedName = document.getElementById("resourceNameModal2").value;
            var updatedMAC = document.getElementById("resourceMACModal2").value;
            var updatedCompany = document.getElementById("resourceCompanyModal2").value;
            var updatedDesc = document.getElementById("resourceDescModal2").value;

            if (updatedName == "" || updatedCompany == "" || updatedDesc == "" || updatedMAC == "" || updatedMAC.length != 17) {
            }
            else {
                var data = "resourceID=" + resID + "&resourceName=" + updatedName + "&resourceMAC=" + updatedMAC + "&resourceCompany=" + updatedCompany + "&resourceDesc=" + updatedDesc + "";
                console.log(data);
                var XRH = new XMLHttpRequest();

                XRH.onload = function () {
                    console.log(this.responseText);
                    obj = JSON.parse(this.responseText);

                    if (obj.status) {
                        showSuccessAlert(obj.msg);
                        $('#staticBackdrop2').modal('hide');
                        fetchResource();
                    }
                }
                XRH.open('POST', './php/updateResource.php');
                XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XRH.send(data);
            }
        }

        // DELETE RESOURCE FUNCTION

        function deleteResource() {
            console.log(resID);

            var data = "resourceID=" + resID + "";
            var XRH = new XMLHttpRequest();

            XRH.onload = function () {
                console.log(this.responseText);
                obj = JSON.parse(this.responseText);

                if (obj.status) {
                    showSuccessAlert(obj.msg);
                    $('#staticBackdrop1').modal('hide');
                    fetchResource();
                }
            }
            XRH.open('POST', './php/deleteResource.php');
            XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            XRH.send(data);
        }

        // GET RESOURCE LIST FOR SELECTED SECTION
        var selectedSection;
        var resListData;
        function getResourceListForSection(val) {
            selectedSection = val.value;
            resListData = "";

            if (resObj != null) {
                for (let resource of resObj) {
                    if (resource.resourceSectionID === selectedSection) {
                        resListData += '<option value="' + resource.resourceMAC + '">' + resource.resourceName + ' ( ' + resource.resourceMAC + ' )</option>';
                    }
                }
                if (val.id == "resourceSectionModal3") {
                    document.getElementById("resourceListModal3").innerHTML = resListData;

                }
                else if (val.id == "resourceSectionModal5") {
                    document.getElementById("resourceListModal4").innerHTML = resListData;

                }
                else if (val.id == "resourceSectionModal6") {
                    document.getElementById("resourceListModal5").innerHTML = resListData;
                }
            }
        }

        // DISPLAY RESOURCE LIST FOR SELECTED RESOURCES
        var values = [];
        var destSlots;
        function getSelectedResourceListToDisplay() {
            values = $('#resourceListModal3').val();
            document.getElementById("selectedResource").innerHTML = values.toString();
            document.getElementById("resCount").innerHTML = values.length;
        }

        // TRANSFER RESOURCE FUNCTION
        function transferResource() {
            var sourceSection = document.getElementById("resourceSectionModal3").value;
            var destSection = document.getElementById("resourceSectionModal4").value;

            var destSelect = document.getElementById("resourceSectionModal4");
            destSlots = destSelect[destSelect.selectedIndex].id;
            console.log("Destination: " + destSlots);

            if (sourceSection == "" || destSection == "") {
                showErrorMsgForTransfer("You have not selected any section!");
            }
            else if (values.length == 0) {
                showErrorMsgForTransfer("You have not selected any resources!");
            }
            else if (sourceSection == destSection) {
                showErrorMsgForTransfer("You can not select source and destination section same!");
            }
            else if (values.length > destSlots) {
                showErrorMsgForTransfer("Destination section has only " + destSlots + " slots left!");
            }
            else {
                var data = "resourceMAC=" + values + "&resourceDestinationSection=" + destSection + "&resourceSourceSection=" + sourceSection + "";
                console.log(data);
                var XRH = new XMLHttpRequest();

                XRH.onload = function () {
                    console.log(this.responseText);
                    obj = JSON.parse(this.responseText);

                    if (obj.status) {
                        showSuccessAlert(obj.msg);
                        $('#staticBackdrop3').modal('hide');
                        fetchSection();
                        fetchResource();
                    }
                    else {
                        showErrorMsg(obj.msg);
                    }
                }
                XRH.open('POST', './php/transferResource.php');
                XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XRH.send(data);
            }
        }

        var sourceReplaceValues = [];
        var destReplaceValues = [];

        // Display list of selected resources
        function getSelectedSourceReplaceResourceListToDisplay() {
            sourceReplaceValues = $('#resourceListModal4').val();
            document.getElementById("selectedSourceReplaceResource").innerHTML = sourceReplaceValues.toString();
            document.getElementById("sourceReplaceResCount").innerHTML = sourceReplaceValues.length;
        }

        // Display list of selected resources
        function getSelectedDestReplaceResourceListToDisplay() {
            destReplaceValues = $('#resourceListModal5').val();
            document.getElementById("selectedDestReplaceResource").innerHTML = destReplaceValues.toString();
            document.getElementById("destReplaceResCount").innerHTML = destReplaceValues.length;
        }

        function replacerResource() {
            var sourceSection = document.getElementById("resourceSectionModal5").value;
            var destSection = document.getElementById("resourceSectionModal6").value;

            console.log(sourceSection);
            console.log(destSection);

            if (sourceSection == "" || destSection == "") {
                showErrorMsgForReplace("You have not selected any section!");
            }
            else if (sourceSection == destSection) {
                showErrorMsgForReplace("You can not select source and destination section same!");
            }
            else if (destReplaceValues.length == 0 || sourceReplaceValues.length == 0) {
                showErrorMsgForReplace("You have not selected any resources!");
            }
            else if (destReplaceValues.length != sourceReplaceValues.length) {
                showErrorMsgForReplace("Resources to replace must be same");
            }
            else {
                var data = "destResource=" + destReplaceValues + "&sourceResource=" + sourceReplaceValues + "&destSection=" + destSection + "&sourceSection=" + sourceSection + "";
                console.log(data);
                var XRH = new XMLHttpRequest();

                XRH.onload = function () {
                    console.log(this.responseText);
                    obj = JSON.parse(this.responseText);

                    if (obj.status) {
                        showSuccessAlert(obj.msg);
                        $('#staticBackdrop4').modal('hide');
                        fetchSection();
                        fetchResource();
                    }
                    else {
                        showErrorMsg(obj.msg);
                    }
                }
                XRH.open('POST', './php/replaceResource.php');
                XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XRH.send(data);
            }
        }

        // DISPLAY ERROR MSG IN Replace RESOURCE MODAL
        function showErrorMsgForReplace(msg) {
            document.getElementById("errorMsgReplaceRes").innerHTML = msg;
            document.getElementById("errorMsgReplaceRes").style.display = "block";
        }

        // HIDE ERROR MSG IN Replace RESOURCE MODAL
        function hideErrorMsgForReplace() {
            document.getElementById("errorMsgReplaceRes").style.display = "none";
        }

        // DISPLAY ERROR MSG IN TRANSFER RESOURCE MODAL
        function showErrorMsgForTransfer(msg) {
            document.getElementById("errorMsgTransferRes").innerHTML = msg;
            document.getElementById("errorMsgTransferRes").style.display = "block";
        }

        // HIDE ERROR MSG IN TRANSFER RESOURCE MODAL
        function hideErrorMsgForTransfer() {
            document.getElementById("errorMsgTransferRes").style.display = "none";
        }

        // FILTER RESOURCE LIST BY SECTION (RADIO BUTTON)
        var old = "ALL";
        function fetchSpecificSection(val) {
            document.getElementById(old).parentNode.childNodes[1].classList.remove("active");
            old = val;
            document.getElementById(val).parentNode.childNodes[1].classList.add("active");

            resourceData = "";
            var selectedCategory = null;

            document.getElementsByName('btnradio').forEach(radio => {
                if (radio.checked) {
                    selectedCategory = radio.value;
                }
            });
            if (selectedCategory == "ALL") {
                for (let resource of resObj) {
                    resourceData += '<div class="col-auto resourceItem"><div class="card"><div class="card-body"><div class="row justify-content-between"><div class="col-auto me-2"><h5 class="card-title resourceName">' + resource.resourceName + '</h5></div><div class="col-auto"><h5 class=" card-text resourceCategory">' + resource.resourceCategory + '</h5><h5 class="card-text resourceCompany">' + resource.resourceCompany + '</h5></div></div><h5 class="card-title mt-2"><span class="resourceMAC">' + resource.resourceMAC + '</span></h5><h5 class="card-text resourceSection">' + resource.resourceSection + '</h5><p class="card-text resourceDesc">' + resource.resourceDesc + '</p><a href="" id = "' + resource.resourceID + '" class="card-link me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onclick="getResourceDetails(this.id)">Update Resource</a><a href="" id = "' + resource.resourceID + '" class="card-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" onclick="getResourceID(this.id)">Delete Resource</a><div class="card-footer mt-3 p-0"><p class="text-muted">Last updated: ' + resource.lastUpdated + '</p></div></div></div></div>';
                }
            }
            else {
                if (resObj != null) {
                    for (let resource of resObj) {
                        if (resource.resourceSectionID == selectedCategory) {
                            resourceData += '<div class="col-auto resourceItem"><div class="card"><div class="card-body"><div class="row justify-content-between"><div class="col-auto me-2"><h5 class="card-title resourceName">' + resource.resourceName + '</h5></div><div class="col-auto"><h5 class=" card-text resourceCategory">' + resource.resourceCategory + '</h5><h5 class="card-text resourceCompany">' + resource.resourceCompany + '</h5></div></div><h5 class="card-title mt-2"><span class="resourceMAC">' + resource.resourceMAC + '</span></h5><h5 class="card-text resourceSection">' + resource.resourceSection + '</h5><p class="card-text resourceDesc">' + resource.resourceDesc + '</p><a href="" id = "' + resource.resourceID + '" class="card-link me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onclick="getResourceDetails(this.id)">Update Resource</a><a href="" id = "' + resource.resourceID + '" class="card-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" onclick="getResourceID(this.id)">Delete Resource</a><div class="card-footer mt-3 p-0"><p class="text-muted">Last updated: ' + resource.lastUpdated + '</p></div></div></div></div>';
                        }
                    }
                }
            }
            document.getElementById("resourceList").innerHTML = resourceData;
        }

        // FILTER RESOURCE LIST BY MAC (SEARCH)
        function fetchSpecificResourceByMAC(searchValue) {
            searchValue = searchValue.toLowerCase();
            resourceData = "";

            if (searchValue == "") {
                for (let resource of resObj) {
                    resourceData += '<div class="col-auto resourceItem"><div class="card"><div class="card-body"><div class="row justify-content-between"><div class="col-auto me-2"><h5 class="card-title resourceName">' + resource.resourceName + '</h5></div><div class="col-auto"><h5 class=" card-text resourceCategory">' + resource.resourceCategory + '</h5><h5 class="card-text resourceCompany">' + resource.resourceCompany + '</h5></div></div><h5 class="card-title mt-2"><span class="resourceMAC">' + resource.resourceMAC + '</span></h5><h5 class="card-text resourceSection">' + resource.resourceSection + '</h5><p class="card-text resourceDesc">' + resource.resourceDesc + '</p><a href="" id = "' + resource.resourceID + '" class="card-link me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onclick="getResourceDetails(this.id)">Update Resource</a><a href="" id = "' + resource.resourceID + '" class="card-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" onclick="getResourceID(this.id)">Delete Resource</a><div class="card-footer mt-3 p-0"><p class="text-muted">Last updated: ' + resource.lastUpdated + '</p></div></div></div></div>';
                }
            }
            else {
                if (resObj != null) {
                    for (let resource of resObj) {
                        if (resource.resourceMAC.toLowerCase().includes(searchValue)) {
                            resourceData += '<div class="col-auto resourceItem"><div class="card"><div class="card-body"><div class="row justify-content-between"><div class="col-auto me-2"><h5 class="card-title resourceName">' + resource.resourceName + '</h5></div><div class="col-auto"><h5 class=" card-text resourceCategory">' + resource.resourceCategory + '</h5><h5 class="card-text resourceCompany">' + resource.resourceCompany + '</h5></div></div><h5 class="card-title mt-2"><span class="resourceMAC">' + resource.resourceMAC + '</span></h5><h5 class="card-text resourceSection">' + resource.resourceSection + '</h5><p class="card-text resourceDesc">' + resource.resourceDesc + '</p><a href="" id = "' + resource.resourceID + '" class="card-link me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onclick="getResourceDetails(this.id)">Update Resource</a><a href="" id = "' + resource.resourceID + '" class="card-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" onclick="getResourceID(this.id)">Delete Resource</a><div class="card-footer mt-3 p-0"><p class="text-muted">Last updated: ' + resource.lastUpdated + '</p></div></div></div></div>';
                        }
                    }
                }
            }
            document.getElementById("resourceList").innerHTML = resourceData;
        }
    </script>
</body>

</html>