<?php
session_start();
if(!isset($_SESSION['logged_in'])) 
{
    header("Location: index.html");
}
else{
    include('./vendor/autoload.php');
    $mpdf = new \Mpdf\Mpdf();
    $con = mysqli_connect("localhost", "root", "", "department");
    $data="";
    $totalRes;
    $totalSec;
    $totalCat;
    $remainSlots = array();
    $catIDArray = array();
    $secIDArray = array();

    $data .='<html>
    <body>
        <h5 class="title">Department Resources</h5>';

    $data .= '<h5 class="subTitle">All Categories: </h5>
        <table border="1" cellspacing="0" cellpadding="5">
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Category Description</th>';

    $select = "SELECT * FROM categories";
    $result = mysqli_query($con, $select);
    $totalCat = mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {
        $arr = array($row["categoryName"]=> $row["categoryID"]);
        $catIDArray = array_merge($catIDArray, $arr);

        $data .= '<tr><td>'.$row["categoryID"].'</td><td>'.$row["categoryName"].'</td><td>'.$row["categoryDesc"].'</td></tr>';
    }

    $data .='</table>';

    $data .= '<h5 class="subTitle">All Sections: </h5>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>Section ID</th>
            <th>Section Name</th>
            <th>Section Capacity</th>
            <th>Section Allocated Slots</th>
            <th>Section Description</th>
        </tr>';

    $select1 = "SELECT * FROM section";
    $result1 = mysqli_query($con, $select1);
    $totalSec = mysqli_num_rows($result1);
    while ($row = mysqli_fetch_assoc($result1)) {

        $arr1 = array($row["sectionName"]=> $row["sectionID"]);
        $secIDArray = array_merge($secIDArray, $arr1);

        $arr = array($row["sectionName"]=> ($row["sectionCapacity"]-$row["sectionAllocated"]));
        $remainSlots = array_merge($remainSlots, $arr); 
        $data .= '<tr><td>'.$row["sectionID"].'</td><td>'.$row["sectionName"].'</td><td>'.$row["sectionCapacity"].'</td><td>'.$row["sectionAllocated"].'</td><td>'.$row["sectionDesc"].'</td></tr>';
    }

    $data .= '</table><h5 class="subTitle">All Resources: </h5>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>Resource ID</th>
            <th>Resource Name</th>
            <th>Resource MAC Address</th>
            <th>Resource Company</th>
            <th>Resource Category</th>
            <th>Resource Section</th>
            <th>Resource Description</th>
            <th>Last Edit Time</th>
        </tr>';

    $select2 = "SELECT * FROM resources ORDER BY resourceSection";
    $result2 = mysqli_query($con, $select2);
    $totalRes = mysqli_num_rows($result2);
    while ($row = mysqli_fetch_assoc($result2)) {
        $catID = $row["resourceCategory"];
        $secID = $row["resourceSection"];

        $select3 = "SELECT sectionName FROM section WHERE sectionID='$secID'";
        $result3 = mysqli_query($con, $select3);
        $row1 = mysqli_fetch_assoc($result3);

        $select4 = "SELECT categoryName FROM categories WHERE categoryID='$catID'";
        $result4 = mysqli_query($con, $select4);
        $row2 = mysqli_fetch_assoc($result4);

        $data .= '<tr><td>'.$row["resourceID"].'</td><td>'.$row["resourceName"].'</td><td>'.$row["resourceMAC"].'</td><td>'.$row["resourceCompany"].'</td><td>'.$row2["categoryName"].'</td><td>'.$row1["sectionName"].'</td><td>'.$row["resourceDesc"].'</td><td>'.$row["lastUpdated"].'</td></tr>';
    }
    $data .= '</table><h5 class="subTitle">Genral Info: </h5>
    <h5 class="subText"> Total Categories: '.$totalCat.'</h5>
    <h5 class="subText"> Total Section: '.$totalSec.'</h5>
    <h5 class="subText"> Total Resources: '.$totalRes.'</h5>';

    $data .= '<h5 class="subTitle">Section Remaining Slots: </h5><table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>Section Name</th>
        <th>Remaining Slots</th>
        </tr>';

    foreach($remainSlots as $x => $x_value) {
        $data .= '<tr><td>'. $x . '</td><td>' . $x_value .'</td></tr>';
    }

    $data .= '</table><h5 class="subTitle">Resources By Categories: </h5>';

    foreach($catIDArray as $a => $x_value) {

        $data .= '<h5 class="subText">Category: '. $a.'</h5><table border="1" cellspacing="0" cellpadding="5"><tr><th>Resource ID</th><th>Resource Name</th><th>Resource MAC Address</th></tr>';

        $fetch = "SELECT * FROM resources WHERE resourceCategory ='$x_value'";
        $res = mysqli_query($con, $fetch);
        while ($get = mysqli_fetch_assoc($res)) {
            $data .= '<tr><td>'.$get["resourceID"].'</td><td>'.$get["resourceName"].'</td><td>'.$get["resourceMAC"].'</td></tr>';
        }
        $data .= '</table>';
    }

    $data .= '<h5 class="subTitle">Resources By Section: </h5>';

    foreach($secIDArray as $a => $x_value) {

        $data .= '<h5 class="subText">Section: '. $a.'</h5><table border="1" cellspacing="0" cellpadding="5"><tr><th>Resource ID</th><th>Resource Name</th><th>Resource MAC Address</th></tr>';

        $fetch = "SELECT * FROM resources WHERE resourceSection ='$x_value'";
        $res = mysqli_query($con, $fetch);
        while ($get = mysqli_fetch_assoc($res)) {
            $data .= '<tr><td>'.$get["resourceID"].'</td><td>'.$get["resourceName"].'</td><td>'.$get["resourceMAC"].'</td></tr>';
        }
        $data .= '</table>';
    }

    $stylesheet = file_get_contents('./css/reportStyles.css');
    $mpdf->writeHtml($stylesheet,1);
    $mpdf->writeHtml($data);
    $mpdf->output();
}
?>