<?php
$con = mysqli_connect("localhost", "root", "", "department");
$records = array();
$records1 = array();

$getCat = "SELECT COUNT(resourceCategory) as resCategoryValues, resourceCategory FROM resources GROUP BY resourceCategory";
$result = mysqli_query($con, $getCat);

while ($row = mysqli_fetch_assoc($result)) {
    $catID = $row["resourceCategory"];
    $q = "SELECT categoryName FROM categories WHERE categoryID='$catID'";
    $result1 = mysqli_query($con, $q);
    $row1 = mysqli_fetch_assoc($result1);

    $records[] = array("category"=>$row1["categoryName"],"resCategoryValues"=>$row["resCategoryValues"]);
}

$getSec = "SELECT COUNT(resourceSection) as resSectionValues, resourceSection FROM resources GROUP BY resourceSection";
$result2 = mysqli_query($con, $getSec);
while ($row2 = mysqli_fetch_assoc($result2)) {
    $secID = $row2["resourceSection"];
    $q1 = "SELECT sectionName FROM section WHERE SectionID='$secID'";
    $result3 = mysqli_query($con, $q1);
    $row3 = mysqli_fetch_assoc($result3);

    $records1[] = array("section"=>$row3['sectionName'],"resSectionValues"=>$row2["resSectionValues"]);
}

$resTotal = "SELECT COUNT(resourceID) as resTotal FROM resources";
$res = mysqli_query($con, $resTotal);
$record = mysqli_fetch_assoc($res);

$catTotal = "SELECT COUNT(categoryID) as catTotal FROM categories";
$cat = mysqli_query($con, $catTotal);
$record2= mysqli_fetch_assoc($cat);

$secTotal = "SELECT COUNT(sectionID) as secTotal FROM section";
$sec = mysqli_query($con, $secTotal);
$record3 = mysqli_fetch_assoc($sec);

$results = array();
$secRemain = "SELECT sectionName, sectionCapacity, sectionAllocated FROM section";
$sec1 = mysqli_query($con, $secRemain);
while($record4 = mysqli_fetch_assoc($sec1)){
    $results[] = array("sectionName"=>$record4["sectionName"],"sectionCapacity"=>$record4["sectionCapacity"],"sectionAllocated"=>$record4["sectionAllocated"]);
}


$myObj = array("sectionData"=>$records1,"categoryData"=>$records,"totalResources"=>$record["resTotal"],"totalSection"=>$record3["secTotal"],"totalCategories"=>$record2["catTotal"],"sectionRemain"=>$results);

echo json_encode($myObj);