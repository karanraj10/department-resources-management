<?php
$con = mysqli_connect("localhost", "root", "", "department");

$resourceDestSec = $_POST["resourceDestinationSection"];
$resourceSourceSec = $_POST["resourceSourceSection"];
$resourceMACAddress = $_POST["resourceMAC"];

// Comaa Sperated value to array
$MACArray = explode(',', $resourceMACAddress);

$length = count($MACArray);

// String to use for IN operator
$names = implode('\', \'', $MACArray);
$fin = "'" . $names . "'";

$check = "UPDATE resources SET resourceSection='$resourceDestSec' WHERE resourceMAC IN ($fin)";
$query = mysqli_query($con,$check);
if($query){

    $updateSection = "UPDATE section SET sectionAllocated = sectionAllocated+'$length' WHERE sectionID = '$resourceDestSec'";
    $query = mysqli_query($con,$updateSection);

    $updateSection1 = "UPDATE section SET sectionAllocated = sectionAllocated-'$length' WHERE sectionID = '$resourceSourceSec'";
    $query1 = mysqli_query($con,$updateSection1);

    echo json_encode(array("status"=>true,"msg"=>"Resource transfered Successfully"));
}
else{
    echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
}
?>