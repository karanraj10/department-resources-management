<?php
$con = mysqli_connect("localhost", "root", "", "department");
$records = array();
$selectSec = "SELECT * FROM resources ORDER BY resourceID DESC";
$result = mysqli_query($con, $selectSec);
while ($row = mysqli_fetch_assoc($result)) {
    $catID = $row["resourceCategory"];
    $secID = $row["resourceSection"];

    $fetchCat = "SELECT categoryName from categories WHERE categoryID = '$catID'";
    $fetchSec = "SELECT sectionName FROM section WHERE sectionID = '$secID'";

    $q = mysqli_query($con,$fetchCat);
    $row1 = mysqli_fetch_assoc($q);

    $q1 = mysqli_query($con,$fetchSec);
    $row2 = mysqli_fetch_assoc($q1);

    $records[] = array("resourceID"=>$row["resourceID"],"resourceName"=>$row["resourceName"],"resourceDesc"=>$row["resourceDesc"],"resourceMAC"=>$row["resourceMAC"],"resourceCompany"=>$row["resourceCompany"],"resourceCategoryID"=>$row["resourceCategory"],"resourceSectionID"=>$row["resourceSection"],"resourceCategory"=>$row1["categoryName"],"resourceSection"=>$row2["sectionName"],"lastUpdated"=>$row["lastUpdated"]);
}
echo json_encode($records);