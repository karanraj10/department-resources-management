<?php
$resID = $_REQUEST["resourceID"];

$con = mysqli_connect("localhost", "root", "", "department");

$fetch = "SELECT resourceSection FROM resources WHERE resourceID='$resID'";
$q1 = mysqli_query($con,$fetch);
$rec = mysqli_fetch_assoc($q1);
$resourceSection = $rec["resourceSection"];

$check = "DELETE FROM resources WHERE resourceID='$resID'";

$query = mysqli_query($con,$check);
if($query){
    $updateSection = "UPDATE section SET sectionAllocated = sectionAllocated-1 WHERE sectionID = '$resourceSection'";
    $query2 = mysqli_query($con,$updateSection);

    echo json_encode(array("status"=>true,"msg"=>"Resource Deleted Successfully"));
}
else{
    echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
}
?>