<?php
$con = mysqli_connect("localhost", "root", "", "department");
$records = array();
$selectSec = "SELECT sectionID,sectionName,sectionDesc,sectionCapacity,sectionAllocated FROM section";
$result = mysqli_query($con, $selectSec);
while ($row = mysqli_fetch_assoc($result)) {
    $records[] = array("sectionID"=>$row["sectionID"],"sectionName"=>$row["sectionName"],"sectionDesc"=>$row["sectionDesc"],"sectionCapacity"=>$row["sectionCapacity"],"sectionAllocated"=>$row["sectionAllocated"]);
}
echo json_encode($records);