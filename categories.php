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
    <title>Manage Categories</title>

    <!-- Bootsrap CSS And JQuery Libs -->
    <link rel="stylesheet" href="css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/sidebarStyles.css">
    <link rel="stylesheet" href="./css/categoriesStyles.css">
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
                    <li class="sidebar-item "><a class="sidebar-link active" href="categories.php">Manage Categories</a>
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

            <!-- Bootstap Modal For Add Category  -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="row addCategoryRow">
                                <div class="col-lg form-group">
                                    <p class="addCategoryRowTitle">Category Name: </p>
                                    <input type="text" name="categoryName" id="categoryNameModal"
                                        placeholder="Enter Category Name" class="form-control">
                                </div>
                            </div>

                            <div class="row addCategoryRow">
                                <div class="col-lg form-group">
                                    <p class="addCategoryRowTitle">Category Discription: </p>
                                    <textarea rows="3" cols="100" name="categoryDisc" id="categoryDescModal"
                                        placeholder="Enter Category Discription" class="form-control"></textarea>
                                </div>
                            </div>

                            <!-- Error Msg (Invalid Inputs) -->
                            <div class="row" style="font-size: 1.2rem; color: red; display: none; margin-left: 1rem;"
                                id="errorMsg">
                                Inputs should not be empty!
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn modalAddCategoryBtn" onclick="addCategory()">Add
                                Category</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstap Modal For Delete caegory  -->
            <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Delete Catrgory</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row addCategoryRow">
                                <div class="col-lg form-group">
                                    <p class="addCategoryRowTitle" id="deleteMsg">Category will be deleted permenantely!
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn modalAddCategoryBtn" onclick="deleteCategory()"
                                id="deleteCategoryBtn">Delete Category</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Bootstap Modal For Update Category  -->
            <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Update Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="row addCategoryRow">
                            <div class="col-lg form-group">
                                <p class="addCategoryRowTitle">Category Name: </p>
                                <input type="text" name="categoryName" id="categoryNameModal2"
                                    placeholder="Enter Category Name" class="form-control">
                            </div>
                        </div>

                        <div class="row addCategoryRow">
                            <div class="col-lg form-group">
                                <p class="addCategoryRowTitle">Category Discription: </p>
                                <textarea rows="3" cols="100" name="categoryDisc" id="categoryDescModal2"
                                    placeholder="Enter Category Discription" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn modalAddCategoryBtn" onclick="updateCategory()">Update
                                Category</button>
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
                            <h3 class="mainTitle">Manage Categories</h3>
                        </div>

                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            <span id="successAlertMsg"></span>
                        </div>

                        <div id="addCategory" class="container">
                            <button class="btn btn-outline-primary addCategoryBtn" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop"><i class="fa fa-plus mr-3"></i>Add New
                                Category</button>
                        </div>

                        <div class="col-auto">
                            <h3 class="secondTitle">All Categories</h3>
                        </div>

                        <div id="categoriesList" class="row categoriesList">
                            <div class="list-group">
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

    <script>
        window.onload = function () {
            fetchTableData();
        }
        
        function addCategory() {
            var categoryName = document.getElementById("categoryNameModal").value;
            var categoryDesc = document.getElementById("categoryDescModal").value;

            document.getElementById("categoryNameModal").value = "";
            document.getElementById("categoryDescModal").value = "";

            if (categoryName == "" || categoryDesc == "") {
                document.getElementById("errorMsg").style.display = "block";
            } else {

                var data = "categoryName=" + categoryName + "&categoryDesc=" + categoryDesc;
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
                XRH.open('POST', './php/addCategory.php');
                XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XRH.send(data);
            }
        }

        document.getElementById("categoryNameModal").onfocus = function () {
            document.getElementById("errorMsg").style.display = "none";
        }
        document.getElementById("categoryDescModal").onfocus = function () {
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
            XRH.open('GET', './php/getCategories.php');

            XRH.onload = function () {
                obj = JSON.parse(this.responseText);
                fetchAllData();
            }
            XRH.send();
        }
        function fetchAllData() {
            tableData = "";
            if (obj != null) {
                for (let category of obj) {
                    tableData += '<div class="col-auto categoryItem"><div class="card"><div class="card-body"><h5 class="card-title categoryName">' + category.categoryName + '</h5><p class="card-text categoryDesc">' + category.categoryDesc + '</p><a href="" id = "' + category.categoryID + '" class="card-link me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onclick="getCategoryDetails(this.id)">Update Category</a><a href="" id = "' + category.categoryID + '" class="card-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" onclick="getCategoryDetails(this.id)">Delete Category</a></div></div></div>';
                }
                document.getElementById("categoriesList").innerHTML = tableData;
            }
        }

        var catID;

        // get Cat Details for Update Function
        function getCategoryDetails(val) {
            catID = val;
            console.log(catID);
            let category = obj.find(o => o.categoryID === val);

            document.getElementById("categoryNameModal2").value = category.categoryName;
            document.getElementById("categoryDescModal2").value = category.categoryDesc;
        }

        // DeleteCategory Function
        function deleteCategory() {
            var data = "categoryID=" + catID + "";
            var XRH = new XMLHttpRequest();

            XRH.onload = function () {
                console.log(this.responseText);
                obj = JSON.parse(this.responseText);

                if (obj.status) {
                    showSuccessAlert(obj.msg);
                    $('#staticBackdrop1').modal('hide');
                }
                else {
                    document.getElementById("deleteMsg").innerHTML = "This category is in use already, so you can not delete this!";
                }
                fetchTableData();
            }
            XRH.open('POST', './php/deleteCategory.php');
            XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            XRH.send(data);
        }

        // UpdateCategory Function
        function updateCategory() {
            var updatedName = document.getElementById("categoryNameModal2").value;
            var updatedDesc = document.getElementById("categoryDescModal2").value;

            if (updatedName == "" || updatedDesc == "") {
            }
            else {
                var data = "categoryID=" + catID + "&categoryName=" + updatedName + "&categoryDesc=" + updatedDesc + "";
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
                XRH.open('POST', './php/updateCategory.php');
                XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XRH.send(data);
            }
        }
    </script>
</body>

</html>